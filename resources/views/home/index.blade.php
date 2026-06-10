@extends('layouts.app')
@section('content')

    {{-- Google Fonts: Montserrat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300&display=swap" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════
           RESET & BASE
        ═══════════════════════════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --c-bg: #0a0a0a;
            --c-surface: #111113;
            --c-card: #161618;
            --c-border: rgba(255, 255, 255, 0.07);
            --c-border2: rgba(255, 255, 255, 0.12);
            --c-text: #e8e8e8;
            --c-muted: #666670;
            --c-dim: #3a3a42;
            --c-accent: #FFD700;
            --c-accent2: #F5A623;
            --c-white: #ffffff;
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 22px;
            --font: 'Montserrat', sans-serif;
            --ease: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        body {
            font-family: var(--font);
            background: var(--c-bg);
            color: var(--c-text);
            font-weight: 300;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        img {
            display: block;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ═══════════════════════════════════════
           HERO
        ═══════════════════════════════════════ */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 640px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ !empty($settings["hero_bg_image"]) ? asset("storage/" . $settings["hero_bg_image"]) : "https://picsum.photos/1920/1080?random=1" }}');
            background-size: cover;
            background-position: center;
            transform: scale(1.04);
            animation: heroScale 14s ease-in-out infinite alternate;
        }

        @keyframes heroScale {
            from { transform: scale(1.04); }
            to   { transform: scale(1.00); }
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(0, 0, 0, 0.80) 0%,
                    rgba(0, 0, 0, 0.42) 55%,
                    rgba(0, 0, 0, 0.22) 100%);
        }

        .hero-overlay2 {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent 58%, rgba(10, 10, 10, 0.96) 100%);
        }

        /* ── KEY FIX: centre content vertically, nudge slightly upward ── */
        .hero-content {
            position: relative;
            z-index: 10;
            flex: 1;
            display: flex;
            align-items: center;          /* was flex-end */
            padding: 5rem 2rem 2rem;      /* top offset accounts for navbar */
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-text {
            max-width: 600px;
            animation: fadeUp 0.9s var(--ease) 0.1s both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--c-accent);
            margin-bottom: 1.25rem;
        }

        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 20px;
            height: 1px;
            background: var(--c-accent);
        }

        .hero-h1 {
            font-size: clamp(2.5rem, 5.5vw, 4.5rem);
            font-weight: 200;
            line-height: 1.08;
            letter-spacing: -0.025em;
            color: var(--c-white);
            margin-bottom: 1.25rem;
        }

        .hero-h1 strong {
            font-weight: 800;
            display: block;
        }

        .hero-sub {
            font-size: 0.875rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.52);
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 420px;
        }

        .hero-ctas {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            flex-wrap: wrap;
        }

        /* ═══════════════════════════════════════
           BUTTONS
        ═══════════════════════════════════════ */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--c-accent);
            color: #000;
            font-family: var(--font);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.7rem 1.4rem;
            border-radius: 24px;
            border: none;
            cursor: pointer;
            transition: background 0.25s, box-shadow 0.25s;
        }

        .btn-primary:hover {
            background: #fff;
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.2);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.07);
            color: var(--c-white);
            font-family: var(--font);
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            padding: 0.7rem 1.4rem;
            border-radius: 24px;
            border: 1px solid var(--c-border2);
            cursor: pointer;
            transition: background 0.25s, border-color 0.25s;
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.11);
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* ═══════════════════════════════════════
           SECTION LABELS & TITLES
        ═══════════════════════════════════════ */
        .s-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--c-accent);
            margin-bottom: 0.625rem;
        }

        .s-label::before {
            content: '';
            display: block;
            width: 14px;
            height: 1px;
            background: var(--c-accent);
        }

        .s-title {
            font-size: clamp(1.5rem, 2.8vw, 2.25rem);
            font-weight: 200;
            color: var(--c-white);
            line-height: 1.1;
            letter-spacing: -0.025em;
        }

        .s-title strong {
            font-weight: 800;
        }

        /* ═══════════════════════════════════════
           STATS BAR
        ═══════════════════════════════════════ */
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            background: var(--c-card);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 1rem;
            position: relative;
            text-align: center;
        }

        .stat-item+.stat-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 22%;
            bottom: 22%;
            width: 1px;
            background: var(--c-border);
        }

        .stat-number {
            font-size: 1.625rem;
            font-weight: 800;
            color: var(--c-white);
            letter-spacing: -0.03em;
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.68rem;
            font-weight: 400;
            color: var(--c-muted);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* ═══════════════════════════════════════
           ABOUT
        ═══════════════════════════════════════ */
        .about-section {
            padding: 5rem 1.5rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .about-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.6rem;
            margin: 1.75rem 0 2rem;
        }

        .about-feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.78rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.58);
        }

        .about-check {
            width: 18px;
            height: 18px;
            background: rgba(255, 215, 0, 0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .about-img-wrap {
            position: relative;
        }

        .about-img-wrap img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: var(--radius-md);
            border: 1px solid var(--c-border);
        }

        .about-badge {
            position: absolute;
            bottom: -1.25rem;
            left: -1.25rem;
            background: var(--c-accent);
            padding: 1.1rem 1.4rem;
            border-radius: var(--radius-sm);
            box-shadow: 0 12px 32px rgba(255, 215, 0, 0.18);
        }

        .about-badge-year {
            font-size: 1.75rem;
            font-weight: 900;
            color: #000;
            line-height: 1;
        }

        .about-badge-label {
            font-size: 0.6rem;
            font-weight: 800;
            color: rgba(0, 0, 0, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        /* ═══════════════════════════════════════
           MARQUEE
        ═══════════════════════════════════════ */
        .marquee-section {
            padding: 2.5rem 0;
            background: var(--c-surface);
            border-top: 1px solid var(--c-border);
            border-bottom: 1px solid var(--c-border);
            overflow: hidden;
            position: relative;
        }

        .marquee-section::before,
        .marquee-section::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100px;
            z-index: 2;
            pointer-events: none;
        }

        .marquee-section::before {
            left: 0;
            background: linear-gradient(to right, var(--c-surface), transparent);
        }

        .marquee-section::after {
            right: 0;
            background: linear-gradient(to left, var(--c-surface), transparent);
        }

        .marquee-track {
            display: flex;
            white-space: nowrap;
            animation: marquee 30s linear infinite;
        }

        @keyframes marquee {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }

        .marquee-item {
            display: inline-flex;
            align-items: center;
            padding: 0 2.5rem;
            flex-shrink: 0;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--c-dim);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            gap: 2.5rem;
        }

        .marquee-dot {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--c-dim);
            flex-shrink: 0;
        }

        /* ═══════════════════════════════════════
           SERVICES
        ═══════════════════════════════════════ */
        .services-section {
            padding: 5rem 1.5rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        .services-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: var(--c-border);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .service-card {
            display: block;
            background: var(--c-card);
            text-decoration: none;
            position: relative;
            overflow: hidden;
            transition: background 0.3s;
        }

        .service-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 2px;
            background: var(--c-accent);
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.4s var(--ease);
        }

        .service-card:hover { background: #1b1b1e; }
        .service-card:hover::before { transform: scaleY(1); }

        .sc-img {
            aspect-ratio: 16/9;
            overflow: hidden;
            background: rgba(255,255,255,0.03);
            display: flex; align-items: center; justify-content: center;
        }

        .sc-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.8;
            transition: opacity 0.4s;
        }

        .service-card:hover .sc-img img { opacity: 1; }

        .sc-body { padding: 1.1rem 1.25rem 1.25rem; }

        .sc-name {
            font-size: 0.825rem;
            font-weight: 700;
            color: var(--c-white);
            margin-bottom: 0.375rem;
            line-height: 1.4;
            transition: color 0.3s;
        }

        .service-card:hover .sc-name { color: var(--c-accent); }

        .sc-desc {
            font-size: 0.72rem;
            font-weight: 300;
            color: var(--c-muted);
            line-height: 1.65;
            margin-bottom: 1rem;
        }

        .sc-link {
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--c-muted);
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            transition: color 0.3s;
        }

        .service-card:hover .sc-link { color: var(--c-accent); }
        .sc-link svg { transition: transform 0.35s var(--ease); }
        .service-card:hover .sc-link svg { transform: translateX(3px); }

        /* ═══════════════════════════════════════
           GALLERY
        ═══════════════════════════════════════ */
        .gallery-section {
            padding: 5rem 1.5rem;
            background: var(--c-surface);
        }

        .gallery-inner { max-width: 1280px; margin: 0 auto; }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto auto;
            gap: 0.75rem;
        }

        .gallery-item {
            display: block;
            border-radius: var(--radius-sm);
            overflow: hidden;
            position: relative;
            background: var(--c-card);
            text-decoration: none;
        }

        .gallery-item.feature { grid-column: span 2; grid-row: span 2; }

        .gallery-item img {
            width: 100%;
            height: 100%;
            min-height: 180px;
            object-fit: cover;
            opacity: 0.82;
            transition: transform 0.55s var(--ease), opacity 0.35s;
        }

        .gallery-item:hover img { transform: scale(1.04); opacity: 1; }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.72) 0%, transparent 55%);
            opacity: 0;
            transition: opacity 0.35s;
            display: flex;
            align-items: flex-end;
            padding: 1.25rem;
        }

        .gallery-item:hover .gallery-overlay { opacity: 1; }

        .gallery-cat {
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--c-accent);
            margin-bottom: 0.2rem;
        }

        .gallery-title { font-size: 0.875rem; font-weight: 700; color: #fff; }

        /* ═══════════════════════════════════════
           ARTICLES
        ═══════════════════════════════════════ */
        .articles-section {
            padding: 5rem 1.5rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        .article-card {
            background: var(--c-card);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-md);
            overflow: hidden;
            text-decoration: none;
            display: block;
            transition: border-color 0.3s;
        }

        .article-card:hover { border-color: rgba(255,255,255,0.14); }
        .article-card:hover .ac-img img { opacity: 1; }

        .ac-img { aspect-ratio: 16/9; overflow: hidden; }

        .ac-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.82;
            transition: opacity 0.35s;
        }

        .ac-body { padding: 1.375rem; }

        .ac-meta {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            margin-bottom: 0.75rem;
        }

        .ac-cat {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            background: rgba(245,166,35,0.1);
            color: var(--c-accent2);
            padding: 0.2rem 0.5rem;
            border-radius: 3px;
        }

        .ac-date { font-size: 0.68rem; color: var(--c-dim); font-weight: 400; }

        .ac-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--c-white);
            line-height: 1.45;
            margin-bottom: 0.625rem;
        }

        .ac-excerpt {
            font-size: 0.75rem;
            font-weight: 300;
            color: var(--c-muted);
            line-height: 1.7;
            margin-bottom: 1.1rem;
        }

        .ac-link {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--c-accent2);
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            letter-spacing: 0.04em;
        }

        /* ═══════════════════════════════════════
           TESTIMONIALS
        ═══════════════════════════════════════ */
        .testi-section {
            padding: 5rem 1.5rem;
            background: var(--c-surface);
            border-top: 1px solid var(--c-border);
        }

        .testi-inner { max-width: 1280px; margin: 0 auto; }

        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        .testi-card {
            background: var(--c-card);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-md);
            padding: 1.75rem;
            transition: border-color 0.3s;
        }

        .testi-card:hover { border-color: rgba(255,255,255,0.14); }

        .testi-stars { display: flex; gap: 0.2rem; margin-bottom: 1rem; }

        .testi-quote {
            font-size: 0.875rem;
            font-weight: 300;
            color: rgba(255,255,255,0.65);
            line-height: 1.8;
            font-style: italic;
            margin-bottom: 1.5rem;
        }

        .testi-footer {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--c-border);
        }

        .testi-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(245,166,35,0.25);
            flex-shrink: 0;
        }

        .testi-name { font-size: 0.825rem; font-weight: 700; color: var(--c-white); }
        .testi-role { font-size: 0.72rem; font-weight: 300; color: var(--c-muted); }

        /* ═══════════════════════════════════════
           CTA BANNER
        ═══════════════════════════════════════ */
        .cta-section {
            padding: 3.5rem 1.5rem;
            background: var(--c-card);
            border-top: 1px solid var(--c-border);
            position: relative;
            overflow: hidden;
        }

        .cta-glow {
            position: absolute;
            top: -80px; right: -80px;
            width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(255,215,0,0.055) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .cta-h2 {
            font-size: clamp(1.25rem, 2.5vw, 1.875rem);
            font-weight: 200;
            line-height: 1.2;
            letter-spacing: -0.02em;
            color: var(--c-white);
            margin-bottom: 0.375rem;
        }

        .cta-h2 strong { font-weight: 800; color: var(--c-accent); }

        .cta-sub {
            font-size: 0.78rem;
            font-weight: 300;
            color: var(--c-muted);
            max-width: 420px;
        }

        .cta-btns { display: flex; gap: 0.75rem; flex-wrap: wrap; flex-shrink: 0; }

        /* helper */
        .link-accent {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--c-accent);
            letter-spacing: 0.04em;
            transition: opacity 0.2s;
        }
        .link-accent:hover { opacity: 0.72; }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 1024px) {
            .services-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 860px) {
            .about-grid { grid-template-columns: 1fr; gap: 2.5rem; }
            .about-badge { bottom: -1rem; left: 0.5rem; }
            .gallery-grid { grid-template-columns: repeat(2, 1fr); }
            .gallery-item.feature { grid-column: span 2; }
            .articles-grid { grid-template-columns: 1fr; }
            .testi-grid { grid-template-columns: 1fr; }
            .stats-bar { grid-template-columns: repeat(2, 1fr); }
            .stat-item:nth-child(3)::before { display: none; }
            .cta-inner { flex-direction: column; align-items: flex-start; }
        }

        @media (max-width: 620px) {
            .hero-h1 { font-size: 2.25rem; }
            .hero-content { padding-top: 4rem; }
            .services-grid { grid-template-columns: 1fr; }
            .gallery-grid { grid-template-columns: 1fr; }
            .gallery-item.feature { grid-column: span 1; grid-row: span 1; }
            .stats-bar { grid-template-columns: repeat(2, 1fr); }
        }
    </style>

    {{-- ═══ HERO ═══ --}}
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="hero-overlay2"></div>

        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-eyebrow">Hoist — Crane — Lift — Maintenance</div>
                <h1 class="hero-h1">
                    {{ $settings['hero_headline'] ?? 'Solusi Angkat' }}
                    <strong>Industri Terpercaya.</strong>
                </h1>
                <p class="hero-sub">{{ $settings['hero_subheadline'] ?? 'Spesialis Hoist, Crane System & Cargo Lift — Melayani Seluruh Indonesia dengan Standar Keselamatan Tertinggi' }}</p>
                <div class="hero-ctas">
                    @if($wa)
                        <button onclick="openOrderModal('Homepage Hero')" class="btn-primary" data-track="wa">
                            {{ $settings['hero_cta_primary'] ?? 'Konsultasi Gratis' }}
                        </button>
                    @endif
                    <a href="{{ route('services') }}" class="btn-ghost">{{ $settings['hero_cta_secondary'] ?? 'Lihat Produk' }} →</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ STATS ═══ --}}
    <div style="max-width:1280px;margin:1.5rem auto;padding:0 1.5rem;" data-aos="fade-up">
        <div class="stats-bar">
            @php $stats = [
                [$settings['stat_years'] ?? '10+', 'Tahun Pengalaman'],
                [$settings['stat_clients'] ?? '28+', 'Klien Industri'],
                [$settings['stat_products'] ?? '12', 'Jenis Produk'],
                [$settings['stat_coverage'] ?? 'Nasional', 'Jangkauan'],
            ]; @endphp
            @foreach($stats as $s)
                <div class="stat-item">
                    <div class="stat-number">{{ $s[0] }}</div>
                    <div class="stat-label">{{ $s[1] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ═══ ABOUT ═══ --}}
    <section class="about-section" data-aos="fade-up">
        <div class="about-grid">
            <div>
                <div class="s-label">Tentang Kami</div>
                <h2 class="s-title">CV. Karya Perdana<br><strong>Teknik</strong></h2>
                <p style="font-size:0.875rem;font-weight:300;color:var(--c-muted);line-height:1.75;margin-top:1.25rem;">
                    {{ $settings['about_text'] ?? 'CV. Karya Perdana Teknik berdiri sejak 2013, bergerak di bidang penyediaan, instalasi, dan perawatan mesin angkat & angkut industri dengan standar keselamatan tertinggi.' }}
                </p>
                <div class="about-features">
                    @foreach(['Produk Berkualitas', 'Garansi After Sales', 'Harga Kompetitif', 'Jangkauan Nasional', 'Tepat Waktu', 'Prioritas K3'] as $f)
                        <div class="about-feature">
                            <div class="about-check">
                                <svg width="9" height="9" fill="none" stroke="#FFD700" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            {{ $f }}
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('about') }}" class="btn-ghost">Profil Lengkap →</a>
            </div>
            <div class="about-img-wrap">
                <img src="{{ !empty($settings['about_image']) ? asset('storage/' . $settings['about_image']) : asset('storage/homepage/gambarabouthome.jpeg') }}"
                     alt="Workshop CV. Karya Perdana Teknik" loading="lazy">
                <div class="about-badge">
                    <div class="about-badge-year">2013</div>
                    <div class="about-badge-label">Berdiri</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ MARQUEE ═══ --}}
    <div class="marquee-section" data-aos="fade-up">
        <div class="marquee-track">
            @foreach(array_merge($clients->toArray(), $clients->toArray()) as $client)
                <span class="marquee-item">
                    {{ $client['name'] }}
                    <span class="marquee-dot"></span>
                </span>
            @endforeach
        </div>
    </div>

    {{-- ═══ SERVICES ═══ --}}
    <section class="services-section" data-aos="fade-up">
        <div class="services-header">
            <div>
                <div class="s-label">Produk &amp; Layanan</div>
                <h2 class="s-title">Solusi Lengkap<br><strong>Mesin Angkat &amp; Angkut</strong></h2>
            </div>
            <a href="{{ route('services') }}" class="link-accent">
                Semua Produk
                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>

        <div class="services-grid" id="services-grid">
            @foreach($services->take(8) as $i => $service)
                <a href="{{ route('services.show', $service->slug) }}" class="service-card"
                   data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 50 }}">
                    <div class="sc-img">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" loading="lazy">
                        @else
                            <svg width="28" height="28" fill="none" stroke="rgba(255,215,0,.1)" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="sc-body">
                        <div class="sc-name">{{ $service->name }}</div>
                        <div class="sc-desc">{{ Str::limit($service->short_desc, 80) }}</div>
                        <span class="sc-link">
                            Detail
                            <svg width="9" height="9" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ═══ GALLERY ═══ --}}
    <section class="gallery-section" data-aos="fade-up">
        <div class="gallery-inner">
            <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
                <div>
                    <div class="s-label">Galeri Proyek</div>
                    <h2 class="s-title">Hasil Kerja Nyata<br><strong>di Lapangan</strong></h2>
                </div>
                <a href="{{ route('gallery') }}" class="link-accent">
                    Lihat Semua
                    <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            <div class="gallery-grid" id="gallery-home-grid">
                @foreach($gallery->take(8) as $i => $item)
                    @php $isFeature = ($i === 0); @endphp
                    <a href="{{ $item->slug ? route('gallery.show', $item->slug) : route('gallery') }}"
                       class="gallery-item {{ $isFeature ? 'feature' : '' }}"
                       data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 50 }}">
                        <img src="{{ $item->image_url }}" alt="{{ $item->alt_text }}" loading="{{ $i < 4 ? 'eager' : 'lazy' }}">
                        <div class="gallery-overlay">
                            <div>
                                @if($item->category)<div class="gallery-cat">{{ $item->category }}</div>@endif
                                <div class="gallery-title">{{ $item->title }}</div>
                                @if($item->client)<div style="font-size:0.68rem;color:rgba(255,255,255,0.5);margin-top:0.15rem;">{{ $item->client }}</div>@endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ ARTICLES ═══ --}}
    <section class="articles-section" data-aos="fade-up">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;">
            <div>
                <div class="s-label">Artikel &amp; Tips</div>
                <h2 class="s-title">Insight dari<br><strong>Tim Ahli Kami</strong></h2>
            </div>
            <a href="{{ route('articles') }}" class="link-accent">Semua Artikel →</a>
        </div>
        <div class="articles-grid">
            @foreach($articles as $i => $article)
                <a href="{{ route('articles.show', $article->slug) }}" class="article-card"
                   data-aos="fade-up" data-aos-delay="{{ $i * 70 }}">
                    <div class="ac-img">
                        <img src="{{ $article->image_url }}" alt="{{ $article->alt_text ?? $article->title }}" loading="lazy">
                    </div>
                    <div class="ac-body">
                        <div class="ac-meta">
                            <span class="ac-cat">{{ $article->category }}</span>
                            <span class="ac-date">{{ $article->formatted_date }}</span>
                        </div>
                        <div class="ac-title">{{ $article->title }}</div>
                        <div class="ac-excerpt">{{ Str::limit($article->excerpt, 110) }}</div>
                        <span class="ac-link">Baca Artikel →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ═══ TESTIMONIALS ═══ --}}
    @if($testimonials->count())
        <section class="testi-section" data-aos="fade-up">
            <div class="testi-inner">
                <div style="text-align:center;margin-bottom:2.5rem;">
                    <div class="s-label" style="justify-content:center;">Testimoni</div>
                    <h2 class="s-title" style="margin-top:0.25rem;"><strong>Kata Klien Kami</strong></h2>
                </div>
                <div class="testi-grid">
                    @foreach($testimonials->take(3) as $t)
                        <div class="testi-card" data-aos="fade-up">
                            <div class="testi-stars">
                                @for($i = 0; $i < 5; $i++)
                                    <svg width="14" height="14" fill="{{ $i < $t->rating ? '#F5A623' : '#222226' }}" viewBox="0 0 24 24">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                @endfor
                            </div>
                            <div class="testi-quote">"{{ $t->content }}"</div>
                            <div class="testi-footer">
                                <img class="testi-avatar" src="{{ $t->photo_url }}" alt="Foto {{ $t->name }}" loading="lazy">
                                <div>
                                    <div class="testi-name">{{ $t->name }}</div>
                                    <div class="testi-role">{{ $t->position ? $t->position . ', ' : '' }}{{ $t->company }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ CTA BANNER ═══ --}}
    <section class="cta-section" data-aos="fade-up">
        <div class="cta-glow"></div>
        <div class="cta-inner">
            <div>
                <div class="s-label" style="margin-bottom:0.625rem;">Siap Bekerja Sama?</div>
                <h2 class="cta-h2">Tingkatkan Efisiensi <strong>Industri Anda</strong></h2>
                <p class="cta-sub">Konsultasi gratis. Solusi terbaik crane, hoist &amp; lift untuk industri Anda.</p>
            </div>
            <div class="cta-btns">
                @if($wa)
                    <a href="{{ $wa->wa_url }}" target="_blank" rel="noopener" class="btn-primary" data-track="wa">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        WhatsApp Sekarang
                    </a>
                @endif
                <a href="tel:+623199171407" class="btn-ghost" data-track="phone">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.9a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                    </svg>
                    031-99171407
                </a>
            </div>
        </div>
    </section>

@endsection