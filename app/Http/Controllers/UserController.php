<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role jika diberikan
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'kelas' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'integer', 'in:1,2,3'],  // Memperbaiki validasi
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'kelas' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'integer', 'in:1,2,3'],  // Memperbaiki validasi
            'password' => 'nullable|string|min:8|confirmed',  // Password adalah opsional
        ]);

        // Perbarui data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->kelas = $request->kelas;
        $user->role = $request->role;

        // Jika password baru diinputkan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Hash password baru
        }

        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function hitung()
    {
        $userCount = User::count(); // Jumlah user
        return view('admin.dashboard', compact('userCount'));
    }
}
