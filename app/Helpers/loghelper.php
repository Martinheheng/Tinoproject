<?php

use App\Models\Log_aktifitas;
use Illuminate\Support\Facades\Auth;

if (!function_exists('logAktivitas')) {
    function logAktivitas($aksi, $target_type = null, $target_id = null, $deskripsi = null)
    {
        if (!Auth::check()) return;

        Log_aktifitas::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role,
            'aksi' => $aksi,
            'target_type' => $target_type,
            'target_id' => $target_id,
            'deskripsi' => $deskripsi
        ]);
    }
}