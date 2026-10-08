<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
@php $adminLogo = \App\Models\Setting::get('logo'); @endphp
@php 
$favicon = \App\Models\Setting::get('favicon') ? asset('storage/'.\App\Models\Setting::get('favicon')) : asset('favicon.ico');
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Dashboard') | {{ $companyName }} Admin</title>
<link rel="icon" type="image/x-icon" href="{{ $favicon }}">
<link rel="shortcut icon" href="{{ $favicon }}">
<link rel="apple-touch-icon" href="{{ $favicon }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('styles')
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
@php
    $tAccent = \App\Models\Setting::get('color_accent') ?? '#FFD700';
    $tMain   = \App\Models\Setting::get('color_main') ?? '#0F0F0F';
    $tText   = \App\Models\Setting::get('color_text') ?? '#FFFFFF';
@endphp
:root {
    --yellow: {{ $tAccent }} !important;
    --bg: #F4F7FE !important;
    --bg2: #FFFFFF;
    --bg3: #F8FAFC;
    --border: #E2E8F0;
    --text1: #2B3674 !important;
    --text2: #475569;
    --text3: #A3AED0;
    --sb-bg: #1B6FE8;
    --sb-bg2: rgba(255,255,255,0.1);
    --sb-border: rgba(255,255,255,0.12);
    --sb-text: rgba(255,255,255,0.65);
}
body { font-family: 'Montserrat', sans-serif; background: var(--bg); color: var(--text1); min-height: 100vh; display: flex; scrollbar-width: thin; scrollbar-color: #CBD5E1 transparent; }

/* GLOBAL BROWSER SCROLLBAR (MATCH SIDEBAR LIGHT GRAY SUBTLE) */
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}
::-webkit-scrollbar-track {
  background: transparent;
}
::-webkit-scrollbar-thumb {
  background: #CBD5E1;
  border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
  background: #94A3B8;
}

/* ═══════ 4 SECONDS SMOOTH ENTRANCE ANIMATION ═══════ */
@keyframes animateSidebarSlideIn {
  0% {
    opacity: 0;
    transform: translateX(-100px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

/* ═══════ SIDEBAR LIGHT & INTERACTIVE ═══════ */
#sidebar {
  width: 68px;
  position: fixed;
  top: 1rem;
  left: 1rem;
  max-height: calc(100vh - 2rem);
  height: fit-content;
  z-index: 200;
  background: #FFFFFF;
  border-radius: 32px;
  box-shadow: 0 10px 35px rgba(0,0,0,0.06), 0 2px 10px rgba(0,0,0,0.02);
  border: 1px solid rgba(226, 232, 240, 0.8);
  display: flex;
  flex-direction: column;
  transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s ease;
  overflow-x: hidden;
  overflow-y: auto;
  padding: 0.75rem 0 0.5rem;
  scrollbar-width: thin;
  scrollbar-color: #CBD5E1 transparent;
}
#sidebar:hover {
  width: 240px;
  box-shadow: 0 15px 40px rgba(0,0,0,0.12), 0 4px 15px rgba(0,0,0,0.04);
}
/* Scrollbar Abu Samar - Hilang Saat Tidak Di-hover */
#sidebar::-webkit-scrollbar { width: 4px; }
#sidebar::-webkit-scrollbar-track { background: transparent; }
#sidebar::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
#sidebar:not(:hover)::-webkit-scrollbar-thumb { background: transparent; }

/* Logo area */
.sb-logo {
  padding: 0.375rem 0.5rem 0.75rem;
  display: flex;
  align-items: center;
  gap: 0.875rem;
}
.sb-logo-badge {
  width: 44px;
  height: 44px;
  background: #F8FAFC;
  border: 1.5px solid #E2E8F0;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  border-radius: 50%;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
  padding: 6px;
  margin: 0 auto;
}
#sidebar:hover .sb-logo-badge {
  margin: 0;
}
.sb-logo-info {
  display: none;
  white-space: nowrap;
  overflow: hidden;
}
#sidebar:hover .sb-logo-info { display: block; }
.sb-logo-text { font-size: 0.875rem; font-weight: 800; color: #0F172A; line-height: 1.2; letter-spacing: -0.01em; }
.sb-logo-sub { font-size: 0.65rem; color: #64748B; font-weight: 500; margin-top: 2px; }

/* Search */
.sb-search { padding: 0.25rem 0.5rem 0.75rem; }
.sb-search-box {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  margin: 0 auto;
  background: #F8FAFC;
  border: 1px solid #E2E8F0;
  border-radius: 50%;
  color: #64748B;
  transition: all 0.2s;
}
#sidebar:hover .sb-search-box {
  width: 100%;
  border-radius: 100px;
  padding: 0 0.875rem;
  justify-content: flex-start;
  gap: 0.75rem;
}
.sb-search-box:focus-within {
  background: #FFF;
  border-color: #0F172A;
  box-shadow: 0 0 0 3px rgba(15,23,42,0.1);
}
.sb-search-box input {
  border: none;
  background: transparent;
  outline: none;
  font-size: 0.8rem;
  color: #0F172A;
  width: 100%;
  display: none;
  font-family: inherit;
}
#sidebar:hover .sb-search-box input { display: block; }

/* Nav */
.sb-nav { flex: 0 1 auto; padding: 0.25rem 0 0.5rem; overflow-y: auto; overflow-x: hidden; }
.sb-sec {
  font-size: 0.6rem;
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: #94A3B8;
  padding: 0.5rem 1rem 0.2rem;
  height: 22px;
  line-height: 1.2;
  opacity: 0;
  white-space: nowrap;
  transition: opacity 0.2s ease 0.1s;
}
#sidebar:hover .sb-sec {
  opacity: 1;
}

