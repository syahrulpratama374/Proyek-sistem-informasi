@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Salero Bundo')
@section('header_title', 'Dashboard Ringkasan')

@section('content')
    @php
        $pesananHariIni = \App\Models\Pesanan::whereDate('created_at', today())->count();
        $pesananPending = \App\Models\Pesanan::where('status', 'pending')->count();
        $totalPelanggan = \App\Models\User::where('role', 'pelanggan')->count();
        $menuAktif      = \App\Models\Menu::where('tersedia', true)->count();
    @endphp

    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 30px;">
        
        <div style="background: white; padding: 25px; border-radius: 8px; flex: 1; min-width: 200px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 5px solid #28a745;">
            <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; text-transform: uppercase;">Pesanan Hari Ini</h4>
            <h2 style="margin: 0; color: #333; font-size: 32px;">{{ $pesananHariIni }}</h2>
        </div>

        <div style="background: white; padding: 25px; border-radius: 8px; flex: 1; min-width: 200px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 5px solid #e74c3c;">
            <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; text-transform: uppercase;">Perlu Diproses</h4>
            <h2 style="margin: 0; color: #e74c3c; font-size: 32px;">{{ $pesananPending }}</h2>
        </div>

        <div style="background: white; padding: 25px; border-radius: 8px; flex: 1; min-width: 200px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 5px solid #007bff;">
            <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; text-transform: uppercase;">Total Pelanggan</h4>
            <h2 style="margin: 0; color: #333; font-size: 32px;">{{ $totalPelanggan }}</h2>
        </div>

        <div style="background: white; padding: 25px; border-radius: 8px; flex: 1; min-width: 200px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 5px solid #f39c12;">
            <h4 style="margin: 0 0 10px 0; color: #666; font-size: 14px; text-transform: uppercase;">Menu Aktif</h4>
            <h2 style="margin: 0; color: #333; font-size: 32px;">{{ $menuAktif }}</h2>
        </div>
    </div>

    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h3 style="margin-top: 0; color: #333; margin-bottom: 15px;">Selamat Datang di Panel Admin Salero Bundo!</h3>
        <p style="color: #555; line-height: 1.6;">
            Gunakan menu di sebelah kiri untuk mengelola pesanan masuk, mengatur katalog menu, dan melihat laporan pendapatan harian restoran Anda.
            <br><br>
            <strong>📌 Tips Hari Ini:</strong> Pastikan Anda selalu mengecek menu "Kelola Pesanan" dan memperhatikan angka "Perlu Diproses" di atas agar pelanggan tidak menunggu lama.
        </p>
        
        <div style="margin-top: 25px;">
            <a href="/admin/pesanan" style="display: inline-block; padding: 12px 20px; background: #343a40; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; margin-right: 10px;">
                🛒 Lihat Pesanan Masuk
            </a>
            <a href="/admin/produk" style="display: inline-block; padding: 12px 20px; background: #f39c12; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
                🍱 Kelola Menu
            </a>
        </div>
    </div>
@endsection