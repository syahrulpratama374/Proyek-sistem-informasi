<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Salero Bundo')</title> 
</head>
<body style="font-family: sans-serif; margin: 0; padding: 0; background-color: #f8f9fa;">

    <nav style="display: flex; justify-content: space-between; padding: 15px 30px; background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <a href="/" style="text-decoration: none; color: #333;">
            <h2 style="margin: 0;">Salero Bundo</h2>
        </a>
        <div style="margin-top: 5px;">
            <a href="/keranjang" style="margin-right: 15px; text-decoration: none; color: #333;">🛒 Keranjang</a>
            <a href="/login" style="margin-right: 10px; text-decoration: none; color: #333;">Login</a> | 
            <a href="/register" style="margin-left: 10px; text-decoration: none; color: #333;">Register</a>
        </div>
    </nav>

    <main style="min-height: 80vh;">
        @yield('content')
    </main>

    <footer style="text-align: center; padding: 20px; background-color: #343a40; color: white; margin-top: 40px;">
        <p>&copy; 2026 Rumah Makan Padang Salero Bundo. All rights reserved.</p>
    </footer>

</body>
</html>