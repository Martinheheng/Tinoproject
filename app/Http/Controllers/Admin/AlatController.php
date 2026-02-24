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
        $alats = Alat::with('kategori')->get();
        return view('admin.alat.index', compact('alats'));
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
            'kategori_id' => 'required'
        ]);

        Alat::create($request->all());

        return redirect()->route('alat.index')
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

        return redirect()->route('alat.index')
            ->with('success', 'Alat Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alat.index')
            ->with('success', 'Alat Berhasil Dihapus');
    }
}
