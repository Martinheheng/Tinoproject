<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\alat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->search;
        $status   = $request->status;
        $sort     = $request->sort;
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;

        $alat = Alat::query()
            ->select('id', 'foto_alat', 'nama_alat', 'stok', 'harga_sewa')

            ->when($search, function ($query) use ($search) {
                $query->where('nama_alat', 'like', "%{$search}%");
            })

            // Filter Status
            ->when($status === 'available', function ($query) {
                $query->where('stok', '>', 0);
            })
            ->when($status === 'empty', function ($query) {
                $query->where('stok', 0);
            })

            // Filter Harga
            ->when($minPrice, function ($query) use ($minPrice) {
                $query->where('harga_sewa', '>=', $minPrice);
            })
            ->when($maxPrice, function ($query) use ($maxPrice) {
                $query->where('harga_sewa', '<=', $maxPrice);
            })

            // Sorting
            ->when($sort === 'termurah', function ($query) {
                $query->orderBy('harga_sewa', 'asc');
            })
            ->when($sort === 'termahal', function ($query) {
                $query->orderBy('harga_sewa', 'desc');
            })
            ->when($sort === 'stok', function ($query) {
                $query->orderBy('stok', 'desc');
            })

            ->latest()
            ->get();

        return view('peminjam.dashboard', compact('alat'));
    }
}