/* Nav link — Floating Circle/Pill */
.sb-link {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 44px;
  width: 44px;
  padding: 0;
  margin: 0.35rem auto;
  font-size: 0.8125rem;
  font-weight: 600;
  color: #475569;
  border-radius: 50%;
  text-decoration: none;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  border: none;
  background: transparent;
  white-space: nowrap;
  position: relative;
}
#sidebar:hover .sb-link {
  width: calc(100% - 1rem);
  margin: 0.35rem 0.5rem;
  padding: 0 0.875rem;
  justify-content: flex-start;
  gap: 0.875rem;
  border-radius: 100px;
}
.sb-link-text {
  display: none;
  white-space: nowrap;
}
#sidebar:hover .sb-link-text { display: inline-block; }

.sb-link:hover:not(.active) {
  background: #F1F5F9;
  color: #0F172A;
}
.sb-link svg {
  flex-shrink: 0;
  stroke: #475569;
  transition: stroke 0.2s;
  width: 20px;
  height: 20px;
  display: block;
}
.sb-link:hover svg { stroke: #0F172A; }

/* Active link — Hitam Elegan Minimalis */
.sb-link.active {
  background: #0F172A !important;
  color: #FFFFFF !important;
  box-shadow: 0 6px 18px rgba(15, 23, 42, 0.3) !important;
}
.sb-link.active svg { stroke: #FFFFFF !important; }

/* Badge (Indikator Notifikasi Merah di Mode Minimalist & Expanded) */
.sb-badge {
  position: absolute;
  top: 0px;
  right: 0px;
  background: #334155;
  color: #fff;
  font-size: 0.55rem;
  font-weight: 800;
  min-width: 16px;
  height: 16px;
  padding: 0 3px;
  border-radius: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
  line-height: 1;
  box-shadow: 0 2px 6px rgba(15, 23, 42,0.4);
  border: 1.5px solid #FFFFFF;
  z-index: 10;
}
#sidebar:hover .sb-badge {
  position: static;
  margin-left: auto;
  border: none;
}

/* MAIN CONTENT AREA - Floating Sidebar Margin Push */
#main {
  margin-left: 96px;
  flex: 1;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  min-width: 0;
  transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
#sidebar:hover ~ #main {
  margin-left: 268px;
}
#topbar { background: transparent; padding: 1.5rem 2rem 0.5rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; backdrop-filter: blur(10px); }
.topbar-left { display: flex; align-items: center; gap: .75rem; }
.topbar-breadcrumb { font-size: .75rem; color: var(--text3); display: flex; align-items: center; gap: .375rem; font-weight: 600; }
.topbar-title { font-size: 1.5rem; font-weight: 700; color: var(--text1); }
.topbar-right { display: flex; align-items: center; gap: .75rem; background: #fff; padding: .375rem .375rem .375rem 1rem; border-radius: 100px; box-shadow: 0 4px 15px rgba(0,0,0,.03); }
.topbar-icon-btn { width: 36px; height: 36px; background: var(--bg3); border: none; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--text3); cursor: pointer; transition: all .2s; text-decoration: none; }
.topbar-icon-btn:hover { background: #E0E8F5; color: var(--text1); }
.avatar { width: 36px; height: 36px; background: #3B82F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff; font-size: .875rem; flex-shrink: 0; }

/* ACCOUNT DROPDOWN ON HOVER */
.user-dropdown-wrap {
  position: relative;
  display: inline-block;
}
.user-dropdown-menu {
  position: absolute;
  top: calc(100% + 10px);
  right: 0;
  width: 230px;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 20px;
  box-shadow: 0 12px 35px rgba(0,0,0,0.08), 0 2px 10px rgba(0,0,0,0.03);
  opacity: 0;
  visibility: hidden;
  transform: translateY(-8px);
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 9999;
  overflow: hidden;
  font-family: inherit;
}
.user-dropdown-wrap:hover .user-dropdown-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}
.user-dropdown-wrap:hover img {
  border-color: #0F172A !important;
}
.user-dropdown-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.7rem 1.25rem;
  font-size: 0.8125rem;
  font-weight: 600;
  color: #334155;
  text-decoration: none;
  transition: background 0.2s, color 0.2s;
}
.user-dropdown-item:hover {
  background: #F8FAFC;
  color: #0F172A;
}
.user-dropdown-item.danger:hover {
  background: #F8FAFC;
  color: #334155;
}
.user-dropdown-item svg {
  color: #64748B;
  transition: color 0.2s;
}
.user-dropdown-item:hover svg {
  color: #0F172A;
}
.user-dropdown-item.danger:hover svg {
  color: #334155;
}
#main {
  flex: 1;
  margin-left: 88px;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  width: calc(100% - 88px);
  background: #F4F7FE;
}
#content { padding: 1.75rem; flex: 1; }
.errors-box { background: rgba(15, 23, 42,.1); border: 1px solid rgba(15, 23, 42,.3); padding: .875rem 1.25rem; margin-bottom: 1.5rem; border-radius: 6px; }
.errors-box li { color: #64748B; font-size: .8125rem; margin-left: 1rem; }

/* MOBILE */
#sb-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 199; backdrop-filter: blur(4px); }
#mobile-toggle { display: none; background: #fff; border: 1px solid #E2E8F0; color: #0F172A; cursor: pointer; padding: .5rem; border-radius: 10px; }
@media(max-width: 1024px) {
  #sidebar {
    left: 0;
    top: 0;
    bottom: 0;
    border-radius: 0 24px 24px 0;
    width: 250px !important;
    transform: translateX(-100%);
    box-shadow: none;
  }
  #sidebar.open {
    transform: translateX(0);
    box-shadow: 8px 0 30px rgba(0,0,0,0.15);
  }
  #sidebar .sb-logo-info,
  #sidebar .sb-sec,
  #sidebar .sb-link-text,
  #sidebar .sb-search-box input {
    opacity: 1 !important;
  }
  #sidebar .sb-link {
    width: calc(100% - 1rem);
    margin: 0.35rem 0.5rem;
    padding: 0 0.875rem;
    justify-content: flex-start;
    border-radius: 100px;
  }
  #sb-overlay.open { display: block; }
  #main { margin-left: 0 !important; width: 100% !important; }
  #mobile-toggle { display: flex !important; }
  #content { padding: .875rem !important; }
  #topbar { padding: .75rem 1rem !important; }
}
@media(max-width:480px){
  #content{padding:.625rem!important}
  .admin-card{padding:1rem!important}
}
</style>
</head>
<body>

<div id="sb-overlay" onclick="closeSb()"></div>

<!-- SIDEBAR -->
<aside id="sidebar">
  {{-- Logo --}}
  <div class="sb-logo">
    <div class="sb-logo-badge">
      @if($adminLogo)
        <img src="{{ asset('storage/'.$adminLogo) }}" alt="Logo" style="width:28px;height:28px;object-fit:contain;border-radius:6px;">
      @else
        <svg width="22" height="22" fill="none" stroke="#1B6FE8" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
      @endif
    </div>
    <div class="sb-logo-info">
      <div class="sb-logo-text">{{ $companyName }}</div>
      <div class="sb-logo-sub">{{ session('admin_name','Administrator') }}</div>
    </div>
  </div>

  {{-- Search --}}
  <div class="sb-search">
    <div class="sb-search-box">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" placeholder="Cari menu..." id="sb-search-input" oninput="sbSearch(this.value)">
    </div>
  </div>

  {{-- Navigation --}}
  <nav class="sb-nav" id="sb-nav">
    <div class="sb-sec">Main</div>
    <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>
      <span class="sb-link-text">Dashboard</span>
    </a>
    <a href="{{ route('admin.analytics') }}" class="sb-link {{ request()->routeIs('admin.analytics*') ? 'active' : '' }}" title="Analytics">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      <span class="sb-link-text">Analytics</span>
    </a>

    <div class="sb-sec">Konten</div>
    <a href="{{ route('admin.services.index') }}" class="sb-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}" title="Layanan">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
      <span class="sb-link-text">Layanan</span>
    </a>
    <a href="{{ route('admin.service-categories.index') }}" class="sb-link {{ request()->routeIs('admin.service-categories*') ? 'active' : '' }}" title="Kategori Produk">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
      <span class="sb-link-text">Kategori Produk</span>
    </a>
    <a href="{{ route('admin.gallery.index') }}" class="sb-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}" title="Galeri">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
      <span class="sb-link-text">Galeri</span>
    </a>
    <a href="{{ route('admin.articles.index') }}" class="sb-link {{ request()->routeIs('admin.articles*') ? 'active' : '' }}" title="Artikel">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <span class="sb-link-text">Artikel</span>
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="sb-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}" title="Testimoni">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
      <span class="sb-link-text">Testimoni</span>
    </a>
    @php $newLeads = \App\Models\Lead::where('status','new')->count(); @endphp
    <a href="{{ route('admin.leads.index') }}" class="sb-link {{ request()->routeIs('admin.leads*') ? 'active' : '' }}" title="Leads">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
      <span class="sb-link-text">Leads</span>
      @if($newLeads > 0)<span class="sb-badge">{{ $newLeads }}</span>@endif
    </a>

    <div class="sb-sec">Pengaturan</div>
    <a href="{{ route('admin.page_management') }}" class="sb-link {{ request()->routeIs('admin.page_management*') || request()->routeIs('admin.hero_slides*') ? 'active' : '' }}" title="Page Management">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      <span class="sb-link-text">Page Management</span>
    </a>
    <a href="{{ route('admin.settings') }}" class="sb-link {{ request()->routeIs('admin.settings*') || request()->routeIs('admin.wa*') ? 'active' : '' }}" title="Pengaturan Situs">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
      <span class="sb-link-text">Pengaturan Situs</span>
    </a>

    <div class="sb-sec">Aksi</div>
    <a href="{{ route('home') }}" target="_blank" class="sb-link" title="Lihat Website">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      <span class="sb-link-text">Lihat Website</span>
    </a>
    <form method="POST" action="{{ route('admin.logout') }}" style="margin:0" id="logout-form">
      @csrf
      <button type="button" class="sb-link" onclick="handleLogoutClick()" title="Logout">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        <span class="sb-link-text">Logout</span>
      </button>
    </form>
  </nav>

