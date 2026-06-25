<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staf')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $suratMasuk = SuratMasuk::latest()->get();
        return view('surat_masuk.index', compact('suratMasuk'));
    }

    public function create()
    {
        return view('surat_masuk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_agenda' => 'required|string|max:255|unique:surat_masuk,no_agenda',
            'no_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_terima' => 'required|date',
            'jam_terima' => 'nullable|date_format:H:i',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048',
            'isi_ringkas' => 'nullable|string',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran/surat_masuk', 'public');
        }

        $validated['user_id'] = Auth::id();

        $suratMasuk = SuratMasuk::create($validated);

        return redirect()->route('surat-masuk.show', $suratMasuk)->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function show(SuratMasuk $suratMasuk)
    {
        $disposisi = $suratMasuk->disposisi()->with(['pengirim', 'penerima', 'penerimaLainnya', 'children.pengirim', 'children.penerima', 'children.penerimaLainnya'])->whereNull('parent_id')->latest()->get();
        return view('surat_masuk.show', compact('suratMasuk', 'disposisi'));
    }

    public function edit(SuratMasuk $suratMasuk)
    {
        return view('surat_masuk.edit', compact('suratMasuk'));
    }

    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'no_agenda' => 'required|string|max:255|unique:surat_masuk,no_agenda,' . $suratMasuk->id,
            'no_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_terima' => 'required|date',
            'jam_terima' => 'nullable|date_format:H:i',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'lampiran' => 'nullable|file|mimes:pdf|max:2048',
            'isi_ringkas' => 'nullable|string',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('lampiran')) {
            if ($suratMasuk->lampiran) {
                Storage::disk('public')->delete($suratMasuk->lampiran);
            }
            $validated['lampiran'] = $request->file('lampiran')->store('lampiran/surat_masuk', 'public');
        }

        $suratMasuk->update($validated);

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil diupdate.');
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        if ($suratMasuk->lampiran) {
            Storage::disk('public')->delete($suratMasuk->lampiran);
        }
        $suratMasuk->delete();
        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil dihapus.');
    }
}
