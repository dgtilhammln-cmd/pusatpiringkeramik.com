@extends('layouts.admin')
@section('title','Pengaturan Situs')
@section('page-title','Pengaturan Situs')
@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" id="settings-form">
@csrf @method('POST')

{{-- Page Header --}}
<div style="margin-bottom:1.5rem; display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1rem;">
  <div>
    <h1 style="font-size:1.375rem;font-weight:800;color:#fff;margin:0 0 .25rem;letter-spacing:-.02em;">Pengaturan Situs</h1>
    <p style="font-size:.8125rem;color:var(--text3,#7A7A8A);margin:0;">Kelola konten, SEO, kontak & tampilan website</p>
  </div>
  <div style="display:flex;gap:.5rem;align-items:center;">
    <a href="{{ route('home') }}" target="_blank" style="display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1rem;font-size:.8rem;font-weight:600;background:transparent;border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.6);border-radius:4px;text-decoration:none;transition:all .2s;" onmouseover="this.style.borderColor='rgba(255,255,255,.4)';this.style.color='#fff'" onmouseout="this.style.borderColor='rgba(255,255,255,.15)';this.style.color='rgba(255,255,255,.6)'">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      Preview Website
    </a>
    <button type="submit" style="display:inline-flex;align-items:center;gap:.375rem;padding:.5rem 1.25rem;font-size:.875rem;font-weight:700;background:#FFD700;color:#000;border:none;border-radius:4px;cursor:pointer;transition:all .2s;font-family:'Montserrat',sans-serif;" onmouseover="this.style.background='#E6C200'" onmouseout="this.style.background='#FFD700'">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
      Simpan Semua
    </button>
  </div>
</div>

{{-- Tab Nav --}}
<div style="display:flex;gap:.125rem;margin-bottom:1.75rem;border-bottom:1px solid rgba(255,255,255,.07);flex-wrap:wrap;">
  @php
    $tabs = [
      'general' => ['Umum', 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
      'seo'     => ['SEO', 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
      'snippet' => ['Snippet & Tag', 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
      'hero'    => ['Hero & Konten', 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
      'contact' => ['Kontak', 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
      'social'  => ['Sosial Media', 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1'],
      'legal'   => ['Legalitas', 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
    ];
      'contact' => ['Kontak', 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
      'social'  => ['Sosial Media', 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1'],
      'legal'   => ['Legalitas', 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
    ];
  @endphp
  @foreach($tabs as $tabKey => [$tabLabel, $tabIcon])
  <button type="button" onclick="switchTab('{{ $tabKey }}')" id="tab-btn-{{ $tabKey }}"
          style="display:flex;align-items:center;gap:.375rem;padding:.625rem 1rem;font-size:.8rem;font-weight:600;border:none;background:transparent;cursor:pointer;color:rgba(255,255,255,.4);border-bottom:2px solid transparent;transition:all .2s;font-family:'Montserrat',sans-serif;margin-bottom:-1px;">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="{{ $tabIcon }}"/></svg>
    {{ $tabLabel }}
  </button>
  @endforeach
</div>

{{-- ======== TAB: UMUM ======== --}}
<div id="tab-general" class="tab-section">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;">
    {{-- Logo --}}
    <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Logo Perusahaan</div>
      </div>
      @if(!empty($settings['logo']))
      <div style="margin-bottom:1rem;padding:1rem;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:6px;display:flex;align-items:center;gap:1rem;">
        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logo" style="height:48px;object-fit:contain;">
        <span style="font-size:.75rem;color:rgba(255,255,255,.3);">Logo saat ini</span>
      </div>
      @endif
      <label style="font-size:.7rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text3);display:block;margin-bottom:.5rem;">Upload Logo Baru</label>
      <input type="file" name="logo" class="form-input" accept="image/*" style="padding:.5rem;">
      <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.5rem 0 0;">PNG/SVG transparan, min 400px lebar. Otomatis dikonversi ke WebP.</p>
    </div>
    {{-- Favicon --}}
    <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Favicon Browser</div>
      </div>
      @if(!empty($settings['favicon']))
      <div style="margin-bottom:1rem;padding:1rem;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:6px;display:flex;align-items:center;gap:1rem;">
        <img src="{{ asset('storage/'.$settings['favicon']) }}" alt="Favicon" style="width:32px;height:32px;object-fit:contain;">
        <span style="font-size:.75rem;color:rgba(255,255,255,.3);">Favicon saat ini</span>
      </div>
      @endif
      <label style="font-size:.7rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text3);display:block;margin-bottom:.5rem;">Upload Favicon (ICO/PNG)</label>
      <input type="file" name="favicon" class="form-input" accept=".ico,.png,.svg" style="padding:.5rem;">
      <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.5rem 0 0;">Rekomendasi: 32×32 atau 64×64 px format ICO/PNG.</p>
    </div>
  </div>

  <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
      <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Teks Umum</div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
      <div>
        <label class="form-label" for="s-footer_desc">Deskripsi Footer</label>
        <input type="text" name="footer_desc" id="s-footer_desc" class="form-input" value="{{ $settings['footer_desc'] ?? '' }}" placeholder="Spesialis Hoist, Crane System & Cargo Lift...">
        <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Tampil di footer website sebagai deskripsi singkat perusahaan.</p>
      </div>
      <div>
        <label class="form-label" for="s-copyright">Copyright Text</label>
        <input type="text" name="copyright" id="s-copyright" class="form-input" value="{{ $settings['copyright'] ?? '' }}" placeholder="© 2025 CV. Karya Perdana Teknik">
        <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Tampil di bagian bawah footer.</p>
      </div>
    </div>
  </div>
</div>

{{-- ======== TAB: SEO ======== --}}
<div id="tab-seo" class="tab-section" style="display:none;">
  <div style="display:flex;flex-direction:column;gap:1.25rem;">
    @foreach([
      ['key'=>'home','label'=>'Halaman Home','route'=>'/'],
      ['key'=>'about','label'=>'Halaman About','route'=>'/about'],
      ['key'=>'services','label'=>'Halaman Layanan','route'=>'/services'],
      ['key'=>'gallery','label'=>'Halaman Galeri','route'=>'/gallery'],
      ['key'=>'articles','label'=>'Halaman Artikel','route'=>'/articles'],
      ['key'=>'contact','label'=>'Halaman Kontak','route'=>'/contact'],
    ] as $page)
    <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
        <div style="display:flex;align-items:center;gap:.5rem;">
          <svg width="13" height="13" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">{{ $page['label'] }}</div>
        </div>
        <a href="{{ url($page['route']) }}" target="_blank" style="display:flex;align-items:center;gap:.25rem;font-size:.7rem;color:rgba(255,255,255,.3);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#FFD700'" onmouseout="this.style.color='rgba(255,255,255,.3)'">
          {{ $page['route'] }}
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>
      </div>
      <div style="display:grid;grid-template-columns:1fr;gap:.875rem;">
        <div>
          <label class="form-label">Meta Title <span style="color:rgba(255,255,255,.3);font-weight:400;">(max 65 karakter)</span></label>
          <input type="text" name="meta_title_{{ $page['key'] }}" class="form-input" maxlength="65"
                 value="{{ $settings['meta_title_'.$page['key']] ?? '' }}"
                 oninput="updateCounter(this,'cnt-title-{{ $page['key'] }}')"
                 placeholder="{{ $page['label'] }} | CV. Karya Perdana Teknik">
          <div style="font-size:.7rem;color:rgba(255,255,255,.3);margin-top:.25rem;">
            <span id="cnt-title-{{ $page['key'] }}">{{ strlen($settings['meta_title_'.$page['key']] ?? '') }}</span>/65 karakter
          </div>
        </div>
        <div>
          <label class="form-label">Meta Description <span style="color:rgba(255,255,255,.3);font-weight:400;">(max 160 karakter)</span></label>
          <textarea name="meta_desc_{{ $page['key'] }}" class="form-input" rows="3" maxlength="160"
                    oninput="updateCounter(this,'cnt-desc-{{ $page['key'] }}')"
                    placeholder="Deskripsi halaman untuk mesin pencari...">{{ $settings['meta_desc_'.$page['key']] ?? '' }}</textarea>
          <div style="font-size:.7rem;color:rgba(255,255,255,.3);margin-top:.25rem;">
            <span id="cnt-desc-{{ $page['key'] }}">{{ strlen($settings['meta_desc_'.$page['key']] ?? '') }}</span>/160 karakter
          </div>
        </div>
        <div>
          <label class="form-label">Meta Keywords <span style="color:rgba(255,255,255,.3);font-weight:400;">(pisahkan koma)</span></label>
          <input type="text" name="meta_keywords_{{ $page['key'] }}" class="form-input"
                 value="{{ $settings['meta_keywords_'.$page['key']] ?? '' }}"
                 placeholder="overhead crane, hoist, crane surabaya, ...">
        </div>
        @if($page['key'] === 'home')
        <div>
          <label class="form-label">Default OG Image <span style="color:rgba(255,255,255,.3);font-weight:400;">(1200×630px, untuk share media sosial)</span></label>
          @if(!empty($settings['og_image_default']))
          <div style="margin-bottom:.75rem;border-radius:6px;overflow:hidden;border:1px solid rgba(255,255,255,.07);">
            <img src="{{ asset('storage/'.$settings['og_image_default']) }}" style="height:100px;width:100%;object-fit:cover;" alt="OG Image">
          </div>
          @endif
          <input type="file" name="og_image_default" class="form-input" accept="image/*" style="padding:.5rem;">
        </div>
        @endif
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- ======== TAB: SNIPPET ======== --}}
<div id="tab-snippet" class="tab-section" style="display:none;">
  <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
      <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Custom Scripts / Tags</div>
    </div>
    <p style="font-size:.75rem;color:rgba(255,255,255,.3);margin-bottom:1.25rem;line-height:1.6;">Gunakan area ini untuk memasukkan kode pelacakan seperti Google Analytics, Meta Pixel, atau custom CSS/JS. Pastikan Anda memasukkan tag lengkap (contoh: <code>&lt;script&gt;...&lt;/script&gt;</code>).</p>
    
    <div style="display:flex;flex-direction:column;gap:1.5rem;">
      <div>
        <label class="form-label" for="s-head_scripts">Script di dalam <code>&lt;head&gt;</code></label>
        <textarea name="head_scripts" id="s-head_scripts" class="form-input" rows="8" placeholder="<!-- Google Tag Manager -->\n<script>...</script>" style="font-family:monospace; font-size:.8rem;">{{ $settings['head_scripts'] ?? '' }}</textarea>
        <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Cocok untuk meta tag verifikasi, Google Analytics (gtag), Meta Pixel base code, atau custom CSS.</p>
      </div>
      <div>
        <label class="form-label" for="s-body_scripts">Script di akhir <code>&lt;body&gt;</code></label>
        <textarea name="body_scripts" id="s-body_scripts" class="form-input" rows="8" placeholder="<!-- Live Chat Widget -->\n<script>...</script>" style="font-family:monospace; font-size:.8rem;">{{ $settings['body_scripts'] ?? '' }}</textarea>
        <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Cocok untuk widget live chat, event tracking pixel, atau custom Javascript yang membutuhkan DOM load selesai.</p>
      </div>
    </div>
  </div>
</div>

{{-- ======== TAB: HERO & KONTEN ======== --}}
<div id="tab-hero" class="tab-section" style="display:none;">
  <div style="display:flex;flex-direction:column;gap:1.25rem;">

    {{-- Hero Text --}}
    <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Teks Hero Section</div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        @foreach(['hero_headline'=>'Headline Utama (Judul Besar)','hero_subheadline'=>'Sub-headline (Kalimat Pendukung)','hero_cta_primary'=>'Teks Tombol Utama','hero_cta_secondary'=>'Teks Tombol Sekunder'] as $key=>$label)
        <div>
          <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
          <input type="text" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}">
        </div>
        @endforeach
      </div>
    </div>

    {{-- Images --}}
    <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Gambar Background</div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.25rem;">
        @foreach([
          'hero_bg_image' => 'Background Hero (1920×1080)',
          'breadcrumb_bg' => 'Header Sub-halaman (Layanan, Artikel, dll)',
          'about_image'   => 'Foto About / Profile',
        ] as $imgKey => $imgLabel)
        <div>
          <label class="form-label">{{ $imgLabel }}</label>
          @if(!empty($settings[$imgKey]))
          <div style="margin-bottom:.75rem;border-radius:6px;overflow:hidden;border:1px solid rgba(255,255,255,.07);">
            <img src="{{ asset('storage/'.$settings[$imgKey]) }}" style="height:90px;width:100%;object-fit:cover;" alt="{{ $imgLabel }}">
          </div>
          @endif
          <input type="file" name="{{ $imgKey }}" class="form-input" accept="image/*" style="padding:.5rem;">
        </div>
        @endforeach
      </div>
      <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.75rem 0 0;">Semua gambar akan otomatis dikompresi ke format WebP.</p>
    </div>

    {{-- About / Visi Misi --}}
    <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Visi & Misi</div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        @foreach(['visi'=>'Visi Perusahaan','misi'=>'Misi Perusahaan'] as $key=>$label)
        <div>
          <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
          <textarea name="{{ $key }}" id="s-{{ $key }}" class="form-input" rows="4">{{ $settings[$key] ?? '' }}</textarea>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Stats --}}
    <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Angka Statistik (Hero Section)</div>
      </div>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
        @foreach(['stat_years'=>'Tahun Pengalaman','stat_clients'=>'Jumlah Klien','stat_products'=>'Jenis Produk','stat_coverage'=>'Jangkauan/Kota'] as $key=>$label)
        <div>
          <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
          <input type="text" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}" placeholder="contoh: 10+">
        </div>
        @endforeach
      </div>
      <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.75rem 0 0;">Angka-angka ini muncul di bagian statistik halaman Home.</p>
    </div>

  </div>
</div>

{{-- ======== TAB: KONTAK ======== --}}
<div id="tab-contact" class="tab-section" style="display:none;">
  <div style="display:flex;flex-direction:column;gap:1.25rem;">
    <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
        <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Informasi Kontak</div>
      </div>
      <p style="font-size:.75rem;color:rgba(255,255,255,.3);margin-bottom:1.25rem;line-height:1.6;">Data di bawah ini akan tampil di <strong style="color:rgba(255,255,255,.6);">Footer</strong>, halaman <strong style="color:rgba(255,255,255,.6);">Kontak</strong>, dan <strong style="color:rgba(255,255,255,.6);">Navbar</strong> website.</p>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div>
          <label class="form-label" for="s-phone">Nomor Telepon Kantor</label>
          <input type="text" name="phone" id="s-phone" class="form-input" value="{{ $settings['phone'] ?? '' }}" placeholder="031-XXXXXXXX">
          <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Tampil di footer & halaman kontak</p>
        </div>
        <div>
          <label class="form-label" for="s-email">Email Perusahaan</label>
          <input type="email" name="email" id="s-email" class="form-input" value="{{ $settings['email'] ?? '' }}" placeholder="karyaperdanateknik@gmail.com">
          <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Tampil di footer & halaman kontak</p>
        </div>
        <div>
          <label class="form-label" for="s-wa1">WhatsApp 1 (Utama)</label>
          <input type="text" name="wa1" id="s-wa1" class="form-input" value="{{ $settings['wa1'] ?? '' }}" placeholder="628xxxxxxxxxx">
          <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Format internasional tanpa + (contoh: 6281234567890)</p>
        </div>
        <div>
          <label class="form-label" for="s-wa2">WhatsApp 2 (Backup)</label>
          <input type="text" name="wa2" id="s-wa2" class="form-input" value="{{ $settings['wa2'] ?? '' }}" placeholder="628xxxxxxxxxx">
          <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Opsional, digunakan jika WA 1 tidak tersedia</p>
        </div>
        <div style="grid-column:span 2;">
          <label class="form-label" for="s-address">Alamat Lengkap Perusahaan</label>
          <textarea name="address" id="s-address" class="form-input" rows="3" placeholder="Jl. ... No. ..., Kota, Provinsi">{{ $settings['address'] ?? '' }}</textarea>
          <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Tampil di footer & halaman kontak</p>
        </div>
        <div style="grid-column:span 2;">
          <label class="form-label" for="s-maps_embed">URL Google Maps Embed</label>
          <input type="text" name="maps_embed" id="s-maps_embed" class="form-input" value="{{ $settings['maps_embed'] ?? '' }}" placeholder="https://maps.google.com/maps?q=...&output=embed">
          <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.375rem 0 0;">Buka Google Maps → Share → Embed a map → salin URL dari atribut src iframe-nya</p>
        </div>
      </div>
    </div>

    <div style="background:rgba(255,215,0,.05);border:1px solid rgba(255,215,0,.15);border-radius:10px;padding:1.25rem;display:flex;align-items:flex-start;gap:.875rem;">
      <svg width="16" height="16" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:.1rem;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <div style="font-size:.8rem;color:rgba(255,255,255,.5);line-height:1.6;">
        <strong style="color:#FFD700;display:block;margin-bottom:.25rem;">Nomor WhatsApp Aktif (Tombol WA)</strong>
        Untuk mengubah nomor pada <strong style="color:rgba(255,255,255,.7);">tombol WhatsApp / floating button</strong>, kelola melalui menu
        <a href="{{ route('admin.wa.index') }}" style="color:#FFD700;text-decoration:none;">Pengaturan WhatsApp</a> di sidebar.
      </div>
    </div>
  </div>
</div>

{{-- ======== TAB: SOSIAL MEDIA ======== --}}
<div id="tab-social" class="tab-section" style="display:none;">
  <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
      <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Media Sosial</div>
    </div>
    <p style="font-size:.75rem;color:rgba(255,255,255,.3);margin-bottom:1.25rem;line-height:1.6;">URL yang diisi akan tampil sebagai ikon di <strong style="color:rgba(255,255,255,.6);">Footer</strong> website. Kosongkan jika tidak memiliki akun.</p>
    <div style="display:flex;flex-direction:column;gap:1rem;">
      <div style="display:flex;align-items:center;gap:.875rem;">
        <div style="width:36px;height:36px;background:rgba(255,255,255,.05);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <svg width="15" height="15" fill="none" stroke="#E1306C" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
        </div>
        <div style="flex:1;">
          <label class="form-label" for="s-instagram">Instagram URL</label>
          <input type="url" name="instagram" id="s-instagram" class="form-input" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/karyaperdanateknik">
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:.875rem;">
        <div style="width:36px;height:36px;background:rgba(255,255,255,.05);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <svg width="15" height="15" fill="#1877F2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
        </div>
        <div style="flex:1;">
          <label class="form-label" for="s-facebook">Facebook URL</label>
          <input type="url" name="facebook" id="s-facebook" class="form-input" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/karyaperdanateknik">
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:.875rem;">
        <div style="width:36px;height:36px;background:rgba(255,255,255,.05);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <svg width="15" height="15" fill="#FF0000" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#fff"/></svg>
        </div>
        <div style="flex:1;">
          <label class="form-label" for="s-youtube">YouTube URL</label>
          <input type="url" name="youtube" id="s-youtube" class="form-input" value="{{ $settings['youtube'] ?? '' }}" placeholder="https://youtube.com/@karyaperdanateknik">
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ======== TAB: LEGALITAS ======== --}}
<div id="tab-legal" class="tab-section" style="display:none;">
  <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.5rem;">
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem;">
      <svg width="14" height="14" fill="none" stroke="#FFD700" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#FFD700;">Legalitas Perusahaan</div>
    </div>
    <p style="font-size:.75rem;color:rgba(255,255,255,.3);margin-bottom:1.25rem;line-height:1.6;">Data legalitas akan tampil di <strong style="color:rgba(255,255,255,.6);">bagian bawah Footer</strong> website.</p>
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;">
      @foreach(['npwp'=>'NPWP','nib'=>'NIB (Nomor Induk Berusaha)','akte'=>'Akta Notaris'] as $key=>$label)
      <div>
        <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
        <input type="text" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}" placeholder="{{ $key === 'npwp' ? '00.000.000.0-000.000' : ($key === 'nib' ? '1234567890' : 'No. Akte...') }}">
      </div>
      @endforeach
    </div>
  </div>
</div>

</form>

<style>
.tab-btn-active { border-bottom-color:#FFD700 !important; color:#FFD700 !important; }
</style>
<script>
function switchTab(name) {
    document.querySelectorAll('.tab-section').forEach(s => s.style.display='none');
    document.querySelectorAll('[id^="tab-btn-"]').forEach(b => b.classList.remove('tab-btn-active'));
    document.getElementById('tab-'+name).style.display='block';
    document.getElementById('tab-btn-'+name).classList.add('tab-btn-active');
}
function updateCounter(el, cntId) {
    document.getElementById(cntId).textContent = el.value.length;
}
switchTab('general');
</script>
@endsection
