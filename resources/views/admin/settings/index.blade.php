@extends('layouts.admin')
@section('title','Pengaturan Situs')
@section('page-title','Pengaturan Situs')
@section('content')

<style>
/* ===== PREMIUM ADMIN THEME OVERRIDES FOR SETTINGS PAGE ===== */

/* 1. Card Styles */
.tab-section > div[style*="background:#FFFFFF"],
.tab-section > div > div[style*="background:#FFFFFF"],
.tab-section > div > div > div[style*="background:#FFFFFF"] {
    background: #ffffff !important;
    border-radius: 20px !important;
    padding: 1.75rem !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important;
    border: 1px solid #F8FAFC !important;
}

/* 2. Card Headers (Icon Box + Title) */
.tab-section [style*="background:#FFFFFF"] > div:first-child[style*="display:flex"] {
    gap: .75rem !important;
    margin-bottom: 1.75rem !important;
    align-items: center !important;
}
.tab-section [style*="background:#FFFFFF"] > div:first-child[style*="display:flex"] > svg {
    width: 34px !important;
    height: 34px !important;
    padding: 8px !important;
    background: rgba(59,130,246,0.1) !important;
    border-radius: 10px !important;
    stroke: #3B82F6 !important;
    color: #3B82F6 !important;
    box-sizing: border-box !important;
}
.tab-section [style*="background:#FFFFFF"] > div:first-child[style*="display:flex"] > div {
    font-size: .95rem !important;
    font-weight: 800 !important;
    color: #1E293B !important;
    letter-spacing: normal !important;
    text-transform: none !important;
}

/* 3. Form Inputs */
.form-input {
    width: 100% !important;
    padding: .875rem 1rem !important;
    background: #F8FAFC !important;
    border: 1.5px solid #E4E7F0 !important;
    border-radius: 12px !important;
    font-size: .9rem !important;
    color: #1E293B !important;
    font-family: 'Montserrat', inherit !important;
    font-weight: 500 !important;
    outline: none !important;
    box-sizing: border-box !important;
    transition: all .2s !important;
}
.form-input:focus {
    border-color: #3B82F6 !important;
    background: #ffffff !important;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
}

/* 4. Form Labels */
.form-label, 
.tab-section label[style*="font-size:.7rem"] {
    display: block !important;
    font-size: .85rem !important;
    font-weight: 700 !important;
    color: #334155 !important;
    margin-bottom: .5rem !important;
    text-transform: none !important;
    letter-spacing: normal !important;
}
.form-label span, 
.tab-section label span {
    font-weight: 500 !important;
    color: #94A3B8 !important;
    font-size: .75rem !important;
    margin-left: 0.25rem !important;
}

/* 5. File Inputs (Uploaders) */
input[type="file"].form-input {
    padding: 1.25rem 1rem !important;
    background: transparent !important;
    border: 2px dashed #CBD5E1 !important;
    border-radius: 12px !important;
    color: #64748B !important;
    cursor: pointer !important;
}
input[type="file"].form-input:hover {
    border-color: #3B82F6 !important;
    background: #F8FAFF !important;
}
input[type="file"]::file-selector-button {
    background: #F1F5F9 !important;
    border: 1px solid #E2E8F0 !important;
    padding: 0.5rem 1.25rem !important;
    border-radius: 8px !important;
    color: #475569 !important;
    font-weight: 600 !important;
    font-size: .8rem !important;
    cursor: pointer !important;
    transition: all 0.2s !important;
    margin-right: 1rem !important;
}
input[type="file"]::file-selector-button:hover {
    background: #E2E8F0 !important;
    color: #1E293B !important;
}

/* 6. Helpers / Descriptions */
.tab-section p[style*="font-size:.7rem"],
.tab-section p[style*="font-size:.75rem"] {
    font-size: .75rem !important;
    color: #94A3B8 !important;
    margin-top: .5rem !important;
    line-height: 1.5 !important;
    font-weight: 500 !important;
}

/* 7. Image Previews */
.tab-section div[style*="background:#F8FAFC"] {
    background: #F8FAFC !important;
    border: 1.5px solid #E4E7F0 !important;
    border-radius: 12px !important;
    padding: 1rem !important;
}

/* 8. Tab Buttons (Matching Page Management Style) */
.pm-main-tab-btn {
  padding: 0.75rem 1.5rem !important;
  font-size: 0.9rem !important;
  font-weight: 700 !important;
  border-radius: 14px !important;
  border: 1.5px solid #E2E8F0 !important;
  background: #ffffff !important;
  color: #64748B !important;
  cursor: pointer !important;
  transition: all 0.2s !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 0.5rem !important;
  font-family: 'Montserrat', sans-serif !important;
}

.pm-main-tab-btn:hover {
  border-color: #CBD5E1 !important;
  color: #0F172A !important;
}

.pm-main-tab-btn.active {
  background: #0F172A !important;
  color: #ffffff !important;
  border-color: #0F172A !important;
  box-shadow: 0 4px 15px rgba(15, 23, 42, 0.2) !important;
}

