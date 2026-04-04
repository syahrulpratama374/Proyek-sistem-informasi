@extends('layouts.app')

@section('title', 'Daftar Akun - Salero Bundo')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 350px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Daftar Akun Baru</h2>
        
        <form action="/register/proses" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Lengkap</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Email</label>
                <input type="email" name="email" required style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <button type="submit" style="width: 100%; padding: 12px; background: orange; border: none; border-radius: 4px; color: white; font-weight: bold; cursor: pointer;">Daftar Sekarang</button>
        </form>
        
        <p style="text-align: center; margin-top: 20px; font-size: 14px;">
            Sudah punya akun? <a href="/login" style="color: #007bff; text-decoration: none;">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection