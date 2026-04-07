@extends('layouts.app')

@section('title', 'Login - Salero Bundo')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); width: 350px; border: 1px solid #eee;">
        
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="margin: 0; color: #333;">Selamat Datang</h2>
            <p style="color: #666; margin-top: 5px; font-size: 14px;">Silakan masuk ke akun Anda</p>
        </div>
        
        <form action="/login" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Email</label>
                <input type="email" name="email" required placeholder="email@contoh.com" style="width: 100%; padding: 12px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; outline: none;">
            </div>
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Password</label>
                <input type="password" name="password" required placeholder="Masukkan password" style="width: 100%; padding: 12px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; outline: none;">
            </div>
            
            <button type="submit" style="width: 100%; padding: 12px; background: #222; border: none; border-radius: 4px; color: white; font-weight: bold; cursor: pointer; font-size: 15px;">
                MASUK
            </button>
        </form>
        
        <p style="text-align: center; margin-top: 25px; font-size: 14px; color: #555;">
            Belum punya akun? <a href="/register" style="color: #e74c3c; text-decoration: none; font-weight: bold;">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection