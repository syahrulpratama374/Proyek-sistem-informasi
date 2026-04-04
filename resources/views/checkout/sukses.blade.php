@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')
<div style="text-align: center; padding: 50px 20px; max-width: 600px; margin: auto; min-height: 50vh;">
    <div style="font-size: 60px; color: #28a745; margin-bottom: 20px;">✅</div>
    <h2 style="margin-top: 0;">Pesanan Berhasil Dibuat!</h2>
    <p style="color: #666; font-size: 16px; line-height: 1.6;">Terima kasih telah memesan di Salero Bundo. Pesanan Anda akan segera kami siapkan.</p>
    
    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px dashed #ccc;">
        <h3 style="margin: 0; color: #333;">ID Pesanan: #ORD-{{ session('pesanan_id') }}</h3>
    </div>

    <a href="/" style="display: inline-block; padding: 10px 20px; background: orange; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">Kembali ke Beranda</a>
</div>
@endsection