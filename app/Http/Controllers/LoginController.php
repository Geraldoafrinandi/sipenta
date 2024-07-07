<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
{
    $credentials = $request->validate([
        'identifier' => ['required'],
        'password' => ['required'],
    ], [
        'identifier.required' => 'Email atau NIM wajib diisi.',
        'password.required' => 'Password wajib diisi.',
    ]);

    // Check if the identifier is an email
    $isEmail = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL);

    // Determine the field to use for authentication
    $field = $isEmail ? 'email' : 'nim';

    if (Auth::attempt([$field => $credentials['identifier'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();

        // Redirect based on user role
        if (Auth::user()->role == 'dosen') {
            return redirect()->intended('/admin-dashboard/dosen'); // Ganti '/dosen/home' dengan route untuk halaman dosen
        } elseif (Auth::user()->role == 'mahasiswa') {
            return redirect()->intended('/admin-dashboard/mahasiswa'); // Ganti '/mahasiswa/home' dengan route untuk halaman mahasiswa
        } else {
            return redirect()->intended('/backend'); // Misalnya untuk admin atau role lainnya
        }
    }

    return back()->withErrors([
        'identifier' => 'Login gagal, coba lagi.',
    ])->onlyInput('identifier');
}

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
