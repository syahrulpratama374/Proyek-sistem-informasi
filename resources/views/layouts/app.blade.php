<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ratu Minang')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=Cinzel:wght@400;600;700&family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E8C97A;
            --gold-dark: #8B6914;
            --gold-pale: #F5E6B8;
            --crimson: #8B1A1A;
            --crimson-deep: #5C0A0A;
            --black: #0A0805;
            --dark: #1A1208;
            --cream: #FAF3E0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Nunito Sans', sans-serif;
            background: var(--dark);
            color: var(--cream);
            overflow-x: hidden;
        }

        /* ══════════════════════════════════
           LOADING SCREEN
        ══════════════════════════════════ */
        #rm-loader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: var(--black);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 28px;
            transition: opacity 0.7s ease, visibility 0.7s ease;
        }

        #rm-loader.hide {
            opacity: 0;
            visibility: hidden;
        }

        /* Ornamen sudut */
        .rm-corner {
            position: absolute;
            width: 60px;
            height: 60px;
            border-color: var(--gold);
            border-style: solid;
            opacity: 0.35;
        }
        .rm-corner.tl { top: 24px; left: 24px; border-width: 1px 0 0 1px; }
        .rm-corner.tr { top: 24px; right: 24px; border-width: 1px 1px 0 0; }
        .rm-corner.bl { bottom: 24px; left: 24px; border-width: 0 0 1px 1px; }
        .rm-corner.br { bottom: 24px; right: 24px; border-width: 0 1px 1px 0; }

        /* Background glow */
        .rm-loader-glow {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(ellipse, rgba(139,26,26,0.3) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Logo mahkota */
        .rm-loader-crown {
            animation: rmCrownPulse 2s ease-in-out infinite;
            filter: drop-shadow(0 0 20px rgba(201,168,76,0.6));
        }

        @keyframes rmCrownPulse {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 0 20px rgba(201,168,76,0.6)); }
            50% { transform: scale(1.07); filter: drop-shadow(0 0 36px rgba(201,168,76,0.9)); }
        }

        /* Teks brand */
        .rm-loader-eyebrow {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 7px;
            color: var(--gold);
            opacity: 0.7;
            text-transform: uppercase;
            animation: rmFadeIn 1s ease 0.3s both;
        }

        .rm-loader-brand {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 900;
            background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 40%, var(--gold-dark) 70%, var(--gold-light) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 6px;
            animation: rmFadeIn 1s ease 0.5s both;
            line-height: 1;
        }

        /* Divider hias */
        .rm-loader-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            animation: rmFadeIn 0.8s ease 0.7s both;
        }
        .rm-loader-divider-line {
            width: 60px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold));
        }
        .rm-loader-divider-line.rev {
            background: linear-gradient(90deg, var(--gold), transparent);
        }
        .rm-loader-divider-dot {
            width: 4px;
            height: 4px;
            background: var(--gold);
            transform: rotate(45deg);
        }

        /* Progress bar */
        .rm-loader-bar-wrap {
            width: 200px;
            height: 1px;
            background: rgba(201,168,76,0.15);
            position: relative;
            overflow: hidden;
            animation: rmFadeIn 0.6s ease 0.9s both;
        }
        .rm-loader-bar {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            background: linear-gradient(90deg, var(--gold-dark), var(--gold-light));
            animation: rmProgress 1.8s ease 0.2s forwards;
            width: 0%;
        }

        @keyframes rmProgress {
            0% { width: 0%; }
            30% { width: 35%; }
            60% { width: 65%; }
            85% { width: 88%; }
            100% { width: 100%; }
        }

        /* Teks loading */
        .rm-loader-text {
            font-family: 'Cinzel', serif;
            font-size: 9px;
            letter-spacing: 4px;
            color: rgba(201,168,76,0.5);
            text-transform: uppercase;
            animation: rmFadeIn 0.6s ease 1s both, rmBlink 1.4s ease 1s infinite;
        }

        @keyframes rmBlink {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.9; }
        }

        @keyframes rmFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Partikel */
        .rm-ldr-particle {
            position: absolute;
            border-radius: 50%;
            background: var(--gold);
            opacity: 0;
            animation: rmPFloat var(--d) ease-in-out var(--dl) infinite;
        }
        @keyframes rmPFloat {
            0% { opacity:0; transform: translateY(0) scale(0); }
            20% { opacity:0.5; }
            80% { opacity:0.2; }
            100% { opacity:0; transform: translateY(-100px) scale(0.4); }
        }

        /* ══════════════════════════════════
           NAVBAR
        ══════════════════════════════════ */
        .rm-nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            height: 64px;
            background: rgba(10,8,5,0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(201,168,76,0.18);
            box-shadow: 0 4px 24px rgba(0,0,0,0.5);
        }

        /* Brand kiri */
        .rm-nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }
        .rm-nav-brand-icon {
            width: 28px;
            filter: drop-shadow(0 0 8px rgba(201,168,76,0.5));
        }
        .rm-nav-brand-name {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            letter-spacing: 3px;
            color: var(--gold);
            font-weight: 600;
        }

        /* Links kanan */
        .rm-nav-right {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .rm-nav-link {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(250,243,224,0.65);
            text-decoration: none;
            padding: 6px 12px;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }
        .rm-nav-link:hover {
            color: var(--gold);
            text-decoration: none;
        }

        /* Keranjang badge */
        .rm-cart-badge {
            background: var(--crimson);
            color: #fff;
            border-radius: 50%;
            padding: 1px 5px;
            font-size: 10px;
            font-family: 'Nunito Sans', sans-serif;
            font-weight: 700;
            line-height: 1.4;
            border: 1px solid rgba(201,168,76,0.3);
        }

        /* Separator */
        .rm-nav-sep {
            width: 1px;
            height: 22px;
            background: rgba(201,168,76,0.2);
            margin: 0 4px;
        }

        /* Nama user */
        .rm-nav-user {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 1px;
            color: var(--gold);
            padding: 6px 10px;
            white-space: nowrap;
        }

        /* Tombol Daftar (CTA) */
        .rm-nav-cta {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--black);
            background: linear-gradient(135deg, var(--gold-dark), var(--gold));
            padding: 8px 18px;
            text-decoration: none;
            font-weight: 700;
            transition: box-shadow 0.3s;
            white-space: nowrap;
        }
        .rm-nav-cta:hover {
            box-shadow: 0 4px 18px rgba(201,168,76,0.4);
            color: var(--black);
            text-decoration: none;
        }

        /* Tombol Masuk (outline) */
        .rm-nav-login {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--gold);
            border: 1px solid rgba(201,168,76,0.4);
            padding: 7px 16px;
            text-decoration: none;
            transition: all 0.3s;
            white-space: nowrap;
        }
        .rm-nav-login:hover {
            border-color: var(--gold);
            background: rgba(201,168,76,0.08);
            color: var(--gold);
            text-decoration: none;
        }

        /* Tombol Logout */
        .rm-nav-logout {
            font-family: 'Cinzel', serif;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(250,243,224,0.5);
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px 10px;
            transition: color 0.3s;
        }
        .rm-nav-logout:hover {
            color: #e74c3c;
        }

        /* Tombol admin/kasir */
        .rm-nav-admin {
            font-family: 'Cinzel', serif;
            font-size: 9px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--gold-light);
            border: 1px solid rgba(201,168,76,0.3);
            padding: 5px 12px;
            text-decoration: none;
            transition: all 0.3s;
            white-space: nowrap;
        }
        .rm-nav-admin:hover {
            background: rgba(201,168,76,0.12);
            color: var(--gold);
            text-decoration: none;
        }

        /* ══════════════════════════════════
           FLASH MESSAGES
        ══════════════════════════════════ */
        .rm-flash {
            padding: 12px 40px;
            text-align: center;
            font-family: 'Cinzel', serif;
            font-size: 11px;
            letter-spacing: 1.5px;
        }
        .rm-flash.success {
            background: linear-gradient(90deg, rgba(39,174,96,0.12), rgba(39,174,96,0.08));
            color: #2ecc71;
            border-bottom: 1px solid rgba(39,174,96,0.25);
        }
        .rm-flash.error {
            background: linear-gradient(90deg, rgba(231,76,60,0.12), rgba(231,76,60,0.08));
            color: #e74c3c;
            border-bottom: 1px solid rgba(231,76,60,0.25);
        }

        /* ══════════════════════════════════
           CONTENT WRAPPER
        ══════════════════════════════════ */
        .rm-content {
            min-height: calc(100vh - 64px);
        }

        /* ══════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════ */
        @media (max-width: 768px) {
            .rm-nav {
                padding: 0 18px;
            }
            .rm-nav-brand-name {
                font-size: 12px;
                letter-spacing: 2px;
            }
            .rm-nav-link span.rm-nav-label {
                display: none;
            }
            .rm-nav-user {
                display: none;
            }
        }
    </style>
