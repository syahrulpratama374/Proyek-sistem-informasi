<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Salero Bundo')</title>
</head>
<body style="display: flex; margin: 0; font-family: sans-serif; background: #f4f6f9; min-height: 100vh;">

    <aside style="width: 250px; background: #343a40; color: white; padding: 20px; box-sizing: border-box; height: 100vh; position: sticky; top: 0;">
        <h2 style="text-align: center; color: orange; border-bottom: 1px solid #4f5962; padding-bottom: 15px;">Admin Panel</h2>
        <ul style="list-style: none; padding: 0; margin-top: 20px;">
            <li style="margin-bottom: 15px;"><a href="/admin/dashboard" style="color: #c2c7d0; text-decoration: none; display: block;">📊 Dashboard</a></li>
            
            <li style="margin-bottom: 15px;"><a href="/admin/pos" style="color: #c2c7d0; text-decoration: none; display: block; font-weight: bold;">💻 POS Kasir</a></li>
            
            <li style="margin-bottom: 15px;"><a href="/admin/pesanan" style="color: #c2c7d0; text-decoration: none; display: block;">🛒 Kelola Pesanan</a></li>
            
            @if(auth()->user()->role == 'admin')
                <li style="margin-bottom: 15px;"><a href="/admin/produk" style="color: #c2c7d0; text-decoration: none; display: block;">🍱 Manajemen Produk</a></li>
                <li style="margin-bottom: 15px;"><a href="/admin/laporan" style="color: #c2c7d0; text-decoration: none; display: block;">📄 Laporan</a></li>
            @endif
            
            <li style="margin-top: 40px;"><a href="/" style="color: #ff6b6b; text-decoration: none; display: block;">&larr; Kembali ke Web</a></li>
        </ul>
    </aside>

    <main style="flex: 1; padding: 30px; box-sizing: border-box; overflow-y: auto;">
        
        <header style="background: white; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: #333;">@yield('header_title', 'Dashboard')</h3>
            
            <div style="display: flex; align-items: center; gap: 15px;">
                @auth
                    <span style="font-weight: bold; color: orange;">Halo, {{ auth()->user()->name }}</span>
                    
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0; border-left: 2px solid #eee; padding-left: 15px;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: red; font-size: 14px; cursor: pointer; padding: 0; font-weight: bold;">
                            Logout
                        </button>
                    </form>
                @else
                    <span>Halo, Admin!</span>
                @endauth
            </div>
        </header>

        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px 20px; border-radius: 4px; margin-bottom: 20px; border-left: 4px solid #28a745;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px 20px; border-radius: 4px; margin-bottom: 20px; border-left: 4px solid #dc3545;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
        
    </main>

</body>
</html>