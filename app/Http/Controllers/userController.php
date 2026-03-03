<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class UserController extends Controller 
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.index');
    }

public function store(Request $request)
{
    $request->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'alamat'   => 'required',
        'role'     => 'required'
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'alamat'   => $request->alamat,
        'role'     => $request->role,
    ]);

    return redirect()->route('admin.user.index')
        ->with('success', 'User berhasil ditambahkan');
}
}