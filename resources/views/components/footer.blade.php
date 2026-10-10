{{-- ═══════════════════════════════════
FOOTER COMPONENT — {{ $companyName }}
══════════════════════════════════ --}}
@php
    $s = \App\Models\Setting::getAllAsArray();
    $companyName    = $s['company_name'] ?? config('app.name');
    $companyTagline = $s['company_tagline'] ?? '';

    // Contact Info Fallbacks from Admin Settings
    $addressFull   = !empty($s['address_full']) ? $s['address_full'] : (!empty($s['address_street']) ? $s['address_street'] : 'Semarang, Jawa Tengah, Indonesia');
    $phoneDisplay  = !empty($s['phone']) ? $s['phone'] : '0818-0589-0181';
    $emailDisplay  = !empty($s['email']) ? $s['email'] : (!empty($s['contact_email']) ? $s['contact_email'] : 'admin@pusatpiringkeramik.com');
    $hoursDisplay  = !empty($s['business_hours']) ? $s['business_hours'] : 'Senin – Sabtu, 08.00 – 17.00 WIB';

    // WA Setting
    $wa = \App\Models\WaSetting::primary() ?? \App\Models\WaSetting::where('is_active', true)->first();
    $waPhoneDisplay = $wa?->nomor_wa ?? ($s['company_whatsapp'] ?? '081805890181');

    // Dynamic Styling Tokens
    $ftrBgType       = $s['footer_bg_type'] ?? 'gradient';
    $ftrBgColor      = $s['footer_bg_color'] ?? ($s['page_home_footer_bg'] ?? '#0F172A');
    $ftrBgGradient   = $s['footer_bg_gradient'] ?? 'linear-gradient(135deg, #0F172A 0%, #1E293B 100%)';
    $effectiveBg     = ($ftrBgType === 'gradient' && !empty($ftrBgGradient)) ? $ftrBgGradient : $ftrBgColor;

    $ftrHeadingColor = $s['footer_heading_color'] ?? '#FFFFFF';
    $ftrTextColor    = $s['footer_text_color'] ?? ($s['page_home_footer_text_color'] ?? '#94A3B8');
    $ftrLinkColor    = $s['footer_link_color'] ?? '#CBD5E1';
    $ftrLinkHover    = $s['footer_link_hover_color'] ?? '#38BDF8';
    $ftrIconBg       = $s['footer_icon_bg_color'] ?? 'rgba(255, 255, 255, 0.08)';
    $ftrIconColor    = $s['footer_icon_color'] ?? '#38BDF8';
    $ftrStarColor    = $s['footer_star_color'] ?? '#F59E0B';

    // Footer Rating & Text
    $ftrRatingVal   = $s['footer_rating_value'] ?? '4.9 / 5.0';
    $ftrRatingCount = $s['footer_rating_count_text'] ?? '134+ Ulasan Terverifikasi';
    $ftrDesc        = $s['footer_desc'] ?? 'Distributor & Supplier Piring Keramik terpercaya di Indonesia. Melayani kebutuhan grosir restoran, hotel, dan catering.';
    $ftrCopyright   = $s['footer_copyright'] ?? ('© ' . date('Y') . ' ' . $companyName . '. All rights reserved.');

    $col1Title = $s['footer_col_1_title'] ?? 'Kategori Produk';
    $col2Title = $s['footer_col_2_title'] ?? 'Navigasi';
    $col3Title = $s['footer_col_3_title'] ?? 'Kontak';
@endphp

