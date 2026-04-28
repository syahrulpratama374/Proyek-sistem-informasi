@extends('layouts.app')

@section('title', 'Halaman Awal - Ratu Minang')

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

    .rm-page * {
        box-sizing: border-box;
    }

    .rm-page {
        font-family: 'Nunito Sans', sans-serif;
        background: var(--dark);
        color: var(--cream);
    }

    /* ── HERO ── */
    .rm-hero {
        min-height: 90vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 70px 60px 90px;
    }

    .rm-hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
        background:
            radial-gradient(ellipse 60% 80% at 65% 50%, rgba(139, 26, 26, 0.35) 0%, transparent 60%),
            radial-gradient(ellipse 50% 60% at 20% 30%, rgba(201, 168, 76, 0.1) 0%, transparent 55%),
            linear-gradient(180deg, #0A0805 0%, #1A0A0A 40%, #0D0808 100%);
    }

    .rm-hero-particles {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
    }

    .rm-particle {
        position: absolute;
        border-radius: 50%;
        background: var(--gold);
        opacity: 0;
        animation: rmFloat var(--dur) ease-in-out var(--delay) infinite;
    }

    @keyframes rmFloat {
        0% {
            opacity: 0;
            transform: translateY(0) scale(0);
        }

        20% {
            opacity: 0.6;
        }

        80% {
            opacity: 0.3;
        }

        100% {
            opacity: 0;
            transform: translateY(-110px) scale(0.5);
        }
    }

    .rm-hero-inner {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 60px;
        width: 100%;
        max-width: 1200px;
    }

    /* LEFT */
    .rm-hero-left {
        flex: 1;
    }

    .rm-eyebrow {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 6px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 16px;
        margin-top: 0;
        opacity: 0;
        animation: rmUp 0.8s ease 0.2s forwards;
    }

    .rm-hero-logo {
        width: 68px;
        margin-bottom: 14px;
        display: block;
        filter: drop-shadow(0 0 26px rgba(201, 168, 76, 0.6));
        opacity: 0;
        animation: rmUp 0.9s ease 0.1s forwards;
    }

    .rm-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(38px, 5.5vw, 84px);
        font-weight: 900;
        line-height: 0.92;
        margin: 0 0 8px 0;
        background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 40%, var(--gold-dark) 70%, var(--gold-light) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        opacity: 0;
        animation: rmUp 1s ease 0.4s forwards;
    }

    .rm-hero-title em {
        font-style: italic;
        display: block;
        font-size: 0.5em;
        letter-spacing: 5px;
        margin-bottom: 4px;
        background: linear-gradient(135deg, #fff, var(--gold-pale));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .rm-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 20px 0;
        opacity: 0;
        animation: rmUp 0.7s ease 0.65s forwards;
    }

    .rm-divider-line {
        height: 1px;
        width: 56px;
        background: linear-gradient(90deg, transparent, var(--gold));
    }

    .rm-divider-line.rev {
        background: linear-gradient(90deg, var(--gold), transparent);
    }

    .rm-divider-dot {
        width: 4px;
        height: 4px;
        background: var(--gold);
        transform: rotate(45deg);
    }

    .rm-hero-desc {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px;
        font-weight: 300;
        color: rgba(250, 243, 224, 0.7);
        line-height: 1.7;
        margin: 0 0 28px 0;
        max-width: 460px;
        opacity: 0;
        animation: rmUp 0.8s ease 0.85s forwards;
    }

    .rm-hero-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        opacity: 0;
        animation: rmUp 0.8s ease 1s forwards;
    }

    .rm-btn-primary {
        font-family: 'Cinzel', serif;
        font-size: 11px;
        letter-spacing: 2.5px;
        padding: 14px 34px;
        text-decoration: none;
        text-transform: uppercase;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold), var(--gold-dark));
        background-size: 200% 100%;
        background-position: 100% 0;
        color: var(--black);
        font-weight: 700;
        display: inline-block;
        transition: background-position 0.5s ease, box-shadow 0.3s;
        box-shadow: 0 4px 28px rgba(201, 168, 76, 0.3);
    }

    .rm-btn-primary:hover {
        background-position: 0 0;
        box-shadow: 0 8px 40px rgba(201, 168, 76, 0.5);
        color: var(--black);
        text-decoration: none;
    }

    .rm-btn-ghost {
        font-family: 'Cinzel', serif;
        font-size: 11px;
        letter-spacing: 2.5px;
        padding: 14px 34px;
        text-decoration: none;
        text-transform: uppercase;
        border: 1px solid rgba(201, 168, 76, 0.5);
        color: var(--gold);
        display: inline-block;
        transition: all 0.4s;
    }

    .rm-btn-ghost:hover {
        border-color: var(--gold);
        background: rgba(201, 168, 76, 0.08);
        color: var(--gold);
        text-decoration: none;
    }

    /* RIGHT */
    .rm-hero-right {
        flex: 1;
        text-align: right;
    }

    .rm-img-frame {
        display: inline-block;
        position: relative;
    }

    .rm-img-frame::before,
    .rm-img-frame::after {
        content: '';
        position: absolute;
        width: 38px;
        height: 38px;
        border-color: var(--gold);
        border-style: solid;
        opacity: 0.45;
        z-index: 3;
    }

    .rm-img-frame::before {
        top: -7px;
        right: -7px;
        border-width: 1px 1px 0 0;
    }

    .rm-img-frame::after {
        bottom: -7px;
        left: -7px;
        border-width: 0 0 1px 1px;
    }

    .rm-hero-img {
        width: 100%;
        max-width: 400px;
        height: 250px;
        object-fit: cover;
        border-radius: 2px;
        border: 1px solid rgba(201, 168, 76, 0.25);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.7), 0 0 36px rgba(201, 168, 76, 0.08);
        opacity: 0;
        animation: rmSlide 1s ease 0.6s forwards;
        filter: brightness(0.88) contrast(1.05);
        display: block;
        margin-left: auto;
    }

    @keyframes rmUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes rmSlide {
        from {
            opacity: 0;
            transform: translateX(40px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Scroll indicator */
    .rm-scroll-hint {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 7px;
        opacity: 0;
        animation: rmUp 0.8s ease 1.4s forwards;
        cursor: pointer;
        z-index: 3;
    }

    .rm-scroll-text {
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 3px;
        color: var(--gold);
        opacity: 0.6;
    }

    .rm-scroll-line {
        width: 1px;
        height: 42px;
        background: linear-gradient(180deg, var(--gold), transparent);
        animation: rmScrollAnim 2s ease infinite;
    }

    @keyframes rmScrollAnim {

        0%,
        100% {
            transform: scaleY(0);
            transform-origin: top
        }

        50% {
            transform: scaleY(1)
        }
    }

    /* ── STATS ── */
    .rm-stats {
        background: linear-gradient(90deg, var(--crimson-deep), #3A0E0E, var(--crimson-deep));
        border-top: 1px solid rgba(201, 168, 76, 0.3);
        border-bottom: 1px solid rgba(201, 168, 76, 0.3);
        padding: 26px 60px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
    }

    .rm-stat {
        text-align: center;
    }

    .rm-stat-num {
        font-family: 'Playfair Display', serif;
        font-size: 38px;
        font-weight: 900;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: block;
        line-height: 1;
    }

    .rm-stat-label {
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 2px;
        color: rgba(250, 243, 224, 0.5);
        margin-top: 4px;
        text-transform: uppercase;
    }

    .rm-stat-sep {
        width: 1px;
        height: 40px;
        background: linear-gradient(180deg, transparent, rgba(201, 168, 76, 0.4), transparent);
    }

    /* ── FILTER BAR ── */
    .rm-filter-bar {
        background: var(--black);
        padding: 26px 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(201, 168, 76, 0.12);
        flex-wrap: wrap;
        gap: 14px;
    }

    .rm-filter-tabs {
        display: flex;
        gap: 0;
        border: 1px solid rgba(201, 168, 76, 0.2);
        flex-wrap: wrap;
    }

    .rm-tab {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 1.5px;
        padding: 11px 20px;
        text-transform: uppercase;
        color: rgba(250, 243, 224, 0.5);
        background: transparent;
        border-right: 1px solid rgba(201, 168, 76, 0.2);
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        white-space: nowrap;
    }

    .rm-tab:last-child {
        border-right: none;
    }

    .rm-tab.active {
        color: var(--gold);
        background: rgba(139, 26, 26, 0.45);
    }

    .rm-tab:hover {
        color: var(--gold);
        background: rgba(139, 26, 26, 0.3);
        text-decoration: none;
    }

    .rm-search-form {
        display: flex;
        gap: 0;
    }

    .rm-search-input {
        padding: 11px 16px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(201, 168, 76, 0.2);
        border-right: none;
        color: var(--cream);
        font-family: 'Nunito Sans', sans-serif;
        font-size: 13px;
        outline: none;
        width: 200px;
        transition: all 0.3s;
    }

    .rm-search-input:focus {
        border-color: rgba(201, 168, 76, 0.5);
        background: rgba(201, 168, 76, 0.04);
    }

    .rm-search-input::placeholder {
        color: rgba(250, 243, 224, 0.3);
    }

    .rm-search-btn {
        padding: 11px 16px;
        background: linear-gradient(135deg, var(--gold-dark), var(--gold));
        border: none;
        color: var(--black);
        cursor: pointer;
        font-family: 'Cinzel', serif;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.5px;
        transition: all 0.3s;
    }

    .rm-search-btn:hover {
        box-shadow: 0 4px 18px rgba(201, 168, 76, 0.4);
    }

    /* ── MENU SECTION ── */
    .rm-katalog {
        background: var(--black);
        padding: 44px 60px 80px;
    }

    .rm-katalog-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .rm-katalog-title {
        font-family: 'Playfair Display', serif;
        font-size: 26px;
        font-weight: 700;
        margin: 0;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .rm-katalog-count {
        font-family: 'Cinzel', serif;
        font-size: 10px;
        letter-spacing: 2px;
        color: rgba(250, 243, 224, 0.4);
        text-transform: uppercase;
    }

    /* ── GRID ── */
    .rm-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    /* ── CARD ── */
    .rm-card {
        background: linear-gradient(145deg, #1A1208, #0F0A05);
        border: 1px solid rgba(201, 168, 76, 0.12);
        position: relative;
        overflow: hidden;
        transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s;
        display: flex;
        flex-direction: column;
        opacity: 0;
        animation: rmCardIn 0.5s ease both;
    }

    @keyframes rmCardIn {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .rm-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 48px rgba(0, 0, 0, 0.65), 0 0 22px rgba(201, 168, 76, 0.09);
        border-color: rgba(201, 168, 76, 0.3);
    }

    /* Card image */
    .rm-card-img {
        width: 100%;
        height: 160px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(145deg, #231A0C, #1A1208);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .rm-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .rm-card:hover .rm-card-img img {
        transform: scale(1.06);
    }

    .rm-card-img::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 50%, rgba(10, 8, 5, 0.72));
        pointer-events: none;
    }

    .rm-no-photo {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cinzel', serif;
        font-size: 12px;
        letter-spacing: 1px;
        color: rgba(201, 168, 76, 0.4);
        flex-direction: column;
        gap: 8px;
    }

    .rm-no-photo::before {
        content: '🍛';
        font-size: 40px;
        opacity: 0.4;
    }

    /* Hover overlay on image */
    .rm-overlay {
        position: absolute;
        inset: 0;
        z-index: 5;
        background: rgba(92, 10, 10, 0.88);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .rm-card-img:hover .rm-overlay {
        opacity: 1;
    }

    .rm-ovr-btn {
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 1.5px;
        padding: 7px 13px;
        text-decoration: none;
        text-transform: uppercase;
        border: 1px solid var(--gold);
        color: var(--gold);
        transition: all 0.3s;
        cursor: pointer;
        background: transparent;
        display: inline-block;
    }

    .rm-ovr-btn.fill {
        background: var(--gold);
        color: var(--black);
        border-color: var(--gold);
    }

    .rm-ovr-btn:hover {
        background: var(--gold);
        color: var(--black);
        text-decoration: none;
    }

    /* Card body */
    .rm-card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .rm-card-cat {
        font-family: 'Cinzel', serif;
        font-size: 8px;
        letter-spacing: 2px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .rm-card-name {
        font-family: 'Playfair Display', serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--cream);
        margin: 0 0 7px 0;
        line-height: 1.3;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .rm-avail-row {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 9px;
    }

    .rm-badge-avail {
        display: inline-block;
        padding: 3px 7px;
        border: 1px solid #27ae60;
        color: #27ae60;
        font-family: 'Cinzel', serif;
        font-size: 8px;
        letter-spacing: 1px;
    }

    .rm-cat-text {
        font-size: 12px;
        color: rgba(250, 243, 224, 0.5);
    }

    .rm-price {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--gold-light), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0 0 14px 0;
        display: block;
    }

    .rm-actions {
        display: flex;
        gap: 7px;
        margin-top: auto;
    }

    /* Detail link */
    .rm-detail-link {
        flex: 1;
        text-align: center;
        padding: 8px 8px;
        border: 1px solid rgba(201, 168, 76, 0.22);
        color: rgba(250, 243, 224, 0.6);
        text-decoration: none;
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.3s;
        display: block;
    }

    .rm-detail-link:hover {
        border-color: var(--gold);
        color: var(--gold);
        text-decoration: none;
    }

    /* Auth: POST form button */
    .rm-form-cart {
        flex: 2;
        margin: 0;
    }

    .rm-btn-cart {
        width: 100%;
        padding: 8px 10px;
        background: transparent;
        border: 1px solid var(--gold);
        color: var(--gold);
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .rm-btn-cart::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gold);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s;
    }

    .rm-btn-cart:hover {
        color: var(--black);
    }

    .rm-btn-cart:hover::before {
        transform: scaleX(1);
        transform-origin: left;
    }

    .rm-btn-cart span {
        position: relative;
        z-index: 1;
    }

    /* Guest: login link styled same */
    .rm-guest-link {
        flex: 2;
        text-align: center;
        padding: 8px 10px;
        border: 1px solid rgba(201, 168, 76, 0.25);
        color: rgba(201, 168, 76, 0.6);
        text-decoration: none;
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.3s;
        display: block;
        position: relative;
        overflow: hidden;
    }

    .rm-guest-link::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gold);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s;
    }

    .rm-guest-link span {
        position: relative;
        z-index: 1;
    }

    .rm-guest-link:hover {
        color: var(--black);
        text-decoration: none;
    }

    .rm-guest-link:hover::before {
        transform: scaleX(1);
        transform-origin: left;
    }

    /* Empty */
    .rm-empty {
        grid-column: 1/-1;
        text-align: center;
        padding: 55px 30px;
        border: 1px dashed rgba(201, 168, 76, 0.2);
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px;
        color: rgba(250, 243, 224, 0.4);
    }

    /* ── FOOTER ── */
    .rm-footer {
        background: var(--black);
        border-top: 1px solid rgba(201, 168, 76, 0.15);
        padding: 50px 60px 26px;
    }

    .rm-gold-bar {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
        opacity: 0.4;
        margin-bottom: 18px;
    }

    .rm-footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 46px;
        margin-bottom: 32px;
    }

    .rm-f-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 13px;
    }

    .rm-f-icon {
        width: 34px;
        filter: drop-shadow(0 0 7px rgba(201, 168, 76, 0.4));
    }

    .rm-f-name {
        font-family: 'Cinzel', serif;
        font-size: 14px;
        color: var(--gold);
        letter-spacing: 2px;
    }

    .rm-f-desc {
        font-size: 13px;
        color: rgba(250, 243, 224, 0.5);
        line-height: 1.7;
        margin-bottom: 18px;
    }

    .rm-f-socials {
        display: flex;
        gap: 7px;
    }

    .rm-f-social {
        width: 32px;
        height: 32px;
        border: 1px solid rgba(201, 168, 76, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        text-decoration: none;
        color: var(--gold);
        transition: all 0.3s;
    }

    .rm-f-social:hover {
        background: var(--gold);
        color: var(--black);
    }

    .rm-f-col-title {
        font-family: 'Cinzel', serif;
        font-size: 9px;
        letter-spacing: 2.5px;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .rm-f-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .rm-f-links li {
        margin-bottom: 9px;
    }

    .rm-f-links a {
        font-size: 12px;
        color: rgba(250, 243, 224, 0.5);
        text-decoration: none;
        transition: color 0.3s;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .rm-f-links a::before {
        content: '—';
        color: var(--gold);
        font-size: 9px;
        opacity: 0.5;
    }

    .rm-f-links a:hover {
        color: var(--gold);
    }

    .rm-f-bottom {
        border-top: 1px solid rgba(201, 168, 76, 0.1);
        padding-top: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .rm-f-copy {
        font-size: 11px;
        color: rgba(250, 243, 224, 0.35);
    }

    /* ── REVEAL ── */
    .rm-reveal {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .rm-reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) {
        .rm-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .rm-footer-grid {
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }
    }

    @media (max-width: 860px) {
        .rm-hero {
            padding: 60px 28px 80px;
        }

        .rm-hero-inner {
            flex-direction: column;
        }

        .rm-hero-right {
            text-align: center;
        }

        .rm-hero-img {
            margin: 0 auto;
            max-width: 100%;
        }

        .rm-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .rm-stats,
        .rm-filter-bar,
        .rm-katalog {
            padding-left: 28px;
            padding-right: 28px;
        }

        .rm-footer {
            padding: 38px 28px 20px;
        }
    }

    @media (max-width: 560px) {
        .rm-hero {
            padding: 50px 18px 70px;
        }

        .rm-grid {
            grid-template-columns: 1fr;
        }

        .rm-filter-bar {
            flex-direction: column;
            align-items: flex-start;
            padding: 18px;
        }

        .rm-filter-tabs {
            flex-wrap: wrap;
        }

        .rm-katalog {
            padding: 32px 18px 56px;
        }

        .rm-stats {
            padding: 18px;
        }

        .rm-footer {
            padding: 32px 18px 18px;
        }

        .rm-footer-grid {
            grid-template-columns: 1fr;
        }

        .rm-f-bottom {
            flex-direction: column;
            gap: 7px;
            text-align: center;
        }

        .rm-hero-actions {
            flex-direction: column;
        }
    }
</style>

<div class="rm-page">

    {{-- ════════════════════════════════════════════════════ --}}
    {{-- HEADER — struktur asli: flex, flex:1 kiri & kanan   --}}
    {{-- ════════════════════════════════════════════════════ --}}
    <header class="rm-hero" id="rm-top">
        <div class="rm-hero-bg"></div>
        <div class="rm-hero-particles" id="rmParticles"></div>

        <div class="rm-hero-inner">

            {{-- KIRI (flex: 1) — persis isi aslinya --}}
            <div class="rm-hero-left">
                <p class="rm-eyebrow">CITA RASA ASLI MINANG</p>

                <svg class="rm-hero-logo" viewBox="0 0 100 80" fill="none">
                    <path d="M50 5L62 30L85 10L75 55H25L15 10L38 30L50 5Z" fill="url(#rmhg)" stroke="#C9A84C" stroke-width="1.5" />
                    <path d="M50 30L56 42H44L50 30Z" fill="#8B6914" />
                    <defs>
                        <linearGradient id="rmhg" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#E8C97A" />
                            <stop offset="50%" stop-color="#C9A84C" />
                            <stop offset="100%" stop-color="#8B6914" />
                        </linearGradient>
                    </defs>
                </svg>

                {{-- Teks asli: "Pesan Makanan<br>Padang Favoritmu" --}}
                <h1 class="rm-hero-title">
                    <em>Pesan Makanan</em>
                    Padang Favoritmu
                </h1>

                <div class="rm-divider">
                    <div class="rm-divider-line"></div>
                    <div class="rm-divider-dot"></div>
                    <div class="rm-divider-dot"></div>
                    <div class="rm-divider-dot"></div>
                    <div class="rm-divider-line rev"></div>
                </div>

                {{-- Teks asli persis --}}
                <p class="rm-hero-desc">Nikmati rendang, gulai, dan aneka lauk khas Minang segar setiap hari. Pesan langsung dari meja Anda!</p>

                <div class="rm-hero-actions">
                    {{-- Asli: href="#katalog-menu" background #e74c3c --}}
                    <a href="#katalog-menu" class="rm-btn-primary">Pesan Sekarang</a>
                    {{-- Asli: href="#katalog-menu" background white --}}
                    <a href="#katalog-menu" class="rm-btn-ghost">Lihat Menu</a>
                </div>
            </div>

            {{-- KANAN (flex: 1, text-align: right) --}}
            <div class="rm-hero-right">
                <div class="rm-img-frame">
                    {{-- Asli: asset('images/menu_utama.jpg') --}}
                    <img src="{{ asset('images/menu_utama.jpg') }}"
                        alt="Ilustrasi Salero Bundo"
                        class="rm-hero-img"
                        onerror="this.style.display='none'">
                </div>
            </div>

        </div>

        <div class="rm-scroll-hint" onclick="document.getElementById('katalog-menu').scrollIntoView({behavior:'smooth'})">
            <span class="rm-scroll-text">GULIR</span>
            <div class="rm-scroll-line"></div>
        </div>
    </header>

    {{-- STATS --}}
    <div class="rm-stats">
        <div class="rm-stat rm-reveal">
            <span class="rm-stat-num" data-target="15">0</span>
            <span class="rm-stat-label">Tahun Berdiri</span>
        </div>
        <div class="rm-stat-sep"></div>
        <div class="rm-stat rm-reveal" style="transition-delay:.1s">
            <span class="rm-stat-num" data-target="{{ count($menus) > 0 ? count($menus) : 60 }}">0</span>
            <span class="rm-stat-label">Varian Menu</span>
        </div>
        <div class="rm-stat-sep"></div>
        <div class="rm-stat rm-reveal" style="transition-delay:.2s">
            <span class="rm-stat-num" data-target="500">0</span>
            <span class="rm-stat-label">Tamu Per Hari</span>
        </div>
        <div class="rm-stat-sep"></div>
        <div class="rm-stat rm-reveal" style="transition-delay:.3s">
            <span class="rm-stat-num" data-target="98">0</span>
            <span class="rm-stat-label">% Kepuasan</span>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════════════════ --}}
    {{-- FILTER + SEARCH — persis struktur asli (section margin-bottom 30px) --}}
    {{-- ════════════════════════════════════════════════════════════════════ --}}
    <section class="rm-filter-bar rm-reveal">

        {{-- Filter tabs — asli: div flex gap-10 --}}
        <div class="rm-filter-tabs">
            <a href="/"
                class="rm-tab {{ !request('kategori') ? 'active' : '' }}">
                Semua
            </a>
            <a href="/?kategori=Lauk Utama"
                class="rm-tab {{ request('kategori') == 'Lauk Utama' ? 'active' : '' }}">
                🍖 Lauk Utama
            </a>
            <a href="/?kategori=Sayuran"
                class="rm-tab {{ request('kategori') == 'Sayuran' ? 'active' : '' }}">
                🥬 Sayuran
            </a>
            <a href="/?kategori=Nasi & Karbohidrat"
                class="rm-tab {{ request('kategori') == 'Nasi & Karbohidrat' ? 'active' : '' }}">
                🍚 Nasi & Karbohidrat
            </a>
            <a href="/?kategori=Minuman"
                class="rm-tab {{ request('kategori') == 'Minuman' ? 'active' : '' }}">
                🥤 Minuman
            </a>
        </div>

        {{-- Search — asli: form action="/" method="GET" --}}
        <form action="/" method="GET" class="rm-search-form">
            @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <input type="text"
                name="cari"
                value="{{ request('cari') }}"
                placeholder="🔍 Cari Menu..."
                class="rm-search-input">
            <button type="submit" class="rm-search-btn">Cari</button>
        </form>

    </section>

    {{-- ════════════════════════════════════════════════════════════════════ --}}
    {{-- KATALOG — asli: section id="katalog-menu" + @forelse($menus as $item) --}}
    {{-- ════════════════════════════════════════════════════════════════════ --}}
    <section id="katalog-menu" class="rm-katalog">

        {{-- Asli: h3 "Menu Tersedia" + span count($menus) --}}
        <div class="rm-katalog-head rm-reveal">
            <h3 class="rm-katalog-title">Menu Tersedia</h3>
            <span class="rm-katalog-count">Menampilkan {{ count($menus) }} menu</span>
        </div>

        {{-- Grid cards --}}
        <div class="rm-grid">
            @forelse($menus as $item)

            <div class="rm-card" style="animation-delay: {{ $loop->index * 0.05 }}s">

                {{-- IMAGE — asli: if $item->foto asset('storage/...') else "Tanpa Foto" --}}
                <div class="rm-card-img">
                    @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_menu }}">
                    @else
                    <div class="rm-no-photo">Tanpa Foto</div>
                    @endif

                    {{-- Overlay hover --}}
                    <div class="rm-overlay">
                        <a href="/menu/{{ $item->id }}" class="rm-ovr-btn">Detail</a>
                        @auth
                        <button class="rm-ovr-btn fill"
                            onclick="rmAddCart({{ $item->id }}, '{{ addslashes($item->nama_menu) }}')">
                            + Pesan
                        </button>
                        @endauth
                        @guest
                        <a href="/login" class="rm-ovr-btn fill">+ Pesan</a>
                        @endguest
                    </div>
                </div>

                {{-- BODY --}}
                <div class="rm-card-body">

                    {{-- Asli: nama_menu h4 --}}
                    <div class="rm-card-cat">{{ $item->kategori }}</div>
                    <h4 class="rm-card-name" title="{{ $item->nama_menu }}">{{ $item->nama_menu }}</h4>

                    {{-- Asli: badge TERSEDIA + kategori --}}
                    <div class="rm-avail-row">
                        <span class="rm-badge-avail">TERSEDIA</span>
                        <span class="rm-cat-text">{{ $item->kategori }}</span>
                    </div>

                    {{-- Asli: harga_rupiah ?? number_format($item->harga) --}}
                    <p class="rm-price">{{ $item->harga_rupiah ?? 'Rp ' . number_format($item->harga, 0, ',', '.') }}</p>

                    {{-- ACTIONS — asli: div flex gap-8 --}}
                    <div class="rm-actions">

                        {{-- Asli: href="/menu/{id}" --}}
                        <a href="/menu/{{ $item->id }}" class="rm-detail-link">Detail</a>

                        @auth
                        {{-- Asli: form action="/keranjang/tambah" method="POST" --}}
                        <form action="/keranjang/tambah" method="POST"
                            class="rm-form-cart"
                            id="rmForm{{ $item->id }}">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $item->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="rm-btn-cart">
                                <span>+ Tambah</span>
                            </button>
                        </form>
                        @endauth

                        @guest
                        {{-- Asli: href="/login" --}}
                        <a href="/login" class="rm-guest-link">
                            <span>+ Tambah</span>
                        </a>
                        @endguest

                    </div>
                </div>

            </div>

            @empty
            {{-- Asli: "Menu tidak ditemukan." --}}
            <div class="rm-empty">✦ Menu tidak ditemukan ✦</div>
            @endforelse
        </div>

    </section>

    {{-- FOOTER --}}
    <footer class="rm-footer">
        <div class="rm-gold-bar"></div>
        <div class="rm-footer-grid">
            <div>
                <div class="rm-f-brand">
                    <svg class="rm-f-icon" viewBox="0 0 100 80" fill="none">
                        <path d="M50 5L62 30L85 10L75 55H25L15 10L38 30L50 5Z" fill="url(#rmfg)" stroke="#C9A84C" stroke-width="1.5" />
                        <path d="M50 30L56 42H44L50 30Z" fill="#8B6914" />
                        <defs>
                            <linearGradient id="rmfg" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#E8C97A" />
                                <stop offset="50%" stop-color="#C9A84C" />
                                <stop offset="100%" stop-color="#8B6914" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <span class="rm-f-name">RATU MINANG</span>
                </div>
                <p class="rm-f-desc">Restoran masakan Padang premium dengan cita rasa kerajaan Minangkabau, bahan terbaik, dan rempah-rempah asli.</p>
                <div class="rm-f-socials">
                    <a href="#" class="rm-f-social">📘</a>
                    <a href="#" class="rm-f-social">📷</a>
                    <a href="#" class="rm-f-social">🐦</a>
                    <a href="#" class="rm-f-social">📺</a>
                </div>
            </div>
            <div>
                <div class="rm-f-col-title">Menu</div>
                <ul class="rm-f-links">
                    <li><a href="/?kategori=Lauk Utama">Lauk Utama</a></li>
                    <li><a href="/?kategori=Sayuran">Sayuran</a></li>
                    <li><a href="/?kategori=Nasi & Karbohidrat">Nasi & Karbohidrat</a></li>
                    <li><a href="/?kategori=Minuman">Minuman</a></li>
                </ul>
            </div>
            <div>
                <div class="rm-f-col-title">Navigasi</div>
                <ul class="rm-f-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="#katalog-menu">Menu</a></li>
                    <li><a href="/login">Masuk</a></li>
                    <li><a href="/register">Daftar</a></li>
                </ul>
            </div>
            <div>
                <div class="rm-f-col-title">Kontak</div>
                <ul class="rm-f-links">
                    <li><a href="#">Jl. Veteran No.68, Sawah, Sukorame, Kec. Mojoroto </a></li>
                    <li><a href="#">Kota Kediri, Jawa Timur 64114</a></li>
                    <li><a href="#">+62 815-2195-81809</a></li>
                    <li><a href="#">info@ratuminang.co.id</a></li>
                    <li><a href="#">08.00 – 22.00 WIB</a></li>
                </ul>
            </div>
        </div>
        <div class="rm-gold-bar"></div>
        <div class="rm-f-bottom">
            <span class="rm-f-copy">© {{ date('Y') }} Ratu Minang. Hak Cipta Dilindungi.</span>
            <span class="rm-f-copy">Dibuat dengan ✦ untuk kuliner Nusantara</span>
        </div>
    </footer>

</div>{{-- /rm-page --}}

{{-- Toast notifikasi --}}
<div id="rmNotif" style="
  position:fixed;top:86px;right:26px;z-index:9999;
  background:linear-gradient(135deg,#5C0A0A,#3A0E0E);
  border:1px solid #C9A84C;padding:13px 20px;
  font-family:'Cinzel',serif;font-size:11px;letter-spacing:1px;color:#C9A84C;
  transform:translateX(220%);transition:transform 0.5s ease;
  box-shadow:0 8px 28px rgba(0,0,0,0.5);pointer-events:none;
">✦ Ditambahkan!</div>

<script>
    // Particles
    (function() {
        var c = document.getElementById('rmParticles');
        if (!c) return;
        for (var i = 0; i < 20; i++) {
            var p = document.createElement('div');
            p.className = 'rm-particle';
            var s = Math.random() * 4 + 2;
            p.style.cssText = 'width:' + s + 'px;height:' + s + 'px;left:' + (Math.random() * 100) + '%;bottom:' + (Math.random() * 40) + '%;--dur:' + (Math.random() * 4 + 3) + 's;--delay:' + (Math.random() * 4) + 's';
            c.appendChild(p);
        }
    })();

    // Scroll reveal
    (function() {
        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(e) {
                if (e.isIntersecting) {
                    e.target.classList.add('active');
                    obs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.1
        });
        document.querySelectorAll('.rm-reveal').forEach(function(el) {
            obs.observe(el);
        });
    })();

    // Stats counter
    (function() {
        var done = false;
        var obs = new IntersectionObserver(function(entries) {
            if (entries[0].isIntersecting && !done) {
                done = true;
                document.querySelectorAll('[data-target]').forEach(function(el) {
                    var target = +el.dataset.target,
                        cur = 0,
                        step = target / 60;
                    var iv = setInterval(function() {
                        cur = Math.min(cur + step, target);
                        el.textContent = Math.floor(cur) + (target >= 100 ? '+' : '');
                        if (cur >= target) {
                            el.textContent = target + (target >= 100 ? '+' : '');
                            clearInterval(iv);
                        }
                    }, 25);
                });
            }
        }, {
            threshold: 0.3
        });
        var s = document.querySelector('.rm-stats');
        if (s) obs.observe(s);
    })();

    // Add to cart (overlay button) — falls back to normal POST
    function rmAddCart(menuId, menuName) {
        var form = document.getElementById('rmForm' + menuId);
        if (!form) {
            return;
        }
        var meta = document.querySelector('meta[name="csrf-token"]');
        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': meta ? meta.content : '',
                    'Accept': 'application/json'
                },
                body: new FormData(form)
            })
            .then(function() {
                rmNotif('✦ ' + menuName + ' ditambahkan!');
            })
            .catch(function() {
                form.submit();
            });
    }

    function rmNotif(msg) {
        var n = document.getElementById('rmNotif');
        if (!n) return;
        n.textContent = msg;
        n.style.transform = 'translateX(0)';
        setTimeout(function() {
            n.style.transform = 'translateX(220%)';
        }, 2500);
    }
</script>

@endsection