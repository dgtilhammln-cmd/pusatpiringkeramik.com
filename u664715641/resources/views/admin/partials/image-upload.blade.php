{{-- Shared Image Upload Partial --}}
{{-- Usage: @include('admin.partials.image-upload', ['item'=>$item??null,'field'=>'image','label'=>'Foto Utama','required'=>true]) --}}
@php
  $imgField = $field ?? 'image';
  $imgLabel = $label ?? 'Gambar';
  $imgRequired = $required ?? false;
  $imgItem = $item ?? null;
  $imgPreviewId = 'prev_'.Str::random(6);
  $currentSrc = $imgItem && $imgItem->{$imgField} ? asset('storage/'.$imgItem->{$imgField}) : null;
@endphp
<div class="admin-card">
  <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">{{ $imgLabel }}</h3>
  @if($currentSrc)
  <div style="margin-bottom:.75rem;border-radius:4px;overflow:hidden;">
    <img id="{{ $imgPreviewId }}" src="{{ $currentSrc }}" style="width:100%;aspect-ratio:16/9;object-fit:cover;">
  </div>
  @else
  <img id="{{ $imgPreviewId }}" style="display:none;width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:4px;margin-bottom:.75rem;">
  @endif
  <input type="file" name="{{ $imgField }}" accept="image/*" class="form-input"
         style="padding:.5rem;" {{ $imgRequired && !$imgItem ? 'required' : '' }}
         onchange="previewImg(this,'{{ $imgPreviewId }}')">
  <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.5rem 0 0;">
    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:3px;"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
    Auto convert ke WebP + kompres otomatis. Max 8MB. JPG, PNG, WebP didukung.
  </p>
</div>
<script>
function previewImg(input, id) {
  var img = document.getElementById(id);
  if(input.files && input.files[0]) {
    img.src = URL.createObjectURL(input.files[0]);
    img.style.display = 'block';
  }
}
</script>
