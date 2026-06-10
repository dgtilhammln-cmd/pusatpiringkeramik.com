{{-- Navbar Component --}}
@php
    $logo   = \App\Models\Setting::get('logo');
    $waNav  = \App\Models\WaSetting::primary();
    $navLinks = [
        ['url' => route('home'),     'label' => 'Home'],
        ['url' => route('about'),    'label' => 'About'],
        ['url' => route('services'), 'label' => 'Layanan'],
        ['url' => route('gallery'),  'label' => 'Galeri'],
        ['url' => route('articles'), 'label' => 'Artikel'],
        ['url' => route('contact'),  'label' => 'Kontak'],
    ];
@endphp

<style>
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
        --font: 'Montserrat', sans-serif;
        --ease: cubic-bezier(0.25,0.46,0.45,0.94);
        --nav-h: 64px;
        --top-h: 36px;
    }

    /* ── CP BANNER LINK (in topbar) ── */
    .topbar-cp-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        color: var(--c-accent);
        font-family: var(--font);
        font-size: 0.63rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: opacity 0.2s;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .topbar-cp-link:hover { opacity: 0.7; }

    .topbar-cp-pill {
        background: var(--c-accent);
        color: #000;
        font-family: var(--font);
        font-size: 0.55rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        padding: 1px 6px;
        border-radius: 20px;
        text-transform: uppercase;
        line-height: 1.7;
        flex-shrink: 0;
    }

    @media (max-width: 960px) {
        .topbar-cp-link { display: none; }
    }

    /* ── TOPBAR ── */
    .topbar {
        background: #0a0a0a;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        height: var(--top-h);
        overflow: hidden;
        position: relative;
        z-index: 101;
    }

    .topbar-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    /* alamat */
    .topbar-address {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-family: var(--font);
        font-size: 0.65rem;
        font-weight: 400;
        color: var(--c-muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .topbar-address svg { flex-shrink: 0; color: var(--c-accent); }

    /* ticker kanan */
    .topbar-right {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        flex-shrink: 0;
    }

    /* ticker teks berganti */
    .topbar-ticker-wrap {
        height: var(--top-h);
        overflow: hidden;
        flex-shrink: 0;
    }

    .topbar-ticker {
        display: flex;
        flex-direction: column;
        animation: tickerSlide 5s ease-in-out infinite;
    }

    .topbar-ticker-item {
        height: var(--top-h);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        font-family: var(--font);
        font-size: 0.63rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--c-accent);
        white-space: nowrap;
        flex-shrink: 0;
    }

    @keyframes tickerSlide {
        0%,  40% { transform: translateY(0); }
        55%, 95% { transform: translateY(calc(-1 * var(--top-h))); }
        100%     { transform: translateY(0); }
    }

    /* sosmed */
    .topbar-socials {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .topbar-social-link {
        width: 22px; height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--c-muted);
        transition: color 0.2s;
    }

    .topbar-social-link:hover { color: var(--c-accent); }

    .topbar-divider {
        width: 1px;
        height: 14px;
        background: var(--c-border2);
        flex-shrink: 0;
    }

    /* ── NAVBAR ── */
    #navbar {
        position: sticky;
        top: 0;
        z-index: 100;
        height: var(--nav-h);
        background: rgba(10,10,10,0.88);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-bottom: 1px solid var(--c-border);
        transition: background 0.3s, box-shadow 0.3s;
        font-family: var(--font);
    }

    #navbar.scrolled {
        background: rgba(10,10,10,0.97);
        box-shadow: 0 4px 24px rgba(0,0,0,0.4);
    }

    .nav-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }

    /* Logo */
    .nav-logo {
        display: flex;
        align-items: center;
        flex-shrink: 0;
        text-decoration: none;
    }

    .nav-logo img {
        height: 40px;
        width: auto;
        object-fit: contain;
    }

    .nav-logo-badge {
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    /* Desktop links */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 0.125rem;
        flex: 1;
        justify-content: center;
    }

    .nav-link {
        position: relative;
        padding: 0.5rem 0.875rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: rgba(255,255,255,0.62);
        text-decoration: none;
        white-space: nowrap;
        transition: color 0.2s;
        letter-spacing: 0.02em;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0; left: 50%; right: 50%;
        height: 1px;
        background: var(--c-accent);
        transition: left 0.3s var(--ease), right 0.3s var(--ease);
    }

    .nav-link:hover,
    .nav-link.active { color: var(--c-white); }

    .nav-link:hover::after,
    .nav-link.active::after { left: 0.875rem; right: 0.875rem; }

    .nav-link.active { color: var(--c-accent); font-weight: 700; }

    /* Desktop CTA */
    .nav-cta {
        display: flex;
        align-items: center;
        gap: 0.625rem;
        flex-shrink: 0;
    }

    .nav-btn-order {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: transparent;
        border: 1px solid rgba(255,215,0,0.35);
        color: var(--c-accent);
        font-family: var(--font);
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        padding: 0.55rem 1.1rem;
        border-radius: 24px;
        cursor: pointer;
        white-space: nowrap;
        transition: background 0.25s, border-color 0.25s;
    }

    .nav-btn-order:hover {
        background: rgba(255,215,0,0.08);
        border-color: var(--c-accent);
    }

    .nav-btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--c-accent);
        color: #000;
        font-family: var(--font);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        padding: 0.55rem 1.1rem;
        border-radius: 24px;
        text-decoration: none;
        white-space: nowrap;
        transition: background 0.25s, box-shadow 0.25s, transform 0.2s;
    }

    .nav-btn-wa:hover {
        background: #fff;
        box-shadow: 0 4px 16px rgba(255,215,0,0.22);
        transform: translateY(-1px);
    }

    /* Hamburger */
    #mobile-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        color: var(--c-white);
        flex-shrink: 0;
    }

    .ham-icon, .close-icon { transition: opacity 0.2s; }
    .close-icon { display: none; }

    /* Mobile menu */
    #mobile-menu {
        display: none;
        position: fixed;
        top: calc(var(--top-h) + var(--nav-h));
        left: 0; right: 0;
        background: rgba(8,8,8,0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--c-border);
        z-index: 99;
        animation: slideDown 0.28s var(--ease) both;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    #mobile-menu.open { display: block; }

    .mobile-menu-inner {
        padding: 1rem 1.5rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .mobile-nav-link {
        padding: 0.875rem 0;
        font-family: var(--font);
        font-size: 0.9375rem;
        font-weight: 500;
        color: rgba(255,255,255,0.72);
        text-decoration: none;
        border-bottom: 1px solid var(--c-border);
        transition: color 0.2s;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .mobile-nav-link:last-of-type { border-bottom: none; }
    .mobile-nav-link:hover, .mobile-nav-link.active { color: var(--c-accent); }
    .mobile-nav-link.active { font-weight: 700; }

    .mobile-cta-wrap {
        margin-top: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
    }

    .mobile-btn-order {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: transparent;
        border: 1px solid rgba(255,215,0,0.45);
        color: var(--c-accent);
        font-family: var(--font);
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.875rem;
        border-radius: 24px;
        cursor: pointer;
        width: 100%;
        transition: background 0.25s;
    }

    .mobile-btn-order:hover { background: rgba(255,215,0,0.08); }

    .mobile-btn-wa {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: var(--c-accent);
        color: #000;
        font-family: var(--font);
        font-size: 0.875rem;
        font-weight: 700;
        padding: 0.875rem;
        border-radius: 24px;
        text-decoration: none;
        width: 100%;
        transition: background 0.25s;
    }

    .mobile-btn-wa:hover { background: #fff; }

    /* Responsive */
    @media (max-width: 960px) {
        .nav-links { display: none; }
        .nav-cta   { display: none; }
        #mobile-toggle { display: flex; }
        .topbar-address { display: none; }
    }

    @media (max-width: 480px) {
        .topbar-ticker-item { font-size: 0.58rem; }
    }
</style>

{{-- ── TOPBAR ── --}}
<div class="topbar">
    <div class="topbar-inner">

        {{-- Alamat --}}
        <div class="topbar-address">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>
            </svg>
            Pergudangan Legundi Business Park Blok D-11, Legundi - Gresik - Jawa Timur
        </div>

        {{-- Download Company Profile --}}
        <a href="{{ asset('storage/Profil_Perusahaan_Karya_Perdana_Teknik.pdf') }}"
           target="_blank"
           rel="noopener"
           class="topbar-cp-link"
           aria-label="Download Company Profile PDF">
            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 15V3m0 12l-4-4m4 4l4-4M2 17l.621 2.485A2 2 0 004.561 21h14.878a2 2 0 001.94-1.515L22 17"/>
            </svg>
            Download Company Profile
            <span class="topbar-cp-pill">PDF</span>
        </a>

        <div class="topbar-right">

            {{-- Teks berganti --}}
            <div class="topbar-ticker-wrap">
                <div class="topbar-ticker">
                    <div class="topbar-ticker-item">
                        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Standar K3
                    </div>
                    <div class="topbar-ticker-item">
                        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Garansi Aftersales
                    </div>
                </div>
            </div>

            <div class="topbar-divider"></div>

{{-- Sosmed --}}
<div class="topbar-socials">
    {{-- Facebook --}}
    <a href="https://www.facebook.com/hoistcraneliftcom" class="topbar-social-link" target="_blank" rel="noopener" aria-label="Facebook">
        <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
        </svg>
    </a>
    {{-- Twitter / X --}}
    <a href="https://twitter.com/HoistKpt" class="topbar-social-link" target="_blank" rel="noopener" aria-label="Twitter">
        <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
        </svg>
    </a>
    {{-- YouTube --}}
    <a href="https://www.youtube.com/@KaryaPerdanaTeknik" class="topbar-social-link" target="_blank" rel="noopener" aria-label="YouTube">
        <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/>
            <polygon fill="#fff" points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/>
        </svg>
    </a>
    {{-- Telegram --}}
    <a href="https://t.me/hoistcranekpt" class="topbar-social-link" target="_blank" rel="noopener" aria-label="Telegram">
        <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z"/>
        </svg>
    </a>
    {{-- Pinterest --}}
    <a href="https://pinterest.com/karyaperdanateknik" class="topbar-social-link" target="_blank" rel="noopener" aria-label="Pinterest">
        <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.477 2 2 6.477 2 12c0 4.236 2.636 7.855 6.356 9.312-.088-.791-.167-2.005.035-2.868.181-.78 1.172-4.97 1.172-4.97s-.299-.598-.299-1.482c0-1.388.806-2.428 1.808-2.428.852 0 1.265.64 1.265 1.408 0 .858-.546 2.140-.828 3.33-.236.995.499 1.806 1.476 1.806 1.772 0 3.136-1.867 3.136-4.563 0-2.387-1.715-4.055-4.163-4.055-2.836 0-4.498 2.126-4.498 4.322 0 .856.33 1.772.741 2.273a.3.3 0 01.069.286c-.076.311-.244.995-.277 1.134-.044.183-.146.222-.337.134-1.249-.581-2.03-2.407-2.03-3.874 0-3.154 2.292-6.052 6.608-6.052 3.469 0 6.165 2.473 6.165 5.776 0 3.447-2.173 6.22-5.19 6.22-1.013 0-1.967-.527-2.292-1.148l-.623 2.378c-.226.869-.835 1.958-1.244 2.621.937.29 1.931.446 2.962.446 5.523 0 10-4.477 10-10S17.523 2 12 2z"/>
        </svg>
    </a>
    {{-- LinkedIn --}}
    <a href="https://www.linkedin.com/company/kpt-hoist-crane-lift/" class="topbar-social-link" target="_blank" rel="noopener" aria-label="LinkedIn">
        <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
            <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
            <circle cx="4" cy="4" r="2"/>
        </svg>
    </a>
</div>

        </div>
    </div>
</div>

{{-- ── NAVBAR ── --}}
<nav id="navbar" aria-label="Navigasi Utama">
    <div class="nav-inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="nav-logo" aria-label="CV. Karya Perdana Teknik – Beranda">
            @if($logo)
                <img src="{{ asset('storage/'.$logo) }}" alt="CV. Karya Perdana Teknik" loading="eager">
            @else
                <div class="nav-logo-badge">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <rect width="40" height="40" rx="4" fill="#FFD700"/>
                        <text x="20" y="27" font-family="'Montserrat',sans-serif" font-size="13" font-weight="900" fill="#000" text-anchor="middle">KPT</text>
                    </svg>
                </div>
            @endif
        </a>

        {{-- Desktop links --}}
        <div class="nav-links">
            @foreach($navLinks as $link)
                <a href="{{ $link['url'] }}"
                   class="nav-link {{ request()->url() === $link['url'] ? 'active' : '' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Desktop CTA --}}
        <div class="nav-cta">
            <button onclick="openOrderModal()" class="nav-btn-order">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Request Order
            </button>

            @if($waNav)
                <button onclick="openOrderModal()" class="nav-btn-wa" data-track="wa">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Konsultasi
                </button>
            @endif
        </div>

        {{-- Hamburger --}}
        <button id="mobile-toggle" onclick="toggleMobileMenu()" aria-label="Toggle Menu" aria-expanded="false">
            <svg class="ham-icon" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="3" y1="6"  x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
            <svg class="close-icon" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6"  y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
</nav>

{{-- Mobile Menu --}}
<div id="mobile-menu" role="navigation" aria-label="Menu Mobile">
    <div class="mobile-menu-inner">
        @foreach($navLinks as $link)
            <a href="{{ $link['url'] }}"
               class="mobile-nav-link {{ request()->url() === $link['url'] ? 'active' : '' }}">
                {{ $link['label'] }}
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
        @endforeach

        <div class="mobile-cta-wrap">
            <button onclick="openOrderModal()" class="mobile-btn-order">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Request Order
            </button>
            @if($waNav)
                <button onclick="openOrderModal();document.getElementById('mobile-menu').classList.remove('open');" class="mobile-btn-wa" data-track="wa">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Konsultasi via WhatsApp
                </button>
            @endif
        </div>
    </div>
</div>

<script>
    function toggleMobileMenu() {
        const menu   = document.getElementById('mobile-menu');
        const toggle = document.getElementById('mobile-toggle');
        const ham    = toggle.querySelector('.ham-icon');
        const close  = toggle.querySelector('.close-icon');
        const isOpen = menu.classList.contains('open');

        menu.classList.toggle('open', !isOpen);
        toggle.setAttribute('aria-expanded', String(!isOpen));
        ham.style.display   = isOpen ? 'block' : 'none';
        close.style.display = isOpen ? 'none'  : 'block';
    }

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 30);
    }, { passive: true });

    // Tutup mobile menu saat resize ke desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth > 960) {
            const menu   = document.getElementById('mobile-menu');
            const toggle = document.getElementById('mobile-toggle');
            const ham    = toggle.querySelector('.ham-icon');
            const close  = toggle.querySelector('.close-icon');
            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
            ham.style.display   = 'block';
            close.style.display = 'none';
        }
    });
</script>