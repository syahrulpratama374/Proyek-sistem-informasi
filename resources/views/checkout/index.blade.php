@extends('layouts.app')

@section('title', 'Konfirmasi Pesanan - Ratu Minang')

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

    .rm-co-page {
        padding: 48px 40px 80px;
        max-width: 1100px;
        margin: auto;
        font-family: 'Nunito Sans', sans-serif;
    }

    /* ── JUDUL ── */
    .rm-co-title {
        font-family: 'Playfair Display', serif;
        font-size: 30px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0 0 28px;
    }

    /* ── STEPPER ── */
    .rm-stepper {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 36px;
        flex-wrap: wrap;
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
        font-family: 'Cinzel', serif;
    }

    /* ── ERROR ── */
    .rm-co-error {
        background: rgba(231,76,60,0.08);
        border: 1px solid rgba(231,76,60,0.25);
        border-left: 3px solid #e74c3c;
        padding: 14px 18px;
        margin-bottom: 24px;
        font-size: 13px;
        color: #e74c3c;
        font-family: 'Nunito Sans', sans-serif;
    }
    .rm-co-error ul { margin: 0; padding-left: 18px; }
    .rm-co-error li { margin-bottom: 3px; }

    /* ── LAYOUT ── */
    .rm-co-form {
        display: flex;
        gap: 28px;
        flex-wrap: wrap;
        align-items: flex-start;
    }

    .rm-co-left {
        flex: 2;
        min-width: 60%;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    /* ── CARD ── */
    .rm-co-card {
        background: linear-gradient(145deg, rgba(26,18,8,0.97), rgba(15,10,5,0.99));
        border: 1px solid rgba(201,168,76,0.15);
        padding: 26px;
        position: relative;
        box-shadow: 0 10px 36px rgba(0,0,0,0.45);
    }

    .rm-co-card::before, .rm-co-card::after {
        content: '';
        position: absolute;
        width: 18px; height: 18px;
        border-color: rgba(201,168,76,0.3);
        border-style: solid;
    }
    .rm-co-card::before { top:-1px; left:-1px; border-width: 1px 0 0 1px; }
    .rm-co-card::after  { bottom:-1px; right:-1px; border-width: 0 1px 1px 0; }

    .rm-co-card h4 {
        margin: 0 0 18px;
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--gold);
    }

    /* ── FORM ELEMENTS ── */
    .rm-co-label {
        display: block;
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 2px;
        color: rgba(201,168,76,0.65);
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .rm-co-label span { color: #e74c3c; margin-left: 3px; }

    .rm-co-input,
    .rm-co-textarea {
        width: 100%;
        padding: 13px 16px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(201,168,76,0.18);
        color: var(--cream);
        font-family: 'Nunito Sans', sans-serif;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
        transition: border-color 0.3s, background 0.3s, box-shadow 0.3s;
        border-radius: 0;
    }

    .rm-co-input::placeholder,
    .rm-co-textarea::placeholder { color: rgba(250,243,224,0.2); font-style: italic; }

    .rm-co-input:focus,
    .rm-co-textarea:focus {
        border-color: rgba(201,168,76,0.5);
        background: rgba(201,168,76,0.04);
        box-shadow: 0 0 0 3px rgba(201,168,76,0.06);
    }

    .rm-co-textarea { resize: vertical; font-family: 'Nunito Sans', sans-serif; }

    /* ── RADIO PAYMENT ── */
    .rm-pay-option {
        display: flex;
        align-items: center;
        padding: 15px 18px;
        border: 1px solid rgba(201,168,76,0.15);
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s;
        background: rgba(255,255,255,0.02);
    }

    .rm-pay-option.active-pay {
        border-color: var(--gold);
        background: rgba(201,168,76,0.06);
    }

    .rm-pay-option:last-child { margin-bottom: 0; }

    .rm-pay-option input[type="radio"] {
        margin-right: 14px;
        accent-color: var(--gold);
        transform: scale(1.2);
        flex-shrink: 0;
    }

    .rm-pay-option-name {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 1.5px;
        color: var(--cream);
        text-transform: uppercase;
    }

    .rm-pay-badge {
        margin-left: auto;
        font-family: 'Cinzel', serif;
        font-size: 8px;
        letter-spacing: 1px;
        padding: 4px 10px;
        border: 1px solid rgba(201,168,76,0.3);
        color: rgba(201,168,76,0.6);
        text-transform: uppercase;
    }

    /* ── RINGKASAN KANAN ── */
    .rm-co-summary {
        flex: 1;
        min-width: 300px;
        background: linear-gradient(145deg, rgba(26,18,8,0.97), rgba(15,10,5,0.99));
        border: 1px solid rgba(201,168,76,0.15);
        padding: 28px;
        position: sticky;
        top: 80px;
        box-shadow: 0 10px 36px rgba(0,0,0,0.45);
        position: relative;
    }

    .rm-co-summary::before, .rm-co-summary::after {
        content: '';
        position: absolute;
        width: 18px; height: 18px;
        border-color: rgba(201,168,76,0.3);
        border-style: solid;
    }
    .rm-co-summary::before { top:-1px; left:-1px; border-width: 1px 0 0 1px; }
    .rm-co-summary::after  { bottom:-1px; right:-1px; border-width: 0 1px 1px 0; }

    .rm-co-summary h3 {
        margin: 0 0 20px;
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--gold);
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(201,168,76,0.15);
    }

    .rm-co-summary ul {
        list-style: none;
        padding: 0;
        margin: 0 0 20px;
    }

    .rm-co-summary ul li {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        border-bottom: 1px solid rgba(201,168,76,0.08);
        padding-bottom: 12px;
        font-size: 13px;
        gap: 10px;
    }

    .rm-co-summary ul li:last-child { border-bottom: none; }

    .rm-co-item-name {
        color: rgba(250,243,224,0.55);
        font-family: 'Cormorant Garamond', serif;
        font-size: 14px;
    }

    .rm-co-item-name strong {
        color: var(--gold);
        font-weight: 600;
    }

    .rm-co-item-price {
        color: rgba(250,243,224,0.7);
        white-space: nowrap;
    }

    .rm-co-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid rgba(201,168,76,0.2);
        padding-top: 16px;
        margin-bottom: 24px;
    }

    .rm-co-total-label {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 2px;
        color: var(--cream);
        text-transform: uppercase;
    }

    .rm-co-total-val {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .rm-co-submit {
        display: block;
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold), var(--gold-dark));
        background-size: 200% 100%;
        background-position: 100% 0;
        color: var(--black);
        text-align: center;
        font-family: 'Cinzel', serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        box-sizing: border-box;
        transition: background-position 0.5s, box-shadow 0.3s;
        box-shadow: 0 4px 22px rgba(201,168,76,0.2);
    }

    .rm-co-submit:hover {
        background-position: 0 0;
        box-shadow: 0 8px 36px rgba(201,168,76,0.4);
    }

    .rm-co-tos {
        text-align: center;
        font-size: 11px;
        color: rgba(250,243,224,0.25);
        margin-top: 12px;
        line-height: 1.5;
        font-family: 'Cormorant Garamond', serif;
    }

    @media (max-width: 768px) {
        .rm-co-page { padding: 28px 18px 60px; }
        .rm-co-left, .rm-co-summary { min-width: 100%; }
    }
