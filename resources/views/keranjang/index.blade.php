@extends('layouts.app')

@section('title', 'Keranjang Pesanan - Ratu Minang')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;600&family=Cinzel:wght@400;600;700&family=Nunito+Sans:wght@300;400;600&display=swap');

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

    .rm-cart-page {
        padding: 48px 40px 80px;
        max-width: 1100px;
        margin: auto;
        font-family: 'Nunito Sans', sans-serif;
    }

    /* ── HEADER ── */
    .rm-cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 18px;
        margin-bottom: 36px;
        border-bottom: 1px solid rgba(201,168,76,0.2);
        position: relative;
    }

    .rm-cart-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 80px;
        height: 1px;
        background: var(--gold);
    }

    .rm-cart-header h2 {
        margin: 0;
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .rm-cart-badge {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 1.5px;
        padding: 7px 18px;
        border: 1px solid rgba(201,168,76,0.35);
        color: var(--gold);
        background: rgba(201,168,76,0.06);
    }

    /* ── LAYOUT ── */
    .rm-cart-body {
        display: flex;
        gap: 28px;
        flex-wrap: wrap;
        align-items: flex-start;
    }

    /* ── ITEM LIST ── */
    .rm-cart-items {
        flex: 2;
        min-width: 60%;
        background: linear-gradient(145deg, rgba(26,18,8,0.97), rgba(15,10,5,0.99));
        border: 1px solid rgba(201,168,76,0.15);
        padding: 28px;
        box-shadow: 0 12px 40px rgba(0,0,0,0.5);
        position: relative;
    }

    .rm-cart-items::before,
    .rm-cart-items::after {
        content: '';
        position: absolute;
        width: 22px; height: 22px;
        border-color: rgba(201,168,76,0.35);
        border-style: solid;
    }
    .rm-cart-items::before { top: -1px; left: -1px; border-width: 1px 0 0 1px; }
    .rm-cart-items::after  { bottom: -1px; right: -1px; border-width: 0 1px 1px 0; }

    /* ── ITEM ROW ── */
    .rm-cart-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(201,168,76,0.1);
        padding: 20px 0;
        gap: 16px;
        transition: background 0.2s;
    }

    .rm-cart-row:last-child { border-bottom: none; }
    .rm-cart-row:hover { background: rgba(201,168,76,0.02); }

    /* Gambar + info */
    .rm-cart-info {
        display: flex;
        gap: 16px;
        align-items: center;
        flex: 2;
    }

    .rm-cart-img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border: 1px solid rgba(201,168,76,0.25);
        flex-shrink: 0;
        filter: brightness(0.9) contrast(1.05);
    }

    .rm-cart-nopic {
        width: 64px;
        height: 64px;
        background: rgba(201,168,76,0.05);
        border: 1px solid rgba(201,168,76,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-family: 'Cinzel', serif;
        font-size: 8px;
        color: rgba(201,168,76,0.35);
        letter-spacing: 1px;
    }

    .rm-cart-info-text h4 {
        margin: 0 0 5px;
        font-family: 'Playfair Display', serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--cream);
    }

    .rm-cart-info-text span {
        font-size: 13px;
        color: rgba(250,243,224,0.45);
        font-family: 'Cormorant Garamond', serif;
        font-size: 14px;
    }

    /* Qty control */
    .rm-cart-qty {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        justify-content: center;
    }

    .rm-qty-form { margin: 0; }

    .rm-qty-btn {
        padding: 6px 14px;
        border: 1px solid rgba(201,168,76,0.3);
        background: transparent;
        color: var(--gold);
        cursor: pointer;
        font-weight: 700;
        font-size: 16px;
        font-family: 'Nunito Sans', sans-serif;
        transition: all 0.25s;
        line-height: 1;
    }

    .rm-qty-btn:hover {
        background: rgba(201,168,76,0.12);
        border-color: var(--gold);
    }

    .rm-qty-btn.minus:hover {
        background: rgba(231,76,60,0.15);
        border-color: rgba(231,76,60,0.5);
        color: #e74c3c;
    }

    .rm-qty-num {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--cream);
        min-width: 28px;
        text-align: center;
    }

    /* Subtotal */
    .rm-cart-subtotal {
        font-family: 'Playfair Display', serif;
        font-size: 17px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        flex: 1;
        text-align: right;
        white-space: nowrap;
    }

    /* ── EMPTY STATE ── */
    .rm-cart-empty {
        text-align: center;
        padding: 60px 30px;
    }

    .rm-cart-empty-icon {
        font-size: 48px;
        opacity: 0.25;
        margin-bottom: 18px;
        display: block;
    }

    .rm-cart-empty h3 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: rgba(250,243,224,0.5);
        margin: 0 0 10px;
    }

    .rm-cart-empty p {
        font-family: 'Cormorant Garamond', serif;
        font-size: 16px;
        color: rgba(250,243,224,0.3);
        margin: 0 0 28px;
    }

    .rm-cart-empty-btn {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        padding: 12px 30px;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        color: var(--black);
        text-decoration: none;
        font-weight: 700;
        display: inline-block;
        transition: box-shadow 0.3s;
    }

    .rm-cart-empty-btn:hover {
        box-shadow: 0 6px 28px rgba(201,168,76,0.4);
        color: var(--black);
        text-decoration: none;
    }

    /* ── RINGKASAN ── */
    .rm-cart-summary {
        flex: 1;
        min-width: 300px;
        background: linear-gradient(145deg, rgba(26,18,8,0.97), rgba(15,10,5,0.99));
        border: 1px solid rgba(201,168,76,0.15);
        padding: 28px;
        height: fit-content;
        box-shadow: 0 12px 40px rgba(0,0,0,0.5);
        position: relative;
    }

    .rm-cart-summary::before,
    .rm-cart-summary::after {
        content: '';
        position: absolute;
        width: 22px; height: 22px;
        border-color: rgba(201,168,76,0.35);
        border-style: solid;
    }
    .rm-cart-summary::before { top: -1px; left: -1px; border-width: 1px 0 0 1px; }
    .rm-cart-summary::after  { bottom: -1px; right: -1px; border-width: 0 1px 1px 0; }

    .rm-cart-summary h3 {
        margin-top: 0;
        font-family: 'Cinzel', serif;
        font-size: 11px;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--gold);
        padding-bottom: 16px;
        margin-bottom: 22px;
        border-bottom: 1px solid rgba(201,168,76,0.15);
    }

    .rm-summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 13px;
        font-size: 14px;
        color: rgba(250,243,224,0.55);
        font-family: 'Nunito Sans', sans-serif;
    }

    .rm-summary-row .free {
        color: #2ecc71;
        font-weight: 600;
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 1px;
    }

    .rm-summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(201,168,76,0.2);
        padding-top: 18px;
        margin-top: 8px;
        margin-bottom: 28px;
    }

    .rm-summary-total-label {
        font-family: 'Cinzel', serif;
        font-size: 11px;
        letter-spacing: 2px;
        color: var(--cream);
        text-transform: uppercase;
    }

    .rm-summary-total-val {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .rm-summary-checkout {
        display: block;
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold), var(--gold-dark));
        background-size: 200% 100%;
        background-position: 100% 0;
        color: var(--black);
        text-align: center;
        text-decoration: none;
        font-family: 'Cinzel', serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
        box-sizing: border-box;
        transition: background-position 0.5s, box-shadow 0.3s;
        box-shadow: 0 4px 22px rgba(201,168,76,0.2);
    }

    .rm-summary-checkout:hover {
        background-position: 0 0;
        box-shadow: 0 8px 36px rgba(201,168,76,0.4);
        color: var(--black);
        text-decoration: none;
    }

    .rm-summary-more {
        display: block;
        width: 100%;
        padding: 12px;
        background: transparent;
        color: rgba(250,243,224,0.55);
        text-align: center;
        text-decoration: none;
        border: 1px solid rgba(201,168,76,0.2);
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        box-sizing: border-box;
        transition: all 0.3s;
    }

    .rm-summary-more:hover {
        border-color: rgba(201,168,76,0.5);
        color: var(--gold);
        background: rgba(201,168,76,0.05);
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .rm-cart-page { padding: 28px 18px 60px; }
        .rm-cart-items, .rm-cart-summary { min-width: 100%; }
        .rm-cart-row { flex-wrap: wrap; gap: 12px; }
        .rm-cart-subtotal { text-align: left; }
    }
