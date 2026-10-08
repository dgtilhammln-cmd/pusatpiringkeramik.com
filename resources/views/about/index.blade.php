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

{{-- ════ 2. BENTO ABOUT CARDS (synced dari homepage about section) ════ --}}
<section class="ab-section ab-section-light">
    <div class="ab-container">
        <div class="ab-bento-grid">
            {{-- Card 1: Keyword Chips --}}
            <div class="ab-bento-card ab-bento-gray" data-aos="fade-up">
                <div class="ab-bento-pattern">
                    @php
                        $chips = array_filter([
                            $settings['about_chip_1'] ?? 'Piring Keramik',
                            $settings['about_chip_2'] ?? 'Tableware',
                            $settings['about_chip_3'] ?? 'Mangkuk Porselen',
                            $settings['about_chip_4'] ?? 'Food Grade',
                            $settings['about_chip_5'] ?? 'HORECA Supplier',
                            $settings['about_chip_6'] ?? 'Standar Resto',
                            $settings['about_chip_7'] ?? 'Tahan Panas',
                            $settings['about_chip_8'] ?? 'Bebas Gores',
                        ]);
                        $positions = [
                            ['top:10%;left:5%'],['top:15%;left:45%'],['top:12%;left:70%'],
                            ['top:35%;left:10%'],['top:38%;left:48%'],['top:60%;left:5%'],
                            ['top:62%;left:38%'],['top:62%;left:72%'],
                        ];
                    @endphp
                    @foreach(array_values($chips) as $idx => $chip)
                        <span class="ab-chip" style="{{ $positions[$idx][0] ?? 'top:20%;left:20%' }}">{{ $chip }}</span>
                    @endforeach
                </div>
                <div class="ab-bento-content push-bottom">
                    <div class="ab-bento-label">{{ $settings['about_card1_label'] ?? 'Tahun Berdiri' }}</div>
                    <div class="ab-bento-value">{{ $settings['founding_year'] ?? '2013' }}</div>
                </div>
            </div>

            {{-- Card 2: Accent — Komitmen --}}
            <div class="ab-bento-card ab-bento-accent" data-aos="fade-up" data-aos-delay="100">
                <div class="ab-bento-content">
                    <div class="ab-bento-label white">{{ $settings['about_card2_label'] ?? 'Komitmen' }}</div>
                    <div class="ab-bento-value white">{{ $settings['stat_satisfaction'] ?? '100%' }}</div>
                    <div class="ab-bento-desc white">{{ $settings['about_card2_desc'] ?? 'Komitmen terhadap kualitas teruji — produk food-grade berstandar tinggi untuk kebutuhan restoran, hotel, dan catering.' }}</div>
                </div>
            </div>

            {{-- Card 3: Image --}}
            <div class="ab-bento-card ab-bento-image" data-aos="fade-up" data-aos-delay="200">
                @php $aboutImg = !empty($settings['about_image']) ? asset('storage/'.$settings['about_image']) : (!empty($settings['logo']) ? asset('storage/'.$settings['logo']) : asset('images/logo.png')); @endphp
                <img src="{{ $aboutImg }}" alt="Tim {{ $companyName }}" class="ab-bento-img" loading="lazy">
                <div class="ab-bento-overlay"></div>
                <div class="ab-bento-content" style="justify-content:flex-end;">
                    <div class="ab-bento-value white">{{ $settings['stat_clients'] ?? '500+' }}</div>
                    <div class="ab-bento-desc white">{{ $settings['about_card3_desc'] ?? 'Mitra industri nasional yang mempercayakan kebutuhan tableware mereka pada kami.' }}</div>
                </div>
            </div>

            {{-- Card 4: Dark — Produk Terdistribusi --}}
            <div class="ab-bento-card ab-bento-dark" data-aos="fade-up" data-aos-delay="300">
                <div class="ab-bento-content">
                    <div class="ab-bento-label white">{{ $settings['about_card4_label'] ?? 'Produk Distribusi' }}</div>
                    <div class="ab-bento-value white">{{ $settings['stat_products'] ?? '1.000+' }}</div>
                    <div class="ab-bento-desc white">{{ $settings['about_card4_desc'] ?? 'Produk berkualitas berhasil kami distribusikan ke seluruh Indonesia.' }}</div>
                </div>
            </div>
        </div>
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

