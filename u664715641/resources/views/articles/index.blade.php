@extends('layouts.app')
@section('content')

<div class="page-hero">
    <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">
        <nav class="breadcrumb" style="margin-bottom:1.5rem;">
            <a href="{{ route('home') }}">Home</a><span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">Articles</span>
        </nav>
        <div class="section-label" style="margin-bottom:0.75rem;">Blog & Artikel</div>
        <h1 class="section-title">Tips, Panduan & Insight<br>Industri Crane & Lift</h1>
    </div>
</div>

<section style="padding:5rem 1.5rem;" data-aos="fade-up">
    <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:2fr 1fr;gap:4rem;align-items:start;">

        {{-- Articles Grid --}}
        <div>
            @if($articles->count())
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
                @foreach($articles as $i => $article)
                <a href="{{ route('articles.show', $article->slug) }}" class="article-card" style="text-decoration:none;display:block;" data-aos="fade-up" data-aos-delay="{{ ($i % 2) * 100 }}">
                    <div style="aspect-ratio:16/9;overflow:hidden;">
                        <img src="{{ $article->image_url }}" alt="{{ $article->alt_text ?? $article->title }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s;">
                    </div>
                    <div style="padding:1.5rem;">
                        <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:0.75rem;flex-wrap:wrap;">
                            @if($article->category)<span style="font-size:0.6875rem;font-weight:700;background:rgba(245,166,35,0.12);color:#F5A623;padding:0.2rem 0.5rem;text-transform:uppercase;letter-spacing:0.08em;">{{ $article->category }}</span>@endif
                            <span style="font-size:0.75rem;color:#3F3F46;">{{ $article->formatted_date }}</span>
                            <span style="font-size:0.75rem;color:#3F3F46;">· {{ $article->read_time }} mnt baca</span>
                        </div>
                        <h2 style="font-size:1rem;font-weight:700;color:#fff;margin:0 0 0.625rem;line-height:1.4;">{{ $article->title }}</h2>
                        <p style="font-size:0.8125rem;color:#A1A1AA;margin:0;line-height:1.65;font-weight:300;">{{ Str::limit($article->excerpt, 100) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            <div style="margin-top:2.5rem;">{{ $articles->links() }}</div>
            @else
            <div style="text-align:center;padding:5rem;color:#A1A1AA;">Belum ada artikel yang dipublish.</div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div style="position:sticky;top:6rem;">
            @if($categories->count())
            <div style="background:#18181B;border:1px solid #27272A;padding:1.5rem;margin-bottom:1.5rem;">
                <h3 style="font-size:0.8125rem;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:#F5A623;margin:0 0 1rem;">Kategori</h3>
                @foreach($categories as $cat)
                <a href="{{ route('articles') }}?category={{ $cat }}" style="display:flex;align-items:center;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid #27272A;text-decoration:none;color:#A1A1AA;font-size:0.875rem;transition:color 0.2s;" onmouseover="this.style.color='#F5A623'" onmouseout="this.style.color='#A1A1AA'">
                    {{ $cat }}<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                @endforeach
            </div>
            @endif
            @if($popular->count())
            <div style="background:#18181B;border:1px solid #27272A;padding:1.5rem;">
                <h3 style="font-size:0.8125rem;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:#F5A623;margin:0 0 1rem;">Artikel Populer</h3>
                @foreach($popular as $i => $p)
                <a href="{{ route('articles.show', $p->slug) }}" style="display:flex;gap:0.875rem;padding:0.875rem 0;border-bottom:1px solid #27272A;text-decoration:none;align-items:flex-start;">
                    <span style="font-size:1.5rem;font-weight:900;color:#27272A;line-height:1;flex-shrink:0;font-family:monospace;">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
                    <div>
                        <div style="font-size:0.875rem;font-weight:600;color:#D4D4D8;line-height:1.4;margin-bottom:0.25rem;transition:color 0.2s;" onmouseover="this.style.color='#F5A623'" onmouseout="this.style.color='#D4D4D8'">{{ Str::limit($p->title,60) }}</div>
                        <div style="font-size:0.6875rem;color:#3F3F46;">{{ number_format($p->views) }} views</div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
<style>
@media(max-width:1024px){ section [style*="grid-template-columns:2fr 1fr"]{grid-template-columns:1fr!important;} }
@media(max-width:600px){ section [style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;} }
</style>
@endsection
