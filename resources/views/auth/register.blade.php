@extends('layouts.app')

@section('title', 'Daftar Akun - Ratu Minang')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;600&family=Cinzel:wght@400;600;700&family=Nunito+Sans:wght@300;400;600&display=swap');

    .rm-auth-page {
        min-height: calc(100vh - 64px);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        padding: 40px 20px;
        background:
            radial-gradient(ellipse 70% 60% at 50% 50%, rgba(139,26,26,0.25) 0%, transparent 65%),
            radial-gradient(ellipse 40% 40% at 20% 80%, rgba(201,168,76,0.07) 0%, transparent 55%),
            linear-gradient(180deg, #0A0805 0%, #120808 60%, #0A0805 100%);
    }

    .rm-auth-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    .rm-auth-orb-1 {
        width: 500px; height: 500px;
        top: -150px; right: -150px;
        background: radial-gradient(ellipse, rgba(139,26,26,0.18) 0%, transparent 70%);
    }
    .rm-auth-orb-2 {
        width: 300px; height: 300px;
        bottom: -80px; left: -80px;
        background: radial-gradient(ellipse, rgba(201,168,76,0.07) 0%, transparent 70%);
    }

    .rm-auth-line {
        position: absolute;
        top: 0; bottom: 0;
        width: 1px;
        background: linear-gradient(180deg, transparent, rgba(201,168,76,0.12), transparent);
        pointer-events: none;
    }
    .rm-auth-line-l { left: 15%; }
    .rm-auth-line-r { right: 15%; }

    .rm-auth-card {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 440px;
        background: linear-gradient(145deg, rgba(26,18,8,0.97), rgba(15,10,5,0.99));
        border: 1px solid rgba(201,168,76,0.2);
        padding: 48px 42px 44px;
        box-shadow: 0 32px 80px rgba(0,0,0,0.7), 0 0 40px rgba(201,168,76,0.04);
        animation: rmAuthIn 0.7s ease both;
    }

    @keyframes rmAuthIn {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .rm-auth-card::before,
    .rm-auth-card::after {
        content: '';
        position: absolute;
        width: 28px; height: 28px;
        border-color: rgba(201,168,76,0.45);
        border-style: solid;
    }
    .rm-auth-card::before { top: -1px; left: -1px; border-width: 2px 0 0 2px; }
    .rm-auth-card::after  { bottom: -1px; right: -1px; border-width: 0 2px 2px 0; }

    .rm-auth-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .rm-auth-crown {
        display: block;
        margin: 0 auto 14px;
        filter: drop-shadow(0 0 14px rgba(201,168,76,0.5));
        animation: rmCrownGlow 3s ease-in-out infinite;
    }
    @keyframes rmCrownGlow {
        0%,100% { filter: drop-shadow(0 0 14px rgba(201,168,76,0.5)); }
        50%      { filter: drop-shadow(0 0 26px rgba(201,168,76,0.85)); }
    }

    .rm-auth-eyebrow {
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 5px;
        color: rgba(201,168,76,0.6);
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .rm-auth-title {
        font-family: 'Playfair Display', serif;
        font-size: 26px;
        font-weight: 700;
        background: linear-gradient(135deg, #E8C97A, #C9A84C, #8B6914, #E8C97A);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0 0 6px;
        line-height: 1.2;
    }

    .rm-auth-sub {
        font-family: 'Cormorant Garamond', serif;
        font-size: 15px;
        font-weight: 300;
        color: rgba(250,243,224,0.45);
        margin: 0;
    }

    .rm-auth-div {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 26px;
    }
    .rm-auth-div-line {
        flex: 1; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(201,168,76,0.35));
    }
    .rm-auth-div-line.rev {
        background: linear-gradient(90deg, rgba(201,168,76,0.35), transparent);
    }
    .rm-auth-div-dot {
        width: 3px; height: 3px;
        background: rgba(201,168,76,0.5);
        transform: rotate(45deg);
    }

    .rm-auth-group {
        margin-bottom: 16px;
    }

    .rm-auth-label {
        display: block;
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 2px;
        color: rgba(201,168,76,0.7);
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .rm-auth-input {
        width: 100%;
        padding: 12px 16px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(201,168,76,0.18);
        color: #FAF3E0;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
        transition: border-color 0.3s, background 0.3s, box-shadow 0.3s;
        border-radius: 0;
        -webkit-appearance: none;
    }

    .rm-auth-input::placeholder {
        color: rgba(250,243,224,0.2);
        font-style: italic;
    }

    .rm-auth-input:focus {
        border-color: rgba(201,168,76,0.55);
        background: rgba(201,168,76,0.04);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.06);
    }

    .rm-auth-submit {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #8B6914, #C9A84C, #8B6914);
        background-size: 200% 100%;
        background-position: 100% 0;
        border: none;
        color: #0A0805;
        font-family: 'Cinzel', serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background-position 0.5s ease, box-shadow 0.3s;
        margin-top: 10px;
        box-shadow: 0 4px 22px rgba(201,168,76,0.2);
    }

    .rm-auth-submit:hover {
        background-position: 0 0;
        box-shadow: 0 8px 36px rgba(201,168,76,0.4);
    }

    .rm-auth-foot {
        text-align: center;
        margin-top: 22px;
        font-family: 'Cormorant Garamond', serif;
        font-size: 15px;
        color: rgba(250,243,224,0.4);
    }

    .rm-auth-foot a {
        color: #C9A84C;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .rm-auth-foot a:hover { color: #E8C97A; }

    .rm-auth-error {
        background: rgba(231,76,60,0.08);
        border: 1px solid rgba(231,76,60,0.25);
        border-left: 3px solid #e74c3c;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 13px;
        color: #e74c3c;
    }

    .rm-auth-error ul { margin: 0; padding-left: 18px; }
    .rm-auth-error li { margin-bottom: 3px; }
</style>

<div class="rm-auth-page">
    <div class="rm-auth-orb rm-auth-orb-1"></div>
    <div class="rm-auth-orb rm-auth-orb-2"></div>
    <div class="rm-auth-line rm-auth-line-l"></div>
    <div class="rm-auth-line rm-auth-line-r"></div>

    <div class="rm-auth-card">

        <div class="rm-auth-header">
            <svg class="rm-auth-crown" width="44" height="36" viewBox="0 0 100 80" fill="none">
                <path d="M50 5L62 30L85 10L75 55H25L15 10L38 30L50 5Z" fill="url(#reging)" stroke="#C9A84C" stroke-width="1.5"/>
                <path d="M50 30L56 42H44L50 30Z" fill="#8B6914"/>
                <defs>
                    <linearGradient id="reging" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#E8C97A"/>
                        <stop offset="50%" stop-color="#C9A84C"/>
                        <stop offset="100%" stop-color="#8B6914"/>
                    </linearGradient>
                </defs>
            </svg>
            <p class="rm-auth-eyebrow">Ratu Minang</p>
            <h2 class="rm-auth-title">Daftar Akun Baru</h2>
            <p class="rm-auth-sub">Mulai pesan makanan favoritmu</p>
        </div>

        <div class="rm-auth-div">
            <div class="rm-auth-div-line"></div>
            <div class="rm-auth-div-dot"></div>
            <div class="rm-auth-div-dot"></div>
            <div class="rm-auth-div-dot"></div>
            <div class="rm-auth-div-line rev"></div>
        </div>

        @if ($errors->any())
            <div class="rm-auth-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf

            <div class="rm-auth-group">
                <label class="rm-auth-label">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Contoh: Syahrul Pratama" class="rm-auth-input">
            </div>

            <div class="rm-auth-group">
                <label class="rm-auth-label">Nomor WhatsApp / Telepon</label>
                <input type="text" name="no_telepon" required placeholder="Contoh: 08123456789" class="rm-auth-input">
            </div>

            <div class="rm-auth-group">
                <label class="rm-auth-label">Email</label>
                <input type="email" name="email" required placeholder="email@contoh.com" class="rm-auth-input">
            </div>

            <div class="rm-auth-group" style="margin-bottom: 24px;">
                <label class="rm-auth-label">Password</label>
                <input type="password" name="password" minlength="8" required placeholder="Minimal 8 karakter" class="rm-auth-input">
            </div>

            <button type="submit" class="rm-auth-submit">Daftar Sekarang</button>
        </form>

        <p class="rm-auth-foot">
            Sudah punya akun? <a href="/login">Masuk di sini</a>
        </p>

    </div>
</div>

@endsection