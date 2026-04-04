@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')
@section('header_title', 'Detail Pesanan #ORD-' . $pesanan->id)

@section('content')
<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 800px;">
    
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
        <div>
            <h3 style="margin-top: 0;">Data Pelanggan</h3>
            <p style="margin: 5px 0;"><strong>Nama:</strong> {{ $pesanan->nama_pelanggan }}</p>
            <p style="margin: 5px 0;"><strong>Alamat:</strong> {{ $pesanan->alamat ?? 'Makan di tempat' }}</p>
            <p style="margin: 5px 0;"><strong>Tanggal Pesan:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
        </div>
        <div style="text-align: right;">
            <h3 style="margin-top: 0;">Status Transaksi</h3>
            <p style="margin: 5px 0;"><strong>Metode:</strong> {{ $pesanan->metode_pembayaran }}</p>
            <span style="display: inline-block; padding: 5px 10px; background: #e9ecef; border-radius: 4px; font-weight: bold; color: {{ $pesanan->status == 'Selesai' ? 'green' : 'orange' }};">
                {{ $pesanan->status }}
            </span>
        </div>
    </div>

    <h3 style="margin-top: 0;">Rincian Menu yang Dipesan</h3>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr style="background: #f8f9fa;">
            <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Nama Menu</th>
            <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Harga Satuan</th>
            <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Jumlah</th>
            <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Subtotal</th>
        </tr>
        
        @foreach($pesanan->detailPesanans as $detail)
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $detail->menu->nama_menu }}</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $detail->jumlah }} porsi</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">Rp {{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div style="text-align: right;">
        <h2>Total Bayar: <span style="color: orange;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></h2>
    </div>

    <div style="margin-top: 30px;">
        <a href="/admin/pesanan" style="padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">&larr; Kembali ke Daftar Pesanan</a>
    </div>

</div>
@endsection