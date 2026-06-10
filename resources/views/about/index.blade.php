@extends('layouts.app')
@section('content')

<div class="page-hero">
    <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">
        <nav class="breadcrumb" style="margin-bottom:1.5rem;">
            <a href="{{ route('home') }}">Home</a><span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">About Us</span>
        </nav>
        <div class="section-label" style="margin-bottom:0.75rem;">Tentang Kami</div>
        <h1 class="section-title" style="max-width:600px;">CV. Karya Perdana Teknik</h1>
        <p class="section-desc" style="margin-top:1rem;max-width:560px;">Spesialis Hoist, Crane System & Cargo Lift berdiri sejak 2013, melayani industri terkemuka di seluruh Indonesia.</p>
    </div>
</div>

{{-- Profile --}}
<section style="padding:6rem 1.5rem;" data-aos="fade-up">
    <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;">
        <div>
            <div class="section-label" style="margin-bottom:1rem;">Profil Perusahaan</div>
            <h2 class="section-title" style="margin:0 0 1.5rem;">Berpengalaman Sejak 2013</h2>
            <p class="section-desc" style="margin-bottom:1.25rem;">{{ $settings['about_text'] ?? 'CV. Karya Perdana Teknik berdiri sejak 2013, bergerak di bidang penyediaan, instalasi, dan perawatan mesin angkat & angkut industri.' }}</p>
            <p class="section-desc" style="margin-bottom:2rem;">Dengan pengalaman lebih dari 10 tahun dan lebih dari 28 klien perusahaan besar di seluruh Indonesia, kami telah membuktikan komitmen terhadap kualitas, keselamatan, dan kepuasan pelanggan.</p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
                @foreach([['10+','Tahun Pengalaman'],['28+','Klien Aktif'],['12','Jenis Produk'],['100%','Kepuasan Klien']] as $s)
                <div style="border-left:2px solid #F5A623;padding-left:1rem;">
                    <div style="font-size:1.75rem;font-weight:800;color:#F5A623;">{{ $s[0] }}</div>
                    <div style="font-size:0.8125rem;color:#A1A1AA;font-weight:400;">{{ $s[1] }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div>
            <img src="{{ !empty($settings['about_image']) ? asset('storage/'.$settings['about_image']) : 'https://picsum.photos/700/500?random=10' }}"
                 alt="Tim CV. Karya Perdana Teknik - Workshop Crane & Hoist" loading="lazy"
                 style="width:100%;height:460px;object-fit:cover;border:1px solid #27272A;">
        </div>
    </div>
</section>

{{-- Visi Misi --}}
<section style="padding:6rem 1.5rem;background:#0D0D0D;border-top:1px solid #27272A;" data-aos="fade-up">
    <div style="max-width:1280px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <div class="section-label" style="margin-bottom:0.75rem;">Fondasi Kami</div>
            <h2 class="section-title">Visi & Misi</h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;">
            <div style="background:#18181B;border:1px solid #27272A;padding:2.5rem;border-top:3px solid #F5A623;">
                <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
                    <div style="width:48px;height:48px;background:rgba(245,166,35,0.12);display:flex;align-items:center;justify-content:center;border-radius:4px;">
                        <svg width="24" height="24" fill="none" stroke="#F5A623" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <h3 style="font-size:1.25rem;font-weight:700;color:#fff;margin:0;">Visi</h3>
                </div>
                <p style="color:#D4D4D8;line-height:1.8;font-weight:300;margin:0;">{{ $settings['visi'] ?? 'Menjadi Perusahaan yang berkompeten dibidang penyediaan mesin angkat & angkut dengan management yang profesional.' }}</p>
            </div>
            <div style="background:#18181B;border:1px solid #27272A;padding:2.5rem;border-top:3px solid #F5A623;">
                <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;">
                    <div style="width:48px;height:48px;background:rgba(245,166,35,0.12);display:flex;align-items:center;justify-content:center;border-radius:4px;">
                        <svg width="24" height="24" fill="none" stroke="#F5A623" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </div>
                    <h3 style="font-size:1.25rem;font-weight:700;color:#fff;margin:0;">Misi</h3>
                </div>
                <p style="color:#D4D4D8;line-height:1.8;font-weight:300;margin:0;">{{ $settings['misi'] ?? 'Menciptakan pelayanan dan solusi menyeluruh dengan kualitas terbaik dalam pengadaan mesin angkat & angkut untuk meningkatkan nilai investasi pelanggan.' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Keunggulan --}}
<section style="padding:6rem 1.5rem;" data-aos="fade-up">
    <div style="max-width:1280px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <div class="section-label" style="margin-bottom:0.75rem;">Mengapa Memilih Kami</div>
            <h2 class="section-title">Keunggulan Kami</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;">
            @foreach($keunggulan as $k)
            <div style="background:#18181B;border:1px solid #27272A;padding:2rem;" class="service-card" data-aos="fade-up">
                <div style="width:44px;height:44px;background:rgba(245,166,35,0.12);display:flex;align-items:center;justify-content:center;border-radius:4px;margin-bottom:1.25rem;">
                    <svg width="22" height="22" fill="none" stroke="#F5A623" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <h3 style="font-size:1rem;font-weight:700;color:#fff;margin:0 0 0.625rem;">{{ $k['title'] }}</h3>
                <p style="font-size:0.875rem;color:#A1A1AA;margin:0;line-height:1.65;font-weight:300;">{{ $k['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Legalitas --}}
<section style="padding:4rem 1.5rem;background:#0D0D0D;border-top:1px solid #27272A;" data-aos="fade-up">
    <div style="max-width:1280px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:2.5rem;">
            <div class="section-label" style="margin-bottom:0.75rem;">Legalitas</div>
            <h2 class="section-title">Dokumen Resmi</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
            @foreach($legalitas as $l)
            <div style="background:#18181B;border:1px solid #27272A;padding:1.5rem;text-align:center;">
                <div style="font-size:0.6875rem;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:#F5A623;margin-bottom:0.5rem;">{{ $l['label'] }}</div>
                <div style="font-size:0.875rem;color:#D4D4D8;font-weight:500;word-break:break-all;">{{ $l['value'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Clients --}}
<section style="padding:5rem 1.5rem;" data-aos="fade-up">
    <div style="max-width:1280px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:2.5rem;">
            <div class="section-label" style="margin-bottom:0.75rem;">Portofolio Klien</div>
            <h2 class="section-title">28+ Klien Industri</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0.5rem;">
            @foreach($clients as $c)
            <div style="background:#18181B;border:1px solid #27272A;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;">
                <div style="width:6px;height:6px;background:#F5A623;border-radius:50%;flex-shrink:0;"></div>
                <div>
                    <div style="font-size:0.8125rem;font-weight:600;color:#D4D4D8;">{{ $c->name }}</div>
                    @if($c->city)<div style="font-size:0.6875rem;color:#A1A1AA;">{{ $c->city }}</div>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Testimonials --}}
@if($testimonials->count())
<section style="padding:5rem 1.5rem;background:#0D0D0D;border-top:1px solid #27272A;" data-aos="fade-up">
    <div style="max-width:1280px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:2.5rem;">
            <div class="section-label" style="margin-bottom:0.75rem;">Testimoni</div>
            <h2 class="section-title">Kata Klien Kami</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;">
            @foreach($testimonials as $t)
            <div style="background:#18181B;border:1px solid #27272A;padding:2rem;border-radius:4px;display:flex;flex-direction:column;gap:1rem;">
                {{-- Stars --}}
                <div style="display:flex;gap:3px;">
                    @for($i=1;$i<=5;$i++)
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="{{ $i<=($t->rating??5) ? '#FFD700' : 'rgba(255,215,0,.2)' }}" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    @endfor
                </div>
                {{-- Quote --}}
                <p style="font-size:0.9rem;color:#D4D4D8;line-height:1.75;margin:0;flex:1;">"{{ $t->content }}"</p>
                {{-- Author --}}
                <div style="display:flex;align-items:center;gap:0.875rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.07);">
                    @if($t->photo)
                    <img src="{{ asset('storage/'.$t->photo) }}" alt="{{ $t->name }}" loading="lazy"
                         style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;border:2px solid rgba(255,215,0,.3);">
                    @else
                    <img src="{{ $t->photo_url }}" alt="{{ $t->name }}" loading="lazy"
                         style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex-shrink:0;border:2px solid rgba(255,215,0,.3);">
                    @endif
                    <div>
                        <div style="font-weight:700;color:#fff;font-size:0.875rem;">{{ $t->name }}</div>
                        <div style="font-size:0.75rem;color:#A1A1AA;">{{ $t->position ? $t->position.', '.$t->company : $t->company }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
@media(max-width:900px){
    section [style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;}
    section [style*="grid-template-columns:repeat(3"]{grid-template-columns:1fr!important;}
    section [style*="grid-template-columns:repeat(4"]{grid-template-columns:repeat(2,1fr)!important;}
    section [style*="gap:5rem"]{gap:2rem!important;}
}
@media(max-width:600px){
    section [style*="grid-template-columns:repeat(2"]{grid-template-columns:1fr!important;}
    section [style*="grid-template-columns:repeat(4"]{grid-template-columns:1fr!important;}
}
</style>
@endsection
