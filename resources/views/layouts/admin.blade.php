<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
@php $adminLogo = \App\Models\Setting::get('logo'); @endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Dashboard') | KPT Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('styles')
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{--yellow:#FFD700;--bg:#0F0F0F;--bg2:#161618;--bg3:#1E1E22;--border:rgba(255,255,255,.07);--text1:#FFFFFF;--text2:#E0E0E0;--text3:#7A7A8A}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text1);min-height:100vh;display:flex}

/* SIDEBAR */
#sidebar{width:240px;min-height:100vh;background:#0A0A0C;border-right:1px solid var(--border);position:fixed;top:0;left:0;z-index:200;display:flex;flex-direction:column;transition:transform .3s ease}
.sb-logo{padding:1.25rem 1rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.625rem}
.sb-logo-badge{width:34px;height:34px;background:var(--yellow);display:flex;align-items:center;justify-content:center;font-weight:900;color:#000;font-size:.8rem;flex-shrink:0;border-radius:6px}
.sb-logo-text{font-size:.875rem;font-weight:700;color:#fff;line-height:1.2}
.sb-logo-sub{font-size:.625rem;color:var(--text3);font-weight:400}
.sb-search{padding:.75rem 1rem;border-bottom:1px solid var(--border)}
.sb-search input{width:100%;background:var(--bg3);border:1px solid var(--border);border-radius:6px;padding:.4rem .75rem;color:var(--text2);font-size:.8rem;outline:none;font-family:inherit}
.sb-search input:focus{border-color:rgba(255,215,0,.3)}
.sb-search input::placeholder{color:var(--text3)}
.sb-nav{flex:1;padding:.5rem 0;overflow-y:auto}
.sb-sec{font-size:.575rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--text3);padding:.875rem 1.25rem .25rem}
.sb-link{display:flex;align-items:center;gap:.625rem;padding:.5rem .875rem;margin:.0625rem .625rem;font-size:.8125rem;font-weight:500;color:var(--text3);border-radius:6px;text-decoration:none;transition:all .18s;cursor:pointer;border:none;background:none;width:calc(100% - 1.25rem);text-align:left}
.sb-link:hover{background:rgba(255,215,0,.08);color:var(--yellow)}
.sb-link.active{background:rgba(255,215,0,.12);color:var(--yellow)}
.sb-link svg{flex-shrink:0;opacity:.7}
.sb-link.active svg,.sb-link:hover svg{opacity:1}
.sb-badge{margin-left:auto;background:var(--yellow);color:#000;font-size:.575rem;font-weight:800;padding:.125rem .4rem;border-radius:100px;line-height:1.4}
.sb-bottom{padding:1rem;border-top:1px solid var(--border)}
.sb-bottom-card{background:linear-gradient(135deg,rgba(255,215,0,.1),rgba(255,215,0,.04));border:1px solid rgba(255,215,0,.2);border-radius:8px;padding:1rem}
.sb-bottom-card p{font-size:.7rem;color:var(--text3);margin:.25rem 0 .75rem;line-height:1.5}
.sb-bottom-card strong{font-size:.8125rem;color:#fff}

/* MAIN */
#main{margin-left:240px;flex:1;display:flex;flex-direction:column;min-height:100vh;min-width:0}
#topbar{background:#0A0A0C;border-bottom:1px solid var(--border);padding:.875rem 1.75rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.topbar-breadcrumb{font-size:.75rem;color:var(--text3);display:flex;align-items:center;gap:.375rem}
.topbar-title{font-size:1rem;font-weight:700;color:#fff}
.topbar-right{display:flex;align-items:center;gap:.625rem}
.topbar-icon-btn{width:34px;height:34px;background:var(--bg3);border:1px solid var(--border);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--text3);cursor:pointer;transition:all .2s;text-decoration:none}
.topbar-icon-btn:hover{border-color:rgba(255,215,0,.3);color:var(--yellow)}
.avatar{width:34px;height:34px;background:var(--yellow);border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:800;color:#000;font-size:.875rem;flex-shrink:0}
.success-toast{background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:#4ade80;font-size:.75rem;padding:.375rem .875rem;border-radius:100px}
#content{padding:1.75rem;flex:1}
.errors-box{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.3);padding:.875rem 1.25rem;margin-bottom:1.5rem;border-radius:6px}
.errors-box li{color:#f87171;font-size:.8125rem;margin-left:1rem}

/* MOBILE */
#sb-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);z-index:199}
#mobile-toggle{display:none;background:none;border:none;color:#fff;cursor:pointer;padding:.5rem}
@media(max-width:1024px){
  #sidebar{transform:translateX(-100%)}
  #sidebar.open{transform:translateX(0)}
  #sb-overlay.open{display:block}
  #main{margin-left:0!important}
  #mobile-toggle{display:flex!important}
  #content{padding:.875rem!important}
  #topbar{padding:.75rem 1rem!important}
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
  <div class="sb-logo">
    @if($adminLogo)
      <img src="{{ asset('storage/'.$adminLogo) }}" alt="KPT Logo" style="height:32px;width:auto;object-fit:contain;">
    @else
      <div class="sb-logo-badge">KPT</div>
    @endif
    <div>
      <div class="sb-logo-text">KPT Admin</div>
      <div class="sb-logo-sub">{{ session('admin_name','Administrator') }}</div>
    </div>
  </div>
  <div class="sb-search">
    <input type="text" placeholder="Cari menu..." id="sb-search-input" oninput="sbSearch(this.value)">
  </div>
  <nav class="sb-nav" id="sb-nav">
    <div class="sb-sec">Main</div>
    <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
      Dashboard
    </a>
    <a href="{{ route('admin.analytics') }}" class="sb-link {{ request()->routeIs('admin.analytics*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      Analytics
    </a>

    <div class="sb-sec">Konten</div>
    <a href="{{ route('admin.services.index') }}" class="sb-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
      Layanan
    </a>
    <a href="{{ route('admin.gallery.index') }}" class="sb-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
      Galeri
    </a>
    <a href="{{ route('admin.articles.index') }}" class="sb-link {{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      Artikel
    </a>
    <a href="{{ route('admin.clients.index') }}" class="sb-link {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
      Klien
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="sb-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
      Testimoni
    </a>
    @php $newLeads = \App\Models\Lead::where('status','new')->count(); @endphp
    <a href="{{ route('admin.leads.index') }}" class="sb-link {{ request()->routeIs('admin.leads*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
      Leads
      @if($newLeads > 0)<span class="sb-badge">{{ $newLeads }}</span>@endif
    </a>

    <div class="sb-sec">Pengaturan</div>
    <a href="{{ route('admin.settings') }}" class="sb-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
      Pengaturan
    </a>
    <a href="{{ route('admin.wa.index') }}" class="sb-link {{ request()->routeIs('admin.wa*') ? 'active' : '' }}">
      <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
      WhatsApp
    </a>

    <div class="sb-sec">Aksi</div>
    <a href="{{ route('home') }}" target="_blank" class="sb-link">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      Lihat Website
    </a>
    <form method="POST" action="{{ route('admin.logout') }}" style="margin:0">
      @csrf
      <button type="submit" class="sb-link" style="color:#7A7A8A;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Logout
      </button>
    </form>
  </nav>

  <div class="sb-bottom">
    <div class="sb-bottom-card">
      <strong>KPT Website</strong>
      <p>Kelola konten & leads bisnis Anda</p>
      <a href="{{ route('home') }}" target="_blank" style="display:inline-flex;align-items:center;gap:.375rem;background:var(--yellow);color:#000;font-size:.75rem;font-weight:700;padding:.375rem .875rem;border-radius:4px;text-decoration:none;">
        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        Preview
      </a>
    </div>
  </div>
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
          <span>KPT Admin</span>
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
      @if($newLeads > 0)
      <a href="{{ route('admin.leads.index') }}" class="topbar-icon-btn" title="{{ $newLeads }} lead baru" style="position:relative;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/></svg>
        <span style="position:absolute;top:-3px;right:-3px;background:var(--yellow);color:#000;font-size:.5rem;font-weight:900;width:14px;height:14px;border-radius:50%;display:flex;align-items:center;justify-content:center;">{{ $newLeads }}</span>
      </a>
      @endif
      <div class="avatar">{{ strtoupper(substr(session('admin_name','A'),0,1)) }}</div>
    </div>
  </header>

  <!-- CONTENT -->
  <main id="content">
    @if($errors->any())
    <div class="errors-box" style="margin-bottom:1.25rem;">
      <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:.25rem;">
        @foreach($errors->all() as $e)
        <li style="display:flex;align-items:center;gap:.5rem;color:#f87171;font-size:.8125rem;">
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
function toggleSb(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('sb-overlay').classList.toggle('open')}
function closeSb(){document.getElementById('sidebar').classList.remove('open');document.getElementById('sb-overlay').classList.remove('open')}
function sbSearch(q){
  q=q.toLowerCase();
  document.querySelectorAll('#sb-nav .sb-link').forEach(function(l){
    l.style.display=l.textContent.toLowerCase().includes(q)?'flex':'none';
  });
}
</script>
</body>
</html>
