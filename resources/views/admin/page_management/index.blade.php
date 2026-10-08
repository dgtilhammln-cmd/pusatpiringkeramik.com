@extends('layouts.admin')
@section('title', 'Page Management')
@section('page-title', 'Page Management')
@section('content')

  <style>
    /* ===== PREMIUM ADMIN PAGE MANAGEMENT STYLES ===== */
    .pm-card {
      background: #ffffff !important;
      border-radius: 20px !important;
      padding: 1.75rem !important;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
      border: 1px solid #E2E8F0 !important;
      margin-bottom: 1.5rem !important;
    }

    .pm-card-header {
      display: flex !important;
      align-items: center !important;
      gap: .75rem !important;
      margin-bottom: 1.5rem !important;
      padding-bottom: 0.75rem !important;
      border-bottom: 1px solid #F1F5F9 !important;
    }

    .pm-card-title {
      font-size: .95rem !important;
      font-weight: 800 !important;
      color: #0F172A !important;
      letter-spacing: normal !important;
    }

    .pm-input {
      width: 100% !important;
      padding: .75rem 1rem !important;
      background: #F8FAFC !important;
      border: 1.5px solid #E2E8F0 !important;
      border-radius: 12px !important;
      font-size: .875rem !important;
      color: #0F172A !important;
      font-family: 'Montserrat', sans-serif !important;
      font-weight: 500 !important;
      outline: none !important;
      box-sizing: border-box !important;
      transition: all .2s !important;
    }

    .pm-input:focus {
      border-color: #3B82F6 !important;
      background: #ffffff !important;
      box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }

    .pm-label {
      display: block !important;
      font-size: .8125rem !important;
      font-weight: 700 !important;
      color: #334155 !important;
      margin-bottom: .4rem !important;
    }

    .pm-help {
      font-size: .75rem;
      color: #64748B;
      margin-top: .3rem;
    }

    .pm-color-picker-wrap {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .pm-color-picker-wrap input[type="color"] {
      -webkit-appearance: none;
      border: 1.5px solid #E2E8F0;
      width: 42px;
      height: 42px;
      border-radius: 10px;
      cursor: pointer;
      padding: 2px;
      background: #ffffff;
    }

    .pm-color-picker-wrap input[type="color"]::-webkit-color-swatch-wrapper {
      padding: 0;
    }

    .pm-color-picker-wrap input[type="color"]::-webkit-color-swatch {
      border: none;
      border-radius: 8px;
    }

    .pm-main-tab-btn {
      padding: 0.75rem 1.5rem;
      font-size: 0.9rem;
      font-weight: 700;
      border-radius: 14px;
      border: 1.5px solid #E2E8F0;
      background: #ffffff;
      color: #64748B;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-family: 'Montserrat', sans-serif;
    }

    .pm-main-tab-btn.active {
      background: #0F172A;
      color: #ffffff;
      border-color: #0F172A;
      box-shadow: 0 4px 15px rgba(15, 23, 42, 0.2);
    }

    .pm-sub-tab-btn {
      padding: 0.5rem 1rem;
      font-size: 0.8125rem;
      font-weight: 600;
      border-radius: 100px;
      border: none;
      background: #F1F5F9;
      color: #475569;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 0.375rem;
      font-family: 'Montserrat', sans-serif;
    }

    .pm-sub-tab-btn.active {
      background: #3B82F6;
      color: #ffffff;
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
    }

    .pm-hero-slide-card {
      background: #F8FAFC;
      border: 1.5px solid #E2E8F0;
      border-radius: 16px;
      padding: 1.25rem;
      display: flex;
      align-items: center;
      gap: 1.25rem;
      transition: all .2s;
    }

    .pm-hero-slide-card:hover {
      border-color: #3B82F6;
      background: #ffffff;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
    }

    /* Modal Overlay */
    .pm-modal {
      position: fixed;
      inset: 0;
      z-index: 9999;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(4px);
      display: none;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }

    .pm-modal.active {
      display: flex;
    }

    .pm-modal-content {
      background: #ffffff;
      border-radius: 24px;
      width: 100%;
      max-width: 720px;
      max-height: 90vh;
      overflow-y: auto;
      padding: 2rem;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }
  </style>

  @if(session('success'))
    <div
      style="background:#ECFDF5; border:1px solid #A7F3D0; color:#047857; padding:.875rem 1.25rem; border-radius:12px; margin-bottom:1.5rem; font-size:.875rem; font-weight:600; display:flex; align-items:center; gap:.5rem;">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <polyline points="20 6 9 17 4 12" />
      </svg>
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div
      style="background:#FEF2F2; border:1px solid #FECACA; color:#B91C1C; padding:.875rem 1.25rem; border-radius:12px; margin-bottom:1.5rem; font-size:.875rem; font-weight:600;">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="{{ route('admin.page_management.update') }}" enctype="multipart/form-data"
    id="page-management-form">
    @csrf
    <input type="hidden" name="active_tab" id="active_tab_input" value="{{ $activeTab ?? 'sect-hero' }}">

    {{-- Header --}}
    <div
      style="margin-bottom:1.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
      <div>
        <h1 style="font-size:1.5rem;font-weight:800;color:#0F172A;margin:0 0 .25rem;letter-spacing:-.02em;">Page
          Management</h1>
        <p style="font-size:.85rem;color:#64748B;margin:0;">Kustomisasi seluruh konten, warna, font, background, dan hero
          slide per halaman secara dinamis.</p>
      </div>
      <div style="display:flex;gap:.75rem;align-items:center;">
        <a href="{{ route('home') }}" target="_blank"
          style="display:inline-flex;align-items:center;gap:.375rem;padding:.625rem 1.25rem;font-size:.85rem;font-weight:600;background:#ffffff;border:1.5px solid #E2E8F0;color:#475569;border-radius:12px;text-decoration:none;transition:all .2s;">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6" />
            <polyline points="15 3 21 3 21 9" />
            <line x1="10" y1="14" x2="21" y2="3" />
          </svg>
          Preview Website
        </a>
        <button type="submit"
          style="display:inline-flex;align-items:center;gap:.375rem;padding:.625rem 1.5rem;font-size:.875rem;font-weight:700;background:#3B82F6;color:#ffffff;border:none;border-radius:12px;cursor:pointer;transition:all .2s;font-family:'Montserrat',sans-serif;box-shadow:0 4px 14px rgba(59,130,246,0.3);">
          <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
            <polyline points="17 21 17 13 7 13 7 21" />
            <polyline points="7 3 7 8 15 8" />
          </svg>
          Simpan Perubahan
        </button>
      </div>
    </div>

    @php
      $isHeaderTab = in_array($activeTab ?? '', ['sect-header', 'header']);
    @endphp

    {{-- MAIN PAGE TABS --}}
    <div style="display:flex; gap:0.75rem; margin-bottom:1.5rem; flex-wrap:wrap;">
      <button type="button" class="pm-main-tab-btn {{ $isHeaderTab ? 'active' : '' }}" onclick="switchMainTab('header')"
        id="main-tab-header">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        Header & Preloader
      </button>
      <button type="button" class="pm-main-tab-btn {{ !$isHeaderTab ? 'active' : '' }}"
        onclick="switchMainTab('homepage')" id="main-tab-homepage">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Homepage
      </button>
    </div>

    {{-- HEADER & PRELOADER MAIN CONTAINER --}}
    <div id="page-header" style="{{ $isHeaderTab ? 'display:block;' : 'display:none;' }}">
      {{-- CARD 1: Warna & Aksent Header --}}
      <div class="pm-card">
        <div class="pm-card-header">
          <svg width="22" height="22" fill="none" stroke="#DC2626" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
          </svg>
          <div>
            <div class="pm-card-title">Warna & Aksent Merah Header</div>
            <div class="pm-help">Atur warna utama (merah), hover button, dan aksen navigasi pada header website.</div>
          </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:1.25rem;">
          <div>
            <label class="pm-label">Warna Utama Header (Red Accent)</label>
            <div class="pm-color-picker-wrap">
              <input type="color" value="{{ $settings['header_accent_color'] ?? '#DC2626' }}"
                onchange="document.getElementById('c_header_accent').value=this.value">
              <input type="text" name="header_accent_color" id="c_header_accent" class="pm-input"
                value="{{ $settings['header_accent_color'] ?? '#DC2626' }}">
            </div>
            <div class="pm-help">Default: #DC2626 (Merah solid untuk tombol CTA & aksen)</div>
          </div>

          <div>
            <label class="pm-label">Warna Hover Tombol CTA Header</label>
            <div class="pm-color-picker-wrap">
              <input type="color" value="{{ $settings['header_cta_hover_color'] ?? '#B91C1C' }}"
                onchange="document.getElementById('c_header_cta_hover').value=this.value">
              <input type="text" name="header_cta_hover_color" id="c_header_cta_hover" class="pm-input"
                value="{{ $settings['header_cta_hover_color'] ?? '#B91C1C' }}">
            </div>
            <div class="pm-help">Default: #B91C1C (Merah lebih gelap saat hover)</div>
          </div>
        </div>
      </div>

      {{-- CARD 2: Animasi Loading (Preloader) --}}
      <div class="pm-card">
        <div class="pm-card-header">
          <svg width="22" height="22" fill="none" stroke="#DC2626" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
          <div>
            <div class="pm-card-title">Efek Animasi Loading (Preloader Website)</div>
            <div class="pm-help">Atur animasi loading awal saat pengunjung membuka website beserta warna aksen.</div>
          </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:1.25rem;">
          <div>
            <label class="pm-label">Status Preloader Loading</label>
            <select name="preloader_enable" class="pm-input">
              <option value="1" {{ ($settings['preloader_enable'] ?? '1') == '1' ? 'selected' : '' }}>Aktif (Tampilkan
                Animasi Loading)</option>
              <option value="0" {{ ($settings['preloader_enable'] ?? '1') == '0' ? 'selected' : '' }}>Nonaktifkan Preloader
              </option>
            </select>
            <div class="pm-help">Aktifkan efek wind sway & garis animasi loading</div>
          </div>

          <div>
            <label class="pm-label">Warna Aksen Animasi Loading</label>
            <div class="pm-color-picker-wrap">
              <input type="color" value="{{ $settings['preloader_accent_color'] ?? '#DC2626' }}"
                onchange="document.getElementById('c_preloader_accent').value=this.value">
              <input type="text" name="preloader_accent_color" id="c_preloader_accent" class="pm-input"
                value="{{ $settings['preloader_accent_color'] ?? '#DC2626' }}">
            </div>
            <div class="pm-help">Default: #DC2626 (Aksen merah garis animasi wind loading)</div>
          </div>
        </div>
      </div>

      {{-- CARD 3: Pengaturan Navigasi Header (Tambah, Sembunyikan, Edit Menu & Tujuan) --}}
      <div class="pm-card">
        <div class="pm-card-header" style="justify-content:space-between;">
          <div style="display:flex; align-items:center; gap:.75rem;">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <div>
              <div class="pm-card-title">Manajemen Menu Navigasi Header</div>
              <div class="pm-help">Tambah menu baru, ubah label, atur link tujuan, serta tampilkan atau sembunyikan menu
                header.</div>
            </div>
          </div>
          <button type="button" onclick="addHeaderMenuItem()"
            style="display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1rem;font-size:.8125rem;font-weight:700;background:#0F172A;color:#ffffff;border:none;border-radius:10px;cursor:pointer;transition:all .2s;">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <line x1="12" y1="5" x2="12" y2="19" />
              <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Tambah Menu Header
          </button>
        </div>

        @php
          $rawMenus = $settings['header_menus'] ?? null;
          $defaultNavs = [
            ['label' => 'Beranda', 'url' => route('home'), 'show' => '1'],
            ['label' => 'Tentang', 'url' => route('about'), 'show' => '1'],
            ['label' => 'Produk', 'url' => route('products'), 'show' => '1'],
            ['label' => 'Galeri', 'url' => route('gallery'), 'show' => '1'],
            ['label' => 'Artikel', 'url' => route('articles'), 'show' => '1'],
            ['label' => 'Kontak', 'url' => route('contact'), 'show' => '1'],
          ];
          if (!empty($rawMenus)) {
            $headerMenus = is_string($rawMenus) ? json_decode($rawMenus, true) : $rawMenus;
            if (!is_array($headerMenus) || count($headerMenus) === 0) {
              $headerMenus = $defaultNavs;
            }
          } else {
            $headerMenus = $defaultNavs;
          }
        @endphp

        <div id="header-menu-container" style="display:flex; flex-direction:column; gap:0.75rem;">
          @foreach($headerMenus as $idx => $m)
            <div class="pm-menu-item-row"
              style="display:grid; grid-template-columns: 2fr 3fr 1.2fr 40px; gap:0.75rem; align-items:center; background:#F8FAFC; padding:0.75rem 1rem; border-radius:12px; border:1px solid #E2E8F0;">
              <div>
                <label class="pm-label" style="font-size:0.75rem;">Label Menu</label>
                <input type="text" name="header_menus[{{ $idx }}][label]" class="pm-input" value="{{ $m['label'] ?? '' }}"
                  placeholder="Nama Menu">
              </div>
              <div>
                <label class="pm-label" style="font-size:0.75rem;">Tujuan Link / URL</label>
                <input type="text" name="header_menus[{{ $idx }}][url]" class="pm-input" value="{{ $m['url'] ?? '' }}"
                  placeholder="https://... atau /route">
              </div>
              <div>
                <label class="pm-label" style="font-size:0.75rem;">Status Tampil</label>
                <select name="header_menus[{{ $idx }}][show]" class="pm-input" style="padding:.75rem .5rem !important;">
                  <option value="1" {{ ($m['show'] ?? '1') == '1' ? 'selected' : '' }}>Tampil</option>
                  <option value="0" {{ ($m['show'] ?? '1') == '0' ? 'selected' : '' }}>Sembunyi</option>
                </select>
              </div>
              <div style="padding-top:1.25rem;">
                <button type="button" onclick="this.closest('.pm-menu-item-row').remove()"
                  style="background:#FEE2E2; border:none; color:#EF4444; width:36px; height:36px; border-radius:10px; cursor:pointer; display:flex; align-items:center; justify-content:center;"
                  title="Hapus Menu">
                  <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- CARD 4: Tombol Aksi (CTA) Header --}}
      <div class="pm-card">
        <div class="pm-card-header">
          <svg width="22" height="22" fill="none" stroke="#10B981" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
          </svg>
          <div>
            <div class="pm-card-title">Tombol Aksi Utama Header (CTA Button)</div>
            <div class="pm-help">Atur teks, tipe aksi (WhatsApp/URL direct), dan tujuan tombol utama di kanan header.
            </div>
          </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem;">
          <div>
            <label class="pm-label">Status Tombol Header CTA</label>
            <select name="header_cta_show" class="pm-input">
              <option value="1" {{ ($settings['header_cta_show'] ?? '1') == '1' ? 'selected' : '' }}>Tampilkan Tombol
              </option>
              <option value="0" {{ ($settings['header_cta_show'] ?? '1') == '0' ? 'selected' : '' }}>Sembunyikan Tombol
              </option>
            </select>
          </div>

          <div>
            <label class="pm-label">Teks Tombol CTA</label>
            <input type="text" name="header_cta_text" class="pm-input"
              value="{{ $settings['header_cta_text'] ?? 'Hubungi Kami' }}" placeholder="Hubungi Kami">
          </div>

          <div>
            <label class="pm-label">Tipe Aksi Tombol</label>
            <select name="header_cta_type" class="pm-input">
              <option value="wa" {{ ($settings['header_cta_type'] ?? 'wa') == 'wa' ? 'selected' : '' }}>Buka WhatsApp (Modal
                Order)</option>
              <option value="url" {{ ($settings['header_cta_type'] ?? 'wa') == 'url' ? 'selected' : '' }}>URL Langsung
              </option>
            </select>
          </div>

          <div>
            <label class="pm-label">Tujuan Link URL (jika tipe URL)</label>
            <input type="text" name="header_cta_url" class="pm-input"
              value="{{ $settings['header_cta_url'] ?? route('contact') }}" placeholder="{{ route('contact') }}">
          </div>
        </div>
      </div>
    </div>

    {{-- HOMEPAGE MAIN CONTAINER --}}
    <div id="page-homepage" style="{{ !$isHeaderTab ? 'display:block;' : 'display:none;' }}">
      {{-- SUB TABS NAVBAR --}}
      <div
        style="background:#ffffff; border-radius:16px; padding:0.75rem 1rem; border:1px solid #E2E8F0; margin-bottom:1.5rem; display:flex; gap:0.5rem; flex-wrap:wrap; box-shadow:0 2px 8px rgba(0,0,0,0.02);">
        @php
          $subTabs = [
            'sect-hero' => ['Hero Section & Slide', 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
            'sect-about' => ['About Us Section', 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            'sect-product' => ['Product Section', 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
            'sect-value' => ['Value & Keunggulan', 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            'sect-aplikasi' => ['Aplikasi & Use Case', 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
            'sect-kota' => ['Coverage Kota', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
            'sect-footer' => ['Footer Section', 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z M16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z'],
            'sect-seo' => ['SEO, AEO & GEO Schema', 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
          ];
        @endphp

        @foreach($subTabs as $sKey => [$sLabel, $sIcon])
          <button type="button" class="pm-sub-tab-btn {{ ($activeTab ?? 'sect-hero') === $sKey ? 'active' : '' }}"
            onclick="switchSubTab('{{ $sKey }}')" id="sub-btn-{{ $sKey }}">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="{{ $sIcon }}" />
            </svg>
            {{ $sLabel }}
          </button>
        @endforeach
      </div>

      {{-- SUB TAB 1: SECT HERO --}}
      <div id="sub-sect-hero" class="sub-tab-content"
        style="{{ ($activeTab ?? 'sect-hero') === 'sect-hero' ? '' : 'display:none;' }}">

        {{-- Color & Styling Settings --}}
        <div class="pm-card">
          <div class="pm-card-header">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <div class="pm-card-title">Tampilan & Warna Section Hero</div>
          </div>

          <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem;">
            <div>
              <label class="pm-label">Background Section</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_hero_bg'] ?? '#FAFAFA' }}"
                  onchange="document.getElementById('c_hero_bg').value=this.value">
                <input type="text" name="page_home_hero_bg" id="c_hero_bg" class="pm-input"
                  value="{{ $settings['page_home_hero_bg'] ?? '#FAFAFA' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Judul (Title Color)</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_hero_title_color'] ?? '#0A1930' }}"
                  onchange="document.getElementById('c_hero_title').value=this.value">
                <input type="text" name="page_home_hero_title_color" id="c_hero_title" class="pm-input"
                  value="{{ $settings['page_home_hero_title_color'] ?? '#0A1930' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Teks & Deskripsi</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_hero_text_color'] ?? '#64748b' }}"
                  onchange="document.getElementById('c_hero_text').value=this.value">
                <input type="text" name="page_home_hero_text_color" id="c_hero_text" class="pm-input"
                  value="{{ $settings['page_home_hero_text_color'] ?? '#64748b' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Background Card Stat</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_hero_card_bg'] ?? '#0A1930' }}"
                  onchange="document.getElementById('c_hero_card_bg').value=this.value">
                <input type="text" name="page_home_hero_card_bg" id="c_hero_card_bg" class="pm-input"
                  value="{{ $settings['page_home_hero_card_bg'] ?? '#0A1930' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Aksen (Brand Color Sitewide)</label>
              <div class="pm-color-picker-wrap">
                <input type="color"
                  value="{{ $settings['brand_color'] ?? $settings['header_accent_color'] ?? '#DC2626' }}"
                  onchange="document.getElementById('c_brand_color').value=this.value">
                <input type="text" name="brand_color" id="c_brand_color" class="pm-input"
                  value="{{ $settings['brand_color'] ?? $settings['header_accent_color'] ?? '#DC2626' }}">
              </div>
              <div class="pm-help">Default: #DC2626 — Aksen merah yang muncul di garis hero, badge, sparkle, stat, tombol,
                dan seluruh halaman.</div>
            </div>
            <div>
              <label class="pm-label">Durasi Transisi Slide Otomatis (Detik)</label>
              <div style="display:flex; align-items:center; gap:0.5rem;">
                <input type="number" name="hero_autoplay_interval" class="pm-input"
                  value="{{ $settings['hero_autoplay_interval'] ?? '5' }}" min="0" max="60" placeholder="5"
                  style="width:100px;">
                <span style="font-size:0.8rem; font-weight:700; color:#3B82F6;">Detik (0 = Transisi Manual /
                  Nonaktif)</span>
              </div>
              <div class="pm-help">Waktu pergantian otomatis antar slide banner hero. Contoh: 5 = pergantian tiap 5 detik.
              </div>
            </div>
          </div>
        </div>

        {{-- HERO SLIDES CRUD MANAGER (1 - MAX 5 SLIDES) --}}
        <div class="pm-card">
          <div class="pm-card-header" style="justify-content:space-between; flex-wrap:wrap; gap:1rem;">
            <div style="display:flex; align-items:center; gap:.75rem;">
              <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
                <rect x="2" y="3" width="20" height="14" rx="2" />
                <path d="M8 21h8M12 17v4" />
              </svg>
              <div>
                <div class="pm-card-title">Kelola Slide Hero (Maks. 5 Slide)</div>
                <div style="font-size:.75rem; color:#64748B; margin-top:.15rem;">Tambah, urutkan, dan ubah banner slide
                  hero utama yang tampil di beranda website.</div>
              </div>
            </div>

            <div style="display:flex; align-items:center; gap:1rem;">
              <span
                style="font-size:.8rem; font-weight:700; color:#3B82F6; background:#EFF6FF; padding:.4rem .8rem; border-radius:20px; border:1px solid #BFDBFE;">
                {{ $heroSlides->count() }} / 5 Slide Aktif
              </span>
              @if($heroSlides->count() < 5)
                <button type="button" onclick="openAddModal()"
                  style="display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.1rem;font-size:.8rem;font-weight:700;background:#0F172A;color:#ffffff;border:none;border-radius:10px;cursor:pointer;transition:all .2s;">
                  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14" />
                  </svg>
                  Tambah Hero Slide
                </button>
              @endif
            </div>
          </div>

          {{-- SLIDES LIST --}}
          @if($heroSlides->isEmpty())
            <div
              style="text-align:center; padding:3rem 1.5rem; background:#F8FAFC; border:1.5px dashed #CBD5E1; border-radius:16px;">
              <svg width="40" height="40" fill="none" stroke="#94A3B8" stroke-width="1.5" viewBox="0 0 24 24"
                style="margin-bottom:.5rem;">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <circle cx="8.5" cy="8.5" r="1.5" />
                <polyline points="21 15 16 10 5 21" />
              </svg>
              <div style="font-weight:700; color:#334155; margin-bottom:.25rem;">Belum ada Slide Hero</div>
              <p style="font-size:.8rem; color:#64748B; margin:0 0 1rem;">Klik tombol "Tambah Hero Slide" di atas untuk
                membuat banner slide hero pertama.</p>
              <button type="button" onclick="openAddModal()"
                style="display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;font-size:.8rem;font-weight:700;background:#3B82F6;color:#ffffff;border:none;border-radius:8px;cursor:pointer;">
                + Tambah Slide Pertama
              </button>
            </div>
          @else
            <div style="display:flex; flex-direction:column; gap:1rem;">
              @foreach($heroSlides as $slide)
                <div class="pm-hero-slide-card">
                  {{-- Thumbnail --}}
                  <div
                    style="width:110px; height:75px; border-radius:12px; overflow:hidden; flex-shrink:0; background:#0F172A; position:relative;">
                    @if($slide->image)
                      <img src="{{ asset('storage/' . $slide->image) }}" style="width:100%;height:100%;object-fit:cover;"
                        alt="{{ $slide->title }}">
                    @else
                      <div
                        style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:.7rem;font-weight:600;">
                        No Image</div>
                    @endif
                    <div
                      style="position:absolute; top:4px; left:4px; background:rgba(15,23,42,0.8); color:#fff; font-size:.65rem; font-weight:800; padding:2px 6px; border-radius:6px;">
                      #{{ $slide->order }}
                    </div>
                  </div>

                  {{-- Slide Info --}}
                  <div style="flex:1; min-width:0;">
                    <div style="display:flex; align-items:center; gap:.5rem; margin-bottom:.2rem;">
                      <span
                        style="font-size:.7rem; font-weight:700; color:#3B82F6; background:#EFF6FF; padding:2px 8px; border-radius:4px;">
                        {{ $slide->subtitle ?: 'Slide Banner' }}
                      </span>
                      <span
                        style="font-size:.7rem; padding:2px 8px; border-radius:20px; font-weight:700; {{ $slide->is_active ? 'background:#DCFCE7; color:#15803D;' : 'background:#F1F5F9; color:#64748B;' }}">
                        {{ $slide->is_active ? 'Aktif' : 'Nonaktif' }}
                      </span>
                    </div>
                    <div
                      style="font-size:.9rem; font-weight:800; color:#0F172A; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                      {{ $slide->title }}
                    </div>
                    @if($slide->description)
                      <div
                        style="font-size:.78rem; color:#64748B; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-top:2px;">
                        {{ $slide->description }}
                      </div>
                    @endif
                    <div style="display:flex; gap:1rem; margin-top:.35rem; font-size:.7rem; color:#94A3B8;">
                      @if($slide->stat_1_value)
                        <span style="display:inline-flex;align-items:center;gap:3px;">
                          <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="12" width="4" height="9" />
                            <rect x="10" y="7" width="4" height="14" />
                            <rect x="17" y="3" width="4" height="18" />
                          </svg>
                          {{ $slide->stat_1_value }} {{ $slide->stat_1_label }}
                        </span>
                      @endif
                      @if($slide->stat_2_value)
                        <span style="display:inline-flex;align-items:center;gap:3px;">
                          <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="12" width="4" height="9" />
                            <rect x="10" y="7" width="4" height="14" />
                            <rect x="17" y="3" width="4" height="18" />
                          </svg>
                          {{ $slide->stat_2_value }} {{ $slide->stat_2_label }}
                        </span>
                      @endif
                      @if($slide->stat_3_value)
                        <span style="display:inline-flex;align-items:center;gap:3px;">
                          <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="12" width="4" height="9" />
                            <rect x="10" y="7" width="4" height="14" />
                            <rect x="17" y="3" width="4" height="18" />
                          </svg>
                          {{ $slide->stat_3_value }} {{ $slide->stat_3_label }}
                        </span>
                      @endif
                    </div>
                  </div>

                  {{-- Actions --}}
                  <div style="display:flex; gap:.5rem; flex-shrink:0;">
                    <button type="button" onclick="openEditModal({{ json_encode($slide) }})"
                      style="background:#EFF6FF; color:#2563EB; border:1px solid #BFDBFE; padding:.5rem .875rem; border-radius:8px; font-size:.78rem; font-weight:700; cursor:pointer; transition:all .2s;">
                      Edit
                    </button>
                    <button type="button" onclick="confirmDeleteSlide({{ $slide->id }})"
                      style="background:#FEF2F2; color:#DC2626; border:1px solid #FECACA; padding:.5rem .875rem; border-radius:8px; font-size:.78rem; font-weight:700; cursor:pointer; transition:all .2s;">
                      Hapus
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>

      </div>

      {{-- SUB TAB 2: SECT ABOUT --}}
      <div id="sub-sect-about" class="sub-tab-content"
        style="{{ ($activeTab ?? '') === 'sect-about' ? '' : 'display:none;' }}">

        {{-- Tampilan Warna --}}
        <div class="pm-card">
          <div class="pm-card-header">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="pm-card-title">Tampilan & Warna Section About Us</div>
          </div>

          <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:1.25rem;">
            <div>
              <label class="pm-label">Background Section</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_about_bg'] ?? '#FFFFFF' }}"
                  onchange="document.getElementById('c_about_bg').value=this.value">
                <input type="text" name="page_home_about_bg" id="c_about_bg" class="pm-input"
                  value="{{ $settings['page_home_about_bg'] ?? '#FFFFFF' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Judul / Heading</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_about_title_color'] ?? '#0F172A' }}"
                  onchange="document.getElementById('c_about_title').value=this.value">
                <input type="text" name="page_home_about_title_color" id="c_about_title" class="pm-input"
                  value="{{ $settings['page_home_about_title_color'] ?? '#0F172A' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Teks / Label / Deskripsi</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_about_text_color'] ?? '#475569' }}"
                  onchange="document.getElementById('c_about_text').value=this.value">
                <input type="text" name="page_home_about_text_color" id="c_about_text" class="pm-input"
                  value="{{ $settings['page_home_about_text_color'] ?? '#475569' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">BG Card Abu-abu (Card 1 &amp; 4)</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_about_card_gray_bg'] ?? '#f1f5f9' }}"
                  onchange="document.getElementById('c_about_card_gray').value=this.value">
                <input type="text" name="page_home_about_card_gray_bg" id="c_about_card_gray" class="pm-input"
                  value="{{ $settings['page_home_about_card_gray_bg'] ?? '#f1f5f9' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">BG Chip Keyword (Card 1)</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_about_chip_bg'] ?? '#ffffff' }}"
                  onchange="document.getElementById('c_about_chip_bg').value=this.value">
                <input type="text" name="page_home_about_chip_bg" id="c_about_chip_bg" class="pm-input"
                  value="{{ $settings['page_home_about_chip_bg'] ?? '#ffffff' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Teks Chip Keyword</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_about_chip_color'] ?? '#94a3b8' }}"
                  onchange="document.getElementById('c_about_chip_color').value=this.value">
                <input type="text" name="page_home_about_chip_color" id="c_about_chip_color" class="pm-input"
                  value="{{ $settings['page_home_about_chip_color'] ?? '#94a3b8' }}">
              </div>
            </div>
          </div>
        </div>


        {{-- Header Section About --}}
        <div class="pm-card">
          <div class="pm-card-header">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
              <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>
            <div class="pm-card-title">Judul Utama & Header About Us</div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 2fr; gap:1.25rem;">
            <div>
              <label class="pm-label">Sub-Judul / Badge Tag (Atas)</label>
              <input type="text" name="about_subtitle" class="pm-input"
                value="{{ $settings['about_subtitle'] ?? 'ABOUT US' }}">
              <div class="pm-help">Teks badge kecil di atas judul utama (Contoh: ABOUT US).</div>
            </div>
            <div>
              <label class="pm-label">Judul Utama About Us (HTML Supported)</label>
              <textarea name="about_heading" class="pm-input"
                rows="2">{{ $settings['about_heading'] ?? 'Solusi Cat <span class="ab-icon-dark-red"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg></span> Berkualitas Tinggi untuk <span class="ab-icon-red"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3c-4.97 0-9 4.03-9 9 0 3.18 1.66 6.02 4.14 7.69.41.27.68.73.68 1.22V22h8.36v-1.09c0-.49.27-.95.68-1.22 2.48-1.67 4.14-4.51 4.14-7.69 0-4.97-4.03-9-9-9zM12 18h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg></span> Industri & Maritim' }}</textarea>
              <div class="pm-help">Anda dapat mengubah teks judul utama atau menambahkan tag icon.</div>
            </div>
          </div>
        </div>

        {{-- 4 Cards Customization Grid --}}
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1.5rem;">

          {{-- Card 1: Keywords Pattern Card --}}
          <div class="pm-card" style="margin-bottom:0;">
            <div class="pm-card-header">
              <span
                style="background:#F1F5F9; color:#0F172A; font-weight:800; padding:2px 8px; border-radius:6px; font-size:.75rem;">Card
                1</span>
              <div class="pm-card-title">Pengalaman & Keyword Chips</div>
            </div>
            <div style="display:flex; flex-direction:column; gap:1rem;">
              <div>
                <label class="pm-label">Label Card</label>
                <input type="text" name="about_c1_label" class="pm-input"
                  value="{{ $settings['about_c1_label'] ?? 'Pengalaman' }}">
              </div>
              <div>
                <label class="pm-label">Nilai Teks / Tahun</label>
                <input type="text" name="about_c1_value" class="pm-input"
                  value="{{ $settings['about_c1_value'] ?? '10+ Tahun' }}">
              </div>
              <div>
                <label class="pm-label">Keywords Tag Chips (Pisahkan dengan koma)</label>
                <textarea name="about_c1_keywords" class="pm-input"
                  rows="3">{{ $settings['about_c1_keywords'] ?? 'Piring Keramik, Keramik Lantai, Porselen, Grosir Hotel, High Quality, Keramik Dinding, Tahan Lama, Food Safe' }}</textarea>
                <div class="pm-help">Keyword mengapung yang tampil di background Card 1.</div>
              </div>
            </div>
          </div>

          {{-- Card 2: Solid Accent Card --}}
          <div class="pm-card" style="margin-bottom:0;">
            <div class="pm-card-header">
              <span
                style="background:#0F172A; color:#ffffff; font-weight:800; padding:2px 8px; border-radius:6px; font-size:.75rem;">Card
                2</span>
              <div class="pm-card-title">Komitmen Kualitas (Solid Card)</div>
            </div>
            <div style="display:flex; flex-direction:column; gap:1rem;">
              <div>
                <label class="pm-label">Label Card</label>
                <input type="text" name="about_c2_label" class="pm-input"
                  value="{{ $settings['about_c2_label'] ?? 'Komitmen Kualitas' }}">
              </div>
              <div>
                <label class="pm-label">Nilai Persentase / Stat</label>
                <input type="text" name="about_c2_value" class="pm-input"
                  value="{{ $settings['about_c2_value'] ?? '100%' }}">
              </div>
              <div>
                <label class="pm-label">Deskripsi Card 2</label>
                <textarea name="about_c2_desc" class="pm-input"
                  rows="2">{{ $settings['about_c2_desc'] ?? 'Memberikan solusi piring dan tableware keramik terbaik untuk usaha Anda.' }}</textarea>
              </div>
              <div>
                <label class="pm-label">Background Color Card 2</label>
                <div class="pm-color-picker-wrap">
                  <input type="color" value="{{ $settings['about_c2_bg'] ?? '#0A1930' }}"
                    onchange="document.getElementById('c_c2_bg').value=this.value">
                  <input type="text" name="about_c2_bg" id="c_c2_bg" class="pm-input"
                    value="{{ $settings['about_c2_bg'] ?? '#0A1930' }}">
                </div>
              </div>
            </div>
          </div>

          {{-- Card 3: Image Card --}}
          <div class="pm-card" style="margin-bottom:0;">
            <div class="pm-card-header">
              <span
                style="background:#EFF6FF; color:#2563EB; font-weight:800; padding:2px 8px; border-radius:6px; font-size:.75rem;">Card
                3</span>
              <div class="pm-card-title">Proyek & Gambar Background Card</div>
            </div>
            <div style="display:flex; flex-direction:column; gap:1rem;">
              <div>
                <label class="pm-label">Upload Gambar Background Card 3</label>
                @if(!empty($settings['about_c3_image']))
                  <div
                    style="width:100px; height:60px; border-radius:8px; overflow:hidden; margin-bottom:.5rem; border:1px solid #E2E8F0;">
                    <img src="{{ asset('storage/' . $settings['about_c3_image']) }}"
                      style="width:100%;height:100%;object-fit:cover;">
                  </div>
                @endif
                <input type="file" name="about_c3_image" class="pm-input" accept="image/*">
              </div>
              <div>
                <label class="pm-label">Nilai Proyek / Stat</label>
                <input type="text" name="about_c3_value" class="pm-input"
                  value="{{ $settings['about_c3_value'] ?? '500+' }}">
              </div>
              <div>
                <label class="pm-label">Deskripsi Card 3</label>
                <textarea name="about_c3_desc" class="pm-input"
                  rows="2">{{ $settings['about_c3_desc'] ?? 'Proyek suplai dan pengadaan diselesaikan di seluruh Indonesia.' }}</textarea>
              </div>
            </div>
          </div>

          {{-- Card 4: Light Gray Card --}}
          <div class="pm-card" style="margin-bottom:0;">
            <div class="pm-card-header">
              <span
                style="background:#F1F5F9; color:#0F172A; font-weight:800; padding:2px 8px; border-radius:6px; font-size:.75rem;">Card
                4</span>
              <div class="pm-card-title">Distribusi Produk Card</div>
            </div>
            <div style="display:flex; flex-direction:column; gap:1rem;">
              <div>
                <label class="pm-label">Label Card 4</label>
                <input type="text" name="about_c4_label" class="pm-input"
                  value="{{ $settings['about_c4_label'] ?? 'Distribusi Produk' }}">
              </div>
              <div>
                <label class="pm-label">Nilai Stat / Volume</label>
                <input type="text" name="about_c4_value" class="pm-input"
                  value="{{ $settings['about_c4_value'] ?? '1.000+' }}">
              </div>
              <div>
                <label class="pm-label">Deskripsi Card 4</label>
                <textarea name="about_c4_desc" class="pm-input"
                  rows="3">{{ $settings['about_c4_desc'] ?? 'Ribuan set tableware terdistribusi ke berbagai sektor Horeca.' }}</textarea>
              </div>
            </div>
          </div>

        </div>
      </div>

      {{-- SUB TAB 3: SECT PRODUCT --}}
      <div id="sub-sect-product" class="sub-tab-content"
        style="{{ ($activeTab ?? '') === 'sect-product' ? '' : 'display:none;' }}">
        <div class="pm-card">
          <div class="pm-card-header">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <div class="pm-card-title">Kustomisasi Section Katalog Produk</div>
          </div>

          <div
            style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
            <div>
              <label class="pm-label">Background Section</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_product_bg'] ?? '#0F172A' }}"
                  onchange="document.getElementById('c_prod_bg').value=this.value">
                <input type="text" name="page_home_product_bg" id="c_prod_bg" class="pm-input"
                  value="{{ $settings['page_home_product_bg'] ?? '#0F172A' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Background Card Produk</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_product_card_bg'] ?? '#1E293B' }}"
                  onchange="document.getElementById('c_prod_card_bg').value=this.value">
                <input type="text" name="page_home_product_card_bg" id="c_prod_card_bg" class="pm-input"
                  value="{{ $settings['page_home_product_card_bg'] ?? '#1E293B' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Judul / Title</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_product_title_color'] ?? '#FFFFFF' }}"
                  onchange="document.getElementById('c_prod_title').value=this.value">
                <input type="text" name="page_home_product_title_color" id="c_prod_title" class="pm-input"
                  value="{{ $settings['page_home_product_title_color'] ?? '#FFFFFF' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Teks Deskripsi</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_product_desc_color'] ?? '#94A3B8' }}"
                  onchange="document.getElementById('c_prod_desc').value=this.value">
                <input type="text" name="page_home_product_desc_color" id="c_prod_desc" class="pm-input"
                  value="{{ $settings['page_home_product_desc_color'] ?? '#94A3B8' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Teks Note Kecil</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_product_note_color'] ?? '#64748B' }}"
                  onchange="document.getElementById('c_prod_note').value=this.value">
                <input type="text" name="page_home_product_note_color" id="c_prod_note" class="pm-input"
                  value="{{ $settings['page_home_product_note_color'] ?? '#64748B' }}">
              </div>
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
            <div>
              <label class="pm-label">Judul Section Produk</label>
              <input type="text" name="product_section_title" class="pm-input"
                value="{{ $settings['product_section_title'] ?? 'Katalog Produk Kami' }}">
            </div>
            <div>
              <label class="pm-label">Catatan Kecil Kanan</label>
              <input type="text" name="product_section_note" class="pm-input"
                value="{{ $settings['product_section_note'] ?? 'Tersedia berbagai varian dan spesifikasi' }}">
            </div>
            <div style="grid-column: span 2;">
              <label class="pm-label">Deskripsi / Subtitle Section Produk</label>
              <textarea name="product_section_desc" class="pm-input"
                rows="2">{{ $settings['product_section_desc'] ?? 'Solusi cat dan coating premium terpercaya untuk berbagai skala industri di Indonesia.' }}</textarea>
            </div>
            <div>
              <label class="pm-label">Teks Tombol Utama CTA</label>
              <input type="text" name="product_cta1_text" class="pm-input"
                value="{{ $settings['product_cta1_text'] ?? 'Ke Katalog Produk' }}">
            </div>
            <div>
              <label class="pm-label">Teks Tombol Sekunder CTA</label>
              <input type="text" name="product_cta2_text" class="pm-input"
                value="{{ $settings['product_cta2_text'] ?? 'Semua Kategori Produk' }}">
            </div>
          </div>
        </div>
      </div>

      {{-- SUB TAB 4: SECT VALUE --}}
      <div id="sub-sect-value" class="sub-tab-content"
        style="{{ ($activeTab ?? '') === 'sect-value' ? '' : 'display:none;' }}">
        <div class="pm-card">
          <div class="pm-card-header">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
            </svg>
            <div class="pm-card-title">Kustomisasi Section Keunggulan (Value)</div>
          </div>

          <div
            style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
            <div>
              <label class="pm-label">Background Section</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_value_bg'] ?? '#FFFFFF' }}"
                  onchange="document.getElementById('c_val_bg').value=this.value">
                <input type="text" name="page_home_value_bg" id="c_val_bg" class="pm-input"
                  value="{{ $settings['page_home_value_bg'] ?? '#FFFFFF' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Card Item</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_value_card_bg'] ?? '#F8FAFC' }}"
                  onchange="document.getElementById('c_val_card_bg').value=this.value">
                <input type="text" name="page_home_value_card_bg" id="c_val_card_bg" class="pm-input"
                  value="{{ $settings['page_home_value_card_bg'] ?? '#F8FAFC' }}">
              </div>
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 2fr; gap:1.25rem; margin-bottom:1.5rem;">
            <div>
              <label class="pm-label">Badge Label Atas</label>
              <input type="text" name="value_section_label" class="pm-input"
                value="{{ $settings['value_section_label'] ?? 'KEUNGGULAN' }}">
            </div>
            <div>
              <label class="pm-label">Judul Section Keunggulan</label>
              <input type="text" name="value_section_title" class="pm-input"
                value="{{ $settings['value_section_title'] ?? 'Mengapa Pilih Pusat Piring Keramik?' }}">
            </div>
            <div style="grid-column: span 2;">
              <label class="pm-label">Deskripsi Section Keunggulan</label>
              <textarea name="value_section_desc" class="pm-input"
                rows="2">{{ $settings['value_section_desc'] ?? 'Solusi perlindungan dan pelapisan berkualitas tinggi untuk kebutuhan maritim dan industri skala besar di seluruh Indonesia.' }}</textarea>
            </div>
          </div>
        </div>
      </div>

      {{-- SUB TAB 5: SECT APLIKASI --}}
      <div id="sub-sect-aplikasi" class="sub-tab-content"
        style="{{ ($activeTab ?? '') === 'sect-aplikasi' ? '' : 'display:none;' }}">
        <div class="pm-card">
          <div class="pm-card-header">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <div class="pm-card-title">Kustomisasi Section Aplikasi & Use Case</div>
          </div>

          <div
            style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
            <div>
              <label class="pm-label">Background Section</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_aplikasi_bg'] ?? '#0A1930' }}"
                  onchange="document.getElementById('c_apk_bg').value=this.value">
                <input type="text" name="page_home_aplikasi_bg" id="c_apk_bg" class="pm-input"
                  value="{{ $settings['page_home_aplikasi_bg'] ?? '#0A1930' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Badge Label</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_aplikasi_label_color'] ?? '#94A3B8' }}"
                  onchange="document.getElementById('c_apk_label').value=this.value">
                <input type="text" name="page_home_aplikasi_label_color" id="c_apk_label" class="pm-input"
                  value="{{ $settings['page_home_aplikasi_label_color'] ?? '#94A3B8' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Judul Section</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_aplikasi_title_color'] ?? '#FFFFFF' }}"
                  onchange="document.getElementById('c_apk_title').value=this.value">
                <input type="text" name="page_home_aplikasi_title_color" id="c_apk_title" class="pm-input"
                  value="{{ $settings['page_home_aplikasi_title_color'] ?? '#FFFFFF' }}">
              </div>
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr 2fr; gap:1.25rem; margin-bottom:1.5rem;">
            <div>
              <label class="pm-label">Badge Label Atas</label>
              <input type="text" name="aplikasi_section_label" class="pm-input"
                value="{{ $settings['aplikasi_section_label'] ?? 'APLIKASI' }}">
            </div>
            <div>
              <label class="pm-label">Judul Section Aplikasi</label>
              <input type="text" name="aplikasi_section_title" class="pm-input"
                value="{{ $settings['aplikasi_section_title'] ?? 'Cocok untuk Berbagai Industri' }}">
            </div>
            <div style="grid-column: span 2;">
              <label class="pm-label">Deskripsi Section Aplikasi</label>
              <textarea name="aplikasi_section_desc" class="pm-input"
                rows="2">{{ $settings['aplikasi_section_desc'] ?? 'Produk pelapis dan cat dirancang untuk melindungi beragam aset strategis di berbagai sektor.' }}</textarea>
            </div>
          </div>

          {{-- 4 Image Uploads for Applications --}}
          <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1.25rem;">
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:1.25rem; border-radius:14px;">
              <label class="pm-label">1. Gambar Maritim / Restoran</label>
              @if(!empty($settings['app_img_restoran']))
                <img src="{{ asset('storage/' . $settings['app_img_restoran']) }}"
                  style="width:100px; height:60px; object-fit:cover; border-radius:8px; margin-bottom:.5rem;">
              @endif
              <input type="file" name="app_img_restoran" class="pm-input" accept="image/*">
            </div>
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:1.25rem; border-radius:14px;">
              <label class="pm-label">2. Gambar Pabrik / Gudang</label>
              @if(!empty($settings['app_img_pabrik']))
                <img src="{{ asset('storage/' . $settings['app_img_pabrik']) }}"
                  style="width:100px; height:60px; object-fit:cover; border-radius:8px; margin-bottom:.5rem;">
              @endif
              <input type="file" name="app_img_pabrik" class="pm-input" accept="image/*">
            </div>
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:1.25rem; border-radius:14px;">
              <label class="pm-label">3. Gambar Struktur Baja / Hotel</label>
              @if(!empty($settings['app_img_gor']))
                <img src="{{ asset('storage/' . $settings['app_img_gor']) }}"
                  style="width:100px; height:60px; object-fit:cover; border-radius:8px; margin-bottom:.5rem;">
              @endif
              <input type="file" name="app_img_gor" class="pm-input" accept="image/*">
            </div>
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:1.25rem; border-radius:14px;">
              <label class="pm-label">4. Gambar Komersial / Dapur</label>
              @if(!empty($settings['app_img_dapur']))
                <img src="{{ asset('storage/' . $settings['app_img_dapur']) }}"
                  style="width:100px; height:60px; object-fit:cover; border-radius:8px; margin-bottom:.5rem;">
              @endif
              <input type="file" name="app_img_dapur" class="pm-input" accept="image/*">
            </div>
          </div>
        </div>
      </div>

      {{-- SUB TAB 6: SECT KOTA --}}
      <div id="sub-sect-kota" class="sub-tab-content"
        style="{{ ($activeTab ?? '') === 'sect-kota' ? '' : 'display:none;' }}">
        <div class="pm-card">
          <div class="pm-card-header">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <div class="pm-card-title">Kustomisasi Section Jangkauan Kota</div>
          </div>

          <div
            style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
            <div>
              <label class="pm-label">Background Section</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_kota_bg'] ?? '#0F172A' }}"
                  onchange="document.getElementById('c_kota_bg').value=this.value">
                <input type="text" name="page_home_kota_bg" id="c_kota_bg" class="pm-input"
                  value="{{ $settings['page_home_kota_bg'] ?? '#0F172A' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Judul Section</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_kota_title_color'] ?? '#FFFFFF' }}"
                  onchange="document.getElementById('c_kota_title').value=this.value">
                <input type="text" name="page_home_kota_title_color" id="c_kota_title" class="pm-input"
                  value="{{ $settings['page_home_kota_title_color'] ?? '#FFFFFF' }}">
              </div>
            </div>
          </div>

          <div style="display:grid; grid-template-columns:1fr; gap:1.25rem; margin-bottom:1.5rem;">
            <div>
              <label class="pm-label">Judul Utama Jangkauan Kota</label>
              <input type="text" name="kota_section_title" class="pm-input"
                value="{{ $settings['kota_section_title'] ?? 'Melayani seluruh Indonesia dengan jangkauan 50+ Kota.' }}">
            </div>
            <div>
              <label class="pm-label">Deskripsi Paragraf Jangkauan Kota</label>
              <textarea name="kota_section_desc" class="pm-input"
                rows="3">{{ $settings['kota_section_desc'] ?? 'Bermitra dengan ekspedisi terkemuka untuk mendistribusikan solusi perlindungan maritim dan industri kualitas premium ke seluruh pelosok Nusantara secara cepat dan aman.' }}</textarea>
            </div>
            <div>
              <label class="pm-label">Upload Gambar Peta Indonesia (Map Vector/PNG)</label>
              @if(!empty($settings['coverage_map']))
                <div style="max-width:200px; margin-bottom:.5rem;">
                  <img src="{{ asset('storage/' . $settings['coverage_map']) }}"
                    style="width:100%; border-radius:8px; border:1px solid #E2E8F0;">
                </div>
              @endif
              <input type="file" name="coverage_map" class="pm-input" accept="image/*">
            </div>
          </div>
        </div>
      </div>

      {{-- SUB TAB 7: SECT FOOTER --}}
      <div id="sub-sect-footer" class="sub-tab-content"
        style="{{ ($activeTab ?? '') === 'sect-footer' ? '' : 'display:none;' }}">
        <div class="pm-card">
          <div class="pm-card-header">
            <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z M16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
            </svg>
            <div class="pm-card-title">Kustomisasi Section Footer</div>
          </div>

          <div
            style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
            <div>
              <label class="pm-label">Background Footer</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_footer_bg'] ?? '#0A1930' }}"
                  onchange="document.getElementById('c_ftr_bg').value=this.value">
                <input type="text" name="page_home_footer_bg" id="c_ftr_bg" class="pm-input"
                  value="{{ $settings['page_home_footer_bg'] ?? '#0A1930' }}">
              </div>
            </div>
            <div>
              <label class="pm-label">Warna Teks Footer</label>
              <div class="pm-color-picker-wrap">
                <input type="color" value="{{ $settings['page_home_footer_text_color'] ?? '#94A3B8' }}"
                  onchange="document.getElementById('c_ftr_text').value=this.value">
                <input type="text" name="page_home_footer_text_color" id="c_ftr_text" class="pm-input"
                  value="{{ $settings['page_home_footer_text_color'] ?? '#94A3B8' }}">
              </div>
            </div>
          </div>

          <div>
            <label class="pm-label">Teks Copyright Footer</label>
            <input type="text" name="footer_copyright" class="pm-input"
              value="{{ $settings['footer_copyright'] ?? '© ' . date('Y') . ' Pusat Piring Keramik. All Rights Reserved.' }}">
          </div>
        </div>
      </div>
    </div>

    {{-- SUB TAB 8: SECT SEO (SEO, AEO & GEO SCHEMA) --}}
    <div id="sub-sect-seo" class="sub-tab-content"
      style="{{ ($activeTab ?? 'sect-hero') === 'sect-seo' ? '' : 'display:none;' }}">

      @php
        $primaryWa = \App\Models\WaSetting::primary() ?? \App\Models\WaSetting::where('is_active', true)->first();
        $rawWaPhone = $primaryWa?->nomor_wa ?? ($settings['phone'] ?? ($settings['whatsapp'] ?? '087832505656'));
        $cleanWaPhone = preg_replace('/[^0-9]/', '', $rawWaPhone);
        if (str_starts_with($cleanWaPhone, '0')) {
          $cleanWaPhone = '62' . substr($cleanWaPhone, 1);
        }
        $defaultPhoneIntl = '+' . ltrim($cleanWaPhone, '+');

        $defaultCity = $settings['address_city'] ?? 'Semarang';
        if (is_numeric($defaultCity) || preg_match('/^[0-9]+$/', trim($defaultCity))) {
          $defaultCity = 'Semarang';
        }

        $defaultProv = $settings['address_province'] ?? 'Jawa Tengah';
        if (is_numeric($defaultProv) || preg_match('/^[0-9]+$/', trim($defaultProv))) {
          $defaultProv = 'Jawa Tengah';
        }

        $defaultStreet = $settings['address_full'] ?? ($settings['address_street'] ?? 'Jl. Semarang No. 88');
        $defaultPostal = $settings['address_postal'] ?? '50123';
      @endphp

      {{-- CARD 1: Local SEO & Alamat Presisi (Tekstual & Koordinat) --}}
      <div class="pm-card">
        <div class="pm-card-header">
          <svg width="22" height="22" fill="none" stroke="#2563EB" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <div>
            <div class="pm-card-title">1. Local SEO & Data Lokasi Presisi (GEO)</div>
            <div class="pm-help">Perbaiki kode wilayah menjadi nama kota & provinsi resmi, format telepon +62, serta
              koordinat peta. Jika dikosongkan, otomatis menggunakan data Pengaturan Umum / WhatsApp.</div>
          </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:1.25rem;">
          <div>
            <label class="pm-label">Nama Kota / Kabupaten (addressLocality)</label>
            <input type="text" name="address_city_name" class="pm-input"
              value="{{ $settings['address_city_name'] ?? '' }}" placeholder="Fallback: {{ $defaultCity }}">
            <div class="pm-help">Gunakan teks nama kota resmi. Kosongkan untuk fallback ke database utama
              ({{ $defaultCity }})</div>
          </div>

          <div>
            <label class="pm-label">Nama Provinsi (addressRegion)</label>
            <input type="text" name="address_province_name" class="pm-input"
              value="{{ $settings['address_province_name'] ?? '' }}" placeholder="Fallback: {{ $defaultProv }}">
            <div class="pm-help">Gunakan teks nama provinsi resmi. Kosongkan untuk fallback ke database utama
              ({{ $defaultProv }})</div>
          </div>

          <div>
            <label class="pm-label">Alamat Jalan Lengkap (streetAddress)</label>
            <input type="text" name="address_street_full" class="pm-input"
              value="{{ $settings['address_street_full'] ?? '' }}" placeholder="Fallback: {{ $defaultStreet }}">
            <div class="pm-help">Kosongkan untuk fallback ke alamat di Pengaturan Umum</div>
          </div>

          <div>
            <label class="pm-label">Kode Pos (postalCode)</label>
            <input type="text" name="address_postal_code" class="pm-input"
              value="{{ $settings['address_postal_code'] ?? '' }}" placeholder="Fallback: {{ $defaultPostal }}">
            <div class="pm-help">Kosongkan untuk fallback ke kode pos Pengaturan Umum</div>
          </div>

          <div>
            <label class="pm-label">Telepon Format Internasional (telephone)</label>
            <input type="text" name="phone_international" class="pm-input"
              value="{{ $settings['phone_international'] ?? '' }}" placeholder="Fallback: {{ $defaultPhoneIntl }}">
            <div class="pm-help">Format +62. Kosongkan untuk fallback otomatis dari nomor WhatsApp/Telepon utama
              ({{ $defaultPhoneIntl }})</div>
          </div>

          <div>
            <label class="pm-label">Koordinat Latitude (geo.latitude)</label>
            <input type="text" name="geo_latitude" class="pm-input" value="{{ $settings['geo_latitude'] ?? '-6.9932' }}"
              placeholder="-6.9932">
          </div>

          <div>
            <label class="pm-label">Koordinat Longitude (geo.longitude)</label>
            <input type="text" name="geo_longitude" class="pm-input"
              value="{{ $settings['geo_longitude'] ?? '110.4203' }}" placeholder="110.4203">
          </div>

          <div>
            <label class="pm-label">Link Google Maps (hasMap)</label>
            <input type="text" name="google_maps_url" class="pm-input"
              value="{{ $settings['google_maps_url'] ?? 'https://maps.google.com' }}"
              placeholder="https://maps.google.com/?cid=...">
          </div>
        </div>
      </div>

      {{-- CARD 2: SameAs Profil Eksternal (Social & Marketplace Entitas) --}}
      <div class="pm-card">
        <div class="pm-card-header">
          <svg width="22" height="22" fill="none" stroke="#8B5CF6" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
          </svg>
          <div>
            <div class="pm-card-title">2. Identitas Entitas Eksternal (sameAs)</div>
            <div class="pm-help">Masukkan link profil media sosial, Google Business Profile, dan Marketplace (1 URL per
              baris) agar mesin AI (Gemini/ChatGPT/Perplexity) dapat memverifikasi otoritas entitas.</div>
          </div>
        </div>

        <div>
          <label class="pm-label">Daftar Link Profil Eksternal (sameAs)</label>
          <textarea name="seo_same_as_urls" class="pm-input" rows="5"
            placeholder="https://g.co/kgs/... (Google Business Profile)&#10;https://www.instagram.com/pusatpiringkeramik&#10;https://shopee.co.id/pusatpiringkeramik&#10;https://www.tokopedia.com/pusatpiringkeramik">{{ $settings['seo_same_as_urls'] ?? '' }}</textarea>
          <div class="pm-help">Pisahkan setiap URL dengan baris baru (Enter).</div>
        </div>
      </div>

      {{-- CARD 3: Tipe Bisnis, Penawaran & E-E-A-T (SEO & GEO) --}}
      <div class="pm-card">
        <div class="pm-card-header">
          <svg width="22" height="22" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-4h.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
          </svg>
          <div>
            <div class="pm-card-title">3. Tipe Bisnis, Penawaran & E-E-A-T (SEO & GEO Graph)</div>
            <div class="pm-help">Definisikan tipe bisnis spesifik, rentang harga rupiah, topik keahlian, dan pemilik
              entitas.</div>
          </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:1.25rem;">
          <div>
            <label class="pm-label">Tipe Spesifik Bisnis Schema.org (@type)</label>
            <input type="text" name="seo_business_type" class="pm-input"
              value="{{ $settings['seo_business_type'] ?? '["LocalBusiness", "Store", "HomeGoodsStore"]' }}"
              placeholder='["LocalBusiness", "Store", "HomeGoodsStore"]'>
            <div class="pm-help">Default: ["LocalBusiness", "Store", "HomeGoodsStore"]</div>
          </div>

          <div>
            <label class="pm-label">Rentang Harga Produk (priceRange)</label>
            <input type="text" name="seo_price_range" class="pm-input"
              value="{{ $settings['seo_price_range'] ?? 'Rp5.000 - Rp500.000' }}" placeholder="Rp5.000 - Rp500.000">
          </div>

          <div>
            <label class="pm-label">Area Layanan (areaServed)</label>
            <input type="text" name="seo_area_served" class="pm-input"
              value="{{ $settings['seo_area_served'] ?? 'Semarang, Jawa Tengah, Indonesia' }}"
              placeholder="Semarang, Jawa Tengah, Indonesia">
          </div>

          <div>
            <label class="pm-label">Slogan Bisnis (slogan)</label>
            <input type="text" name="seo_slogan" class="pm-input"
              value="{{ $settings['seo_slogan'] ?? 'Distributor & Supplier Piring Keramik Terpercaya' }}"
              placeholder="Distributor & Supplier Piring Keramik Terpercaya">
          </div>

          <div>
            <label class="pm-label">Tahun Pendirian (foundingDate)</label>
            <input type="text" name="seo_founding_date" class="pm-input"
              value="{{ $settings['seo_founding_date'] ?? '2015' }}" placeholder="2015">
          </div>

          <div>
            <label class="pm-label">Nama Pendiri / Founder / EEAT (founder)</label>
            <input type="text" name="seo_founder_name" class="pm-input"
              value="{{ $settings['seo_founder_name'] ?? 'UD. Sukses Makmur' }}" placeholder="UD. Sukses Makmur">
          </div>

          <div style="grid-column: span 2;">
            <label class="pm-label">Topik Keahlian Entitas (knowsAbout)</label>
            <input type="text" name="seo_knows_about" class="pm-input"
              value="{{ $settings['seo_knows_about'] ?? 'Piring Keramik, Mangkok Keramik, Perabotan Restoran & Hotel, Tableware, Dinnerware, Keramik Custom Logo' }}"
              placeholder="Piring Keramik, Mangkok Keramik, Perabotan Restoran & Hotel">
            <div class="pm-help">Pisahkan setiap kata kunci keahlian dengan koma.</div>
          </div>

          <div>
            <label class="pm-label">Nilai Rating Ulasan (ratingValue - optional)</label>
            <input type="text" name="seo_rating_value" class="pm-input" value="{{ $settings['seo_rating_value'] ?? '' }}"
              placeholder="Contoh: 4.9">
          </div>

          <div>
            <label class="pm-label">Jumlah Ulasan Terverifikasi (reviewCount - optional)</label>
            <input type="text" name="seo_rating_count" class="pm-input" value="{{ $settings['seo_rating_count'] ?? '' }}"
              placeholder="Contoh: 128">
          </div>
        </div>
      </div>

      {{-- CARD 4: Jam Operasional (OpeningHoursSpecification) --}}
      <div class="pm-card">
        <div class="pm-card-header">
          <svg width="22" height="22" fill="none" stroke="#D97706" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <div>
            <div class="pm-card-title">4. Jam Operasional Terstruktur (OpeningHoursSpecification)</div>
            <div class="pm-help">Format terstruktur jam buka dan tutup toko untuk Google Local Pack dan AI Search.</div>
          </div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:1.25rem;">
          <div>
            <label class="pm-label">Hari Operasional (dayOfWeek)</label>
            <input type="text" name="seo_opening_days" class="pm-input"
              value="{{ $settings['seo_opening_days'] ?? 'Monday,Tuesday,Wednesday,Thursday,Friday,Saturday' }}"
              placeholder="Monday,Tuesday,Wednesday,Thursday,Friday,Saturday">
            <div class="pm-help">Bahasa Inggris terpisah koma (Monday, Tuesday, dst)</div>
          </div>

          <div>
            <label class="pm-label">Jam Buka (opens)</label>
            <input type="text" name="seo_opening_time" class="pm-input"
              value="{{ $settings['seo_opening_time'] ?? '08:00' }}" placeholder="08:00">
          </div>

          <div>
            <label class="pm-label">Jam Tutup (closes)</label>
            <input type="text" name="seo_closing_time" class="pm-input"
              value="{{ $settings['seo_closing_time'] ?? '17:00' }}" placeholder="17:00">
          </div>
        </div>
      </div>

      {{-- CARD 5: AEO FAQPage Schema Manager --}}
      <div class="pm-card">
        <div class="pm-card-header" style="justify-content:space-between;">
          <div style="display:flex; align-items:center; gap:.75rem;">
            <svg width="22" height="22" fill="none" stroke="#EC4899" stroke-width="2" viewBox="0 0 24 24">
              <path
                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
              <div class="pm-card-title">5. AEO FAQ Schema Manager (Featured Snippet & Voice Search)</div>
              <div class="pm-help">Tambah & kelola pertanyaan dan jawaban yang sering ditanyakan untuk tampil langsung di
                Google Search & Jawaban AI.</div>
            </div>
          </div>
          <button type="button" onclick="addFaqSchemaItem()"
            style="display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1rem;font-size:.8125rem;font-weight:700;background:#0F172A;color:#ffffff;border:none;border-radius:10px;cursor:pointer;transition:all .2s;">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <line x1="12" y1="5" x2="12" y2="19" />
              <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Tambah FAQ Baru
          </button>
        </div>

        @php
          $rawFaqs = $settings['seo_faq_json'] ?? null;
          $defaultFaqs = [
            [
              'question' => 'Apakah menjual piring keramik secara grosir?',
              'answer' => 'Ya, kami adalah distributor utama piring keramik yang melayani pembelian grosir dan eceran dengan harga pabrik langsung.',
              'show' => '1'
            ],
            [
              'question' => 'Apakah pengiriman piring keramik aman sampai luar kota/luar pulau?',
              'answer' => 'Sangat aman. Setiap piring keramik dipack berlapis menggunakan bubble wrap tebal dan peti kayu standar ekspor dengan garansi pecah diganti baru.',
              'show' => '1'
            ],
            [
              'question' => 'Apakah bisa custom logo resto atau hotel di piring keramik?',
              'answer' => 'Bisa. Kami menerima pemesanan piring keramik custom cetak logo untuk restoran, café, hotel, dan souvenir pernikahan.',
              'show' => '1'
            ],
            [
              'question' => 'Bagaimana cara melakukan pemesanan dan konsultasi produk?',
              'answer' => 'Anda dapat menghubungi tim customer service kami melalui WhatsApp di +6287832505656 atau menekan tombol Konsultasi di website kami.',
              'show' => '1'
            ]
          ];
          if (!empty($rawFaqs)) {
            $seoFaqs = is_string($rawFaqs) ? json_decode($rawFaqs, true) : $rawFaqs;
            if (!is_array($seoFaqs) || count($seoFaqs) === 0) {
              $seoFaqs = $defaultFaqs;
            }
          } else {
            $seoFaqs = $defaultFaqs;
          }
        @endphp

        <div id="seo-faq-container" style="display:flex; flex-direction:column; gap:0.75rem;">
          @foreach($seoFaqs as $fIdx => $fq)
            <div class="pm-faq-item-row"
              style="background:#F8FAFC; padding:1rem; border-radius:14px; border:1px solid #E2E8F0; display:flex; flex-direction:column; gap:0.75rem;">
              <div style="display:grid; grid-template-columns: 1fr 120px 40px; gap:0.75rem; align-items:center;">
                <div>
                  <label class="pm-label" style="font-size:0.75rem;">Pertanyaan (Question)</label>
                  <input type="text" name="seo_faq_json[{{ $fIdx }}][question]" class="pm-input"
                    value="{{ $fq['question'] ?? '' }}" placeholder="Pertanyaan FAQ">
                </div>
                <div>
                  <label class="pm-label" style="font-size:0.75rem;">Status</label>
                  <select name="seo_faq_json[{{ $fIdx }}][show]" class="pm-input" style="padding:.75rem .5rem !important;">
                    <option value="1" {{ ($fq['show'] ?? '1') == '1' ? 'selected' : '' }}>Tampil</option>
                    <option value="0" {{ ($fq['show'] ?? '1') == '0' ? 'selected' : '' }}>Sembunyi</option>
                  </select>
                </div>
                <div style="padding-top:1.25rem;">
                  <button type="button" onclick="this.closest('.pm-faq-item-row').remove()"
                    style="background:#FEE2E2; border:none; color:#EF4444; width:36px; height:36px; border-radius:10px; cursor:pointer; display:flex; align-items:center; justify-content:center;"
                    title="Hapus FAQ">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </div>
              <div>
                <label class="pm-label" style="font-size:0.75rem;">Jawaban (Answer)</label>
                <textarea name="seo_faq_json[{{ $fIdx }}][answer]" class="pm-input" rows="2"
                  placeholder="Jawaban lengkap FAQ">{{ $fq['answer'] ?? '' }}</textarea>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>
    </div>

  </form>

  {{-- HERO SLIDE MODAL (ADD / EDIT) --}}
  <div class="pm-modal" id="hero-slide-modal">
    <div class="pm-modal-content">
      <div
        style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; padding-bottom:.75rem; border-bottom:1px solid #E2E8F0;">
        <h3 id="modal-title" style="font-size:1.1rem; font-weight:800; color:#0F172A; margin:0;">Tambah Hero Slide</h3>
        <button type="button" onclick="closeHeroModal()"
          style="background:none; border:none; color:#64748B; cursor:pointer; font-size:1.5rem; line-height:1;">&times;</button>
      </div>

      <form method="POST" action="{{ route('admin.hero_slides.store') }}" enctype="multipart/form-data"
        id="hero-slide-form">
        @csrf
        <input type="hidden" name="_method" id="hero-form-method" value="POST">

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
          <div style="grid-column: span 2;">
            <label class="pm-label">Judul Utama Slide * (Gunakan Enter untuk buat 2 baris)</label>
            <textarea name="title" id="slide_title" class="pm-input" rows="2" required
              placeholder="Contoh: Solusi Tableware Keramik&#10;Premium untuk Bisnis F&B"></textarea>
          </div>
          <div>
            <label class="pm-label">Subtitle / Badge Tagline Atas</label>
            <input type="text" name="subtitle" id="slide_subtitle" class="pm-input"
              placeholder="Contoh: Trusted Tableware Distributor">
          </div>
          <div>
            <label class="pm-label">Urutan Tampil (Order)</label>
            <input type="number" name="order" id="slide_order" class="pm-input" value="1" min="1" max="5">
          </div>
          <div style="grid-column: span 2;">
            <label class="pm-label">Deskripsi Ringkas Banner</label>
            <textarea name="description" id="slide_description" class="pm-input" rows="2"
              placeholder="Deskripsi singkat slide hero..."></textarea>
          </div>
          <div style="grid-column: span 2;">
            <label class="pm-label">Tag Chips (Pisahkan dengan koma)</label>
            <input type="text" name="tags" id="slide_tags" class="pm-input"
              placeholder="Piring Keramik, Keramik Lantai, Porselen, Food Grade">
          </div>
          <div style="grid-column: span 2;">
            <label class="pm-label">Gambar Slide Hero (WebP / JPG / PNG)</label>
            <div id="slide_img_preview" style="margin-bottom:.5rem; display:none;">
              <img id="slide_img_src" src="" style="max-height:120px; border-radius:10px; border:1px solid #E2E8F0;">
            </div>
            <input type="file" name="image" class="pm-input" accept="image/*">
            <div
              style="font-size:0.75rem; color:#64748B; margin-top:0.4rem; display:flex; align-items:center; gap:0.35rem; background:#F8FAFC; padding:0.5rem 0.75rem; border-radius:8px; border:1px solid #E2E8F0;">
              <svg width="14" height="14" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"
                style="flex-shrink:0;">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="16" x2="12" y2="12" />
                <line x1="12" y1="8" x2="12.01" y2="8" />
              </svg>
              <span><strong>Rekomendasi Ukuran Banner:</strong> <strong>3448 x 914 px</strong> (Rasio Ultra-wide ~3.77 :
                1), maks 10MB. Sistem otomatis mengompresi dan mengonversi gambar ke format <strong>WebP</strong>.</span>
            </div>
          </div>

          {{-- Hidden Stat fields (Deprecate stats on hero UI) --}}
          <input type="hidden" name="stat_1_value" id="slide_stat_1_value">
          <input type="hidden" name="stat_1_label" id="slide_stat_1_label">
          <input type="hidden" name="stat_2_value" id="slide_stat_2_value">
          <input type="hidden" name="stat_2_label" id="slide_stat_2_label">
          <input type="hidden" name="stat_3_value" id="slide_stat_3_value">
          <input type="hidden" name="stat_3_label" id="slide_stat_3_label">

          <div style="grid-column: span 2; display:flex; align-items:center; gap:.5rem;">
            <input type="checkbox" name="is_active" id="slide_is_active" value="1" checked
              style="width:18px; height:18px; cursor:pointer;">
            <label for="slide_is_active" style="font-size:.875rem; font-weight:700; color:#0F172A; cursor:pointer;">Status
              Aktif (Tampilkan slide di beranda)</label>
          </div>
        </div>

        <div
          style="display:flex; justify-content:flex-end; gap:.75rem; border-top:1px solid #E2E8F0; padding-top:1.25rem;">
          <button type="button" onclick="closeHeroModal()"
            style="padding:.6rem 1.2rem; font-size:.85rem; font-weight:700; background:#F1F5F9; color:#475569; border:none; border-radius:10px; cursor:pointer;">Batal</button>
          <button type="submit"
            style="padding:.6rem 1.5rem; font-size:.85rem; font-weight:700; background:#3B82F6; color:#ffffff; border:none; border-radius:10px; cursor:pointer; font-family:'Montserrat',sans-serif;">Simpan
            Slide</button>
        </div>
      </form>
    </div>
  </div>

  {{-- DELETE SLIDE FORM --}}
  <form id="delete-slide-form" method="POST" action="" style="display:none;">
    @csrf @method('DELETE')
  </form>

  <script>
    function switchMainTab(tabKey) {
      document.querySelectorAll('.pm-main-tab-btn').forEach(btn => btn.classList.remove('active'));
      const activeBtn = document.getElementById('main-tab-' + tabKey);
      if (activeBtn) activeBtn.classList.add('active');

      const pageHeader = document.getElementById('page-header');
      const pageHomepage = document.getElementById('page-homepage');

      if (tabKey === 'header') {
        if (pageHeader) pageHeader.style.display = 'block';
        if (pageHomepage) pageHomepage.style.display = 'none';
        document.getElementById('active_tab_input').value = 'sect-header';
      } else {
        if (pageHeader) pageHeader.style.display = 'none';
        if (pageHomepage) pageHomepage.style.display = 'block';
        if (document.getElementById('active_tab_input').value === 'sect-header') {
          document.getElementById('active_tab_input').value = 'sect-hero';
        }
      }
    }

    let headerMenuIndex = {{ isset($headerMenus) ? count($headerMenus) : 10 }};
    function addHeaderMenuItem() {
      const container = document.getElementById('header-menu-container');
      if (!container) return;
      const row = document.createElement('div');
      row.className = 'pm-menu-item-row';
      row.style.cssText = 'display:grid; grid-template-columns: 2fr 3fr 1.2fr 40px; gap:0.75rem; align-items:center; background:#F8FAFC; padding:0.75rem 1rem; border-radius:12px; border:1px solid #E2E8F0;';
      row.innerHTML = `
          <div>
            <label class="pm-label" style="font-size:0.75rem;">Label Menu</label>
            <input type="text" name="header_menus[${headerMenuIndex}][label]" class="pm-input" value="" placeholder="Menu Baru">
          </div>
          <div>
            <label class="pm-label" style="font-size:0.75rem;">Tujuan Link / URL</label>
            <input type="text" name="header_menus[${headerMenuIndex}][url]" class="pm-input" value="#" placeholder="/halaman-tujuan">
          </div>
          <div>
            <label class="pm-label" style="font-size:0.75rem;">Status Tampil</label>
            <select name="header_menus[${headerMenuIndex}][show]" class="pm-input" style="padding:.75rem .5rem !important;">
              <option value="1" selected>Tampil</option>
              <option value="0">Sembunyi</option>
            </select>
          </div>
          <div style="padding-top:1.25rem;">
            <button type="button" onclick="this.closest('.pm-menu-item-row').remove()"
              style="background:#FEE2E2; border:none; color:#EF4444; width:36px; height:36px; border-radius:10px; cursor:pointer; display:flex; align-items:center; justify-content:center;" title="Hapus Menu">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        `;
      container.appendChild(row);
      headerMenuIndex++;
    }

    let seoFaqIndex = {{ isset($seoFaqs) ? count($seoFaqs) : 10 }};
    function addFaqSchemaItem() {
      const container = document.getElementById('seo-faq-container');
      if (!container) return;
      const row = document.createElement('div');
      row.className = 'pm-faq-item-row';
      row.style.cssText = 'background:#F8FAFC; padding:1rem; border-radius:14px; border:1px solid #E2E8F0; display:flex; flex-direction:column; gap:0.75rem;';
      row.innerHTML = `
          <div style="display:grid; grid-template-columns: 1fr 120px 40px; gap:0.75rem; align-items:center;">
            <div>
              <label class="pm-label" style="font-size:0.75rem;">Pertanyaan (Question)</label>
              <input type="text" name="seo_faq_json[${seoFaqIndex}][question]" class="pm-input" value="" placeholder="Pertanyaan FAQ Baru">
            </div>
            <div>
              <label class="pm-label" style="font-size:0.75rem;">Status</label>
              <select name="seo_faq_json[${seoFaqIndex}][show]" class="pm-input" style="padding:.75rem .5rem !important;">
                <option value="1" selected>Tampil</option>
                <option value="0">Sembunyi</option>
              </select>
            </div>
            <div style="padding-top:1.25rem;">
              <button type="button" onclick="this.closest('.pm-faq-item-row').remove()"
                style="background:#FEE2E2; border:none; color:#EF4444; width:36px; height:36px; border-radius:10px; cursor:pointer; display:flex; align-items:center; justify-content:center;" title="Hapus FAQ">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
              </button>
            </div>
          </div>
          <div>
            <label class="pm-label" style="font-size:0.75rem;">Jawaban (Answer)</label>
            <textarea name="seo_faq_json[${seoFaqIndex}][answer]" class="pm-input" rows="2" placeholder="Jawaban lengkap FAQ"></textarea>
          </div>
        `;
      container.appendChild(row);
      seoFaqIndex++;
    }

    function switchSubTab(subKey) {
      document.querySelectorAll('.pm-sub-tab-btn').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.sub-tab-content').forEach(content => content.style.display = 'none');

      const subBtn = document.getElementById('sub-btn-' + subKey);
      if (subBtn) subBtn.classList.add('active');
      const subContent = document.getElementById('sub-' + subKey);
      if (subContent) subContent.style.display = 'block';
      document.getElementById('active_tab_input').value = subKey;
    }

    function openAddModal() {
      document.getElementById('modal-title').innerText = 'Tambah Hero Slide Baru';
      var form = document.getElementById('hero-slide-form');
      form.action = "{{ route('admin.hero_slides.store') }}";
      document.getElementById('hero-form-method').value = 'POST';

      document.getElementById('slide_title').value = '';
      document.getElementById('slide_subtitle').value = '';
      document.getElementById('slide_order').value = '1';
      document.getElementById('slide_description').value = '';
      document.getElementById('slide_tags').value = '';
      document.getElementById('slide_stat_1_value').value = '640+';
      document.getElementById('slide_stat_1_label').value = 'Projects Completed';
      document.getElementById('slide_stat_2_value').value = '25+';
      document.getElementById('slide_stat_2_label').value = 'Years of Experience';
      document.getElementById('slide_stat_3_value').value = '450+';
      document.getElementById('slide_stat_3_label').value = 'Happy Customers';
      document.getElementById('slide_is_active').checked = true;
      document.getElementById('slide_img_preview').style.display = 'none';

      document.getElementById('hero-slide-modal').classList.add('active');
    }

    function openEditModal(slide) {
      document.getElementById('modal-title').innerText = 'Edit Hero Slide #' + slide.id;
      var form = document.getElementById('hero-slide-form');
      form.action = "/admin/hero-slides/" + slide.id;
      document.getElementById('hero-form-method').value = 'PUT';

      document.getElementById('slide_title').value = slide.title || '';
      document.getElementById('slide_subtitle').value = slide.subtitle || '';
      document.getElementById('slide_order').value = slide.order || 0;
      document.getElementById('slide_description').value = slide.description || '';
      document.getElementById('slide_tags').value = slide.tags || '';
      document.getElementById('slide_stat_1_value').value = slide.stat_1_value || '';
      document.getElementById('slide_stat_1_label').value = slide.stat_1_label || '';
      document.getElementById('slide_stat_2_value').value = slide.stat_2_value || '';
      document.getElementById('slide_stat_2_label').value = slide.stat_2_label || '';
      document.getElementById('slide_stat_3_value').value = slide.stat_3_value || '';
      document.getElementById('slide_stat_3_label').value = slide.stat_3_label || '';
      document.getElementById('slide_is_active').checked = !!slide.is_active;

      if (slide.image) {
        document.getElementById('slide_img_src').src = "/storage/" + slide.image;
        document.getElementById('slide_img_preview').style.display = 'block';
      } else {
        document.getElementById('slide_img_preview').style.display = 'none';
      }

      document.getElementById('hero-slide-modal').classList.add('active');
    }

    function closeHeroModal() {
      document.getElementById('hero-slide-modal').classList.remove('active');
    }

    function confirmDeleteSlide(slideId) {
      if (confirm('Yakin ingin menghapus slide ini?')) {
        var form = document.getElementById('delete-slide-form');
        form.action = "/admin/hero-slides/" + slideId;
        form.submit();
      }
    }
  </script>

@endsection