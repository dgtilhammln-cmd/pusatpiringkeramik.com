@extends('layouts.app')
@section('content')

<div class="page-hero">
    <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">
        <nav class="breadcrumb" style="margin-bottom:1.5rem;">
            <a href="{{ route('home') }}">Home</a><span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">Galeri Proyek</span>
        </nav>
        <div class="section-label" style="margin-bottom:0.75rem;">Galeri Proyek</div>
        <h1 class="section-title">Dokumentasi Proyek<br>di Lapangan</h1>
        <p class="section-desc" style="margin-top:1rem;max-width:500px;">Pemasangan &amp; instalasi crane, hoist &amp; lift di berbagai industri seluruh Indonesia.</p>
    </div>
</div>

<section style="padding:5rem 1.5rem;">
    <div style="max-width:1280px;margin:0 auto;">

        {{-- Category Filter --}}
        @if($categories->count())
        <div style="display:flex;gap:.625rem;flex-wrap:wrap;margin-bottom:2.5rem;" id="cat-filters">
            <button data-filter="all" onclick="filterGallery('all',this)"
                    style="padding:.5rem 1.25rem;font-size:.8125rem;font-weight:600;border:1px solid #FFD700;background:#FFD700;color:#000;cursor:pointer;border-radius:2px;transition:all .2s;font-family:inherit;">
                Semua
            </button>
            @foreach($categories as $cat)
            <button data-filter="{{ $cat }}" onclick="filterGallery('{{ $cat }}',this)"
                    style="padding:.5rem 1.25rem;font-size:.8125rem;font-weight:600;border:1px solid rgba(255,255,255,.1);background:transparent;color:#A1A1AA;cursor:pointer;border-radius:2px;transition:all .2s;font-family:inherit;"
                    onmouseover="if(!this.classList.contains('cat-active')){this.style.borderColor='#FFD700';this.style.color='#FFD700';}"
                    onmouseout="if(!this.classList.contains('cat-active')){this.style.borderColor='rgba(255,255,255,.1)';this.style.color='#A1A1AA';}">
                {{ $cat }}
            </button>
            @endforeach
        </div>
        @endif

        {{-- Grid --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;" id="gallery-grid">
            @foreach($gallery as $i => $item)
            <a href="{{ $item->slug ? route('gallery.show', $item->slug) : '#' }}"
               class="gallery-item"
               data-category="{{ $item->category }}"
               data-aos="fade-up"
               data-aos-delay="{{ ($i % 3) * 60 }}"
               style="display:block;text-decoration:none;border-radius:4px;overflow:hidden;">
                <img src="{{ $item->image_url }}"
                     alt="{{ $item->alt_text }}"
                     loading="{{ $i < 6 ? 'eager' : 'lazy' }}"
                     style="width:100%;height:100%;object-fit:cover;">
                <div class="gallery-overlay">
                    <div style="width:100%;">
                        @if($item->category)
                        <div style="font-size:.625rem;color:#FFD700;font-weight:700;text-transform:uppercase;letter-spacing:.1em;margin-bottom:.25rem;">{{ $item->category }}</div>
                        @endif
                        <div style="font-size:.9375rem;font-weight:700;color:#fff;">{{ $item->title }}</div>
                        @if($item->client)<div style="font-size:.75rem;color:rgba(255,255,255,.65);margin-top:.25rem;">{{ $item->client }}</div>@endif
                        @if($item->location)
                        <div style="font-size:.7rem;color:rgba(255,255,255,.45);margin-top:.125rem;display:flex;align-items:center;gap:.25rem;">
                            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $item->location }}
                        </div>
                        @endif
                        <div style="margin-top:.75rem;display:inline-flex;align-items:center;gap:.375rem;font-size:.7rem;color:#FFD700;font-weight:600;">
                            Lihat Detail
                            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        @if($gallery->isEmpty())
        <div style="text-align:center;padding:5rem;color:#A1A1AA;">
            <svg width="48" height="48" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 1rem;display:block;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <p>Belum ada foto proyek. Tambahkan dari panel admin.</p>
        </div>
        @endif
    </div>
</section>

<script>
function filterGallery(cat, btn) {
    document.querySelectorAll('#cat-filters button').forEach(b => {
        b.style.background = 'transparent';
        b.style.color = '#A1A1AA';
        b.style.borderColor = 'rgba(255,255,255,.1)';
        b.classList.remove('cat-active');
    });
    btn.style.background = '#FFD700';
    btn.style.color = '#000';
    btn.style.borderColor = '#FFD700';
    btn.classList.add('cat-active');
    document.querySelectorAll('.gallery-item').forEach(item => {
        const show = cat === 'all' || item.dataset.category === cat;
        item.style.display = show ? 'block' : 'none';
    });
}
</script>
<style>
@media(max-width:768px){ #gallery-grid{grid-template-columns:repeat(2,1fr)!important;} }
@media(max-width:480px){ #gallery-grid{grid-template-columns:1fr!important;} }
</style>
@endsection
