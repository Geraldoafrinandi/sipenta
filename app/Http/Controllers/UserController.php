<?php

namespace App\Http\Controllers;

use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User; // Pastikan model User sudah di-import

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('file');
        Excel::import(new ImportUser, $file);

        return redirect()->route('admin.user.index')->with('success', 'Data User berhasil diimpor.');
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
            'nim' => 'nullable|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,mahasiswa,dosen,kaprodi', // pastikan role yang di-input valid
        ]);

        // Simpan user baru ke dalam database
        $user = new User([
            'name' => $request->input('name'),
            'nim' => $request->input('nim'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'), // ambil role dari input form
        ]);
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'nullable|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:admin,kaprodi,dosen,mahasiswa', // sesuaikan dengan role yang tersedia
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
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
