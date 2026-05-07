@extends('admin.layouts.app')

@section('title', 'Laporan Penjualan - Ratu Minang')
@section('header_title', 'Laporan Pendapatan')

@section('content')

<div style="background: linear-gradient(145deg, #1A1208, #0F0A05); padding: 30px; border-radius: 8px; border: 1px solid rgba(201, 168, 76, 0.2); box-shadow: 0 4px 15px rgba(0,0,0,0.5); margin-bottom: 25px; text-align: center; border-bottom: 4px solid #C9A84C;">
    <h3 style="margin: 0; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 13px; letter-spacing: 3px;">TOTAL PENDAPATAN BERSIH</h3>
    <h1 style="margin: 15px 0 0 0; color: #C9A84C; font-family: 'Playfair Display', serif; font-size: 42px; font-weight: bold; text-shadow: 0 2px 10px rgba(201, 168, 76, 0.2);">
        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
    </h1>
    <p style="margin: 8px 0 0 0; color: rgba(250, 243, 224, 0.5); font-size: 13px; font-style: italic;">(Hanya menghitung pesanan dengan status "Selesai")</p>
</div>

<div style="background: #0A0805; padding: 25px; border-radius: 8px; border: 1px solid rgba(201, 168, 76, 0.2); box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
        <h4 style="margin: 0; color: #E8C97A; font-family: 'Playfair Display', serif; font-size: 24px;">Rincian Transaksi</h4>
        
        <div style="display: flex; gap: 8px; font-family: 'Cinzel', serif;">
            <a href="?filter=hari" style="padding: 8px 16px; border-radius: 4px; text-decoration: none; font-size: 11px; font-weight: bold; letter-spacing: 1px; transition: 0.3s; {{ $filter == 'hari' ? 'background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; border: 1px solid #C9A84C;' : 'background: transparent; color: #C9A84C; border: 1px solid rgba(201,168,76,0.3);' }}">HARI INI</a>
            
            <a href="?filter=minggu" style="padding: 8px 16px; border-radius: 4px; text-decoration: none; font-size: 11px; font-weight: bold; letter-spacing: 1px; transition: 0.3s; {{ $filter == 'minggu' ? 'background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; border: 1px solid #C9A84C;' : 'background: transparent; color: #C9A84C; border: 1px solid rgba(201,168,76,0.3);' }}">MINGGU INI</a>
            
            <a href="?filter=bulan" style="padding: 8px 16px; border-radius: 4px; text-decoration: none; font-size: 11px; font-weight: bold; letter-spacing: 1px; transition: 0.3s; {{ $filter == 'bulan' ? 'background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; border: 1px solid #C9A84C;' : 'background: transparent; color: #C9A84C; border: 1px solid rgba(201,168,76,0.3);' }}">BULAN INI</a>
            
            <a href="?filter=tahun" style="padding: 8px 16px; border-radius: 4px; text-decoration: none; font-size: 11px; font-weight: bold; letter-spacing: 1px; transition: 0.3s; {{ $filter == 'tahun' ? 'background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; border: 1px solid #C9A84C;' : 'background: transparent; color: #C9A84C; border: 1px solid rgba(201,168,76,0.3);' }}">TAHUN INI</a>
            
            <a href="?filter=semua" style="padding: 8px 16px; border-radius: 4px; text-decoration: none; font-size: 11px; font-weight: bold; letter-spacing: 1px; transition: 0.3s; {{ $filter == 'semua' ? 'background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; border: 1px solid #C9A84C;' : 'background: transparent; color: #C9A84C; border: 1px solid rgba(201,168,76,0.3);' }}">SEMUA WAKTU</a>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 700px;">
            <tr style="background: rgba(201, 168, 76, 0.1); color: #C9A84C; font-size: 12px; font-family: 'Cinzel', serif; letter-spacing: 1.5px;">
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Tanggal</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Kode Pesanan</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Nama Pelanggan</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: right;">Nominal</th>
            </tr>

            @forelse($laporans as $item)
            <tr style="transition: background 0.3s;" onmouseover="this.style.background='rgba(201, 168, 76, 0.08)'" onmouseout="this.style.background='transparent'">
                <td style="padding: 16px; border-bottom: 1px solid rgba(201, 168, 76, 0.15); color: rgba(250, 243, 224, 0.8);">{{ $item->created_at->format('d M Y, H:i') }}</td>
                
                <td style="padding: 16px; border-bottom: 1px solid rgba(201, 168, 76, 0.15); color: #E8C97A; font-weight: bold; letter-spacing: 1px;">{{ $item->kode_pesanan }}</td>
                
                <td style="padding: 16px; border-bottom: 1px solid rgba(201, 168, 76, 0.15); color: #FAF3E0; text-transform: capitalize;">{{ $item->user->name ?? 'Kasir / Guest' }}</td>
                
                <td style="padding: 16px; border-bottom: 1px solid rgba(201, 168, 76, 0.15); text-align: right; color: #C9A84C; font-weight: bold; font-size: 16px; font-family: 'Playfair Display', serif;">
                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 60px 20px; text-align: center; color: rgba(250, 243, 224, 0.5); border: 1px dashed rgba(201, 168, 76, 0.3); background: transparent;">
                    <div style="font-size: 32px; margin-bottom: 15px; opacity: 0.6;">📜</div>
                    <div style="font-family: 'Cinzel', serif; letter-spacing: 1px; font-size: 13px;">Belum ada data penjualan "Selesai" untuk periode ini.</div>
                </td>
            </tr>
            @endforelse
        </table>
    </div>

</div>
@endsection