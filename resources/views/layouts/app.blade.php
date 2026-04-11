<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Salero Bundo')</title> 
</head>
<body style="font-family: sans-serif; margin: 0; padding: 0; background-color: #f8f9fa;">

    <nav style="display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        
        <a href="/" style="text-decoration: none; color: #333;">
            <h2 style="margin: 0;">Salero Bundo</h2>
        </a>
        
        <div style="display: flex; align-items: center;">
            
            <a href="/keranjang" style="margin-right: 20px; text-decoration: none; color: #333; display: flex; align-items: center;">
                🛒 Keranjang
                @if(session('keranjang') && count(session('keranjang')) > 0)
                    <span style="background-color: #e74c3c; color: white; border-radius: 50%; padding: 2px 7px; font-size: 12px; margin-left: 5px; font-weight: bold;">
                        {{ collect(session('keranjang'))->sum('qty') }}
                    </span>
                @endif
            </a>

            @guest
                <a href="/login" style="margin-left: 10px; text-decoration: none; color: #333; font-weight: bold;">Login</a> | 
                <a href="/register" style="margin-left: 10px; text-decoration: none; color: #333; font-weight: bold;">Register</a>
            @endguest

            @auth
                <div style="display: flex; align-items: center; gap: 15px; border-left: 2px solid #eee; padding-left: 15px;">
                    
                    <a href="{{ route('riwayat.index') }}" style="text-decoration: none; color: #333; font-weight: bold;">📜 Riwayat</a>
                    
                    <span style="font-weight: bold; color: orange;">Halo, {{ Auth::user()->name }}</span>
                    
                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <a href="/admin/dashboard" style="text-decoration: none; color: #007bff; font-weight: bold;">Dashboard Admin</a>
                    @elseif(Auth::check() && Auth::user()->role == 'kasir')
                        <a href="/admin/pos" style="text-decoration: none; color: #28a745; font-weight: bold;">Menu Kasir</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #e74c3c; font-weight: bold; cursor: pointer; padding: 0; font-size: 16px;">
                            Logout
                        </button>
                    </form>

                </div>
            @endauth

        </div>
    </nav>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px 30px; text-align: center; border-bottom: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px 30px; text-align: center; border-bottom: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif

    <div style="padding: 20px;">
        @yield('content')
    </div>

</body>
</html>