@extends('layouts.app')
@section('content')

<style>
    /* ═══════════════════════════════════════
       DESIGN TOKENS — sama dengan homepage
    ═══════════════════════════════════════ */
    :root {
        --c-bg:      #0a0a0a;
        --c-surface: #111113;
        --c-card:    #161618;
        --c-border:  rgba(255,255,255,0.07);
        --c-border2: rgba(255,255,255,0.12);
        --c-text:    #e8e8e8;
        --c-muted:   #666670;
        --c-dim:     #3a3a42;
        --c-accent:  #FFD700;
        --c-accent2: #F5A623;
        --c-white:   #ffffff;
        --radius-sm: 8px;
        --radius-md: 14px;
        --radius-lg: 22px;
        --font:      'Plus Jakarta Sans', sans-serif;
        --ease:      cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* ═══════════════════════════════════════
       PAGE HERO — mirip homepage about-section
    ═══════════════════════════════════════ */
    .sv-hero {
        position: relative;
        padding: 7rem 1.5rem 4rem;
        background: var(--c-bg);
        overflow: hidden;
    }

    .sv-hero::before {
        content: '';
        position: absolute;
        top: -120px; right: -120px;
        width: 480px; height: 480px;
        background: radial-gradient(circle, rgba(255,215,0,0.045) 0%, transparent 65%);
        pointer-events: none;
    }

    .sv-hero::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 80px;
        background: linear-gradient(to bottom, transparent, #0a0a0a);
        z-index: 1;
    }

    /* Override page-hero::before inside sv-hero (already handled by sv-hero::after) */
    .page-hero.sv-hero::before {
        display: none;
    }

    .sv-hero-inner {
        max-width: 1280px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* breadcrumb */
    .sv-breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.72rem;
        font-weight: 400;
        color: var(--c-dim);
        margin-bottom: 2rem;
        font-family: var(--font);
    }
    .sv-breadcrumb a {
        color: var(--c-dim);
        text-decoration: none;
        transition: color 0.2s;
    }
    .sv-breadcrumb a:hover { color: var(--c-accent); }
    .sv-breadcrumb-sep {
        font-size: 0.6rem;
        color: var(--c-dim);
        opacity: 0.5;
    }
    .sv-breadcrumb-current { color: var(--c-muted); }

    /* label */
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
        font-family: var(--font);
    }
    .s-label::before {
        content: '';
        display: block;
        width: 14px; height: 1px;
        background: var(--c-accent);
    }

    /* title */
    .s-title {
        font-size: clamp(1.75rem, 3.2vw, 2.75rem);
        font-weight: 200;
        color: var(--c-white);
        line-height: 1.1;
        letter-spacing: -0.025em;
        font-family: var(--font);
    }
    .s-title strong { font-weight: 800; }

    /* intro text */
    .sv-intro {
        margin-top: 1.25rem;
        max-width: 620px;
        font-size: 0.875rem;
        font-weight: 300;
        color: var(--c-muted);
        line-height: 1.75;
        font-family: var(--font);
    }

    /* ═══════════════════════════════════════
       SERVICES GRID
    ═══════════════════════════════════════ */
    .sv-section {
        padding: 4rem 1.5rem 6rem;
        max-width: 1280px;
        margin: 0 auto;
    }

    .sv-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1px;
        background: var(--c-border);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    /* service card — identik dengan homepage */
    .sv-card {
        display: block;
        background: var(--c-card);
        text-decoration: none;
        position: relative;
        overflow: hidden;
        transition: background 0.3s;
    }

    .sv-card::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 2px;
        background: var(--c-accent);
        transform: scaleY(0);
        transform-origin: bottom;
        transition: transform 0.4s var(--ease);
    }

    .sv-card:hover { background: #1b1b1e; }
    .sv-card:hover::before { transform: scaleY(1); }

    .sv-card-img {
        aspect-ratio: 16/9;
        overflow: hidden;
        background: rgba(255,255,255,0.03);
        display: flex; align-items: center; justify-content: center;
    }

    .sv-card-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        opacity: 0.8;
        transition: opacity 0.4s, transform 0.5s var(--ease);
    }

    .sv-card:hover .sv-card-img img {
        opacity: 1;
        transform: scale(1.04);
    }

    .sv-card-body { padding: 1.1rem 1.25rem 1.4rem; }

    .sv-card-num {
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--c-accent2);
        margin-bottom: 0.4rem;
        font-family: var(--font);
    }

    .sv-card-name {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--c-white);
        margin-bottom: 0.4rem;
        line-height: 1.4;
        font-family: var(--font);
        transition: color 0.3s;
    }
    .sv-card:hover .sv-card-name { color: var(--c-accent); }

    .sv-card-desc {
        font-size: 0.72rem;
        font-weight: 300;
        color: var(--c-muted);
        line-height: 1.65;
        margin-bottom: 1rem;
        font-family: var(--font);
    }

    .sv-card-link {
        font-size: 0.68rem;
        font-weight: 600;
        color: var(--c-muted);
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        font-family: var(--font);
        transition: color 0.3s;
    }
    .sv-card:hover .sv-card-link { color: var(--c-accent); }
    .sv-card-link svg { transition: transform 0.35s var(--ease); }
    .sv-card:hover .sv-card-link svg { transform: translateX(3px); }

    /* ═══════════════════════════════════════
       CTA BANNER — identik homepage
    ═══════════════════════════════════════ */
    .sv-cta {
        padding: 3.5rem 1.5rem;
        background: var(--c-card);
        border-top: 1px solid var(--c-border);
        position: relative;
        overflow: hidden;
    }

    .sv-cta-glow {
        position: absolute;
        top: -80px; right: -80px;
        width: 320px; height: 320px;
        background: radial-gradient(circle, rgba(255,215,0,0.055) 0%, transparent 70%);
        pointer-events: none;
    }

    .sv-cta-inner {
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

    .sv-cta-h2 {
        font-size: clamp(1.25rem, 2.5vw, 1.875rem);
        font-weight: 200;
        line-height: 1.2;
        letter-spacing: -0.02em;
        color: var(--c-white);
        margin-bottom: 0.375rem;
        font-family: var(--font);
    }
    .sv-cta-h2 strong { font-weight: 800; color: var(--c-accent); }

    .sv-cta-sub {
        font-size: 0.78rem;
        font-weight: 300;
        color: var(--c-muted);
        max-width: 420px;
        font-family: var(--font);
    }

    .sv-cta-btns { display: flex; gap: 0.75rem; flex-wrap: wrap; flex-shrink: 0; }

    /* buttons — sama dengan homepage */
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
        text-decoration: none;
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
        text-decoration: none;
        transition: background 0.25s, border-color 0.25s;
    }
    .btn-ghost:hover {
        background: rgba(255,255,255,0.11);
        border-color: rgba(255,255,255,0.2);
    }

    /* ═══════════════════════════════════════
       RESPONSIVE
    ═══════════════════════════════════════ */
    @media (max-width: 1100px) {
        .sv-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 860px) {
        .sv-grid { grid-template-columns: repeat(2, 1fr); }
        .sv-cta-inner { flex-direction: column; align-items: flex-start; }
    }

    @media (max-width: 480px) {
        .sv-grid { grid-template-columns: 1fr; }
        .sv-hero { padding: 5.5rem 1rem 3rem; }
        .sv-section { padding: 3rem 1rem 4rem; }
    }
