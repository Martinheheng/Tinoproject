<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // GET /admin/user
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    // GET /admin/user/create
    public function create()
    {
        return view('admin.user.create');
    }

    // POST /admin/user
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'telepon'  => 'required|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,petugas,peminjam',
            'alamat'   => 'required',
            'no_hp'    => 'nullable|unique:users'
        ]);

        User::create([
            'name'     => $request->name,
            'telepon'  => $request->telepon,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'alamat'   => $request->alamat,
            'no_hp'    => $request->no_hp
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
    }

    // GET /admin/user/{id}
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    // GET /admin/user/{id}/edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }
    
    // PUT /admin/user/{id}
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required',
            'telepon'  => 'required|unique:users,telepon,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
            'role'     => 'required|in:admin,petugas,peminjam',
            'alamat'   => 'required',
            'no_hp'    => 'nullable|unique:users,no_hp,' . $id
        ]);

        $data = $request->all();

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate');
    }

    // DELETE /admin/user/{id}
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
}
