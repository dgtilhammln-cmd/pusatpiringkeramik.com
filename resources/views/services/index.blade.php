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
        --radius-lg: 20px;
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

    /* MINIMALIST FILTER BAR */
    .sv-filter-wrap {
        background: #ffffff;
        border-bottom: 1px solid var(--c-border);
        position: sticky; top: 70px; z-index: 100;
        padding: 0.75rem 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .sv-filter-inner {
        max-width: 1200px; margin: 0 auto;
        padding: 0 1.5rem;
        display: flex; align-items: center; justify-content: space-between;
        gap: 1rem;
    }
    .sv-filter-pills {
        display: flex; align-items: center; gap: 0.5rem;
        overflow-x: auto; scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 2px; flex-grow: 1;
    }
    .sv-filter-pills::-webkit-scrollbar { display: none; }
    .sv-pill-tab {
        flex-shrink: 0;
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 1rem;
        font-size: 0.8125rem; font-weight: 600;
        font-family: var(--font); color: #64748B;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 50px;
        text-decoration: none !important;
        transition: all 0.2s var(--ease);
        white-space: nowrap;
    }
    .sv-pill-tab:hover {
        color: #0F172A; background: #F1F5F9; border-color: #CBD5E1;
    }
    .sv-pill-tab.active {
        color: #ffffff; background: #0F172A; border-color: #0F172A;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
    }
    .sv-pill-tab .pill-count {
        display: inline-flex; align-items: center; justify-content: center;
        background: rgba(0, 0, 0, 0.06); color: inherit;
        font-size: 0.65rem; font-weight: 700;
        padding: 0.15rem 0.45rem; border-radius: 20px;
        transition: all 0.2s;
    }
    .sv-pill-tab.active .pill-count {
        background: rgba(255, 255, 255, 0.2); color: #ffffff;
    }

    /* CUSTOM PREMIUM CATEGORY DROPDOWN */
    .sv-filter-dropdown-wrap {
        position: relative;
        flex-shrink: 0;
    }
    .sv-cat-dropdown-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 50px;
        padding: 0.5rem 1rem;
        font-size: 0.8125rem;
        font-weight: 600;
        font-family: var(--font);
        color: #0F172A;
        cursor: pointer;
        outline: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        user-select: none;
        white-space: nowrap;
    }
    .sv-cat-dropdown-btn:hover {
        border-color: #CBD5E1;
        background: #F8FAFC;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
    }
    .sv-cat-btn-left {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 0;
    }
    .sv-cat-btn-icon {
        color: #64748B;
        flex-shrink: 0;
    }
    .sv-cat-btn-prefix {
        color: #64748B;
        font-weight: 500;
        font-size: 0.8125rem;
    }
    .sv-cat-btn-label {
        color: #0F172A;
        font-weight: 600;
    }
    .sv-cat-btn-right {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        flex-shrink: 0;
    }
    .sv-cat-btn-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #F1F5F9;
        color: #475569;
        font-size: 0.6875rem;
        font-weight: 700;
        padding: 0.15rem 0.5rem;
        border-radius: 20px;
        transition: all 0.2s;
    }
    .sv-cat-chevron {
        width: 14px;
        height: 14px;
        color: #64748B;
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        flex-shrink: 0;
    }
    .sv-filter-dropdown-wrap:hover .sv-cat-chevron,
    .sv-filter-dropdown-wrap.is-open .sv-cat-chevron {
        transform: rotate(180deg);
        color: #0F172A;
    }
    
    /* Bridge so hover doesn't break when cursor moves to menu */
    .sv-cat-dropdown-menu-bridge {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        height: 12px;
        display: block;
    }

    .sv-cat-dropdown-menu {
        position: absolute;
        right: 0;
        top: calc(100% + 6px);
        min-width: 250px;
        max-width: 320px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 16px;
        box-shadow: 0 16px 36px -8px rgba(15, 23, 42, 0.14), 0 0 0 1px rgba(15, 23, 42, 0.04);
        padding: 0.5rem;
        z-index: 1050;
        opacity: 0;
        visibility: hidden;
        transform: translateY(6px) scale(0.98);
        transform-origin: top right;
        transition: opacity 0.2s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.2s cubic-bezier(0.16, 1, 0.3, 1),
                    visibility 0.2s;
        pointer-events: none;
    }
    .sv-filter-dropdown-wrap:hover .sv-cat-dropdown-menu,
    .sv-filter-dropdown-wrap.is-open .sv-cat-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }
    .sv-cat-menu-header {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94A3B8;
        padding: 0.35rem 0.6rem 0.45rem;
        border-bottom: 1px solid #F1F5F9;
        margin-bottom: 0.35rem;
    }
    .sv-cat-list {
        list-style: none;
        margin: 0;
        padding: 0;
        max-height: 280px;
        overflow-y: auto;
        overscroll-behavior: contain;
        scrollbar-width: thin;
        scrollbar-color: #E2E8F0 transparent;
    }
    .sv-cat-list::-webkit-scrollbar {
        width: 4px;
    }
    .sv-cat-list::-webkit-scrollbar-track {
        background: transparent;
    }
    .sv-cat-list::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 4px;
    }
    .sv-cat-item-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        padding: 0.55rem 0.75rem;
        border-radius: 10px;
        font-size: 0.8125rem;
        font-weight: 500;
        color: #334155;
        text-decoration: none !important;
        transition: all 0.15s ease;
    }
    .sv-cat-item-link:hover {
        background: #F8FAFC;
        color: #0F172A;
        transform: translateX(2px);
    }
    .sv-cat-item-link.is-active {
        background: #0F172A;
        color: #ffffff;
        font-weight: 600;
    }
    .sv-cat-item-name {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .sv-cat-item-count {
        flex-shrink: 0;
        font-size: 0.6875rem;
        font-weight: 600;
        padding: 0.15rem 0.45rem;
        border-radius: 12px;
        background: #F1F5F9;
        color: #64748B;
        transition: all 0.15s;
    }
    .sv-cat-item-link.is-active .sv-cat-item-count {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
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

    /* SERVICE CARD: ELEGAN FLOATING HOVER WITHOUT OUTLINE */
    .sv-card {
        display: flex; flex-direction: column;
        background: var(--c-card);
        border: 1px solid var(--c-border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        text-decoration: none !important;
        transition: transform 0.35s var(--ease), box-shadow 0.35s var(--ease);
        position: relative;
        outline: none !important;
    }
    .sv-card * { text-decoration: none !important; }
    .sv-card:hover, .sv-card:focus {
        border-color: transparent !important;
        outline: none !important;
        transform: translateY(-8px) !important;
        box-shadow: 0 24px 50px rgba(15, 23, 42, 0.12), 0 8px 20px rgba(15, 23, 42, 0.06) !important;
    }
    .sv-card-img {
        width: 100%; aspect-ratio: 16/10;
        overflow: hidden; position: relative;
        background: var(--c-surface);
    }
    .sv-card-img img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.55s var(--ease);
    }
    .sv-card:hover .sv-card-img img { transform: scale(1.07); }

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
        padding: 1.5rem; display: flex;
        flex-direction: column; flex-grow: 1;
    }
    .sv-card-cat {
        display: inline-flex; align-items: center; gap: 0.35rem;
        background: rgba(14, 165, 233, 0.08);
        color: var(--c-accent);
        font-size: 0.65rem; font-weight: 700;
        letter-spacing: 0.1em; text-transform: uppercase;
        padding: 0.35rem 0.75rem; border-radius: 20px;
        margin-bottom: 0.875rem; align-self: flex-start;
        font-family: var(--font);
    }
    .sv-card-cat svg { width: 10px; height: 10px; }
    .sv-card-name {
        font-size: 1.05rem; font-weight: 700;
        color: var(--c-text); margin-bottom: 0.6rem;
        line-height: 1.4; font-family: var(--font);
        transition: color 0.3s;
    }
    .sv-card:hover .sv-card-name { color: var(--c-accent); }
    .sv-card-desc {
        font-size: 0.85rem; font-weight: 400;
        color: var(--c-muted); line-height: 1.6;
        margin-bottom: 1.25rem; font-family: var(--font); flex-grow: 1;
    }
    .sv-card-link {
        font-size: 0.8125rem; font-weight: 600;
        color: var(--c-accent);
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-family: var(--font); transition: gap 0.3s;
        border-top: 1px solid var(--c-border);
        padding-top: 1rem; margin-top: auto;
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

    /* RESPONSIVE & MOBILE 2 CARDS PER ROW */
    @media (max-width: 1024px) {
        .sv-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    }
    @media (max-width: 768px) {
        .sv-filter-wrap {
            padding: 0.65rem 0;
            top: 70px;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        .sv-filter-inner {
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: stretch;
            gap: 0;
        }
        /* HILANGKAN TAB HORIZONTAL DI MOBILE: Mencegah tampilan double-double dan sesak */
        .sv-filter-pills {
            display: none !important;
        }
        .sv-filter-dropdown-wrap {
            width: 100%;
            flex: 1;
            position: relative;
        }
        .sv-cat-dropdown-btn {
            width: 100% !important;
            max-width: 100% !important;
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.25rem !important;
            font-size: 0.875rem !important;
            border-radius: 50px;
            background: #ffffff;
            border: 1.5px solid #E2E8F0;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
            box-sizing: border-box;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .sv-cat-dropdown-btn:active {
            background: #F8FAFC;
            transform: scale(0.99);
        }
        .sv-cat-btn-left {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            min-width: 0;
            overflow: hidden;
        }
        .sv-cat-btn-icon {
            color: #0F172A;
            flex-shrink: 0;
        }
        .sv-cat-btn-prefix {
            display: inline !important;
            color: #64748B;
            font-size: 0.8125rem;
            font-weight: 500;
            flex-shrink: 0;
        }
        .sv-cat-btn-label {
            max-width: none !important;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: 700;
            color: #0F172A;
        }
        .sv-cat-btn-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-shrink: 0;
            margin-left: 0.5rem;
        }
        .sv-cat-btn-count {
            background: #0F172A;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
        }
        .sv-cat-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box;
            border-radius: 18px;
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.18), 0 0 0 1px rgba(15, 23, 42, 0.05);
            max-height: 340px;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            padding: 0.6rem;
        }
        .sv-cat-menu-header {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94A3B8;
            padding: 0.5rem 0.75rem;
            border-bottom: 1px solid #F1F5F9;
            margin-bottom: 0.4rem;
        }
        .sv-cat-item-link {
            padding: 0.75rem 0.85rem !important;
            font-size: 0.875rem !important;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sv-search-wrap {
            margin: 0.75rem auto 1.5rem;
            padding: 0 0.25rem;
        }
        .sv-search-box {
            padding: 0.35rem 0.45rem 0.35rem 1rem;
        }
        .sv-search-input {
            font-size: 0.875rem;
        }
        .sv-search-btn {
            padding: 0.55rem 1.15rem;
            font-size: 0.8125rem;
        }
    }
    @media (max-width: 640px) {
        .sv-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }
        .sv-section { padding: 1.5rem 0.75rem 4rem; }
        .sv-hero-premium { padding: 7rem 1rem 3.5rem; }
        .sv-card { border-radius: 14px; }
        .sv-card-body { padding: 0.875rem; }
        .sv-card-name { font-size: 0.875rem; margin-bottom: 0.25rem; line-height: 1.3; }
        .sv-card-desc {
            font-size: 0.75rem; margin-bottom: 0.6rem;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
            line-height: 1.4;
        }
        .sv-card-cat { font-size: 0.55rem; padding: 0.2rem 0.45rem; margin-bottom: 0.35rem; }
        .sv-card-link { font-size: 0.72rem; padding-top: 0.5rem; }
        .sv-card-badge-top { top: 6px; left: 6px; right: 6px; }
        .sv-card-rating-badge { font-size: 0.6rem; padding: 2px 6px; }
        .sv-card-price-badge { font-size: 0.65rem; padding: 2px 6px; }
        .sv-cta-premium { padding: 3.5rem 1rem; }
        .sv-cta-btns { flex-direction: column; width: 100%; }
        .btn-primary-v2, .btn-outline-v2 { width: 100%; justify-content: center; }
    }

    /* ═══ SEARCH BAR (PREMIUM MINIMALIST) ═══ */
    .sv-search-wrap {
        margin: 0 auto 2rem;
        max-width: 680px;
        position: relative;
    }
    .sv-search-box {
        position: relative;
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid #E2E8F0;
        border-radius: 50px;
        padding: 0.35rem 0.5rem 0.35rem 1.25rem;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .sv-search-box:focus-within {
        border-color: #0F172A;
        box-shadow: 0 8px 30px -4px rgba(15, 23, 42, 0.12), 0 0 0 3px rgba(15, 23, 42, 0.05);
        background: #ffffff;
    }
    .sv-search-icon {
        color: #94A3B8;
        flex-shrink: 0;
        margin-right: 0.75rem;
        transition: color 0.2s;
    }
    .sv-search-box:focus-within .sv-search-icon {
        color: #0F172A;
    }
    .sv-search-input {
        flex: 1;
        border: none;
        outline: none;
        font-family: var(--font);
        font-size: 0.9375rem;
        color: #0F172A;
        background: transparent;
        padding: 0.5rem 0;
    }
    .sv-search-input::placeholder {
        color: #94A3B8;
        font-weight: 400;
    }
    .sv-search-clear {
        display: none;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #F1F5F9;
        color: #64748B;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        margin-right: 0.35rem;
    }
    .sv-search-clear:hover {
        background: #E2E8F0;
        color: #0F172A;
    }
    .sv-search-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        background: #0F172A;
        color: #ffffff;
        font-family: var(--font);
        font-size: 0.8125rem;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .sv-search-btn:hover {
        background: #1E293B;
        transform: translateY(-1px);
    }

    /* ═══ SKELETON SHIMMER LOADING (PERSIS LAYOUT PRODUK) ═══ */
    .sv-skeleton-container {
        width: 100%;
        margin-top: 1.5rem;
    }
    .sv-skeleton-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        width: 100%;
    }
    @media (max-width: 1024px) {
        .sv-skeleton-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    }
    @media (max-width: 640px) {
        .sv-skeleton-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            margin-top: 0.5rem;
        }
    }
    .sv-skeleton-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.7);
        box-shadow: 0 4px 16px rgba(0,0,0,0.02);
        display: flex;
        flex-direction: column;
        position: relative;
    }
    @media (max-width: 640px) {
        .sv-skeleton-card { border-radius: 14px; }
    }
    .sv-shimmer {
        background: linear-gradient(90deg, #F1F5F9 0%, #E2E8F0 50%, #F1F5F9 100%);
        background-size: 200% 100%;
        animation: svShimmer 1.4s ease-in-out infinite;
    }
    @keyframes svShimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    .sv-skel-img {
        width: 100%;
        aspect-ratio: 4/3;
        min-height: 180px;
    }
    @media (max-width: 640px) {
        .sv-skel-img { min-height: 120px; }
    }
    .sv-skel-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    @media (max-width: 640px) {
        .sv-skel-body { padding: 0.875rem; }
    }
    .sv-skel-cat {
        width: 75px;
        height: 14px;
        border-radius: 20px;
        margin-bottom: 0.75rem;
    }
    @media (max-width: 640px) {
        .sv-skel-cat { width: 55px; height: 11px; margin-bottom: 0.4rem; }
    }
    .sv-skel-title-1 {
        width: 92%;
        height: 16px;
        border-radius: 5px;
        margin-bottom: 0.45rem;
    }
    .sv-skel-title-2 {
        width: 65%;
        height: 16px;
        border-radius: 5px;
        margin-bottom: 0.85rem;
    }
    @media (max-width: 640px) {
        .sv-skel-title-1 { height: 13px; margin-bottom: 0.3rem; }
        .sv-skel-title-2 { height: 13px; margin-bottom: 0.6rem; }
    }
    .sv-skel-desc-1 {
        width: 100%;
        height: 11px;
        border-radius: 4px;
        margin-bottom: 0.35rem;
    }
    .sv-skel-desc-2 {
        width: 78%;
        height: 11px;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
    @media (max-width: 640px) {
        .sv-skel-desc-1 { height: 9px; margin-bottom: 0.25rem; }
        .sv-skel-desc-2 { height: 9px; margin-bottom: 0.75rem; }
    }
    .sv-skel-link {
        width: 75px;
        height: 12px;
        border-radius: 4px;
        margin-top: auto;
        padding-top: 0.75rem;
        border-top: 1px solid #F1F5F9;
    }
    @media (max-width: 640px) {
        .sv-skel-link { width: 60px; height: 10px; }
    }

    .sv-infinite-end {
        padding: 3rem 0 1rem;
        text-align: center;
        color: #94A3B8;
        font-size: 0.8125rem;
        font-weight: 500;
        font-family: var(--font);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }
    .sv-infinite-end::before,
    .sv-infinite-end::after {
        content: '';
        height: 1px;
        width: 60px;
        background: #E2E8F0;
    }
    
    .sv-card.sv-fade-in {
        animation: svCardFadeIn 0.35s ease-out forwards;
    }
    @keyframes svCardFadeIn {
        from {
            opacity: 0;
            transform: translateY(14px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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

{{-- ═══ MINIMALIST FILTER TABS & DROPDOWN ═══ --}}
<div class="sv-filter-wrap">
    <div class="sv-filter-inner">
        {{-- Minimalist Pill Tabs --}}
        <div class="sv-filter-pills">
            <a href="{{ route('products') }}"
               class="sv-pill-tab {{ !$currentCat ? 'active' : '' }}"
               id="filter-all">
                Semua Produk
                <span class="pill-count">{{ \App\Models\Service::active()->count() }}</span>
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('products.category', $cat->slug) }}"
                   class="sv-pill-tab {{ ($currentCat && $currentCat->slug === $cat->slug) ? 'active' : '' }}"
                   id="filter-{{ $cat->slug }}">
                    {{ $cat->name }}
                    <span class="pill-count">{{ $cat->services()->where('is_active', true)->count() }}</span>
                </a>
            @endforeach
        </div>

        {{-- Custom Premium Category Dropdown (Hover on Desktop, Tap on Mobile) --}}
        <div class="sv-filter-dropdown-wrap" id="svCategoryDropdown">
            <button type="button" class="sv-cat-dropdown-btn" id="svCatToggleBtn" aria-haspopup="true" aria-expanded="false" title="Pilih Kategori">
                <span class="sv-cat-btn-left">
                    <svg class="sv-cat-btn-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="6" x2="20" y2="6"/>
                        <line x1="4" y1="12" x2="14" y2="12"/>
                        <line x1="4" y1="18" x2="18" y2="18"/>
                    </svg>
                    <span class="sv-cat-btn-prefix">Kategori:</span>
                    <span class="sv-cat-btn-label">
                        {{ $currentCat ? $currentCat->name : 'Semua Kategori' }}
                    </span>
                </span>
                <span class="sv-cat-btn-right">
                    <span class="sv-cat-btn-count">
                        {{ $currentCat ? $currentCat->services()->where('is_active', true)->count() : \App\Models\Service::active()->count() }}
                    </span>
                    <svg class="sv-cat-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </span>
            </button>

            <div class="sv-cat-dropdown-menu-bridge"></div>

            <div class="sv-cat-dropdown-menu" id="svCatMenu" role="menu">
                <div class="sv-cat-menu-header">Kategori Produk</div>
                <ul class="sv-cat-list">
                    <li>
                        <a href="{{ route('products') }}" class="sv-cat-item-link {{ !$currentCat ? 'is-active' : '' }}" role="menuitem">
                            <span class="sv-cat-item-name">
                                @if(!$currentCat)
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                @endif
                                Semua Kategori
                            </span>
                            <span class="sv-cat-item-count">{{ \App\Models\Service::active()->count() }}</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        @php
                            $catCount = $cat->services()->where('is_active', true)->count();
                            $isActive = ($currentCat && $currentCat->slug === $cat->slug);
                        @endphp
                        <li>
                            <a href="{{ route('products.category', $cat->slug) }}" class="sv-cat-item-link {{ $isActive ? 'is-active' : '' }}" role="menuitem">
                                <span class="sv-cat-item-name">
                                    @if($isActive)
                                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                    @endif
                                    {{ $cat->name }}
                                </span>
                                <span class="sv-cat-item-count">{{ $catCount }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- ═══ PRODUCTS GRID ═══ --}}
<section class="sv-section">
    <div class="sv-search-wrap">
        <form id="productSearchForm" onsubmit="event.preventDefault(); window.triggerSearch();">
            <div class="sv-search-box">
                <svg class="sv-search-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="productSearchInput" class="sv-search-input" placeholder="Cari piring, mangkok, cangkir..." value="{{ request('q') }}" autocomplete="off">
                <button type="button" id="productSearchClear" class="sv-search-clear" title="Hapus pencarian">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <button type="submit" class="sv-search-btn">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <div class="sv-grid-header">
        <p class="sv-grid-count">
            Menampilkan <strong>{{ $services->firstItem() ?? 0 }}-{{ $services->lastItem() ?? 0 }}</strong>
            dari <strong>{{ $services->total() }}</strong> produk
        </p>
    </div>

    <div class="sv-grid" id="productsGrid">
        @include('services._items', ['services' => $services])
    </div>

    {{-- Infinite Scroll Sentinel & Loading Indicator --}}
    <div id="infiniteSentinel" style="height: 20px; margin-top: 1.5rem;"></div>

    {{-- Skeleton Shimmer Loading (Persis Layout Produk Asli, Mobile-Friendly) --}}
    <div id="infiniteSkeleton" class="sv-skeleton-container" style="display: none;">
        <div class="sv-skeleton-grid">
            @for($k = 0; $k < 6; $k++)
                <div class="sv-skeleton-card">
                    <div class="sv-skel-img sv-shimmer"></div>
                    <div class="sv-skel-body">
                        <div class="sv-skel-cat sv-shimmer"></div>
                        <div class="sv-skel-title-1 sv-shimmer"></div>
                        <div class="sv-skel-title-2 sv-shimmer"></div>
                        <div class="sv-skel-desc-1 sv-shimmer"></div>
                        <div class="sv-skel-desc-2 sv-shimmer"></div>
                        <div class="sv-skel-link sv-shimmer"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div id="infiniteEnd" class="sv-infinite-end" style="{{ !$services->hasMorePages() && $services->total() > 0 ? 'display:flex;' : 'display:none;' }}">
        <span>Semua produk telah ditampilkan</span>
    </div>
</section>


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Kategori Dropdown Toggle
    const catWrap = document.getElementById('svCategoryDropdown');
    const catBtn = document.getElementById('svCatToggleBtn');
    if (catWrap && catBtn) {
        catBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = catWrap.classList.toggle('is-open');
            catBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
        document.addEventListener('click', function (e) {
            if (!catWrap.contains(e.target)) {
                catWrap.classList.remove('is-open');
                catBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // 2. INFINITE SCROLLING & LIVE SEARCH
    const grid = document.getElementById('productsGrid');
    const sentinel = document.getElementById('infiniteSentinel');
    const skeleton = document.getElementById('infiniteSkeleton');
    const endNotice = document.getElementById('infiniteEnd');
    const searchInput = document.getElementById('productSearchInput');
    const searchClear = document.getElementById('productSearchClear');
    const gridCount = document.querySelector('.sv-grid-count');

    let nextPageUrl = @json($services->nextPageUrl());
    let isLoading = false;
    let searchDebounceTimer = null;
    let currentSearch = @json(request('q', ''));

    function updateClearButton() {
        if (searchClear && searchInput) {
            searchClear.style.display = searchInput.value.trim().length > 0 ? 'inline-flex' : 'none';
        }
    }
    updateClearButton();

    // Fetch products (for search or initial page reset)
    window.triggerSearch = function () {
        const query = searchInput ? searchInput.value.trim() : '';
        currentSearch = query;
        updateClearButton();

        // Update browser URL query param without reload
        const url = new URL(window.location.href);
        if (query) {
            url.searchParams.set('q', query);
        } else {
            url.searchParams.delete('q');
        }
        url.searchParams.delete('page');
        window.history.replaceState({}, '', url.toString());

        // Perform AJAX request
        url.searchParams.set('ajax', '1');
        if (skeleton) skeleton.style.display = 'block';
        if (endNotice) endNotice.style.display = 'none';

        fetch(url.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            if (skeleton) skeleton.style.display = 'none';
            if (grid) grid.innerHTML = data.html;
            if (gridCount && data.countText) gridCount.innerHTML = data.countText;
            nextPageUrl = data.nextPageUrl;

            if (!data.hasMorePages && data.total > 0) {
                if (endNotice) endNotice.style.display = 'flex';
            } else {
                if (endNotice) endNotice.style.display = 'none';
            }
        })
        .catch(err => {
            console.error('Search error:', err);
            if (skeleton) skeleton.style.display = 'none';
        });
    };

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            updateClearButton();
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(window.triggerSearch, 350);
        });
    }

    if (searchClear) {
        searchClear.addEventListener('click', function () {
            if (searchInput) {
                searchInput.value = '';
                searchInput.focus();
                window.triggerSearch();
            }
        });
    }

    // Infinite Scroll IntersectionObserver
    function loadMoreProducts() {
        if (!nextPageUrl || isLoading) return;
        isLoading = true;
        if (skeleton) skeleton.style.display = 'block';

        const fetchUrl = new URL(nextPageUrl, window.location.origin);
        fetchUrl.searchParams.set('ajax', '1');

        fetch(fetchUrl.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            isLoading = false;
            if (skeleton) skeleton.style.display = 'none';

            if (data.html && grid) {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.html;
                const newCards = tempDiv.querySelectorAll('.sv-card');
                newCards.forEach(card => {
                    card.classList.add('sv-fade-in');
                    grid.appendChild(card);
                });
            }

            if (gridCount && data.countText) gridCount.innerHTML = data.countText;
            nextPageUrl = data.nextPageUrl;

            if (!data.hasMorePages) {
                if (endNotice) endNotice.style.display = 'flex';
            }
        })
        .catch(err => {
            console.error('Infinite scroll error:', err);
            isLoading = false;
            if (skeleton) skeleton.style.display = 'none';
        });
    }

    if ('IntersectionObserver' in window && sentinel) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting && nextPageUrl && !isLoading) {
                    loadMoreProducts();
                }
            });
        }, {
            root: null,
            rootMargin: '400px 0px',
            threshold: 0.05
        });
        observer.observe(sentinel);
    }
});
</script>

@endpush

@endsection
