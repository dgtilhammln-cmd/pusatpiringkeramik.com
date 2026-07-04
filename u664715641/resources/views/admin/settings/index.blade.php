@extends('layouts.admin')
@section('title','Pengaturan Situs')
@section('page-title','Pengaturan Situs')
@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" id="settings-form">
@csrf @method('POST')

{{-- Tab Nav --}}
<div style="display:flex;gap:0.25rem;margin-bottom:2rem;border-bottom:1px solid rgba(255,255,255,0.07);padding-bottom:0;flex-wrap:wrap;">
    @foreach(['general'=>'⚙️ Umum','seo'=>'🔍 SEO','hero'=>'🏠 Hero','contact'=>'📞 Kontak','social'=>'🔗 Sosial','legal'=>'📋 Legalitas'] as $tab=>$label)
    <button type="button" onclick="switchTab('{{ $tab }}')" id="tab-btn-{{ $tab }}"
            style="padding:0.625rem 1.125rem;font-size:0.875rem;font-weight:600;border:none;background:transparent;cursor:pointer;color:rgba(255,255,255,0.4);border-bottom:2px solid transparent;transition:all 0.2s;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:-1px;">
        {{ $label }}
    </button>
    @endforeach
</div>

{{-- ======== TAB: UMUM ======== --}}
<div id="tab-general" class="tab-section">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;">
        {{-- Logo --}}
        <div class="admin-card">
            <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;margin:0 0 1rem;text-transform:uppercase;letter-spacing:0.08em;">Logo Perusahaan</h3>
            @if(!empty($settings['logo']))
            <div style="margin-bottom:1rem;padding:1rem;background:rgba(255,255,255,0.04);border-radius:4px;display:flex;align-items:center;gap:1rem;">
                <img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logo" style="height:60px;object-fit:contain;">
                <span style="font-size:0.75rem;color:rgba(255,255,255,0.3);">Logo saat ini</span>
            </div>
            @endif
            <label class="form-label">Upload Logo Baru (WebP otomatis, max 2MB)</label>
            <input type="file" name="logo" class="form-input" accept="image/*" style="padding:0.5rem;">
            <p style="font-size:0.75rem;color:rgba(255,255,255,0.3);margin:0.5rem 0 0;">Rekomendasi: PNG/SVG transparent, min 400px lebar. Akan dikonversi ke WebP otomatis.</p>
        </div>
        {{-- Favicon --}}
        <div class="admin-card">
            <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;margin:0 0 1rem;text-transform:uppercase;letter-spacing:0.08em;">Favicon</h3>
            @if(!empty($settings['favicon']))
            <div style="margin-bottom:1rem;padding:1rem;background:rgba(255,255,255,0.04);border-radius:4px;display:flex;align-items:center;gap:1rem;">
                <img src="{{ asset('storage/'.$settings['favicon']) }}" alt="Favicon" style="width:32px;height:32px;object-fit:contain;">
                <span style="font-size:0.75rem;color:rgba(255,255,255,0.3);">Favicon saat ini</span>
            </div>
            @endif
            <label class="form-label">Upload Favicon (ICO/PNG, 32x32 atau 64x64)</label>
            <input type="file" name="favicon" class="form-input" accept=".ico,.png,.svg" style="padding:0.5rem;">
        </div>
    </div>
    <div class="admin-card">
        <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;margin:0 0 1.25rem;text-transform:uppercase;letter-spacing:0.08em;">Informasi Umum</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            @foreach(['footer_desc'=>'Deskripsi Footer','copyright'=>'Copyright Text'] as $key=>$label)
            <div>
                <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
                <input type="text" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}">
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ======== TAB: SEO ======== --}}
<div id="tab-seo" class="tab-section" style="display:none;">
    <div style="display:flex;flex-direction:column;gap:1.5rem;">
        @foreach([
            ['key'=>'home','label'=>'Halaman Home','route'=>'/'],
            ['key'=>'about','label'=>'Halaman About','route'=>'/about'],
            ['key'=>'services','label'=>'Halaman Layanan','route'=>'/services'],
            ['key'=>'gallery','label'=>'Halaman Galeri','route'=>'/gallery'],
            ['key'=>'articles','label'=>'Halaman Artikel','route'=>'/articles'],
            ['key'=>'contact','label'=>'Halaman Kontak','route'=>'/contact'],
        ] as $page)
        <div class="admin-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;margin:0;text-transform:uppercase;letter-spacing:0.08em;">{{ $page['label'] }}</h3>
                <a href="{{ url($page['route']) }}" target="_blank" style="font-size:0.75rem;color:rgba(255,255,255,0.35);text-decoration:none;">{{ $page['route'] }} ↗</a>
            </div>
            <div style="display:grid;grid-template-columns:1fr;gap:1rem;">
                <div>
                    <label class="form-label">Meta Title <span style="color:rgba(255,255,255,0.3);font-weight:400;">(max 65 karakter)</span></label>
                    <input type="text" name="meta_title_{{ $page['key'] }}" class="form-input" maxlength="65"
                           value="{{ $settings['meta_title_'.$page['key']] ?? '' }}"
                           oninput="updateCounter(this,'cnt-title-{{ $page['key'] }}')"
                           placeholder="{{ $page['label'] }} | CV. Karya Perdana Teknik">
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.3);margin-top:0.25rem;">
                        <span id="cnt-title-{{ $page['key'] }}">{{ strlen($settings['meta_title_'.$page['key']] ?? '') }}</span>/65
                    </div>
                </div>
                <div>
                    <label class="form-label">Meta Description <span style="color:rgba(255,255,255,0.3);font-weight:400;">(max 160 karakter)</span></label>
                    <textarea name="meta_desc_{{ $page['key'] }}" class="form-input" rows="3" maxlength="160"
                              oninput="updateCounter(this,'cnt-desc-{{ $page['key'] }}')"
                              placeholder="Deskripsi halaman untuk mesin pencari...">{{ $settings['meta_desc_'.$page['key']] ?? '' }}</textarea>
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.3);margin-top:0.25rem;">
                        <span id="cnt-desc-{{ $page['key'] }}">{{ strlen($settings['meta_desc_'.$page['key']] ?? '') }}</span>/160
                    </div>
                </div>
                <div>
                    <label class="form-label">Meta Keywords <span style="color:rgba(255,255,255,0.3);font-weight:400;">(pisahkan koma)</span></label>
                    <input type="text" name="meta_keywords_{{ $page['key'] }}" class="form-input"
                           value="{{ $settings['meta_keywords_'.$page['key']] ?? '' }}"
                           placeholder="overhead crane, hoist, crane surabaya, ...">
                </div>
                @if($page['key'] === 'home')
                <div>
                    <label class="form-label">Default OG Image (1200×630px)</label>
                    @if(!empty($settings['og_image_default']))
                    <div style="margin-bottom:0.75rem;"><img src="{{ asset('storage/'.$settings['og_image_default']) }}" style="height:80px;object-fit:cover;border-radius:4px;" alt="OG"></div>
                    @endif
                    <input type="file" name="og_image_default" class="form-input" accept="image/*" style="padding:0.5rem;">
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ======== TAB: HERO ======== --}}
<div id="tab-hero" class="tab-section" style="display:none;">
    <div class="admin-card">
        <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;margin:0 0 1.25rem;text-transform:uppercase;letter-spacing:0.08em;">Hero Section</h3>
        <div style="display:flex;flex-direction:column;gap:1rem;">
            @foreach(['hero_headline'=>'Headline Utama','hero_subheadline'=>'Sub-headline','hero_cta_primary'=>'Teks Tombol Utama','hero_cta_secondary'=>'Teks Tombol Sekunder'] as $key=>$label)
            <div>
                <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
                <input type="text" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}">
            </div>
            @endforeach
            <div>
                <label class="form-label">Background Image Hero</label>
                @if(!empty($settings['hero_bg_image']))
                <div style="margin-bottom:0.75rem;border-radius:4px;overflow:hidden;"><img src="{{ asset('storage/'.$settings['hero_bg_image']) }}" style="height:120px;width:100%;object-fit:cover;" alt="Hero BG"></div>
                @endif
                <input type="file" name="hero_bg_image" class="form-input" accept="image/*" style="padding:0.5rem;">
                <p style="font-size:0.75rem;color:rgba(255,255,255,0.3);margin:0.5rem 0 0;">Akan otomatis dikompresi ke WebP. Gunakan gambar landscape minimal 1920×1080px.</p>
            </div>
            <div>
                <label class="form-label">About Image</label>
                @if(!empty($settings['about_image']))
                <div style="margin-bottom:0.75rem;border-radius:4px;overflow:hidden;"><img src="{{ asset('storage/'.$settings['about_image']) }}" style="height:120px;width:100%;object-fit:cover;" alt="About"></div>
                @endif
                <input type="file" name="about_image" class="form-input" accept="image/*" style="padding:0.5rem;">
            </div>
            @foreach(['visi'=>'Visi Perusahaan','misi'=>'Misi Perusahaan'] as $key=>$label)
            <div>
                <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
                <textarea name="{{ $key }}" id="s-{{ $key }}" class="form-input" rows="3">{{ $settings[$key] ?? '' }}</textarea>
            </div>
            @endforeach
            @foreach(['stat_years'=>'Tahun Pengalaman','stat_clients'=>'Jumlah Klien','stat_products'=>'Jenis Produk','stat_coverage'=>'Jangkauan'] as $key=>$label)
            <div style="display:inline-block;width:calc(50% - 0.5rem);margin-right:0.5rem;vertical-align:top;">
                <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
                <input type="text" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}">
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ======== TAB: KONTAK ======== --}}
<div id="tab-contact" class="tab-section" style="display:none;">
    <div class="admin-card">
        <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;margin:0 0 1.25rem;text-transform:uppercase;letter-spacing:0.08em;">Informasi Kontak</h3>
        <div style="display:flex;flex-direction:column;gap:1rem;">
            @foreach(['phone'=>'Nomor Telepon','wa1'=>'WhatsApp 1 (Utama)','wa2'=>'WhatsApp 2 (Backup)','email'=>'Email'] as $key=>$label)
            <div>
                <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
                <input type="text" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}">
            </div>
            @endforeach
            <div>
                <label class="form-label" for="s-address">Alamat Lengkap</label>
                <textarea name="address" id="s-address" class="form-input" rows="3">{{ $settings['address'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="form-label" for="s-maps_embed">URL Google Maps Embed</label>
                <input type="text" name="maps_embed" id="s-maps_embed" class="form-input" value="{{ $settings['maps_embed'] ?? '' }}" placeholder="https://maps.google.com/maps?q=...&output=embed">
            </div>
        </div>
    </div>
</div>

{{-- ======== TAB: SOSIAL ======== --}}
<div id="tab-social" class="tab-section" style="display:none;">
    <div class="admin-card">
        <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;margin:0 0 1.25rem;text-transform:uppercase;letter-spacing:0.08em;">Media Sosial</h3>
        <div style="display:flex;flex-direction:column;gap:1rem;">
            @foreach(['instagram'=>'Instagram URL','facebook'=>'Facebook URL','youtube'=>'YouTube URL'] as $key=>$label)
            <div>
                <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
                <input type="url" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}" placeholder="https://...">
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ======== TAB: LEGALITAS ======== --}}
<div id="tab-legal" class="tab-section" style="display:none;">
    <div class="admin-card">
        <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;margin:0 0 1.25rem;text-transform:uppercase;letter-spacing:0.08em;">Legalitas Perusahaan</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            @foreach(['npwp'=>'NPWP','nib'=>'NIB','akte'=>'Akta Notaris'] as $key=>$label)
            <div>
                <label class="form-label" for="s-{{ $key }}">{{ $label }}</label>
                <input type="text" name="{{ $key }}" id="s-{{ $key }}" class="form-input" value="{{ $settings[$key] ?? '' }}">
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Save Button --}}
<div style="position:sticky;bottom:0;background:rgba(8,8,8,0.95);backdrop-filter:blur(12px);border-top:1px solid rgba(255,255,255,0.07);padding:1.25rem 0;margin-top:2rem;display:flex;justify-content:flex-end;gap:1rem;">
    <a href="{{ route('home') }}" target="_blank" class="btn-outline">Preview Website</a>
    <button type="submit" class="btn-primary" style="gap:0.5rem;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Semua Pengaturan
    </button>
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
// Init first tab
switchTab('general');
</script>
@endsection