{{-- ════ 6. STATS + MAP (synced dari settings stats) ════ --}}
<section class="ab-section ab-section-dark" style="border-top:1px solid rgba(255,255,255,0.06);">
    <div class="ab-container">
        <div style="display:flex;flex-wrap:wrap;gap:2rem;justify-content:space-between;align-items:flex-end;margin-bottom:1rem;">
            <div data-aos="fade-right">
                <div class="ab-sect-label" style="color:#64748B;">JANGKAUAN KAMI</div>
                <h2 class="ab-sect-title white" style="margin-top:0.5rem;">
                    Melayani seluruh Indonesia<br>
                    <span style="color:var(--brand,#10B981);">{{ $settings['stat_cities'] ?? '50+' }} Kota.</span>
                </h2>
            </div>
            <p style="flex:1;min-width:260px;max-width:480px;color:#94A3B8;font-size:1rem;line-height:1.65;margin:0;" data-aos="fade-left">
                {{ $settings['coverage_desc'] ?? ($companyName . ' bermitra dengan ekspedisi terkemuka untuk mendistribusikan produk berkualitas ke seluruh Nusantara secara cepat dan aman.') }}
            </p>
        </div>

        <div class="ab-stats-grid" data-aos="fade-up">
            @php
                $statItems = [
                    ['num' => preg_replace('/[^0-9]/', '', $stats['years'] ?? '10'), 'suffix' => '+', 'label' => 'Tahun Pengalaman'],
                    ['num' => preg_replace('/[^0-9]/', '', $stats['clients'] ?? '500'), 'suffix' => '+', 'label' => 'Klien Aktif'],
                    ['num' => preg_replace('/[^0-9]/', '', $stats['cities'] ?? '50'), 'suffix' => '+', 'label' => 'Kota Terlayani'],
                    ['num' => preg_replace('/[^0-9]/', '', $stats['products'] ?? '1000'), 'suffix' => '+', 'label' => 'Produk Tersedia'],
                ];
            @endphp
            @foreach($statItems as $si)
            <div class="ab-stat-card">
                <div class="ab-stat-num">{{ $si['num'] }}<span class="ab-stat-suffix">{{ $si['suffix'] }}</span></div>
                <div class="ab-stat-label">{{ $si['label'] }}</div>
            </div>
            @endforeach
        </div>

        {{-- Map --}}
        @if(!empty($settings['coverage_map']))
        <div class="ab-map-wrap" data-aos="zoom-in">
            <img src="{{ asset('storage/' . $settings['coverage_map']) }}"
                alt="Peta Jangkauan {{ $companyName }}" loading="lazy">
        </div>
        @endif
    </div>
</section>

{{-- ════ 7. MARQUEE KLIEN (synced dari DB $clients) ════ --}}
@if(isset($clients) && $clients->filter(fn($c) => !empty($c->logo) || !empty($c->name))->count() > 0)
<section class="ab-marquee-section">
    <div style="text-align:center; margin-bottom:2rem;">
        <div style="font-size:0.72rem;font-weight:700;color:var(--brand,#10B981);text-transform:uppercase;letter-spacing:0.12em;margin-bottom:0.4rem;">
            {{ $settings['client_section_label'] ?? 'KLIEN AKTIF' }}
        </div>
        <h2 style="font-size:clamp(1.3rem,2.5vw,1.8rem);font-weight:500;color:#fff;margin:0;">
            Dipercaya oleh Perusahaan Terkemuka
        </h2>
    </div>
    <div style="overflow:hidden;position:relative;">
        <div style="position:absolute;left:0;top:0;bottom:0;width:80px;background:linear-gradient(to right,#0F172A,transparent);z-index:2;"></div>
        <div style="position:absolute;right:0;top:0;bottom:0;width:80px;background:linear-gradient(to left,#0F172A,transparent);z-index:2;"></div>
        <div class="ab-marquee-track">
            @foreach([1,2] as $loop)
                @foreach($clients as $c)
                <div style="display:flex;align-items:center;justify-content:center;height:48px;padding:0 0.75rem;flex-shrink:0;">
                    @if($c->logo)
                        <img src="{{ asset('storage/'.$c->logo) }}" alt="{{ $c->auto_alt }}"
                            title="{{ $c->name }}"
                            style="max-height:42px;max-width:130px;object-fit:contain;filter:grayscale(100%) opacity(0.55);transition:all .3s;"
                            onmouseover="this.style.filter='grayscale(0) opacity(1)'"
                            onmouseout="this.style.filter='grayscale(100%) opacity(0.55)'">
                    @else
                        <span style="font-size:0.9rem;font-weight:600;color:#94A3B8;white-space:nowrap;">{{ $c->name }}</span>
                    @endif
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════ 8. CTA ════ --}}
<section class="ab-cta">
    <div class="ab-cta-glow"></div>
    <div class="ab-cta-inner" data-aos="fade-up">
        <h2 class="ab-cta-title">{{ $settings['about_cta_title'] ?? 'Siap Bermitra dengan Kami?' }}</h2>
        <p class="ab-cta-desc">{{ $settings['about_cta_desc'] ?? 'Konsultasikan kebutuhan tableware dan keramik Anda bersama tim ' . $companyName . ' — respon cepat, harga kompetitif.' }}</p>
        <div class="ab-cta-btns">
            @if($wa)
            <button class="ab-btn-primary" onclick="openOrderModal('About CTA')" type="button">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Chat WhatsApp
            </button>
            @endif
            <a href="{{ route('contact') }}" class="ab-btn-outline">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,12 2,6"/></svg>
                Form Konsultasi
            </a>
        </div>
    </div>
</section>

@endsection