<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log_aktifitas;
use Illuminate\Http\Request;

class LogAktifitasController extends Controller
{
    public function index(Request $request)
    {

        $query = Log_aktifitas::with('user');

        // 🔍 Filter role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // 🔍 Filter aksi
        if ($request->filled('aksi')) {
            $query->where('aksi', 'like', '%' . $request->aksi . '%');
        }

        // 🔍 Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $logs = $query->latest()->paginate(10)->withQueryString();

        return view('admin.log.index', compact('logs'));
    }
}