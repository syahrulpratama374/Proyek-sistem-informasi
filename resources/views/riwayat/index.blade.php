@extends('layouts.app')

@section('title', 'Riwayat Pesanan - Ratu Minang')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Cormorant+Garamond:wght@300;400;600&family=Cinzel:wght@400;600;700&family=Nunito+Sans:wght@300;400;600&display=swap');

    .rm-history-page {
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

    /* Garis dekoratif vertikal */
    .rm-auth-line {
        position: absolute;
        top: 0; bottom: 0;
        width: 1px;
        background: linear-gradient(180deg, transparent, rgba(201,168,76,0.12), transparent);
        pointer-events: none;
    }
    .rm-auth-line-l { left: 15%; }
    .rm-auth-line-r { right: 15%; }

    .rm-history-container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    /* Header text */
    .rm-page-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .rm-page-title {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        background: linear-gradient(135deg, #E8C97A, #C9A84C, #8B6914, #E8C97A);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0 0 15px;
    }

    /* Divider hias */
    .rm-auth-div {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        max-width: 250px;
        margin: 0 auto;
    }
    .rm-auth-div-line {
        flex: 1;
        height: 1px;
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

    /* Card Order */
    .rm-order-card {
        background: linear-gradient(145deg, rgba(26,18,8,0.97), rgba(15,10,5,0.99));
        border: 1px solid rgba(201,168,76,0.2);
        box-shadow: 0 15px 35px rgba(0,0,0,0.5), 0 0 20px rgba(201,168,76,0.02);
        margin-bottom: 25px;
        position: relative;
    }

    /* Sudut dekoratif card */
    .rm-order-card::before,
    .rm-order-card::after {
        content: '';
        position: absolute;
        width: 15px; height: 15px;
        border-color: rgba(201,168,76,0.45);
        border-style: solid;
        pointer-events: none;
    }
    .rm-order-card::before { top: -1px; left: -1px; border-width: 1px 0 0 1px; }
    .rm-order-card::after  { bottom: -1px; right: -1px; border-width: 0 1px 1px 0; }

    /* Order Header dalam Card */
    .rm-order-header {
        background: rgba(201,168,76,0.03);
        padding: 16px 24px;
        border-bottom: 1px solid rgba(201,168,76,0.15);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    .rm-order-code {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        color: #E8C97A;
        font-size: 16px;
        letter-spacing: 1px;
    }
    .rm-order-date {
        font-family: 'Nunito Sans', sans-serif;
        color: rgba(250,243,224,0.4);
        font-size: 13px;
        margin-left: 12px;
    }

    /* Badge Status */
    .rm-status-badge {
        padding: 6px 14px;
        border-radius: 0px;
        font-family: 'Cinzel', serif;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        border: 1px solid;
    }
    .status-pending { background: rgba(201,168,76,0.05); color: #C9A84C; border-color: rgba(201,168,76,0.3); }
    .status-diproses { background: rgba(85,152,212,0.05); color: #7DB2E8; border-color: rgba(85,152,212,0.3); }
    .status-selesai { background: rgba(76,175,80,0.05); color: #66BB6A; border-color: rgba(76,175,80,0.3); }
    .status-batal { background: rgba(211,47,47,0.05); color: #EF5350; border-color: rgba(211,47,47,0.3); }

    /* Order Body */
    .rm-order-body {
        padding: 24px;
    }
    .rm-order-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .rm-order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px dashed rgba(201,168,76,0.15);
    }
    .rm-order-item:last-child {
        margin-bottom: 0;
        border-bottom: none;
        padding-bottom: 0;
    }
    .rm-item-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .rm-item-img {
        width: 55px; height: 55px;
        object-fit: cover;
        border: 1px solid rgba(201,168,76,0.3);
    }
    .rm-item-img-placeholder {
        width: 55px; height: 55px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(201,168,76,0.1);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 10px; color: rgba(250,243,224,0.3); text-align: center;
    }
    .rm-item-name {
        font-family: 'Cormorant Garamond', serif;
        font-weight: 600;
        color: #FAF3E0;
        font-size: 18px;
        display: block;
        margin-bottom: 4px;
    }
    .rm-item-qty {
        font-family: 'Nunito Sans', sans-serif;
        color: rgba(250,243,224,0.5);
        font-size: 13px;
    }
    .rm-item-price {
        font-family: 'Nunito Sans', sans-serif;
        font-weight: 600;
        color: #C9A84C;
        font-size: 15px;
    }

    /* Catatan */
    .rm-order-notes {
        background: rgba(201,168,76,0.04);
        padding: 12px 16px;
        border-left: 2px solid #C9A84C;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 13px;
        color: rgba(250,243,224,0.7);
        margin-top: 20px;
    }
    .rm-notes-title {
        font-family: 'Cinzel', serif;
        color: #C9A84C;
        font-size: 10px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-right: 5px;
    }

    /* Footer Total */
    .rm-order-footer {
        margin-top: 24px;
        text-align: right;
        border-top: 1px solid rgba(201,168,76,0.2);
        padding-top: 18px;
    }
    .rm-total-label {
        font-family: 'Cinzel', serif;
        font-size: 11px;
        color: rgba(250,243,224,0.5);
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    .rm-total-amount {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: #E8C97A;
        margin-left: 12px;
    }

    /* Empty State */
    .rm-empty-state {
        text-align: center;
        padding: 60px 20px;
        background: linear-gradient(145deg, rgba(26,18,8,0.97), rgba(15,10,5,0.99));
        border: 1px solid rgba(201,168,76,0.2);
        box-shadow: 0 15px 35px rgba(0,0,0,0.5);
    }
    .rm-empty-icon {
        font-size: 40px;
        margin-bottom: 20px;
        filter: drop-shadow(0 0 10px rgba(201,168,76,0.3));
    }
    .rm-empty-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        color: #E8C97A;
        margin-bottom: 10px;
    }
    .rm-empty-desc {
        font-family: 'Cormorant Garamond', serif;
        color: rgba(250,243,224,0.5);
        font-size: 17px;
        margin-bottom: 30px;
    }
    .rm-btn-primary {
        display: inline-block;
        padding: 14px 32px;
        background: linear-gradient(135deg, #8B6914, #C9A84C, #8B6914);
        background-size: 200% 100%;
        color: #0A0805;
        font-family: 'Cinzel', serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        text-decoration: none;
        transition: background-position 0.5s ease, box-shadow 0.3s;
        box-shadow: 0 4px 22px rgba(201,168,76,0.2);
    }
    .rm-btn-primary:hover {
        background-position: 0 0;
        box-shadow: 0 8px 36px rgba(201,168,76,0.4);
    }
</style>

<div class="rm-history-page">
    <div class="rm-auth-orb rm-auth-orb-1"></div>
    <div class="rm-auth-orb rm-auth-orb-2"></div>
    <div class="rm-auth-line rm-auth-line-l"></div>
    <div class="rm-auth-line rm-auth-line-r"></div>

    <div class="rm-history-container">
        
        <div class="rm-page-header">
            <h2 class="rm-page-title">Riwayat Pesanan</h2>
            <div class="rm-auth-div">
                <div class="rm-auth-div-line"></div>
                <div class="rm-auth-div-dot"></div>
                <div class="rm-auth-div-dot"></div>
                <div class="rm-auth-div-dot"></div>
                <div class="rm-auth-div-line rev"></div>
            </div>
        </div>

        @forelse($pesanans as $pesanan)
            <div class="rm-order-card">
                
                <div class="rm-order-header">
                    <div>
                        <span class="rm-order-code">{{ $pesanan->kode_pesanan }}</span>
                        <span class="rm-order-date">{{ $pesanan->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div>
                        @if($pesanan->status == 'pending')
                            <span class="rm-status-badge status-pending">Menunggu Proses</span>
                        @elseif($pesanan->status == 'diproses')
                            <span class="rm-status-badge status-diproses">Sedang Dimasak</span>
                        @elseif($pesanan->status == 'selesai')
                            <span class="rm-status-badge status-selesai">Selesai</span>
                        @else
                            <span class="rm-status-badge status-batal">Dibatalkan</span>
                        @endif
                    </div>
                </div>

                <div class="rm-order-body">
                    <ul class="rm-order-list">
                        @foreach($pesanan->detailPesanans as $detail)
                            <li class="rm-order-item">
                                
                                <div class="rm-item-info">
                                    @if($detail->menu && $detail->menu->foto)
                                        <img src="{{ asset('storage/' . $detail->menu->foto) }}" alt="{{ $detail->menu->nama_menu }}" class="rm-item-img">
                                    @else
                                        <div class="rm-item-img-placeholder">Tanpa<br>Foto</div>
                                    @endif

                                    <div>
                                        <span class="rm-item-name">
                                            {{ $detail->menu ? $detail->menu->nama_menu : 'Menu Tidak Tersedia' }}
                                        </span>
                                        <span class="rm-item-qty">{{ $detail->qty }} Porsi</span>
                                    </div>
                                </div>

                                <div class="rm-item-price">
                                    Rp {{ number_format($detail->harga_satuan * $detail->qty, 0, ',', '.') }}
                                </div>

                            </li>
                        @endforeach
                    </ul>

                    @if($pesanan->catatan)
                        <div class="rm-order-notes">
                            <span class="rm-notes-title">Catatan:</span> {{ $pesanan->catatan }}
                        </div>
                    @endif

                    <div class="rm-order-footer">
                        <span class="rm-total-label">Total Belanja</span>
                        <span class="rm-total-amount">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>
        @empty
            <div class="rm-empty-state">
                <div class="rm-empty-icon">🍽️</div>
                <h3 class="rm-empty-title">Belum Ada Riwayat Pesanan</h3>
                <p class="rm-empty-desc">Sajian istimewa khas Ratu Minang menanti untuk Anda nikmati.</p>
                <a href="/" class="rm-btn-primary">Lihat Menu</a>
            </div>
        @endforelse

    </div>
</div>

@endsection