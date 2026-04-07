@extends('admin.layouts.app')

@section('title', 'Detail Pesanan - Admin')
@section('header_title', 'Detail Pesanan: ' . $pesanan->kode_pesanan)

@section('content')
<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 900px; margin: auto;">
    
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 20px; flex-wrap: wrap; gap: 20px;">
        
        <div style="flex: 1; min-width: 250px;">
            <h3 style="margin-top: 0; color: #333;">Data Pelanggan</h3>
            <p style="margin: 8px 0; color: #555;"><strong>Nama:</strong> {{ $pesanan->user->name ?? 'Pelanggan' }}</p>
            <p style="margin: 8px 0; color: #555;">
                <strong>Nomor Meja:</strong> 
                <span style="background: #e74c3c; color: white; padding: 2px 8px; border-radius: 3px; font-weight: bold;">
                    {{ strtoupper($pesanan->nomor_meja) }}
                </span>
            </p>
            <p style="margin: 8px 0; color: #555;"><strong>Tanggal Pesan:</strong> {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
            
            <div style="margin-top: 15px; padding: 12px; background: #fff3cd; border: 1px solid #ffeeba; border-radius: 4px; color: #856404;">
                <strong style="display: block; margin-bottom: 5px;">📝 Catatan Dapur:</strong>
                {{ $pesanan->catatan ?? 'Tidak ada catatan khusus.' }}
            </div>
        </div>
        
        <div style="flex: 1; min-width: 250px; text-align: right;">
            <h3 style="margin-top: 0; color: #333;">Status Transaksi</h3>
            <p style="margin: 8px 0; color: #555;">
                <strong>Metode Pembayaran:</strong> <br>
                <span style="font-size: 18px; font-weight: bold; text-transform: uppercase;">{{ $pesanan->metode_pembayaran }}</span>
            </p>
            
            <div style="margin-top: 15px;">
                <strong>Status Saat Ini:</strong><br>
                @php
                    $warnaBadge = match($pesanan->status) {
                        'pending'  => '#f39c12',
                        'diproses' => '#3498db',
                        'selesai'  => '#2ecc71',
                        'batal'    => '#e74c3c',
                        default    => '#95a5a6'
                    };
                @endphp
                <span style="display: inline-block; margin-top: 5px; padding: 8px 15px; background: {{ $warnaBadge }}; color: white; border-radius: 4px; font-weight: bold; text-transform: uppercase; font-size: 14px;">
                    {{ $pesanan->status }}
                </span>
            </div>
        </div>
    </div>

    <h3 style="margin-top: 0; color: #333;">Rincian Menu yang Dipesan</h3>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr style="background: #343a40; color: white;">
                <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Nama Menu</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: center;">Harga Satuan</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: center;">Qty</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: right;">Subtotal</th>
            </tr>
            
            @foreach($pesanan->detailPesanans as $detail)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 12px; border: 1px solid #ddd; font-weight: bold; color: #333;">
                    {{ $detail->menu->nama_menu ?? 'Menu Dihapus' }}
                </td>
                <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                <td style="padding: 12px; border: 1px solid #ddd; text-align: center; font-weight: bold;">{{ $detail->qty }}</td>
                <td style="padding: 12px; border: 1px solid #ddd; text-align: right; font-weight: bold;">Rp {{ number_format($detail->harga_satuan * $detail->qty, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div style="text-align: right; border-top: 2px solid #333; padding-top: 15px;">
        <h2 style="margin: 0; color: #333;">Total Bayar: <span style="color: #27ae60;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></h2>
    </div>

    <div style="margin-top: 40px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
        <a href="/admin/pesanan" style="padding: 12px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
            &larr; Kembali ke Daftar
        </a>
        
        <button onclick="window.print()" style="padding: 12px 20px; background: #17a2b8; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
            🖨️ Cetak Struk
        </button>
    </div>

</div>
@endsection