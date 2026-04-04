<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Salero Bundo')</title>
</head>
<body style="display: flex; margin: 0; font-family: sans-serif; background: #f4f6f9; min-height: 100vh;">

    <aside style="width: 250px; background: #343a40; color: white; padding: 20px; box-sizing: border-box;">
        <h2 style="text-align: center; color: orange; border-bottom: 1px solid #4f5962; padding-bottom: 15px;">Admin Panel</h2>
        <ul style="list-style: none; padding: 0; margin-top: 20px;">
            <li style="margin-bottom: 15px;"><a href="/admin/dashboard" style="color: #c2c7d0; text-decoration: none; display: block;">📊 Dashboard</a></li>
            <li style="margin-bottom: 15px;"><a href="/admin/pesanan" style="color: #c2c7d0; text-decoration: none; display: block;">🛒 Kelola Pesanan</a></li>
            <li style="margin-bottom: 15px;"><a href="/admin/produk" style="color: #c2c7d0; text-decoration: none; display: block;">🍱 Manajemen Produk</a></li>
            <li style="margin-bottom: 15px;"><a href="/admin/laporan" style="color: #c2c7d0; text-decoration: none; display: block;">📈 Laporan</a></li>
            <li style="margin-top: 40px;"><a href="/" style="color: #ff6b6b; text-decoration: none; display: block;">&larr; Kembali ke Web</a></li>
        </ul>
    </aside>

    <main style="flex: 1; padding: 30px; box-sizing: border-box;">
        <header style="background: white; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between;">
            <h3 style="margin: 0; color: #333;">@yield('header_title', 'Dashboard')</h3>
            <div>Halo, Admin!</div>
        </header>

        @yield('content')
    </main>

</body>
</html>