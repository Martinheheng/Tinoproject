<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::with('kategori')->get();
        return view('admin.alat.index', compact('alat'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'stok' => 'required|integer',
            'harga_sewa' => 'required|numeric',
            'kategori_id' => 'required',
            'foto_alat' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required'
        ]);
        $foto_alat = $request->file('foto_alat')->store('alat', 'public');

        Alat::create([
            'nama_alat' => $request->nama_alat,
            'foto_alat' => $foto_alat,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'harga_sewa' => $request->harga_sewa
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required',
            'stok' => 'required|integer',
            'harga_sewa' => 'required|numeric',
            'kategori_id' => 'required'
        ]);

        $alat->update($request->all());

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat Berhasil Dihapus');
    }
}
