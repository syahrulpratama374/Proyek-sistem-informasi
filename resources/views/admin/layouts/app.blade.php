<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('header_title', 'Panel Ratu Minang')</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;600&family=Cinzel:wght@400;600;700&family=Nunito+Sans:wght@300;400;600&display=swap');

        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --gold-dark: #8B6914;
            --black: #0A0805;
            --dark: #1A1208;
            --cream: #FAF3E0;
        }

        body { 
            display: flex; margin: 0; font-family: 'Nunito Sans', sans-serif; 
            background: var(--dark); color: var(--cream); min-height: 100vh;
        }

        .sidebar-link { transition: all 0.3s; }
        .sidebar-link:hover { color: var(--gold) !important; padding-left: 5px; }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold-dark), var(--gold), var(--gold-dark));
            color: var(--black); border: none; font-family: 'Cinzel', serif; font-weight: bold;
            padding: 8px 15px; cursor: pointer; transition: 0.3s;
        }
        .btn-gold:hover { box-shadow: 0 0 15px rgba(201,168,76,0.5); }
    </style>
</head>
<body>

    <aside style="width: 250px; background: var(--black); border-right: 1px solid rgba(201,168,76,0.2); padding: 20px; box-sizing: border-box; height: 100vh; position: sticky; top: 0;">
        <h2 style="text-align: center; color: var(--gold-light); font-family: 'Playfair Display', serif; border-bottom: 1px solid rgba(201,168,76,0.3); padding-bottom: 15px;">Ratu Minang</h2>
        
        <ul style="list-style: none; padding: 0; margin-top: 20px;">
            
            @if(Auth::user()->role == 'admin')
                <div style="color: var(--gold); font-family: 'Cinzel', serif; font-size: 11px; font-weight: bold; margin-bottom: 15px; letter-spacing: 2px;">MENU PEMILIK</div>
                
                <li style="margin-bottom: 15px;">
                    <a href="/admin/dashboard" class="sidebar-link" style="color: var(--cream); text-decoration: none; display: block;">📊 Dashboard</a>
                </li>
                <li style="margin-bottom: 15px;">
                    <a href="/admin/laporan" class="sidebar-link" style="color: var(--cream); text-decoration: none; display: block;">📈 Laporan Penjualan</a>
                </li>
            @endif

            @if(Auth::user()->role == 'kasir')
                <div style="color: var(--gold); font-family: 'Cinzel', serif; font-size: 11px; font-weight: bold; margin-bottom: 15px; margin-top: 10px; letter-spacing: 2px;">MENU KASIR</div>
                
                <li style="margin-bottom: 15px;">
                    <a href="/admin/pos" class="sidebar-link" style="color: var(--gold-light); text-decoration: none; display: block; font-weight: bold;">🖥️ POS Kasir (Offline)</a>
                </li>
                <li style="margin-bottom: 15px;">
                    <a href="/admin/pesanan" class="sidebar-link" style="color: var(--cream); text-decoration: none; display: block;">🛒 Kelola Pesanan</a>
                </li>
                <li style="margin-bottom: 8px;">
                    <a href="/admin/produk" class="sidebar-link" style="color: var(--cream); text-decoration: none; display: block;">🍱 Kelola Menu</a>
                </li>
                <li style="margin-bottom: 15px; padding-left: 28px;">
                    <a href="/admin/produk/tambah" class="sidebar-link" style="color: rgba(250,243,224,0.6); text-decoration: none; display: block; font-size: 13px;">➕ Tambah Menu</a>
                </li>
            @endif

            <div style="border-top: 1px solid rgba(201,168,76,0.3); margin-top: 30px; padding-top: 20px;">
                <li><a href="/" class="sidebar-link" style="color: #8B1A1A; text-decoration: none; display: block;">&larr; Lihat Website Utama</a></li>
            </div>
        </ul>
    </aside>

    <main style="flex: 1; padding: 30px; box-sizing: border-box;">
        
        <header style="background: var(--black); padding: 15px 20px; border-radius: 8px; border: 1px solid rgba(201,168,76,0.2); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: var(--gold-light); font-family: 'Playfair Display', serif;">@yield('header_title', 'Dashboard')</h3>
            
            <div style="display: flex; align-items: center; gap: 15px;">
                @auth
                    <div style="text-align: right; line-height: 1.2;">
                        <div style="font-weight: bold; color: var(--cream); font-size: 15px;">{{ auth()->user()->name }}</div>
                        <div style="font-size: 12px; font-family: 'Cinzel', serif; color: var(--gold);">
                            @if(auth()->user()->role == 'admin')
                                PEMILIK
                            @else
                                KASIR UTAMA
                            @endif
                        </div>
                    </div>
                    
                    <form action="/logout" method="POST" style="margin: 0; border-left: 1px solid rgba(201,168,76,0.3); padding-left: 15px; display: flex; align-items: center;">
                        @csrf
                        <button type="submit" class="btn-gold" style="border-radius: 4px;">
                            LOGOUT
                        </button>
                    </form>
                @endauth
            </div>
        </header>

        @if(session('success'))
            <div style="background-color: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                ✦ {{ session('success') }}
            </div>
        @endif

        @yield('content')
        
    </main>

</body>
</html>