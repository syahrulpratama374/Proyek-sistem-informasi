@extends('layouts.app')

@section('title', 'Cek Out - Salero Bundo')

@section('content')
<div style="padding: 30px; max-width: 1000px; margin: auto;">
    <h2>Penyelesaian Pesanan (Cek Out)</h2>

    <div style="display: flex; gap: 20px;">
        <div style="flex: 2; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h3>Data Pengiriman / Pemesan</h3>
            
            <form action="/checkout/proses" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Alamat Lengkap (Kosongkan jika makan di tempat)</label>
                    <textarea name="alamat" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;"></textarea>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Metode Pembayaran</label>
                    <select name="metode_pembayaran" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="E-Wallet (GoPay/OVO)">E-Wallet (GoPay/OVO)</option>
                        <option value="Bayar di Kasir (Cash)">Bayar di Kasir (Cash)</option>
                    </select>
                </div>
                <button type="submit" style="padding: 12px 20px; background: #28a745; color: white; border: none; width: 100%; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer;">Buat Pesanan Sekarang</button>
            </form>

        </div>

        <div style="flex: 1; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); height: fit-content;">
            <h3>Ringkasan Pesanan</h3>
            <ul style="list-style: none; padding: 0; margin-bottom: 20px;">
                @foreach($keranjang as $item)
                <li style="margin-bottom: 10px; border-bottom: 1px dashed #ddd; padding-bottom: 10px;">
                    <strong>{{ $item['nama_menu'] }}</strong> ({{ $item['jumlah'] }}x)<br>
                    <span style="color: #666;">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                </li>
                @endforeach
            </ul>
            <h3 style="border-top: 2px solid #eee; padding-top: 15px; margin-top: 0;">Total: <span style="color: orange;">Rp {{ number_format($total_belanja, 0, ',', '.') }}</span></h3>
        </div>
    </div>
</div>
@endsection