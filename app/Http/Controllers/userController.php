<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class UserController extends Controller 
{
    public function store(Request $request)
    {
        
        User::create([    
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/users');
    }
}
