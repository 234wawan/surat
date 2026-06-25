<?php

namespace App\Http\Controllers;

use App\Models\MasterSurat;
use Illuminate\Http\Request;

class MasterSuratController extends Controller
{    public function index()
    {
        $masterSurat = MasterSurat::latest()->get();
        return view('master_surat.index', compact('masterSurat'));
    }

    public function show(MasterSurat $masterSurat)
    {
        $masterSurat->load('suratKeluar');
        return view('master_surat.show', compact('masterSurat'));
    }

    public function create()
    {
        return view('master_surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:master_surat,kode',
            'nama' => 'required|string|max:255',
            'pola_nomor' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        MasterSurat::create($validated);

        return redirect()->route('master-surat.index')->with('success', 'Master surat berhasil ditambahkan.');
    }

    public function edit(MasterSurat $masterSurat)
    {
        return view('master_surat.edit', compact('masterSurat'));
    }

    public function update(Request $request, MasterSurat $masterSurat)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:master_surat,kode,' . $masterSurat->id,
            'nama' => 'required|string|max:255',
            'pola_nomor' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $masterSurat->update($validated);

        return redirect()->route('master-surat.index')->with('success', 'Master surat berhasil diupdate.');
    }

    public function destroy(MasterSurat $masterSurat)
    {
        if ($masterSurat->suratKeluar()->count() > 0) {
            return back()->withErrors(['Master surat masih digunakan oleh ' . $masterSurat->suratKeluar()->count() . ' surat keluar.']);
        }
        $masterSurat->delete();
        return redirect()->route('master-surat.index')->with('success', 'Master surat berhasil dihapus.');
    }
}
