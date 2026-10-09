@php
    if (!isset($settings)) {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
    }
    $apkBg = $settings['page_home_aplikasi_bg'] ?? '#0F172A';
    $apkCardBg = $settings['page_home_aplikasi_card_bg'] ?? '#1E293B';
    $apkCardText = $settings['page_home_aplikasi_card_text'] ?? '#FFFFFF';
    $apkLabelColor = $settings['page_home_aplikasi_label_color'] ?? '#94A3B8';
    $apkTitleColor = $settings['page_home_aplikasi_title_color'] ?? '#FFFFFF';
    $apkDescColor = $settings['page_home_aplikasi_desc_color'] ?? '#E2E8F0';

    $compName = $settings['company_name'] ?? 'Pusat Piring Keramik';
    $appsList = [
        [
            'title' => 'Hotel, Resort & Villa',
            'desc'  => 'Tableware keramik berstandar bintang lima untuk dining area, banquet, room service, dan acara mewah.',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1m-5 4h1m4 0h1m-5 4h1m4 0h1"/></svg>',
            'img'   => !empty($settings['app_img_restoran']) ? asset('storage/' . $settings['app_img_restoran']) : 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80'
        ],
        [
            'title' => 'Restoran, Kafe & Bistro',
            'desc'  => 'Piring keramik aesthetic & durable yang meningkatkan daya tarik visual sajian kuliner harian.',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 8h1a4 4 0 0 1 0 8h-1M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8zM6 1v3M10 1v3M14 1v3"/></svg>',
            'img'   => !empty($settings['app_img_pabrik']) ? asset('storage/' . $settings['app_img_pabrik']) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80'
        ],
        [
            'title' => 'Catering & Event Organizers',
            'desc'  => 'Perlengkapan makan tahan bentur & serbaguna untuk kebutuhan prasmanan dan acara pesta skala besar.',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
            'img'   => !empty($settings['app_img_gor']) ? asset('storage/' . $settings['app_img_gor']) : 'https://images.unsplash.com/photo-1555244162-803834f70033?w=800&q=80'
        ],
        [
            'title' => 'Grosir & Toko Piranti Dapur',
            'desc'  => 'Suplai stok piring keramik melimpah dengan harga grosir kompetitif untuk distributor & toko daerah.',
            'icon'  => '<svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
            'img'   => !empty($settings['app_img_dapur']) ? asset('storage/' . $settings['app_img_dapur']) : 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?w=800&q=80'
        ],
    ];
@endphp