/* 9. Premium Buttons */
button[type="submit"][style*="background:#0F172A"] {
    background: #3B82F6 !important;
    color: #fff !important;
    font-size: .875rem !important;
    font-weight: 700 !important;
    padding: .625rem 1.25rem !important;
    border-radius: 10px !important;
    border: none !important;
    box-shadow: 0 4px 14px rgba(59,130,246,0.3) !important;
    transition: all .2s !important;
}
button[type="submit"][style*="background:#0F172A"]:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 20px rgba(59,130,246,0.4) !important;
}
a[target="_blank"][style*="border:1px solid"] {
    background: #fff !important;
    border: 1.5px solid #E4E7F0 !important;
    color: #475569 !important;
    font-size: .85rem !important;
    font-weight: 600 !important;
    padding: .625rem 1.25rem !important;
    border-radius: 10px !important;
    transition: all .2s !important;
}
a[target="_blank"][style*="border:1px solid"]:hover {
    border-color: #3B82F6 !important;
    color: #3B82F6 !important;
    background: #F8FAFC !important;
}
button[style*="background:#25D366"] {
    background: #10B981 !important;
    color: #fff !important;
    border-radius: 10px !important;
    padding: .625rem 1.25rem !important;
    font-size: .85rem !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 14px rgba(16,185,129,0.2) !important;
    transition: all .2s !important;
    border: none !important;
}
button[style*="background:#25D366"]:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 20px rgba(16,185,129,0.3) !important;
}
button[style*="background:rgba(37,211,102,.15)"] {
    background: rgba(16,185,129,0.1) !important;
    color: #10B981 !important;
    border: 1px solid rgba(16,185,129,0.2) !important;
    border-radius: 10px !important;
    padding: .625rem 1.25rem !important;
    font-size: .85rem !important;
    font-weight: 700 !important;
    transition: all .2s !important;
}
button[style*="background:rgba(37,211,102,.15)"]:hover {
    background: rgba(16,185,129,0.15) !important;
}
</style><form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" id="settings-form">
@csrf @method('POST')

{{-- Page Header --}}
<div style="margin-bottom:1.5rem; display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1rem;">
  <div>
    <h1 style="font-size:1.375rem;font-weight:800;color:#0F172A;margin:0 0 .25rem;letter-spacing:-.02em;">Pengaturan Situs</h1>
    <p style="font-size:.8125rem;color:var(--text3,#7A7A8A);margin:0;">Kelola konten, SEO, kontak & tampilan website</p>
  </div>
  <div style="display:flex;gap:.5rem;align-items:center;">
    <a href="{{ route('home') }}" target="_blank" style="display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1rem;font-size:.8rem;font-weight:600;background:transparent;border:1px solid #CBD5E1;color:#475569;border-radius:4px;text-decoration:none;transition:all .2s;" onmouseover="this.style.borderColor='rgba(255,255,255,.4)';this.style.color='#fff'" onmouseout="this.style.borderColor='rgba(255,255,255,.15)';this.style.color='rgba(255,255,255,.6)'">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      Preview Website
    </a>
    <button type="submit" style="display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1.25rem;font-size:.875rem;font-weight:700;background:#0F172A;color:#ffffff;border:none;border-radius:4px;cursor:pointer;transition:all .2s;font-family:'Montserrat',sans-serif;" onmouseover="this.style.background='#1E293B'" onmouseout="this.style.background='#0F172A'">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
      Simpan Semua
    </button>
  </div>
</div>

