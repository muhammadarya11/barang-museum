<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_index(Request $request)
    {
        $query = User::query();

        if ($request->filled('cari')) {
            $keyword = $request->cari;
            $query->where('nama', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->orWhere('role', 'like', "%{$keyword}%");
        }
        $data = $query->get();
        return view('admin.user', compact('data'));
    }

    public function tambah_user()
    {
        return view('admin.tambah_user');
    }

    public function simpan_user(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard')->with('notifikasi', [
            'icon' => 'plus-circle-fill',
            'color' => 'primary',
            'message' => 'User berhasil ditambahkan!'
        ]);
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'password' => 'nullable|string|min:6',
            'role' => 'required|string',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('dashboard')->with('notifikasi', [
        'icon' => 'pencil-square',
        'color' => 'warning',
        'message' => 'User berhasil diperbarui!'
        ]);
    }

    public function hapus_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard')->with('notifikasi', [
        'icon' => 'trash-fill',
        'color' => 'danger',
        'message' => 'User berhasil dihapus!'
        ]);
    }

    public function formResetPassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.reset_password', compact('user'));
    }

    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.index')->with('success', 'Password user berhasil direset.');
    }
}
