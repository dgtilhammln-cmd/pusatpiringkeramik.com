@extends('layouts.app')
@section('content')

    {{-- Removed duplicate font import since it's in app.blade.php --}}

    <style>
    /* ═══════════════════════════════════════
       RESET & BASE
    ═══════════════════════════════════════ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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
      --radius-sm: 8px;
      --radius-md: 14px;
      --radius-lg: 22px;
      --font:      'Plus Jakarta Sans', sans-serif;
      --ease:      cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    body {
      font-family: var(--font);
      background: var(--c-bg);
      color: var(--c-text);
      font-weight: 300;
      -webkit-font-smoothing: antialiased;
      overflow-x: hidden;
    }

    img { display: block; }
    a   { text-decoration: none; color: inherit; }

    /* ═══════════════════════════════════════
       BUTTONS
    ═══════════════════════════════════════ */
    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--c-accent);
      color: #000;
      font-family: var(--font);
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      padding: 0.7rem 1.4rem;
      border-radius: 24px;
      border: none;
      cursor: pointer;
      transition: background 0.25s, box-shadow 0.25s;
      text-decoration: none;
    }

    .btn-primary:hover {
      background: #fff;
      box-shadow: 0 6px 20px rgba(255,215,0,0.2);
    }

    .btn-ghost {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255,255,255,0.07);
      color: var(--c-white);
      font-family: var(--font);
      font-size: 0.78rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      padding: 0.7rem 1.4rem;
      border-radius: 24px;
      border: 1px solid var(--c-border2);
      cursor: pointer;
      transition: background 0.25s, border-color 0.25s;
      text-decoration: none;
    }

    .btn-ghost:hover {
      background: rgba(255,255,255,0.11);
      border-color: rgba(255,255,255,0.2);
    }

    /* ═══════════════════════════════════════
       SECTION LABELS & TITLES
    ═══════════════════════════════════════ */
    .s-label {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.65rem;
      font-weight: 700;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--c-accent);
      margin-bottom: 0.625rem;
    }

    .s-label::before {
      content: '';
      display: block;
      width: 14px; height: 1px;
      background: var(--c-accent);
    }

    .s-title {
      font-size: clamp(1.5rem, 2.8vw, 2.25rem);
      font-weight: 200;
      color: var(--c-white);
      line-height: 1.1;
      letter-spacing: -0.025em;
    }

    .s-title strong { font-weight: 800; }

    /* ═══════════════════════════════════════
       BREADCRUMB
    ═══════════════════════════════════════ */
    .breadcrumb {
      display: flex;
      align-items: center;
      gap: 0.375rem;
      flex-wrap: wrap;
    }

    .breadcrumb a {
      font-size: 0.72rem;
      font-weight: 400;
      color: var(--c-muted);
      transition: color 0.2s;
    }

    .breadcrumb a:hover { color: var(--c-accent); }

    .breadcrumb-sep {
      font-size: 0.72rem;
      color: var(--c-dim);
    }

    .breadcrumb-current {
      font-size: 0.72rem;
      font-weight: 500;
      color: var(--c-text);
    }

    /* ═══════════════════════════════════════
       ARTICLE HERO
    ═══════════════════════════════════════ */
    .article-hero {
      padding: 7rem 1.5rem 3.5rem;
      background: var(--c-bg);
      border-bottom: 1px solid var(--c-border);
      position: relative;
      overflow: hidden;
    }

    .article-hero::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 1px;
      background: linear-gradient(
        90deg,
        transparent 0%,
        rgba(255,215,0,0.35) 25%,
        rgba(255,215,0,0.75) 50%,
        rgba(255,215,0,0.35) 75%,
        transparent 100%
      );
      background-size: 200% 100%;
      animation: shimmer 4s linear infinite;
    }

    @keyframes shimmer {
      0%   { background-position: -200% 0; }
      100% { background-position:  200% 0; }
    }

    .article-hero-glow {
      position: absolute;
      top: -120px; right: -100px;
      width: 480px; height: 480px;
      background: radial-gradient(circle, rgba(255,215,0,0.04) 0%, transparent 65%);
      pointer-events: none;
    }

    .article-hero-inner {
      max-width: 860px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
      animation: fadeUp 0.7s var(--ease) both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .article-cat-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.375rem;
      font-size: 0.62rem;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      background: rgba(255,215,0,0.1);
      color: var(--c-accent);
      padding: 0.3rem 0.75rem;
      border-radius: 3px;
      border: 1px solid rgba(255,215,0,0.15);
    }

    .article-meta-row {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      flex-wrap: wrap;
      margin-bottom: 1.25rem;
    }

    .article-meta-dot {
      color: var(--c-dim);
      font-size: 0.75rem;
    }

    .article-meta-item {
      font-size: 0.78rem;
      font-weight: 400;
      color: var(--c-muted);
    }

    .article-hero-title {
      font-size: clamp(1.75rem, 4vw, 2.75rem);
      font-weight: 800;
      line-height: 1.15;
      letter-spacing: -0.025em;
      color: var(--c-white);
      margin-bottom: 1.25rem;
    }

    .article-hero-excerpt {
      font-size: 0.9625rem;
      font-weight: 300;
      color: rgba(255,255,255,0.48);
      line-height: 1.8;
      max-width: 680px;
    }

    .article-author-row {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-top: 1.75rem;
      padding-top: 1.75rem;
      border-top: 1px solid var(--c-border);
    }

    .article-author-avatar {
      width: 38px; height: 38px;
      background: var(--c-accent);
      display: flex; align-items: center; justify-content: center;
      border-radius: 50%;
      font-weight: 800;
      color: #000;
      font-size: 0.875rem;
      flex-shrink: 0;
    }

    .article-author-name {
      font-size: 0.825rem;
      font-weight: 700;
      color: var(--c-white);
    }

    .article-author-company {
      font-size: 0.72rem;
      font-weight: 300;
      color: var(--c-muted);
    }

    /* ═══════════════════════════════════════
       FEATURED IMAGE
    ═══════════════════════════════════════ */
    .article-featured-img-wrap {
      max-width: 960px;
      margin: 0 auto;
      padding: 0 1.5rem;
    }

    .article-featured-img-wrap img {
      width: 100%;
      max-height: 520px;
      object-fit: cover;
      display: block;
      border-radius: 0 0 var(--radius-sm) var(--radius-sm);
      border: 1px solid var(--c-border);
      border-top: none;
    }

    /* ═══════════════════════════════════════
       ARTICLE BODY LAYOUT
    ═══════════════════════════════════════ */
    .article-body-section {
      padding: 3.5rem 1.5rem 5rem;
    }

    .article-body-inner {
      max-width: 1280px;
      margin: 0 auto;
    }

    .article-layout {
      display: grid;
      grid-template-columns: 1fr 300px;
      gap: 4rem;
      align-items: start;
    }

    /* ═══════════════════════════════════════
       TOC
    ═══════════════════════════════════════ */
    .article-toc {
      background: var(--c-card);
      border: 1px solid var(--c-border);
      border-left: 2px solid var(--c-accent);
      padding: 1.25rem 1.5rem;
      margin-bottom: 2.5rem;
      border-radius: var(--radius-sm);
    }

    .article-toc-title {
      font-size: 0.65rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.16em;
      color: var(--c-accent);
      margin-bottom: 0.875rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .article-toc ol {
      margin: 0;
      padding-left: 1.25rem;
      display: flex;
      flex-direction: column;
      gap: 0.375rem;
    }

    .article-toc li { list-style: decimal; }

    .article-toc a {
      font-size: 0.825rem;
      font-weight: 400;
      color: var(--c-muted);
      text-decoration: none;
      transition: color 0.2s;
    }

    .article-toc a:hover { color: var(--c-accent); }

    /* ═══════════════════════════════════════
       ARTICLE CONTENT
    ═══════════════════════════════════════ */
    .article-content {
      font-size: 0.9625rem;
      line-height: 1.9;
      color: #C8C8CC;
    }

    .article-content h2 {
      font-size: 1.375rem;
      font-weight: 800;
      color: var(--c-white);
      margin: 2.75rem 0 1rem;
      padding-top: 0.5rem;
      letter-spacing: -0.02em;
    }

    .article-content h3 {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--c-white);
      margin: 2rem 0 0.875rem;
      letter-spacing: -0.01em;
    }

    .article-content p {
      margin: 0 0 1.375rem;
    }

    .article-content ul,
    .article-content ol {
      margin: 0 0 1.375rem;
      padding-left: 1.5rem;
    }

    .article-content li { margin-bottom: 0.4rem; }

    .article-content a {
      color: var(--c-accent);
      text-decoration: underline;
      text-underline-offset: 3px;
    }

    .article-content blockquote {
      border-left: 2px solid var(--c-accent);
      padding: 1rem 1.375rem;
      background: rgba(255,215,0,0.04);
      margin: 2rem 0;
      border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
      color: rgba(255,255,255,0.6);
      font-style: italic;
      font-weight: 300;
    }

    .article-content code {
      background: rgba(255,255,255,0.06);
      border: 1px solid var(--c-border2);
      padding: 0.125rem 0.4rem;
      border-radius: 4px;
      font-size: 0.85em;
      color: var(--c-accent);
      font-family: 'Fira Code', monospace;
    }

    .article-content img {
      max-width: 100%;
      border-radius: var(--radius-sm);
      margin: 1.75rem 0;
      border: 1px solid var(--c-border);
    }

    /* ═══════════════════════════════════════
       FAQ
    ═══════════════════════════════════════ */
    .faq-section {
      margin-top: 3rem;
      padding-top: 2.5rem;
      border-top: 1px solid var(--c-border);
    }

    .faq-title {
      font-size: 1.1rem;
      font-weight: 800;
      color: var(--c-white);
      margin: 0 0 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.625rem;
      letter-spacing: -0.015em;
    }

    .faq-list {
      display: flex;
      flex-direction: column;
      gap: 0.625rem;
    }

    .faq-item {
      background: var(--c-card);
      border: 1px solid var(--c-border);
      border-radius: var(--radius-sm);
      overflow: hidden;
      transition: border-color 0.3s;
    }

    .faq-item:hover { border-color: var(--c-border2); }

    .faq-item summary {
      padding: 1rem 1.25rem;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--c-white);
      cursor: pointer;
      list-style: none;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      user-select: none;
    }

    .faq-item summary::-webkit-details-marker { display: none; }

    .faq-chevron { flex-shrink: 0; transition: transform 0.3s var(--ease); color: var(--c-accent); }
    .faq-item[open] .faq-chevron { transform: rotate(180deg); }

    .faq-answer {
      padding: 0.875rem 1.25rem 1.25rem;
      border-top: 1px solid var(--c-border);
      font-size: 0.875rem;
      font-weight: 300;
      color: var(--c-muted);
      line-height: 1.75;
    }

    /* ═══════════════════════════════════════
       CTA BOX
    ═══════════════════════════════════════ */
    .article-cta-box {
      margin-top: 3rem;
      background: linear-gradient(135deg, rgba(255,215,0,0.07), rgba(255,215,0,0.02));
      border: 1px solid rgba(255,215,0,0.18);
      padding: 2rem;
      border-radius: var(--radius-md);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .article-cta-box::before {
      content: '';
      position: absolute;
      top: -60px; right: -60px;
      width: 200px; height: 200px;
      background: radial-gradient(circle, rgba(255,215,0,0.06) 0%, transparent 70%);
      pointer-events: none;
    }

    .article-cta-box p {
      font-size: 0.875rem;
      font-weight: 300;
      color: var(--c-muted);
      margin: 0 0 1.25rem;
      position: relative;
      z-index: 1;
    }

    /* ═══════════════════════════════════════
       TAGS
    ═══════════════════════════════════════ */
    .article-tags {
      margin-top: 2.5rem;
      padding-top: 2rem;
      border-top: 1px solid var(--c-border);
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
      align-items: center;
    }

    .article-tags-label {
      font-size: 0.65rem;
      font-weight: 700;
      color: var(--c-dim);
      text-transform: uppercase;
      letter-spacing: 0.14em;
    }

    .article-tag {
      font-size: 0.72rem;
      font-weight: 400;
      background: var(--c-card);
      border: 1px solid var(--c-border);
      color: var(--c-muted);
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      transition: border-color 0.2s, color 0.2s;
    }

    .article-tag:hover {
      border-color: rgba(255,215,0,0.2);
      color: var(--c-accent);
    }

    /* ═══════════════════════════════════════
       SHARE
    ═══════════════════════════════════════ */
    .article-share {
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid var(--c-border);
      display: flex;
      align-items: center;
      gap: 0.875rem;
      flex-wrap: wrap;
    }

    .article-share-label {
      font-size: 0.72rem;
      font-weight: 700;
      color: var(--c-muted);
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .share-btn-wa {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      font-size: 0.78rem;
      font-weight: 600;
      color: #25D366;
      background: rgba(37,211,102,0.08);
      border: 1px solid rgba(37,211,102,0.2);
      padding: 0.45rem 1rem;
      border-radius: 20px;
      text-decoration: none;
      transition: background 0.25s;
      font-family: var(--font);
    }

    .share-btn-wa:hover { background: rgba(37,211,102,0.14); }

    .share-btn-copy {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--c-muted);
      background: var(--c-card);
      border: 1px solid var(--c-border);
      padding: 0.45rem 1rem;
      border-radius: 20px;
      cursor: pointer;
      transition: border-color 0.25s, color 0.25s;
      font-family: var(--font);
    }

    .share-btn-copy:hover {
      border-color: rgba(255,215,0,0.25);
      color: var(--c-accent);
    }

    /* ═══════════════════════════════════════
       SIDEBAR
    ═══════════════════════════════════════ */
    .article-sidebar {
      position: sticky;
      top: 5.5rem;
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    .sidebar-card {
      background: var(--c-card);
      border: 1px solid var(--c-border);
      border-radius: var(--radius-md);
      padding: 1.5rem;
      transition: border-color 0.3s;
    }

    .sidebar-card:hover { border-color: var(--c-border2); }

    .sidebar-card-title {
      font-size: 0.65rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.16em;
      color: var(--c-accent);
      margin-bottom: 0.875rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px solid var(--c-border);
    }

    .sidebar-desc {
      font-size: 0.78rem;
      font-weight: 300;
      color: var(--c-muted);
      line-height: 1.65;
      margin-bottom: 1.125rem;
    }

    /* Related in sidebar */
    .sidebar-related-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .sidebar-related-item {
      display: flex;
      gap: 0.75rem;
      align-items: flex-start;
      text-decoration: none;
      transition: opacity 0.2s;
    }

    .sidebar-related-item:hover { opacity: 0.8; }

    .sidebar-related-img {
      width: 54px; height: 54px;
      object-fit: cover;
      border-radius: var(--radius-sm);
      flex-shrink: 0;
      border: 1px solid var(--c-border);
    }

    .sidebar-related-cat {
      font-size: 0.58rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--c-accent2);
      margin-bottom: 0.2rem;
    }

    .sidebar-related-title {
      font-size: 0.78rem;
      font-weight: 600;
      color: var(--c-text);
      line-height: 1.45;
    }

    /* ═══════════════════════════════════════
       RELATED BOTTOM GRID
    ═══════════════════════════════════════ */
    .related-section {
      padding: 4.5rem 1.5rem;
      background: var(--c-surface);
      border-top: 1px solid var(--c-border);
    }

    .related-inner {
      max-width: 1280px;
      margin: 0 auto;
    }

    .related-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.25rem;
      margin-top: 2rem;
    }

    .related-card {
      background: var(--c-card);
      border: 1px solid var(--c-border);
      border-radius: var(--radius-md);
      overflow: hidden;
      text-decoration: none;
      display: block;
      transition: border-color 0.3s;
    }

    .related-card:hover { border-color: rgba(255,215,0,0.18); }

    .related-card-img {
      aspect-ratio: 16/9;
      overflow: hidden;
      background: var(--c-bg);
    }

    .related-card-img img {
      width: 100%; height: 100%;
      object-fit: cover;
      opacity: 0.82;
      transition: transform 0.45s var(--ease), opacity 0.3s;
    }

    .related-card:hover .related-card-img img {
      transform: scale(1.04);
      opacity: 1;
    }

    .related-card-body { padding: 1.25rem; }

    .related-card-cat {
      font-size: 0.6rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      background: rgba(245,166,35,0.1);
      color: var(--c-accent2);
      padding: 0.2rem 0.5rem;
      border-radius: 3px;
      display: inline-block;
      margin-bottom: 0.625rem;
    }

    .related-card-title {
      font-size: 0.9rem;
      font-weight: 700;
      color: var(--c-white);
      line-height: 1.45;
    }

    /* helper */
    .link-accent {
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      font-size: 0.78rem;
      font-weight: 700;
      color: var(--c-accent);
      letter-spacing: 0.04em;
      transition: opacity 0.2s;
      text-decoration: none;
    }
    .link-accent:hover { opacity: 0.72; }

    /* ═══════════════════════════════════════
       RESPONSIVE
    ═══════════════════════════════════════ */
    @media (max-width: 1024px) {
      .article-layout {
        grid-template-columns: 1fr;
        gap: 2.5rem;
      }
      .article-sidebar {
        position: static;
      }
    }

    @media (max-width: 860px) {
      .related-grid { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 600px) {
      .article-hero { padding: 6rem 1.25rem 2.5rem; }
      .related-grid { grid-template-columns: 1fr; }
    }
    </style>

    {{-- ═══ ARTICLE HERO ═══ --}}
    <div class="article-hero">
      <div class="article-hero-glow"></div>
      <div class="article-hero-inner">

        <nav class="breadcrumb" style="margin-bottom:1.5rem;">
          <a href="{{ route('home') }}">Home</a>
          <span class="breadcrumb-sep">/</span>
          <a href="{{ route('articles') }}">Artikel</a>
          <span class="breadcrumb-sep">/</span>
          <span class="breadcrumb-current">{{ Str::limit($article->title, 45) }}</span>
        </nav>

        <div class="article-meta-row">
          @if($article->category)
            <span class="article-cat-badge">{{ $article->category }}</span>
          @endif
          <span class="article-meta-item">{{ $article->formatted_date }}</span>
          <span class="article-meta-dot">·</span>
          <span class="article-meta-item">{{ $readTime ?? $article->read_time }} menit baca</span>
          <span class="article-meta-dot">·</span>
          <span class="article-meta-item">{{ number_format($article->views) }} views</span>
        </div>

        <h1 class="article-hero-title">{{ $article->title }}</h1>
        <p class="article-hero-excerpt">{{ $article->excerpt }}</p>

        <div class="article-author-row">
          <div class="article-author-avatar">{{ strtoupper(substr($article->author ?? 'T', 0, 1)) }}</div>
          <div>
            <div class="article-author-name">{{ $article->author ?? 'Tim Karya Perdana Teknik' }}</div>
            <div class="article-author-company">CV. Karya Perdana Teknik</div>
          </div>
        </div>

      </div>
    </div>

    {{-- ═══ FEATURED IMAGE ═══ --}}
    @if($article->image)
          <div class="article-featured-img-wrap">
            <img src="{{ asset('storage/' . $article->image) }}"
                 alt="{{ $article->alt_text ?? $article->title }}"
                 loading="eager">
          </div>
    @endif

    {{-- ═══ ARTICLE BODY ═══ --}}
    <section class="article-body-section">
      <div class="article-body-inner">
        <div class="article-layout">

          {{-- Main Content --}}
          <div>

            {{-- TOC --}}
            @if($article->show_toc && count($article->toc) > 0)
                  <div class="article-toc">
                    <div class="article-toc-title">
                      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                        <line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/>
                        <line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
                      </svg>
                      Daftar Isi
                    </div>
                    <ol>
                      @foreach($article->toc as $item)
                        <li style="padding-left:{{ ($item['level'] - 2) * 0.875 }}rem;">
                          <a href="#{{ $item['id'] }}">{{ $item['text'] }}</a>
                        </li>
                      @endforeach
                    </ol>
                  </div>
            @endif

            {{-- Article Content --}}
            <article class="article-content">
              {!! $article->content_with_toc_ids !!}
            </article>

            {{-- FAQ --}}
            @if($article->faqs && count($article->faqs) > 0)
                  <div class="faq-section">
                    <h2 class="faq-title">
                      <svg width="18" height="18" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"/>
                      </svg>
                      FAQ
                    </h2>
                    <div class="faq-list">
                      @foreach($article->faqs as $faq)
                        @if(!empty($faq['q']))
                              <details class="faq-item">
                                <summary>
                                  {{ $faq['q'] }}
                                  <svg class="faq-chevron" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="6 9 12 15 18 9"/>
                                  </svg>
                                </summary>
                                <div class="faq-answer">{{ $faq['a'] ?? '' }}</div>
                              </details>
                        @endif
                      @endforeach
                    </div>
                  </div>
            @endif

            {{-- CTA --}}
            @if($article->cta_button && !empty($article->cta_button['text']))
                  @php
                    $cta = $article->cta_button;
                    $ctaWa = \App\Models\WaSetting::primary();
                    $ctaUrl = ($cta['type'] === 'wa' && $ctaWa) ? $ctaWa->wa_url : ($cta['url'] ?? '#');
                  @endphp
                  <div class="article-cta-box">
                    <p>Tertarik dengan solusi crane &amp; hoist untuk kebutuhan industri Anda?</p>
                    <button onclick="openOrderModal('Artikel CTA: {{ addslashes($article->title) }}')" class="btn-primary" style="justify-content:center; border:none; cursor:pointer;">
                      <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                      {{ $cta['text'] }}
                    </button>
                  </div>
            @endif

            {{-- Tags --}}
            @if($article->tags)
                  <div class="article-tags">
                    <span class="article-tags-label">Tags:</span>
                    @foreach($article->tags as $tag)
                          <span class="article-tag">{{ $tag }}</span>
                    @endforeach
                  </div>
            @endif

            {{-- Share --}}
            <div class="article-share">
              <span class="article-share-label">Bagikan:</span>
              <button onclick="openOrderModal('Share Artikel: {{ addslashes($article->title) }}')" class="share-btn-wa">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                WhatsApp
              </button>
              <button class="share-btn-copy"
                      onclick="navigator.clipboard.writeText(window.location.href);this.textContent='✓ Tersalin!';setTimeout(()=>this.textContent='Salin Link',2000)">
                Salin Link
              </button>
            </div>

          </div>

          {{-- ═══ SIDEBAR ═══ --}}
          <aside class="article-sidebar">

            {{-- Konsultasi --}}
            @php $waMain = \App\Models\WaSetting::primary(); @endphp
            <div class="sidebar-card">
              <div class="sidebar-card-title">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.9a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                </svg>
                Butuh Konsultasi?
              </div>
              <p class="sidebar-desc">Hubungi tim ahli kami untuk solusi crane &amp; hoist terbaik sesuai kebutuhan industri Anda.</p>
              @if($waMain)
                <button onclick="openOrderModal('Hubungi Kami: {{ addslashes($article->title) }}')" class="btn-primary" style="width:100%;justify-content:center; border:none; cursor:pointer;" data-track="wa">
                  <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                  Chat WhatsApp
                </button>
              @endif
            </div>

            {{-- Related Sidebar --}}
            @if($related->count())
                  <div class="sidebar-card">
                    <div class="sidebar-card-title">
                      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                      </svg>
                      Artikel Terkait
                    </div>
                    <div class="sidebar-related-list">
                      @foreach($related->take(3) as $r)
                        <a href="{{ route('articles.show', $r->slug) }}" class="sidebar-related-item">
                          @if($r->image)
                            <img src="{{ asset('storage/' . $r->image) }}" alt="{{ $r->title }}" class="sidebar-related-img">
                          @endif
                          <div>
                            <div class="sidebar-related-cat">{{ $r->category }}</div>
                            <div class="sidebar-related-title">{{ Str::limit($r->title, 55) }}</div>
                          </div>
                        </a>
                      @endforeach
                    </div>
                  </div>
            @endif

          </aside>

        </div>
      </div>
    </section>

    {{-- ═══ RELATED BOTTOM ═══ --}}
    @if($related->count())
          <section class="related-section">
            <div class="related-inner">
              <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
                <div>
                  <div class="s-label">Baca Juga</div>
                  <h2 class="s-title">Artikel <strong>Terkait</strong></h2>
                </div>
                <a href="{{ route('articles') }}" class="link-accent">
                  Semua Artikel
                  <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
              </div>
              <div class="related-grid">
                @foreach($related as $r)
                      <a href="{{ route('articles.show', $r->slug) }}" class="related-card">
                        <div class="related-card-img">
                          @if($r->image)
                            <img src="{{ asset('storage/' . $r->image) }}" alt="{{ $r->title }}" loading="lazy">
                          @else
                            <div style="width:100%;height:100%;min-height:160px;background:var(--c-bg);display:flex;align-items:center;justify-content:center;">
                              <svg width="28" height="28" fill="none" stroke="var(--c-border2)" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                          @endif
                        </div>
                        <div class="related-card-body">
                          @if($r->category)
                            <span class="related-card-cat">{{ $r->category }}</span>
                          @endif
                          <h3 class="related-card-title">{{ $r->title }}</h3>
                        </div>
                      </a>
                @endforeach
              </div>
            </div>
          </section>
    @endif

@endsection