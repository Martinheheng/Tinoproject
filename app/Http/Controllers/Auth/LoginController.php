<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $creadentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($creadentials)) {
            $request->session()->regenerate();

            $role = auth()->user()->role;
            
            if ($role === 'admin') {
                return redirect('/admin/dashboard');
            }
            if ($role === 'petugas') {
                return redirect('/petugas/dashboard');
            }
            return redirect('/peminjam/dashboard');
        }
        return back()->withErrors([
            'email' => 'Email atau Password salah'
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
