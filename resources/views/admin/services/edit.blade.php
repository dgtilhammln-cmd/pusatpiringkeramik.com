@extends('layouts.admin')
@section('title', isset($service) ? 'Edit Layanan' : 'Tambah Layanan')
@section('page-title', isset($service) ? 'Edit Layanan' : 'Tambah Layanan Baru')
@section('content')
@php $s = $service ?? null; @endphp
<div style="max-width:1100px;">
<form method="POST" action="{{ $s ? route('admin.services.update',$s) : route('admin.services.store') }}" enctype="multipart/form-data" id="svc-form">
@csrf @if($s) @method('PUT') @endif
<div style="display:grid;grid-template-columns:1fr 340px;gap:1.75rem;">

{{-- LEFT --}}
<div style="display:flex;flex-direction:column;gap:1.25rem;">
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Informasi Layanan</h3>
    <div style="display:flex;flex-direction:column;gap:.875rem;">
      <div>
        <label class="form-label">Nama Layanan <span style="color:#FFD700;">*</span></label>
        <input type="text" name="name" id="svc-name" value="{{ old('name',$s?->name) }}" class="form-input" required oninput="svcAutoSlug()">
      </div>
      <div>
        <label class="form-label">Slug (URL)
          <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.7rem;">Kosongkan = auto dari nama</span>
        </label>
        <div style="display:flex;align-items:center;gap:.5rem;">
          <span style="font-size:.8rem;color:rgba(255,255,255,.3);white-space:nowrap;">/services/</span>
          <input type="text" name="slug" id="svc-slug" value="{{ old('slug',$s?->slug) }}" class="form-input" pattern="[a-z0-9\-]*">
        </div>
      </div>
      <div>
        <label class="form-label">Deskripsi Singkat <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.7rem;">(tampil di listing, max 500)</span></label>
        <textarea name="short_desc" class="form-input" rows="2" maxlength="500">{{ old('short_desc',$s?->short_desc) }}</textarea>
      </div>
    </div>
  </div>

  {{-- Rich Editor --}}
  <div class="admin-card" style="padding:0;overflow:hidden;">
    <div style="padding:.875rem 1rem;border-bottom:1px solid rgba(255,255,255,.07);">
      <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0;">Deskripsi Lengkap</h3>
    </div>
    <div style="padding:.875rem 1rem 1rem;">
      @include('admin.partials.rich-editor', ['name'=>'description','value'=>old('description',$s?->description??''),'height'=>'320px'])
    </div>
  </div>

  @include('admin.partials.seo-fields', ['item'=>$s])
</div>

{{-- RIGHT --}}
<div style="display:flex;flex-direction:column;gap:1.25rem;">
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Status & Urutan</h3>
    <div style="display:flex;flex-direction:column;gap:.75rem;">
      <label style="display:flex;align-items:center;gap:.625rem;cursor:pointer;">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active',$s?->is_active??true)?'checked':'' }} style="width:16px;height:16px;accent-color:#FFD700;">
        <span style="font-size:.875rem;color:#D4D4D8;">Aktif (tampil di website)</span>
      </label>
      <div><label class="form-label">Urutan</label><input type="number" name="order" value="{{ old('order',$s?->order??0) }}" class="form-input" min="0"></div>
      <div>
        <label class="form-label">Icon (opsional)</label>
        <input type="text" name="icon" value="{{ old('icon',$s?->icon) }}" class="form-input" placeholder="crane, hoist, lift, maintenance">
        <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.4rem 0 0;">Nama ikon atau SVG path identifier</p>
      </div>
    </div>
  </div>

  @include('admin.partials.image-upload', ['item'=>$s,'field'=>'image','label'=>'Foto Layanan'])
  @include('admin.partials.image-upload', ['item'=>$s,'field'=>'og_image','label'=>'OG Image (auto dari foto)'])

  <button type="submit" class="btn-primary" style="width:100%;justify-content:center;padding:1rem;">
    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
    {{ $s ? 'Update Layanan' : 'Simpan Layanan' }}
  </button>
  <a href="{{ route('admin.services.index') }}" class="btn-outline" style="width:100%;justify-content:center;text-align:center;">Batal</a>
</div>
</div>
</form>
</div>
<script>
var svcSlugManual = {{ $s ? 'true' : 'false' }};
document.getElementById('svc-slug').addEventListener('input',()=>svcSlugManual=true);
function svcAutoSlug() {
  if(svcSlugManual) return;
  document.getElementById('svc-slug').value = document.getElementById('svc-name').value.toLowerCase().replace(/[^a-z0-9\s\-]/g,'').trim().replace(/\s+/g,'-');
}
document.getElementById('svc-form').addEventListener('submit',function(){
  document.querySelectorAll('textarea[style*="display:none"]').forEach(t=>t.style.display='block');
});
</script>
@endsection
