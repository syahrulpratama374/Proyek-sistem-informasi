@extends('admin.layouts.app')

@section('title', 'Laporan Penjualan - Salero Bundo')
@section('header_title', 'Laporan Pendapatan')

@section('content')

<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px; text-align: center; border-bottom: 4px solid #28a745;">
    <h3 style="margin: 0; color: #666; font-size: 16px;">Total Pendapatan Bersih</h3>
    <h1 style="margin: 10px 0 0 0; color: #28a745; font-size: 36px;">
        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
    </h1>
    <p style="margin: 5px 0 0 0; color: #888; font-size: 13px;">(Hanya menghitung pesanan dengan status "Selesai")</p>
</div>

<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
        <h4 style="margin: 0; color: #333;">Rincian Transaksi</h4>
        
        <div style="display: flex; gap: 5px;">
            <a href="?filter=hari" style="padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $filter == 'hari' ? 'background: #007bff; color: white;' : 'background: #f8f9fa; color: #555; border: 1px solid #ddd;' }}">Hari Ini</a>
            
            <a href="?filter=minggu" style="padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $filter == 'minggu' ? 'background: #007bff; color: white;' : 'background: #f8f9fa; color: #555; border: 1px solid #ddd;' }}">Minggu Ini</a>
            
            <a href="?filter=bulan" style="padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $filter == 'bulan' ? 'background: #007bff; color: white;' : 'background: #f8f9fa; color: #555; border: 1px solid #ddd;' }}">Bulan Ini</a>
            
            <a href="?filter=tahun" style="padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $filter == 'tahun' ? 'background: #007bff; color: white;' : 'background: #f8f9fa; color: #555; border: 1px solid #ddd;' }}">Tahun Ini</a>
            
            <a href="?filter=semua" style="padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; font-weight: bold; {{ $filter == 'semua' ? 'background: #007bff; color: white;' : 'background: #f8f9fa; color: #555; border: 1px solid #ddd;' }}">Semua Waktu</a>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 700px;">
            <tr style="background: #343a40; color: white; font-size: 14px;">
                <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Tanggal</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Kode Pesanan</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Nama Pelanggan</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: right;">Nominal</th>
            </tr>

            @forelse($laporans as $item)
            <tr>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $item->created_at->format('d M Y, H:i') }}</td>
                <td style="padding: 12px; border: 1px solid #ddd; font-weight: bold;">{{ $item->kode_pesanan }}</td>
                <td style="padding: 12px; border: 1px solid #ddd;">{{ $item->user->name ?? 'Kasir / Guest' }}</td>
                <td style="padding: 12px; border: 1px solid #ddd; text-align: right; color: #28a745; font-weight: bold;">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 40px; text-align: center; color: #888; background: #f8f9fa;">
                    <div style="font-size: 30px; margin-bottom: 10px;">📉</div>
                    Belum ada data penjualan "Selesai" untuk periode ini.
                </td>
            </tr>
            @endforelse
        </table>
    </div>

</div>
@endsection