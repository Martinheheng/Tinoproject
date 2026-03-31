<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;

class LogController extends Controller
{
public function index(Request $request)
{
    $query = Log::with('user');

    // 🔍 SEARCH
    if ($request->search) {
        $query->where('description', 'like', '%' . $request->search . '%');
    }

    // 👤 FILTER USER
    if ($request->user_id) {
        $query->where('user_id', $request->user_id);
    }

    // 📅 FILTER TANGGAL
    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $logs = $query->latest()->paginate(15)->withQueryString();

    // 📊 DATA CHART (7 hari terakhir)
    $chartData = Log::selectRaw('DATE(created_at) as date, COUNT(*) as total')
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $users = User::all();

    return view('admin.log.index', compact('logs', 'users', 'chartData'));
}
}
