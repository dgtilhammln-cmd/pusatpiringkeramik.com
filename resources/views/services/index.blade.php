@extends('layouts.app')
@section('content')

<style>
    /* ═══════════════════════════════════════
       DESIGN TOKENS
    ═══════════════════════════════════════ */
    :root {
        --c-bg:      #ffffff;
        --c-surface: #F8FAFC;
        --c-card:    #ffffff;
        --c-border:  #E2E8F0;
        --c-text:    #0F172A;
        --c-muted:   #64748B;
        --c-accent:  #0F172A;
        --c-accent-hover: #1E293B;
        --c-white:   #ffffff;
        --radius-sm: 8px;
        --radius-md: 14px;
        --radius-lg: 24px;
        --font:      'Montserrat', sans-serif;
        --ease:      cubic-bezier(0.22, 1, 0.36, 1);
    }
    body { background-color: var(--c-bg); }

    /* PAGE HERO */
    .sv-hero-premium {
        position: relative;
        padding: 9rem 1.5rem 5rem;
        background: var(--c-surface);
        overflow: hidden;
        border-bottom: 1px solid var(--c-border);
    }
    .sv-hero-premium::before {
        content: '';
        position: absolute;
        top: -150px; right: -100px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(14,165,233,0.06) 0%, transparent 70%);
        pointer-events: none; border-radius: 50%;
    }
    .sv-hero-premium::after {
        content: '';
        position: absolute;
        bottom: -150px; left: -100px;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(14,165,233,0.04) 0%, transparent 70%);
        pointer-events: none; border-radius: 50%;
    }
    .sv-hero-inner {
        max-width: 1200px; margin: 0 auto;
        position: relative; z-index: 2; text-align: center;
    }
    .sv-breadcrumb {
        display: flex; align-items: center; justify-content: center;
        gap: 0.5rem; font-size: 0.75rem; font-weight: 500;
        color: var(--c-muted); margin-bottom: 2.5rem; font-family: var(--font);
    }
    .sv-breadcrumb a { color: var(--c-muted); text-decoration: none; transition: color 0.2s; }
    .sv-breadcrumb a:hover { color: var(--c-accent); }
    .sv-breadcrumb-sep { font-size: 0.6rem; color: var(--c-muted); opacity: 0.5; }
    .sv-breadcrumb-current { color: var(--c-text); font-weight: 600; }
    .sv-label {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 0.5rem; font-size: 0.75rem; font-weight: 700;
        letter-spacing: 0.15em; text-transform: uppercase;
        color: var(--c-muted); margin-bottom: 1.25rem; font-family: var(--font);
    }
    .sv-label::before {
        content: ''; display: block;
        width: 5px; height: 5px;
        background: #0F172A; border-radius: 50%;
    }
    .sv-title {
        font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: 500; color: var(--c-text);
        line-height: 1.15; letter-spacing: -0.03em;
        font-family: var(--font); margin-bottom: 1.5rem;
        max-width: 800px; margin-left: auto; margin-right: auto;
    }
    .sv-intro {
        margin: 0 auto; max-width: 650px;
        font-size: 1rem; font-weight: 400;
        color: var(--c-muted); line-height: 1.7; font-family: var(--font);
    }

    /* FILTER TABS */
    .sv-filter-wrap {
        background: var(--c-white);
        border-bottom: 1px solid var(--c-border);
        position: sticky; top: 70px; z-index: 100;
    }
    .sv-filter-inner {
        max-width: 1200px; margin: 0 auto;
        padding: 0 1.5rem;
        display: flex; align-items: center; gap: 0.5rem;
        overflow-x: auto; scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        cursor: grab;
    }
    .sv-filter-inner:active { cursor: grabbing; }
    .sv-filter-tab {
        flex-shrink: 0;
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 1rem 1.25rem;
        font-size: 0.8125rem; font-weight: 600;
        font-family: var(--font); color: var(--c-muted);
        border-bottom: 2px solid transparent;
        text-decoration: none !important;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .sv-filter-tab:hover { color: var(--c-accent); border-bottom-color: rgba(14,165,233,0.3); }
    .sv-filter-tab.active { color: var(--c-accent); border-bottom-color: var(--c-accent); }
    .sv-filter-tab .tab-count {
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--c-surface);
        color: var(--c-muted);
        font-size: 0.65rem; font-weight: 700;
        padding: 0.15rem 0.45rem;
        border-radius: 20px;
        transition: all 0.2s;
    }
    .sv-filter-tab.active .tab-count {
        background: rgba(14,165,233,0.1);
        color: var(--c-accent);
    }

    /* GRID */
    .sv-section {
        padding: 3rem 1.5rem 7rem;
        max-width: 1200px; margin: 0 auto; background: var(--c-bg);
    }
    .sv-grid-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 2rem; flex-wrap: wrap; gap: 0.75rem;
    }
    .sv-grid-count {
        font-size: 0.875rem; font-weight: 500; color: var(--c-muted);
        font-family: var(--font);
    }
    .sv-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    /* SERVICE CARD */
    .sv-card {
        display: flex; flex-direction: column;
        background: var(--c-card);
        border: 1.5px solid var(--c-border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        text-decoration: none !important;
        transition: all 0.4s var(--ease);
        position: relative;
        outline: none !important;
    }
    .sv-card * { text-decoration: none !important; }
    .sv-card:hover, .sv-card:focus {
        border-color: #10B981 !important;
        outline: none !important;
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
    }
    .sv-card-img {
        width: 100%; aspect-ratio: 16/10;
        overflow: hidden; position: relative;
        background: var(--c-surface);
    }
    .sv-card-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s var(--ease);
    }
    .sv-card:hover .sv-card-img img { transform: scale(1.08); }

    /* CARD OVERLAY BADGES */
    .sv-card-badge-top {
        position: absolute; top: 12px; left: 12px; right: 12px;
        display: flex; justify-content: space-between; align-items: center;
        gap: 6px; z-index: 3; pointer-events: none;
    }
    .sv-card-rating-badge {
        background: rgba(15, 23, 42, 0.82);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        color: #ffffff; font-size: 0.72rem; font-weight: 600;
        padding: 4px 10px; border-radius: 20px;
        display: inline-flex; align-items: center; gap: 4px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .sv-rating-star { color: #F59E0B; }
    .sv-rating-sep { opacity: 0.4; margin: 0 1px; }
    .sv-sold-val { color: #E2E8F0; font-weight: 500; }
    .sv-card-price-badge {
        background: #0F172A; color: #ffffff;
        font-size: 0.78rem; font-weight: 700;
        padding: 4px 10px; border-radius: 20px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        margin-left: auto;
    }

    .sv-card-body {
        padding: 1.75rem; display: flex;
        flex-direction: column; flex-grow: 1;
    }
    .sv-card-cat {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: rgba(14, 165, 233, 0.08);
        color: var(--c-accent);
        font-size: 0.65rem; font-weight: 700;
        letter-spacing: 0.1em; text-transform: uppercase;
        padding: 0.35rem 0.75rem; border-radius: 20px;
        margin-bottom: 1rem; align-self: flex-start;
        font-family: var(--font);
    }
    .sv-card-cat svg { width: 10px; height: 10px; }
    .sv-card-name {
        font-size: 1.1rem; font-weight: 700;
        color: var(--c-text); margin-bottom: 0.75rem;
        line-height: 1.4; font-family: var(--font);
        transition: color 0.3s;
    }
    .sv-card:hover .sv-card-name { color: var(--c-accent); }
    .sv-card-desc {
        font-size: 0.9rem; font-weight: 400;
        color: var(--c-muted); line-height: 1.6;
        margin-bottom: 1.5rem; font-family: var(--font); flex-grow: 1;
    }
    .sv-card-link {
        font-size: 0.8125rem; font-weight: 600;
        color: var(--c-accent);
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-family: var(--font); transition: gap 0.3s;
        border-top: 1px solid var(--c-border);
        padding-top: 1.25rem; margin-top: auto;
    }
    .sv-card:hover .sv-card-link { gap: 0.75rem; }

    /* EMPTY STATE */
    .sv-empty {
        grid-column: 1/-1;
        text-align: center; padding: 5rem 1rem;
        color: var(--c-muted); font-family: var(--font);
    }
    .sv-empty svg { width: 48px; height: 48px; margin: 0 auto 1rem; opacity: 0.3; }
    .sv-empty h3 { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--c-text); }

    /* PAGINATION */
    .sv-pagination {
        display: flex; align-items: center; justify-content: center;
        gap: 0.5rem; margin-top: 4rem; font-family: var(--font);
        flex-wrap: wrap;
    }
    .sv-pagination a,
    .sv-pagination span {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 40px; height: 40px; padding: 0 0.75rem;
        border-radius: var(--radius-sm);
        font-size: 0.875rem; font-weight: 600;
        border: 1.5px solid var(--c-border);
        text-decoration: none !important;
        transition: all 0.2s;
        color: var(--c-muted);
    }
    .sv-pagination a:hover { border-color: var(--c-accent); color: var(--c-accent); }
    .sv-pagination .active-page,
    .sv-pagination [aria-current] {
        background: var(--c-accent); border-color: var(--c-accent);
        color: white !important;
    }
    .sv-pagination .disabled { opacity: 0.4; pointer-events: none; }

    /* CTA BANNER */
    .sv-cta-premium {
        background: var(--c-surface); padding: 5rem 1.5rem;
        border-top: 1px solid var(--c-border);
        position: relative; overflow: hidden;
    }
    .sv-cta-glow {
        position: absolute; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 800px; height: 800px;
        background: radial-gradient(circle, rgba(14,165,233,0.06) 0%, transparent 60%);
        pointer-events: none;
    }
    .sv-cta-inner {
        max-width: 1000px; margin: 0 auto;
        text-align: center; position: relative; z-index: 1;
    }
    .sv-cta-h2 {
        font-size: clamp(1.75rem, 3vw, 2.5rem);
        font-weight: 500; line-height: 1.2;
        letter-spacing: -0.02em; color: var(--c-text);
        margin-bottom: 1rem; font-family: var(--font);
    }
    .sv-cta-sub {
        font-size: 1rem; font-weight: 400; color: var(--c-muted);
        max-width: 600px; margin: 0 auto 2.5rem; line-height: 1.6; font-family: var(--font);
    }
    .sv-cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
    .btn-primary-v2 {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: var(--c-accent); color: var(--c-white);
        font-family: var(--font); font-size: 0.9375rem; font-weight: 600;
        padding: 1rem 2rem; border-radius: 50px; border: none;
        cursor: pointer; text-decoration: none !important; transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(14,165,233,0.25);
    }
    .btn-primary-v2:hover {
        background: var(--c-accent-hover); transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(14,165,233,0.35); color: var(--c-white) !important;
    }
    .btn-outline-v2 {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: transparent; color: var(--c-text);
        font-family: var(--font); font-size: 0.9375rem; font-weight: 600;
        padding: 1rem 2rem; border-radius: 50px;
        border: 1.5px solid var(--c-border);
        cursor: pointer; text-decoration: none !important; transition: all 0.3s;
    }
    .btn-outline-v2:hover { border-color: var(--c-text); color: var(--c-text) !important; }

    /* RESPONSIVE */
    @media (max-width: 1024px) { .sv-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 640px) {
        .sv-grid { grid-template-columns: 1fr; }
        .sv-hero-premium { padding: 7rem 1rem 4rem; }
        .sv-section { padding: 2rem 1rem 5rem; }
        .sv-cta-premium { padding: 4rem 1rem; }
        .sv-cta-btns { flex-direction: column; width: 100%; }
        .btn-primary-v2, .btn-outline-v2 { width: 100%; justify-content: center; }
    }
</style>

@php
    $currentCat = $activeCategory ?? ($categories->firstWhere('slug', request('category')));
@endphp

{{-- ═══ HERO ═══ --}}
<section class="sv-hero-premium">
    <div class="sv-hero-inner" data-aos="fade-up">
        <nav class="sv-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="sv-breadcrumb-sep">/</span>
            @if($currentCat)
                <a href="{{ route('products') }}">Produk &amp; Layanan</a>
                <span class="sv-breadcrumb-sep">/</span>
                <span class="sv-breadcrumb-current">{{ $currentCat->name }}</span>
            @else
                <span class="sv-breadcrumb-current">Produk &amp; Layanan</span>
            @endif
        </nav>

        <div class="sv-label">{{ $settings['page_product_hero_label'] ?? 'Katalog Produk' }}</div>
        <h1 class="sv-title">
            @if($currentCat)
                {{ $currentCat->name }}
            @else
                {!! nl2br(e($settings['page_product_hero_title'] ?? 'Katalog Piring Keramik & Tableware Berkualitas')) !!}
            @endif
        </h1>

        <p class="sv-intro">
            @if($currentCat)
                {{ $currentCat->description ?? 'Temukan berbagai pilihan produk ' . $currentCat->name . ' berkualitas tinggi dari ' . $companyName . '.' }}
            @else
                {{ $settings['page_product_hero_desc'] ?? 'Jelajahi koleksi piring keramik, mangkuk, cangkir, dan perlengkapan meja makan dari UD. Sukses Makmur untuk resto, hotel, cafe, dan rumah tangga.' }}
            @endif
        </p>
    </div>
</section>

{{-- ═══ FILTER TABS ═══ --}}
<div class="sv-filter-wrap">
    <div class="sv-filter-inner">
        <a href="{{ route('products') }}"
           class="sv-filter-tab {{ !$currentCat ? 'active' : '' }}"
           id="filter-all">
            Semua Produk
            <span class="tab-count">{{ \App\Models\Service::active()->count() }}</span>
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('products.category', $cat->slug) }}"
               class="sv-filter-tab {{ ($currentCat && $currentCat->slug === $cat->slug) ? 'active' : '' }}"
               id="filter-{{ $cat->slug }}">
                {{ $cat->name }}
                <span class="tab-count">{{ $cat->services()->where('is_active', true)->count() }}</span>
            </a>
        @endforeach
    </div>
