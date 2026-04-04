@extends('layouts.app')

@section('title', 'Keranjang Pesanan - Salero Bundo')

@section('content')
<div style="padding: 30px; max-width: 1000px; margin: auto;">
    <h2>Keranjang Anda</h2>
    
    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <tr style="background: #f8f9fa; border-bottom: 2px solid #ddd;">
                <th style="padding: 15px;">Menu</th>
                <th style="padding: 15px;">Harga</th>
                <th style="padding: 15px;">Jumlah</th>
                <th style="padding: 15px;">Total</th>
                <th style="padding: 15px; text-align: center;">Aksi</th>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 15px;">Rendang Daging</td>
                <td style="padding: 15px;">Rp 20.000</td>
                <td style="padding: 15px;"><input type="number" value="2" style="width: 60px; padding: 5px;"></td>
                <td style="padding: 15px; font-weight: bold;">Rp 40.000</td>
                <td style="padding: 15px; text-align: center;">
                    <button style="background: none; border: none; color: red; cursor: pointer; font-weight: bold;">X Hapus</button>
                </td>
            </tr>
        </table>

        <div style="text-align: right; margin-top: 30px;">
            <h3 style="margin-bottom: 20px;">Total Pembayaran: <span style="color: orange;">Rp 40.000</span></h3>
            <a href="/checkout" style="padding: 12px 25px; background: orange; color: white; text-decoration: none; font-weight: bold; border-radius: 4px;">Lanjut Cek Out</a>
        </div>
    </div>
</div>
@endsection