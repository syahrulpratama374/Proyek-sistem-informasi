@extends('layouts.app')

@section('title', 'Pesanan Berhasil - Ratu Minang')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;600&family=Cinzel:wght@400;600;700&family=Nunito+Sans:wght@300;400;600&display=swap');

    :root {
        --gold: #C9A84C;
        --gold-light: #E8C97A;
        --gold-dark: #8B6914;
        --crimson: #8B1A1A;
        --black: #0A0805;
        --dark: #1A1208;
        --cream: #FAF3E0;
    }

    .rm-done-page {
        padding: 30px 20px 80px;
        max-width: 800px;
        margin: auto;
        text-align: center;
        min-height: calc(100vh - 64px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: 'Nunito Sans', sans-serif;
    }

    /* ── STEPPER ── */
    .rm-stepper {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 52px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .rm-step {
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 1.5px;
        padding: 8px 18px;
        text-transform: uppercase;
        border: 1px solid rgba(201,168,76,0.2);
        color: rgba(250,243,224,0.3);
        background: transparent;
        white-space: nowrap;
    }

    .rm-step.active {
        border-color: var(--gold);
        color: var(--gold);
        background: rgba(201,168,76,0.08);
    }

    .rm-step-arrow {
        color: rgba(201,168,76,0.25);
        font-size: 14px;
    }

    /* ── ICON SUKSES ── */
    .rm-done-icon-wrap {
        position: relative;
        margin-bottom: 32px;
    }

    .rm-done-ring {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 1px solid rgba(201,168,76,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        position: relative;
        animation: rmRingPulse 3s ease-in-out infinite;
    }

    .rm-done-ring::before {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        border: 1px solid rgba(201,168,76,0.1);
    }

    @keyframes rmRingPulse {
        0%,100% { box-shadow: 0 0 0 0 rgba(201,168,76,0.1); }
        50%      { box-shadow: 0 0 0 18px rgba(201,168,76,0); }
    }

    .rm-done-check {
        animation: rmCheckIn 0.6s ease 0.2s both;
    }

    @keyframes rmCheckIn {
        from { opacity: 0; transform: scale(0.5); }
        to   { opacity: 1; transform: scale(1); }
    }

    /* ── TEKS ── */
    .rm-done-eyebrow {
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 5px;
        color: rgba(201,168,76,0.55);
        text-transform: uppercase;
        margin-bottom: 12px;
        animation: rmFadeUp 0.7s ease 0.4s both;
    }

    .rm-done-title {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0 0 14px;
        line-height: 1.2;
        animation: rmFadeUp 0.7s ease 0.5s both;
    }

    /* Divider hias */
    .rm-done-div {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 auto 22px;
        width: 260px;
        animation: rmFadeUp 0.6s ease 0.6s both;
    }
    .rm-done-div-line {
        flex: 1; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(201,168,76,0.35));
    }
    .rm-done-div-line.rev {
        background: linear-gradient(90deg, rgba(201,168,76,0.35), transparent);
    }
    .rm-done-div-dot {
        width: 3px; height: 3px;
        background: rgba(201,168,76,0.5);
        transform: rotate(45deg);
    }

    .rm-done-desc {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px;
        font-weight: 300;
        color: rgba(250,243,224,0.5);
        line-height: 1.7;
        max-width: 480px;
        margin: 0 auto 40px;
        animation: rmFadeUp 0.7s ease 0.7s both;
    }

    /* ── TOMBOL ── */
    .rm-done-actions {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
        animation: rmFadeUp 0.7s ease 0.85s both;
    }

    .rm-done-btn-ghost {
        display: inline-block;
        padding: 13px 28px;
        background: transparent;
        color: rgba(250,243,224,0.6);
        text-decoration: none;
        border: 1px solid rgba(201,168,76,0.25);
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: all 0.3s;
    }

    .rm-done-btn-ghost:hover {
        border-color: var(--gold);
        color: var(--gold);
        text-decoration: none;
        background: rgba(201,168,76,0.05);
    }

    .rm-done-btn-primary {
        display: inline-block;
        padding: 13px 28px;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        color: var(--black);
        text-decoration: none;
        font-family: 'Cinzel', serif;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: box-shadow 0.3s;
        box-shadow: 0 4px 20px rgba(201,168,76,0.2);
    }

    .rm-done-btn-primary:hover {
        box-shadow: 0 8px 34px rgba(201,168,76,0.4);
        color: var(--black);
        text-decoration: none;
    }

    @keyframes rmFadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="rm-done-page">

    {{-- STEPPER --}}
    <div class="rm-stepper">
        <span class="rm-step">1. Keranjang</span>
        <span class="rm-step-arrow">────</span>
        <span class="rm-step">2. Konfirmasi</span>
        <span class="rm-step-arrow">────</span>
        <span class="rm-step active">3. Selesai</span>
    </div>

    {{-- ICON --}}
    <div class="rm-done-icon-wrap">
        <div class="rm-done-ring">
            <svg class="rm-done-check" width="52" height="52" viewBox="0 0 52 52" fill="none">
                <circle cx="26" cy="26" r="25" stroke="#C9A84C" stroke-width="1"/>
                <polyline points="14,27 22,35 38,18" stroke="url(#ckgrad)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <defs>
                    <linearGradient id="ckgrad" x1="14" y1="27" x2="38" y2="18" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#E8C97A"/>
                        <stop offset="100%" stop-color="#C9A84C"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>

    <p class="rm-done-eyebrow">Ratu Minang</p>

    <h1 class="rm-done-title">Pesanan Berhasil Dibuat!</h1>

    <div class="rm-done-div">
        <div class="rm-done-div-line"></div>
        <div class="rm-done-div-dot"></div>
        <div class="rm-done-div-dot"></div>
        <div class="rm-done-div-dot"></div>
        <div class="rm-done-div-line rev"></div>
    </div>

    <p class="rm-done-desc">
        Terima kasih telah memesan di Ratu Minang. Pesanan Anda telah masuk ke sistem dapur kami dan akan segera disiapkan. Mohon tunggu sejenak di meja Anda.
    </p>

    <div class="rm-done-actions">
        <a href="/#katalog-menu" class="rm-done-btn-ghost">+ Pesan Menu Lain</a>
        <a href="/" class="rm-done-btn-primary">Kembali ke Beranda</a>
    </div>

</div>

@endsection