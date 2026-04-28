@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan - Admin Ratu Minang')
@section('header_title', 'Daftar Pesanan Masuk')

@section('content')
<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h4 style="margin: 0; color: #333;">Data Transaksi Berjalan</h4>
        <span style="background: #e9ecef; padding: 5px 15px; border-radius: 20px; font-size: 13px; font-weight: bold;">
            Total: {{ count($pesanans) }} Pesanan
        </span>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 900px;">
            <tr style="background: #343a40; color: white; font-size: 14px;">
                <th style="padding: 15px; border: 1px solid #454d55; text-align: left;">Kode Pesanan</th>
                <th style="padding: 15px; border: 1px solid #454d55; text-align: left;">Pelanggan & Meja</th>
                <th style="padding: 15px; border: 1px solid #454d55; text-align: left;">Pembayaran</th>
                <th style="padding: 15px; border: 1px solid #454d55; text-align: left;">Total Bayar</th>
                <th style="padding: 15px; border: 1px solid #454d55; text-align: center;">Status Saat Ini</th>
                <th style="padding: 15px; border: 1px solid #454d55; text-align: center;">Aksi Kasir</th>
            </tr>
            
            @forelse($pesanans as $item)
            <tr style="border-bottom: 1px solid #eee; background: {{ $loop->iteration % 2 == 0 ? '#f8f9fa' : 'white' }};">
                
                <td style="padding: 15px; font-weight: bold; color: #333;">
                    {{ $item->kode_pesanan }}
                    <div style="font-size: 11px; color: #888; margin-top: 4px; font-weight: normal;">
                        {{ $item->created_at->format('d M Y, H:i') }}
                    </div>
                </td>
                
                <td style="padding: 15px;">
                    <strong>{{ $item->user->name ?? 'Pelanggan' }}</strong> <br>
                    <span style="display: inline-block; margin-top: 5px; background: #e74c3c; color: white; padding: 2px 8px; border-radius: 3px; font-size: 11px; font-weight: bold;">
                        MEJA {{ strtoupper($item->nomor_meja) }}
                    </span>
                </td>
                
                <td style="padding: 15px; text-transform: uppercase; font-size: 13px; font-weight: bold; color: #555;">
                    {{ $item->metode_pembayaran }}
                </td>
                
                <td style="padding: 15px; font-weight: bold; color: #27ae60; font-size: 15px;">
                    {{ $item->total_rupiah }} </td>
                
                <td style="padding: 15px; text-align: center;">
                    @php
                        $warnaBadge = match($item->status) {
                            'pending'  => '#f39c12', // Orange
                            'diproses' => '#3498db', // Biru
                            'selesai'  => '#2ecc71', // Hijau
                            'batal'    => '#e74c3c', // Merah
                            default    => '#95a5a6'
                        };
                    @endphp
                    <span style="background: {{ $warnaBadge }}; color: white; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                        {{ $item->status }}
                    </span>
                </td>
                
                <td style="padding: 15px;">
                    <form action="/admin/pesanan/{{ $item->id }}/status" method="POST" style="display: flex; gap: 5px; justify-content: center; align-items: center; margin: 0;">
                        @csrf
                        
                        <select name="status" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; outline: none;">
                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="batal" {{ $item->status == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                        
                        <button type="submit" style="background: #343a40; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-weight: bold;" title="Update Status">
                            ✓
                        </button>
                        
                        <a href="/admin/pesanan/{{ $item->id }}" style="background: #17a2b8; color: white; text-decoration: none; padding: 8px 12px; border-radius: 4px; font-size: 14px; font-weight: bold; text-align: center;" title="Lihat Detail">
                            Detail
                        </a>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 40px; text-align: center; color: #888; background: #f8f9fa;">
                    <div style="font-size: 30px; margin-bottom: 10px;">🍽️</div>
                    Belum ada pesanan masuk hari ini.
                </td>
            </tr>
            @endforelse
        </table>
    </div>

</div>
@endsection