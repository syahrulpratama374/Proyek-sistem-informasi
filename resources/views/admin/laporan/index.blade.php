@extends('admin.layouts.app')

@section('title', 'Laporan Penjualan')
@section('header_title', 'Laporan Pendapatan Salero Bundo')

@section('content')
<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px;">🖨️ Cetak Laporan (PDF)</button>
    </div>

    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="margin: 0;">Laporan Penjualan</h2>
        <p style="color: #666; margin-top: 5px;">Rumah Makan Padang Salero Bundo</p>
        <hr style="border: 1px solid #eee;">
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr style="background: #f8f9fa;">
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Tanggal</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">ID Order</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Nama Pelanggan</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Metode</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: right;">Pendapatan</th>
        </tr>

        @forelse($pesanans as $item)
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->created_at->format('d M Y') }}</td>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">#ORD-{{ $item->id }}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->nama_pelanggan }}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->metode_pembayaran }}</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: right; color: green; font-weight: bold;">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="padding: 20px; text-align: center; color: #888;">Belum ada pesanan yang berstatus "Selesai".</td>
        </tr>
        @endforelse
    </table>

    <div style="text-align: right; font-size: 20px;">
        <strong>Total Pendapatan: <span style="color: orange;">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</span></strong>
    </div>

</div>

<style>
    @media print {
        /* 1. Sembunyikan semua elemen di layar */
        body * {
            visibility: hidden; 
        }
        /* 2. Tampilkan hanya elemen yang ada di dalam kotak laporan */
        main, main * {
            visibility: visible; 
        }
        /* 3. Geser posisi laporan ke pojok kiri atas kertas */
        main {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0 !important;
        }
        /* 4. Sembunyikan sidebar, header, dan tombol cetak */
        aside, header, .no-print {
            display: none !important; 
        }
    }
</style>
@endsection