</style>

{{-- Removed duplicate font import --}}

{{-- ═══ HERO ═══ --}}
<section class="page-hero sv-hero">
    <div class="sv-hero-inner">

        {{-- Breadcrumb --}}
        <nav class="sv-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sv-breadcrumb-sep">/</span>
            <span class="sv-breadcrumb-current">Produk &amp; Layanan</span>
        </nav>

        <div class="s-label">Produk &amp; Layanan</div>
        <h1 class="s-title">
            Solusi Lengkap Crane,<br>
            <strong>Hoist &amp; Lift Industri</strong>
        </h1>

        {{-- Intro paragraph — penting untuk SEO, bukan thin content --}}
        <p class="sv-intro">
            CV. Karya Perdana Teknik menyediakan {{ $services->count() }} jenis produk dan layanan mesin angkat angkut industri —
            mulai dari overhead crane, chain hoist, wire rope hoist, gantry crane, cargo lift, hingga fabrikasi dan maintenance.
            Melayani industri manufaktur, pergudangan, petrokimia, dan konstruksi di Gresik, Surabaya, Sidoarjo,
            dan seluruh Indonesia sejak 2013.
        </p>

    </div>
</section>

{{-- ═══ SERVICES GRID ═══ --}}
<section class="sv-section" data-aos="fade-up">
    <div class="sv-grid">
        @foreach($services as $i => $service)
            <a href="{{ route('services.show', $service->slug) }}"
               class="sv-card"
               data-aos="fade-up"
               data-aos-delay="{{ ($i % 4) * 60 }}">

                <div class="sv-card-img">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}"
                             alt="{{ $service->name }} - CV. Karya Perdana Teknik"
                             loading="{{ $i < 4 ? 'eager' : 'lazy' }}">
                    @else
                        <svg width="32" height="32" fill="none" stroke="rgba(255,215,0,0.1)" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
                        </svg>
                    @endif
                </div>

                <div class="sv-card-body">
                    <div class="sv-card-num">Produk #{{ str_pad($service->order ?? ($i + 1), 2, '0', STR_PAD_LEFT) }}</div>
                    <h2 class="sv-card-name">{{ $service->name }}</h2>
                    <p class="sv-card-desc">{{ Str::limit($service->short_desc, 90) }}</p>
                    <span class="sv-card-link">
                        Lihat Detail
                        <svg width="9" height="9" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </span>
                </div>

            </a>
        @endforeach
    </div>
</section>

{{-- ═══ CTA BANNER ═══ --}}
<section class="sv-cta" data-aos="fade-up">
    <div class="sv-cta-glow"></div>
    <div class="sv-cta-inner">
        <div>
            <div class="s-label" style="margin-bottom:0.625rem;">Butuh Konsultasi?</div>
            <h2 class="sv-cta-h2">
                Tentukan Produk yang Tepat<br>
                <strong>untuk Industri Anda</strong>
            </h2>
            <p class="sv-cta-sub">
                Tim engineer kami siap membantu memilih solusi crane, hoist &amp; lift
                yang sesuai kebutuhan teknis dan anggaran Anda. Gratis, tanpa tekanan.
            </p>
        </div>
        <div class="sv-cta-btns">
            @php $wa = \App\Models\WaSetting::primary(); @endphp
            @if($wa)
                <button onclick="openOrderModal('Halaman Layanan')" class="btn-primary" data-track="wa">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
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

@endsection