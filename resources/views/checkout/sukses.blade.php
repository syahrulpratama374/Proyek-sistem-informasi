@extends('layouts.app')

@section('title', 'Pesanan Berhasil - Salero Bundo')

@section('content')
<div style="padding: 30px; max-width: 800px; margin: auto; text-align: center; min-height: 60vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">

    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 40px; font-weight: bold; font-size: 14px; color: #666; justify-content: center;">
        <span style="padding: 5px 15px; border: 1px solid #ccc; border-radius: 4px; background: white;">1. Keranjang</span>
        <span>────</span>
        <span style="padding: 5px 15px; border: 1px solid #ccc; border-radius: 4px; background: white;">2. Konfirmasi</span>
        <span>────</span>
        <span style="padding: 5px 15px; border: 1px solid #333; border-radius: 4px; background: #e9ecef; color: #333;">3. Selesai</span>
    </div>

    <div style="font-size: 80px; color: #27ae60; margin-bottom: 20px;">✅</div>

    <h1 style="margin-top: 0; color: #333; margin-bottom: 10px;">Pesanan Berhasil Dibuat!</h1>

    <p style="color: #555; font-size: 16px; line-height: 1.6; max-width: 500px; margin: 0 auto 30px auto;">
        Terima kasih telah memesan di Salero Bundo. Pesanan Anda telah masuk ke sistem dapur kami dan akan segera disiapkan. Mohon tunggu sejenak di meja Anda.
    </p>

    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="/#katalog-menu" style="display: inline-block; padding: 12px 25px; background: white; color: #333; text-decoration: none; border-radius: 4px; font-weight: bold; border: 1px solid #ccc;">
            + Pesan Menu Lain
        </a>

        <a href="/" style="display: inline-block; padding: 12px 25px; background: #222; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
            Kembali ke Beranda
        </a>
    </div>

</div>
@endsection