</style>

<div class="rm-co-page">

    <h2 class="rm-co-title">Konfirmasi Pesanan</h2>

    {{-- STEPPER --}}
    <div class="rm-stepper">
        <span class="rm-step">1. Keranjang</span>
        <span class="rm-step-arrow">────</span>
        <span class="rm-step active">2. Konfirmasi</span>
        <span class="rm-step-arrow">────</span>
        <span class="rm-step">3. Selesai</span>
    </div>

    @if ($errors->any())
        <div class="rm-co-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/checkout/proses" method="POST" class="rm-co-form">
        @csrf

        <div class="rm-co-left">

            {{-- Detail Meja --}}
            <div class="rm-co-card">
                <h4>Detail Meja</h4>
                <label class="rm-co-label">Nomor Meja <span>*</span></label>
                <input type="text" name="nomor_meja" value="{{ old('nomor_meja') }}" required placeholder="Contoh: Meja 05" class="rm-co-input">
            </div>

            {{-- Metode Pembayaran --}}
            <div class="rm-co-card">
                <h4>Metode Pembayaran</h4>

                <label class="rm-pay-option active-pay">
                    <input type="radio" name="metode_pembayaran" value="tunai" checked>
                    <span class="rm-pay-option-name">Bayar di Kasir (Tunai / Cash)</span>
                </label>

                <label class="rm-pay-option">
                    <input type="radio" name="metode_pembayaran" value="transfer">
                    <span class="rm-pay-option-name">Transfer Bank</span>
                    <span class="rm-pay-badge">Tersedia</span>
                </label>
            </div>

            {{-- Catatan --}}
            <div class="rm-co-card">
                <h4>Catatan Untuk Dapur <span style="font-size:8px;color:rgba(250,243,224,0.3);letter-spacing:1px;">(Opsional)</span></h4>
                <textarea name="catatan" rows="3" placeholder="Instruksi khusus, pedas, pisah kuah, dll..." class="rm-co-textarea">{{ old('catatan') }}</textarea>
            </div>

        </div>

        {{-- RINGKASAN --}}
        <div class="rm-co-summary">
            <h3>Ringkasan Pesanan</h3>

            @php $total_belanja = 0; @endphp

            <ul>
                @foreach($keranjang as $item)
                    @php
                        $subtotal = $item['harga'] * $item['qty'];
                        $total_belanja += $subtotal;
                    @endphp
                    <li>
                        <span class="rm-co-item-name">{{ $item['nama_menu'] }} <strong>x {{ $item['qty'] }}</strong></span>
                        <span class="rm-co-item-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="rm-co-total-row">
                <span class="rm-co-total-label">Total</span>
                <span class="rm-co-total-val">Rp {{ number_format($total_belanja, 0, ',', '.') }}</span>
            </div>

            <button type="submit" class="rm-co-submit">✦ Pesan Sekarang</button>
            <p class="rm-co-tos">Dengan memesan, Anda setuju dengan syarat & ketentuan yang berlaku.</p>
        </div>

    </form>
</div>

@endsection