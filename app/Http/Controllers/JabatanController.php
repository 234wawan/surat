<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::withCount('users')->latest()->get();
        return view('jabatan.index', compact('jabatan'));
    }

    public function show(Jabatan $jabatan)
    {
        $jabatan->load('users');
        return view('jabatan.show', compact('jabatan'));
    }

    public function create()
    {
        return view('jabatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:jabatan,nama',
            'keterangan' => 'nullable|string',
        ]);

        Jabatan::create($validated);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:jabatan,nama,' . $jabatan->id,
            'keterangan' => 'nullable|string',
        ]);

        $jabatan->update($validated);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diupdate.');
    }

    public function destroy(Jabatan $jabatan)
    {
        if ($jabatan->users()->count() > 0) {
            return back()->withErrors(['Jabatan masih memiliki pengguna.']);
        }
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
