<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $classes = ClassModel::all();

        // Filter berdasarkan role jika diberikan
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Menggunakan pagination dengan 10 item per halaman
        $users = $query->paginate(5);

        // Menambahkan parameter filter ke link pagination
        $users->appends($request->all());

        return view('users.index', compact('users', 'classes'));
    }

    public function create()
    {
        $classes = ClassModel::all();  // Ambil semua kelas
        return view('users.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'class_id' => 'nullable|exists:classes,id',  // Validasi class_id
            'role' => ['required', 'integer', 'in:1,2,3'],  // Memperbaiki validasi
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'class_id' => $request->class_id,  // Menyimpan class_id
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $classes = ClassModel::all();  // Ambil semua kelas
        return view('users.edit', compact('user', 'classes'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'class_id' => 'nullable|exists:classes,id',
            'role' => ['required', 'integer', 'in:1,2,3'],
            'password' => 'nullable|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->class_id = $request->class_id;
        $user->role = $request->role;

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
