<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User sudah di-import

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }
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
        return redirect()->route('admin.user.index')->with('success', 'Password berhasil diubah');
    }

    public function showChangePasswordForm()
    {
        return view('admin.change_password'); // Sesuaikan dengan nama blade template yang Anda gunakan
    }

    public function create()
    {
        return view('admin.user.create');
    }

public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,mahasiswa,dosen', // pastikan role yang di-input valid
    ]);

    // Simpan user baru ke dalam database
    $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'role' => $request->input('role'), // ambil role dari input form
    ]);
    $user->save();

    // Redirect dengan pesan sukses
    return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
}

public function destroy($id)
{
    // Cari user berdasarkan ID
    $user = User::findOrFail($id);

    // Hapus user
    $user->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
}
}