</style>

<div class="rm-cart-page">

    {{-- HEADER --}}
    <div class="rm-cart-header">
        <h2>Keranjang Pesanan</h2>
        @if(session('keranjang'))
            <span class="rm-cart-badge">🛒 {{ count(session('keranjang')) }} Item</span>
        @endif
    </div>

    <div class="rm-cart-body">

        {{-- ITEM LIST --}}
        <div class="rm-cart-items">
            @php
                $total_belanja = 0;
                $total_item = 0;
            @endphp

            @if(session('keranjang') && count(session('keranjang')) > 0)
                @foreach(session('keranjang') as $id => $item)
                    @php
                        $subtotal = $item['harga'] * $item['qty'];
                        $total_belanja += $subtotal;
                        $total_item += $item['qty'];
                    @endphp

                    <div class="rm-cart-row">

                        {{-- Info produk --}}
                        <div class="rm-cart-info">
                            @if(isset($item['foto']) && $item['foto'])
                                <img src="{{ asset('storage/' . $item['foto']) }}" alt="{{ $item['nama_menu'] }}" class="rm-cart-img">
                            @else
                                <div class="rm-cart-nopic">No Pic</div>
                            @endif

                            <div class="rm-cart-info-text">
                                <h4>{{ $item['nama_menu'] }}</h4>
                                <span>Rp {{ number_format($item['harga'], 0, ',', '.') }} / porsi</span>
                            </div>
                        </div>

                        {{-- Qty control --}}
                        <div class="rm-cart-qty">
                            <form action="/keranjang/{{ $id }}/update" method="POST" class="rm-qty-form">
                                @csrf
                                <input type="hidden" name="action" value="kurang">
                                <button type="submit" class="rm-qty-btn minus">-</button>
                            </form>

                            <span class="rm-qty-num">{{ $item['qty'] }}</span>

                            <form action="/keranjang/{{ $id }}/update" method="POST" class="rm-qty-form">
                                @csrf
                                <input type="hidden" name="action" value="tambah">
                                <button type="submit" class="rm-qty-btn">+</button>
                            </form>
                        </div>

                        {{-- Subtotal --}}
                        <div class="rm-cart-subtotal">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </div>

                    </div>
                @endforeach
            @else
                <div class="rm-cart-empty">
                    <span class="rm-cart-empty-icon">🍛</span>
                    <h3>Keranjang Anda masih kosong</h3>
                    <p>Yuk pilih hidangan Padang favoritmu terlebih dahulu!</p>
                    <a href="/#katalog-menu" class="rm-cart-empty-btn">Lihat Menu</a>
                </div>
            @endif
        </div>

        {{-- RINGKASAN --}}
        @if(session('keranjang') && count(session('keranjang')) > 0)
        <div class="rm-cart-summary">
            <h3>Ringkasan</h3>

            <div class="rm-summary-row">
                <span>Subtotal ({{ $total_item }} menu)</span>
                <span>Rp {{ number_format($total_belanja, 0, ',', '.') }}</span>
            </div>

            <div class="rm-summary-row">
                <span>Biaya layanan</span>
                <span class="free">Gratis</span>
            </div>

            <div class="rm-summary-total">
                <span class="rm-summary-total-label">Total</span>
                <span class="rm-summary-total-val">Rp {{ number_format($total_belanja, 0, ',', '.') }}</span>
            </div>

            <a href="/checkout" class="rm-summary-checkout">Lanjut ke Pembayaran &rarr;</a>
            <a href="/#katalog-menu" class="rm-summary-more">+ Tambah Menu Lagi</a>
        </div>
        @endif

    </div>
</div>

@endsection