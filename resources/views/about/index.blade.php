@extends('layouts.app')

@section('content')

<style>
    /* ════════════════════════════════════
       ABOUT PAGE — Mobile-First, DB-Driven
    ════════════════════════════════════ */
    :root {
        --font: 'Montserrat', sans-serif;
        --brand: {{ $settings['brand_color'] ?? $settings['header_accent_color'] ?? '#10B981' }};
        --text: #0F172A;
        --muted: #64748B;
        --surface: #F8FAFC;
        --border: #E2E8F0;
    }

    /* ── HERO ── */
    .ab-hero {
        position: relative;
        padding: 9rem 1.5rem 5rem;
        background: #F8FAFC;
        overflow: hidden;
        border-bottom: 1px solid #E2E8F0;
        text-align: center;
    }
    .ab-hero::before {
        content: '';
        position: absolute;
        top: -150px; right: -100px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(14,165,233,0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .ab-hero-inner { max-width: 1200px; margin: 0 auto; position: relative; z-index: 2; }

    .sv-label {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 0.5rem; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.15em;
        text-transform: uppercase; color: #64748B; margin-bottom: 1.25rem;
        font-family: var(--font);
    }
    .sv-label::before {
        content: ''; display: block; width: 5px; height: 5px;
        background: #0F172A; border-radius: 50%;
    }
    .sv-title {
        font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 500; color: #0F172A;
        line-height: 1.15; letter-spacing: -0.03em; font-family: var(--font);
        margin: 0 auto 1.5rem; max-width: 800px;
    }
    .sv-intro {
        margin: 0 auto; max-width: 650px; font-size: 1rem; font-weight: 400;
        color: #64748B; line-height: 1.7;
    }
    .sv-breadcrumb {
        display: flex; align-items: center; justify-content: center;
        gap: 0.5rem; font-size: 0.8rem; color: #94A3B8; margin-bottom: 1.5rem;
    }
    .sv-breadcrumb a { color: #64748B; text-decoration: none; }
    .sv-breadcrumb a:hover { color: #0F172A; }
    .sv-breadcrumb-sep { color: #CBD5E1; }

    /* ── SECTION HEADER ── */
    .ab-section { padding: 5rem 1.5rem; }
    .ab-section-light { background: #ffffff; }
    .ab-section-surface { background: #F8FAFC; }
    .ab-section-dark { background: #0F172A; color: #fff; }

    .ab-container { max-width: 1200px; margin: 0 auto; }

    .ab-sect-label {
        font-size: 0.72rem; font-weight: 700; letter-spacing: 0.15em;
        text-transform: uppercase; color: #64748B; display: flex;
        align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;
    }
    .ab-sect-label::before {
        content: ''; width: 4px; height: 4px; border-radius: 50%; background: #0F172A;
    }
    .ab-sect-label.centered { justify-content: center; }
    .ab-sect-title {
        font-size: clamp(1.8rem, 3.5vw, 2.8rem); font-weight: 500; color: #0F172A;
        line-height: 1.2; letter-spacing: -0.03em; margin: 0;
    }
    .ab-sect-title.white { color: #ffffff; }
    .ab-sect-title.centered { text-align: center; }

    /* ── ABOUT 4-CARD BENTO GRID (Synced from homepage about section) ── */
    .ab-bento-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: auto;
        gap: 1.25rem;
    }
    .ab-bento-card {
        border-radius: 22px;
        overflow: hidden;
        position: relative;
        min-height: 240px;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .ab-bento-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,0.08); }

    /* Card types */
    .ab-bento-gray    { background: #F1F5F9; }
    .ab-bento-accent  { background: var(--brand, #10B981); }
    .ab-bento-dark    { background: #0F172A; }
    .ab-bento-image   { background: #0F172A; }

    /* chip pattern */
    .ab-bento-pattern { position: absolute; inset: 0; pointer-events: none; }
    .ab-chip {
        position: absolute;
        font-size: 0.68rem; font-weight: 600; color: #64748B;
        background: #fff; border: 1px solid #E2E8F0;
        padding: 0.2rem 0.6rem; border-radius: 50px;
        white-space: nowrap; letter-spacing: 0.01em;
    }
    .ab-bento-content {
        padding: 2rem; position: relative; z-index: 2;
        display: flex; flex-direction: column; height: 100%;
    }
    .ab-bento-content.push-bottom { justify-content: flex-end; }

    .ab-bento-label {
        font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em;
        text-transform: uppercase; color: #94A3B8; margin-bottom: 0.4rem;
    }
    .ab-bento-label.white { color: rgba(255,255,255,0.6); }

    .ab-bento-value {
        font-size: 3.5rem; font-weight: 400; line-height: 1;
        letter-spacing: -0.05em; color: #0F172A;
    }
    .ab-bento-value.white { color: #ffffff; }

    .ab-bento-desc {
        font-size: 0.85rem; line-height: 1.65; color: #64748B; margin-top: 0.75rem;
    }
    .ab-bento-desc.white { color: rgba(255,255,255,0.75); }

    .ab-bento-img {
        position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
    }
    .ab-bento-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0.1) 60%);
    }

    /* responsive bento */
    @media (max-width: 1024px) {
        .ab-bento-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .ab-bento-grid { grid-template-columns: 1fr; }
        .ab-bento-card { min-height: 180px; }
    }

    /* ── VISI MISI ── */
    .ab-vm-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-top: 3rem;
    }
    .ab-vm-card {
        background: #ffffff;
        border: 1.5px solid #E2E8F0;
        border-radius: 22px;
        padding: 2.5rem;
        transition: all 0.3s;
    }
    .ab-vm-card:hover {
        border-color: #0F172A;
        box-shadow: 0 20px 50px rgba(0,0,0,0.06);
        transform: translateY(-4px);
    }
    .ab-vm-icon {
        width: 52px; height: 52px; border-radius: 16px;
        background: #0F172A; color: #fff;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
    }
    .ab-vm-heading {
        font-size: 1.3rem; font-weight: 600; color: #0F172A;
        margin: 0 0 1rem; letter-spacing: -0.02em;
    }
    .ab-vm-text {
        font-size: 0.9375rem; color: #64748B; line-height: 1.7; margin: 0;
    }
    @media (max-width: 640px) {
        .ab-vm-grid { grid-template-columns: 1fr; }
    }

    /* ── STATS GRID (synced from homepage coverage section) ── */
    .ab-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-top: 3rem;
    }
    .ab-stat-card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.3s;
    }
    .ab-stat-card:hover {
        background: rgba(255,255,255,0.08);
        transform: translateY(-4px);
    }
    .ab-stat-num {
        font-size: 3rem; font-weight: 400; color: #ffffff;
        letter-spacing: -0.05em; line-height: 1; margin-bottom: 0.5rem;
    }
    .ab-stat-suffix {
        font-size: 1.5rem; font-weight: 600;
        color: var(--brand, #10B981);
    }
    .ab-stat-label {
        font-size: 0.8rem; font-weight: 600; color: #94A3B8;
        text-transform: uppercase; letter-spacing: 0.08em;
    }
    @media (max-width: 768px) {
        .ab-stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 480px) {
        .ab-stats-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .ab-stat-num { font-size: 2.25rem; }
    }

    /* ── LEGALITAS ── */
    .ab-legal-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-top: 2.5rem;
    }
    .ab-legal-item {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 1.5rem 2rem;
    }
    .ab-legal-label {
        font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em;
        text-transform: uppercase; color: #64748B; margin-bottom: 0.5rem;
    }
    .ab-legal-val {
        font-size: 1rem; font-weight: 600; color: #ffffff;
        letter-spacing: 0.01em;
    }
    @media (max-width: 768px) { .ab-legal-grid { grid-template-columns: 1fr; } }

    /* ── MAP ── */
    .ab-map-wrap {
        margin-top: 3rem; width: 100%; text-align: center; position: relative;
    }
    .ab-map-wrap img {
        max-width: 100%; height: auto;
        filter: opacity(0.8) drop-shadow(0 0 20px rgba(16,185,129,0.15));
    }

    /* ── KEUNGGULAN (reuse from keunggulan component) ── */

    /* ── TESTIMONI ── */
    .ab-testi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 3.5rem;
    }
    .ab-testi-card {
        background: #fff; border: 1.5px solid #E2E8F0;
        border-radius: 22px; padding: 2.25rem;
        position: relative; transition: all 0.3s;
    }
    .ab-testi-card:hover {
        border-color: var(--brand, #10B981);
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.08);
    }
    .ab-testi-stars { display: flex; gap: 0.25rem; color: #F59E0B; margin-bottom: 1.25rem; }
    .ab-testi-text { font-size: 0.9375rem; line-height: 1.7; color: #475569; margin-bottom: 2rem; }
    .ab-testi-author { display: flex; align-items: center; gap: 1rem; border-top: 1px solid #F1F5F9; padding-top: 1.25rem; }
    .ab-testi-avatar {
        width: 44px; height: 44px; border-radius: 50%; background: #F1F5F9;
        object-fit: cover; flex-shrink: 0;
    }
    .ab-testi-name { font-size: 0.9rem; font-weight: 700; color: #0F172A; }
    .ab-testi-pos { font-size: 0.75rem; color: #64748B; }
    @media (max-width: 1024px) { .ab-testi-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 640px)  { .ab-testi-grid { grid-template-columns: 1fr; } }

    /* ── MARQUEE KLIEN ── */
    .ab-marquee-section { background: #0F172A; padding: 3rem 0; }
    @keyframes marqueeLeft {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .ab-marquee-track {
        display: flex; gap: 1.5rem; width: max-content;
        animation: marqueeLeft 30s linear infinite;
    }
    .ab-marquee-track:hover { animation-play-state: paused; }

    /* ── CTA ── */
    .ab-cta {
        background: #0F172A; color: #fff;
        padding: 5rem 1.5rem; text-align: center; position: relative; overflow: hidden;
    }
    .ab-cta-glow {
        position: absolute; width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(16,185,129,0.08) 0%, transparent 60%);
        top: 50%; left: 50%; transform: translate(-50%, -50%);
        pointer-events: none;
    }
    .ab-cta-inner { position: relative; z-index: 2; max-width: 700px; margin: 0 auto; }
    .ab-cta-title {
        font-size: clamp(2rem, 4vw, 3rem); font-weight: 500;
        letter-spacing: -0.03em; margin-bottom: 1.25rem;
    }
    .ab-cta-desc { font-size: 1.05rem; color: rgba(255,255,255,0.65); margin-bottom: 2.5rem; line-height: 1.6; }
    .ab-cta-btns { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
    .ab-btn-primary {
        background: var(--brand, #10B981); color: #fff;
        padding: 0.875rem 2rem; border-radius: 50px; font-weight: 600; font-size: 0.95rem;
        display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;
        transition: all 0.3s; border: none; cursor: pointer; font-family: var(--font);
    }
    .ab-btn-primary:hover { filter: brightness(1.1); transform: translateY(-2px); color: #fff; }
    .ab-btn-outline {
        background: transparent; color: #fff;
        border: 1px solid rgba(255,255,255,0.3);
        padding: 0.875rem 2rem; border-radius: 50px; font-weight: 600; font-size: 0.95rem;
        display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;
        transition: all 0.3s;
    }
    .ab-btn-outline:hover { border-color: #fff; background: rgba(255,255,255,0.06); color: #fff; }
</style>

{{-- ════ 1. HERO ════ --}}
<section class="ab-hero">
    <div class="ab-hero-inner" data-aos="fade-up">
        <nav class="sv-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="sv-breadcrumb-sep">/</span>
            <span>Tentang Kami</span>
        </nav>
        <div class="sv-label">{{ $settings['page_about_hero_label'] ?? 'Profil Perusahaan' }}</div>
        <h1 class="sv-title">
            {!! nl2br(e($settings['page_about_hero_title'] ?? 'Mitra Solusi Terpercaya untuk Kebutuhan Tableware & Keramik')) !!}
        </h1>
        <p class="sv-intro">
            {{ $settings['page_about_hero_desc'] ?? 'Hadir untuk menjawab kebutuhan produk berkualitas di seluruh wilayah Indonesia.' }}
        </p>
    </div>
</section>


{{-- ════ 3. VISI & MISI (dari settings DB) ════ --}}
<section class="ab-section ab-section-surface" style="border-top:1px solid #E2E8F0;">
    <div class="ab-container">
        <div style="text-align:center; max-width:700px; margin:0 auto;" data-aos="fade-up">
            <div class="ab-sect-label centered">PROFIL PERUSAHAAN</div>
            <h2 class="ab-sect-title centered" style="margin-top:0.5rem;">Visi &amp; Misi Kami</h2>
        </div>
        <div class="ab-vm-grid">
            <div class="ab-vm-card" data-aos="fade-up">
                <div class="ab-vm-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                </div>
                <h3 class="ab-vm-heading">Visi</h3>
                <p class="ab-vm-text">{{ $settings['visi'] ?? 'Menjadi perusahaan penyedia tableware dan keramik berkualitas berskala nasional yang berfokus pada kualitas dan pelayanan unggul.' }}</p>
            </div>
            <div class="ab-vm-card" data-aos="fade-up" data-aos-delay="100">
                <div class="ab-vm-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="ab-vm-heading">Misi</h3>
                <p class="ab-vm-text">{{ $settings['misi'] ?? 'Menciptakan produk dan layanan yang memberikan kepuasan maksimal bagi pelanggan dengan harga kompetitif dan standar kualitas terjaga.' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ════ 4. KEUNGGULAN (reuse component) ════ --}}
@include('components.keunggulan')

{{-- ════ 5. TESTIMONI (synced dari DB $testimonials) ════ --}}
@if($testimonials->count())
<section class="ab-section ab-section-surface" style="border-top:1px solid #E2E8F0;">
    <div class="ab-container">
        <div style="text-align:center; max-width:600px; margin:0 auto;" data-aos="fade-up">
            <div class="ab-sect-label centered">TESTIMONI KLIEN</div>
            <h2 class="ab-sect-title centered" style="margin-top:0.5rem;">Kata Mereka yang<br>Sudah Menggunakan</h2>
        </div>
        <div class="ab-testi-grid">
            @foreach($testimonials->take(3) as $i => $testi)
            <div class="ab-testi-card" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="ab-testi-stars">
                    @for($s = 0; $s < ($testi->rating ?? 5); $s++)
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    @endfor
                </div>
                <p class="ab-testi-text">"{{ $testi->content }}"</p>
                <div class="ab-testi-author">
                    <img src="{{ $testi->photo_url }}" alt="{{ $testi->name }}" class="ab-testi-avatar">
                    <div>
                        <div class="ab-testi-name">{{ $testi->name }}</div>
                        <div class="ab-testi-pos">{{ $testi->position }} — {{ $testi->company }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


@endsection