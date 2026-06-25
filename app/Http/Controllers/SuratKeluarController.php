<?php

namespace App\Http\Controllers;

use App\Models\MasterSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staf')->only(['create', 'store', 'edit', 'update', 'destroy', 'previewNomor']);
    }

    public function index()
    {
        $suratKeluar = SuratKeluar::with('masterSurat')->latest()->get();
        return view('surat_keluar.index', compact('suratKeluar'));
    }

    public function create()
    {
        $masterSurat = MasterSurat::all();
        return view('surat_keluar.create', compact('masterSurat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'master_surat_id' => 'nullable|exists:master_surat,id',
            'perihal' => 'required|string|max:255',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048',
            'isi_ringkas' => 'nullable|string',
            'no_urut' => 'nullable|integer|min:1',
        ]);

        $masterSurat = MasterSurat::find($validated['master_surat_id']);
        if ($masterSurat) {
            $manualNoUrut = $request->filled('no_urut') ? (int) $request->no_urut : null;
            $result = $this->generateNomorSurat($masterSurat, $validated['tanggal_surat'], $manualNoUrut);
            $validated['no_urut'] = $result['no_urut'];
            $validated['no_surat'] = $result['no_surat'];
        }

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran/surat_keluar', 'public');
        }

        $lastAgenda = SuratKeluar::where('no_agenda', 'like', 'SK-' . date('Ymd') . '-%')->orderBy('no_agenda', 'desc')->first();
        $nextUrut = $lastAgenda ? (int) substr($lastAgenda->no_agenda, -4) + 1 : 1;
        $validated['no_agenda'] = 'SK-' . date('Ymd') . '-' . str_pad($nextUrut, 4, '0', STR_PAD_LEFT);
        $validated['user_id'] = Auth::id();

        SuratKeluar::create($validated);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function show(SuratKeluar $suratKeluar)
    {
        $suratKeluar->load('masterSurat');
        return view('surat_keluar.show', compact('suratKeluar'));
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        $masterSurat = MasterSurat::all();
        return view('surat_keluar.edit', compact('suratKeluar', 'masterSurat'));
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'master_surat_id' => 'nullable|exists:master_surat,id',
            'perihal' => 'required|string|max:255',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048',
            'isi_ringkas' => 'nullable|string',
            'no_urut' => 'nullable|integer|min:1',
        ]);

        $masterSurat = MasterSurat::find($validated['master_surat_id']);
        $manualNoUrut = $request->filled('no_urut') ? (int) $request->no_urut : null;

        $tanggalBerubah = $validated['tanggal_surat'] != $suratKeluar->tanggal_surat->format('Y-m-d');
        if ($masterSurat && ($manualNoUrut || $tanggalBerubah || $validated['master_surat_id'] != $suratKeluar->master_surat_id)) {
            $result = $this->generateNomorSurat($masterSurat, $validated['tanggal_surat'], $manualNoUrut);
            $validated['no_urut'] = $result['no_urut'];
            $validated['no_surat'] = $result['no_surat'];
        }

        if ($request->hasFile('lampiran')) {
            if ($suratKeluar->lampiran) {
                Storage::disk('public')->delete($suratKeluar->lampiran);
            }
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran/surat_keluar', 'public');
        }

        $suratKeluar->update($validated);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diupdate.');
    }

    public function print(SuratKeluar $suratKeluar)
    {
        $suratKeluar->load('masterSurat');
        return view('surat_keluar.print', compact('suratKeluar'));
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        if ($suratKeluar->lampiran) {
            Storage::disk('public')->delete($suratKeluar->lampiran);
        }
        $suratKeluar->delete();
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus.');
    }

    public function previewNomor(Request $request)
    {
        $request->validate([
            'master_surat_id' => 'required|exists:master_surat,id',
            'tanggal_surat' => 'required|date',
            'no_urut' => 'nullable|integer|min:1',
        ]);

        $masterSurat = MasterSurat::findOrFail($request->master_surat_id);
        $manualNoUrut = $request->filled('no_urut') ? (int) $request->no_urut : null;
        $result = $this->generateNomorSurat($masterSurat, $request->tanggal_surat, $manualNoUrut);

        return response()->json($result);
    }

    private function generateNomorSurat(MasterSurat $masterSurat, string $tanggalSurat, ?int $manualNoUrut = null): array
    {
        $date = \Carbon\Carbon::parse($tanggalSurat);
        $year = $date->format('Y');
        $month = (int) $date->format('m');

        $romanMonths = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulanRomawi = $romanMonths[$month - 1];

        if ($manualNoUrut !== null) {
            $no_urut = $manualNoUrut;
        } else {
            $last = SuratKeluar::where('master_surat_id', $masterSurat->id)
                ->whereYear('tanggal_surat', $year)
                ->whereMonth('tanggal_surat', $month)
                ->orderBy('no_urut', 'desc')
                ->first();

            $no_urut = $last ? $last->no_urut + 1 : 1;
        }

        $polaNomor = $masterSurat->pola_nomor ?? '';
        $noSurat = str_replace(
            ['{no_urut}', '{bulan_romawi}', '{tahun}'],
            [str_pad($no_urut, 3, '0', STR_PAD_LEFT), $bulanRomawi, $year],
            $polaNomor
        );

        return [
            'no_urut' => $no_urut,
            'no_surat' => $noSurat,
        ];
    }
}
