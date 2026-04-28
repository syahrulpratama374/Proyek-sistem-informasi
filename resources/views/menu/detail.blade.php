@extends('layouts.app')

@section('title', 'Detail Menu - ' . $menu->nama_menu)

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;600&family=Cinzel:wght@400;600;700&family=Nunito+Sans:wght@300;400;600&display=swap');

    .rm-detail-page {
        min-height: calc(100vh - 64px);
        position: relative;
        overflow: hidden;
        padding: 40px 20px;
        background:
            radial-gradient(ellipse 70% 60% at 50% 50%, rgba(139,26,26,0.15) 0%, transparent 65%),
            radial-gradient(ellipse 40% 40% at 20% 80%, rgba(201,168,76,0.05) 0%, transparent 55%),
            linear-gradient(180deg, #0A0805 0%, #120808 60%, #0A0805 100%);
        color: #FAF3E0;
    }

    /* Ornamen latar */
    .rm-auth-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    .rm-auth-orb-1 {
        width: 500px; height: 500px;
        top: -150px; right: -150px;
        background: radial-gradient(ellipse, rgba(139,26,26,0.12) 0%, transparent 70%);
    }
    .rm-auth-orb-2 {
        width: 300px; height: 300px;
        bottom: -80px; left: -80px;
        background: radial-gradient(ellipse, rgba(201,168,76,0.05) 0%, transparent 70%);
    }

    .rm-detail-container {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    /* Tautan Kembali */
    .rm-back-link {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        color: #C9A84C;
        font-family: 'Cinzel', serif;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 25px;
        transition: color 0.3s, transform 0.3s;
    }
    .rm-back-link:hover {
        color: #E8C97A;
        transform: translateX(-5px);
    }

    /* Card Utama */
    .rm-detail-card {
        display: flex;
        gap: 40px;
        background: linear-gradient(145deg, rgba(26,18,8,0.97), rgba(15,10,5,0.99));
        padding: 40px;
        border: 1px solid rgba(201,168,76,0.2);
        box-shadow: 0 20px 50px rgba(0,0,0,0.6), 0 0 30px rgba(201,168,76,0.03);
        flex-wrap: wrap;
        position: relative;
    }

    /* Sudut dekoratif card */
    .rm-detail-card::before,
    .rm-detail-card::after {
        content: '';
        position: absolute;
        width: 20px; height: 20px;
        border-color: rgba(201,168,76,0.45);
        border-style: solid;
        pointer-events: none;
    }
    .rm-detail-card::before { top: -1px; left: -1px; border-width: 1px 0 0 1px; }
    .rm-detail-card::after  { bottom: -1px; right: -1px; border-width: 0 1px 1px 0; }

    /* Kolom Gambar */
    .rm-img-col {
        flex: 1;
        min-width: 300px;
    }
    .rm-detail-img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border: 1px solid rgba(201,168,76,0.3);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .rm-detail-placeholder {
        width: 100%;
        height: 380px;
        background: rgba(255,255,255,0.02);
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Cinzel', serif;
        font-weight: 600;
        color: rgba(201,168,76,0.4);
        border: 1px dashed rgba(201,168,76,0.2);
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: 14px;
    }

    /* Kolom Info */
    .rm-info-col {
        flex: 1;
        min-width: 300px;
        display: flex;
        flex-direction: column;
    }

    .rm-badge-kategori {
        display: inline-block;
        padding: 6px 14px;
        border: 1px solid rgba(201,168,76,0.3);
        background: rgba(201,168,76,0.05);
        color: #C9A84C;
        font-family: 'Cinzel', serif;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .rm-title-menu {
        font-family: 'Playfair Display', serif;
        font-size: 38px;
        font-weight: 700;
        background: linear-gradient(135deg, #E8C97A, #C9A84C, #8B6914, #E8C97A);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0 0 10px 0;
        line-height: 1.1;
    }

    .rm-price-menu {
        font-family: 'Nunito Sans', sans-serif;
        font-weight: 600;
        color: #E8C97A;
        font-size: 26px;
        margin: 0 0 25px 0;
    }

    /* Divider */
    .rm-divider {
        height: 1px;
        background: linear-gradient(90deg, rgba(201,168,76,0.3), transparent);
        margin-bottom: 25px;
    }

    .rm-desc-label {
        font-family: 'Cinzel', serif;
        font-size: 11px;
        color: rgba(201,168,76,0.8);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
        display: block;
    }

    .rm-desc-text {
        font-family: 'Cormorant Garamond', serif;
        color: rgba(250,243,224,0.7);
        font-size: 17px;
        line-height: 1.8;
        margin: 0;
        flex-grow: 1;
        margin-bottom: 30px;
    }

    /* Area Form / Aksi */
    .rm-action-area {
        background: rgba(255,255,255,0.02);
        padding: 24px;
        border: 1px solid rgba(201,168,76,0.15);
    }

    .rm-input-label {
        font-family: 'Cinzel', serif;
        font-size: 11px;
        color: rgba(250,243,224,0.6);
        letter-spacing: 1px;
        display: block;
        margin-bottom: 15px;
    }

    .rm-form-group {
        display: flex;
        gap: 15px;
    }

    .rm-input-qty {
        width: 80px;
        padding: 12px;
        text-align: center;
        background: rgba(0,0,0,0.3);
        border: 1px solid rgba(201,168,76,0.3);
        color: #E8C97A;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 16px;
        font-weight: bold;
        outline: none;
        transition: border-color 0.3s;
    }
    .rm-input-qty:focus {
        border-color: #C9A84C;
        box-shadow: 0 0 10px rgba(201,168,76,0.1);
    }

    .rm-btn-submit {
        flex: 1;
        background: linear-gradient(135deg, #8B6914, #C9A84C, #8B6914);
        background-size: 200% 100%;
        border: none;
        color: #0A0805;
        font-family: 'Cinzel', serif;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background-position 0.5s ease, box-shadow 0.3s;
        box-shadow: 0 4px 15px rgba(201,168,76,0.2);
    }
    .rm-btn-submit:hover {
        background-position: 0 0;
        box-shadow: 0 8px 25px rgba(201,168,76,0.4);
    }

    /* Guest Prompt */
    .rm-guest-prompt {
        text-align: center;
    }
    .rm-guest-text {
        font-family: 'Cormorant Garamond', serif;
        color: #E8C97A;
        font-size: 18px;
        margin-bottom: 15px;
        font-style: italic;
    }
    .rm-btn-login {
        display: inline-block;
        padding: 12px 30px;
        border: 1px solid #C9A84C;
        color: #C9A84C;
        text-decoration: none;
        font-family: 'Cinzel', serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: all 0.3s;
    }
    .rm-btn-login:hover {
        background: rgba(201,168,76,0.1);
        color: #E8C97A;
        border-color: #E8C97A;
    }
</style>

<div class="rm-detail-page">
    <div class="rm-auth-orb rm-auth-orb-1"></div>
    <div class="rm-auth-orb rm-auth-orb-2"></div>

    <div class="rm-detail-container">
        <a href="/#katalog-menu" class="rm-back-link">
            &larr; Kembali ke Katalog
        </a>
        
        <div class="rm-detail-card">
            
            <div class="rm-img-col">
                @if($menu->foto)
                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="rm-detail-img">
                @else
                    <div class="rm-detail-placeholder">
                        Belum Ada Foto
                    </div>
                @endif
            </div>
            
            <div class="rm-info-col">
                
                <div>
                    <span class="rm-badge-kategori">
                        {{ $menu->kategori }}
                    </span>
                    <h1 class="rm-title-menu">{{ $menu->nama_menu }}</h1>
                    <h2 class="rm-price-menu">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h2>
                </div>
                
                <div class="rm-divider"></div>

                <div>
                    <span class="rm-desc-label">Deskripsi Menu:</span>
                    <p class="rm-desc-text">
                        {{ $menu->deskripsi ?: 'Tidak ada deskripsi untuk menu ini.' }}
                    </p>
                </div>
                
                @auth
                    <form action="/keranjang/tambah" method="POST" class="rm-action-area">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        
                        <label class="rm-input-label">Tentukan Jumlah Porsi:</label>
                        
                        <div class="rm-form-group">
                            <input type="number" name="qty" value="1" min="1" class="rm-input-qty">
                            
                            <button type="submit" class="rm-btn-submit">
                                + Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                @endauth

                @guest
                    <div class="rm-action-area rm-guest-prompt">
                        <p class="rm-guest-text">
                            Silakan masuk terlebih dahulu untuk memesan menu ini.
                        </p>
                        <a href="/login" class="rm-btn-login">
                            Login Sekarang
                        </a>
                    </div>
                @endguest
                
            </div>
        </div>
    </div>
</div>

@endsection