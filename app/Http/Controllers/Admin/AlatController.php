<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
public function index(Request $request)
{
    $query = Alat::query();

    if ($request->search) {
        $query->where('nama_alat', 'like', '%'.$request->search.'%');
    }

    if ($request->kategori) {
        $query->where('kategori_id', $request->kategori);
    }

    $alats = $query->paginate(10)->withQueryString();

    $totalAlat = Alat::count();
    $totalStok = Alat::sum('stok');
    $alatHabis = Alat::where('stok', 0)->count();
    $kategoris = Kategori::all();

    return view('admin.alat.index', compact(
        'alats',
        'totalAlat',
        'totalStok',
        'alatHabis',
        'kategoris'
    ));
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
            $data = $request->all();

            if($request->hasFile('gambar')){
                $data['gambar'] = $request->file('gambar')->store('alat','public');
            }

            Alat::create($data);

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
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids || count($ids) == 0) {
            return back()->with('error', 'Tidak ada data dipilih');
        }

        Alat::whereIn('id', $ids)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