<section class="cv-apps-premium" id="aplikasi">
    <style>
        .cv-apps-premium { background: {{ $apkBg }} !important; padding:5rem 1.5rem; border-top:1px solid rgba(255,255,255,0.1); }
        .cv-apps-inner-comp { max-width:1200px; margin:0 auto; }
        .cv-apps-header-comp { max-width:650px; margin-bottom:3rem; }
        .cv-adv-section-label-comp {
            display:inline-flex; align-items:center; gap:0.5rem; font-size:0.75rem;
            font-weight:700; letter-spacing:0.15em; text-transform:uppercase;
            color: {{ $apkLabelColor }} !important; margin-bottom:0.75rem; font-family:'Montserrat', sans-serif;
        }
        .cv-adv-section-label-comp::before {
            content:''; display:block; width:5px; height:5px; background: {{ $apkLabelColor }} !important; border-radius:50%;
        }
        .cv-adv-section-title-comp {
            font-size:clamp(1.75rem, 3vw, 2.5rem); font-weight:600; color: {{ $apkTitleColor }} !important;
            line-height:1.2; letter-spacing:-0.03em; margin:0; font-family:'Montserrat', sans-serif;
        }
        .cv-apps-grid-comp {
            display:grid; grid-template-columns:repeat(4, 1fr); gap:1.5rem;
        }
        .cv-app-card-comp {
            background: {{ $apkCardBg }} !important; border:1px solid rgba(255,255,255,0.15); border-radius:20px;
            overflow:hidden; display:flex; flex-direction:column; transition:all 0.35s cubic-bezier(0.22, 1, 0.36, 1);
            outline: none !important;
        }
        .cv-app-card-comp:hover { transform:translateY(-8px); border-color:#10B981; box-shadow:0 20px 40px rgba(0,0,0,0.3); outline: none !important; }
        .cv-app-img-wrapper-comp { width:100%; aspect-ratio:16/10; overflow:hidden; background: {{ $apkBg }} !important; }
        .cv-app-img-wrapper-comp img { width:100%; height:100%; object-fit:cover; transition:transform 0.5s ease; display:block; }
        .cv-app-card-comp:hover .cv-app-img-wrapper-comp img { transform:scale(1.06); }
        .cv-app-card-body-comp { padding:1.5rem; display:flex; flex-direction:column; gap:0.875rem; flex:1; }
        .cv-app-icon-circle-comp {
            width:44px; height:44px; background:rgba(255,255,255,0.12); border-radius:12px;
            display:flex; align-items:center; justify-content:center; color: {{ $apkCardText }} !important; flex-shrink:0; transition:all 0.3s ease;
        }
        .cv-app-card-comp:hover .cv-app-icon-circle-comp { background:#10B981; color:#ffffff !important; }
        .cv-app-card-title-comp { font-size:1.05rem; font-weight:600; color: {{ $apkCardText }} !important; margin:0; font-family:'Montserrat', sans-serif; line-height:1.3; }
        .cv-app-card-desc-comp { font-size:0.85rem; color: {{ $apkCardText }} !important; opacity:0.85; line-height:1.65; margin:0; font-family:'Montserrat', sans-serif; }

        @media (max-width: 1024px) { .cv-apps-grid-comp { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) {
            .cv-apps-premium { padding: 3rem 1.25rem !important; }
            .cv-apps-header-comp { margin-bottom: 1.75rem !important; }
            .cv-apps-grid-comp {
                display: flex; overflow-x: auto; scroll-snap-type: x mandatory; gap: 1rem; padding-bottom: 1rem;
                -webkit-overflow-scrolling: touch; scrollbar-width: none;
            }
            .cv-apps-grid-comp::-webkit-scrollbar { display: none; }
            .cv-app-card-comp { min-width: 82vw; max-width: 320px; flex-shrink: 0; scroll-snap-align: start; border-radius: 16px; }
            .cv-app-img-wrapper-comp { aspect-ratio: 16 / 10; max-height: 180px; }
            .cv-app-card-body-comp { padding: 1.25rem; gap: 0.75rem; }
            .cv-app-card-title-comp { font-size: 1rem; }
            .cv-app-card-desc-comp { font-size: 0.8rem; line-height: 1.55; }
        }
    </style>

    <div class="cv-apps-inner-comp">
        <div class="cv-apps-header-comp">
            <div class="cv-adv-section-label-comp">{{ $settings['aplikasi_section_label'] ?? 'APLIKASI' }}</div>
            <h2 class="cv-adv-section-title-comp">
                {!! nl2br(e($settings['aplikasi_section_title'] ?? "Cocok untuk\nBerbagai Industri")) !!}
            </h2>
            <p style="margin-top:1rem; font-size:0.875rem; color: {{ $apkDescColor }} !important; line-height:1.65; font-family:'Montserrat', sans-serif;">
                {{ $settings['aplikasi_section_desc'] ?? 'Pusat Piring Keramik menyediakan perlengkapan meja makan dan tableware premium yang dirancang khusus untuk memenuhi standar operasional berbagai sektor bisnis F&B.' }}
            </p>
        </div>

        <div class="cv-apps-grid-comp">
            @foreach($appsList as $app)
                <div class="cv-app-card-comp">
                    <div class="cv-app-img-wrapper-comp">
                        <img src="{{ $app['img'] }}" alt="{{ $app['title'] }}" loading="lazy">
                    </div>
                    <div class="cv-app-card-body-comp">
                        <div style="display:flex; align-items:center; gap:0.875rem;">
                            <div class="cv-app-icon-circle-comp">{!! $app['icon'] !!}</div>
                            <h3 class="cv-app-card-title-comp">{{ $app['title'] }}</h3>
                        </div>
                        <p class="cv-app-card-desc-comp">{{ $app['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
