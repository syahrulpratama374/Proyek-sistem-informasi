<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Ratu Minang</title>
    <style>
        body { font-family: sans-serif; padding: 40px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f4f4f4; }
        .total { text-align: right; font-size: 18px; font-weight: bold; margin-top: 20px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h1>RATU MINANG</h1>
        <p>Laporan Penjualan Periode: <strong>{{ $tgl_mulai }}</strong> s/d <strong>{{ $tgl_selesai }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Metode</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $row->kode_pesanan }}</td>
                <td>{{ $row->user->name ?? 'Guest/Kasir' }}</td>
                <td>{{ strtoupper($row->metode_pembayaran) }}</td>
                <td>Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        TOTAL PENDAPATAN: Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
    </div>

    <div style="margin-top: 50px; text-align: right;">
        Kediri, {{ date('d F Y') }}<br><br><br><br>
        ( Admin Ratu Minang )
    </div>
</body>
</html>