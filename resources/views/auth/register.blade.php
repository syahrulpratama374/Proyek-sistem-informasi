@extends('layouts.app')

@section('title', 'Daftar Akun - Salero Bundo')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); width: 350px; border: 1px solid #eee;">
        
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="margin: 0; color: #333;">Daftar Akun Baru</h2>
            <p style="color: #666; margin-top: 5px; font-size: 14px;">Mulai pesan makanan favoritmu</p>
        </div>
        
        <form action="/register" method="POST">
            @csrf
            
            @if ($errors->any())
                <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; font-size: 13px; border-left: 4px solid #dc3545;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Contoh: Syahrul Pratama" style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Nomor WhatsApp/Telepon</label>
                <input type="text" name="no_telepon" required placeholder="Contoh: 08123456789" style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Email</label>
                <input type="email" name="email" required placeholder="email@contoh.com" style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Password</label>
                <input type="password" name="password" minlength="8" required placeholder="Minimal 8 karakter" style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            <button type="submit" style="width: 100%; padding: 12px; background: #e74c3c; border: none; border-radius: 4px; color: white; font-weight: bold; cursor: pointer; font-size: 15px;">
                DAFTAR SEKARANG
            </button>
        </form>
        
        <p style="text-align: center; margin-top: 25px; font-size: 14px; color: #555;">
            Sudah punya akun? <a href="/login" style="color: #222; text-decoration: none; font-weight: bold;">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection