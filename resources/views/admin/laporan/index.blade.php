@extends('admin.layouts.app')

@section('title', 'Laporan Penjualan - Ratu Minang')
@section('header_title', 'Laporan Pendapatan')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

<style>
    /* Menimpa sedikit warna Flatpickr agar senada dengan Emas Ratu Minang */
    .flatpickr-calendar.dark {
        background: #1A1208;
        border: 1px solid rgba(201, 168, 76, 0.3);
        box-shadow: 0 10px 25px rgba(0,0,0,0.8);
    }
    .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay {
        background: #C9A84C;
        border-color: #C9A84C;
        color: #0A0805;
        font-weight: bold;
    }
    
    .rm-date-input {
        padding: 12px 15px; 
        background: #1A1208 url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%23C9A84C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>') no-repeat right 15px center;
        border: 1px solid rgba(201, 168, 76, 0.4); 
        color: #FAF3E0; 
        border-radius: 6px;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 14px;
        width: 220px;
        cursor: pointer;
        transition: 0.3s;
    }
    .rm-date-input:focus { outline: none; border-color: #C9A84C; background-color: rgba(201, 168, 76, 0.05); }
    
    .rm-btn-filter {
        padding: 12px 25px; background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; 
        border: none; border-radius: 6px; font-weight: bold; font-family: 'Cinzel', serif; letter-spacing: 1px; 
        cursor: pointer; transition: 0.3s; box-shadow: 0 4px 15px rgba(201, 168, 76, 0.2);
    }
    .rm-btn-filter:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(201, 168, 76, 0.4); }

    .rm-btn-print {
        padding: 12px 25px; background: transparent; color: #2ecc71; border: 1px solid #2ecc71; 
        text-decoration: none; border-radius: 6px; font-weight: bold; font-family: 'Cinzel', serif; letter-spacing: 1px; 
        transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;
    }
    .rm-btn-print:hover { background: rgba(46, 204, 113, 0.1); box-shadow: 0 4px 15px rgba(46, 204, 113, 0.2); }
</style>

<div style="background: #0A0805; padding: 30px; border-radius: 8px; border: 1px solid rgba(201, 168, 76, 0.2); box-shadow: 0 5px 20px rgba(0,0,0,0.5);">
    
    <div style="background: rgba(255,255,255,0.02); padding: 20px; border-radius: 8px; border: 1px dashed rgba(201, 168, 76, 0.3); margin-bottom: 30px;">
        <form action="/admin/laporan" method="GET" style="display: flex; gap: 20px; align-items: flex-end; flex-wrap: wrap;">
            <div>
                <label style="display:block; color:#E8C97A; font-size:11px; font-family: 'Cinzel', serif; letter-spacing: 1px; font-weight: bold; margin-bottom:8px;">DARI TANGGAL</label>
                <input type="text" name="tgl_mulai" value="{{ $tgl_mulai }}" class="rm-date-input" placeholder="Pilih Tanggal Mulai">
            </div>
            <div>
                <label style="display:block; color:#E8C97A; font-size:11px; font-family: 'Cinzel', serif; letter-spacing: 1px; font-weight: bold; margin-bottom:8px;">SAMPAI TANGGAL</label>
                <input type="text" name="tgl_selesai" value="{{ $tgl_selesai }}" class="rm-date-input" placeholder="Pilih Tanggal Selesai">
            </div>
            <button type="submit" class="rm-btn-filter">🔍 TAMPILKAN</button>
            
            <div style="flex-grow: 1; text-align: right;">
                <a href="/admin/laporan/cetak?tgl_mulai={{ $tgl_mulai }}&tgl_selesai={{ $tgl_selesai }}" target="_blank" class="rm-btn-print">📄 CETAK PDF</a>
            </div>
        </form>
    </div>

    <div style="background: linear-gradient(135deg, #1A1208, #0A0805); padding: 25px; border-radius: 8px; border-left: 4px solid #C9A84C; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
        <span style="color: rgba(250,243,224,0.6); font-size: 14px; font-family: 'Nunito Sans', sans-serif;">Total Omzet pada Periode Terpilih</span>
        <h2 style="color: #E8C97A; margin: 8px 0 0 0; font-size: 38px; font-family: 'Playfair Display', serif;">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h2>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; color: #FAF3E0; font-size: 14px; min-width: 700px;">
            <tr style="border-bottom: 2px solid #C9A84C; text-align: left; background: rgba(201, 168, 76, 0.05);">
                <th style="padding: 15px; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px;">Tanggal</th>
                <th style="padding: 15px; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px;">Kode Pesanan</th>
                <th style="padding: 15px; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px;">Pelanggan</th>
                <th style="padding: 15px; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px; text-align: right;">Total Harga</th>
            </tr>
            @forelse($laporan as $row)
            <tr style="border-bottom: 1px solid rgba(201, 168, 76, 0.1); transition: 0.2s;" onmouseover="this.style.background='rgba(201,168,76,0.05)'" onmouseout="this.style.background='transparent'">
                <td style="padding: 15px;">{{ $row->created_at->format('d M Y') }}</td>
                <td style="padding: 15px; color: #C9A84C; font-weight: bold; font-family: 'Cinzel', serif;">{{ $row->kode_pesanan }}</td>
                <td style="padding: 15px;">{{ $row->user->name ?? 'Guest/Kasir' }}</td>
                <td style="padding: 15px; text-align: right; font-weight: bold; font-size: 15px;">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 60px; text-align: center;">
                    <div style="font-size: 40px; opacity: 0.5; margin-bottom: 15px;">📄</div>
                    <div style="color: rgba(250,243,224,0.5); font-family: 'Cormorant Garamond', serif; font-size: 18px;">Tidak ada transaksi pada periode tanggal ini.</div>
                </td>
            </tr>
            @endforelse
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(".rm-date-input", {
            dateFormat: "Y-m-d",        // Format data yang dikirim ke backend (wajib Y-m-d)
            altInput: true,             // Aktifkan tampilan teks alternatif
            altFormat: "d F Y",         // Format yang dilihat User (contoh: 05 Mei 2026)
            locale: "id",               // Bahasa Indonesia
            disableMobile: "true"       // Memaksa HP pakai kalender estetik ini, bukan bawaan HP
        });
    });
</script>
@endsection