</aside>

<!-- MAIN -->
<div id="main">
  <!-- TOPBAR -->
  <header id="topbar">
    <div class="topbar-left">
      <button id="mobile-toggle" onclick="toggleSb()" aria-label="Menu">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
      <div>
        <div class="topbar-breadcrumb">
          <span>Admin Panel</span>
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
          <span style="color:var(--text2);">@yield('page-title','Dashboard')</span>
        </div>
      </div>
    </div>
    <div class="topbar-right">
      @if(session('success'))
      <span class="success-toast">
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:4px;"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
      </span>
      @endif
      <a href="{{ route('home') }}" target="_blank" class="topbar-icon-btn" title="Lihat Website">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
      </a>
      <a href="{{ route('admin.settings') }}" class="topbar-icon-btn" title="Pengaturan">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
      </a>
      @php
        $newLeadsCount = \App\Models\Lead::where('status', 'new')->count();
        $recentLeads = \App\Models\Lead::where('status', 'new')->latest()->take(5)->get();
      @endphp
      <div style="position:relative;" id="notif-container">
        <button id="notif-btn" title="{{ $newLeadsCount }} lead baru" onclick="toggleNotif(event)" style="position:relative;width:38px;height:38px;border-radius:12px;border:1.5px solid var(--border,#E4E7F0);background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;box-shadow:0 2px 8px rgba(0,0,0,.04);">
          <svg width="16" height="16" fill="none" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/></svg>
          @if($newLeadsCount > 0)
          <span id="notif-badge" style="position:absolute;top:-4px;right:-4px;background:#3B82F6;color:#fff;font-size:.55rem;font-weight:800;min-width:16px;height:16px;border-radius:100px;display:flex;align-items:center;justify-content:center;padding:0 3px;border:2px solid #F4F7FE;">{{ $newLeadsCount }}</span>
          @endif
        </button>

        {{-- Premium Notification Dropdown --}}
        <div id="notif-dropdown" style="display:none;opacity:0;transform:translateY(-8px);position:absolute;top:calc(100% + 10px);right:0;width:360px;background:#fff;border:1px solid #E2E8F0;border-radius:24px;box-shadow:0 12px 40px rgba(0,0,0,0.06), 0 2px 10px rgba(0,0,0,0.02);z-index:9999;overflow:hidden;transition:opacity .25s,transform .25s;font-family:inherit;">
          {{-- Header --}}
          <div style="padding:1.25rem 1.25rem .75rem;display:flex;align-items:center;justify-content:space-between;">
            <div style="font-size:1rem;font-weight:600;color:#0F172A;letter-spacing:-.01em;">Pusat Notifikasi</div>
          </div>

          {{-- Segmented Tabs --}}
          <div style="padding:0 1.25rem 1rem;">
            <div style="display:flex;align-items:center;background:#F1F5F9;padding:.25rem;border-radius:12px;gap:.25rem;" id="notif-tabs">
              <div onclick="switchNotifTab(this)" class="notif-tab active" style="flex:1;text-align:center;padding:.375rem 0;background:#fff;border-radius:8px;font-size:.7rem;font-weight:600;color:#0F172A;box-shadow:0 1px 2px rgba(0,0,0,0.05);cursor:pointer;transition:all .2s;">Hari Ini</div>
              <div onclick="switchNotifTab(this)" class="notif-tab" style="flex:1;text-align:center;padding:.375rem 0;font-size:.7rem;font-weight:500;color:#64748B;cursor:pointer;transition:all .2s;">Minggu Ini</div>
              <div onclick="switchNotifTab(this)" class="notif-tab" style="flex:1;text-align:center;padding:.375rem 0;font-size:.7rem;font-weight:500;color:#64748B;cursor:pointer;transition:all .2s;">Sebelumnya</div>
            </div>
          </div>

          {{-- Notification Items --}}
          <div style="max-height:350px;overflow-y:auto;" class="notif-scroll">
            @if($newLeadsCount > 0)
              @foreach($recentLeads as $lead)
                <a href="{{ route('admin.leads.show', $lead) }}" style="display:flex;align-items:flex-start;gap:.875rem;padding:1.125rem 1.25rem;border-bottom:1px solid #F1F5F9;text-decoration:none;transition:background .15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                  {{-- Icon badge --}}
                  <div style="width:38px;height:38px;border-radius:50%;background:#fff;border:1.5px solid #F1F5F9;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="18" height="18" fill="none" stroke="#64748B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                  </div>
                  {{-- Content --}}
                  <div style="flex:1;min-width:0;padding-top:2px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.25rem;">
                      <div style="display:flex;align-items:center;gap:.375rem;">
                        <div style="width:5px;height:5px;background:#8B5CF6;border-radius:50%;"></div>
                        <div style="font-size:.875rem;font-weight:600;color:#0F172A;line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px;">{{ $lead->name }}</div>
                      </div>
                      <div style="font-size:.7rem;font-weight:500;color:#94A3B8;flex-shrink:0;">{{ \Carbon\Carbon::parse($lead->created_at)->locale('id')->diffForHumans(null, true) }} lalu</div>
                    </div>
                    <div style="font-size:.75rem;color:#64748B;line-height:1.4;">
                      Lead dari <strong>{{ $lead->source ?? 'Website' }}</strong>. Tertarik pada: {{ $lead->product ?? 'Inquiry Umum' }}
                    </div>
                  </div>
                </a>
              @endforeach
            @else
              <div style="padding:2.5rem 1.25rem;text-align:center;">
                <div style="width:40px;height:40px;background:#fff;border:1px solid #F1F5F9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                  <svg width="18" height="18" fill="none" stroke="#94A3B8" stroke-width="1.5" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <div style="font-size:.875rem;font-weight:500;color:#0F172A;">Semua sudah dibaca</div>
                <div style="font-size:.75rem;color:#64748B;margin-top:.25rem;">Tidak ada notifikasi baru saat ini.</div>
              </div>
            @endif
          </div>
          
          {{-- Mark as read action --}}
          @if($newLeadsCount > 0)
          <div style="padding:.75rem 1.25rem;background:#F8FAFC;border-top:1px solid #F1F5F9;">
            <form action="{{ route('admin.leads.mark_read') }}" method="POST" style="margin:0;">
              @csrf
              <button type="submit" style="width:100%;background:transparent;border:none;color:#64748B;font-size:.75rem;cursor:pointer;font-weight:500;font-family:inherit;transition:color .2s;" onmouseover="this.style.color='#0F172A'" onmouseout="this.style.color='#64748B'">Tandai semua dibaca</button>
            </form>
          </div>
          @endif
        </div>
      </div>
      {{-- User Account Logo Avatar & Hover Dropdown --}}
      <div class="user-dropdown-wrap">
        <div style="cursor:pointer; display:flex; align-items:center;">
          @if($adminLogo)
            <img src="{{ asset('storage/'.$adminLogo) }}" alt="Admin Avatar" style="width:38px; height:38px; border-radius:50%; object-fit:contain; background:#FFFFFF; border:1.5px solid #E2E8F0; padding:2px; box-shadow:0 2px 8px rgba(0,0,0,0.04); flex-shrink:0; transition:border-color 0.2s;">
          @else
            <div style="width:38px; height:38px; border-radius:50%; background:#0F172A; color:#FFFFFF; font-weight:700; display:flex; align-items:center; justify-content:center; font-size:0.875rem; border:1.5px solid #E2E8F0; flex-shrink:0;">
              {{ strtoupper(substr(session('admin_name','A'),0,1)) }}
            </div>
          @endif
        </div>

        {{-- Account Dropdown Menu --}}
        <div class="user-dropdown-menu">
          <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #F1F5F9; background: #F8FAFC;">
            <div style="font-size: 0.875rem; font-weight: 700; color: #0F172A;">{{ session('admin_name', 'Administrator') }}</div>
            <div style="display:inline-block; background:#E2E8F0; color:#475569; font-size:0.625rem; font-weight:700; padding:2px 8px; border-radius:100px; margin-top:4px; text-transform:uppercase; letter-spacing:0.05em;">Super Admin</div>
          </div>

          <div style="padding: 0.35rem 0;">
            <!-- Role / Hak Akses Menu Item -->
            <a href="{{ route('admin.roles.index') }}" class="user-dropdown-item">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              <span>Role &amp; Hak Akses</span>
            </a>

            <!-- Pengaturan Akun -->
            <a href="{{ route('admin.settings') }}" class="user-dropdown-item">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
              <span>Pengaturan Akun</span>
            </a>
          </div>

          <div style="border-top: 1px solid #F1F5F9; padding: 0.35rem 0;">
            <!-- Logout Form -->
            <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
              @csrf
              <button type="submit" class="user-dropdown-item danger" style="width:100%; border:none; background:transparent; font-family:inherit; cursor:pointer; text-align:left;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                <span>Keluar / Logout</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- CONTENT -->
  <main id="content">
    @if($errors->any())
    <div class="errors-box" style="margin-bottom:1.25rem;">
      <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.25rem;">
        @foreach($errors->all() as $e)
        <li style="display:flex;align-items:center;gap:.5rem;color:#64748B;font-size:.8125rem;">
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
          {{ $e }}
        </li>
        @endforeach
      </ul>
    </div>
    @endif
    @yield('content')
  </main>
