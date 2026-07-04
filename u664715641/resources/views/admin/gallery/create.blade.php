@extends('layouts.admin')
@section('title', isset($gallery) ? 'Edit Foto Proyek' : 'Tambah Foto Proyek')
@section('page-title', isset($gallery) ? 'Edit Foto Proyek' : 'Tambah Foto Proyek')
@section('content')
@php $g = $gallery ?? null; @endphp
<div style="max-width:1100px;">
<form method="POST" action="{{ $g ? route('admin.gallery.update',$g) : route('admin.gallery.store') }}" enctype="multipart/form-data" id="gal-form">
@csrf @if($g) @method('PUT') @endif
<div style="display:grid;grid-template-columns:1fr 340px;gap:1.75rem;">

{{-- LEFT --}}
<div style="display:flex;flex-direction:column;gap:1.25rem;">

  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Info Proyek</h3>
    <div style="display:flex;flex-direction:column;gap:.875rem;">
      <div>
        <label class="form-label">Judul Proyek <span style="color:#FFD700;">*</span></label>
        <input type="text" name="title" id="gal-title" value="{{ old('title',$g?->title) }}" class="form-input" required oninput="galAutoSlug()">
      </div>
      <div>
        <label class="form-label">Slug (URL)
          <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.7rem;">Kosongkan = auto dari judul</span>
        </label>
        <div style="display:flex;align-items:center;gap:.5rem;">
          <span style="font-size:.8rem;color:rgba(255,255,255,.3);white-space:nowrap;">/gallery/</span>
          <input type="text" name="slug" id="gal-slug" value="{{ old('slug',$g?->slug) }}" class="form-input" pattern="[a-z0-9\-]*">
        </div>
      </div>
      <div>
        <label class="form-label">Deskripsi Singkat</label>
        <textarea name="description" class="form-input" rows="2" placeholder="Ringkasan singkat proyek...">{{ old('description',$g?->description) }}</textarea>
      </div>
    </div>
  </div>

  {{-- Rich Editor --}}
  <div class="admin-card" style="padding:0;overflow:hidden;">
    <div style="padding:.875rem 1rem;border-bottom:1px solid rgba(255,255,255,.07);">
      <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0;">Detail Konten Proyek</h3>
    </div>
    <div style="padding:.875rem 1rem 1rem;">
      @include('admin.partials.rich-editor', ['name'=>'content','value'=>old('content',$g?->content??''),'height'=>'280px'])
    </div>
  </div>

  {{-- Project Details --}}
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Detail Proyek</h3>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;">
      <div>
        <label class="form-label">Klien / Perusahaan</label>
        <input type="text" name="client" value="{{ old('client',$g?->client) }}" class="form-input" placeholder="PT. Contoh Industri">
      </div>
      <div>
        <label class="form-label">Lokasi</label>
        <input type="text" name="location" value="{{ old('location',$g?->location) }}" class="form-input" placeholder="Surabaya, Jawa Timur">
      </div>
      <div>
        <label class="form-label">Tahun</label>
        <input type="number" name="year" value="{{ old('year',$g?->year ?? date('Y')) }}" class="form-input" min="2000" max="2099">
      </div>
      <div>
        <label class="form-label">Kategori</label>
        <select name="category" class="form-select">
          <option value="">-- Pilih Kategori --</option>
          @foreach(['Overhead Crane','Gantry Crane','Jib Crane','Chain Hoist','Wire Rope Hoist','Cargo Lift','Maintenance','Fabrikasi'] as $cat)
          <option value="{{ $cat }}" {{ old('category',$g?->category)===$cat?'selected':'' }}>{{ $cat }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="form-label">Alt Text (SEO)</label>
        <input type="text" name="alt_text" value="{{ old('alt_text',$g?->alt_text) }}" class="form-input" placeholder="Pemasangan overhead crane 10 ton...">
      </div>
      <div>
        <label class="form-label">Tags <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.7rem;">(pisah koma)</span></label>
        <input type="text" name="tags" value="{{ old('tags',$g?->tags) }}" class="form-input" placeholder="overhead crane, 10 ton, surabaya">
      </div>
    </div>
  </div>

  @include('admin.partials.seo-fields', ['item'=>$g])
</div>

{{-- RIGHT --}}
<div style="display:flex;flex-direction:column;gap:1.25rem;">

  {{-- Status --}}
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Status & Urutan</h3>
    <div style="display:flex;flex-direction:column;gap:.75rem;">
      <label style="display:flex;align-items:center;gap:.625rem;cursor:pointer;">
        <input type="hidden" name="is_published" value="0">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published',$g?->is_published??true)?'checked':'' }} style="width:16px;height:16px;accent-color:#FFD700;">
        <span style="font-size:.875rem;color:#D4D4D8;">Published (tampil di galeri)</span>
      </label>
      <label style="display:flex;align-items:center;gap:.625rem;cursor:pointer;">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active',$g?->is_active??true)?'checked':'' }} style="width:16px;height:16px;accent-color:#FFD700;">
        <span style="font-size:.875rem;color:#D4D4D8;">Aktif</span>
      </label>
      <label style="display:flex;align-items:center;gap:.625rem;cursor:pointer;">
        <input type="hidden" name="is_featured" value="0">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$g?->is_featured??false)?'checked':'' }} style="width:16px;height:16px;accent-color:#FFD700;">
        <span style="font-size:.875rem;color:#D4D4D8;">Featured (tampil di homepage)</span>
      </label>
      <div>
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="order" value="{{ old('order',$g?->order??0) }}" class="form-input" min="0">
      </div>
    </div>
  </div>

  @include('admin.partials.image-upload', ['item'=>$g,'field'=>'image','label'=>'Foto Proyek (wajib)','required'=>true])
  @include('admin.partials.image-upload', ['item'=>$g,'field'=>'og_image','label'=>'OG Image (opsional, auto dari foto)'])

  <button type="submit" class="btn-primary" style="width:100%;justify-content:center;padding:1rem;">
    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
    {{ $g ? 'Update Proyek' : 'Simpan Proyek' }}
  </button>
  <a href="{{ route('admin.gallery.index') }}" class="btn-outline" style="width:100%;justify-content:center;text-align:center;">Batal</a>
</div>
</div>
</form>
</div>
<script>
var galSlugManual = {{ $g ? 'true' : 'false' }};
document.getElementById('gal-slug').addEventListener('input',()=>galSlugManual=true);
function galAutoSlug() {
  if(galSlugManual) return;
  document.getElementById('gal-slug').value = document.getElementById('gal-title').value.toLowerCase().replace(/[^a-z0-9\s\-]/g,'').trim().replace(/\s+/g,'-');
}
document.getElementById('gal-form').addEventListener('submit',function(){
  document.querySelectorAll('textarea[style*="display:none"]').forEach(t=>t.style.display='block');
});
</script>
@endsection
