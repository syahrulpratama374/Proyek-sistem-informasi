@extends('admin.layouts.app')

@section('title', 'Laporan Penjualan')
@section('header_title', 'Laporan Pendapatan Salero Bundo')

@section('content')
<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    
    <div class="no-print" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
        
        <form action="/admin/laporan" method="GET" style="display: flex; gap: 10px; align-items: center; margin: 0;">
            <label style="font-weight: bold; color: #333;">Pilih Tanggal:</label>
            <input type="date" name="tanggal" value="{{ $tanggal }}" style="padding: 10px; border: 1px solid #ddd; border-radius: 4px; outline: none;">
            <button type="submit" style="padding: 10px 15px; background: #343a40; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                🔍 Tampilkan
            </button>
        </form>

        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 15px;">
            🖨️ Cetak Laporan (PDF)
        </button>
    </div>

    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="margin: 0; color: #333;">Laporan Penjualan Harian</h2>
        <p style="color: #666; margin-top: 5px; font-size: 16px;">Rumah Makan Padang Salero Bundo</p>
        <p style="color: #333; font-weight: bold; margin-top: 5px;">Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</p>
        <hr style="border: 1px solid #eee; margin-top: 20px;">
    </div>

    <div style="display: flex; gap: 20px; margin-bottom: 25px;">
        <div style="flex: 1; background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 5px solid #007bff;">
            <p style="margin: 0; color: #666; font-size: 14px; font-weight: bold;">TOTAL PESANAN SELESAI</p>
            <h2 style="margin: 5px 0 0 0; color: #333;">{{ $totalPesanan }} Transaksi</h2>
        </div>
        <div style="flex: 1; background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 5px solid #28a745;">
            <p style="margin: 0; color: #666; font-size: 14px; font-weight: bold;">TOTAL PENDAPATAN HARI INI</p>
            <h2 style="margin: 5px 0 0 0; color: #28a745;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
        </div>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr style="background: #343a40; color: white;">
            <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Waktu</th>
            <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Kode Pesanan</th>
            <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Pelanggan & Meja</th>
            <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Metode</th>
            <th style="padding: 12px; border: 1px solid #454d55; text-align: right;">Pendapatan</th>
        </tr>

        @forelse($laporan as $item)
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->created_at->format('H:i') }} WIB</td>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; color: #333;">{{ $item->kode_pesanan }}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">
                {{ $item->user->name ?? 'Pelanggan' }} <br>
                <small style="color: #888;">Meja {{ strtoupper($item->nomor_meja) }}</small>
            </td>
            <td style="padding: 10px; border: 1px solid #ddd; text-transform: uppercase; font-size: 13px;">{{ $item->metode_pembayaran }}</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: right; color: #28a745; font-weight: bold;">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="padding: 30px; text-align: center; color: #888; background: #f8f9fa;">
                Tidak ada pesanan yang selesai pada tanggal ini.
            </td>
        </tr>
        @endforelse
    </table>

</div>

<style>
    @media print {
        body * {
            visibility: hidden; 
        }
        main, main * {
            visibility: visible; 
        }
        main {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0 !important;
            margin: 0 !important;
        }
        aside, header, .no-print {
            display: none !important; 
        }
        /* Penyesuaian agar tampilan tabel saat dicetak lebih rapi */
        table th {
            background-color: #f8f9fa !important;
            color: #333 !important;
        }
    }
</style>
@endsection