@extends('layouts.app')
@section('content')

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════
           DESIGN TOKENS (sama persis homepage)
        ═══════════════════════════════════════ */
        *,
        *::before,
        *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --c-bg: #080808;
            --c-surface: #101010;
            --c-card: #161618;
            --c-border:  rgba(255,255,255,0.07);
            --c-border2: rgba(255,255,255,0.12);
            --c-text:    #FFFFFF;
            --c-muted:   #A0A0A8;
            --c-dim:     #3a3a42;
            --c-accent:  #FFD700;
            --c-accent2: #E6C200;
            --c-white:   #ffffff;
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 22px;
            --font: 'Inter','Plus Jakarta Sans', sans-serif;
            --ease: cubic-bezier(0.25,0.46,0.45,0.94);
        }

        body {
            font-family: var(--font);
            background: var(--c-bg);
            color: var(--c-text);
            font-weight: 300;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        img { display: block; }
        a   { text-decoration: none; color: inherit; }

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

        .s-title strong { font-weight: 800; }

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
            box-shadow: 0 6px 20px rgba(255,215,0,0.2);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.07);
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
            background: rgba(255,255,255,0.11);
            border-color: rgba(255,255,255,0.2);
        }

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
           PAGE HERO (service)
        ═══════════════════════════════════════ */
        .page-hero {
            position: relative;
            padding: 5rem 1.5rem 4rem;
            background: var(--c-surface);
            border-bottom: 1px solid var(--c-border);
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -120px; right: -120px;
            width: 480px; height: 480px;
            background: radial-gradient(circle, rgba(255,215,0,0.055) 0%, transparent 68%);
            pointer-events: none;
        }

        .page-hero-inner {
            max-width: 1280px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* ═══════════════════════════════════════
           BREADCRUMB
        ═══════════════════════════════════════ */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            font-weight: 400;
            color: var(--c-muted);
            flex-wrap: wrap;
            margin-bottom: 1.75rem;
        }

        .breadcrumb a { color: var(--c-muted); transition: color 0.2s; }
        .breadcrumb a:hover { color: var(--c-accent); }
        .breadcrumb-sep { color: var(--c-dim); }
        .breadcrumb-current { color: var(--c-text); }

        /* ═══════════════════════════════════════
           MAIN CONTENT LAYOUT
        ═══════════════════════════════════════ */
        .service-layout {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4rem 1.5rem 5rem;
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 4rem;
            align-items: start;
        }

        /* ═══════════════════════════════════════
           SERVICE IMAGE
        ═══════════════════════════════════════ */
        .service-img-wrap {
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--c-border);
            aspect-ratio: 16/9;
            margin-bottom: 2.5rem;
        }

        .service-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.88;
            transition: opacity 0.4s;
        }

        .service-img-wrap:hover img { opacity: 1; }

        /* ═══════════════════════════════════════
           ARTICLE CONTENT (rich text dari CMS)
        ═══════════════════════════════════════ */
        .article-content {
            color: rgba(255,255,255,0.68);
            font-size: 0.9rem;
            font-weight: 300;
            line-height: 1.82;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4 {
            color: var(--c-white);
            font-weight: 700;
            line-height: 1.25;
            margin: 2rem 0 0.875rem;
            letter-spacing: -0.015em;
        }

        .article-content h2 { font-size: 1.2rem; }
        .article-content h3 { font-size: 1rem; }

        .article-content p { margin-bottom: 1.1rem; }

        .article-content ul,
        .article-content ol {
            margin: 0.875rem 0 1.1rem 1.25rem;
        }

        .article-content li { margin-bottom: 0.4rem; }

        .article-content strong { color: var(--c-white); font-weight: 700; }

        .article-content a {
            color: var(--c-accent2);
            border-bottom: 1px solid rgba(245,166,35,0.3);
            transition: border-color 0.2s;
        }

        .article-content a:hover { border-color: var(--c-accent2); }

        .article-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            font-size: 0.82rem;
        }

        .article-content th {
            background: var(--c-card);
            color: var(--c-accent);
            font-weight: 700;
            font-size: 0.68rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.75rem 1rem;
            border: 1px solid var(--c-border);
            text-align: left;
        }

        .article-content td {
            padding: 0.75rem 1rem;
            border: 1px solid var(--c-border);
            color: rgba(255,255,255,0.65);
        }

        .article-content tr:nth-child(even) td { background: rgba(255,255,255,0.015); }

        /* ═══════════════════════════════════════
           SIDEBAR
        ═══════════════════════════════════════ */
        .sidebar {
            position: sticky;
            top: 5.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .sidebar-card {
            background: var(--c-card);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-md);
            padding: 1.75rem;
            transition: border-color 0.3s;
        }

        .sidebar-card:hover { border-color: var(--c-border2); }

        .sidebar-card-title {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--c-accent2);
            margin-bottom: 1rem;
        }

        .sidebar-desc {
            font-size: 0.82rem;
            font-weight: 300;
            color: var(--c-muted);
            line-height: 1.7;
            margin-bottom: 1.25rem;
        }

        .sidebar-btns { display: flex; flex-direction: column; gap: 0.625rem; }
        .sidebar-btns .btn-primary,
        .sidebar-btns .btn-ghost { justify-content: center; width: 100%; }

        /* Related products */
        .related-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--c-border);
            color: var(--c-text);
            font-size: 0.825rem;
            font-weight: 400;
            transition: color 0.2s;
        }

        .related-item:last-child { border-bottom: none; padding-bottom: 0; }
        .related-item:first-child { padding-top: 0; }
        .related-item:hover { color: var(--c-accent); }

        .related-arrow {
            flex-shrink: 0;
            color: var(--c-accent);
            transition: transform 0.25s var(--ease);
        }

        .related-item:hover .related-arrow { transform: translateX(3px); }

        /* Related Products Grid (Bottom) */
        .related-grid-card {
            display: flex;
            flex-direction: column;
            background: var(--c-card);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-md);
            overflow: hidden;
            transition: border-color 0.3s, transform 0.3s var(--ease);
        }

        .related-grid-card:hover {
            border-color: var(--c-border2);
            transform: translateY(-4px);
        }

        .related-grid-img {
            aspect-ratio: 16/9;
            overflow: hidden;
            border-bottom: 1px solid var(--c-border);
        }

        .related-grid-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
            transition: opacity 0.3s, transform 0.5s var(--ease);
        }

        .related-grid-card:hover img {
            opacity: 1;
            transform: scale(1.05);
        }

        .related-grid-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .related-grid-title {
            font-size: 1rem;
            color: var(--c-white);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .related-grid-desc {
            font-size: 0.8rem;
            color: var(--c-muted);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .related-grid-link {
            margin-top: auto;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--c-accent);
            display: flex;
            align-items: center;
            gap: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ═══════════════════════════════════════
           FAQ SECTION
        ═══════════════════════════════════════ */
        .faq-section {
            padding: 5rem 1.5rem;
            background: var(--c-surface);
            border-top: 1px solid var(--c-border);
        }

        .faq-inner { max-width: 800px; margin: 0 auto; }

        .faq-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .faq-item {
            background: var(--c-card);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-sm);
            margin-bottom: 0.625rem;
            overflow: hidden;
            transition: border-color 0.3s;
        }

        .faq-item:hover { border-color: var(--c-border2); }

        .faq-item.open { border-color: rgba(255,215,0,0.15); }

        .faq-trigger {
            width: 100%;
            text-align: left;
            padding: 1.125rem 1.375rem;
            background: none;
            border: none;
            color: var(--c-white);
            font-family: var(--font);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            line-height: 1.45;
            transition: color 0.2s;
        }

        .faq-item.open .faq-trigger { color: var(--c-accent); }

        .faq-icon {
            flex-shrink: 0;
            width: 22px; height: 22px;
            background: rgba(255,215,0,0.07);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, transform 0.3s var(--ease);
        }

        .faq-item.open .faq-icon {
            background: rgba(255,215,0,0.14);
            transform: rotate(45deg);
        }

        .faq-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.38s var(--ease);
        }

        .faq-body-inner {
            padding: 0 1.375rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 300;
            color: var(--c-muted);
            line-height: 1.78;
        }

        /* ═══════════════════════════════════════
           CTA BANNER (sama kayak homepage)
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

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 1024px) {
            .service-layout {
                grid-template-columns: 1fr 300px;
                gap: 2.5rem;
            }
        }

        @media (max-width: 860px) {
            .service-layout {
                grid-template-columns: 1fr;
                gap: 2rem;
                padding: 2.5rem 1.25rem 3.5rem;
            }

            .sidebar { position: static; }

            .cta-inner { flex-direction: column; align-items: flex-start; }
        }

        @media (max-width: 560px) {
            .page-hero { padding: 3.5rem 1.25rem 2.5rem; }

            .hero-ctas-service { flex-direction: column; }
            .hero-ctas-service .btn-primary,
            .hero-ctas-service .btn-ghost { justify-content: center; }
        }
    </style>

    {{-- ═══ PAGE HERO ═══ --}}
    <div class="page-hero" data-aos="fade-up">
        <div class="page-hero-inner">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span class="breadcrumb-sep">/</span>
                <a href="{{ route('services') }}">Produk &amp; Layanan</a>
                <span class="breadcrumb-sep">/</span>
                <span class="breadcrumb-current">{{ $service->name }}</span>
            </nav>

            <div class="s-label">Produk &amp; Layanan</div>
            <h1 class="s-title" style="font-size:clamp(1.75rem,3.5vw,2.75rem);max-width:720px;">
                {{ $service->name }}
            </h1>
            <p style="margin-top:1rem;max-width:580px;font-size:0.9rem;font-weight:300;color:var(--c-muted);line-height:1.72;">
                {{ $service->short_desc }}
            </p>

            <div class="hero-ctas-service" style="margin-top:2rem;display:flex;gap:0.875rem;flex-wrap:wrap;">
                @if($wa)
                    <button onclick="openOrderModal('Konsultasi Produk: {{ addslashes($service->name) }}')" class="btn-primary" data-track="wa">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Konsultasi Produk Ini
                    </button>
                @endif
                <a href="{{ route('services') }}" class="btn-ghost">← Semua Produk</a>
            </div>
        </div>
    </div>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <div class="service-layout" data-aos="fade-up">

        {{-- KIRI: gambar + konten rich text --}}
        <div>
            <div class="service-img-wrap">
                <img src="{{ $service->image_url }}"
                     alt="{{ $service->name }} - Cyclevent"
                     loading="lazy">
            </div>

            <div class="article-content">
                {!! $service->description !!}
            </div>
        </div>

        {{-- KANAN: sidebar --}}
        <aside class="sidebar">

            {{-- Konsultasi --}}
            <div class="sidebar-card">
                <div class="sidebar-card-title">Konsultasi Gratis</div>
                <p class="sidebar-desc">
                    Hubungi tim teknis kami untuk penawaran terbaik dan konsultasi spesifikasi produk.
                </p>
                <div class="sidebar-btns">
                    @if($wa)
                        <button onclick="openOrderModal('Layanan: {{ addslashes($service->name) }}')" class="btn-primary" style="width:100%;justify-content:center;" data-track="wa">
                            <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            WhatsApp Sekarang
                        </button>
                    @endif
                    <a href="tel:+623199171407" class="btn-ghost" data-track="phone">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.9a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                        031-99171407
                    </a>
                </div>
            </div>

        </aside>
    </div>


    {{-- ═══ RELATED SERVICES GRID ═══ --}}
    @if($related->count())
    <section class="related-section" data-aos="fade-up" style="padding: 4rem 1.5rem; background: var(--c-bg); border-top: 1px solid var(--c-border);">
        <div style="max-width: 1280px; margin: 0 auto;">
            <div class="s-label">Eksplorasi</div>
            <h2 class="s-title" style="margin-bottom: 2.5rem; font-size: clamp(1.5rem, 2.5vw, 2rem);">Produk & Layanan <strong>Lainnya</strong></h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                @foreach($related as $r)
                <a href="{{ route('services.show', $r->slug) }}" class="related-grid-card">
                    <div class="related-grid-img">
                        <img src="{{ $r->image_url }}" alt="{{ $r->name }}" loading="lazy">
                    </div>
                    <div class="related-grid-content">
                        <h3 class="related-grid-title">{{ $r->name }}</h3>
                        <p class="related-grid-desc">{{ $r->short_desc }}</p>
                        <div class="related-grid-link">
                            Lihat Detail
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                        </div>
                    </div>
                </a>
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
                    <button onclick="openOrderModal('Konsultasi Layanan: {{ addslashes($service->name) }}')" class="btn-primary" data-track="wa">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        WhatsApp Sekarang
                    </button>
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

    <script>
        function toggleFaq(i) {
            const wrap = document.getElementById('faq-wrap-' + i);
            const body = document.getElementById('faq-body-' + i);
            const btn  = wrap.querySelector('.faq-trigger');
            const isOpen = wrap.classList.contains('open');

            // tutup semua dulu
            document.querySelectorAll('.faq-item.open').forEach(function(el) {
                el.classList.remove('open');
                el.querySelector('.faq-body').style.maxHeight = null;
                el.querySelector('.faq-trigger').setAttribute('aria-expanded', 'false');
            });

            // buka yg diklik (kalau belum open)
            if (!isOpen) {
                wrap.classList.add('open');
                body.style.maxHeight = body.scrollHeight + 'px';
                btn.setAttribute('aria-expanded', 'true');
            }
        }
    </script>

@endsection