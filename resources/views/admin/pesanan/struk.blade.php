<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $pesanan->kode_pesanan }}</title>
    <style>
        /* Desain Khusus Kertas Thermal Kasir (58mm) */
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .ticket {
            width: 58mm; /* Lebar standar kertas kasir */
            max-width: 58mm;
            margin: 0 auto; /* Supaya di layar komputer posisinya di tengah */
            padding: 10px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .bold { font-weight: bold; }
        
        .border-top { border-top: 1px dashed #000; padding-top: 5px; margin-top: 5px; }
        .border-bottom { border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px; }
        
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; }
        
        /* Menyembunyikan elemen URL dan tanggal otomatis dari browser saat diprint */
        @media print {
            @page { margin: 0; }
            body { margin: 0.5cm; }
        }
    </style>
</head>

<!-- SIHIR JS: Otomatis memunculkan dialog print, lalu menutup tab setelah selesai -->
<body onload="window.print(); setTimeout(window.close, 500);">

    <div class="ticket">
        <!-- HEADER TOKO -->
        <div class="text-center">
            <h2 style="margin: 0; font-size: 16px;">RATU MINANG</h2>
            <p style="margin: 2px 0;">Cita Rasa Padang Asli</p>
            <p style="margin: 2px 0;">Telp: 0812-3456-7890</p>
        </div>

        <!-- INFO TRANSAKSI -->
        <div class="border-top border-bottom">
            <table style="font-size: 10px;">
                <tr>
                    <td>Tgl</td>
                    <td>: {{ $pesanan->created_at->format('d/m/y H:i') }}</td>
                </tr>
                <tr>
                    <td>No</td>
                    <td>: {{ $pesanan->kode_pesanan }}</td>
                </tr>
                <tr>
                    <td>Tujuan</td>
                    <td>: {{ strtoupper(substr($pesanan->nomor_meja, 0, 15)) }}</td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td>: {{ auth()->user()->name ?? 'Kasir Utama' }}</td>
                </tr>
            </table>
        </div>

        <!-- DAFTAR ITEM BELANJA -->
        <table style="font-size: 10px; margin-bottom: 5px;">
            @foreach($pesanan->detailPesanans as $detail)
            <tr>
                <!-- Baris Pertama: Nama Menu -->
                <td colspan="3" class="text-left bold">{{ $detail->menu->nama_menu ?? 'Menu Dihapus' }}</td>
            </tr>
            <tr>
                <!-- Baris Kedua: Harga Satuan x Qty = Subtotal -->
                <td class="text-left" style="padding-left: 5px;">{{ $detail->qty }}x</td>
                <td class="text-left">{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($detail->harga_satuan * $detail->qty, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <!-- TOTAL & PEMBAYARAN -->
        <div class="border-top" style="margin-bottom: 10px;">
            <table style="font-size: 12px;">
                <tr>
                    <td class="bold text-left">TOTAL</td>
                    <td class="bold text-right">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="text-left" style="font-size: 10px;">Bayar Via</td>
                    <td class="text-right" style="font-size: 10px;">{{ strtoupper($pesanan->metode_pembayaran) }}</td>
                </tr>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="text-center border-top" style="font-size: 10px; margin-top: 10px;">
            <p style="margin: 2px 0;">Terima Kasih Atas Kunjungan Anda</p>
            <p style="margin: 2px 0;">---</p>
        </div>
    </div>

</body>
</html>