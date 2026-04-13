<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'no_hp' => 'nullable|unique:users,no_hp,' . $user->id,
            'profile_picture' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only('name', 'alamat', 'no_hp');

        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $user->update($data);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui');
    }
}
