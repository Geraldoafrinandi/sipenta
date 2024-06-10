<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User sudah di-import

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah password saat ini benar
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini tidak sesuai');
        }

        // Update password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.change.password')->with('success', 'Password berhasil diubah');
    }

    public function showChangePasswordForm()
    {
        return view('admin.change_password'); // Sesuaikan dengan nama blade template yang Anda gunakan
    }
}