</div>

@stack('scripts')
<script>
function switchNotifTab(el) {
  document.querySelectorAll('#notif-tabs .notif-tab').forEach(t => {
    t.style.background = 'transparent';
    t.style.boxShadow = 'none';
    t.style.color = '#64748B';
    t.style.fontWeight = '500';
  });
  el.style.background = '#fff';
  el.style.boxShadow = '0 1px 2px rgba(0,0,0,0.05)';
  el.style.color = '#0F172A';
  el.style.fontWeight = '600';
}
function toggleSb(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('sb-overlay').classList.toggle('open')}
function closeSb(){document.getElementById('sidebar').classList.remove('open');document.getElementById('sb-overlay').classList.remove('open')}
function sbSearch(q){
  q=q.toLowerCase();
  document.querySelectorAll('#sb-nav .sb-link').forEach(function(l){
    l.style.display=l.textContent.toLowerCase().includes(q)?'flex':'none';
  });
}
function toggleNotif(e) {
  e.stopPropagation();
  const dropdown = document.getElementById('notif-dropdown');
  const btn = document.getElementById('notif-btn');
  const isHidden = dropdown.style.display === 'none' || dropdown.style.display === '';
  if (isHidden) {
    dropdown.style.display = 'block';
    requestAnimationFrame(() => {
      dropdown.style.opacity = '1';
      dropdown.style.transform = 'translateY(0)';
    });
    btn.style.background = '#EFF6FF';
    btn.style.borderColor = '#BFDBFE';
  } else {
    dropdown.style.opacity = '0';
    dropdown.style.transform = 'translateY(-8px)';
    setTimeout(() => { dropdown.style.display = 'none'; }, 200);
    btn.style.background = '#fff';
    btn.style.borderColor = 'var(--border, #E4E7F0)';
  }
}
window.addEventListener('click', function(e) {
  const dropdown = document.getElementById('notif-dropdown');
  const btn = document.getElementById('notif-btn');
  if (dropdown && !e.target.closest('#notif-container')) {
    dropdown.style.opacity = '0';
    dropdown.style.transform = 'translateY(-8px)';
    setTimeout(() => { dropdown.style.display = 'none'; }, 200);
    if (btn) { btn.style.background = '#fff'; btn.style.borderColor = 'var(--border, #E4E7F0)'; }
  }
});
</script>

