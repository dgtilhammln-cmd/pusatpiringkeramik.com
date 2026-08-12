@extends('layouts.app')

@section('content')
    @push('styles')
        @if(isset($heroSlides) && $heroSlides->count() > 0)
            <link rel="preload" as="image" href="{{ asset('storage/' . $heroSlides->first()->image) }}">
        @elseif(!empty($settings['hero_main_image']))
            <link rel="preload" as="image" href="{{ asset('storage/' . $settings['hero_main_image']) }}">
        @endif
    @endpush
    {{-- ════════════════════════════════════════════════
      HOME PAGE — CV. Bintang Energy Surabaya Cat Industri
      PT. Hiranatha Makmur Sukses | www.ptbiner.co.id
    ════════════════════════════════════════════════ --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* ── NEW HERO ────────────────────────────────── */
    .cv-hero-modern {
        background-color: #FAFAFA;
        padding-top: calc(80px + 3rem);
        padding-bottom: 2rem;
        position: relative;
        overflow: hidden;
        font-family: var(--font);
    }
    
    .cv-hero-bg-block {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 25%;
        background-color: #0A1930; /* Navy Blue */
        z-index: 0;
    }
    
    .cv-hero-grid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
        width: 100%;
        position: relative;
        z-index: 1;
    }
    
    /* Top Section */
    .cv-hero-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        position: relative;
    }
    .cv-hero-top-left {
        max-width: 75%;
    }
    .cv-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 1rem;
        letter-spacing: 0.02em;
    }
    .cv-hero-badge::before {
        content: '';
        width: 25px; height: 1.5px;
        background: #DC2626; /* Red accent */
    }
    .cv-hero-title,
    h2.cv-hero-title {
        font-size: clamp(2.5rem, 3.8vw, 4rem);
        font-weight: 500;
        color: #0A1930; /* Navy Blue */
        line-height: 1.1;
        letter-spacing: -0.02em;
        margin: 0;
    }
    .cv-hero-title span,
    h2.cv-hero-title span {
        font-weight: 700;
    }
    
    /* Static Logo Badge (Just Image, No Pill) */
    .cv-static-logo-badge {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
    }
    .cv-static-logo-badge img {
        height: 60px; /* Besarkan ukuran sesuai request */
        width: auto;
        max-width: 250px;
        object-fit: contain;
    }
    
    /* Middle Section */
    .cv-hero-mid {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
    }
    .cv-hero-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        flex: 1;
        padding-right: 2rem;
        justify-content: flex-start;
        align-items: flex-start;
        align-content: flex-start;
    }
    .cv-hero-tags span {
        font-size: 0.8rem;
        color: #475569;
        font-weight: 500;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .cv-hero-desc {
        font-size: 0.95rem;
        font-weight: 400;
        color: #64748b;
        line-height: 1.6;
        padding-left: 1.5rem;
        border-left: 2px solid #DC2626; /* Red vertical line */
        max-width: 400px;
    }
    
    /* Bottom Section */
    .cv-hero-bottom {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        width: 100%;
        gap: 0;
    }
    .cv-hero-img-wrapper {
        position: relative;
        width: 100%;
        height: 380px;
        border-radius: 16px 16px 0 0;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.18);
        z-index: 1;
    }
    .cv-hero-img {
        width: 100%; height: 100%;
        object-fit: cover;
    }
    /* Stats row — horizontal strip under image */
    .cv-hero-stats-box {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        background: #0A1930;
        border-radius: 0 0 16px 16px;
        overflow: hidden;
        z-index: 2;
    }
    .cv-stat-item {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        padding: 1.25rem 1.5rem;
        border-right: 1px solid rgba(255,255,255,0.06);
    }
    .cv-stat-item:last-child { border-right: none; }
    .cv-stat-row {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
    }
    .cv-stat-val {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        color: #ffffff;
        margin: 0;
        font-variant-numeric: tabular-nums;
    }
    .cv-stat-label {
        font-size: 0.65rem;
        font-weight: 700;
        color: rgba(255,255,255,0.35);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-top: 0.15rem;
    }
    
    /* Sparkles */
    .cv-sparkles {
        position: absolute;
        left: -30px;
        top: 50px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 2;
    }
    .cv-sparkle {
        color: #DC2626;
    }
    
    @media (max-width: 992px) {
        .cv-hero-top { flex-direction: column; gap: 1rem; }
        .cv-hero-top-left { max-width: 100%; }
        .cv-static-logo-badge { display: none !important; }
        .cv-hero-mid { flex-direction: column; align-items: flex-start; gap: 1.5rem; }
        .cv-hero-desc { border-left: none; border-top: 2px solid #DC2626; padding-left: 0; padding-top: 1rem; }
        .cv-hero-img-wrapper { width: 100%; border-radius: 16px 16px 0 0; }
        .cv-hero-stats-box { grid-template-columns: 1fr 1fr 1fr; }
        .cv-hero-bg-block { height: 15%; }
    }
    /* ── PRODUCTS ─────────────────────── */
    .cv-products { background: var(--bg-base); }
    .cv-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }
    .cv-product-card {
        background: var(--bg-base);
        border: 1.5px solid var(--border-1);
        border-radius: 16px;
        padding: 2rem 1.75rem;
        text-decoration: none;
        display: block;
        transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(56,189,248,0.05);
    }
    .cv-product-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #0EA5E9, #38BDF8, #7DD3FC);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .cv-product-card:hover {
        border-color: #38BDF8;
        transform: translateY(-8px);
        box-shadow: 0 32px 80px rgba(56,189,248,0.15), 0 0 0 1px rgba(56,189,248,0.1);
    }
    .cv-product-card:hover::after { transform: scaleX(1); }
    .cv-product-type {
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #0EA5E9;
        margin-bottom: 0.375rem;
    }
    .cv-product-name {
        font-size: 1.375rem;
        font-weight: 900;
        color: var(--text-1);
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }
    .cv-product-size {
        font-size: 0.8125rem;
        font-weight: 400;
        color: var(--text-3);
        margin-bottom: 1.25rem;
    }
    .cv-product-specs {
        border-top: 1px solid var(--border-1);
        padding-top: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
    }
    .cv-spec-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .cv-spec-key {
        font-size: 0.75rem;
        font-weight: 400;
        color: var(--text-3);
    }
    .cv-spec-val {
        font-size: 0.8125rem;
        font-weight: 700;
        color: var(--text-1);
    }
    .cv-spec-val.highlight { color: #0284C7; }
    .cv-product-cta {
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #0EA5E9;
        transition: gap 0.2s;
    }
    .cv-product-card:hover .cv-product-cta { gap: 0.625rem; }

    /* ── ADVANTAGES ───────────────────── */
    .cv-advantages { background: var(--bg-1); }
    .cv-adv-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }
    .cv-adv-card {
        background: var(--bg-base);
        border: 1px solid var(--border-2);
        border-radius: 12px;
        padding: 1.75rem;
        transition: all 0.3s ease;
        color: var(--text-1);
    }
    .cv-adv-card:hover {
        background: var(--bg-2);
        border-color: var(--accent);
        transform: translateY(-4px);
    }
    .cv-adv-icon {
        width: 48px; height: 48px;
        background: var(--bg-2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        color: var(--accent-dark);
    }
    .cv-adv-title {
        font-size: 1rem;
        font-weight: 300;
        color: var(--text-1);
        margin-bottom: 0.5rem;
    }
    .cv-adv-desc {
        font-size: 0.8125rem;
        font-weight: 300;
        color: var(--text-3);
        line-height: 1.65;
    }

    /* ── APPLICATIONS ─────────────────── */
    .cv-apps { background: var(--bg-1); }
    .cv-apps-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-top: 3rem;
    }
    .cv-app-card {
        background: var(--bg-base);
        border: 1.5px solid var(--border-1);
        border-radius: 12px;
        padding: 1.75rem 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    .cv-app-card:hover {
        border-color: var(--accent);
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(56,189,248,0.12);
    }
    .cv-app-emoji {
        font-size: 2.25rem;
        display: block;
        margin-bottom: 0.875rem;
        line-height: 1;
    }
    .cv-app-title {
        font-size: 0.9375rem;
        font-weight: 300;
        color: var(--text-1);
        margin-bottom: 0.375rem;
    }
    .cv-app-desc {
        font-size: 0.75rem;
        font-weight: 300;
        color: var(--text-3);
        line-height: 1.5;
    }

    /* ── GALLERY PREVIEW ──────────────── */
    .cv-gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(2, 220px);
        gap: 1rem;
        margin-top: 3rem;
    }
    .cv-gallery-grid .gallery-item:first-child {
        grid-column: span 2;
        grid-row: span 2;
    }
    .cv-gallery-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--bg-2), var(--bg-3));
        border-radius: 10px;
    }
    .cv-gallery-placeholder-inner {
        text-align: center;
        color: var(--text-3);
    }

    /* ── TESTIMONIALS ─────────────────── */
    .cv-testimonials { background: var(--bg-dark); }
    .cv-testi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }
    .cv-testi-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 16px;
        padding: 2rem;
        position: relative;
    }
    .cv-testi-quote {
        font-size: 2.5rem;
        color: #38BDF8;
        opacity: 0.3;
        line-height: 1;
        margin-bottom: 0.5rem;
        font-family: Georgia, serif;
    }
    .cv-testi-text {
        font-size: 0.875rem;
        font-weight: 300;
        color: rgba(255,255,255,0.65);
        line-height: 1.75;
        margin-bottom: 1.5rem;
        font-style: italic;
    }
    .cv-testi-author {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .cv-testi-avatar {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0EA5E9, #38BDF8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        font-weight: 800;
        color: #fff;
        flex-shrink: 0;
    }
    .cv-testi-name {
        font-size: 0.9375rem;
        font-weight: 300;
        color: #fff;
    }
    .cv-testi-company {
        font-size: 0.75rem;
        font-weight: 300;
        color: rgba(255,255,255,0.45);
    }
    .cv-testi-stars {
        display: flex;
        gap: 2px;
        margin-bottom: 1rem;
    }

    /* ── COVERAGE MAP ─────────────────── */
    .cv-coverage { background: var(--bg-2); }
    .cv-coverage-areas {
        display: flex;
        flex-wrap: wrap;
        gap: 0.625rem;
        margin-top: 2rem;
    }
    .cv-area-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: var(--bg-base);
        border: 1px solid var(--border-1);
        border-radius: 20px;
        padding: 0.4rem 0.875rem;
        font-size: 0.8rem;
        font-weight: 400;
        color: var(--text-2);
        transition: all 0.2s;
    }
    .cv-area-chip:hover {
        border-color: var(--accent);
        color: var(--accent-deep);
        background: var(--accent-glow);
    }
    .cv-area-chip::before {
        content: '';
        width: 5px; height: 5px;
        border-radius: 50%;
        background: #38BDF8;
        flex-shrink: 0;
    }

    /* ── CTA SECTION ──────────────────── */
    .cv-cta {
        background: linear-gradient(135deg, #38BDF8 0%, #0EA5E9 50%, #0284C7 100%);
        position: relative;
        overflow: hidden;
    }
    .cv-cta::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(255,255,255,0.15) 0%, transparent 70%);
        pointer-events: none;
    }
    .cv-cta-inner {
        max-width: 860px;
        margin: 0 auto;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    /* ── ARTICLES ─────────────────────── */
    .cv-articles { background: var(--bg-1); }
    .cv-articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }
    .cv-article-card {
        background: var(--bg-base);
        border: 1.5px solid var(--border-1);
        border-radius: 14px;
        overflow: hidden;
        text-decoration: none;
        display: block;
        transition: all 0.3s ease;
    }
    .cv-article-card:hover {
        border-color: var(--accent);
        transform: translateY(-6px);
        box-shadow: 0 20px 56px rgba(56,189,248,0.12);
    }
    .cv-article-thumb {
        height: 180px;
        background: linear-gradient(135deg, var(--bg-2), var(--bg-3));
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-4);
        font-size: 0.8rem;
    }
    .cv-article-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .cv-article-card:hover .cv-article-thumb img { transform: scale(1.06); }
    .cv-article-body { padding: 1.5rem; }
    .cv-article-cat {
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #0EA5E9;
        margin-bottom: 0.5rem;
    }
    .cv-article-title {
        font-size: 1rem;
        font-weight: 300;
        color: var(--text-1);
        line-height: 1.4;
        margin-bottom: 0.625rem;
    }
    .cv-article-excerpt {
        font-size: 0.8125rem;
        font-weight: 300;
        color: var(--text-3);
        line-height: 1.65;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .cv-article-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.75rem;
        color: var(--text-4);
    }

    /* ── PREMIUM CLIENT BAR ──────────── */
    .cv-clients-section {
        background: #ffffff;
        padding: 3.5rem 0;
        border-top: 1px solid rgba(14,165,233,0.08);
        border-bottom: 1px solid rgba(14,165,233,0.08);
        overflow: hidden;
        position: relative;
    }
    .cv-clients-header {
        max-width: 1200px;
        margin: 0 auto 2.5rem;
        padding: 0 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 0.5rem;
    }
    .cv-clients-label {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #64748B;
    }
    .cv-clients-count {
        font-size: 0.7rem;
        font-weight: 600;
        color: #0EA5E9;
        background: #F0F9FF;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        border: 1px solid rgba(14,165,233,0.15);
    }

    /* Marquee Container */
    .cv-marquee-container {
        width: 100%;
        overflow: hidden;
        position: relative;
        display: flex;
    }
    /* Fade edges */
    .cv-marquee-container::before,
    .cv-marquee-container::after {
        content: '';
        position: absolute;
        top: 0; bottom: 0;
        width: 150px;
        z-index: 2;
        pointer-events: none;
    }
    .cv-marquee-container::before {
        left: 0;
        background: linear-gradient(to right, #ffffff, transparent);
    }
    .cv-marquee-container::after {
        right: 0;
        background: linear-gradient(to left, #ffffff, transparent);
    }

    /* Infinite Animation */
    @keyframes scrollLeft {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .cv-marquee-track {
        display: flex;
        gap: 2rem;
        padding: 1.5rem 1rem;
        width: max-content;
        animation: scrollLeft 40s linear infinite;
    }
    .cv-marquee-container:hover .cv-marquee-track {
        animation-play-state: paused;
    }

    /* Card Design */
    .cv-client-logo-card {
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 16px;
        padding: 1rem 1.75rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        min-width: 180px;
        max-width: 220px;
        height: 110px;
        transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    .cv-client-logo-card:hover {
        border-color: #38BDF8;
        background: #ffffff;
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 12px 30px rgba(14,165,233,0.12);
    }
    .cv-client-logo-img {
        max-height: 52px;
        max-width: 160px;
        width: auto;
        height: auto;
        object-fit: contain;
        filter: grayscale(80%) opacity(0.8);
        transition: all 0.3s;
        display: block;
    }
    .cv-client-logo-card:hover .cv-client-logo-img { filter: grayscale(0%) opacity(1); }
    .cv-client-logo-name {
        font-size: 0.7rem;
        font-weight: 600;
        color: #64748B;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 130px;
    }
    /* Text-only chip */
    .cv-client-chip-v2 {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 16px;
        padding: 0 2rem;
        height: 100px;
        min-width: 160px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        white-space: nowrap;
        transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .cv-client-chip-v2::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #38BDF8;
        flex-shrink: 0;
    }
    .cv-client-chip-v2:hover {
        border-color: #38BDF8;
        background: #ffffff;
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 12px 30px rgba(14,165,233,0.12);
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .cv-hero-grid { grid-template-columns: 1fr 1fr; }
        .cv-hero-right { display: none; }
        .cv-hero-center { height: 420px; }
        .cv-explainer-grid { grid-template-columns: 1fr; }
        .cv-gallery-grid { grid-template-columns: repeat(2, 1fr); grid-template-rows: auto; }
        .cv-gallery-grid .gallery-item:first-child { grid-column: 1; grid-row: 1; }
    }
    @media (max-width: 640px) {
        .cv-hero-modern { padding-top: calc(46px + 1.5rem); }
        .cv-hero-grid { grid-template-columns: 1fr; }
        .cv-hero-center { height: 320px; }
        .cv-gallery-grid { grid-template-columns: 1fr; }
        .cv-products-grid, .cv-adv-grid, .cv-apps-grid { grid-template-columns: 1fr; }
    }
    </style>

        {{-- ════ NEW MODERN HERO ════ --}}
    <section class="cv-hero-modern" id="home">
        <div class="cv-hero-bg-block"></div>
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
                @if(isset($heroSlides) && $heroSlides->count() > 0)
                    @foreach($heroSlides as $slide)
                    <div class="swiper-slide">
                        <div class="cv-hero-grid">
                            
                            {{-- Top Section --}}
                            <div class="cv-hero-top">
                                <div class="cv-hero-top-left">
                                    @if($slide->subtitle)
                                    <div class="cv-hero-badge">{{ $slide->subtitle }}</div>
                                    @endif
                                    
                                    @if($loop->first)
                                    <h1 class="cv-hero-title">
                                        {!! str_replace(['Structural Perfection', 'Innovation', 'structural perfection', 'innovation'], ['<span>Structural Perfection</span>', '<span>Innovation</span>', '<span>structural perfection</span>', '<span>innovation</span>'], nl2br(e($slide->title))) !!}
                                    </h1>
                                    @else
                                    <h2 class="cv-hero-title">
                                        {!! str_replace(['Structural Perfection', 'Innovation', 'structural perfection', 'innovation'], ['<span>Structural Perfection</span>', '<span>Innovation</span>', '<span>structural perfection</span>', '<span>innovation</span>'], nl2br(e($slide->title))) !!}
                                    </h2>
                                    @endif
                                </div>
                                
                                <div class="cv-static-logo-badge d-none d-sm-inline-flex">
                                    @if(!empty($settings['logo']))
                                        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="{{ $settings['company_name'] ?? config('app.name') }}">
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Middle Section --}}
                            <div class="cv-hero-mid">
                                <div class="cv-hero-tags">
                                    @if($slide->tags)
                                        @foreach(explode(',', $slide->tags) as $tag)
                                            <span>{{ trim($tag) }}</span>
                                        @endforeach
                                    @else
                                        <span>General Construction Services</span>
                                        <span>Concrete Work</span>
                                        <span>Design and Planning</span>
                                        <span>Civil Works</span>
                                        <span>Pre-Construction</span>
                                    @endif
                                </div>
                                
                                @if($slide->description)
                                <div class="cv-hero-desc">
                                    {{ $slide->description }}
                                </div>
                                @endif
                            </div>

                            {{-- Bottom Section --}}
                            <div class="cv-hero-bottom">
                                <div class="cv-sparkles d-none d-md-flex">
                                    <svg class="cv-sparkle" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0l2 8 8 2-8 2-2 8-2-8-8-2 8-2 2-8z"/></svg>
                                    <svg class="cv-sparkle" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-left:20px;"><path d="M12 0l2 8 8 2-8 2-2 8-2-8-8-2 8-2 2-8z"/></svg>
                                </div>

                                <div class="cv-hero-img-wrapper">
                                    @if($slide->image)
                                        <img src="{{ asset('storage/' . $slide->image) }}" class="cv-hero-img" alt="{{ $slide->title }}">
                                    @else
                                        <div style="width:100%;height:100%;background:#1E293B;"></div>
                                    @endif
                                </div>

                                <div class="cv-hero-stats-box">
                                    <div class="cv-stat-item">
                                        <div class="cv-stat-row">
                                            <div class="cv-stat-val">{{ $slide->stat_1_value ?? '640+' }}</div>
                                        </div>
                                        <div class="cv-stat-label">{{ $slide->stat_1_label ?? 'Projects Completed' }}</div>
                                    </div>
                                    <div class="cv-stat-item">
                                        <div class="cv-stat-row">
                                            <div class="cv-stat-val">{{ $slide->stat_2_value ?? '25+' }}</div>
                                        </div>
                                        <div class="cv-stat-label">{{ $slide->stat_2_label ?? 'Years of Experience' }}</div>
                                    </div>
                                    <div class="cv-stat-item">
                                        <div class="cv-stat-row">
                                            <div class="cv-stat-val">{{ $slide->stat_3_value ?? '450+' }}</div>
                                        </div>
                                        <div class="cv-stat-label">{{ $slide->stat_3_label ?? 'Happy Customers' }}</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    @endforeach
                @else
                    {{-- Default slide if no slides exist --}}
                    <div class="swiper-slide">
                        <div class="cv-hero-grid">
                            <div class="cv-hero-top">
                                <div class="cv-hero-top-left">
                                    <div class="cv-hero-badge">Award-Winning Construction Excellence</div>
                                    <h1 class="cv-hero-title">Where <span>Innovation</span> Drives<br><span>Structural Perfection</span></h1>
                                </div>
                                <div class="cv-static-logo-badge d-none d-sm-flex">
                                    @if(!empty($settings['logo']))
                                        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logo">
                                    @else
                                        <span class="cv-text-logo">CV. Bintang Energy Surabaya</span>
                                    @endif
                                </div>
                            </div>
                            <div class="cv-hero-mid">
                                <div class="cv-hero-tags">
                                    <span>General Construction Services</span>
                                    <span>Concrete Work</span>
                                    <span>Design and Planning</span>
                                </div>
                                <div class="cv-hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tambahkan slide di admin.</div>
                            </div>
                            <div class="cv-hero-bottom">
                                <div class="cv-sparkles d-none d-md-flex">
                                    <svg class="cv-sparkle" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0l2 8 8 2-8 2-2 8-2-8-8-2 8-2 2-8z"/></svg>
                                    <svg class="cv-sparkle" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-left:20px;"><path d="M12 0l2 8 8 2-8 2-2 8-2-8-8-2 8-2 2-8z"/></svg>
                                </div>
                                <div class="cv-hero-img-wrapper"><div style="width:100%;height:100%;background:#1E293B;"></div></div>
                                <div class="cv-hero-stats-box">
                                    <div class="cv-stat-item">
                                        <div style="display:flex;align-items:center;gap:0.75rem;">
                                            <svg width="28" height="28" fill="none" stroke="#DC2626" stroke-width="2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                                            <div class="cv-stat-val">640+</div>
                                        </div>
                                        <div class="cv-stat-label">Projects Completed</div>
                                    </div>
                                    <div style="width:100%;height:1px;background:rgba(255,255,255,0.1);"></div>
                                    <div class="cv-stat-item">
                                        <div style="display:flex;align-items:center;gap:0.75rem;">
                                            <svg width="28" height="28" fill="none" stroke="#DC2626" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            <div class="cv-stat-val">25+</div>
                                        </div>
                                        <div class="cv-stat-label">Years of Experience</div>
                                    </div>
                                    <div style="width:100%;height:1px;background:rgba(255,255,255,0.1);"></div>
                                    <div class="cv-stat-item">
                                        <div style="display:flex;align-items:center;gap:0.75rem;">
                                            <svg width="28" height="28" fill="none" stroke="#DC2626" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                                            <div class="cv-stat-val">450+</div>
                                        </div>
                                        <div class="cv-stat-label">Happy Customers</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="swiper-pagination hero-swiper-pagination"></div>
        </div>
    </section>

    {{-- ════ PREMIUM CLIENTS BAR ════ --}}
    @if($clients->count())
        <section class="cv-clients-section">
            <div class="cv-clients-header">
                <span class="cv-clients-label">Dipercaya oleh perusahaan terkemuka</span>
            </div>

            <div class="cv-marquee-container">
                <div class="cv-marquee-track">
                    {{-- Loop twice to create seamless infinite scroll effect --}}
                    @foreach([1, 2] as $loopGroup)
                        @foreach($clients as $client)
                            @if($client->logo)
                                <div class="cv-client-logo-card">
                                    <img
                                        src="{{ asset('storage/' . $client->logo) }}"
                                        alt="{{ $client->alt_text ?: $client->name }}"
                                        class="cv-client-logo-img"
                                        title="{{ $client->name }}"
                                        loading="lazy"
                                    >
                                </div>
                            @else
                                <div class="cv-client-chip-v2">{{ $client->name }}</div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ════ ABOUT SECTION (PREMIUM 4 CARDS) ════ --}}
    <section class="cv-about-premium section-pad" id="tentang" style="background:#ffffff; color:#0f172a; position:relative; z-index:2;">
        <div class="container">
            {{-- Section Header --}}
            <div style="text-align:center; max-width:800px; margin:0 auto 4rem;">
                <div style="font-size:0.75rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#64748b; margin-bottom:1.5rem; display:flex; align-items:center; justify-content:center; gap:0.5rem;">
                    <span style="width:4px; height:4px; background:#0A1930; border-radius:50%;"></span>
                    ABOUT US
                </div>

                {{-- Dynamic Heading with Icons --}}
                <h2 style="font-size:clamp(1.75rem, 3.5vw, 3rem); font-weight:500; line-height:1.15; letter-spacing:-0.02em; color:#0A1930;" class="about-premium-heading">
                    {!! !empty($settings['about_heading']) ? $settings['about_heading'] : 'Solusi Cat <span class="ab-icon-dark-red"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg></span> Berkualitas Tinggi untuk <span class="ab-icon-red"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3c-4.97 0-9 4.03-9 9 0 3.18 1.66 6.02 4.14 7.69.41.27.68.73.68 1.22V22h8.36v-1.09c0-.49.27-.95.68-1.22 2.48-1.67 4.14-4.51 4.14-7.69 0-4.97-4.03-9-9-9zM12 18h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg></span> Industri & Maritim' !!}
                </h2>
            </div>


            {{-- 4 Cards Grid --}}
            <div class="about-cards-grid">

                {{-- Card 1: Light Gray (Keywords pattern) --}}
                <div class="ab-card ab-card-gray" data-aos="fade-up" data-aos-delay="0">
                    <div class="ab-card-bg-pattern">
                        <span class="ab-chip" style="top:10%;left:5%;">Cat Industri</span>
                        <span class="ab-chip" style="top:15%;left:45%;">Cat Kapal</span>
                        <span class="ab-chip" style="top:12%;left:80%;">Anti Karat</span>
                        <span class="ab-chip" style="top:35%;left:15%;">Tahan Cuaca</span>
                        <span class="ab-chip" style="top:38%;left:50%;">High Quality</span>
                        <span class="ab-chip" style="top:60%;left:5%;">Cat Jalan</span>
                        <span class="ab-chip" style="top:65%;left:40%;">Protektif</span>
                        <span class="ab-chip" style="top:62%;left:75%;">Warna Presisi</span>
                    </div>
                    <div class="ab-card-content">
                        <div class="ab-card-label">Pengalaman</div>
                        <div class="ab-card-value">{{ date('Y') - (\App\Models\Setting::get('founding_year') ?? 2013) }}+ Tahun</div>
                    </div>
                </div>

                {{-- Card 2: Solid Accent (Navy) --}}
                <div class="ab-card ab-card-accent" data-aos="fade-up" data-aos-delay="100" style="background:#0A1930;">
                    <div class="ab-card-content" style="height: 100%; display: flex; flex-direction: column;">
                        <div class="ab-card-label" style="color:rgba(255,255,255,0.9);">Komitmen Kualitas</div>
                        <div class="ab-card-value" style="color:#ffffff;">100%</div>
                        <div class="ab-card-desc" style="margin-top:auto; color:rgba(255,255,255,0.9);">
                            Memberikan solusi cat dan pelapis terbaik untuk industri Anda.
                        </div>
                    </div>
                </div>

                {{-- Card 3: Image Background --}}
                <div class="ab-card ab-card-image" data-aos="fade-up" data-aos-delay="200">
                    @if(!empty($settings['about_c3_image']))
                        <img src="{{ asset('storage/' . $settings['about_c3_image']) }}" alt="About" class="ab-card-img" width="400" height="400" loading="lazy">
                    @else
                        <div style="position:absolute; inset:0; background:linear-gradient(135deg, #cbd5e1, #94a3b8);"></div>
                    @endif
                    <div class="ab-card-overlay"></div>
                    <div class="ab-card-content" style="position:relative; z-index:2; height:100%; display:flex; flex-direction:column; justify-content:flex-end;">
                        <div class="ab-card-value" style="color:#ffffff; margin-bottom:0.5rem;">500+</div>
                        <div class="ab-card-desc" style="color:rgba(255,255,255,0.9);">
                            Proyek suplai dan pengecatan diselesaikan di seluruh Indonesia.
                        </div>
                    </div>
                </div>

                {{-- Card 4: Light Gray --}}
                <div class="ab-card ab-card-gray" data-aos="fade-up" data-aos-delay="300">
                    <div class="ab-card-content" style="height: 100%; display: flex; flex-direction: column;">
                        <div class="ab-card-label">Distribusi Produk</div>
                        <div class="ab-card-value">1.000+</div>
                        <div class="ab-card-desc" style="margin-top:auto;">
                            Ton cat terdistribusi ke berbagai sektor industri dan maritim.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
    /* CSS FOR PREMIUM ABOUT SECTION */
    .about-premium-heading {
        /* Style specifically for the heading */
    }
    .about-premium-heading strong {
        font-weight: 600;
    }
    .about-premium-heading .ab-icon-dark-red,
    .about-premium-heading .ab-icon-red {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        vertical-align: middle;
        margin: 0 0.1em;
        transform: translateY(-0.1em);
    }
    .about-premium-heading .ab-icon-dark-red {
        background: #ca0000; /* dark red */
        color: #fff;
        padding: 0.2em;
    }
    .about-premium-heading .ab-icon-red {
        background: #ef4444; /* red */
        color: #fff;
        padding: 0.2em;
    }

    .about-cards-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
    }
    @media (min-width: 768px) {
        .about-cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width: 1024px) {
        .about-cards-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .ab-card {
        border-radius: 24px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        min-height: 320px;
        display: flex;
        flex-direction: column;
    }
    .ab-card-gray {
        background: #f1f5f9;
    }
    .ab-card-accent {
        background: #0ea5e9; /* matching hero blue */
    }
    .ab-card-image {
        padding: 2rem;
    }
    .ab-card-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }
    .ab-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 60%);
        z-index: 1;
    }

    .ab-card-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #64748b;
        margin-bottom: 1rem;
    }
    .ab-card-value {
        font-size: 3rem;
        font-weight: 400;
        line-height: 1;
        color: #0f172a;
        letter-spacing: -0.05em;
    }
    .ab-card-desc {
        font-size: 0.95rem;
        line-height: 1.5;
        color: #475569;
        font-weight: 400;
    }

    /* Pattern for Card 1 */
    .ab-card-bg-pattern {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        opacity: 0.6;
    }
    .ab-chip {
        position: absolute;
        background: #ffffff;
        padding: 0.4rem 0.8rem;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 600;
        color: #94a3b8;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        white-space: nowrap;
    }
    .ab-card-gray .ab-card-content {
        position: relative;
        z-index: 1;
        margin-top: auto; /* push text to bottom for card 1 */
    }
    </style>

    {{-- ════ PRODUCTS (CATALOG STYLE) ════ --}}
    <style>
        /* ── PRODUCT CATALOG SECTION ─────────────────── */
        .cv-catalog-section {
            background: #F8FAFC;
            padding: 5rem 0;
        }
        .cv-catalog-header {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 2rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }
        .cv-catalog-title {
            font-size: clamp(1.75rem, 3.5vw, 3rem);
            font-weight: 500;
            color: #0F172A;
            line-height: 1.15;
            letter-spacing: -0.02em;
            max-width: 420px;
        }
        .cv-catalog-right-info {
            max-width: 260px;
            text-align: right;
        }
        .cv-catalog-right-info p {
            font-size: 0.875rem;
            color: #64748B;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }
        .cv-catalog-right-info small {
            font-size: 0.75rem;
            color: #94A3B8;
        }

        /* Horizontal scroll track */
        .cv-catalog-track-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            position: relative;
        }
        .cv-catalog-scroll {
            display: grid;
            grid-template-columns: repeat(5, calc(25% - 0.75rem));
            gap: 1rem;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .cv-catalog-scroll::-webkit-scrollbar { display: none; }

        /* Product Card */
        .cv-cat-card {
            scroll-snap-align: start;
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            min-height: 300px;
            text-decoration: none;
            display: block;
            flex-shrink: 0;
            background: #e2e8f0;
            cursor: pointer;
            transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s;
        }
        .cv-cat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(14, 165, 233, 0.15);
        }
        .cv-cat-card img {
            width: 100%; height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
            transition: transform 0.5s ease;
        }
        .cv-cat-card:hover img { transform: scale(1.06); }

        /* Dark gradient overlay at bottom */
        .cv-cat-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.15) 55%, transparent 100%);
            z-index: 1;
        }
        .cv-cat-card-placeholder {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 0.5rem;
            color: #94a3b8;
        }
        .cv-cat-card-body {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 1.25rem;
            z-index: 2;
        }
        .cv-cat-card-name {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }
        .cv-cat-card-spec {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.7);
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .cv-cat-card-spec span {
            background: rgba(14,165,233,0.85);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
            color: #fff;
        }

        /* Bottom Controls: Button left, Nav arrows right */
        .cv-catalog-footer {
            max-width: 1200px;
            margin: 2rem auto 0;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .cv-catalog-btn-all {
            background: #1E293B;
            color: #fff;
            padding: 0.875rem 2rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }
        .cv-catalog-btn-all:hover {
            background: #0EA5E9;
            transform: translateY(-2px);
        }
        .cv-catalog-nav {
            display: flex;
            gap: 0.5rem;
        }
        .cv-catalog-nav-btn {
            width: 42px; height: 42px;
            border-radius: 50%;
            background: #fff;
            border: 1.5px solid #E2E8F0;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: #334155;
            transition: all 0.2s;
        }
        .cv-catalog-nav-btn:hover {
            background: #0EA5E9;
            border-color: #0EA5E9;
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .cv-catalog-scroll { grid-template-columns: repeat(5, 280px); }
        }
        @media (max-width: 640px) {
            .cv-catalog-section { padding: 3.5rem 0; }
            .cv-catalog-header { flex-direction: column; }
            .cv-catalog-right-info { text-align: left; max-width: 100%; }
            .cv-catalog-scroll { grid-template-columns: repeat(5, 80vw); }
            .cv-cat-card { min-height: 260px; }
        }
    </style>

    <section class="cv-catalog-section" id="produk">

        {{-- Header: Title left, description right --}}
        <div class="cv-catalog-header">
            <h2 class="cv-catalog-title">Katalog Produk<br>Kami</h2>
            <div class="cv-catalog-right-info">
                <p>Solusi cat dan coating premium terpercaya untuk berbagai skala industri di Indonesia.</p>
                <small>Tersedia berbagai varian dan spesifikasi</small>
            </div>
        </div>

        {{-- Cards Track --}}
        <div class="cv-catalog-track-wrapper">
            <div class="cv-catalog-scroll" id="cv-catalog-scroll">
                @php
                    $productData = [
                        ['type' => 'CV-45', 'size' => '18"', 'diameter' => '45 cm', 'capacity' => '52,47', 'slug' => 'cv-45-18'],
                        ['type' => 'CV-60', 'size' => '24"', 'diameter' => '60 cm', 'capacity' => '98,79', 'slug' => 'cv-60-24'],
                        ['type' => 'CV-75', 'size' => '30"', 'diameter' => '75 cm', 'capacity' => '147,95', 'slug' => 'cv-75-30'],
                        ['type' => 'CV-90', 'size' => '36"', 'diameter' => '90 cm', 'capacity' => '215,79', 'slug' => 'cv-90-36'],
                        ['type' => 'CV-105', 'size' => '42"', 'diameter' => '105 cm', 'capacity' => '257,87', 'slug' => 'cv-105-42'],
                    ];
                @endphp

                @if($products->count())
                    @foreach($products as $i => $product)
                        @php $pd = $productData[$i] ?? ['type' => 'CV', 'size' => '', 'diameter' => '', 'capacity' => '', 'slug' => $product->slug]; @endphp
                        <a href="{{ route('products.show', $product->slug) }}" class="cv-cat-card">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy">
                            @elseif($product->category && $product->category->image)
                                <img src="{{ asset('storage/' . $product->category->image) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="cv-cat-card-placeholder">
                                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    <span style="font-size:.7rem;">Upload di Admin</span>
                                </div>
                            @endif
                            <div class="cv-cat-card-overlay"></div>
                            <div class="cv-cat-card-body">
                                <div class="cv-cat-card-name">{{ $product->name }}</div>
                                <div class="cv-cat-card-spec">
                                    <span>{{ $pd['type'] }}</span>
                                    Ø {{ $pd['diameter'] }} — {{ $pd['capacity'] }} m³/mnt
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    @foreach($productData as $i => $pd)
                        <a href="{{ route('products') }}" class="cv-cat-card">
                            <div class="cv-cat-card-placeholder">
                                <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                <span style="font-size:.7rem;">Upload di Admin</span>
                            </div>
                            <div class="cv-cat-card-overlay"></div>
                            <div class="cv-cat-card-body">
                                <div class="cv-cat-card-name">Cat Industri {{ $pd['type'] }}</div>
                                <div class="cv-cat-card-spec">
                                    <span>{{ $pd['type'] }}</span>
                                    Ø {{ $pd['diameter'] }} — {{ $pd['capacity'] }} m³/mnt
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Footer: Button left, Arrows right --}}
        <div class="cv-catalog-footer">
            <a href="{{ route('products') }}" class="cv-catalog-btn-all">
                Ke Katalog Produk
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
            <div class="cv-catalog-nav">
                <button class="cv-catalog-nav-btn" id="cv-scroll-prev" aria-label="Sebelumnya">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <button class="cv-catalog-nav-btn" id="cv-scroll-next" aria-label="Berikutnya">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
            </div>
        </div>
    </section>

    <script>
    (function() {
        var track = document.getElementById('cv-catalog-scroll');
        var prev = document.getElementById('cv-scroll-prev');
        var next = document.getElementById('cv-scroll-next');
        if (!track || !prev || !next) return;
        var scrollAmt = function() {
            var card = track.querySelector('.cv-cat-card');
            return card ? card.offsetWidth + 16 : 260;
        };
        next.addEventListener('click', function() { track.scrollBy({ left: scrollAmt(), behavior: 'smooth' }); });
        prev.addEventListener('click', function() { track.scrollBy({ left: -scrollAmt(), behavior: 'smooth' }); });
    })();
    </script>


    {{-- ════ ADVANTAGES (PREMIUM REDESIGN) ════ --}}
    <style>
    /* ── KEUNGGULAN ───────────────────────────── */
    .cv-adv-premium {
        background: #ffffff;
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }
    .cv-adv-premium::before {
        content: '';
        position: absolute;
        top: -200px; right: -200px;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(14,165,233,0.04) 0%, transparent 70%);
        pointer-events: none;
    }
    .cv-adv-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    /* Header row: label + title left, CTA right */
    .cv-adv-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 2rem;
        margin-bottom: 3.5rem;
        flex-wrap: wrap;
    }
    .cv-adv-section-label {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .cv-adv-section-label::before {
        content: '';
        width: 4px; height: 4px;
        border-radius: 50%;
        background: #0EA5E9;
    }
    .cv-adv-section-title {
        font-size: clamp(2rem, 3.5vw, 3rem);
        font-weight: 500;
        color: #0F172A;
        line-height: 1.15;
        letter-spacing: -0.025em;
    }

    /* Premium 7-card grid — matches about section */
    .cv-adv-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
    }
    /* Special first card: full-height accent (like about card-2) */
    .cv-adv-card-v2 {
        background: #F1F5F9;
        border-radius: 22px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 240px;
        transition: transform 0.3s cubic-bezier(0.22,1,0.36,1), box-shadow 0.3s;
    }
    .cv-adv-card-v2:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(14,165,233,0.1);
    }
    .cv-adv-card-v2.accent {
        background: #0EA5E9;
    }
    .cv-adv-card-v2.accent-dark {
        background: #0F172A;
    }
    .cv-adv-card-icon-wrap {
        width: 48px; height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        flex-shrink: 0;
    }
    .cv-adv-card-icon-wrap.blue-bg { background: #E0F2FE; color: #0EA5E9; }
    .cv-adv-card-icon-wrap.white-bg { background: rgba(255,255,255,0.2); color: #fff; }
    .cv-adv-card-icon-wrap.dark-bg { background: rgba(255,255,255,0.06); color: #38BDF8; }
    .cv-adv-card-num {
        font-size: 2.75rem;
        font-weight: 400;
        line-height: 1;
        letter-spacing: -0.04em;
        color: #0F172A;
        margin-bottom: 0.5rem;
    }
    .cv-adv-card-num.white { color: #fff; }
    .cv-adv-card-num.blue { color: #38BDF8; }
    .cv-adv-card-title {
        font-size: 1rem;
        font-weight: 600;
        color: #0F172A;
        margin-bottom: 0.5rem;
    }
    .cv-adv-card-title.white { color: #fff; }
    .cv-adv-card-title.light { color: rgba(255,255,255,0.9); }
    .cv-adv-card-desc {
        font-size: 0.8125rem;
        line-height: 1.65;
        color: #64748B;
        margin-top: auto;
    }
    .cv-adv-card-desc.white { color: rgba(255,255,255,0.75); }

    /* Responsive */
    @media (max-width: 1024px) { .cv-adv-cards { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) {
        .cv-adv-premium { padding: 3.5rem 0; }
        .cv-adv-cards { 
            grid-template-columns: none !important;
            grid-auto-flow: column;
            grid-auto-columns: 78vw;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 1.5rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            gap: 1rem;
        }
        .cv-adv-cards::-webkit-scrollbar { display: none; }
        .cv-adv-cards > * { scroll-snap-align: start; }
        .cv-adv-card-v2 { min-height: 180px; }
        .cv-adv-card-span-2 { 
            grid-column: auto !important; 
            flex-direction: column !important; 
            align-items: flex-start !important; 
        }
    }

    /* ── APLIKASI ─────────────────────────────── */
    .cv-apps-premium {
        background: #F8FAFC;
        padding: 5rem 0;
    }
    .cv-apps-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .cv-apps-header {
        max-width: 600px;
        margin-bottom: 3rem;
    }
    /* Horizontal scroll row of app cards */
    .cv-apps-grid-v2 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
    }
    .cv-app-card-v2 {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.22,1,0.36,1);
        overflow: hidden;
    }
    .cv-app-img-wrapper-v2 {
        width: 100%;
        aspect-ratio: 4/3;
        overflow: hidden;
        background: #F8FAFC;
    }
    .cv-app-img-wrapper-v2 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .cv-app-card-v2:hover .cv-app-img-wrapper-v2 img { transform: scale(1.05); }
    .cv-app-card-body-v2 {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        flex: 1;
    }
    .cv-app-card-v2:hover {
        border-color: #0EA5E9;
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(14,165,233,0.1);
    }
    .cv-app-icon-circle {
        width: 50px; height: 50px;
        background: #F0F9FF;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0EA5E9;
        flex-shrink: 0;
        transition: all 0.3s;
    }
    .cv-app-card-v2:hover .cv-app-icon-circle {
        background: #0EA5E9;
        color: #fff;
    }
    .cv-app-card-title-v2 {
        font-size: 1.05rem;
        font-weight: 600;
        color: #0F172A;
        margin: 0;
    }
    .cv-app-card-desc-v2 {
        font-size: 0.8125rem;
        color: #64748B;
        line-height: 1.65;
        margin: 0;
    }
    
    @media (max-width: 1024px) { .cv-apps-grid-v2 { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) {
        .cv-apps-premium { padding: 3.5rem 0; }
        .cv-apps-grid-v2 { 
            grid-template-columns: none !important;
            grid-auto-flow: column;
            grid-auto-columns: 78vw;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 1.5rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            gap: 1rem;
        }
        .cv-apps-grid-v2::-webkit-scrollbar { display: none; }
        .cv-apps-grid-v2 > * { scroll-snap-align: start; }
    }
    </style>

    <section class="cv-adv-premium" id="keunggulan">
        <div class="cv-adv-inner">
            {{-- Section Header --}}
            <div class="cv-adv-header">
                <div>
                    <div class="cv-adv-section-label">KEUNGGULAN</div>
                    <h2 class="cv-adv-section-title">Mengapa Pilih<br>CV. Bintang Energy Surabaya?</h2>
                </div>
                <p style="max-width:320px;font-size:0.875rem;color:#64748B;line-height:1.65;text-align:right;">
                    Solusi perlindungan dan pelapisan berkualitas tinggi untuk kebutuhan maritim dan industri skala besar di seluruh Indonesia.
                </p>
            </div>

            {{-- Premium Cards Grid --}}
            <div class="cv-adv-cards">

                {{-- Card 1: Kualitas --}}
                <div class="cv-adv-card-v2 accent" data-aos="fade-up" data-aos-delay="0" style="background:#0F172A;">
                    <div class="cv-adv-card-icon-wrap" style="background:#DC2626;">
                        <svg width="22" height="22" fill="#fff" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="cv-adv-card-num white">#1</div>
                    <div class="cv-adv-card-title white">Kualitas Premium</div>
                    <div class="cv-adv-card-desc white">Menyediakan produk cat dari merk terbaik yang sudah teruji tahan lama dan anti korosi.</div>
                </div>

                {{-- Card 2: Pengiriman --}}
                <div class="cv-adv-card-v2" data-aos="fade-up" data-aos-delay="80">
                    <div class="cv-adv-card-icon-wrap" style="background:#FEE2E2; color:#DC2626;">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
                    </div>
                    <div class="cv-adv-card-title">Cakupan Luas</div>
                    <div class="cv-adv-card-desc">Melayani pengiriman ke seluruh wilayah Indonesia dengan ekspedisi yang terpercaya dan berasuransi.</div>
                </div>

                {{-- Card 3: Resmi --}}
                <div class="cv-adv-card-v2" data-aos="fade-up" data-aos-delay="160">
                    <div class="cv-adv-card-icon-wrap" style="background:#FEE2E2; color:#DC2626;">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    </div>
                    <div class="cv-adv-card-title">Distributor Resmi</div>
                    <div class="cv-adv-card-desc">Produk 100% original, tersertifikasi dan didatangkan langsung dari pabrik resmi.</div>
                </div>

                {{-- Card 4: Kapasitas --}}
                <div class="cv-adv-card-v2 accent-dark" data-aos="fade-up" data-aos-delay="240" style="background:#DC2626;">
                    <div class="cv-adv-card-icon-wrap" style="background:rgba(255,255,255,0.2); color:#fff;">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div class="cv-adv-card-num" style="color:#fff;">B2B</div>
                    <div class="cv-adv-card-title light">Siap Skala Proyek</div>
                    <div class="cv-adv-card-desc white">Memiliki kapasitas besar untuk memenuhi permintaan proyek industri dan kontraktor.</div>
                </div>

                {{-- Card 5: Perlindungan --}}
                <div class="cv-adv-card-v2" data-aos="fade-up" data-aos-delay="0">
                    <div class="cv-adv-card-icon-wrap" style="background:#FEE2E2; color:#DC2626;">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                    </div>
                    <div class="cv-adv-card-title" style="margin-top:auto;">Pelindungan Maksimal</div>
                    <div class="cv-adv-card-desc">Cocok diaplikasikan untuk perlindungan aset maritim maupun industri dari kondisi ekstrim.</div>
                </div>

                {{-- Card 6: Support --}}
                <div class="cv-adv-card-v2" data-aos="fade-up" data-aos-delay="80">
                    <div class="cv-adv-card-icon-wrap" style="background:#FEE2E2; color:#DC2626;">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div class="cv-adv-card-title" style="margin-top:auto;">Layanan Konsultasi</div>
                    <div class="cv-adv-card-desc">Tim kami selalu siap mendampingi Anda dalam memilih jenis cat dan spesifikasi yang paling tepat.</div>
                </div>

                {{-- Card 7: Pengalaman spans 2 columns --}}
                <div class="cv-adv-card-v2 cv-adv-card-span-2" data-aos="fade-up" data-aos-delay="160" style="grid-column: span 2; flex-direction: row; gap: 2rem; align-items: center;">
                    <div class="cv-adv-card-icon-wrap" style="flex-shrink:0; width:60px; height:60px; background:#FEE2E2; color:#DC2626;">
                        <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div>
                        <div class="cv-adv-card-title" style="font-size:1.125rem; margin-bottom:0.5rem;">Berpengalaman Sejak 2007</div>
                        <div class="cv-adv-card-desc">Lebih dari 18 tahun menjadi andalan perusahaan BUMN dan swasta dalam menyuplai produk cat pelindung berstandar internasional.</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ════ APPLICATIONS (PREMIUM REDESIGN) ════ --}}
    <section class="cv-apps-premium" id="aplikasi">
        <div class="cv-apps-inner">
            <div class="cv-apps-header">
                <div class="cv-adv-section-label">APLIKASI</div>
                <h2 class="cv-adv-section-title" style="margin-top:0.75rem;">Cocok untuk<br>Berbagai Industri</h2>
                <p style="margin-top:1rem;font-size:0.875rem;color:#64748B;line-height:1.65;">
                    Produk pelapis dan cat CV. Bintang Energy Surabaya dirancang untuk melindungi beragam aset strategis di berbagai sektor.
                </p>
            </div>

            <div class="cv-apps-grid-v2">
                @php
                    $apps = [
                        [
                            'title' => 'Maritim & Perkapalan',
                            'desc' => 'Perlindungan maksimal lambung kapal dan struktur laut dari korosi air asin yang ekstrem.',
                            'icon' => '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 12h-4l-3-9L9 3l-3 9H2v6h20v-6z"/></svg>',
                            'img' => !empty($settings['app_img_restoran']) ? asset('storage/'.$settings['app_img_restoran']) : asset('images/placeholder-app.jpg')
                        ],
                        [
                            'title' => 'Pabrik & Gudang',
                            'desc' => 'Melindungi lantai pabrik, struktur baja, dan alat berat dengan coating khusus tahan lama.',
                            'icon' => '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/></svg>',
                            'img' => !empty($settings['app_img_pabrik']) ? asset('storage/'.$settings['app_img_pabrik']) : asset('images/placeholder-app.jpg')
                        ],
                        [
                            'title' => 'Struktur Baja',
                            'desc' => 'Cat anti karat terbaik untuk menjaga integritas rangka jembatan dan struktur baja terbuka.',
                            'icon' => '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
                            'img' => !empty($settings['app_img_gor']) ? asset('storage/'.$settings['app_img_gor']) : asset('images/placeholder-app.jpg')
                        ],
                        [
                            'title' => 'Fasilitas Komersial',
                            'desc' => 'Lapisan pelindung yang estetik dan awet untuk pusat perbelanjaan dan gedung komersial.',
                            'icon' => '<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
                            'img' => !empty($settings['app_img_dapur']) ? asset('storage/'.$settings['app_img_dapur']) : asset('images/placeholder-app.jpg')
                        ],
                    ];
                @endphp
                @foreach($apps as $i => $app)
                    <div class="cv-app-card-v2" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                        <div class="cv-app-img-wrapper-v2">
                            <img src="{{ $app['img'] }}" alt="{{ $app['title'] }}" loading="lazy">
                        </div>
                        <div class="cv-app-card-body-v2">
                            <div style="display:flex; align-items:center; gap:1rem;">
                                <div class="cv-app-icon-circle">{!! $app['icon'] !!}</div>
                                <h3 class="cv-app-card-title-v2">{{ $app['title'] }}</h3>
                            </div>
                            <p class="cv-app-card-desc-v2">{{ $app['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ════ PREMIUM GALLERY & TESTIMONIALS CSS ════ --}}
    <style>
    /* ── GALERI ─────────────────────────────── */
    .cv-gallery-premium {
        background: #ffffff;
        padding: 5rem 0;
    }
    .cv-gallery-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .cv-gallery-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 2rem;
        margin-bottom: 3.5rem;
        flex-wrap: wrap;
    }
    .cv-gallery-grid-v2 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    .cv-gallery-card-v2 {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        aspect-ratio: 4/3;
        display: block;
        background: #F1F5F9;
    }
    .cv-gallery-img-v2 {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.22,1,0.36,1);
    }
    .cv-gallery-card-v2:hover .cv-gallery-img-v2 {
        transform: scale(1.08);
    }
    .cv-gallery-overlay-v2 {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0) 60%);
        display: flex;
        align-items: flex-end;
        padding: 1.5rem;
        transition: background 0.3s;
    }
    .cv-gallery-card-v2:hover .cv-gallery-overlay-v2 {
        background: linear-gradient(to top, rgba(14,165,233,0.9) 0%, rgba(15,23,42,0) 70%);
    }
    .cv-gallery-meta-v2 {
        color: #fff;
        transform: translateY(10px);
        transition: transform 0.3s cubic-bezier(0.22,1,0.36,1);
    }
    .cv-gallery-card-v2:hover .cv-gallery-meta-v2 {
        transform: translateY(0);
    }
    .cv-gallery-title-v2 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .cv-gallery-client-v2 {
        font-size: 0.8125rem;
        color: rgba(255,255,255,0.75);
    }

    /* ── TESTIMONI ──────────────────────────── */
    .cv-testi-premium {
        background: #F8FAFC;
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }
    .cv-testi-premium::before {
        content: '';
        position: absolute;
        bottom: -200px; left: -200px;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(14,165,233,0.04) 0%, transparent 70%);
        pointer-events: none;
    }
    .cv-testi-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .cv-testi-grid-v2 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    .cv-testi-card-v2 {
        background: #ffffff;
        border: 1.5px solid #E2E8F0;
        border-radius: 20px;
        padding: 2.25rem;
        position: relative;
        transition: all 0.3s cubic-bezier(0.22,1,0.36,1);
    }
    .cv-testi-card-v2:hover {
        border-color: #0EA5E9;
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(14,165,233,0.1);
    }
    .cv-testi-quote-icon {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        color: #F1F5F9;
        width: 48px;
        height: 48px;
        transition: color 0.3s;
    }
    .cv-testi-card-v2:hover .cv-testi-quote-icon {
        color: #E0F2FE;
    }
    .cv-testi-stars-v2 {
        display: flex;
        gap: 0.25rem;
        color: #F59E0B;
        margin-bottom: 1.25rem;
    }
    .cv-testi-text-v2 {
        font-size: 0.9375rem;
        line-height: 1.7;
        color: #475569;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }
    .cv-testi-author-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        border-top: 1px solid #F1F5F9;
        padding-top: 1.25rem;
    }
    .cv-testi-avatar-v2 {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: #F1F5F9;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        font-weight: 600;
        object-fit: cover;
    }
    .cv-testi-name-v2 {
        font-size: 0.9375rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 0.15rem;
    }
    .cv-testi-pos-v2 {
        font-size: 0.75rem;
        color: #64748B;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .cv-gallery-grid-v2 { grid-template-columns: repeat(2, 1fr); }
        .cv-testi-grid-v2 { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .cv-gallery-premium, .cv-testi-premium { padding: 3.5rem 0; }
        .cv-gallery-grid-v2, .cv-testi-grid-v2 { 
            grid-template-columns: none !important;
            grid-auto-flow: column;
            grid-auto-columns: 78vw;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 1.5rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            gap: 1rem;
        }
        .cv-gallery-grid-v2::-webkit-scrollbar, .cv-testi-grid-v2::-webkit-scrollbar { display: none; }
        .cv-gallery-grid-v2 > *, .cv-testi-grid-v2 > * { scroll-snap-align: start; }
    }
    </style>

    {{-- ════ GALLERY PREVIEW (PREMIUM) ════ --}}
    @if($gallery->count())
        <section class="cv-gallery-premium" id="galeri">
            <div class="cv-gallery-inner">
                <div class="cv-gallery-header">
                    <div>
                        <div class="cv-adv-section-label">GALERI INSTALASI</div>
                        <h2 class="cv-adv-section-title" style="margin-top:0.75rem;">Bukti Nyata<br>di Lapangan</h2>
                    </div>
                    <a href="{{ route('gallery') }}" class="btn-ghost" style="color:#0F172A; border-color:#E2E8F0; background:#F8FAFC;">
                        Lihat Semua Galeri
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>

                <div class="cv-gallery-grid-v2">
                    @foreach($gallery->take(6) as $item)
                        <a href="{{ asset('storage/' . $item->image) }}" class="cv-gallery-card-v2 glightbox" data-gallery="home-gallery" data-title="{{ $item->title }}" data-description="{{ $item->client }}">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->alt_text ?? $item->title }}" class="cv-gallery-img-v2" loading="lazy">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#94A3B8;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    <span style="font-size:0.7rem;margin-top:0.5rem;">Upload Foto</span>
                                </div>
                            @endif
                            <div class="cv-gallery-overlay-v2">
                                <div class="cv-gallery-meta-v2">
                                    <div class="cv-gallery-title-v2">{{ $item->title }}</div>
                                    @if($item->client)<div class="cv-gallery-client-v2">{{ $item->client }}</div>@endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ════ TESTIMONIALS (PREMIUM) ════ --}}
    @include('components.testimonials')

    {{-- ════ PREMIUM COVERAGE CSS ════ --}}
    <style>
    .cv-coverage-premium {
        background: #EAEBED;
        padding: 6rem 0 0;
        position: relative;
    }
    .cv-coverage-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
        position: relative;
        z-index: 2;
    }
    .cv-coverage-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        margin-bottom: 3rem;
    }
    .cv-coverage-title-v2 {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 600;
        color: #0F172A;
        line-height: 1.1;
        letter-spacing: -0.04em;
        flex-shrink: 0;
        min-width: 220px;
    }
    .cv-coverage-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        flex: 1;
    }
    .cv-stat-card-v2 {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s;
    }
    .cv-stat-card-v2:hover {
        transform: translateY(-5px);
    }
    .cv-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }
    .cv-stat-label {
        font-size: 0.65rem;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    .cv-stat-icon {
        color: #0F172A;
        opacity: 0.8;
    }
    .cv-stat-val {
        font-size: 4rem;
        font-weight: 400;
        color: #0EA5E9;
        line-height: 1;
        letter-spacing: -0.05em;
        display: flex;
        align-items: baseline;
        gap: 0.1em;
    }
    .cv-stat-val span {
        color: #0EA5E9;
        font-size: 2rem;
        font-weight: 600;
        line-height: 1;
    }

    /* Abstract Map BG */
    .cv-coverage-map-bg {
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120%;
        min-width: 1000px;
        opacity: 0.6;
        z-index: 1;
        pointer-events: none;
    }

    /* Glassmorphism Bottom Box */
    .cv-coverage-glass-box {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 24px;
        padding: 3rem;
        margin-top: 8rem;
    }
    .cv-glass-box-title {
        font-size: 2.2rem;
        font-weight: 500;
        color: #0F172A;
        margin-bottom: 2rem;
        letter-spacing: -0.04em;
    }
    .cv-cities-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    .cv-city-item {
        font-size: 0.9rem;
        color: #1E293B;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .cv-city-item::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: transparent;
        border: 1.5px solid #94A3B8;
    }
    .cv-city-item.active::before {
        background: #0EA5E9;
        border-color: #0EA5E9;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .cv-coverage-header-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 2rem;
        }
    }
    @media (max-width: 1024px) {
        .cv-coverage-stats-grid { grid-template-columns: repeat(2, 1fr); }
        .cv-cities-grid { grid-template-columns: repeat(3, 1fr); }
        .cv-coverage-glass-box { margin-top: 4rem; }
    }
    @media (max-width: 640px) {
        .cv-coverage-premium { padding: 4rem 0; }
        .cv-coverage-stats-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .cv-stat-card-v2 { padding: 1.25rem; }
        .cv-stat-val { font-size: 2.5rem; }
        .cv-stat-val span { font-size: 1.5rem; }
        .cv-cities-grid { grid-template-columns: repeat(2, 1fr); }
        .cv-coverage-glass-box { padding: 2rem 1.5rem; margin-top: 3rem; }
    }
    .cv-coverage-map-wrapper {
        position: relative;
        width: 100%;
        margin-top: -6rem;
    }
    @media (max-width: 1024px) {
        .cv-coverage-map-wrapper { margin-top: -2rem; }
    }
    @media (max-width: 640px) {
        .cv-coverage-map-wrapper { margin-top: 1rem; }
    }
    </style>

    {{-- ════ COVERAGE (PREMIUM REDESIGN) ════ --}}
    <section class="cv-coverage-premium" id="jangkauan">


        <style>
        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.5); opacity: 0; }
            100% { transform: scale(1); opacity: 0; }
        }
        </style>

        <div class="cv-coverage-inner">
            <div class="cv-coverage-header-row">
                <h2 class="cv-coverage-title-v2">Melayani<br>seluruh Indonesia</h2>

                <div class="cv-coverage-stats-grid">
                    {{-- Card 1 --}}
                    <div class="cv-stat-card-v2" data-aos="fade-up" data-aos-delay="0">
                        <div class="cv-stat-top">
                            <span class="cv-stat-label">Berdiri Sejak</span>
                            <svg class="cv-stat-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 22h20M12 2v20M5 22V10l7-8 7 8v12M8 14h8M8 18h8"/></svg>
                        </div>
                        <div class="cv-stat-val"><span class="count-up" data-target="{{ \App\Models\Setting::get('founding_year') ?? '2013' }}">0</span></div>
                    </div>

                    {{-- Card 2 --}}
                    <div class="cv-stat-card-v2" data-aos="fade-up" data-aos-delay="100">
                        <div class="cv-stat-top">
                            <span class="cv-stat-label">Klien Aktif</span>
                            <svg class="cv-stat-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 7a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                        </div>
                        <div class="cv-stat-val"><span class="count-up" data-target="500">0</span><span>+</span></div>
                    </div>

                    {{-- Card 3 --}}
                    <div class="cv-stat-card-v2" data-aos="fade-up" data-aos-delay="200">
                        <div class="cv-stat-top">
                            <span class="cv-stat-label">Kota Dilayani</span>
                            <svg class="cv-stat-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div class="cv-stat-val"><span class="count-up" data-target="50">0</span><span>+</span></div>
                    </div>

                    {{-- Card 4 --}}
                    <div class="cv-stat-card-v2" data-aos="fade-up" data-aos-delay="300">
                        <div class="cv-stat-top">
                            <span class="cv-stat-label">Tahun Garansi</span>
                            <svg class="cv-stat-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                        </div>
                        <div class="cv-stat-val"><span class="count-up" data-target="15">0</span><span>+</span></div>
                    </div>
                </div>
            </div>

        {{-- MAP: from admin upload --}}
        @php $coverageMap = \App\Models\Setting::get('coverage_map'); @endphp
        @if($coverageMap)
            <div class="cv-coverage-map-wrapper">
                <img src="{{ asset('storage/'.$coverageMap) }}" alt="Peta Jangkauan Indonesia"
                     style="display:block; width:100%; height:auto;" loading="lazy">
            </div>
        @endif

        </div>{{-- end cv-coverage-inner --}}
        
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.count-up');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if(entry.isIntersecting) {
                        const el = entry.target;
                        if (el.classList.contains('counted')) return;
                        el.classList.add('counted');
                        const target = +el.getAttribute('data-target');
                        const duration = 2000;
                        const frameRate = 30;
                        const totalFrames = Math.round((duration / 1000) * frameRate);
                        let frame = 0;
                        const counter = setInterval(() => {
                            frame++;
                            const progress = frame / totalFrames;
                            // Ease out quad
                            const easeOut = progress * (2 - progress);
                            const current = Math.round(target * easeOut);
                            el.innerText = current;
                            if (frame === totalFrames) {
                                clearInterval(counter);
                                el.innerText = target;
                            }
                        }, 1000 / frameRate);
                    }
                });
            }, { threshold: 0.5 });
            
            counters.forEach(c => observer.observe(c));
        });
        </script>
    </section>

    {{-- ════ PREMIUM CTA & ARTICLES CSS ════ --}}
    <style>
    /* ── CTA PREMIUM ────────────────────────── */
    .cv-cta-premium {
        background: #0F172A;
        position: relative;
        overflow: hidden;
        padding: 6rem 0;
        color: #ffffff;
    }
    .cv-cta-bg-glow {
        position: absolute;
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, rgba(14,165,233,0.15) 0%, transparent 60%);
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }
    .cv-cta-inner-v2 {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        padding: 0 1.5rem;
    }
    .cv-cta-title-v2 {
        font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: 500;
        letter-spacing: -0.03em;
        line-height: 1.15;
        margin-bottom: 1.5rem;
        color: #ffffff !important;
    }
    .cv-cta-desc-v2 {
        font-size: 1.125rem;
        color: rgba(255,255,255,0.7);
        line-height: 1.6;
        margin-bottom: 3rem;
    }
    .cv-cta-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .cv-cta-btn-primary {
        background: #0EA5E9;
        color: #ffffff;
        padding: 1.125rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s;
        box-shadow: 0 10px 25px rgba(14,165,233,0.3);
        text-decoration: none !important;
    }
    .cv-cta-btn-primary:hover {
        background: #0284C7;
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(14,165,233,0.4);
    }
    .cv-cta-btn-outline {
        background: transparent;
        color: #ffffff;
        border: 1.5px solid rgba(255,255,255,0.3);
        padding: 1.125rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s;
        text-decoration: none !important;
    }
    .cv-cta-btn-outline:hover {
        border-color: #ffffff;
        background: rgba(255,255,255,0.1);
        transform: translateY(-3px);
    }
    .cv-cta-info {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
        gap: 3rem;
        flex-wrap: wrap;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 3rem;
    }
    .cv-cta-info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: rgba(255,255,255,0.6);
        font-size: 0.875rem;
    }
    .cv-cta-info-icon {
        color: #0EA5E9;
    }

    /* ── ARTIKEL PREMIUM ────────────────────── */
    .cv-articles-premium {
        background: #ffffff;
        padding: 6rem 0;
    }
    .cv-articles-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .cv-articles-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 2rem;
        margin-bottom: 3.5rem;
        flex-wrap: wrap;
    }
    .cv-articles-grid-v2 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }
    .cv-article-card-v2 {
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 24px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.22,1,0.36,1);
        text-decoration: none !important;
    }
    .cv-article-card-v2 * {
        text-decoration: none !important;
    }
    .cv-article-card-v2:hover {
        border-color: #0EA5E9;
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(14,165,233,0.08);
    }
    .cv-article-img-wrap {
        width: 100%;
        aspect-ratio: 16/10;
        overflow: hidden;
        position: relative;
    }
    .cv-article-img-v2 {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.22,1,0.36,1);
    }
    .cv-article-card-v2:hover .cv-article-img-v2 {
        transform: scale(1.08);
    }
    .cv-article-cat-badge {
        position: absolute;
        top: 1.25rem; left: 1.25rem;
        background: rgba(15,23,42,0.85);
        backdrop-filter: blur(8px);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.4rem 1rem;
        border-radius: 50px;
    }
    .cv-article-content-v2 {
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .cv-article-title-v2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0F172A !important;
        line-height: 1.4;
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .cv-article-excerpt-v2 {
        font-size: 0.9375rem;
        color: #64748B !important;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }
    .cv-article-meta-v2 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #E2E8F0;
        padding-top: 1.25rem;
        font-size: 0.8125rem;
        font-weight: 600;
    }
    .cv-article-date-v2 {
        color: #94A3B8;
    }
    .cv-article-read-v2 {
        color: #0EA5E9;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .cv-article-read-v2 svg {
        transition: transform 0.3s;
    }
    .cv-article-card-v2:hover .cv-article-read-v2 svg {
        transform: translateX(4px);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .cv-articles-grid-v2 { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .cv-cta-premium, .cv-articles-premium { padding: 4rem 0; }
        .cv-cta-info { gap: 1.5rem; flex-direction: column; align-items: center; }
        .cv-articles-grid-v2 { 
            grid-template-columns: none !important;
            grid-auto-flow: column;
            grid-auto-columns: 78vw;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 1.5rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            gap: 1rem;
        }
        .cv-articles-grid-v2::-webkit-scrollbar { display: none; }
        .cv-articles-grid-v2 > * { scroll-snap-align: start; }
    }
    </style>

    {{-- ════ CTA STRIP (PREMIUM) ════ --}}
    <section class="cv-cta-premium">
        <div class="cv-cta-bg-glow"></div>
        <div class="cv-cta-inner-v2" data-aos="zoom-in">
            <div style="font-size:0.75rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#38BDF8; margin-bottom:1rem; display:flex; align-items:center; justify-content:center; gap:0.5rem;">
                <span style="width:4px; height:4px; background:#38BDF8; border-radius:50%;"></span>
                SIAP MULAI?
            </div>
            <h2 class="cv-cta-title-v2" style="margin-top:1rem;">Dapatkan Konsultasi Gratis<br>& Penawaran Terbaik</h2>
            <p class="cv-cta-desc-v2">Tim kami siap membantu Anda memilih produk cat dan pelapis yang paling sesuai untuk kebutuhan industri dan proyek Anda.</p>
            
            <div class="cv-cta-buttons">
                @if($wa)
                    <a href="javascript:void(0)" onclick="openOrderModal('Bottom CTA WA')"
                       class="cv-cta-btn-primary" data-track="Bottom CTA WA">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Chat WhatsApp
                    </a>
                @endif
                <a href="{{ route('contact') }}" class="cv-cta-btn-outline">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,12 2,6"/></svg>
                    Form Konsultasi
                </a>
            </div>
            
            <div class="cv-cta-info">
                <div class="cv-cta-info-item">
                    <svg class="cv-cta-info-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.5 12.05a19.79 19.79 0 01-3.07-8.67A2 2 0 012.41 1.5h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 9.4a16 16 0 006.69 6.69l1.27-.76a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    021-22523334
                </div>
                <div class="cv-cta-info-item">
                    <svg class="cv-cta-info-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Senin–Sabtu 08.00–18.00 WIB
                </div>
                <div class="cv-cta-info-item">
                    <svg class="cv-cta-info-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Kalideres, Jakarta Barat
                </div>
            </div>
        </div>
    </section>


    {{-- ════ ARTICLES (PREMIUM) ════ --}}
    @if($articles->count())
        <section class="cv-articles-premium" id="artikel">
            <div class="cv-articles-inner">
                <div class="cv-articles-header">
                    <div>
                        <div style="font-size:0.75rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#64748b; margin-bottom:1.5rem; display:flex; align-items:center; gap:0.5rem;">
                            <span style="width:4px; height:4px; background:#0ea5e9; border-radius:50%;"></span>
                            ARTIKEL &amp; TIPS
                        </div>
                        <h2 style="font-size:clamp(2rem, 4vw, 3.5rem); font-weight:500; line-height:1.15; letter-spacing:-0.03em; color:#0f172a !important; margin-top:0; margin-bottom:0;">
                            Panduan Ventilasi Udara
                        </h2>
                    </div>
                    <a href="{{ route('articles') }}" class="btn-ghost" style="color:#0F172A !important; border-color:#E2E8F0; background:#F8FAFC; text-decoration:none !important;">
                        Semua Artikel 
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>

                <div class="cv-articles-grid-v2">
                    @foreach($articles as $i => $article)
                        <a href="{{ route('articles.show', $article->slug) }}" class="cv-article-card-v2" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                            <div class="cv-article-img-wrap">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="cv-article-img-v2" loading="lazy">
                                @else
                                    <div style="width:100%;height:100%;background:#E2E8F0;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#94A3B8;">
                                        <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                        <span style="font-size:0.75rem;margin-top:0.5rem;font-weight:600;">Artikel CV. Bintang Energy Surabaya</span>
                                    </div>
                                @endif
                                <div class="cv-article-cat-badge">{{ $article->category ?? 'Tips Ventilasi' }}</div>
                            </div>
                            
                            <div class="cv-article-content-v2">
                                <h3 class="cv-article-title-v2">{{ $article->title }}</h3>
                                <p class="cv-article-excerpt-v2">{{ $article->excerpt }}</p>
                                
                                <div class="cv-article-meta-v2">
                                    <span class="cv-article-date-v2">{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</span>
                                    <span class="cv-article-read-v2">
                                        Baca
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@include('components.lightbox-assets')

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if(document.querySelector('.hero-swiper')) {
            new Swiper('.hero-swiper', {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.hero-swiper-pagination',
                    clickable: true,
                },
            });
        }
    });
</script>

@endsection
