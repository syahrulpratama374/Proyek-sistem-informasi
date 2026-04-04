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
            </tr>
            
            @php $total_belanja = 0; @endphp
            
            @if(session('keranjang'))
                @foreach(session('keranjang') as $id => $item)
                    @php 
                        $subtotal = $item['harga'] * $item['jumlah'];
                        $total_belanja += $subtotal;
                    @endphp
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px;">{{ $item['nama_menu'] }}</td>
                        <td style="padding: 15px;">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td style="padding: 15px;">{{ $item['jumlah'] }} Porsi</td>
                        <td style="padding: 15px; font-weight: bold;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="padding: 20px; text-align: center; color: #888;">Keranjang Anda masih kosong. Yuk pesan makanan!</td>
                </tr>
            @endif
        </table>

        <div style="text-align: right; margin-top: 30px;">
            <h3 style="margin-bottom: 20px;">Total Pembayaran: <span style="color: orange;">Rp {{ number_format($total_belanja, 0, ',', '.') }}</span></h3>
            
            @if(session('keranjang'))
                <a href="/checkout" style="padding: 12px 25px; background: orange; color: white; text-decoration: none; font-weight: bold; border-radius: 4px;">Lanjut Cek Out</a>
            @endif
        </div>
    </div>
</div>
@endsection