</div>

{{-- ═══ PRODUCTS GRID ═══ --}}
<section class="sv-section">
    <div class="sv-grid-header">
        <p class="sv-grid-count">
            Menampilkan <strong>{{ $services->firstItem() ?? 0 }}–{{ $services->lastItem() ?? 0 }}</strong>
            dari <strong>{{ $services->total() }}</strong> produk
        </p>
    </div>

    <div class="sv-grid">
        @forelse($services as $i => $service)
            <a href="{{ route('products.show', $service->slug) }}"
               class="sv-card"
               data-aos="fade-up"
               data-aos-delay="{{ ($i % 3) * 100 }}">

                <div class="sv-card-img">
                    <img src="{{ $service->image_url }}"
                         alt="{{ $service->alt_text }}"
                         loading="{{ $i < 6 ? 'eager' : 'lazy' }}"
                         style="width:100%;height:100%;object-fit:cover;">

                    @if(($service->rating && $service->rating > 0) || !empty($service->sold_count) || ($service->price && $service->price > 0))
                        <div class="sv-card-badge-top">
                            @if(($service->rating && $service->rating > 0) || !empty($service->sold_count))
                                <div class="sv-card-rating-badge">
                                    @if($service->rating && $service->rating > 0)
                                        <span class="sv-rating-star">★</span>
                                        <span class="sv-rating-val">{{ number_format($service->rating, 1) }}</span>
                                    @endif
                                    @if(($service->rating && $service->rating > 0) && !empty($service->sold_count))
                                        <span class="sv-rating-sep">•</span>
                                    @endif
                                    @if(!empty($service->sold_count))
                                        <span class="sv-sold-val">{{ $service->sold_count }} terjual</span>
                                    @endif
                                </div>
                            @endif

                            @if($service->price && $service->price > 0)
                                <div class="sv-card-price-badge">
                                    {{ $service->formatted_price }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="sv-card-body">
                    {{-- Category Label (replaces Tipe #99) --}}
                    <div class="sv-card-cat">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M5.5 7A1.5 1.5 0 014 5.5 1.5 1.5 0 015.5 4 1.5 1.5 0 017 5.5 1.5 1.5 0 015.5 7m15.91 4.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.11 0-2 .89-2 2v7c0 .55.22 1.05.59 1.41l9 9c.36.37.86.59 1.41.59.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41.01-.56-.22-1.06-.59-1.42z"/>
                        </svg>
                        {{ $service->category?->name ?? 'Produk Unggulan' }}
                    </div>
                    <h2 class="sv-card-name">{{ $service->name }}</h2>
                    <p class="sv-card-desc">{{ Str::limit($service->short_desc, 90) }}</p>
                    <span class="sv-card-link">
                        Lihat Detail
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </span>
                </div>
            </a>
        @empty
            <div class="sv-empty">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3>Belum ada produk</h3>
                <p>Belum ada produk di kategori ini. Coba pilih kategori lain.</p>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($services->hasPages())
        <div class="sv-pagination">
            {{-- Prev --}}
            @if($services->onFirstPage())
                <span class="disabled">&lsaquo;</span>
            @else
                <a href="{{ $services->previousPageUrl() }}">&lsaquo;</a>
            @endif

            {{-- Page Numbers --}}
            @foreach($services->getUrlRange(max(1, $services->currentPage()-2), min($services->lastPage(), $services->currentPage()+2)) as $page => $url)
                @if($page == $services->currentPage())
                    <span class="active-page">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next --}}
            @if($services->hasMorePages())
                <a href="{{ $services->nextPageUrl() }}">&rsaquo;</a>
            @else
                <span class="disabled">&rsaquo;</span>
            @endif
        </div>
    @endif
</section>

@endsection