<!-- SweetAlert2 for Premium Popups -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Override window.alert
    window.alert = function(msg) {
        Swal.fire({
            text: msg,
            icon: 'info',
            confirmButtonColor: '#0F172A',
            confirmButtonText: 'Mengerti',
            background: '#ffffff',
            color: '#0F172A',
            customClass: { popup: 'premium-swal-popup' },
            showClass: { popup: 'animate__animated animate__fadeInDown animate__faster' },
            hideClass: { popup: 'animate__animated animate__fadeOutUp animate__faster' }
        });
    };

    // Intercept form submissions that have confirm()
    document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
        const onsubmitStr = form.getAttribute('onsubmit');
        const match = onsubmitStr.match(/confirm\('([^']+)'\)/);
        const msg = match ? match[1] : 'Anda yakin?';
        
        form.removeAttribute('onsubmit'); // Remove native confirm
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                text: msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#334155',
                cancelButtonColor: '#94A3B8',
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                color: '#0F172A',
                customClass: { popup: 'premium-swal-popup' }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Intercept onclick that have confirm()
    document.querySelectorAll('[onclick*="confirm"]').forEach(el => {
        const onclickStr = el.getAttribute('onclick');
        const match = onclickStr.match(/confirm\('([^']+)'\)/);
        const msg = match ? match[1] : 'Anda yakin?';
        
        // Remove native confirm so it doesn't trigger
        el.removeAttribute('onclick');
        
        el.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                text: msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#334155',
                cancelButtonColor: '#94A3B8',
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
                background: '#ffffff',
                color: '#0F172A',
                customClass: { popup: 'premium-swal-popup' }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Check if there's a submit action in the original onclick
                    const submitMatch = onclickStr.match(/document\.getElementById\('([^']+)'\)\.submit\(\)/);
                    if (submitMatch) {
                        document.getElementById(submitMatch[1]).submit();
                    } else if (onclickStr.includes('submit()')) {
                       // Try to execute the rest of the script if it's not a generic form
                       // This handles other random logic if present
                    }
                }
            });
        });
    });
});
</script>
<style>
.premium-swal-popup {
    border-radius: 24px !important;
    box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12) !important;
    padding: 2rem 1.75rem !important;
    border: 1px solid #E2E8F0 !important;
    font-family: 'Montserrat', sans-serif !important;
}
div:where(.swal2-container) button:where(.swal2-styled) {
    border-radius: 50px !important;
    font-weight: 600 !important;
    font-size: 0.875rem !important;
    padding: 0.65rem 1.75rem !important;
}
div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
    background-color: #0F172A !important;
    box-shadow: 0 4px 15px rgba(15, 23, 42, 0.2) !important;
}
div:where(.swal2-container) .swal2-icon.swal2-info {
    border-color: #0F172A !important;
    color: #0F172A !important;
}
div:where(.swal2-container) .swal2-icon.swal2-info .swal2-icon-content {
    color: #0F172A !important;
}
div:where(.swal2-container) h2:where(.swal2-title) {
    font-size: 1.25rem !important;
    color: #0F172A !important;
    font-weight: 700 !important;
}
div:where(.swal2-container) div:where(.swal2-html-container) {
    font-size: 0.95rem !important;
    color: #475569 !important;
    font-weight: 400 !important;
}
</style>

<script>
// --- Fast Premium Loader Logic ---
document.addEventListener("DOMContentLoaded", () => {
    const loader = document.getElementById('premium-loader');
    if (loader) {
        loader.classList.add('hide');
        setTimeout(() => loader.style.display = 'none', 150);
    }
});

function handleLogoutClick() {
    document.getElementById('logout-form').submit();
}
</script>

</body>
</html>
