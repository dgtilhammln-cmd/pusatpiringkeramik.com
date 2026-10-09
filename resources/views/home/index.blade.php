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
    HOME PAGE — {{ $companyName }}
    ════════════════════════════════════════════════ --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .cv-hero-modern {
            background-color:
                {{ $settings['page_home_hero_bg'] ?? '#FAFAFA' }}
            ;
            padding-top: calc(80px + 3rem);
            padding-bottom: 2rem;
            position: relative;
            overflow: hidden;
            font-family: var(--font);
        }

        .cv-hero-title,
        h2.cv-hero-title {
            color:
                {{ $settings['page_home_hero_title_color'] ?? '#0A1930' }}
            ;
        }

        .cv-hero-desc {
            color:
                {{ $settings['page_home_hero_text_color'] ?? '#64748b' }}
            ;
        }

        .cv-hero-stats-box,
        .cv-hero-bg-block {
            background:
                {{ $settings['page_home_hero_card_bg'] ?? '#0A1930' }}
            ;
        }

        /* ── Product / Catalog Section ── */
        .cv-products,
        .cv-catalog-section {
            background:
                {{ $settings['page_home_product_bg'] ?? '#0F172A' }}
                !important;
        }

        .cv-product-card {
            background:
                {{ $settings['page_home_product_card_bg'] ?? '#1E293B' }}
            ;
        }

        .cv-catalog-title {
            color:
                {{ $settings['page_home_product_title_color'] ?? '#ffffff' }}
                !important;
        }

        .cv-catalog-right-info p {
            color:
                {{ $settings['page_home_product_desc_color'] ?? '#94A3B8' }}
                !important;
        }

        .cv-catalog-right-info small {
            color:
                {{ $settings['page_home_product_note_color'] ?? '#64748B' }}
                !important;
        }

        /* ── About Section ── */
        .cv-about-premium {
            background-color:
                {{ $settings['page_home_about_bg'] ?? '#ffffff' }}
                !important;
        }

        .about-premium-heading {
            color:
                {{ $settings['page_home_about_title_color'] ?? '#0A1930' }}
                !important;
        }

        .cv-about-premium .ab-card-label {
            color:
                {{ $settings['page_home_about_text_color'] ?? '#64748b' }}
                !important;
        }

        /* Desc color applies only to non-image cards — card-image always forces white */
        .cv-about-premium .ab-card-gray .ab-card-desc,
        .cv-about-premium .ab-card-accent .ab-card-desc {
            color:
                {{ $settings['page_home_about_text_color'] ?? '#64748b' }}
                !important;
        }

        .cv-about-premium .ab-card-image .ab-card-desc,
        .cv-about-premium .ab-card-image .ab-card-label,
        .cv-about-premium .ab-card-image .ab-card-value {
            color: #ffffff !important;
        }

        .cv-about-premium .ab-card-gray .ab-card-value {
            color:
                {{ $settings['page_home_about_title_color'] ?? '#0A1930' }}
                !important;
        }

        /* ── Value / Keunggulan Section ── */
        .cv-advantages {
            background-color:
                {{ $settings['page_home_value_bg'] ?? '#f8fafc' }}
                !important;
        }

        .cv-adv-card {
            background-color:
                {{ $settings['page_home_value_card_bg'] ?? '#ffffff' }}
                !important;
        }

        /* ── Aplikasi Section ── */
        .cv-apps-premium {
            background-color:
                {{ $settings['page_home_aplikasi_bg'] ?? '#0F172A' }}
                !important;
        }

        .cv-apps-premium .cv-adv-section-label {
            color:
                {{ $settings['page_home_aplikasi_label_color'] ?? '#94A3B8' }}
                !important;
        }

        .cv-apps-premium .cv-adv-section-title {
            color:
                {{ $settings['page_home_aplikasi_title_color'] ?? '#ffffff' }}
                !important;
        }

        /* ── Coverage / Kota Section ── */
        .cv-coverage-dark {
            background-color:
                {{ $settings['page_home_kota_bg'] ?? '#0F172A' }}
                !important;
        }

        .cv-coverage-dark h2 {
            color:
                {{ $settings['page_home_kota_title_color'] ?? '#ffffff' }}
                !important;
        }

        /* ── Footer ── */
        @if(!empty($settings['page_home_footer_bg']))
            footer.cv-footer {
                background-color:
                    {{ $settings['page_home_footer_bg'] }}
                    !important;
            }

        @endif

        @if(!empty($settings['page_home_footer_text_color']))
            footer.cv-footer, footer.cv-footer p, footer.cv-footer span {
                color:
                    {{ $settings['page_home_footer_text_color'] }}
                    !important;
            }

        @endif

        /* ── NEW COMPACT HERO REDESIGN (IMAGE 2 STYLE) ── */
        .cv-hero-modern {
            background-color:
                {{ $settings['page_home_hero_bg'] ?? '#FAFAFA' }}
            ;
            padding-top: calc(65px + 0.75rem);
            padding-bottom: 1rem;
            position: relative;
            overflow: hidden;
            font-family: var(--font);
        }

        .cv-hero-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.25rem;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        /* Mobile-only hero layers: hidden on desktop */
        .cv-hero-mob-bg,
        .cv-hero-mob-grad,
        .cv-hero-mob-content {
            display: none;
        }

        /* Top Section */
        .cv-hero-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.6rem;
            gap: 1.5rem;
        }

        .cv-hero-top-left {
            max-width: 78%;
        }

        .cv-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: #64748B;
            margin-bottom: 0.25rem;
            letter-spacing: 0.01em;
        }

        .cv-hero-badge::before {
            content: '';
            width: 18px;
            height: 2px;
            background: var(--brand, #00A664);
            border-radius: 2px;
        }

        .cv-hero-title,
        h2.cv-hero-title {
            font-size: clamp(1.4rem, 2.4vw, 2.1rem);
            font-weight: 500;
            color:
                {{ $settings['page_home_hero_title_color'] ?? '#0A1930' }}
            ;
            line-height: 1.2;
            letter-spacing: -0.02em;
            margin: 0;
            white-space: pre-line;
            word-break: normal;
        }

        .cv-hero-title span,
        h2.cv-hero-title span {
            color:
                {{ $settings['page_home_hero_title_color'] ?? '#0A1930' }}
            ;
            font-weight: 700;
        }

        /* Static Logo Badge */
        .cv-static-logo-badge {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
        }

        .cv-static-logo-badge img {
            height: 46px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
        }

        /* Middle Section */
        .cv-hero-mid {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.6rem;
            gap: 1.5rem;
        }

        .cv-hero-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            flex: 1;
            align-items: center;
        }

        .cv-hero-tags span {
            font-size: 0.73rem;
            font-weight: 500;
            color:
                {{ $settings['page_home_hero_tags_color'] ?? '#475569' }}
            ;
            background:
                {{ $settings['page_home_hero_tags_bg'] ?? '#ffffff' }}
            ;
            border: 1px solid
                {{ $settings['page_home_hero_tags_border'] ?? '#E2E8F0' }}
            ;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            white-space: nowrap;
        }

        .cv-hero-desc {
            font-size: 0.8rem;
            font-weight: 400;
            color:
                {{ $settings['page_home_hero_text_color'] ?? '#64748B' }}
            ;
            line-height: 1.45;
            padding-left: 0.85rem;
            border-left: 3px solid var(--brand, #00A664);
            max-width: 440px;
            flex-shrink: 0;
        }

        /* Banner Card & Carousel Wrap (Image 2 style with side-peeking & edge fade gradients) */
        .cv-hero-banner-wrap {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding: 0.25rem 0 0.5rem;
            margin-top: 0.4rem;
        }

        .cv-hero-banner-wrap::before,
        .cv-hero-banner-wrap::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 120px;
            z-index: 10;
            pointer-events: none;
        }

        .cv-hero-banner-wrap::before {
            left: 0;
            background: linear-gradient(to right,
                    {{ $settings['page_home_hero_bg'] ?? '#FAFAFA' }}
                    30%, rgba(250, 250, 250, 0) 100%);
        }

        .cv-hero-banner-wrap::after {
            right: 0;
            background: linear-gradient(to left,
                    {{ $settings['page_home_hero_bg'] ?? '#FAFAFA' }}
                    30%, rgba(250, 250, 250, 0) 100%);
        }

        .hero-banner-swiper {
            width: 100%;
            overflow: visible !important;
        }

        .hero-banner-swiper .swiper-slide {
            transition: transform 0.4s ease, opacity 0.4s ease;
            opacity: 0.75;
        }

        .hero-banner-swiper .swiper-slide-active {
            opacity: 1;
            transform: scale(1.01);
        }

        /* Banner card — placeholder: proportional to 3448/914 on desktop, safe height on mobile */
        .cv-banner-card {
            position: relative;
            width: 100%;
            height: auto;
            aspect-ratio: 3448 / 914;
            border-radius: 18px;
            overflow: hidden;
            background: linear-gradient(135deg, #005F41 0%, #00875A 50%, #004D34 100%);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
        }

        /* Uploaded image card — same ratio, image fills entirely */
        .cv-banner-card.has-image {
            align-items: stretch;
        }

        .cv-banner-uploaded-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 18px;
        }

        .cv-banner-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .cv-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, var(--brand, #005F41) 0%, rgba(0, 95, 65, 0.94) 45%, rgba(0, 95, 65, 0.3) 80%, transparent 100%);
            z-index: 2;
        }

        .cv-banner-content {
            position: relative;
            z-index: 3;
            padding: 1.5rem 2rem;
            max-width: 580px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            gap: 0.65rem;
        }

        .cv-banner-header {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            padding: 0.3rem 0.75rem;
            border-radius: 50px;
            width: fit-content;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .cv-banner-brand-logo {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2px;
        }

        .cv-banner-brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .cv-banner-brand-name {
            font-size: 0.75rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.02em;
        }

        .cv-banner-headline {
            font-size: clamp(1.05rem, 1.8vw, 1.45rem);
            font-weight: 400;
            color: #ffffff;
            line-height: 1.3;
            margin: 0;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
        }

        .cv-banner-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 0.15rem;
        }

        .cv-banner-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.28);
            color: #ffffff;
            padding: 0.25rem 0.7rem;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .cv-banner-pill:hover {
            background: rgba(255, 255, 255, 0.32);
            color: #ffffff;
        }

        /* Swiper pagination below card (Dark Navy / Slate Gray, NOT green) */
        .hero-banner-swiper-pagination {
            position: relative !important;
            bottom: auto !important;
            margin-top: 0.65rem !important;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            z-index: 12;
        }

        .hero-banner-swiper-pagination .swiper-pagination-bullet {
            background: #64748B !important;
            opacity: 0.35 !important;
            width: 8px;
            height: 8px;
            transition: all 0.3s ease;
            margin: 0 !important;
        }

        .hero-banner-swiper-pagination .swiper-pagination-bullet-active {
            background: #0A1930 !important;
            opacity: 1 !important;
            width: 22px !important;
            border-radius: 10px !important;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .cv-hero-top {
                flex-direction: column;
                gap: 0.5rem;
            }

            .cv-hero-top-left {
                max-width: 100%;
            }

            .cv-hero-mid {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.6rem;
            }

            .cv-hero-desc {
                max-width: 100%;
            }

            .cv-banner-card {
                aspect-ratio: 3448 / 914;
                height: auto;
                min-height: 160px;
            }

            .cv-banner-content {
                padding: 1.25rem 1.5rem;
            }
        }

        /* ═══════════════════════════════════════
           MOBILE HERO — Full Bleed Image Layout
           ═══════════════════════════════════════ */
        @media (max-width: 768px) {

            /* Section becomes the banner — full-height, image as background */
            .cv-hero-modern {
                position: relative;
                padding: 0 !important;
                overflow: hidden;
                min-height: 90dvh;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                background-color: #030712 !important;
            }

            /* Full-bleed background image layer */
            .cv-hero-mob-bg {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center top;
                display: block;
                z-index: 0;
            }

            /* Dark gradient overlay: Extra dark for maximum legibility */
            .cv-hero-mob-grad {
                position: absolute;
                inset: 0;
                z-index: 1;
                background: linear-gradient(
                    160deg,
                    rgba(1, 4, 10, 0.98) 0%,
                    rgba(3, 8, 20, 0.92) 40%,
                    rgba(5, 12, 26, 0.80) 75%,
                    rgba(5, 12, 26, 0.50) 100%
                );
                pointer-events: none;
            }

            /* Content sits on top */
            .cv-hero-grid {
                position: relative;
                z-index: 2;
                padding: 0 1.25rem calc(env(safe-area-inset-bottom, 0px) + 2.5rem);
                width: 100%;
                max-width: 100%;
            }

            /* Hide desktop elements on mobile */
            .cv-hero-top,
            .cv-hero-mid,
            .cv-hero-banner-wrap,
            .cv-static-logo-badge {
                display: none !important;
            }

            /* Mobile-only content block */
            .cv-hero-mob-content {
                display: flex !important;
                flex-direction: column;
                gap: 1.25rem;
                padding-bottom: 0;
            }

            .cv-hero-mob-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.45rem;
                font-size: 0.72rem;
                font-weight: 700;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: rgba(255,255,255,0.85);
            }

            .cv-hero-mob-badge::before {
                content: '';
                width: 20px;
                height: 2px;
                background: #00D68F;
                border-radius: 2px;
                flex-shrink: 0;
            }

            .cv-hero-mob-title {
                font-size: 2.25rem;
                font-weight: 500;
                color: #ffffff;
                line-height: 1.18;
                letter-spacing: -0.025em;
                margin: 0;
                white-space: pre-line;
                text-shadow: 0 2px 14px rgba(0,0,0,0.5);
            }

            .cv-hero-mob-desc {
                font-size: 0.83rem;
                color: rgba(255,255,255,0.85);
                line-height: 1.55;
                margin: 0;
                padding-left: 0.85rem;
                border-left: 2.5px solid #00D68F;
                max-width: 90%;
            }

            /* Capsule buttons with dynamic gradient support */
            .cv-hero-mob-ctas {
                display: flex;
                flex-direction: column;
                gap: 0.65rem;
                width: 100%;
            }

            .cv-hero-mob-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.55rem;
                padding: 0.85rem 1.5rem;
                border-radius: 100px;
                font-size: 0.88rem;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.22s ease;
                letter-spacing: 0.01em;
            }

            .cv-hero-mob-btn-primary {
                background: linear-gradient({{ $settings['hero_btn_primary_dir'] ?? '135deg' }}, {{ $settings['hero_btn_primary_start'] ?? '#00D68F' }}, {{ $settings['hero_btn_primary_end'] ?? '#00A664' }});
                color: #ffffff !important;
                border: none;
                box-shadow: 0 6px 20px rgba(0,166,100,0.45);
            }

            .cv-hero-mob-btn-primary:hover {
                filter: brightness(1.08);
                transform: translateY(-1px);
            }

            .cv-hero-mob-btn-outline {
                background: linear-gradient(135deg, {{ $settings['hero_btn_secondary_start'] ?? 'rgba(255,255,255,0.18)' }}, {{ $settings['hero_btn_secondary_end'] ?? 'rgba(255,255,255,0.08)' }});
                color: #ffffff !important;
                border: 1.5px solid {{ $settings['hero_btn_secondary_border'] ?? 'rgba(255,255,255,0.45)' }};
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
            }

            .cv-hero-mob-btn-outline:hover {
                background: rgba(255,255,255,0.25);
                color: #ffffff !important;
            }

            /* Pagination dots — still visible at bottom on mobile */
            .cv-hero-mob-dots {
                display: flex;
                justify-content: center;
                gap: 5px;
                margin-top: 1rem;
            }

            .cv-hero-mob-dots span {
                width: 6px; height: 6px;
                border-radius: 50%;
                background: rgba(255,255,255,0.35);
                display: inline-block;
                transition: all 0.3s;
            }

            .cv-hero-mob-dots span.active {
                width: 18px;
                border-radius: 10px;
                background: #ffffff;
            }
        }

        /* ── PRODUCTS ─────────────────────── */
        .cv-products {
            background: var(--bg-base);
        }

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
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(56, 189, 248, 0.05);
        }

        .cv-product-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--brand), var(--brand), #FCA5A5);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .cv-product-card:hover {
            border-color: #334155;
            transform: translateY(-8px);
            box-shadow: 0 32px 80px rgba(56, 189, 248, 0.15), 0 0 0 1px rgba(56, 189, 248, 0.1);
        }

        .cv-product-card:hover::after {
            transform: scaleX(1);
        }

        .cv-product-type {
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--brand);
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

        .cv-spec-val.highlight {
            color: #1E293B;
        }

        .cv-product-cta {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--brand);
            transition: gap 0.2s;
        }

        .cv-product-card:hover .cv-product-cta {
            gap: 0.625rem;
        }

        /* ── ADVANTAGES ───────────────────── */
        .cv-advantages {
            background: var(--bg-1);
        }

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
            width: 48px;
            height: 48px;
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
        .cv-apps {
            background: var(--bg-1);
        }

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
            box-shadow: 0 12px 40px rgba(56, 189, 248, 0.12);
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
            background: linear-gradient(135deg, #F1F5F9, #E2E8F0);
            border-radius: 10px;
        }

        .cv-gallery-placeholder-inner {
            text-align: center;
            color: #64748B;
        }

        /* ── TESTIMONIALS ─────────────────── */
        .cv-testimonials {
            background: var(--bg-dark);
        }

        .cv-testi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .cv-testi-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 16px;
            padding: 2rem;
            position: relative;
        }

        .cv-testi-quote {
            font-size: 2.5rem;
            color: #334155;
            opacity: 0.3;
            line-height: 1;
            margin-bottom: 0.5rem;
            font-family: Georgia, serif;
        }

        .cv-testi-text {
            font-size: 0.875rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.65);
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
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--brand), var(--brand));
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
            color: rgba(255, 255, 255, 0.45);
        }

        .cv-testi-stars {
            display: flex;
            gap: 2px;
            margin-bottom: 1rem;
        }

        /* ── COVERAGE MAP ─────────────────── */
        .cv-coverage {
            background: var(--bg-2);
        }

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
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #334155;
            flex-shrink: 0;
        }

        /* ── CTA SECTION ──────────────────── */
        .cv-cta {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand) 50%, var(--brand) 100%);
            position: relative;
            overflow: hidden;
        }

        .cv-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
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
        .cv-articles {
            background: var(--bg-1);
        }

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
            box-shadow: 0 20px 56px rgba(56, 189, 248, 0.12);
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

        .cv-article-card:hover .cv-article-thumb img {
            transform: scale(1.06);
        }

        .cv-article-body {
            padding: 1.5rem;
        }

        .cv-article-cat {
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--brand);
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

        /* ── ELEGANT MINIMALIST CLIENT BAR ──────────── */
        .cv-clients-section {
            background: #ffffff;
            padding: 1.5rem 0 1.75rem;
            border-top: 1px solid #F1F5F9;
            border-bottom: 1px solid #F1F5F9;
            overflow: hidden;
            position: relative;
        }

        .cv-marquee-container {
            width: 100%;
            overflow: hidden;
            position: relative;
            display: flex;
        }

        .cv-marquee-container::before,
        .cv-marquee-container::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 140px;
            z-index: 2;
            pointer-events: none;
        }

        .cv-marquee-container::before {
            left: 0;
            background: linear-gradient(to right, rgba(255,255,255,1), rgba(255,255,255,0));
        }

        .cv-marquee-container::after {
            right: 0;
            background: linear-gradient(to left, rgba(255,255,255,1), rgba(255,255,255,0));
        }

        @keyframes scrollLeftSlow {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .cv-marquee-track {
            display: flex;
            align-items: center;
            gap: 4rem;
            padding: 0.5rem 1rem;
            width: max-content;
            animation: scrollLeftSlow 35s linear infinite;
        }

        .cv-marquee-container:hover .cv-marquee-track {
            animation-play-state: paused;
        }

        .cv-client-minimal-item {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 48px;
            padding: 0 0.5rem;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .cv-client-logo-img {
            max-height: 44px;
            max-width: 150px;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.35s cubic-bezier(0.22, 1, 0.36, 1);
            display: block;
        }

        .cv-client-minimal-item:hover .cv-client-logo-img {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.08);
        }

        @media (max-width: 768px) {
            .cv-clients-section { padding: 1.25rem 0 1.5rem; }
            .cv-marquee-track { gap: 2.25rem; animation-duration: 25s; }
            .cv-client-minimal-item { height: 38px; }
            .cv-client-logo-img { max-height: 36px; max-width: 120px; }
            .cv-marquee-container::before, .cv-marquee-container::after { width: 50px; }
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .cv-hero-grid {
                grid-template-columns: 1fr 1fr;
            }

            .cv-hero-right {
                display: none;
            }

            .cv-hero-center {
                height: 420px;
            }

            .cv-explainer-grid {
                grid-template-columns: 1fr;
            }

            .cv-gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
            }

            .cv-gallery-grid .gallery-item:first-child {
                grid-column: 1;
            }
        }

        @media (max-width: 640px) {
            .cv-hero-modern {
                padding-top: calc(46px + 1.5rem);
            }

            .cv-hero-grid {
                grid-template-columns: 1fr;
            }

            .cv-gallery-grid {
                grid-template-columns: 1fr;
            }

            .cv-products-grid,
            .cv-adv-grid,
            .cv-apps-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    {{-- ════ NEW MODERN HERO (REDESIGN - IMAGE 2 STYLE) ════ --}}
    <section class="cv-hero-modern" id="home">

        {{-- MOBILE: Full-bleed background image + gradient overlay --}}
        @php
            $firstSlide = isset($heroSlides) && $heroSlides->count() > 0 ? $heroSlides->first() : null;
            $mobBgUrl = '';
            if ($firstSlide) {
                $mobBgUrl = $firstSlide->image_mobile
                    ? asset('storage/' . $firstSlide->image_mobile)
                    : ($firstSlide->image ? asset('storage/' . $firstSlide->image) : '');
            }
            $waPhone = !empty($settings['phone_number']) ? preg_replace('/[^0-9]/', '', $settings['phone_number'])
                     : (!empty($settings['company_phone']) ? preg_replace('/[^0-9]/', '', $settings['company_phone']) : '');
        @endphp

        {{-- Mobile background image element (hidden on desktop) --}}
        @if($mobBgUrl)
            <img id="cv-hero-mob-bg-img" class="cv-hero-mob-bg" src="{{ $mobBgUrl }}" alt="Banner" aria-hidden="true">
        @else
            <div id="cv-hero-mob-bg-img" class="cv-hero-mob-bg" style="background: linear-gradient(135deg, #005F41 0%, #00875A 50%, #004D34 100%);"></div>
        @endif
        <div class="cv-hero-mob-grad" aria-hidden="true"></div>

        <div class="cv-hero-grid">
            {{-- Mobile-only content block --}}
            <div class="cv-hero-mob-content" id="cv-hero-mob-content" style="display:none;">
                <div class="cv-hero-mob-badge" id="cv-hero-mob-badge">
                    {{ $firstSlide->subtitle ?? 'Distributor Resmi Keramik Premium' }}
                </div>
                <h1 class="cv-hero-mob-title" id="cv-hero-mob-title">
                    {{ $firstSlide ? $firstSlide->title : "Peralatan Makan\nBerkualitas Premium" }}
                </h1>
                <p class="cv-hero-mob-desc" id="cv-hero-mob-desc">
                    {{ $firstSlide->description ?? 'Distributor resmi peralatan makan keramik & stainless untuk usaha, bisnis, dan rumah tangga.' }}
                </p>
                <div class="cv-hero-mob-ctas">
                    <a href="{{ url('/produk') }}" class="cv-hero-mob-btn cv-hero-mob-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                        Lihat Katalog
                    </a>
                    @if($waPhone)
                        <a href="https://wa.me/{{ $waPhone }}" target="_blank" rel="noopener" class="cv-hero-mob-btn cv-hero-mob-btn-outline">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                            Hubungi Kami
                        </a>
                    @else
                        <a href="{{ url('/kontak') }}" class="cv-hero-mob-btn cv-hero-mob-btn-outline">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Hubungi Kami
                        </a>
                    @endif
                </div>
                {{-- Slide indicator dots --}}
                @if(isset($heroSlides) && $heroSlides->count() > 1)
                    <div class="cv-hero-mob-dots" id="cv-hero-mob-dots">
                        @foreach($heroSlides as $i => $s)
                            <span class="{{ $i === 0 ? 'active' : '' }}"></span>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Desktop: Top Section --}}
            <div class="cv-hero-top">
                <div class="cv-hero-top-left">
                    <div class="cv-hero-badge" id="hero-badge">
                        {{ $firstSlide->subtitle ?? 'Trusted Tableware Distributor' }}</div>
                    <h1 class="cv-hero-title" id="hero-title">
                        {{ $firstSlide ? $firstSlide->title : "Peralatan Makan Berkualitas\nuntuk Rumah & Bisnis Anda" }}
                    </h1>
                </div>

                <div class="cv-static-logo-badge d-none d-sm-inline-flex">
                    @if(!empty($settings['logo']))
                        <img src="{{ asset('storage/' . $settings['logo']) }}"
                            alt="{{ $settings['company_name'] ?? config('app.name') }}">
                    @endif
                </div>
            </div>

            {{-- Desktop: Middle Section --}}
            <div class="cv-hero-mid">
                <div class="cv-hero-tags" id="hero-tags">
                    @if($firstSlide && $firstSlide->tags)
                        @foreach(explode(',', $firstSlide->tags) as $tag)
                            <span>{{ trim($tag) }}</span>
                        @endforeach
                    @else
                        <span>Keramik Lantai</span>
                        <span>Keramik Dinding</span>
                        <span>Porselen</span>
                        <span>High Quality</span>
                        <span>Food Safe</span>
                    @endif
                </div>

                <div class="cv-hero-desc" id="hero-desc">
                    {{ $firstSlide->description ?? 'Distributor resmi peralatan makan keramik dan stainless terpercaya untuk kebutuhan usaha, bisnis, & rumah tangga.' }}
                </div>
            </div>
        </div>

        {{-- Banner Carousel with Side-Peeking & Left/Right Edge Fade Gradients --}}
        <div class="cv-hero-banner-wrap">
            <div class="swiper hero-banner-swiper">
                <div class="swiper-wrapper">
                    @if(isset($heroSlides) && $heroSlides->count() > 0)
                        @foreach($heroSlides as $slide)
                            <div class="swiper-slide" data-title="{{ $slide->title }}" data-subtitle="{{ $slide->subtitle }}"
                                data-desc="{{ $slide->description }}" data-tags="{{ $slide->tags }}"
                                data-img="{{ $slide->image ? asset('storage/' . $slide->image) : '' }}"
                                data-img-mobile="{{ $slide->image_mobile ? asset('storage/' . $slide->image_mobile) : '' }}">
                                <div class="cv-banner-card {{ ($slide->image || $slide->image_mobile) ? 'has-image' : '' }}">
                                    @if($slide->image || $slide->image_mobile)
                                        <picture style="width:100%; height:100%; display:block;">
                                            @if($slide->image_mobile)
                                                <source media="(max-width: 768px)" srcset="{{ asset('storage/' . $slide->image_mobile) }}">
                                            @endif
                                            <img src="{{ asset('storage/' . ($slide->image ?? $slide->image_mobile)) }}" class="cv-banner-uploaded-img"
                                                alt="{{ $slide->title }}">
                                        </picture>
                                    @else
                                        <div class="cv-banner-bg"
                                            style="background: linear-gradient(135deg, #005F41 0%, #00875A 50%, #004D34 100%);"></div>
                                        <div class="cv-banner-overlay"></div>

                                        <div class="cv-banner-content">
                                            <div class="cv-banner-header">
                                                <div class="cv-banner-brand-logo">
                                                    @if(!empty($settings['logo']))
                                                        <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo">
                                                    @else
                                                        <svg width="14" height="14" fill="none" stroke="var(--brand, #00A664)"
                                                            stroke-width="2" viewBox="0 0 24 24">
                                                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <span
                                                    class="cv-banner-brand-name">{{ $settings['company_name'] ?? 'UD. Sukses Makmur' }}</span>
                                            </div>

                                            <h3 class="cv-banner-headline">
                                                Distributor Peralatan makan keramik dan stainless kualitas terbaik
                                            </h3>

                                            <div class="cv-banner-pills">
                                                <a href="{{ url('/') }}" class="cv-banner-pill">
                                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                                                        viewBox="0 0 24 24">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <path
                                                            d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" />
                                                    </svg>
                                                    <span>{{ request()->getHost() ?? 'pusatpiringkeramik.com' }}</span>
                                                </a>

                                                @if(!empty($settings['phone_number']) || !empty($settings['company_phone']))
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['phone_number'] ?? $settings['company_phone']) }}"
                                                        target="_blank" class="cv-banner-pill">
                                                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                                                        </svg>
                                                        <span>{{ $settings['phone_number'] ?? $settings['company_phone'] }}</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- Fallback slide --}}
                        <div class="swiper-slide">
                            <div class="cv-banner-card">
                                <div class="cv-banner-bg"
                                    style="background: linear-gradient(135deg, #005F41 0%, #00875A 50%, #004D34 100%);"></div>
                                <div class="cv-banner-overlay"></div>
                                <div class="cv-banner-content">
                                    <div class="cv-banner-header">
                                        <div class="cv-banner-brand-logo">
                                            @if(!empty($settings['logo']))
                                                <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo">
                                            @endif
                                        </div>
                                        <span
                                            class="cv-banner-brand-name">{{ $settings['company_name'] ?? 'UD. Sukses Makmur' }}</span>
                                    </div>
                                    <h3 class="cv-banner-headline">
                                        Distributor Peralatan makan keramik dan stainless kualitas terbaik
                                    </h3>
                                    <div class="cv-banner-pills">
                                        <a href="{{ url('/') }}" class="cv-banner-pill">
                                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10" />
                                                <path
                                                    d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" />
                                            </svg>
                                            <span>{{ request()->getHost() ?? 'pusatpiringkeramik.com' }}</span>
                                        </a>
                                        @if(!empty($settings['phone_number']) || !empty($settings['company_phone']))
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['phone_number'] ?? $settings['company_phone']) }}"
                                                target="_blank" class="cv-banner-pill">
                                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
                                                </svg>
                                                <span>{{ $settings['phone_number'] ?? $settings['company_phone'] }}</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="swiper-pagination hero-banner-swiper-pagination"></div>
            </div>
        </div>
    </section>

    {{-- ════ PREMIUM CLIENTS BAR (MINIMALIST & ELEGANT SLOW MARQUEE) ════ --}}
    @php
        $logoClients = isset($clients) ? $clients->filter(fn($c) => !empty($c->logo)) : collect();
    @endphp
    @if($logoClients->count() > 0)
        @php
            $clientSectionBg = \App\Models\Setting::get('page_home_client_bg') ?? '#FFFFFF';
        @endphp
        <section class="cv-clients-section" style="background: {{ $clientSectionBg }};">
            <div class="cv-marquee-container">
                <div class="cv-marquee-track">
                    {{-- Loop twice to create seamless infinite scroll effect --}}
                    @foreach([1, 2] as $loopGroup)
                        @foreach($logoClients as $client)
                            <div class="cv-client-minimal-item">
                                <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->auto_alt }}"
                                    class="cv-client-logo-img" title="{{ $client->name }}" loading="lazy">
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ════ ABOUT SECTION (PREMIUM 4 CARDS) ════ --}}
    <section class="cv-about-premium section-pad" id="tentang" style="position:relative; z-index:2;">
        <div class="container">
            @php
                $aboutSubtitle = $settings['about_subtitle'] ?? 'ABOUT US';
                $aboutHeadLine1 = $settings['about_heading_line1'] ?? 'Solusi Tableware Keramik';
                $aboutHeadLine2 = $settings['about_heading_line2'] ?? 'Terpercaya untuk Bisnis F&B';
                $aboutC1Label = $settings['about_c1_label'] ?? 'Pengalaman';
                $aboutC1Value = $settings['about_c1_value'] ?? (date('Y') - (\App\Models\Setting::get('founding_year') ?? 2013)) . '+ Tahun';
                $aboutC1Desc = $settings['about_c1_desc'] ?? '';
                $aboutC1Keywords = array_filter(array_map('trim', explode(',', $settings['about_c1_keywords'] ?? 'Piring Keramik, Keramik Lantai, Porselen, Grosir Hotel, High Quality, Keramik Dinding, Tahan Lama, Food Safe')));
                $aboutC2Label = $settings['about_c2_label'] ?? 'Komitmen Kualitas';
                $aboutC2Value = $settings['about_c2_value'] ?? '100%';
                $aboutC2Desc = $settings['about_c2_desc'] ?? 'Memberikan solusi piring dan tableware keramik terbaik untuk usaha Anda.';
                // Card 2 background: gradient takes priority, then image, then solid color
                $aboutC2ColorStart = $settings['about_c2_color_start'] ?? '';
                $aboutC2ColorEnd = $settings['about_c2_color_end'] ?? '';
                $aboutC2GradDir = $settings['about_c2_grad_dir'] ?? '135deg';
                $aboutC2Image = $settings['about_c2_image'] ?? '';
                if (!empty($aboutC2Image)) {
                    $aboutC2BgStyle = "background:url('" . asset('storage/' . $aboutC2Image) . "') center/cover no-repeat;";
                } elseif (!empty($aboutC2ColorStart) && !empty($aboutC2ColorEnd)) {
                    $aboutC2BgStyle = "background:linear-gradient({$aboutC2GradDir},{$aboutC2ColorStart},{$aboutC2ColorEnd});";
                } else {
                    $aboutC2BgStyle = 'background:' . ($settings['about_c2_bg'] ?? '#00875A') . ';';
                }
                $aboutC3Value = $settings['about_c3_value'] ?? '500+';
                $aboutC3Desc = $settings['about_c3_desc'] ?? 'Proyek suplai dan pengadaan diselesaikan di seluruh Indonesia.';
                $aboutC4Label = $settings['about_c4_label'] ?? 'Distribusi Produk';
                $aboutC4Value = $settings['about_c4_value'] ?? '1.000+';
                $aboutC4Desc = $settings['about_c4_desc'] ?? 'Ribuan set tableware terdistribusi ke berbagai sektor Horeca.';
                $chipPositions = ['top:10%;left:5%', 'top:15%;left:45%', 'top:12%;left:80%', 'top:35%;left:15%', 'top:38%;left:50%', 'top:60%;left:5%', 'top:65%;left:40%', 'top:62%;left:75%'];
            @endphp

            {{-- Section Header --}}
            <div style="text-align:center; max-width:800px; margin:0 auto 4rem;">
                <div
                    style="font-size:0.75rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#64748b; margin-bottom:1.5rem; display:flex; align-items:center; justify-content:center; gap:0.5rem;">
                    <span style="width:4px; height:4px; background:#0A1930; border-radius:50%;"></span>
                    {{ $aboutSubtitle }}
                </div>
                <h2 style="font-size:clamp(1.75rem, 3.5vw, 3rem); font-weight:500; line-height:1.15; letter-spacing:-0.02em;"
                    class="about-premium-heading">
                    {{ $aboutHeadLine1 }}
                    @if($aboutHeadLine2)
                        <br><strong>{{ $aboutHeadLine2 }}</strong>
                    @endif
                </h2>
            </div>

            {{-- 4 Cards Grid --}}
            <div class="about-cards-grid">

                {{-- Card 1: Light Gray (Keywords pattern) --}}
                <div class="ab-card ab-card-gray" data-aos="fade-up" data-aos-delay="0">
                    <div class="ab-card-bg-pattern">
                        @foreach(array_slice($aboutC1Keywords, 0, 8) as $idx => $kw)
                            <span class="ab-chip" style="{{ $chipPositions[$idx] ?? 'top:50%;left:50%' }};">{{ $kw }}</span>
                        @endforeach
                    </div>
                    <div class="ab-card-content">
                        <div class="ab-card-label">{{ $aboutC1Label }}</div>
                        <div class="ab-card-value">{{ $aboutC1Value }}</div>
                        @if($aboutC1Desc)
                            <div class="ab-card-desc" style="margin-top:0.5rem;">{{ $aboutC1Desc }}</div>
                        @endif
                    </div>
                </div>

                {{-- Card 2: Gradient / Image / Solid Color --}}
                <div class="ab-card ab-card-accent ab-card-c2" data-aos="fade-up" data-aos-delay="100"
                    style="{{ $aboutC2BgStyle }} position:relative; overflow:hidden;">
                    {{-- Dark overlay for image mode --}}
                    @if(!empty($aboutC2Image))
                        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.45);z-index:1;"></div>
                    @endif
                    <div class="ab-card-content"
                        style="position:relative;z-index:2;height:100%;display:flex;flex-direction:column;">
                        <div class="ab-card-label" style="color:rgba(255,255,255,0.9);">{{ $aboutC2Label }}</div>
                        <div class="ab-card-value" style="color:#ffffff;">{{ $aboutC2Value }}</div>
                        <div class="ab-card-desc" style="margin-top:auto;color:rgba(255,255,255,0.9);">{{ $aboutC2Desc }}
                        </div>
                    </div>
                </div>

                {{-- Card 3: Image Background --}}
                <div class="ab-card ab-card-image" data-aos="fade-up" data-aos-delay="200">
                    @if(!empty($settings['about_c3_image']))
                        <img src="{{ asset('storage/' . $settings['about_c3_image']) }}" alt="About" class="ab-card-img"
                            width="400" height="400" loading="lazy">
                    @else
                        <div style="position:absolute; inset:0; background:linear-gradient(135deg, #cbd5e1, #94a3b8);"></div>
                    @endif
                    <div class="ab-card-overlay"></div>
                    <div class="ab-card-content"
                        style="position:relative; z-index:2; height:100%; display:flex; flex-direction:column; justify-content:flex-end;">
                        <div class="ab-card-value" style="color:#ffffff; margin-bottom:0.5rem;">{{ $aboutC3Value }}</div>
                        <div class="ab-card-desc" style="color:rgba(255,255,255,0.9);">{{ $aboutC3Desc }}</div>
                    </div>
                </div>

                {{-- Card 4: Light Gray --}}
                <div class="ab-card ab-card-gray" data-aos="fade-up" data-aos-delay="300">
                    <div class="ab-card-content" style="height: 100%; display: flex; flex-direction: column;">
                        <div class="ab-card-label">{{ $aboutC4Label }}</div>
                        <div class="ab-card-value">{{ $aboutC4Value }}</div>
                        <div class="ab-card-desc" style="margin-top:auto;">{{ $aboutC4Desc }}</div>
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
            background: #ca0000;
            /* dark red */
            color: #fff;
            padding: 0.2em;
        }

        .about-premium-heading .ab-icon-red {
            background: #334155;
            /* red */
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
            background:
                {{ $settings['page_home_about_card_gray_bg'] ?? '#f1f5f9' }}
            ;
        }

        .ab-card-accent {
            background: var(--brand);
            /* matching hero blue */
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
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 60%);
            z-index: 1;
        }

        .ab-card-label {
            font-size: 0.875rem;
            font-weight: 500;
            color:
                {{ $settings['page_home_about_text_color'] ?? '#64748b' }}
            ;
            margin-bottom: 1rem;
        }

        .ab-card-value {
            font-size: 3rem;
            font-weight: 400;
            line-height: 1;
            color:
                {{ $settings['page_home_about_title_color'] ?? '#0f172a' }}
            ;
            letter-spacing: -0.05em;
        }

        .ab-card-desc {
            font-size: 0.95rem;
            line-height: 1.5;
            color:
                {{ $settings['page_home_about_text_color'] ?? '#475569' }}
            ;
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
            background:
                {{ $settings['page_home_about_chip_bg'] ?? '#ffffff' }}
            ;
            padding: 0.4rem 0.8rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            color:
                {{ $settings['page_home_about_chip_color'] ?? '#94a3b8' }}
            ;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            white-space: nowrap;
        }

        .ab-card-gray .ab-card-content {
            position: relative;
            z-index: 1;
            margin-top: auto;
            /* push text to bottom for card 1 */
        }
    </style>

    {{-- ════ PRODUCTS (CATALOG STYLE) ════ --}}
    <style>
        /* ── PRODUCT CATALOG SECTION ─────────────────── */
        .cv-catalog-section {
            background:
                {{ $settings['page_home_product_bg'] ?? '#0F172A' }}
            ;
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
            color:
                {{ $settings['page_home_product_title_color'] ?? '#ffffff' }}
            ;
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
            color:
                {{ $settings['page_home_product_desc_color'] ?? '#94A3B8' }}
            ;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }

        .cv-catalog-right-info small {
            font-size: 0.75rem;
            color:
                {{ $settings['page_home_product_note_color'] ?? '#64748B' }}
            ;
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
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.25rem;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding-top: 16px;
            padding-bottom: 16px;
            margin-top: -16px;
            margin-bottom: -16px;
        }

        .cv-catalog-scroll::-webkit-scrollbar {
            display: none;
        }

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
            background:
                {{ $settings['page_home_product_card_bg'] ?? '#1E293B' }}
            ;
            cursor: pointer;
            transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s;
            transform: translateZ(0);
        }

        .cv-cat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
        }

        .cv-cat-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
            transition: transform 0.5s ease;
        }

        .cv-cat-card:hover img {
            transform: scale(1.06);
        }

        /* Dark gradient overlay at bottom */
        .cv-cat-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.15) 55%, transparent 100%);
            z-index: 1;
        }

        /* Skeleton shimmer — matches the card size exactly */
        @keyframes cv-skeleton-shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .cv-cat-card-placeholder {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0.07) 25%,
                    rgba(255, 255, 255, 0.18) 50%,
                    rgba(255, 255, 255, 0.07) 75%);
            background-size: 200% 100%;
            animation: cv-skeleton-shimmer 1.6s ease-in-out infinite;
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            flex-direction: column;
            gap: 0;
            color: rgba(255, 255, 255, 0.35);
        }

        .cv-cat-card-body {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
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
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .cv-cat-card-spec span {
            background:
                {{ $settings['page_home_product_accent_color'] ?? 'rgba(15, 23, 42, 0.85)' }}
            ;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
            color:
                {{ $settings['page_home_product_accent_text'] ?? '#fff' }}
            ;
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

        /* Single CTA Button */
        .cv-catalog-btn-single {
            background:
                {{ $settings['page_home_product_btn_bg'] ?? 'rgba(255,255,255,0.15)' }}
            ;
            color:
                {{ $settings['page_home_product_btn_text'] ?? '#ffffff' }}
            ;
            border: 2px solid
                {{ $settings['page_home_product_btn_border'] ?? 'rgba(255,255,255,0.45)' }}
            ;
            padding: 0.85rem 2.2rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s cubic-bezier(0.22, 1, 0.36, 1);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }

        .cv-catalog-btn-single:hover {
            background:
                {{ $settings['page_home_product_btn_text'] ?? '#ffffff' }}
            ;
            color:
                {{ $settings['page_home_product_bg'] ?? '#0F172A' }}
            ;
            border-color:
                {{ $settings['page_home_product_btn_text'] ?? '#ffffff' }}
            ;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .cv-catalog-nav {
            display: flex;
            gap: 0.5rem;
        }

        .cv-catalog-nav-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            border: 1.5px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #ffffff;
            transition: all 0.2s;
        }

        .cv-catalog-nav-btn:hover {
            background:
                {{ $settings['page_home_product_btn_bg'] ?? 'var(--brand)' }}
            ;
            border-color:
                {{ $settings['page_home_product_btn_bg'] ?? 'var(--brand)' }}
            ;
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .cv-catalog-scroll {
                grid-template-columns: repeat(4, 280px);
            }
        }

        @media (max-width: 640px) {
            .cv-catalog-section {
                padding: 3.5rem 0;
            }

            .cv-catalog-header {
                flex-direction: column;
            }

            .cv-catalog-right-info {
                text-align: left;
                max-width: 100%;
            }

            .cv-catalog-scroll {
                grid-template-columns: repeat(4, 78vw);
            }

            .cv-cat-card {
                min-height: 260px;
            }
        }
    </style>

    <section class="cv-catalog-section" id="produk">

        {{-- Header: Title left, description right --}}
        <div class="cv-catalog-header">
            <h2 class="cv-catalog-title">{!! nl2br(e($settings['product_section_title'] ?? "Katalog Produk\nKami")) !!}</h2>
            <div class="cv-catalog-right-info">
                <p>{{ $settings['product_section_desc'] ?? 'Solusi tableware keramik premium terpercaya untuk berbagai skala bisnis F&B di Indonesia.' }}
                </p>
                <small>{{ $settings['product_section_note'] ?? 'Tersedia berbagai varian dan spesifikasi' }}</small>
            </div>
        </div>

        {{-- Cards Track --}}
        <div class="cv-catalog-track-wrapper">
            <div class="cv-catalog-scroll" id="cv-catalog-scroll">
                @if($products->count())
                    @foreach($products as $product)
                        <a href="{{ route('products.show', $product->slug) }}" class="cv-cat-card">
                            <img src="{{ $product->image_url }}" alt="{{ $product->alt_text }}" loading="lazy"
                                style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">
                            <div class="cv-cat-card-overlay"></div>

                            @if(($product->rating && $product->rating > 0) || !empty($product->sold_count) || ($product->price && $product->price > 0))
                                <div style="position:absolute; top:12px; left:12px; right:12px; display:flex; justify-content:space-between; align-items:center; z-index:3; pointer-events:none;">
                                    @if(($product->rating && $product->rating > 0) || !empty($product->sold_count))
                                        <div style="background:rgba(15,23,42,0.82); backdrop-filter:blur(6px); -webkit-backdrop-filter:blur(6px); color:#ffffff; font-size:0.7rem; font-weight:600; padding:3px 9px; border-radius:20px; display:inline-flex; align-items:center; gap:4px; border:1px solid rgba(255,255,255,0.2);">
                                            @if($product->rating && $product->rating > 0)
                                                <span style="color:#F59E0B;">★</span>
                                                <span>{{ number_format($product->rating, 1) }}</span>
                                            @endif
                                            @if(($product->rating && $product->rating > 0) && !empty($product->sold_count))
                                                <span style="opacity:0.4; margin:0 1px;">•</span>
                                            @endif
                                            @if(!empty($product->sold_count))
                                                <span style="color:#E2E8F0;">{{ $product->sold_count }} terjual</span>
                                            @endif
                                        </div>
                                    @endif
                                    @if($product->price && $product->price > 0)
                                        <div style="background:#0F172A; color:#ffffff; font-size:0.75rem; font-weight:700; padding:3px 9px; border-radius:20px; box-shadow:0 4px 12px rgba(0,0,0,0.2); margin-left:auto;">
                                            {{ $product->formatted_price }}
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="cv-cat-card-body">
                                <div class="cv-cat-card-name">{{ $product->name }}</div>
                            </div>
                        </a>
                    @endforeach
                @else
                    @for($i = 1; $i <= 4; $i++)
                        <a href="{{ route('products') }}" class="cv-cat-card">
                            {{-- White skeleton shimmer — fills the whole card, no text --}}
                            <div class="cv-cat-card-placeholder"></div>
                            <div class="cv-cat-card-overlay"></div>
                            <div class="cv-cat-card-body">
                                <div class="cv-cat-card-name" style="opacity:0;">—</div>
                            </div>
                        </a>
                    @endfor
                @endif
            </div>
        </div>

        {{-- Footer: Single CTA Button left, Nav arrows right --}}
        <div class="cv-catalog-footer">
            <a href="{{ $settings['product_cta1_url'] ?? route('products') }}" class="cv-catalog-btn-single">
                {{ $settings['product_cta1_text'] ?? 'Ke Katalog Produk' }}
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </a>
            <div class="cv-catalog-nav">
                <button class="cv-catalog-nav-btn" id="cv-scroll-prev" aria-label="Sebelumnya">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                </button>
                <button class="cv-catalog-nav-btn" id="cv-scroll-next" aria-label="Berikutnya">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <script>
        (function () {
            var track = document.getElementById('cv-catalog-scroll');
            var prev = document.getElementById('cv-scroll-prev');
            var next = document.getElementById('cv-scroll-next');
            if (!track || !prev || !next) return;
            var scrollAmt = function () {
                var card = track.querySelector('.cv-cat-card');
                return card ? card.offsetWidth + 16 : 260;
            };
            next.addEventListener('click', function () { track.scrollBy({ left: scrollAmt(), behavior: 'smooth' }); });
            prev.addEventListener('click', function () { track.scrollBy({ left: -scrollAmt(), behavior: 'smooth' }); });
        })();
    </script>

    @include('components.keunggulan')

    @include('components.aplikasi')


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
            transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .cv-gallery-card-v2:hover .cv-gallery-img-v2 {
            transform: scale(1.08);
        }

        .cv-gallery-overlay-v2 {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0) 60%);
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
            transition: background 0.3s;
        }

        @php
            $ghovColorHex = \App\Models\Setting::get('page_gallery_hover_overlay') ?? '#0EA5E9';
            list($ghr, $ghg, $ghb) = sscanf(strlen($ghovColorHex) == 7 ? $ghovColorHex : '#0EA5E9', "#%02x%02x%02x");
            $ghovRgba1 = "rgba({$ghr}, {$ghg}, {$ghb}, 0.9)";
        @endphp
        .cv-gallery-card-v2:hover .cv-gallery-overlay-v2 {
            background: linear-gradient(to top, {{ $ghovRgba1 }} 0%, rgba(15, 23, 42, 0) 70%);
        }

        .cv-gallery-meta-v2 {
            color: #fff;
            transform: translateY(10px);
            transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1);
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
            color: rgba(255, 255, 255, 0.75);
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
            bottom: -200px;
            left: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.04) 0%, transparent 70%);
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
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .cv-testi-card-v2:hover {
            border-color: var(--brand);
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(14, 165, 233, 0.1);
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
            color: #F1F5F9;
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
            width: 44px;
            height: 44px;
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
            .cv-gallery-grid-v2 {
                grid-template-columns: repeat(2, 1fr);
            }

            .cv-testi-grid-v2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {

            .cv-gallery-premium,
            .cv-testi-premium {
                padding: 3.5rem 0;
            }

            .cv-gallery-grid-v2,
            .cv-testi-grid-v2 {
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

            .cv-gallery-grid-v2::-webkit-scrollbar,
            .cv-testi-grid-v2::-webkit-scrollbar {
                display: none;
            }

            .cv-gallery-grid-v2>*,
            .cv-testi-grid-v2>* {
                scroll-snap-align: start;
            }
        }
    </style>

    {{-- ════ GALLERY PREVIEW (PREMIUM) ════ --}}
    @if(isset($gallery) && $gallery->filter(fn($item) => !empty($item->image))->count() > 0)
        <section class="cv-gallery-premium" id="galeri" style="background: {{ \App\Models\Setting::get('page_home_gallery_bg') ?? '#FFFFFF' }};">
            <div class="cv-gallery-inner">
                <div class="cv-gallery-header">
                    <div>
                        <div class="cv-adv-section-label">{{ \App\Models\Setting::get('gallery_section_label') ?? 'GALERI' }}</div>
                        <h2 class="cv-adv-section-title" style="margin-top:0.75rem;">{!! nl2br(e(\App\Models\Setting::get('gallery_section_title') ?? "Bukti Nyata\ndi Lapangan")) !!}</h2>
                    </div>
                    <a href="{{ route('gallery') }}" class="btn-ghost"
                        style="color:#0F172A; border-color:#E2E8F0; background:#F8FAFC;">
                        Lihat Semua Galeri
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </a>
                </div>

                <div class="cv-gallery-grid-v2">
                    @foreach($gallery->take(6) as $item)
                        <a href="{{ asset('storage/' . $item->image) }}" class="cv-gallery-card-v2 glightbox"
                            data-gallery="home-gallery" data-title="{{ $item->title }}" data-description="{{ $item->client }}">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->alt_text ?? $item->title }}"
                                    class="cv-gallery-img-v2" loading="lazy">
                            @else
                                <div
                                    style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#94A3B8;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    <span style="font-size:0.7rem;margin-top:0.5rem;">Upload Foto</span>
                                </div>
                            @endif
                            <div class="cv-gallery-overlay-v2">
                                <div class="cv-gallery-meta-v2">
                                    <div class="cv-gallery-title-v2">{{ $item->title }}</div>
                                    @if($item->client)
                                    <div class="cv-gallery-client-v2">{{ $item->client }}</div>@endif
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
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
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
            color: var(--brand);
            line-height: 1;
            letter-spacing: -0.05em;
            display: flex;
            align-items: baseline;
            gap: 0.1em;
        }

        .cv-stat-val span {
            color: var(--brand);
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
            background: var(--brand);
            border-color: var(--brand);
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
            .cv-coverage-stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .cv-cities-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .cv-coverage-glass-box {
                margin-top: 4rem;
            }
        }

        @media (max-width: 640px) {
            .cv-coverage-premium {
                padding: 4rem 0;
            }

            .cv-coverage-stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .cv-stat-card-v2 {
                padding: 1.25rem;
            }

            .cv-stat-val {
                font-size: 2.5rem;
            }

            .cv-stat-val span {
                font-size: 1.5rem;
            }

            .cv-cities-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .cv-coverage-glass-box {
                padding: 2rem 1.5rem;
                margin-top: 3rem;
            }
        }

        .cv-coverage-map-wrapper {
            position: relative;
            width: 100%;
            margin-top: -6rem;
        }

        @media (max-width: 1024px) {
            .cv-coverage-map-wrapper {
                margin-top: -2rem;
            }
        }

        @media (max-width: 640px) {
            .cv-coverage-map-wrapper {
                margin-top: 1rem;
            }
        }
    </style>

    {{-- ════ COVERAGE (PREMIUM REDESIGN) ════ --}}
    @php
        $kotaBgType = $settings['kota_bg_type'] ?? 'solid';
        $kotaBgSolid = $settings['page_home_kota_bg'] ?? '#0F172A';
        $kotaBgGradient = $settings['kota_bg_gradient'] ?? 'linear-gradient(135deg, #0F172A 0%, #1E293B 100%)';
        $effectiveKotaBgStyle = ($kotaBgType === 'gradient') ? "background: {$kotaBgGradient};" : "background-color: {$kotaBgSolid};";
        
        $kotaTitleColor = $settings['page_home_kota_title_color'] ?? '#FFFFFF';
        $kotaDescColor = $settings['kota_desc_color'] ?? '#94A3B8';
        
        $kotaStatIconColor = $settings['kota_stat_icon_color'] ?? '#E2E8F0';
        $kotaStatTitleColor = $settings['kota_stat_title_color'] ?? '#FFFFFF';
        $kotaStatSubColor = $settings['kota_stat_sub_color'] ?? '#64748B';

        $foundingYear = \App\Models\Setting::get('founding_year') ?? '2013';
    @endphp
    <section class="cv-coverage-premium" id="jangkauan"
        style="{{ $effectiveKotaBgStyle }} padding: 6rem 0 2rem 0; color: #fff; overflow: hidden; position: relative;">
        <div class="cv-coverage-inner"
            style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; position: relative; z-index: 2;">

            <div style="display: flex; flex-wrap: wrap; gap: 4rem; justify-content: space-between; margin-bottom: 2rem;">
                {{-- Left: Heading --}}
                <div style="flex: 1; min-width: 300px;" data-aos="fade-right">
                    <h2
                        style="font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 500; line-height: 1.2; letter-spacing: -0.03em; margin: 0; color: {{ $kotaTitleColor }};">
                        {!! nl2br(e($settings['kota_section_title'] ?? 'Melayani seluruh Indonesia dengan jangkauan 50+ Kota.')) !!}
                    </h2>
                </div>

                {{-- Right: Description --}}
                <div style="flex: 1; min-width: 300px; max-width: 500px; display: flex; align-items: center;"
                    data-aos="fade-left">
                    <p style="color: {{ $kotaDescColor }}; font-size: 1.1rem; line-height: 1.6; margin: 0;">
                        {{ $settings['kota_section_desc'] ?? $companyName . ' bermitra dengan layanan ekspedisi kargo terpercaya untuk mendistribusikan produk piring keramik dan tableware berkualitas ke seluruh penjuru Nusantara secara cepat dan aman.' }}
                    </p>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem; margin-bottom: 1rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
                {{-- Stat 1 --}}
                <div data-aos="fade-up" data-aos-delay="0">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem; color: {{ $kotaStatIconColor }};">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span style="font-weight: 600; font-size: 1.1rem; color: {{ $kotaStatTitleColor }};">
                            {{ $settings['kota_stat_1_title'] ?? 'Berdiri Sejak ' . $foundingYear }}
                        </span>
                    </div>
                    <p style="color: {{ $kotaStatSubColor }}; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        {{ $settings['kota_stat_1_sub'] ?? 'Berpengalaman lebih dari satu dekade menjadi andalan perusahaan BUMN dan swasta.' }}
                    </p>
                </div>

                {{-- Stat 2 --}}
                <div data-aos="fade-up" data-aos-delay="100">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem; color: {{ $kotaStatIconColor }};">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 7a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                        </svg>
                        <span style="font-weight: 600; font-size: 1.1rem; color: {{ $kotaStatTitleColor }};">
                            {{ $settings['kota_stat_2_title'] ?? '500+ Klien Aktif' }}
                        </span>
                    </div>
                    <p style="color: {{ $kotaStatSubColor }}; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        {{ $settings['kota_stat_2_sub'] ?? 'Dipercaya oleh ratusan perusahaan terkemuka untuk melindungi aset strategis mereka.' }}
                    </p>
                </div>

                {{-- Stat 3 --}}
                <div data-aos="fade-up" data-aos-delay="200">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem; color: {{ $kotaStatIconColor }};">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="7" />
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
                        </svg>
                        <span style="font-weight: 600; font-size: 1.1rem; color: {{ $kotaStatTitleColor }};">
                            {{ $settings['kota_stat_3_title'] ?? 'Garansi Terbaik' }}
                        </span>
                    </div>
                    <p style="color: {{ $kotaStatSubColor }}; font-size: 0.95rem; line-height: 1.5; margin: 0;">
                        {{ $settings['kota_stat_3_sub'] ?? 'Jaminan kualitas dan performa maksimal untuk setiap produk pelapis yang kami sediakan.' }}
                    </p>
                </div>
            </div>

            {{-- Map Graphic --}}
            @php $coverageMap = \App\Models\Setting::get('coverage_map'); @endphp
            @if($coverageMap)
                <div style="position: relative; width: 100%; text-align: center; margin-bottom: 0;" data-aos="zoom-in">
                    <img src="{{ asset('storage/' . $coverageMap) }}" alt="Peta Jangkauan Indonesia"
                        style="max-width: 100%; height: auto; filter: opacity(0.8) drop-shadow(0 0 20px rgba(15, 23, 42, 0.2));"
                        loading="lazy">
                </div>
            @else
                <div style="position: relative; width: 100%; text-align: center; margin-bottom: 0; opacity: 0.7;"
                    data-aos="zoom-in">
                    <img src="https://www.amcharts.com/lib/3/maps/svg/indonesiaLow.svg" alt="Peta Indonesia"
                        style="width:100%; height:auto; filter: invert(1) brightness(0.8) sepia(1) hue-rotate(310deg) saturate(3) opacity(0.5);">
                </div>
            @endif

        </div>
    </section>

    {{-- ════ PREMIUM CTA & ARTICLES CSS ════ --}}
    <style>
        /* ── CTA PREMIUM (Dark Theme) ────────────────────────── */
        .cv-cta-premium {
            background: #0F172A;
            position: relative;
            overflow: hidden;
            padding: 4rem 0 8rem 0;
            color: #ffffff;
        }

        .cv-cta-bg-glow {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(15, 23, 42, 0.08) 0%, transparent 60%);
            top: 50%;
            left: 50%;
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
            color: rgba(255, 255, 255, 0.7);
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
            background: var(--brand);
            color: #ffffff;
            padding: 1.125rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.2);
            text-decoration: none !important;
        }

        .cv-cta-btn-primary:hover {
            background: #1E293B;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(15, 23, 42, 0.3);
        }

        .cv-cta-btn-outline {
            background: transparent;
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
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
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-3px);
        }

        .cv-cta-info {
            margin-top: 4rem;
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 3rem;
        }

        .cv-cta-info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.875rem;
        }

        .cv-cta-info-icon {
            color: var(--brand);
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
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
            text-decoration: none !important;
        }

        .cv-article-card-v2 * {
            text-decoration: none !important;
        }

        .cv-article-card-v2:hover {
            border-color: var(--brand);
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(14, 165, 233, 0.08);
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
            transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .cv-article-card-v2:hover .cv-article-img-v2 {
            transform: scale(1.08);
        }

        .cv-article-cat-badge {
            position: absolute;
            top: 1.25rem;
            left: 1.25rem;
            background: rgba(15, 23, 42, 0.85);
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
            color: var(--brand);
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
            .cv-articles-grid-v2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {

            .cv-cta-premium,
            .cv-articles-premium {
                padding: 4rem 0;
            }

            .cv-cta-info {
                gap: 1.5rem;
                flex-direction: column;
                align-items: center;
            }

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

            .cv-articles-grid-v2::-webkit-scrollbar {
                display: none;
            }

            .cv-articles-grid-v2>* {
                scroll-snap-align: start;
            }
        }
    </style>

    {{-- ════ ARTICLES (PREMIUM) ════ --}}
    @if($articles->count())
        <section class="cv-articles-premium" id="artikel">
            <div class="cv-articles-inner">
                <div class="cv-articles-header">
                    <div>
                        <div
                            style="font-size:0.75rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; color:#64748b; margin-bottom:1.5rem; display:flex; align-items:center; gap:0.5rem;">
                            <span style="width:4px; height:4px; background:var(--brand); border-radius:50%;"></span>
                            ARTIKEL &amp; TIPS
                        </div>
                        <h2
                            style="font-size:clamp(2rem, 4vw, 3.5rem); font-weight:500; line-height:1.15; letter-spacing:-0.03em; color:#0f172a !important; margin-top:0; margin-bottom:0;">
                            Artikel & Insight
                        </h2>
                    </div>
                    <a href="{{ route('articles') }}" class="btn-ghost"
                        style="color:#0F172A !important; border-color:#E2E8F0; background:#F8FAFC; text-decoration:none !important;">
                        Semua Artikel
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </a>
                </div>

                <div class="cv-articles-grid-v2">
                    @foreach($articles as $i => $article)
                        <a href="{{ route('articles.show', $article->slug) }}" class="cv-article-card-v2" data-aos="fade-up"
                            data-aos-delay="{{ $i * 100 }}">
                            <div class="cv-article-img-wrap">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->alt_text }}"
                                        class="cv-article-img-v2" loading="lazy">
                                @else
                                    <div
                                        style="width:100%;height:100%;background:#E2E8F0;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#94A3B8;">
                                        <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5"
                                            viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                            <polyline points="14 2 14 8 20 8" />
                                            <line x1="16" y1="13" x2="8" y2="13" />
                                            <line x1="16" y1="17" x2="8" y2="17" />
                                            <polyline points="10 9 9 9 8 9" />
                                        </svg>
                                        <span style="font-size:0.75rem;margin-top:0.5rem;font-weight:600;">Artikel
                                            {{ $companyName }}</span>
                                    </div>
                                @endif
                                <div class="cv-article-cat-badge">{{ $article->category ?? 'Cat & Coating' }}</div>
                            </div>

                            <div class="cv-article-content-v2">
                                <h3 class="cv-article-title-v2">{{ $article->title }}</h3>
                                <p class="cv-article-excerpt-v2">{{ $article->excerpt }}</p>

                                <div class="cv-article-meta-v2">
                                    <span
                                        class="cv-article-date-v2">{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</span>
                                    <span class="cv-article-read-v2">
                                        Baca
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                                            viewBox="0 0 24 24">
                                            <polyline points="9 18 15 12 9 6" />
                                        </svg>
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

    @php
        $heroAutoplaySec = isset($settings['hero_autoplay_interval']) && is_numeric($settings['hero_autoplay_interval'])
            ? (int) $settings['hero_autoplay_interval']
            : 5;
        $heroAutoplayMs = $heroAutoplaySec * 1000;
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!document.querySelector('.hero-banner-swiper')) return;

            /* ── Desktop hero text elements ── */
            const badgeEl = document.getElementById('hero-badge');
            const titleEl = document.getElementById('hero-title');
            const descEl  = document.getElementById('hero-desc');
            const tagsEl  = document.getElementById('hero-tags');

            /* ── Mobile hero elements ── */
            const mobContent = document.getElementById('cv-hero-mob-content');
            const mobBgEl    = document.getElementById('cv-hero-mob-bg-img');
            const mobBadge   = document.getElementById('cv-hero-mob-badge');
            const mobTitle   = document.getElementById('cv-hero-mob-title');
            const mobDesc    = document.getElementById('cv-hero-mob-desc');
            const mobDots    = document.getElementById('cv-hero-mob-dots');

            const isMobile = () => window.innerWidth <= 768;

            /* Show/hide mobile content block based on viewport */
            function applyMobileLayout() {
                if (!mobContent) return;
                if (isMobile()) {
                    mobContent.style.display = 'flex';
                } else {
                    mobContent.style.display = 'none';
                }
            }
            applyMobileLayout();
            window.addEventListener('resize', applyMobileLayout);

            /* Update mobile hero background image + text on slide change */
            function updateMobileHero(slide) {
                if (!slide) return;
                const imgMob = slide.dataset.imgMobile || '';
                const imgDesk = slide.dataset.img || '';
                const url = (isMobile() && imgMob) ? imgMob : (imgDesk || imgMob);
                if (mobBgEl && url) {
                    if (mobBgEl.tagName === 'IMG') {
                        mobBgEl.src = url;
                    } else {
                        mobBgEl.style.backgroundImage = 'url(' + url + ')';
                    }
                }
                const title    = slide.dataset.title    || '';
                const subtitle = slide.dataset.subtitle || '';
                const desc     = slide.dataset.desc     || '';
                if (mobBadge && subtitle) mobBadge.textContent = subtitle;
                if (mobTitle && title)   mobTitle.textContent  = title;
                if (mobDesc  && desc)    mobDesc.textContent   = desc;
            }

            /* Update mobile pagination dots */
            function updateMobDots(realIdx) {
                if (!mobDots) return;
                const dots = mobDots.querySelectorAll('span');
                dots.forEach((d, i) => d.classList.toggle('active', i === realIdx));
            }

            /* Desktop text update */
            function updateHeroText(swiper) {
                const slide = swiper.slides[swiper.activeIndex];
                if (!slide) return;

                const title    = slide.dataset.title    || '';
                const subtitle = slide.dataset.subtitle || '';
                const desc     = slide.dataset.desc     || '';
                const tags     = slide.dataset.tags     || '';

                if (badgeEl && subtitle) badgeEl.textContent = subtitle;
                if (titleEl && title)   titleEl.textContent  = title;
                if (descEl  && desc)    descEl.textContent   = desc;
                if (tagsEl  && tags) {
                    tagsEl.innerHTML = tags.split(',').map(function (t) {
                        return '<span>' + t.trim() + '</span>';
                    }).join('');
                }

                /* Also update mobile hero */
                updateMobileHero(slide);
                updateMobDots(swiper.realIndex);
            }

            const autoplayDelay = {{ $heroAutoplayMs > 0 ? $heroAutoplayMs : 5000 }};
            const autoplayConfig = autoplayDelay > 0 ? { delay: autoplayDelay, disableOnInteraction: false } : false;

            const heroSwiper = new Swiper('.hero-banner-swiper', {
                loop: false,
                centeredSlides: true,
                spaceBetween: 24,
                autoplay: autoplayConfig,
                pagination: {
                    el: '.hero-banner-swiper-pagination',
                    clickable: true,
                },
                on: {
                    slideChangeTransitionStart: updateHeroText,
                    init: function(swiper) {
                        updateHeroText(swiper);
                    }
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 12,
                        centeredSlides: true,
                    },
                    640: {
                        slidesPerView: 1.06,
                        spaceBetween: 16,
                        centeredSlides: true,
                    },
                    1024: {
                        slidesPerView: 1.12,
                        spaceBetween: 24,
                        centeredSlides: true,
                    }
                }
            });
        });
    </script>

@endsection