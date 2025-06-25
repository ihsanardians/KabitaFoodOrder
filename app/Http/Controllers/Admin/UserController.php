<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Penting untuk enkripsi password

class UserController extends Controller
{
    // Menampilkan daftar semua user
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password di-hash (enkripsi)
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User kasir baru berhasil dibuat.');
    }

    // Method lain (show, edit, update, destroy) bisa kita lengkapi nanti
}