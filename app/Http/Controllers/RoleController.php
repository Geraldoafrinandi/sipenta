<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function showAssignRoleForm()
    {
        $users = User::all(); // Dapatkan semua pengguna
        $roles = ['admin', 'mahasiswa', 'kaprodi', 'dosen']; // Role yang tersedia
        return view('admin.assign-role', compact('users', 'roles'));
    }

    /**
     * Assign the role to a user.
     */
    public function assignRole(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'role' => 'required|string|in:admin,mahasiswa,kaprodi,dosen', // Validasi role yang tersedia
        ]);

        $user = User::find($request->id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('assign.role')->with('success', 'Role assigned successfully.');
    }
}
