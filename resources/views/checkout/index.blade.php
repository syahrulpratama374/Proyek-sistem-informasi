<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Out Pesanan</title>
</head>
<body style="font-family: sans-serif; padding: 20px; background: #f8f9fa;">

    <h2>Penyelesaian Pesanan (Cek Out)</h2>

    <div style="display: flex; gap: 20px;">
        <div style="flex: 2; background: white; padding: 20px; border: 1px solid #ddd;">
            <h3>Data Pengiriman / Pengambilan</h3>
            <form action="/checkout/proses" method="POST">
                <div style="margin-bottom: 10px;">
                    <label>Nama Penerima</label><br>
                    <input type="text" style="width: 100%; padding: 8px;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Alamat Lengkap (Kosongkan jika makan di tempat/ambil sendiri)</label><br>
                    <textarea style="width: 100%; padding: 8px;" rows="3"></textarea>
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Metode Pembayaran</label><br>
                    <select style="width: 100%; padding: 8px;">
                        <option>Transfer Bank</option>
                        <option>E-Wallet (GoPay/OVO)</option>
                        <option>Bayar di Kasir (Cash)</option>
                    </select>
                </div>
                <button style="padding: 10px 20px; background: green; color: white; border: none; width: 100%; font-size: 16px;">Buat Pesanan</button>
            </form>
        </div>

        <div style="flex: 1; background: white; padding: 20px; border: 1px solid #ddd;">
            <h3>Ringkasan</h3>
            <p>Rendang Daging (2x) : Rp 40.000</p>
            <hr>
            <h3>Total: Rp 40.000</h3>
        </div>
    </div>

</body>
</html>