{{-- ═══════════════════════════════════════
FOOTER COMPONENT
resources/views/components/footer.blade.php
Data: ambil dari Setting model langsung di sini
═══════════════════════════════════════ --}}
@php
    $s = \App\Models\Setting::getAllAsArray();
    $svc = \App\Models\Service::where('is_active', true)->orderBy('order')->take(6)->get();
    $wa = \App\Models\WaSetting::where('is_active', true)->first();
@endphp

<style>
    /* ─── Footer ─────────────────────────────────── */
    .site-footer {
        background: #080808;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        position: relative;
        overflow: hidden;
        font-family: 'Montserrat', 'Plus Jakarta Sans', sans-serif;
    }

    /* shimmer top line */
    .site-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg,
                transparent 0%,
                rgba(255, 215, 0, 0.35) 25%,
                rgba(255, 215, 0, 0.75) 50%,
                rgba(255, 215, 0, 0.35) 75%,
                transparent 100%);
        background-size: 200% 100%;
        animation: footer-shimmer 4s linear infinite;
    }

    @keyframes footer-shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    .footer-glow-l {
        position: absolute;
        top: -140px;
        left: -140px;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.032) 0%, transparent 65%);
        pointer-events: none;
    }

    .footer-glow-r {
        position: absolute;
        bottom: -100px;
        right: -100px;
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.020) 0%, transparent 65%);
        pointer-events: none;
    }

    .footer-main {
        max-width: 1280px;
        margin: 0 auto;
        padding: 4rem 1.5rem 3rem;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 3rem;
        position: relative;
        z-index: 1;
    }

    /* Brand */
    .footer-brand-wrap {
        display: flex;
        flex-direction: column;
    }

    .footer-brand-name {
        font-size: 0.8rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 0.625rem;
        margin-bottom: 1rem;
    }

    .footer-brand-icon {
        width: 28px;
        height: 28px;
        background: #FFD700;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        flex-shrink: 0;
    }

    .footer-brand-desc {
        font-size: 0.78rem;
        font-weight: 300;
        color: #666670;
        line-height: 1.78;
        margin-bottom: 1.75rem;
        max-width: 280px;
    }

    .footer-contacts {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 0.625rem;
        font-size: 0.78rem;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.45);
        text-decoration: none;
        line-height: 1.5;
        transition: color 0.25s;
    }

    .footer-contact-item:hover {
        color: rgba(255, 255, 255, 0.9);
    }

    .footer-contact-icon {
        width: 28px;
        height: 28px;
        border-radius: 4px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.07);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: -0.1rem;
    }

    /* Columns */
    .footer-col-title {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #FFD700;
        margin: 0 0 1.25rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .footer-col-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 20px;
        height: 1px;
        background: #FFD700;
    }

    .footer-col-links {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
    }

    .footer-col-links a {
        font-size: 0.78rem;
        font-weight: 300;
        color: #666670;
        text-decoration: none;
        transition: color 0.25s, padding-left 0.25s;
    }

    .footer-col-links a:hover {
        color: #fff;
        padding-left: 4px;
    }

    /* Hours */
    .footer-hour-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 0.625rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        margin-bottom: 0.625rem;
        font-size: 0.72rem;
        color: #666670;
    }

    .footer-hour-val {
        font-weight: 600;
        color: #fff;
    }

    .footer-hour-val.closed {
        font-weight: 400;
        color: #3a3a42;
    }

    .footer-mini-cta {
        margin-top: 0.875rem;
        background: rgba(255, 215, 0, 0.04);
        border: 1px solid rgba(255, 215, 0, 0.1);
        border-radius: 8px;
        padding: 0.875rem 1rem;
    }

    .footer-mini-cta-label {
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #FFD700;
        margin-bottom: 0.3rem;
    }

    .footer-mini-cta-text {
        font-size: 0.72rem;
        font-weight: 300;
        color: #666670;
        line-height: 1.55;
    }

    /* Socials */
    .footer-social-row {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .footer-social {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.07);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3a3a42;
        text-decoration: none;
        transition: background 0.25s, border-color 0.25s, color 0.25s;
    }

    .footer-social:hover {
        background: rgba(255, 215, 0, 0.08);
        border-color: rgba(255, 215, 0, 0.22);
        color: #FFD700;
    }

    /* Bottom bar */
    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
        z-index: 1;
    }

    .footer-bottom-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .footer-copy {
        font-size: 0.72rem;
        font-weight: 300;
        color: #3a3a42;
        letter-spacing: 0.03em;
    }

    .footer-copy span {
        color: #666670;
    }

    .footer-legal {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .footer-legal span {
        font-size: 0.6875rem;
        color: rgba(255, 255, 255, 0.15);
    }

    .footer-dev-link {
        color: rgba(255, 215, 0, 0.5);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .footer-dev-link:hover {
        color: #FFD700;
    }

    /* Responsive */
    @media (max-width: 1100px) {
        .footer-main {
            grid-template-columns: 1fr 1fr 1fr;
        }

        .footer-main>.footer-brand-wrap {
            grid-column: span 3;
        }

        .footer-brand-desc {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .footer-main {
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .footer-main>.footer-brand-wrap {
            grid-column: span 2;
        }
    }

    @media (max-width: 500px) {
        .footer-main {
            grid-template-columns: 1fr;
        }

        .footer-main>.footer-brand-wrap {
            grid-column: span 1;
        }

        .footer-bottom-inner {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<footer class="site-footer" role="contentinfo">
    <div class="footer-glow-l" aria-hidden="true"></div>
    <div class="footer-glow-r" aria-hidden="true"></div>

    <div class="footer-main">

        {{-- ── Brand ── --}}
        <div class="footer-brand-wrap">
            <a href="{{ route('home') }}" aria-label="CV. Karya Perdana Teknik – Beranda"
                style="display:inline-block;margin-bottom:1rem;">
                @if(!empty($s['logo']))
                    <img src="{{ asset('storage/' . $s['logo']) }}" alt="Logo CV. Karya Perdana Teknik" loading="lazy"
                        style="height:48px;width:auto;object-fit:contain;">
                @else
                    <div class="footer-brand-name">
                        <div class="footer-brand-icon" aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                <polygon points="8,1 15,13 1,13" fill="#000" />
                            </svg>
                        </div>
                        CV. Karya Perdana Teknik
                    </div>
                @endif
            </a>

            <p class="footer-brand-desc">
                {{ $s['footer_desc'] ?? 'Spesialis Hoist, Crane System & Cargo Lift. Melayani pengadaan, instalasi, fabrikasi & maintenance di seluruh Indonesia sejak 2013.' }}
            </p>

            {{-- Social media --}}
            @if(!empty($s['instagram']) || !empty($s['facebook']) || !empty($s['youtube']))
                <div class="footer-social-row">
                    @if(!empty($s['instagram']))
                        <a href="{{ $s['instagram'] }}" class="footer-social" target="_blank" rel="noopener noreferrer"
                            aria-label="Instagram CV. Karya Perdana Teknik">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                aria-hidden="true">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                        </a>
                    @endif
                    @if(!empty($s['facebook']))
                        <a href="{{ $s['facebook'] }}" class="footer-social" target="_blank" rel="noopener noreferrer"
                            aria-label="Facebook CV. Karya Perdana Teknik">
                            <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                        </a>
                    @endif
                    @if(!empty($s['youtube']))
                        <a href="{{ $s['youtube'] }}" class="footer-social" target="_blank" rel="noopener noreferrer"
                            aria-label="YouTube CV. Karya Perdana Teknik">
                            <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z" />
                                <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#080808" />
                            </svg>
                        </a>
                    @endif
                </div>
            @endif

            {{-- Kontak --}}
            <div class="footer-contacts">
                <a href="tel:+623199171407" class="footer-contact-item" data-track="phone">
                    <span class="footer-contact-icon" aria-hidden="true">
                        <svg width="12" height="12" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24">
                            <path
                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.9a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" />
                        </svg>
                    </span>
                    <span>{{ $s['phone'] ?? '031 - 99171407' }}</span>
                </a>

                @if($wa)
                    <a href="{{ $wa->wa_url }}" target="_blank" rel="noopener" class="footer-contact-item" data-track="wa">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg width="12" height="12" fill="#25D366" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                        </span>
                        <span>{{ $s['wa1'] ?? '081331148731' }}</span>
                    </a>
                @endif

                <a href="mailto:{{ $s['email'] ?? 'karyaperdanateknik@gmail.com' }}" class="footer-contact-item"
                    data-track="email">
                    <span class="footer-contact-icon" aria-hidden="true">
                        <svg width="12" height="12" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </span>
                    <span>{{ $s['email'] ?? 'karyaperdanateknik@gmail.com' }}</span>
                </a>

                <div class="footer-contact-item">
                    <span class="footer-contact-icon" aria-hidden="true">
                        <svg width="11" height="11" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                    </span>
                    <span>{{ $s['address'] ?? 'Pergudangan Legundi Business Park Blok D-11, Legundi - Gresik - Jawa Timur' }}</span>
                </div>
            </div>
        </div>

        {{-- ── Navigasi ── --}}
        <nav aria-label="Footer navigasi">
            <div class="footer-col-title">Navigasi</div>
            <div class="footer-col-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('about') }}">Tentang Kami</a>
                <a href="{{ route('services') }}">Produk &amp; Layanan</a>
                <a href="{{ route('gallery') }}">Galeri Proyek</a>
                <a href="{{ route('articles') }}">Artikel &amp; Tips</a>
                <a href="{{ route('contact') }}">Kontak</a>
            </div>
        </nav>

        {{-- ── Layanan ── --}}
        <nav aria-label="Footer layanan">
            <div class="footer-col-title">Layanan</div>
            <div class="footer-col-links">
                @forelse($svc as $service)
                    <a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a>
                @empty
                    @foreach(['Overhead Crane', 'Chain Hoist', 'Wire Rope Hoist', 'Gantry Crane', 'Jib Crane', 'Cargo Lift'] as $prod)
                        <span style="color:rgba(255,255,255,0.4);font-size:0.78rem;font-weight:300;">{{ $prod }}</span>
                    @endforeach
                @endforelse
            </div>
        </nav>

        {{-- ── Jam Operasional ── --}}
        <div>
            <div class="footer-col-title">Jam Operasional</div>
            @php
                $hours = [
                    ['Senin – Jumat', '08.00 – 17.00', false],
                    ['Sabtu', '08.00 – 13.00', false],
                    ['Minggu', 'Tutup', true],
                ];
            @endphp
            @foreach($hours as $h)
                <div class="footer-hour-row">
                    <span>{{ $h[0] }}</span>
                    <span class="footer-hour-val {{ $h[2] ? 'closed' : '' }}">{{ $h[1] }}</span>
                </div>
            @endforeach

            <div class="footer-mini-cta">
                <div class="footer-mini-cta-label">Respon Cepat</div>
                <div class="footer-mini-cta-text">Pertanyaan darurat? Tim kami siap membantu via WhatsApp kapan saja.
                </div>
            </div>
        </div>

    </div>{{-- /footer-main --}}

    {{-- ── Bottom bar ── --}}
    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <p class="footer-copy">
                &copy; {{ date('Y') }} <span>CV. Karya Perdana Teknik.</span> Seluruh hak dilindungi.
            </p>
            <div class="footer-legal">
                @if(!empty($s['npwp']))
                    <span>NPWP: {{ $s['npwp'] }}</span>
                @endif
                @if(!empty($s['nib']))
                    <span>NIB: {{ $s['nib'] }}</span>
                @endif
                <span>
                    Developed by
                    <a href="https://hvmdigital.id" target="_blank" rel="noopener noreferrer" class="footer-dev-link">
                        HVM Digital ID
                    </a>
                </span>
            </div>
        </div>
    </div>

</footer>