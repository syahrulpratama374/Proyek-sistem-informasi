<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Proses pendaftaran akun baru
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib dienkripsi
            'role' => 'pelanggan' // Paksa otomatis jadi pelanggan
        ]);

        return redirect('/login');
    }

    // Proses masuk (login)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika password benar, cek role-nya
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard'); // Admin masuk ke dapur
            } else {
                return redirect('/'); // Pelanggan masuk ke halaman depan
            }
        }

        // Jika salah password
        return redirect('/login');
    }

    // Proses keluar (logout)
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}