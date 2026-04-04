@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan')
@section('header_title', 'Daftar Pesanan Masuk')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <tr style="background: #343a40; color: white;">
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">ID Order</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Nama Pelanggan</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Metode Pembayaran</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Total Bayar</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Status Saat Ini</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Aksi / Update Status</th>
        </tr>
        
        @foreach($pesanans as $item)
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd; font-weight: bold;">#ORD-{{ $item->id }}</td>
            <td style="padding: 12px; border: 1px solid #ddd;">
                {{ $item->nama_pelanggan }} <br>
                <span style="font-size: 12px; color: #666;">Alamat: {{ $item->alamat ?? 'Makan di tempat' }}</span>
            </td>
            <td style="padding: 12px; border: 1px solid #ddd;">{{ $item->metode_pembayaran }}</td>
            <td style="padding: 12px; border: 1px solid #ddd; font-weight: bold; color: orange;">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
            
            <td style="padding: 12px; border: 1px solid #ddd; font-weight: bold; 
                color: {{ $item->status == 'Selesai' ? 'green' : ($item->status == 'Sedang Diproses' ? 'blue' : 'red') }};">
                {{ $item->status }}
            </td>
            
            <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                <form action="/admin/pesanan/update/{{ $item->id }}" method="POST" style="display: flex; gap: 5px; justify-content: center; align-items: center;">
                    @csrf
                    <select name="status" style="padding: 6px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="Menunggu Pembayaran" {{ $item->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="Sedang Diproses" {{ $item->status == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                        <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Dibatalkan" {{ $item->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <button type="submit" style="background: #28a745; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer;">Simpan</button>
                    
                    <a href="/admin/pesanan/detail/{{ $item->id }}" style="background: #007bff; color: white; text-decoration: none; padding: 6px 10px; border-radius: 4px; font-size: 14px;">Lihat Detail</a>
                </form>
            </td>
        </tr>
        @endforeach

        @if($pesanans->isEmpty())
        <tr>
            <td colspan="6" style="padding: 20px; text-align: center; color: #888;">Belum ada pesanan masuk hari ini.</td>
        </tr>
        @endif
    </table>

</div>
@endsection