</head>
<body>

    {{-- ════════════════════════════════════
         LOADING SCREEN
    ════════════════════════════════════ --}}
    <div id="rm-loader">

        {{-- Ornamen sudut --}}
        <div class="rm-corner tl"></div>
        <div class="rm-corner tr"></div>
        <div class="rm-corner bl"></div>
        <div class="rm-corner br"></div>

        {{-- Glow bg --}}
        <div class="rm-loader-glow"></div>

        {{-- Partikel --}}
        <div id="rm-ldr-particles"></div>

        {{-- Mahkota SVG --}}
        <svg class="rm-loader-crown" width="72" height="58" viewBox="0 0 100 80" fill="none">
            <path d="M50 5L62 30L85 10L75 55H25L15 10L38 30L50 5Z" fill="url(#ldrg)" stroke="#C9A84C" stroke-width="1.5"/>
            <path d="M50 30L56 42H44L50 30Z" fill="#8B6914"/>
            <defs>
                <linearGradient id="ldrg" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#E8C97A"/>
                    <stop offset="50%" stop-color="#C9A84C"/>
                    <stop offset="100%" stop-color="#8B6914"/>
                </linearGradient>
            </defs>
        </svg>

        <p class="rm-loader-eyebrow">Restoran Masakan Minangkabau</p>

        <div class="rm-loader-brand">RATU MINANG</div>

        <div class="rm-loader-divider">
            <div class="rm-loader-divider-line"></div>
            <div class="rm-loader-divider-dot"></div>
            <div class="rm-loader-divider-dot"></div>
            <div class="rm-loader-divider-dot"></div>
            <div class="rm-loader-divider-line rev"></div>
        </div>

        <div class="rm-loader-bar-wrap">
            <div class="rm-loader-bar"></div>
        </div>

        <p class="rm-loader-text">Menyiapkan Sajian...</p>

    </div>

    {{-- ════════════════════════════════════
         NAVBAR
    ════════════════════════════════════ --}}
    <nav class="rm-nav">

        {{-- Brand --}}
        <a href="/" class="rm-nav-brand">
            <svg class="rm-nav-brand-icon" viewBox="0 0 100 80" fill="none">
                <path d="M50 5L62 30L85 10L75 55H25L15 10L38 30L50 5Z" fill="url(#nvg)" stroke="#C9A84C" stroke-width="1.5"/>
                <path d="M50 30L56 42H44L50 30Z" fill="#8B6914"/>
                <defs>
                    <linearGradient id="nvg" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#E8C97A"/>
                        <stop offset="50%" stop-color="#C9A84C"/>
                        <stop offset="100%" stop-color="#8B6914"/>
                    </linearGradient>
                </defs>
            </svg>
            <span class="rm-nav-brand-name">RATU MINANG</span>
        </a>

        {{-- Right side --}}
        <div class="rm-nav-right">

            {{-- Keranjang --}}
            <a href="/keranjang" class="rm-nav-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                <span class="rm-nav-label">Keranjang</span>
                @if(session('keranjang') && count(session('keranjang')) > 0)
                    <span class="rm-cart-badge">{{ collect(session('keranjang'))->sum('qty') }}</span>
                @endif
            </a>

            @guest
                <div class="rm-nav-sep"></div>
                <a href="/login" class="rm-nav-login">Masuk</a>
                <a href="/register" class="rm-nav-cta">Daftar</a>
            @endguest

            @auth
                <div class="rm-nav-sep"></div>

                {{-- Riwayat --}}
                <a href="/riwayat" class="rm-nav-link">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span class="rm-nav-label">Riwayat</span>
                </a>

                {{-- Nama user --}}
                <span class="rm-nav-user">✦ {{ Auth::user()->name }}</span>

                {{-- Admin / Kasir --}}
                @if(Auth::check() && Auth::user()->role == 'admin')
                    <a href="/admin/dashboard" class="rm-nav-admin">Dashboard</a>
                @elseif(Auth::check() && Auth::user()->role == 'kasir')
                    <a href="/admin/pos" class="rm-nav-admin">Kasir</a>
                @endif

                {{-- Logout --}}
                <form action="/logout" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="rm-nav-logout">Keluar</button>
                </form>
            @endauth

        </div>
    </nav>

    {{-- ════════════════════════════════════
         FLASH MESSAGES
    ════════════════════════════════════ --}}
    @if(session('success'))
        <div class="rm-flash success">✦ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="rm-flash error">✦ {{ session('error') }}</div>
    @endif

    {{-- ════════════════════════════════════
         CONTENT
    ════════════════════════════════════ --}}
    <div class="rm-content">
        @yield('content')
    </div>

    {{-- ════════════════════════════════════
         SCRIPTS
    ════════════════════════════════════ --}}
    <script>
        // Partikel loader
        (function(){
            var c = document.getElementById('rm-ldr-particles');
            if(!c) return;
            for(var i=0;i<18;i++){
                var p = document.createElement('div');
                p.className = 'rm-ldr-particle';
                var s = Math.random()*3+2;
                p.style.cssText = 'width:'+s+'px;height:'+s+'px;left:'+(Math.random()*100)+'vw;bottom:'+(Math.random()*50)+'vh;--d:'+(Math.random()*4+3)+'s;--dl:'+(Math.random()*3)+'s';
                c.appendChild(p);
            }
        })();

        // Hide loader setelah halaman siap
        window.addEventListener('load', function(){
            setTimeout(function(){
                var loader = document.getElementById('rm-loader');
                if(loader){
                    loader.classList.add('hide');
                    setTimeout(function(){
                        loader.style.display = 'none';
                    }, 700);
                }
            }, 2000);
        });
    </script>

</body>
</html>