<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        
        $request->validate([
            'name'       => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email'      => 'required|string|email|max:255|unique:users', 
            'password'   => 'required|string|min:8', 
        ], [
           
            'password.min' => 'Maaf, password wajib terdiri dari minimal 8 karakter!',
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau coba login.'
        ]);

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'no_telepon' => $request->no_telepon,
            'role' => 'pelanggan' 
        ]);

       
        return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        
        if (Auth::attempt($credentials)) {
            
          
            $request->session()->regenerate(); 

            
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/');
            }
        }

        
        return back()->with('error', 'Email atau Password salah!');
    }

  
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}