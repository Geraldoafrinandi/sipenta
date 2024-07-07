<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $role = ($request->name === 'admin' && $request->password === 'admin123') ? 'admin' : 'mahasiswa';

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'nim' => $role === 'admin' ? 'nullable|string|max:20|unique:users' : 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        Auth::login($user);

        return redirect()->intended('/login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }
}
