{{-- Shared SEO Fields Partial --}}
{{-- Usage: @include('admin.partials.seo-fields', ['item' => $item ?? null]) --}}
@php $s = $item ?? null; @endphp
<div class="admin-card">
  <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">SEO Settings</h3>
  <div style="display:flex;flex-direction:column;gap:.875rem;">
    <div>
      <label class="form-label">Meta Title <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.7rem;">(max 70 karakter)</span></label>
      <input type="text" name="meta_title" value="{{ old('meta_title', $s?->getRawOriginal('meta_title')) }}" class="form-input" maxlength="70"
             oninput="document.getElementById('seo-mt-cnt').textContent=this.value.length">
      <div style="font-size:.7rem;color:rgba(255,255,255,.3);margin-top:.2rem;"><span id="seo-mt-cnt">{{ strlen(old('meta_title', $s?->getRawOriginal('meta_title') ?? '')) }}</span>/70</div>
    </div>
    <div>
      <label class="form-label">Meta Description <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.7rem;">(max 160 karakter)</span></label>
      <textarea name="meta_desc" class="form-input" rows="2" maxlength="160"
                oninput="document.getElementById('seo-md-cnt').textContent=this.value.length">{{ old('meta_desc', $s?->getRawOriginal('meta_desc')) }}</textarea>
      <div style="font-size:.7rem;color:rgba(255,255,255,.3);margin-top:.2rem;"><span id="seo-md-cnt">{{ strlen(old('meta_desc', $s?->getRawOriginal('meta_desc') ?? '')) }}</span>/160</div>
    </div>
    <div>
      <label class="form-label">Meta Keywords <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.7rem;">(pisah koma)</span></label>
      <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $s?->meta_keywords) }}" class="form-input" placeholder="crane surabaya, overhead crane, lift industri">
    </div>
  </div>
</div>
