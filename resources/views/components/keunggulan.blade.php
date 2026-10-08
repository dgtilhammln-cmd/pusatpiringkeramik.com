@php
$iconLib = [
    'shield'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    'check'    => '<path d="M5 12l5 5L20 7"/>',
    'clock'    => '<circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>',
    'users'    => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
    'tag'      => '<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>',
    'chat'     => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
    'star'     => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
    'truck'    => '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
    'globe'    => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
    'award'    => '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>',
    'box'      => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
    'heart'    => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>',
    'zap'      => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
    'building' => '<path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m4 0h1m-5 4h1m4 0h1m-5 4h1m4 0h1"/>',
    'leaf'     => '<path d="M17 8C8 10 5.9 16.17 3.82 19.5L5.71 18c.68-.43 1.51-.56 2.28-.37C9.58 18.03 10.6 21 14 21c3.86 0 7-3.14 7-7 0-1.61-.53-3.1-1.42-4.29L17 8z"/>',
    'diamond'  => '<path d="M2.7 10.3a2.41 2.41 0 0 0 0 3.41l7.59 7.59a2.41 2.41 0 0 0 3.41 0l7.59-7.59a2.41 2.41 0 0 0 0-3.41L13.7 2.71a2.41 2.41 0 0 0-3.41 0L2.7 10.3z"/>',
];
$cardDefaults = [
    1 => ['num'=>'#1','title'=>'Kualitas Premium','desc'=>'Menyediakan produk piring keramik & tableware premium food grade yang tahan panas dan awet.','bg'=>'#0F172A','num_color'=>'#ffffff','title_color'=>'#ffffff','desc_color'=>'rgba(255,255,255,0.75)','icon_key'=>'shield','icon_bg'=>'#DC2626','icon_color'=>'#ffffff','span'=>'1'],
    2 => ['num'=>'','title'=>'Cakupan Luas','desc'=>'Melayani pengiriman ke seluruh wilayah Indonesia dengan packing aman kayu & berasuransi.','bg'=>'#F1F5F9','num_color'=>'#0F172A','title_color'=>'#0F172A','desc_color'=>'#64748B','icon_key'=>'check','icon_bg'=>'#FEE2E2','icon_color'=>'#DC2626','span'=>'1'],
    3 => ['num'=>'','title'=>'Distributor Resmi','desc'=>'Produk 100% original, tersertifikasi food grade dan didatangkan langsung dari pabrik resmi.','bg'=>'#F1F5F9','num_color'=>'#0F172A','title_color'=>'#0F172A','desc_color'=>'#64748B','icon_key'=>'award','icon_bg'=>'#FEE2E2','icon_color'=>'#DC2626','span'=>'1'],
    4 => ['num'=>'HORECA','title'=>'Siap Skala Besar','desc'=>'Memiliki kapasitas suplai besar untuk memenuhi permintaan Hotel, Restoran, Kafe, dan Grosir.','bg'=>'#DC2626','num_color'=>'#ffffff','title_color'=>'rgba(255,255,255,0.9)','desc_color'=>'rgba(255,255,255,0.75)','icon_key'=>'users','icon_bg'=>'rgba(255,255,255,0.2)','icon_color'=>'#ffffff','span'=>'1'],
    5 => ['num'=>'','title'=>'Desain Variatif','desc'=>'Beragam pilihan model piring keramik modern & vintage untuk mempercantik hidangan F&B.','bg'=>'#F1F5F9','num_color'=>'#EF4444','title_color'=>'#0F172A','desc_color'=>'#64748B','icon_key'=>'tag','icon_bg'=>'#FEE2E2','icon_color'=>'#DC2626','span'=>'1'],
    6 => ['num'=>'','title'=>'Layanan Konsultasi','desc'=>'Tim kami selalu siap mendampingi Anda dalam memilih jenis tableware dan kuantitas paling tepat.','bg'=>'#F1F5F9','num_color'=>'#0F172A','title_color'=>'#0F172A','desc_color'=>'#64748B','icon_key'=>'chat','icon_bg'=>'#FEE2E2','icon_color'=>'#DC2626','span'=>'1'],
    7 => ['num'=>'','title'=>'Terpercaya & Bergaransi','desc'=>'Dipercaya oleh ratusan hotel, restoran, catering, dan mitra usaha F&B di seluruh Indonesia.','bg'=>'#F1F5F9','num_color'=>'#0F172A','title_color'=>'#0F172A','desc_color'=>'#64748B','icon_key'=>'star','icon_bg'=>'#FEE2E2','icon_color'=>'#DC2626','span'=>'2'],
];
$cards = [];
foreach ($cardDefaults as $i => $def) {
    $cards[$i] = [
        'num'         => \App\Models\Setting::get("value_card_{$i}_num")         ?? $def['num'],
        'title'       => \App\Models\Setting::get("value_card_{$i}_title")       ?? $def['title'],
        'desc'        => \App\Models\Setting::get("value_card_{$i}_desc")        ?? $def['desc'],
        'bg'          => \App\Models\Setting::get("value_card_{$i}_bg")          ?? $def['bg'],
        'num_color'   => \App\Models\Setting::get("value_card_{$i}_num_color")   ?? $def['num_color'],
        'title_color' => \App\Models\Setting::get("value_card_{$i}_title_color") ?? $def['title_color'],
        'desc_color'  => \App\Models\Setting::get("value_card_{$i}_desc_color")  ?? $def['desc_color'],
        'icon_key'    => \App\Models\Setting::get("value_card_{$i}_icon_key")    ?? $def['icon_key'],
        'icon_img'    => \App\Models\Setting::get("value_card_{$i}_icon_img")    ?? '',
        'icon_bg'     => \App\Models\Setting::get("value_card_{$i}_icon_bg")     ?? $def['icon_bg'],
        'icon_color'  => \App\Models\Setting::get("value_card_{$i}_icon_color")  ?? $def['icon_color'],
        'span'        => \App\Models\Setting::get("value_card_{$i}_span")        ?? $def['span'],
    ];
}
@endphp

