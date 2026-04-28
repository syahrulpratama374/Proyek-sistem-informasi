<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Ratu Minang')</title>
    
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            main { padding: 0 !important; margin: 0 !important; }
        }
    </style>
</head>
<body style="display: flex; margin: 0; font-family: sans-serif; background: #f4f6f9; min-height: 100vh;">

    <aside class="no-print" style="width: 250px; background: #343a40; color: white; padding: 20px; box-sizing: border-box; height: 100vh; position: sticky; top: 0;">
        <h2 style="text-align: center; color: orange; border-bottom: 1px solid #4f5962; padding-bottom: 15px;">Ratu Minang</h2>
        
        <ul style="list-style: none; padding: 0; margin-top: 20px;">
            
            @if(Auth::user()->role == 'admin')
                <div style="color: #8aa4af; font-size: 12px; font-weight: bold; margin-bottom: 10px; letter-spacing: 1px;">MENU PEMILIK</div>
                
                <li style="margin-bottom: 15px;">
                    <a href="/admin/dashboard" style="color: #c2c7d0; text-decoration: none; display: block;">📊 Dashboard</a>
                </li>
                <li style="margin-bottom: 15px;">
                    <a href="/admin/laporan" style="color: #c2c7d0; text-decoration: none; display: block;">📈 Laporan Penjualan</a>
                </li>
            @endif

            @if(Auth::user()->role == 'kasir')
                <div style="color: #8aa4af; font-size: 12px; font-weight: bold; margin-bottom: 10px; margin-top: 10px; letter-spacing: 1px;">MENU KASIR</div>
                
                <li style="margin-bottom: 15px;">
                    <a href="/admin/pos" class="sidebar-link" style="color: white; text-decoration: none; display: block; font-weight: bold;">🖥️ POS Kasir (Offline)</a>
                </li>
                <li style="margin-bottom: 15px;">
                    <a href="/admin/pesanan" class="sidebar-link" style="color: #c2c7d0; text-decoration: none; display: block;">🛒 Kelola Pesanan</a>
                </li>
                
                <li style="margin-bottom: 8px;">
                    <a href="/admin/produk" class="sidebar-link" style="color: #c2c7d0; text-decoration: none; display: block;">🍱 Kelola Menu</a>
                </li>
                <li style="margin-bottom: 15px; padding-left: 28px;">
                    <a href="/admin/produk/tambah" class="sidebar-link" style="color: #a0a5b1; text-decoration: none; display: block; font-size: 13px;">➕ Tambah Menu Baru</a>
                </li>
            @endif

            <div style="border-top: 1px solid #4f5962; margin-top: 30px; padding-top: 20px;">
                <li><a href="/" style="color: #ff6b6b; text-decoration: none; display: block;">&larr; Lihat Website Utama</a></li>
            </div>
        </ul>
    </aside>

    <main style="flex: 1; padding: 30px; box-sizing: border-box;">
        
        <header class="no-print" style="background: white; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: #333;">@yield('header_title', 'Dashboard')</h3>
            
            <div style="display: flex; align-items: center; gap: 15px;">
                @auth
                    <div style="text-align: right; line-height: 1.2;">
                        <div style="font-weight: bold; color: #333; font-size: 15px;">{{ auth()->user()->name }}</div>
                        <div style="font-size: 12px;">
                            @if(auth()->user()->role == 'admin')
                                <span style="background: #007bff; color: white; padding: 2px 6px; border-radius: 10px;">👑 Admin</span>
                            @else
                                <span style="background: #28a745; color: white; padding: 2px 6px; border-radius: 10px;">👨‍🍳 Kasir</span>
                            @endif
                        </div>
                    </div>
                    
                    <form action="/logout" method="POST" style="margin: 0; border-left: 2px solid #eee; padding-left: 15px; height: 100%; display: flex; align-items: center;">
                        @csrf
                        <button type="submit" style="background: #ffeeba; border: 1px solid #ffdf7e; color: #856404; font-size: 13px; cursor: pointer; padding: 5px 12px; font-weight: bold; border-radius: 4px; transition: 0.2s;">
                            Logout
                        </button>
                    </form>
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