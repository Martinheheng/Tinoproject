<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Log_aktifitas;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log_aktifitas::latest()->get();
        return view("admin.log.index", compact("logs"));
    }
}