<style>
    .cv-adv-premium { background: {{ \App\Models\Setting::get('page_home_value_bg') ?? '#ffffff' }}; padding: 5rem 0; }
    .cv-adv-inner { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
    .cv-adv-header { display:flex; justify-content:space-between; align-items:flex-end; gap:2rem; margin-bottom:3.5rem; }
    .cv-adv-section-label { font-size:.75rem; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:#64748B; display:flex; align-items:center; gap:.5rem; margin-bottom:1rem; }
    .cv-adv-section-label::before { content:''; width:4px; height:4px; border-radius:50%; background:#DC2626; }
    .cv-adv-section-title { font-size:clamp(2rem,3.5vw,3rem); font-weight:500; color:#0F172A; line-height:1.15; letter-spacing:-.025em; }
    .cv-adv-cards { display:grid; grid-template-columns:repeat(4,1fr); gap:1.25rem; }
    .cv-adv-card-v2 { background:{{ \App\Models\Setting::get('page_home_value_card_bg') ?? '#F1F5F9' }}; border-radius:22px; padding:2rem; position:relative; overflow:hidden; display:flex; flex-direction:column; min-height:240px; transition:transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s; }
    .cv-adv-card-v2:hover { transform:translateY(-6px); box-shadow:0 20px 50px rgba(14,165,233,.1); }
    .cv-adv-card-icon-wrap { width:48px; height:48px; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:1.5rem; flex-shrink:0; }
    .cv-adv-card-icon-wrap img { width:22px; height:22px; object-fit:contain; }
    .cv-adv-card-num { font-size:2.75rem; font-weight:400; line-height:1; letter-spacing:-.04em; margin-bottom:.5rem; }
    .cv-adv-card-title { font-size:1rem; font-weight:600; margin-bottom:.5rem; }
    .cv-adv-card-desc { font-size:.8125rem; line-height:1.65; margin-top:auto; }
    @media(max-width:1024px){ .cv-adv-cards { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:768px){
        .cv-adv-premium { padding:3.5rem 0; }
        .cv-adv-header { flex-direction:column; align-items:flex-start; gap:1rem; }
        .cv-adv-header p { text-align:left !important; }
        .cv-adv-cards { grid-template-columns:none !important; grid-auto-flow:column; grid-auto-columns:78vw; overflow-x:auto; scroll-snap-type:x mandatory; padding-bottom:1.5rem; -webkit-overflow-scrolling:touch; scrollbar-width:none; gap:1rem; }
        .cv-adv-cards::-webkit-scrollbar { display:none; }
        .cv-adv-cards > * { scroll-snap-align:start; }
        .cv-adv-card-v2 { min-height:180px; }
        .cv-adv-card-span-2 { grid-column:auto !important; flex-direction:column !important; align-items:flex-start !important; }
    }
</style>

<section class="cv-adv-premium" id="keunggulan">
    <div class="cv-adv-inner">
        <div class="cv-adv-header">
            <div>
                <div class="cv-adv-section-label">{{ \App\Models\Setting::get('value_section_label') ?? 'KEUNGGULAN' }}</div>
                <h2 class="cv-adv-section-title">{{ \App\Models\Setting::get('value_section_title') ?? 'Mengapa Pilih ' . ($companyName ?? 'Pusat Piring Keramik') . '?' }}</h2>
            </div>
            <p style="max-width:320px;font-size:.875rem;color:#64748B;line-height:1.65;text-align:right;">
                {{ \App\Models\Setting::get('value_section_desc') ?? 'Solusi suplai tableware dan piring keramik berkualitas tinggi untuk kebutuhan restoran, hotel, catering, dan bisnis F&B di seluruh Indonesia.' }}
            </p>
        </div>

        <div class="cv-adv-cards">
            @foreach($cards as $i => $card)
                @php
                    $isSpan2  = $card['span'] == '2';
                    $spanAttr = $isSpan2 ? 'grid-column:span 2; flex-direction:row; gap:2rem; align-items:center;' : '';
                    $delay    = ($i - 1) * 60;
                    $iconSvg  = $iconLib[$card['icon_key']] ?? $iconLib['star'];
                @endphp
                <div class="cv-adv-card-v2 @if($isSpan2) cv-adv-card-span-2 @endif"
                     data-aos="fade-up" data-aos-delay="{{ $delay }}"
                     style="background:{{ $card['bg'] }}; {{ $spanAttr }}">

                    <div class="cv-adv-card-icon-wrap"
                         style="background:{{ $card['icon_bg'] }}; color:{{ $card['icon_color'] }}; @if($isSpan2) width:60px;height:60px; @endif">
                        @if(!empty($card['icon_img']))
                            <img src="{{ asset('storage/' . $card['icon_img']) }}" alt="{{ $card['title'] }}">
                        @else
                            <svg width="{{ $isSpan2 ? 28 : 22 }}" height="{{ $isSpan2 ? 28 : 22 }}"
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                {!! $iconSvg !!}
                            </svg>
                        @endif
                    </div>

                    @if($isSpan2)<div>@endif

                    @if(!empty($card['num']))
                        <div class="cv-adv-card-num" style="color:{{ $card['num_color'] }};">{{ $card['num'] }}</div>
                    @endif
                    <div class="cv-adv-card-title" style="color:{{ $card['title_color'] }}; @if($isSpan2) font-size:1.125rem; margin-bottom:.5rem; @endif">{{ $card['title'] }}</div>
                    <div class="cv-adv-card-desc" style="color:{{ $card['desc_color'] }};">{{ $card['desc'] }}</div>

                    @if($isSpan2)</div>@endif
                </div>
            @endforeach
        </div>
    </div>
</section>