{{-- Tab Nav (Matching Page Management Style) --}}
<div style="display:flex; gap:0.75rem; margin-bottom:1.5rem; flex-wrap:wrap;">
  @php
    $tabs = [
      'general' => ['Umum', 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
      'seo'     => ['SEO & Head Scripts', 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
      'contact' => ['Kontak & Sosmed', 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
    ];
  @endphp
  @foreach($tabs as $tabKey => [$tabLabel, $tabIcon])
  <button type="button" onclick="switchTab('{{ $tabKey }}')" id="tab-btn-{{ $tabKey }}"
          class="pm-main-tab-btn {{ $loop->first ? 'active' : '' }}">
    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $tabIcon }}"/></svg>
    {{ $tabLabel }}
  </button>
  @endforeach
</div>

{{-- ======== TAB: UMUM ======== --}}
<div id="tab-general" class="tab-section">

  {{-- ━━━ IDENTITAS PERUSAHAAN ━━━ --}}
  <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;margin-bottom:1.25rem;">
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
      <svg width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">Identitas Perusahaan</div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
      <div>
        <label class="form-label" for="s-company_name">Nama Perusahaan</label>
        <input type="text" name="company_name" id="s-company_name" class="form-input" value="{{ $settings['company_name'] ?? '' }}" placeholder="Nama Perusahaan Anda">
        <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Tampil di footer, halaman about, sitemap, dan seluruh halaman website.</p>
      </div>
      <div>
        <label class="form-label" for="s-company_tagline">Tagline / Slogan</label>
        <input type="text" name="company_tagline" id="s-company_tagline" class="form-input" value="{{ $settings['company_tagline'] ?? '' }}" placeholder="Tagline / Slogan Perusahaan">
      </div>
      <div>
        <label class="form-label" for="s-address_street">Alamat Jalan</label>
        <input type="text" name="address_street" id="s-address_street" class="form-input" value="{{ $settings['address_street'] ?? '' }}" placeholder="Jl. Tanjung Pinang No. 15">
      </div>
      <div>
        <label class="form-label" for="s-address_province">Provinsi</label>
        <select name="address_province" id="s-address_province" class="form-input" onchange="loadKabupaten(this.value)">
          <option value="">-- Pilih Provinsi --</option>
        </select>
      </div>
      <div>
        <label class="form-label" for="s-address_city">Kota / Kabupaten</label>
        <select name="address_city" id="s-address_city" class="form-input" onchange="loadKecamatan(this.value)">
          <option value="">-- Pilih Kota --</option>
        </select>
      </div>
      <div>
        <label class="form-label" for="s-address_district">Kecamatan</label>
        <select name="address_district" id="s-address_district" class="form-input">
          <option value="">-- Pilih Kecamatan --</option>
        </select>
      </div>
      <div>
        <label class="form-label" for="s-address_postal">Kode Pos</label>
        <input type="text" name="address_postal" id="s-address_postal" class="form-input" value="{{ $settings['address_postal'] ?? '' }}" placeholder="60177" maxlength="5" style="max-width:160px;">
      </div>
      <div>
        <label class="form-label" for="s-address_full">Alamat Lengkap (Preview)</label>
        <textarea name="address_full" id="s-address_full" class="form-input" rows="2" placeholder="Alamat lengkap otomatis terisi">{{ $settings['address_full'] ?? '' }}</textarea>
        <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Terisi otomatis saat Anda simpan, atau Anda bisa edit manual di sini.</p>
      </div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;">
    {{-- Logo --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">Logo Perusahaan</div>
      </div>
      @if(!empty($settings['logo']))
      <div style="margin-bottom:1rem;padding:1rem;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;display:flex;align-items:center;gap:1rem;">
        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logo" style="height:48px;object-fit:contain;">
        <span style="font-size:.75rem;color:#94A3B8;">Logo saat ini</span>
      </div>
      @endif
      <label style="font-size:.7rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text3);display:block;margin-bottom:.5rem;">Upload Logo Baru</label>
      <input type="file" name="logo" class="form-input" accept="image/*" style="padding:.5rem;">
      <p style="font-size:.7rem;color:#94A3B8;margin:.5rem 0 0;">PNG/SVG transparan, min 400px lebar. Otomatis dikonversi ke WebP.</p>
    </div>
    {{-- Favicon --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">Favicon Browser</div>
      </div>
      @if(!empty($settings['favicon']))
      <div style="margin-bottom:1rem;padding:1rem;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;display:flex;align-items:center;gap:1rem;">
        <img src="{{ asset('storage/'.$settings['favicon']) }}" alt="Favicon" style="width:32px;height:32px;object-fit:contain;">
        <span style="font-size:.75rem;color:#94A3B8;">Favicon saat ini</span>
      </div>
      @endif
      <label style="font-size:.7rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text3);display:block;margin-bottom:.5rem;">Upload Favicon (ICO/PNG)</label>
      <input type="file" name="favicon" class="form-input" accept=".ico,.png,.svg" style="padding:.5rem;">
      <p style="font-size:.7rem;color:#94A3B8;margin:.5rem 0 0;">Rekomendasi: 32×32 atau 64×64 px format ICO/PNG.</p>
    </div>

    {{-- Company Profile --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;grid-column:1/-1;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">Company Profile (PDF)</div>
      </div>
      @if(!empty($settings['compro']))
      <div style="margin-bottom:1rem;padding:1rem;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;display:flex;align-items:center;justify-content:space-between;">
        <div style="display:flex;align-items:center;gap:.5rem;">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          <span style="font-size:.8rem;color:#0F172A;">{{ basename($settings['compro']) }}</span>
        </div>
        <a href="{{ asset('storage/'.$settings['compro']) }}" target="_blank" style="font-size:.7rem;color:#0F172A;text-decoration:none;">Buka File</a>
      </div>
      @endif
      <label style="font-size:.7rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text3);display:block;margin-bottom:.5rem;">Upload Compro Baru</label>
      <input type="file" name="compro" class="form-input" accept=".pdf,.doc,.docx" style="padding:.5rem;">
      <p style="font-size:.7rem;color:#94A3B8;margin:.5rem 0 0;">Upload file PDF Company Profile. Akan tampil di menu header.</p>
    </div>

    {{-- Coverage Map --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;grid-column:1/-1;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">Peta Jangkauan (Coverage Map)</div>
      </div>
      @if(!empty($settings['coverage_map']))
      <div style="margin-bottom:1rem;padding:1rem;background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;">
        <img src="{{ asset('storage/'.$settings['coverage_map']) }}" alt="Coverage Map" style="width:100%;max-height:300px;object-fit:contain;border-radius:4px;margin-bottom:.75rem;">
        <span style="font-size:.75rem;color:#94A3B8;">Peta jangkauan saat ini</span>
      </div>
      @endif
      <label style="font-size:.7rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text3);display:block;margin-bottom:.5rem;">Upload Gambar Peta</label>
      <input type="file" name="coverage_map" class="form-input" accept="image/*" style="padding:.5rem;">
      <p style="font-size:.7rem;color:#94A3B8;margin:.5rem 0 0;">Upload gambar peta Indonesia dengan titik-titik jangkauan. Otomatis dikonversi ke WebP. Tidak ada batas ukuran — gambar tampil penuh.</p>
    </div>
  </div>

  <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;">
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
      <svg width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">Teks Umum</div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
      <div>
        <label class="form-label" for="s-footer_desc">Deskripsi Footer</label>
        <input type="text" name="footer_desc" id="s-footer_desc" class="form-input" value="{{ $settings['footer_desc'] ?? '' }}" placeholder="Deskripsi singkat perusahaan...">
        <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Tampil di footer website sebagai deskripsi singkat perusahaan.</p>
      </div>
      <div>
        <label class="form-label" for="s-copyright">Copyright Text</label>
        <input type="text" name="copyright" id="s-copyright" class="form-input" value="{{ $settings['copyright'] ?? '' }}" placeholder="© {{ date('Y') }} Nama Perusahaan. All rights reserved.">
        <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Tampil di bagian bawah footer.</p>
      </div>
      <div>
        <label class="form-label" for="s-founding_year" style="display:inline-flex;align-items:center;gap:0.3rem;">
          <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
          Tahun Berdiri
        </label>
        <input type="number" name="founding_year" id="s-founding_year" class="form-input" value="{{ $settings['founding_year'] ?? '2013' }}" placeholder="2013" min="1900" max="{{ date('Y') }}" style="max-width:180px;">
        <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Otomatis tersinkron ke semua halaman: hero, statistik, footer, dan badge "Sejak xxxx".</p>
      </div>
    </div>
  </div>
</div>

{{-- ======== TAB: SEO ======== --}}
<div id="tab-seo" class="tab-section" style="display:none;">
  <div style="display:flex;flex-direction:column;gap:1.25rem;">

    {{-- KONFIGURASI DOMAIN, NAMA APP & LLM (AI SEO) --}}
    <div style="background:#FFFFFF;border:1.5px solid #3B82F6;box-shadow:0 8px 25px rgba(59,130,246,0.08);border-radius:14px;padding:1.75rem;">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;padding-bottom:1rem;border-bottom:1px solid #F1F5F9;flex-wrap:wrap;gap:1rem;">
        <div style="display:flex;align-items:center;gap:.625rem;">
          <div style="width:36px;height:36px;border-radius:10px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;">
            <svg width="20" height="20" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
          </div>
          <div>
            <div style="font-size:1rem;font-weight:800;color:#0F172A;">Konfigurasi Domain, Nama App & AI SEO (llms.txt)</div>
            <div style="font-size:.75rem;color:#64748B;">Pengaturan dinamis URL domain, Nama App, serta integrasi AI Search Engine (ChatGPT, Claude, Perplexity, Gemini)</div>
          </div>
        </div>
        <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
          <a href="{{ \App\Models\Setting::getAppUrl() }}/sitemap.xml" target="_blank" style="display:inline-flex;align-items:center;gap:.375rem;padding:.4rem .875rem;font-size:.75rem;font-weight:700;background:#F8FAFC;border:1px solid #E2E8F0;color:#334155;border-radius:8px;text-decoration:none;">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
            Sitemap.xml
          </a>
          <a href="{{ \App\Models\Setting::getAppUrl() }}/robots.txt" target="_blank" style="display:inline-flex;align-items:center;gap:.375rem;padding:.4rem .875rem;font-size:.75rem;font-weight:700;background:#F8FAFC;border:1px solid #E2E8F0;color:#334155;border-radius:8px;text-decoration:none;">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            Robots.txt
          </a>
          <a href="{{ \App\Models\Setting::getAppUrl() }}/llms.txt" target="_blank" style="display:inline-flex;align-items:center;gap:.375rem;padding:.4rem .875rem;font-size:.75rem;font-weight:700;background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.2);color:#3B82F6;border-radius:8px;text-decoration:none;">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            llms.txt
          </a>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;">
        {{-- 1. URL Domain --}}
        <div>
          <label class="form-label" for="s-app_url" style="display:inline-flex;align-items:center;gap:0.3rem;">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM3.6 9h16.8M3.6 15h16.8M12 3a15.3 15.3 0 014 9 15.3 15.3 0 01-4 9 15.3 15.3 0 01-4-9 15.3 15.3 0 014-9z"></path></svg>
            URL Domain (App URL)
          </label>
          <input type="url" name="app_url" id="s-app_url" class="form-input" 
                 value="{{ $settings['app_url'] ?? config('app.url', 'https://pusatpiringkeramik.hvmdigital.id') }}" 
                 placeholder="https://pusatpiringkeramik.hvmdigital.id">
          <p style="font-size:.75rem;color:#64748B;margin:.375rem 0 0;line-height:1.4;">
            <strong style="color:#0F172A;">Sinkron Otomatis:</strong> Diperbarui ke <code>.env (APP_URL)</code>, <code>sitemap.xml</code>, dan <code>robots.txt</code>.
          </p>
        </div>

        {{-- 2. App Name --}}
        <div>
          <label class="form-label" for="s-app_name" style="display:inline-flex;align-items:center;gap:0.3rem;">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            Nama Aplikasi (App Name)
          </label>
          <input type="text" name="app_name" id="s-app_name" class="form-input" 
                 value="{{ $settings['app_name'] ?? '' }}" 
                 placeholder="{{ $settings['company_name'] ?? 'Pusat Piring Keramik' }}">
          <p style="font-size:.75rem;color:#64748B;margin:.375rem 0 0;line-height:1.4;">
            <strong style="color:#0F172A;">Fallback Otomatis:</strong> Jika dikosongkan, akan menggunakan Nama Perusahaan (<em>{{ $settings['company_name'] ?? 'Pusat Piring Keramik' }}</em>). Diperbarui ke <code>.env (APP_NAME)</code> & <code>sitemap</code>.
          </p>
        </div>
      </div>

      {{-- 3. Form llms.txt --}}
      <div>
        <label class="form-label" for="s-llms_txt" style="display:inline-flex;align-items:center;gap:0.3rem;">
          <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
          Konten <code>llms.txt</code> (Format Informasi AI Search Engines)
        </label>
        @php
          $siteUrlDefault = $settings['app_url'] ?? config('app.url', 'https://pusatpiringkeramik.hvmdigital.id');
          $compNameDefault = !empty($settings['app_name']) ? $settings['app_name'] : ($settings['company_name'] ?? 'Pusat Piring Keramik');
          $defaultLlms = "# {$compNameDefault}

"
              . "> Distributor resmi & supplier piring keramik, mangkuk, tableware, dan peralatan makan HORECA terpercaya di Indonesia.

"
              . "## Informasi Utama
"
              . "- **Nama Perusahaan**: {$compNameDefault} (UD. Sukses Makmur)
"
              . "- **Situs Resmi**: {$siteUrlDefault}
"
              . "- **Telepon / WhatsApp**: 0818-0589-0181
"
              . "- **Alamat**: Semarang, Jawa Tengah, Indonesia

"
              . "## Kategori Produk Utama
"
              . "- Mug Promosi Cap Gunung (Custom Logo)
"
              . "- Kaibon (Porcelain & Ceramic Tableware)
"
              . "- Toyoki (Japanese Style Stoneware & Fine Dining)
"
              . "- Cap Gunung (Stainless Ware Peralatan Makan)
"
              . "- Piring Cap Gunung (Piring Cekung, Ceper, List Mas, Porselen)
"
              . "- Mangkok Cap Gunung (Mangkok Bakso, Sup, Mie Ayam, Cobek)

"
              . "## Halaman Penting
"
              . "- Katalog Produk: {$siteUrlDefault}/product
"
              . "- Profil Perusahaan: {$siteUrlDefault}/about
"
              . "- Artikel & Tips Tableware: {$siteUrlDefault}/articles
"
              . "- Kontak & Whatsapp: {$siteUrlDefault}/contact
"
              . "- Sitemap XML: {$siteUrlDefault}/sitemap.xml
";
        @endphp
        <textarea name="llms_txt" id="s-llms_txt" class="form-input" rows="9" 
                  style="font-family:'Courier New', monospace; font-size:0.85rem; line-height:1.5; background:#0F172A; color:#38BDF8; border-color:#1E293B;"
                  placeholder="Isi dokumen llms.txt...">{{ $settings['llms_txt'] ?? $defaultLlms }}</textarea>
        <p style="font-size:.75rem;color:#64748B;margin:.375rem 0 0;line-height:1.4;">
          Konten ini dibaca oleh bot AI Search (ChatGPT, Claude, Perplexity, Gemini) untuk memahami profil perusahaan dan struktur website. Dapat diakses secara publik pada URL <code>/llms.txt</code>.
        </p>
      </div>
    </div>
    
    {{-- Google Search Console --}}
    <div style="background:#FFFFFF;border:1px solid rgba(16,185,129,.15);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#10b981;">Google Search Console Verification</div>
      </div>
      <div>
        <label class="form-label" for="s-google_search_console">Meta Tag Verifikasi</label>
        <input type="text" name="google_search_console" id="s-google_search_console" class="form-input" value="{{ $settings['google_search_console'] ?? '' }}" placeholder="<meta name=&quot;google-site-verification&quot; content=&quot;...&quot; />">
        <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Paste meta tag verifikasi HTML dari Google Search Console di sini. Kode ini akan otomatis dipasang di bagian <code>&lt;head&gt;</code> website agar terbaca oleh Google.</p>
      </div>
    </div>
    @foreach([
      ['key'=>'home','label'=>'Halaman Home','route'=>'/'],
      ['key'=>'about','label'=>'Halaman About','route'=>'/about'],
      ['key'=>'services','label'=>'Halaman Layanan','route'=>'/services'],
      ['key'=>'gallery','label'=>'Halaman Galeri','route'=>'/gallery'],
      ['key'=>'articles','label'=>'Halaman Artikel','route'=>'/articles'],
      ['key'=>'contact','label'=>'Halaman Kontak','route'=>'/contact'],
    ] as $page)
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
        <div style="display:flex;align-items:center;gap:.5rem;">
          <svg width="13" height="13" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">{{ $page['label'] }}</div>
        </div>
        <a href="{{ url($page['route']) }}" target="_blank" style="display:flex;align-items:center;gap:.25rem;font-size:.7rem;color:#94A3B8;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#0F172A'" onmouseout="this.style.color='rgba(255,255,255,.3)'">
          {{ $page['route'] }}
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>
      </div>
      <div style="display:grid;grid-template-columns:1fr;gap:.875rem;">
        <div>
          <label class="form-label">Meta Title <span style="color:#94A3B8;font-weight:400;">(max 65 karakter)</span></label>
          <input type="text" name="meta_title_{{ $page['key'] }}" class="form-input" maxlength="65"
                 value="{{ $settings['meta_title_'.$page['key']] ?? '' }}"
                 oninput="updateCounter(this,'cnt-title-{{ $page['key'] }}')"
                 placeholder="{{ $page['label'] }} | Nama Perusahaan">
          <div style="font-size:.7rem;color:#94A3B8;margin-top:.25rem;">
            <span id="cnt-title-{{ $page['key'] }}">{{ strlen($settings['meta_title_'.$page['key']] ?? '') }}</span>/65 karakter
          </div>
        </div>
        <div>
          <label class="form-label">Meta Description <span style="color:#94A3B8;font-weight:400;">(max 160 karakter)</span></label>
          <textarea name="meta_desc_{{ $page['key'] }}" class="form-input" rows="3" maxlength="160"
                    oninput="updateCounter(this,'cnt-desc-{{ $page['key'] }}')"
                    placeholder="Deskripsi halaman untuk mesin pencari...">{{ $settings['meta_desc_'.$page['key']] ?? '' }}</textarea>
          <div style="font-size:.7rem;color:#94A3B8;margin-top:.25rem;">
            <span id="cnt-desc-{{ $page['key'] }}">{{ strlen($settings['meta_desc_'.$page['key']] ?? '') }}</span>/160 karakter
          </div>
        </div>
        <div>
          <label class="form-label">Meta Keywords <span style="color:#94A3B8;font-weight:400;">(pisahkan koma)</span></label>
          <input type="text" name="meta_keywords_{{ $page['key'] }}" class="form-input"
                 value="{{ $settings['meta_keywords_'.$page['key']] ?? '' }}"
                 placeholder="overhead crane, hoist, crane surabaya, ...">
        </div>
        @if($page['key'] === 'home')
        <div>
          <label class="form-label">Default OG Image <span style="color:#94A3B8;font-weight:400;">(1200×630px, untuk share media sosial)</span></label>
          @if(!empty($settings['og_image_default']))
          <div style="margin-bottom:.75rem;border-radius:6px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);">
            <img src="{{ asset('storage/'.$settings['og_image_default']) }}" style="height:100px;width:100%;object-fit:cover;" alt="OG Image">
          </div>
          @endif
          <input type="file" name="og_image_default" class="form-input" accept="image/*" style="padding:.5rem;">
        </div>
        @endif
      </div>
    </div>
    @endforeach

    {{-- Custom Scripts --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;">
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
      <svg width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">Custom Scripts / Tags</div>
    </div>
    <p style="font-size:.75rem;color:#94A3B8;margin-bottom:1.25rem;line-height:1.6;">Gunakan area ini untuk memasukkan kode pelacakan seperti Google Analytics, Meta Pixel, atau custom CSS/JS. Pastikan Anda memasukkan tag lengkap (contoh: <code>&lt;script&gt;...&lt;/script&gt;</code>).</p>
    
    <div style="display:flex;flex-direction:column;gap:1.5rem;">
      <div>
        <label class="form-label" for="s-head_scripts">Script di dalam <code>&lt;head&gt;</code></label>
        <textarea name="head_scripts" id="s-head_scripts" class="form-input" rows="8" placeholder="<!-- Google Tag Manager -->\n<script>...</script>" style="font-family:monospace; font-size:.8rem;">{{ $settings['head_scripts'] ?? '' }}</textarea>
        <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Cocok untuk meta tag verifikasi, Google Analytics (gtag), Meta Pixel base code, atau custom CSS.</p>
      </div>
      <div>
        <label class="form-label" for="s-body_scripts">Script di akhir <code>&lt;body&gt;</code></label>
        <textarea name="body_scripts" id="s-body_scripts" class="form-input" rows="8" placeholder="<!-- Live Chat Widget -->\n<script>...</script>" style="font-family:monospace; font-size:.8rem;">{{ $settings['body_scripts'] ?? '' }}</textarea>
        <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Cocok untuk widget live chat, event tracking pixel, atau custom Javascript yang membutuhkan DOM load selesai.</p>
  </div>

  </div>
</div>

  </div>
</div>





{{-- ======== TAB: KONTAK ======== --}}
<div id="tab-contact" class="tab-section" style="display:none;">
  <div style="display:flex;flex-direction:column;gap:1.25rem;">
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#0F172A" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0F172A;">Informasi Kontak</div>
      </div>
      <p style="font-size:.75rem;color:#94A3B8;margin-bottom:1.25rem;line-height:1.6;">Data di bawah ini akan tampil di <strong style="color:#475569;">Footer</strong>, halaman <strong style="color:#475569;">Kontak</strong>, dan <strong style="color:#475569;">Navbar</strong> website.</p>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div>
          <label class="form-label" for="s-phone">Nomor Telepon Kantor</label>
          <input type="text" name="phone" id="s-phone" class="form-input" value="{{ $settings['phone'] ?? '' }}" placeholder="031-XXXXXXXX">
          <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Tampil di footer & halaman kontak</p>
        </div>
        <div>
          <label class="form-label" for="s-email">Email Perusahaan</label>
          <input type="email" name="email" id="s-email" class="form-input" value="{{ $settings['email'] ?? '' }}" placeholder="karyaperdanateknik@gmail.com">
          <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Tampil di footer & halaman kontak</p>
        </div>
        <div style="grid-column:span 2;">
          <label class="form-label" for="s-business_hours">Jam Operasional</label>
          <input type="text" name="business_hours" id="s-business_hours" class="form-input" value="{{ $settings['business_hours'] ?? '' }}" placeholder="Senin – Sabtu, 08.00 – 17.00 WIB">
          <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Tampil di footer & halaman kontak</p>
        </div>
        <div style="grid-column:span 2;">
          <label class="form-label" for="s-maps_embed">URL Google Maps Embed</label>
          <input type="text" name="maps_embed" id="s-maps_embed" class="form-input" value="{{ $settings['maps_embed'] ?? '' }}" placeholder="https://maps.google.com/maps?q=...&output=embed">
          <p style="font-size:.7rem;color:#94A3B8;margin:.375rem 0 0;">Buka Google Maps → Share → Embed a map → salin URL dari atribut src iframe-nya</p>
        </div>
      </div>
    </div>
  </div>
</div>

</form>

{{-- WhatsApp Numbers Management (Outside Settings Form to avoid DOM nesting issue) --}}
<div id="wa-management-section" style="margin-top:1.5rem;">
  @php $waSettings = \App\Models\WaSetting::ordered()->get(); @endphp
  <div style="background:#FFFFFF;border:1px solid #E2E8F0;box-shadow:0 4px 15px rgba(0,0,0,0.03);border-radius:10px;padding:1.5rem;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
      <div style="display:flex;align-items:center;gap:.5rem;">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="color:#25D366;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#25D366;">Nomor WhatsApp (Floating Button & Order Modal)</div>
      </div>
    </div>
    <p style="font-size:.75rem;color:#94A3B8;margin-bottom:1.25rem;line-height:1.6;">Nomor di bawah ini digunakan pada <strong style="color:#475569;">tombol WA mengambang</strong> dan <strong style="color:#475569;">form order modal</strong> di website. Centang <em>Utama</em> untuk nomor yang aktif dipakai.</p>

    {{-- WA Update Form (terpisah agar tidak konflik submit) --}}
    <form method="POST" action="{{ route('admin.wa.update') }}">
      @csrf
      @forelse($waSettings as $wa)
      <input type="hidden" name="ids[]" value="{{ $wa->id }}">
      <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:8px;padding:1rem;margin-bottom:.75rem;">
        <div style="display:grid;grid-template-columns:1fr 1fr auto auto;gap:.75rem;align-items:end;">
          <div>
            <label class="form-label">Label</label>
            <input type="text" name="label[{{ $wa->id }}]" class="form-input" value="{{ $wa->label }}" placeholder="Contoh: WA Utama">
          </div>
          <div>
            <label class="form-label">Nomor WA <span style="color:#94A3B8;font-weight:400;">(format: 08xxx / 628xxx)</span></label>
            <input type="text" name="nomor_wa[{{ $wa->id }}]" class="form-input" value="{{ $wa->nomor_wa }}" placeholder="08xxxxxxxxxx / 628xxxxxxxxxx">
          </div>
          <div style="display:flex;flex-direction:column;gap:.375rem;align-items:center;">
            <label class="form-label" style="text-align:center;">Utama</label>
            <input type="radio" name="primary" value="{{ $wa->id }}" {{ $wa->is_primary ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#0F172A;cursor:pointer;">
          </div>
          <div>
            <label class="form-label" style="display:block;margin-bottom:.375rem;">Hapus</label>
            <a href="#" onclick="if(confirm('Hapus nomor ini?')) { document.getElementById('del-wa-{{ $wa->id }}').submit(); } return false;"
              style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;background:rgba(15, 23, 42,.1);border:1px solid rgba(15, 23, 42,.25);border-radius:6px;color:#64748B;text-decoration:none;">
              <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
            </a>
          </div>
        </div>
        <div style="margin-top:.75rem;">
          <label class="form-label">Template Pesan WA</label>
          <input type="text" name="template_pesan[{{ $wa->id }}]" class="form-input" value="{{ $wa->template_pesan }}" placeholder="Halo Pusat Piring Keramik, saya ingin menanyakan produk [produk]">
          <p style="font-size:.7rem;color:#94A3B8;margin:.25rem 0 0;">Gunakan [produk] untuk diganti nama produk secara otomatis.</p>
        </div>
      </div>
      @empty
      <div style="text-align:center;padding:1.5rem;color:#94A3B8;font-size:.8rem;">Belum ada nomor WhatsApp. Tambahkan di bawah.</div>
      @endforelse
      @if($waSettings->count() > 0)
      <button type="submit" style="display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1.25rem;font-size:.8rem;font-weight:700;background:#25D366;color:#0F172A;border:none;border-radius:6px;cursor:pointer;margin-bottom:1rem;">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Nomor WA
      </button>
      @endif
    </form>

    {{-- Add New WA Form --}}
    <form method="POST" action="{{ route('admin.wa.store') }}" style="border-top:1px solid #E2E8F0;padding-top:1rem;margin-top:.5rem;">
      @csrf
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#475569;margin-bottom:.75rem;">+ Tambah Nomor Baru</div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
        <div>
          <label class="form-label">Label</label>
          <input type="text" name="label" class="form-input" placeholder="Contoh: WA CS Utama" required>
        </div>
        <div>
          <label class="form-label">Nomor WA <span style="color:#94A3B8;font-weight:400;">(08xxx / 628xxx)</span></label>
          <input type="text" name="nomor_wa" class="form-input" placeholder="081805890181" required>
        </div>
        <div style="grid-column:span 2;">
          <label class="form-label">Template Pesan</label>
          <input type="text" name="template_pesan" class="form-input" value="Halo Pusat Piring Keramik, saya ingin menanyakan produk [produk]. Mohon informasi harga dan ketersediaannya. Terima kasih." placeholder="Halo Pusat Piring Keramik, saya ingin menanyakan produk [produk]" required>
        </div>
      </div>
      <button type="submit" style="margin-top:.75rem;display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1rem;font-size:.8rem;font-weight:700;background:rgba(37,211,102,.15);color:#166534;border:1px solid rgba(37,211,102,.4);border-radius:6px;cursor:pointer;">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Nomor
      </button>
    </form>
  </div>
</div>

{{-- Hidden Delete Forms for WA --}}
@php $waAll = \App\Models\WaSetting::all(); @endphp
@foreach($waAll as $waItem)
<form id="del-wa-{{ $waItem->id }}" method="POST" action="{{ route('admin.wa.destroy', $waItem->id) }}" style="display:none;">
  @csrf @method('DELETE')
</form>
@endforeach

{{-- Hidden Delete Forms for Hero Slides --}}
@php $allSlidesHidden = \App\Models\HeroSlide::all(); @endphp
@foreach($allSlidesHidden as $hs)
<form id="del-slide-{{ $hs->id }}" method="POST" action="{{ route('admin.hero_slides.destroy', $hs->id) }}" style="display:none;">
  @csrf @method('DELETE')
</form>
@endforeach

<script>
function switchTab(name) {
    document.querySelectorAll('.tab-section').forEach(s => s.style.display='none');
    document.querySelectorAll('[id^="tab-btn-"]').forEach(b => b.classList.remove('active'));
    const targetTab = document.getElementById('tab-'+name);
    if (targetTab) targetTab.style.display='block';
    const targetBtn = document.getElementById('tab-btn-'+name);
    if (targetBtn) targetBtn.classList.add('active');
}
function updateCounter(el, cntId) {
    document.getElementById(cntId).textContent = el.value.length;
}
switchTab('general');
</script>
<script>
// Gunakan API data-indonesia (ibnux) yang 100% reliable di hosting manapun (Raw GitHub)
const API_BASE = 'https://ibnux.github.io/data-indonesia';
const savedProvince = @json($settings['address_province'] ?? '');
const savedCity     = @json($settings['address_city'] ?? '');
const savedDistrict = @json($settings['address_district'] ?? '');

async function loadProvinsi() {
    try {
        const res  = await fetch(`${API_BASE}/provinsi.json`);
        const data = await res.json();
        const sel  = document.getElementById('s-address_province');
        sel.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
        data.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p.id;
            opt.textContent = p.nama;
            if (p.nama === savedProvince || p.id === savedProvince) opt.selected = true;
            sel.appendChild(opt);
        });
        if (sel.value) loadKabupaten(sel.value, true);
    } catch(e) { console.warn('Gagal load provinsi:', e); }
}

async function loadKabupaten(provinceCode, initial = false) {
    try {
        const res  = await fetch(`${API_BASE}/kabupaten/${provinceCode}.json`);
        const data = await res.json();
        const sel  = document.getElementById('s-address_city');
        sel.innerHTML = '<option value="">-- Pilih Kota --</option>';
        data.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.id;
            opt.textContent = c.nama;
            if (c.nama === savedCity || c.id === savedCity) opt.selected = true;
            sel.appendChild(opt);
        });
        if (initial && sel.value) loadKecamatan(sel.value, true);
    } catch(e) { console.warn('Gagal load kabupaten:', e); }
}

async function loadKecamatan(cityCode, initial = false) {
    try {
        const res  = await fetch(`${API_BASE}/kecamatan/${cityCode}.json`);
        const data = await res.json();
        const sel  = document.getElementById('s-address_district');
        sel.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        data.forEach(d => {
            const opt = document.createElement('option');
            opt.value = d.id;
            opt.textContent = d.nama;
            if (d.nama === savedDistrict || d.id === savedDistrict) opt.selected = true;
            sel.appendChild(opt);
        });
    } catch(e) { console.warn('Gagal load kecamatan:', e); }
}

// Auto-compose address_full when user changes fields
function composeAddress() {
    const street   = document.getElementById('s-address_street')?.value || '';
    const district = document.getElementById('s-address_district')?.options[document.getElementById('s-address_district').selectedIndex]?.text || '';
    const city     = document.getElementById('s-address_city')?.options[document.getElementById('s-address_city').selectedIndex]?.text || '';
    const province = document.getElementById('s-address_province')?.options[document.getElementById('s-address_province').selectedIndex]?.text || '';
    const postal   = document.getElementById('s-address_postal')?.value || '';
    const parts    = [street, district, city, province, postal].filter(v => v && v !== '-- Pilih Provinsi --' && v !== '-- Pilih Kota --' && v !== '-- Pilih Kecamatan --');
    if (parts.length > 1) {
        document.getElementById('s-address_full').value = parts.join(', ');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    loadProvinsi();
    ['s-address_street','s-address_province','s-address_city','s-address_district','s-address_postal'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('change', composeAddress);
        if (el && id === 's-address_street') el.addEventListener('input', composeAddress);
        if (el && id === 's-address_postal') el.addEventListener('input', composeAddress);
    });
});
</script>
<style>
@keyframes fadeIn { from { opacity:0; transform:translateY(-5px); } to { opacity:1; transform:translateY(0); } }
</style>
@endsection

