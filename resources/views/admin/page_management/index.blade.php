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
    box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important;
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
    font-family: 'Montserrat', inherit !important;
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
.pm-color-picker-wrap input[type="color"]::-webkit-color-swatch-wrapper { padding: 0; }
.pm-color-picker-wrap input[type="color"]::-webkit-color-swatch { border: none; border-radius: 8px; }

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

.pm-btn-add {
    background: #EFF6FF;
    color: #2563EB;
    border: 1px dashed #93C5FD;
    padding: 0.6rem 1.2rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}
.pm-btn-add:hover {
    background: #DBEAFE;
    color: #1D4ED8;
}

.pm-btn-del {
    background: #FEE2E2;
    color: #DC2626;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}
.pm-btn-del:hover {
    background: #FCA5A5;
    color: #991B1B;
}
</style>

<form method="POST" action="{{ route('admin.page_management.update') }}" enctype="multipart/form-data" id="page-management-form">
@csrf

{{-- Header --}}
<div style="margin-bottom:1.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
  <div>
    <h1 style="font-size:1.5rem;font-weight:800;color:#0F172A;margin:0 0 .25rem;letter-spacing:-.02em;">Page Management</h1>
    <p style="font-size:.85rem;color:#64748B;margin:0;">Kustomisasi seluruh warna, font, background, dan isi konten per halaman secara dinamis.</p>
  </div>
  <div style="display:flex;gap:.75rem;align-items:center;">
    <a href="{{ route('home') }}" target="_blank" style="display:inline-flex;align-items:center;gap:.375rem;padding:.625rem 1.25rem;font-size:.85rem;font-weight:600;background:#ffffff;border:1.5px solid #E2E8F0;color:#475569;border-radius:12px;text-decoration:none;transition:all .2s;">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      Preview Website
    </a>
    <button type="submit" style="display:inline-flex;align-items:center;gap:.375rem;padding:.625rem 1.5rem;font-size:.875rem;font-weight:700;background:#3B82F6;color:#ffffff;border:none;border-radius:12px;cursor:pointer;transition:all .2s;font-family:'Montserrat',sans-serif;box-shadow:0 4px 14px rgba(59,130,246,0.3);">
      <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
      Simpan Perubahan
    </button>
  </div>
</div>

{{-- MAIN PAGE TABS --}}
<div style="display:flex; gap:0.75rem; margin-bottom:1.5rem; flex-wrap:wrap;">
  <button type="button" class="pm-main-tab-btn active" onclick="switchMainTab('homepage')" id="main-tab-homepage">
    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    /homepage
  </button>
</div>

{{-- HOMEPAGE MAIN CONTAINER --}}
<div id="page-homepage">
  {{-- SUB TABS NAVBAR --}}
  <div style="background:#ffffff; border-radius:16px; padding:0.75rem 1rem; border:1px solid #E2E8F0; margin-bottom:1.5rem; display:flex; gap:0.5rem; flex-wrap:wrap; box-shadow:0 2px 8px rgba(0,0,0,0.02);">
    @php
      $subTabs = [
        'sect-hero'    => ['Hero Section', 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
        'sect-about'   => ['About Us Section', 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        'sect-product' => ['Product Section', 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
        'sect-value'   => ['Value & Keunggulan', 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
        'sect-aplikasi'=> ['Aplikasi & Use Case', 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
        'sect-kota'    => ['Coverage Kota', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
        'sect-footer'  => ['Footer Section', 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z M16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z'],
      ];
    @endphp

    @foreach($subTabs as $sKey => [$sLabel, $sIcon])
      <button type="button" class="pm-sub-tab-btn {{ $loop->first ? 'active' : '' }}" onclick="switchSubTab('{{ $sKey }}')" id="sub-btn-{{ $sKey }}">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $sIcon }}"/></svg>
        {{ $sLabel }}
      </button>
    @endforeach
  </div>

  {{-- SUB TAB 1: SECT HERO --}}
  <div id="sub-sect-hero" class="sub-tab-content">
    <div class="pm-card">
      <div class="pm-card-header">
        <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <div class="pm-card-title">Tampilan & Warna Section Hero</div>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
        <div>
          <label class="pm-label">Background Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_hero_bg'] ?? '#FAFAFA' }}" onchange="document.getElementById('c_hero_bg').value=this.value">
            <input type="text" name="page_home_hero_bg" id="c_hero_bg" class="pm-input" value="{{ $settings['page_home_hero_bg'] ?? '#FAFAFA' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Judul (Title Color)</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_hero_title_color'] ?? '#0A1930' }}" onchange="document.getElementById('c_hero_title').value=this.value">
            <input type="text" name="page_home_hero_title_color" id="c_hero_title" class="pm-input" value="{{ $settings['page_home_hero_title_color'] ?? '#0A1930' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Teks & Deskripsi</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_hero_text_color'] ?? '#64748b' }}" onchange="document.getElementById('c_hero_text').value=this.value">
            <input type="text" name="page_home_hero_text_color" id="c_hero_text" class="pm-input" value="{{ $settings['page_home_hero_text_color'] ?? '#64748b' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Background Card Stat</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_hero_card_bg'] ?? '#0A1930' }}" onchange="document.getElementById('c_hero_card_bg').value=this.value">
            <input type="text" name="page_home_hero_card_bg" id="c_hero_card_bg" class="pm-input" value="{{ $settings['page_home_hero_card_bg'] ?? '#0A1930' }}">
          </div>
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
        <div>
          <label class="pm-label">Badge Tag (Kategori Atas)</label>
          <input type="text" name="hero_badge_text" class="pm-input" value="{{ $settings['hero_badge_text'] ?? 'PRODUSEN & DISTRIBUTOR UTAMA TABLEWARE KERAMIK' }}">
        </div>
        <div>
          <label class="pm-label">Judul Utama Hero (Title)</label>
          <input type="text" name="hero_title" class="pm-input" value="{{ $settings['hero_title'] ?? 'Pusat Piring Keramik Grosir Indonesia' }}">
        </div>
        <div style="grid-column: span 2;">
          <label class="pm-label">Deskripsi Ringkas</label>
          <textarea name="hero_desc" class="pm-input" rows="3">{{ $settings['hero_desc'] ?? 'Supplier resmi piring keramik & porselen food-grade premium untuk Hotel, Restoran, Kafe, Katering & Event Organizer seluruh Indonesia.' }}</textarea>
        </div>
      </div>
    </div>
  </div>

  {{-- SUB TAB 2: SECT ABOUT --}}
  <div id="sub-sect-about" class="sub-tab-content" style="display:none;">
    <div class="pm-card">
      <div class="pm-card-header">
        <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="pm-card-title">Kustomisasi Section About Us</div>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
        <div>
          <label class="pm-label">Background Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_about_bg'] ?? '#FFFFFF' }}" onchange="document.getElementById('c_about_bg').value=this.value">
            <input type="text" name="page_home_about_bg" id="c_about_bg" class="pm-input" value="{{ $settings['page_home_about_bg'] ?? '#FFFFFF' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Judul (Title Color)</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_about_title_color'] ?? '#0F172A' }}" onchange="document.getElementById('c_about_title').value=this.value">
            <input type="text" name="page_home_about_title_color" id="c_about_title" class="pm-input" value="{{ $settings['page_home_about_title_color'] ?? '#0F172A' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Teks & Paragraf</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_about_text_color'] ?? '#475569' }}" onchange="document.getElementById('c_about_text').value=this.value">
            <input type="text" name="page_home_about_text_color" id="c_about_text" class="pm-input" value="{{ $settings['page_home_about_text_color'] ?? '#475569' }}">
          </div>
        </div>
      </div>

      <div style="display:grid; grid-template-columns:1fr; gap:1.25rem;">
        <div>
          <label class="pm-label">Sub-Judul / Badge</label>
          <input type="text" name="about_subtitle" class="pm-input" value="{{ $settings['about_subtitle'] ?? 'TENTANG KAMI' }}">
        </div>
        <div>
          <label class="pm-label">Judul Section About</label>
          <input type="text" name="about_title" class="pm-input" value="{{ $settings['about_title'] ?? 'Mitra Terpercaya Peralatan Makan Keramik B2B' }}">
        </div>
        <div>
          <label class="pm-label">Deskripsi Lengkap About</label>
          <textarea name="about_desc" class="pm-input" rows="4">{{ $settings['about_desc'] ?? 'Kami adalah distributor dan supplier piring keramik, porselen, dan peralatan makan (tableware) terbesar yang melayani ribuan bisnis F&B, hotel bintang, restoran, dan catering di Indonesia.' }}</textarea>
        </div>
      </div>
    </div>
  </div>

  {{-- SUB TAB 3: SECT PRODUCT --}}
  <div id="sub-sect-product" class="sub-tab-content" style="display:none;">
    <div class="pm-card">
      <div class="pm-card-header">
        <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <div class="pm-card-title">Kustomisasi Section Katalog Produk</div>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
        <div>
          <label class="pm-label">Background Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_product_bg'] ?? '#F8FAFC' }}" onchange="document.getElementById('c_prod_bg').value=this.value">
            <input type="text" name="page_home_product_bg" id="c_prod_bg" class="pm-input" value="{{ $settings['page_home_product_bg'] ?? '#F8FAFC' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Background Card</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_product_card_bg'] ?? '#FFFFFF' }}" onchange="document.getElementById('c_prod_card_bg').value=this.value">
            <input type="text" name="page_home_product_card_bg" id="c_prod_card_bg" class="pm-input" value="{{ $settings['page_home_product_card_bg'] ?? '#FFFFFF' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Judul Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_product_title_color'] ?? '#0F172A' }}" onchange="document.getElementById('c_prod_title').value=this.value">
            <input type="text" name="page_home_product_title_color" id="c_prod_title" class="pm-input" value="{{ $settings['page_home_product_title_color'] ?? '#0F172A' }}">
          </div>
        </div>
      </div>

      <div>
        <label class="pm-label">Judul Section Produk</label>
        <input type="text" name="product_section_title" class="pm-input" value="{{ $settings['product_section_title'] ?? 'Katalog Piring & Tableware Unggulan' }}">
      </div>
    </div>
  </div>

  {{-- SUB TAB 4: SECT VALUE --}}
  <div id="sub-sect-value" class="sub-tab-content" style="display:none;">
    <div class="pm-card">
      <div class="pm-card-header">
        <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
        <div class="pm-card-title">Kustomisasi Section Keunggulan (Value)</div>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
        <div>
          <label class="pm-label">Background Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_value_bg'] ?? '#FFFFFF' }}" onchange="document.getElementById('c_val_bg').value=this.value">
            <input type="text" name="page_home_value_bg" id="c_val_bg" class="pm-input" value="{{ $settings['page_home_value_bg'] ?? '#FFFFFF' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Card Item</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_value_card_bg'] ?? '#F8FAFC' }}" onchange="document.getElementById('c_val_card_bg').value=this.value">
            <input type="text" name="page_home_value_card_bg" id="c_val_card_bg" class="pm-input" value="{{ $settings['page_home_value_card_bg'] ?? '#F8FAFC' }}">
          </div>
        </div>
      </div>

      <div>
        <label class="pm-label">Judul Keunggulan</label>
        <input type="text" name="value_section_title" class="pm-input" value="{{ $settings['value_section_title'] ?? 'Mengapa Memilih Kami?' }}">
      </div>
    </div>
  </div>

  {{-- SUB TAB 5: SECT APLIKASI --}}
  <div id="sub-sect-aplikasi" class="sub-tab-content" style="display:none;">
    <div class="pm-card">
      <div class="pm-card-header">
        <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        <div class="pm-card-title">Kustomisasi Section Aplikasi & Segmen Pasar</div>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
        <div>
          <label class="pm-label">Background Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_aplikasi_bg'] ?? '#0A1930' }}" onchange="document.getElementById('c_apk_bg').value=this.value">
            <input type="text" name="page_home_aplikasi_bg" id="c_apk_bg" class="pm-input" value="{{ $settings['page_home_aplikasi_bg'] ?? '#0A1930' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Judul Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_aplikasi_title_color'] ?? '#FFFFFF' }}" onchange="document.getElementById('c_apk_title').value=this.value">
            <input type="text" name="page_home_aplikasi_title_color" id="c_apk_title" class="pm-input" value="{{ $settings['page_home_aplikasi_title_color'] ?? '#FFFFFF' }}">
          </div>
        </div>
      </div>

      <div>
        <label class="pm-label">Judul Section Aplikasi</label>
        <input type="text" name="aplikasi_section_title" class="pm-input" value="{{ $settings['aplikasi_section_title'] ?? 'Melayani Seluruh Sektor Industri F&B & Hospitality' }}">
      </div>
    </div>
  </div>

  {{-- SUB TAB 6: SECT KOTA --}}
  <div id="sub-sect-kota" class="sub-tab-content" style="display:none;">
    <div class="pm-card">
      <div class="pm-card-header">
        <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        <div class="pm-card-title">Kustomisasi Section Jangkauan Kota</div>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
        <div>
          <label class="pm-label">Background Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_kota_bg'] ?? '#FAFAFA' }}" onchange="document.getElementById('c_kota_bg').value=this.value">
            <input type="text" name="page_home_kota_bg" id="c_kota_bg" class="pm-input" value="{{ $settings['page_home_kota_bg'] ?? '#FAFAFA' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Judul Section</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_kota_title_color'] ?? '#0F172A' }}" onchange="document.getElementById('c_kota_title').value=this.value">
            <input type="text" name="page_home_kota_title_color" id="c_kota_title" class="pm-input" value="{{ $settings['page_home_kota_title_color'] ?? '#0F172A' }}">
          </div>
        </div>
      </div>

      <div>
        <label class="pm-label">Judul Jangkauan Kota</label>
        <input type="text" name="kota_section_title" class="pm-input" value="{{ $settings['kota_section_title'] ?? 'Jangkauan Pengiriman Ke 50+ Kota di Indonesia' }}">
      </div>
    </div>
  </div>

  {{-- SUB TAB 7: SECT FOOTER --}}
  <div id="sub-sect-footer" class="sub-tab-content" style="display:none;">
    <div class="pm-card">
      <div class="pm-card-header">
        <svg width="22" height="22" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z M16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
        <div class="pm-card-title">Kustomisasi Section Footer</div>
      </div>

      <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
        <div>
          <label class="pm-label">Background Footer</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_footer_bg'] ?? '#0A1930' }}" onchange="document.getElementById('c_ftr_bg').value=this.value">
            <input type="text" name="page_home_footer_bg" id="c_ftr_bg" class="pm-input" value="{{ $settings['page_home_footer_bg'] ?? '#0A1930' }}">
          </div>
        </div>
        <div>
          <label class="pm-label">Warna Teks Footer</label>
          <div class="pm-color-picker-wrap">
            <input type="color" value="{{ $settings['page_home_footer_text_color'] ?? '#94A3B8' }}" onchange="document.getElementById('c_ftr_text').value=this.value">
            <input type="text" name="page_home_footer_text_color" id="c_ftr_text" class="pm-input" value="{{ $settings['page_home_footer_text_color'] ?? '#94A3B8' }}">
          </div>
        </div>
      </div>

      <div>
        <label class="pm-label">Teks Copyright Footer</label>
        <input type="text" name="footer_copyright" class="pm-input" value="{{ $settings['footer_copyright'] ?? '© ' . date('Y') . ' Pusat Piring Keramik. All Rights Reserved.' }}">
      </div>
    </div>
  </div>
</div>

</form>

<script>
function switchMainTab(tabKey) {
    document.querySelectorAll('.pm-main-tab-btn').forEach(btn => btn.classList.remove('active'));
    document.getElementById('main-tab-' + tabKey).classList.add('active');
}

function switchSubTab(subKey) {
    document.querySelectorAll('.pm-sub-tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.sub-tab-content').forEach(content => content.style.display = 'none');
    
    document.getElementById('sub-btn-' + subKey).classList.add('active');
    document.getElementById('sub-' + subKey).style.display = 'block';
}
</script>

@endsection
