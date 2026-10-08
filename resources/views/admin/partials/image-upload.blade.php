{{-- Shared Image Upload Partial (Small Box Preview + X button) --}}
@php
  $imgField      = $field    ?? 'image';
  $imgLabel      = $label    ?? 'Gambar';
  $imgRequired   = $required ?? false;
  $imgItem       = $item     ?? null;
  $imgPreviewId  = 'prev_'.Str::random(6);
  $imgInputId    = 'inp_'.Str::random(6);
  $currentSrc    = ($imgItem && !empty($imgItem->{$imgField})) ? asset('storage/'.$imgItem->{$imgField}) : null;
@endphp

<div style="background:#fff;border-radius:20px;padding:1.5rem;box-shadow:0 2px 20px rgba(0,0,0,0.04);">
  {{-- Header --}}
  <div style="display:flex;align-items:center;gap:.625rem;margin-bottom:1.125rem;">
    <div style="width:32px;height:32px;background:rgba(59,130,246,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
      <svg width="16" height="16" fill="none" stroke="#3B82F6" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
    </div>
    <h3 style="font-size:.875rem;font-weight:800;color:#1E293B;margin:0;">{{ $imgLabel }}</h3>
  </div>

  <div id="wrap_{{ $imgPreviewId }}" style="display:flex;flex-direction:column;gap:1rem;">
    {{-- Dropzone / Upload Box --}}
    <div id="drop_{{ $imgPreviewId }}" onclick="document.getElementById('{{ $imgInputId }}').click()"
         style="display: {{ $currentSrc ? 'none' : 'flex' }};flex-direction:column;align-items:center;justify-content:center;gap:.625rem;padding:1.5rem;border:2px dashed #E4E7F0;border-radius:14px;cursor:pointer;background:#F8FAFC;transition:all .2s;text-align:center;"
         onmouseover="this.style.borderColor='#3B82F6';this.style.background='#F0F6FF'" onmouseout="this.style.borderColor='#E4E7F0';this.style.background='#F8FAFC'">
      <div style="width:42px;height:42px;background:#EFF6FF;border-radius:10px;display:flex;align-items:center;justify-content:center;">
        <svg width="20" height="20" fill="none" stroke="#3B82F6" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
      </div>
      <div>
        <div style="font-size:.85rem;font-weight:700;color:#1E293B;">Upload {{ $imgLabel }}</div>
        <div style="font-size:.73rem;color:#94A3B8;margin-top:.15rem;">JPG, PNG, WebP (Maks 5MB)</div>
      </div>
    </div>

    {{-- Small Box Preview (Kotak Kecil Preview + Tombol X) --}}
    <div id="box_{{ $imgPreviewId }}" style="display: {{ $currentSrc ? 'inline-block' : 'none' }};position:relative;width:110px;height:110px;">
      <div style="width:100%;height:100%;border-radius:12px;overflow:hidden;border:2px solid #E4E7F0;background:#F1F5F9;box-shadow:0 4px 12px rgba(0,0,0,0.06);position:relative;cursor:pointer;" onclick="document.getElementById('{{ $imgInputId }}').click()" title="Klik untuk mengganti foto">
        <img id="{{ $imgPreviewId }}" src="{{ $currentSrc ?? '' }}" style="width:100%;height:100%;object-fit:cover;display:block;">
        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.4);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.7rem;font-weight:700;opacity:0;transition:opacity .2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
          Ganti
        </div>
      </div>
      {{-- Tombol X Hapus --}}
      <button type="button" onclick="clearSingleImgPreview('{{ $imgInputId }}', '{{ $imgPreviewId }}')" title="Hapus foto"
              style="position:absolute;top:-8px;right:-8px;width:24px;height:24px;background:#EF4444;color:#fff;border:2px solid #fff;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(239,68,68,0.4);transition:transform .15s;"
              onmouseover="this.style.transform='scale(1.15)'" onmouseout="this.style.transform='scale(1)'">
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
  </div>

  {{-- Hidden input --}}
  <input type="file" id="{{ $imgInputId }}" name="{{ $imgField }}" accept="image/*"
         {{ $imgRequired && !$imgItem ? 'required' : '' }}
         onchange="previewSingleImgPremium(this,'{{ $imgPreviewId }}')"
         style="display:none;">

  {{-- Info --}}
  <div style="display:flex;align-items:center;gap:.375rem;margin-top:.75rem;font-size:.72rem;color:#94A3B8;">
    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
    Auto convert ke WebP + kompres otomatis.
  </div>
</div>

<script>
if (typeof clearSingleImgPreview !== 'function') {
  window.clearSingleImgPreview = function(inputId, previewId) {
    var input = document.getElementById(inputId);
    var box = document.getElementById('box_' + previewId);
    var drop = document.getElementById('drop_' + previewId);
    var img = document.getElementById(previewId);
    if (input) input.value = '';
    if (img) img.src = '';
    if (box) box.style.display = 'none';
    if (drop) drop.style.display = 'flex';
  };
}

if (typeof previewSingleImgPremium !== 'function') {
  window.previewSingleImgPremium = function(input, previewId) {
    if (!input.files || !input.files[0]) return;
    var img = document.getElementById(previewId);
    var box = document.getElementById('box_' + previewId);
    var drop = document.getElementById('drop_' + previewId);
    img.src = URL.createObjectURL(input.files[0]);
    if (box) box.style.display = 'inline-block';
    if (drop) drop.style.display = 'none';
  };
}
</script>
