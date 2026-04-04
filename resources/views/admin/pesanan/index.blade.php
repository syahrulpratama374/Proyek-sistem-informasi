<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pesanan - Admin</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">

    <h2>Daftar Pesanan Masuk</h2>

    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <tr style="background: #343a40; color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">ID Order</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Nama Pelanggan</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Total Bayar</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Status Pembayaran</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Aksi / Update Status</th>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">#ORD-1002</td>
            <td style="padding: 10px; border: 1px solid #ddd;">Andi Saputra</td>
            <td style="padding: 10px; border: 1px solid #ddd;">Rp 40.000</td>
            <td style="padding: 10px; border: 1px solid #ddd; color: red;">Belum Lunas</td>
            <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                <select style="padding: 5px;">
                    <option>Menunggu Pembayaran</option>
                    <option>Sedang Diproses</option>
                    <option>Selesai</option>
                </select>
                <button style="background: green; color: white; border: none; padding: 6px 10px;">Simpan</button>
            </td>
        </tr>
    </table>

</body>
</html>