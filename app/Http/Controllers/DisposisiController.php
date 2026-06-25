<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->only('destroy');
    }

    public function index()
    {
        $disposisi = Disposisi::with(['suratMasuk', 'pengirim', 'penerima', 'penerimaLainnya'])
            ->where(function ($q) {
                $q->where('kepada', Auth::id())
                  ->orWhere('dari', Auth::id())
                  ->orWhereHas('penerimaLainnya', function ($r) {
                      $r->where('user_id', Auth::id());
                  });
            })
            ->latest()
            ->get();

        return view('disposisi.index', compact('disposisi'));
    }

    public function create(SuratMasuk $suratMasuk)
    {
        $jabatanList = \App\Models\Jabatan::all();
        $instruksiOptions = [
            'Diteruskan',
            'Dimonitor',
            'Ditindak lanjuti',
            'Dibantu',
            'Diperbaiki',
            'Diarsip',
        ];
        $parentDisposisi = request('parent_id') ? Disposisi::with('pengirim')->find(request('parent_id')) : null;
        return view('disposisi.create', compact('suratMasuk', 'jabatanList', 'instruksiOptions', 'parentDisposisi'));
    }

    public function store(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:disposisi,id',
            'disposisi_jabatan' => 'required|array',
            'disposisi_jabatan.*' => 'exists:jabatan,id',
            'instruksi_jenis' => 'nullable|string',
            'catatan_direksi' => 'nullable|string',
            'batas_waktu' => 'nullable|date',
        ]);

        if ($request->filled('parent_id')) {
            $parent = Disposisi::find($request->parent_id);
            if ($parent && $parent->surat_masuk_id != $suratMasuk->id) {
                return back()->withErrors(['parent_id' => 'Disposisi induk tidak valid untuk surat masuk ini.'])->withInput();
            }
        }

        $firstJabatanId = $request->disposisi_jabatan[0];
        $firstJabatanUserIds = User::where('jabatan_id', $firstJabatanId)->where('id', '!=', Auth::id())->pluck('id')->toArray();
        $allUserIds = User::whereIn('jabatan_id', $request->disposisi_jabatan)->where('id', '!=', Auth::id())->pluck('id')->toArray();

        if (empty($allUserIds)) {
            return back()->withErrors(['disposisi_jabatan' => 'Tidak ada user ditemukan untuk jabatan yang dipilih.'])->withInput();
        }

        $utama = !empty($firstJabatanUserIds) ? $firstJabatanUserIds[0] : $allUserIds[0];
        $validated['surat_masuk_id'] = $suratMasuk->id;
        $validated['dari'] = Auth::id();
        $validated['kepada'] = $utama;
        unset($validated['disposisi_jabatan']);

        $disposisi = Disposisi::create($validated);

        foreach ($allUserIds as $userId) {
            if ($userId != $utama) {
                $disposisi->penerimaLainnya()->attach($userId);
            }
        }

        return redirect()->route('surat-masuk.show', $suratMasuk)
            ->with('success', 'Disposisi berhasil dikirim.');
    }

    public function show(Disposisi $disposisi)
    {
        $disposisi->load(['suratMasuk', 'pengirim', 'penerima', 'penerimaLainnya', 'parent', 'children']);

        $userId = Auth::id();
        $isRecipient = $disposisi->kepada === $userId ||
            $disposisi->penerimaLainnya->contains('id', $userId);

        if ($isRecipient && $disposisi->status === 'belum') {
            $disposisi->update(['status' => 'dibaca']);
        }

        $users = User::with('jabatan')->where('id', '!=', Auth::id())->get();
        $instruksiOptions = [
            'Diteruskan',
            'Dimonitor',
            'Ditindak lanjuti',
            'Dibantu',
            'Diperbaiki',
            'Diarsip',
        ];

        return view('disposisi.show', compact('disposisi', 'users', 'instruksiOptions'));
    }

    public function storeLanjutan(Request $request, Disposisi $disposisi)
    {
        $userId = Auth::id();
        $isParticipant = $disposisi->dari === $userId
            || $disposisi->kepada === $userId
            || $disposisi->penerimaLainnya->contains('id', $userId);

        if (!$isParticipant) {
            abort(403, 'Anda tidak memiliki akses untuk meneruskan disposisi ini.');
        }

        $validated = $request->validate([
            'kepada' => 'required|exists:users,id',
            'penerima_lainnya' => 'nullable|array',
            'penerima_lainnya.*' => 'exists:users,id',
            'instruksi_jenis' => 'nullable|string',
            'instruksi' => 'nullable|string',
            'catatan' => 'nullable|string',
            'catatan_direksi' => 'nullable|string',
            'batas_waktu' => 'nullable|date',
        ]);

        $validated['surat_masuk_id'] = $disposisi->surat_masuk_id;
        $validated['dari'] = Auth::id();
        $validated['parent_id'] = $disposisi->id;

        $baru = Disposisi::create($validated);

        if ($request->has('penerima_lainnya')) {
            foreach ($request->penerima_lainnya as $userId) {
                if ($userId != $request->kepada) {
                    $baru->penerimaLainnya()->attach($userId);
                }
            }
        }

        return redirect()->route('disposisi.show', $disposisi)
            ->with('success', 'Disposisi lanjutan berhasil dikirim.');
    }

    public function destroy(Disposisi $disposisi)
    {
        $disposisi->delete();
        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }
}