<style>
    /* ═══════════════════════════════════
       FOOTER DYNAMIC STYLING
    ═══════════════════════════════════ */
    .cv-footer-v2 {
        background: {{ $effectiveBg }};
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        color: {{ $ftrTextColor }};
        font-family: 'Montserrat', sans-serif;
        position: relative;
    }

    /* ── MAIN GRID ─────────────────── */
    .cv-footer-v2-main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 5rem clamp(1.25rem, 5vw, 2.5rem) 4rem;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 3.5rem;
    }

    /* ── BRAND COL ─────────────────── */
    .cv-footer-v2-logo-wrap {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        text-decoration: none;
        margin-bottom: 1.5rem;
    }

    .cv-footer-v2-logo-icon {
        width: 46px;
        height: 46px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .cv-footer-v2-logo-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 4px;
    }

    .cv-footer-v2-brand-name {
        font-size: 1.25rem;
        font-weight: 800;
        color: {{ $ftrHeadingColor }};
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .cv-footer-v2-brand-sub {
        font-size: 0.65rem;
        font-weight: 600;
        color: {{ $ftrTextColor }};
        letter-spacing: 0.12em;
        text-transform: uppercase;
        margin-top: 2px;
        opacity: 0.85;
    }

    .cv-footer-v2-tagline {
        font-size: 0.9rem;
        font-weight: 400;
        color: {{ $ftrTextColor }};
        line-height: 1.75;
        margin-bottom: 1.75rem;
        max-width: 340px;
    }

    /* ── RATING BOX ─────────────────── */
    .cv-footer-rating-box {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1.75rem;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: 0.875rem 1.125rem;
        border-radius: 12px;
        max-width: 320px;
    }

    .cv-footer-stars {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .cv-footer-star-icon {
        color: {{ $ftrStarColor }};
        display: flex;
        align-items: center;
    }

    .cv-footer-rating-text {
        font-size: 0.875rem;
        font-weight: 700;
        color: {{ $ftrHeadingColor }};
        display: flex;
        align-items: center;
        gap: 0.4rem;
        flex-wrap: wrap;
    }

    .cv-footer-rating-subtext {
        color: {{ $ftrTextColor }};
        font-weight: 500;
        font-size: 0.8125rem;
        opacity: 0.9;
    }

    /* ── SOCIAL BUTTONS ─────────────── */
    .cv-footer-v2-socials {
        display: flex;
        gap: 0.6rem;
    }

    .cv-footer-v2-social-btn {
        width: 38px;
        height: 38px;
        background: {{ $ftrIconBg }};
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: {{ $ftrIconColor }};
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .cv-footer-v2-social-btn:hover {
        background: {{ $ftrLinkHover }};
        border-color: {{ $ftrLinkHover }};
        color: #0F172A;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(56, 189, 248, 0.3);
    }

    /* ── COLUMN HEADINGS ─────────── */
    .cv-footer-v2-col-title {
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: {{ $ftrHeadingColor }};
        margin-bottom: 1.5rem;
        position: relative;
    }

    /* ── LINKS ─────────────────────── */
    .cv-footer-v2-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .cv-footer-v2-links li {
        margin-bottom: 0.75rem;
    }

    .cv-footer-v2-links a {
        font-size: 0.875rem;
        font-weight: 400;
        color: {{ $ftrLinkColor }};
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.25s;
    }

    .cv-footer-v2-links a:hover {
        color: {{ $ftrLinkHover }};
        font-weight: 600;
        transform: translateX(3px);
    }

    /* ── CONTACT ITEMS ─────────────── */
    .cv-footer-v2-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 0.875rem;
        margin-bottom: 1.25rem;
    }

    .cv-footer-v2-contact-icon {
        width: 36px;
        height: 36px;
        background: {{ $ftrIconBg }};
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: {{ $ftrIconColor }};
        transition: all 0.25s;
    }

    .cv-footer-v2-contact-item:hover .cv-footer-v2-contact-icon {
        background: {{ $ftrLinkHover }};
        border-color: {{ $ftrLinkHover }};
        color: #0F172A;
        box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);
        transform: scale(1.05);
    }

    .cv-footer-v2-contact-label {
        font-size: 0.625rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: {{ $ftrHeadingColor }};
        display: block;
        margin-bottom: 3px;
        opacity: 0.9;
    }

    .cv-footer-v2-contact-text {
        font-size: 0.8125rem;
        font-weight: 400;
        color: {{ $ftrLinkColor }};
        line-height: 1.6;
    }

    .cv-footer-v2-contact-text a {
        color: {{ $ftrLinkColor }};
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }

    .cv-footer-v2-contact-text a:hover {
        color: {{ $ftrLinkHover }};
    }

    /* ── DIVIDER & BOTTOM BAR ─────────────── */
    .cv-footer-v2-divider {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        margin: 0;
    }

    .cv-footer-v2-bottom-wrap {
        background: rgba(0, 0, 0, 0.25);
    }

    .cv-footer-v2-bottom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem clamp(1.25rem, 5vw, 2.5rem);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .cv-footer-v2-copy {
        font-size: 0.8rem;
        color: {{ $ftrTextColor }};
        font-weight: 400;
    }

    .cv-footer-v2-copy strong {
        color: {{ $ftrHeadingColor }};
        font-weight: 600;
    }

    .cv-footer-v2-dev {
        font-size: 0.75rem;
        color: {{ $ftrTextColor }};
    }

    .cv-footer-v2-dev a {
        color: {{ $ftrLinkHover }};
        text-decoration: none;
        font-weight: 600;
        transition: opacity 0.2s;
    }

    .cv-footer-v2-dev a:hover {
        opacity: 0.8;
    }

    /* ── RESPONSIVE ────────────────── */
    @media (max-width: 1024px) {
        .cv-footer-v2-main {
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
        }
    }

    @media (max-width: 640px) {
        .cv-footer-v2-main {
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 3rem 1.25rem 2.5rem;
        }

        .cv-footer-v2-bottom {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .cv-footer-v2-tagline, .cv-footer-rating-box {
            max-width: 100%;
        }
    }
</style>

{{-- ════ MAIN FOOTER ════ --}}
<footer class="cv-footer-v2" role="contentinfo">

    <div class="cv-footer-v2-main">

        {{-- Brand Column --}}
        <div>
            <a href="{{ route('home') }}" class="cv-footer-v2-logo-wrap">
                <div class="cv-footer-v2-logo-icon">
                    @php $logo = \App\Models\Setting::get('logo'); @endphp
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo">
                    @else
                        <span style="font-weight:900;color:#0F172A;font-size:1rem;">{{ $companyName }}</span>
                    @endif
                </div>
                <div>
                    <div class="cv-footer-v2-brand-name">{{ $companyName }}</div>
                    @if($companyTagline)
                        <div class="cv-footer-v2-brand-sub">{{ $companyTagline }}</div>
                    @endif
                </div>
            </a>

            <p class="cv-footer-v2-tagline">
                {{ $ftrDesc }}
            </p>

            {{-- Dynamic Rating & Review Box --}}
            <div class="cv-footer-rating-box">
                <div class="cv-footer-stars">
                    @for($i=0; $i<5; $i++)
                        <span class="cv-footer-star-icon">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                            </svg>
                        </span>
                    @endfor
                </div>
                <div class="cv-footer-rating-text">
                    {{ $ftrRatingVal }} <span class="cv-footer-rating-subtext">&bull; {{ $ftrRatingCount }}</span>
                </div>
            </div>

            {{-- Social Icons --}}
            <div class="cv-footer-v2-socials">
                <a href="javascript:void(0)" onclick="openOrderModal('Footer WA Icon')" class="cv-footer-v2-social-btn"
                    title="WhatsApp" data-track="Footer WA Icon">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                </a>
                <a href="mailto:{{ $emailDisplay }}" class="cv-footer-v2-social-btn" title="Email">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,12 2,6" />
                    </svg>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phoneDisplay) }}" class="cv-footer-v2-social-btn" title="Telepon">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.5 12.05a19.79 19.79 0 01-3.07-8.67A2 2 0 012.41 1.5h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 9.4a16 16 0 006.69 6.69l1.27-.76a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Produk Column --}}
        <div>
            <div class="cv-footer-v2-col-title">{{ $col1Title }}</div>
            <ul class="cv-footer-v2-links">
                @php
                    $categories = \App\Models\ServiceCategory::take(5)->get();
                @endphp
                @if($categories->count())
                    @foreach($categories as $cat)
                        <li><a href="{{ route('products.category', $cat->slug) }}">{{ $cat->name }}</a></li>
                    @endforeach
                @else
                    <li><a href="{{ route('products') }}">Semua Produk</a></li>
                @endif
            </ul>
        </div>

        {{-- Navigasi Column --}}
        <div>
            <div class="cv-footer-v2-col-title">{{ $col2Title }}</div>
            <ul class="cv-footer-v2-links">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                <li><a href="{{ route('gallery') }}">Galeri Pengerjaan</a></li>
                <li><a href="{{ route('articles') }}">Artikel & Tips</a></li>
                <li><a href="{{ route('contact') }}">Hubungi Kami</a></li>
            </ul>
        </div>

        {{-- Kontak Column (Uses Admin Settings Fallback) --}}
        <div>
            <div class="cv-footer-v2-col-title">{{ $col3Title }}</div>

            <div class="cv-footer-v2-contact-item">
                <div class="cv-footer-v2-contact-icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="cv-footer-v2-contact-text">
                    <span class="cv-footer-v2-contact-label">Alamat</span>
                    <span class="cv-footer-v2-contact-value" style="font-size:0.85rem;line-height:1.4;">{{ $addressFull }}</span>
                </div>
            </div>

            <div class="cv-footer-v2-contact-item">
                <div class="cv-footer-v2-contact-icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.5 12.05a19.79 19.79 0 01-3.07-8.67A2 2 0 012.41 1.5h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 9.4a16 16 0 006.69 6.69l1.27-.76a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                    </svg>
                </div>
                @php
                    $cleanTel = preg_replace('/[^0-9]/', '', $phoneDisplay);
                    if (str_starts_with($cleanTel, '0')) {
                        $cleanTel = '62' . substr($cleanTel, 1);
                    }
                    $telHref = '+' . ltrim($cleanTel, '+');
                @endphp
                <div class="cv-footer-v2-contact-text">
                    <span class="cv-footer-v2-contact-label">Telepon</span>
                    <a href="tel:{{ $telHref }}">{{ $phoneDisplay }}</a>
                </div>
            </div>

            <div class="cv-footer-v2-contact-item">
                <div class="cv-footer-v2-contact-icon">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                </div>
                <div class="cv-footer-v2-contact-text">
                    <span class="cv-footer-v2-contact-label">WhatsApp</span>
                    <a href="javascript:void(0)" onclick="openOrderModal('Footer WA')" data-track="Footer WA">{{ $waPhoneDisplay }}</a>
                </div>
            </div>

            <div class="cv-footer-v2-contact-item">
                <div class="cv-footer-v2-contact-icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,12 2,6" />
                    </svg>
                </div>
                <div class="cv-footer-v2-contact-text">
                    <span class="cv-footer-v2-contact-label">Email</span>
                    <a href="mailto:{{ $emailDisplay }}">{{ $emailDisplay }}</a>
                </div>
            </div>

            <div class="cv-footer-v2-contact-item">
                <div class="cv-footer-v2-contact-icon">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
                <div class="cv-footer-v2-contact-text">
                    <span class="cv-footer-v2-contact-label">Jam Operasional</span>
                    {{ $hoursDisplay }}
                </div>
            </div>
        </div>

    </div>{{-- /cv-footer-v2-main --}}

    <hr class="cv-footer-v2-divider">

    <div class="cv-footer-v2-bottom-wrap">
        <div class="cv-footer-v2-bottom">
            <div class="cv-footer-v2-copy">
                <strong>{{ $ftrCopyright }}</strong>
            </div>
            <div class="cv-footer-v2-dev">
                Built by <a href="https://hvmdigital.id/jasa-pembuatan-website-jakarta-murah" target="_blank"
                    rel="noopener">hvmdigital.id</a>
            </div>
        </div>
    </div>

</footer>