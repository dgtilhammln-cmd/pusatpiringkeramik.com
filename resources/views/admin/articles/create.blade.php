@extends('layouts.admin')
@section('title', isset($article) ? 'Edit Artikel' : 'Tulis Artikel')
@section('page-title', isset($article) ? 'Edit Artikel' : 'Tulis Artikel Baru')
@section('content')
@php $a = $article ?? null; @endphp
<div style="max-width:1200px;">
<form method="POST" action="{{ $a ? route('admin.articles.update',$a) : route('admin.articles.store') }}" enctype="multipart/form-data" id="article-form">
@csrf @if($a) @method('PUT') @endif
<div style="display:grid;grid-template-columns:1fr 360px;gap:1.75rem;">

{{-- LEFT --}}
<div style="display:flex;flex-direction:column;gap:1.25rem;">

  {{-- Title + Slug --}}
  <div class="admin-card">
    <h3 style="font-size:0.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Konten Utama</h3>
    <div style="display:flex;flex-direction:column;gap:.875rem;">
      <div>
        <label class="form-label">Judul Artikel <span style="color:#FFD700;">*</span></label>
        <input type="text" name="title" id="art-title" value="{{ old('title',$a?->title) }}" class="form-input" required oninput="autoSlug()">
      </div>
      <div>
        <label class="form-label">Slug (URL)
          <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.75rem;margin-left:.5rem;">Kosongkan = auto dari judul. Huruf kecil, angka, strip.</span>
        </label>
        <div style="display:flex;align-items:center;gap:.5rem;">
          <span style="font-size:.8rem;color:rgba(255,255,255,.3);white-space:nowrap;">/articles/</span>
          <input type="text" name="slug" id="art-slug" value="{{ old('slug',$a?->slug) }}" class="form-input" pattern="[a-z0-9\-]*" placeholder="auto-dari-judul">
        </div>
      </div>
      <div>
        <label class="form-label">Excerpt / Ringkasan <span style="font-weight:400;color:rgba(255,255,255,.3);font-size:.75rem;">(max 160 karakter)</span></label>
        <textarea name="excerpt" class="form-input" rows="2" maxlength="500" oninput="document.getElementById('exc-cnt').textContent=this.value.length">{{ old('excerpt',$a?->excerpt) }}</textarea>
        <div style="font-size:.7rem;color:rgba(255,255,255,.3);margin-top:.25rem;"><span id="exc-cnt">{{ strlen(old('excerpt',$a?->excerpt??'')) }}</span>/500</div>
      </div>
    </div>
  </div>

  {{-- Editor --}}
  <div class="admin-card" style="padding:0;overflow:hidden;">
    <div style="padding:.875rem 1rem .5rem;border-bottom:1px solid rgba(255,255,255,.07);">
      <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0;">Konten <span style="color:#FFD700;">*</span></h3>
    </div>
    {{-- Toolbar --}}
    <div id="toolbar" style="display:flex;flex-wrap:wrap;gap:3px;padding:.625rem .875rem;background:rgba(255,255,255,.02);border-bottom:1px solid rgba(255,255,255,.06);">
      @foreach([['bold','B','font-weight:800'],['italic','I','font-style:italic'],['underline','U','text-decoration:underline']] as $b)
      <button type="button" onclick="fmt('{{$b[0]}}')" style="{{$b[2]}};padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.8rem;font-family:inherit;">{{$b[1]}}</button>
      @endforeach
      <span style="width:1px;background:rgba(255,255,255,.1);margin:0 .25rem;"></span>
      @foreach([['h2','H2'],['h3','H3'],['p','P']] as $b)
      <button type="button" onclick="fmtBlock('{{$b[0]}}')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#FFD700;border-radius:3px;cursor:pointer;font-size:.8rem;font-weight:700;">{{$b[1]}}</button>
      @endforeach
      <span style="width:1px;background:rgba(255,255,255,.1);margin:0 .25rem;"></span>
      <button type="button" onclick="fmt('insertUnorderedList')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.8rem;">UL</button>
      <button type="button" onclick="fmt('insertOrderedList')" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.8rem;">OL</button>
      <button type="button" onclick="insertLink()" style="padding:.25rem .625rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.8rem;">
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align:middle;"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
        Link
      </button>
      <button type="button" onclick="insertQuote()" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.8rem;">&ldquo; Quote</button>
      <button type="button" onclick="insertCode()" style="padding:.25rem .5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;border-radius:3px;cursor:pointer;font-size:.8rem;font-family:monospace;">&lt;/&gt;</button>
      <span style="width:1px;background:rgba(255,255,255,.1);margin:0 .25rem;"></span>
      <button type="button" id="html-btn" onclick="toggleHtml()" style="padding:.25rem .625rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:rgba(255,255,255,.4);border-radius:3px;cursor:pointer;font-size:.75rem;font-family:monospace;">HTML</button>
    </div>
    <div id="editor" contenteditable="true"
         style="min-height:420px;padding:1.25rem;color:#D4D4D8;font-size:.9375rem;line-height:1.9;outline:none;font-family:'Montserrat',sans-serif;"
         oninput="syncContent()">{!! old('content',$a?->content) !!}</div>
    <textarea id="html-editor" name="content" style="display:none;width:100%;min-height:420px;padding:1.25rem;color:#D4D4D8;font-size:.8rem;line-height:1.65;font-family:'Fira Code',monospace;background:transparent;border:none;outline:none;resize:vertical;">{{ old('content',$a?->content) }}</textarea>
  </div>

  {{-- FAQ --}}
  <div class="admin-card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
      <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0;">FAQ (Pertanyaan & Jawaban)</h3>
      <button type="button" onclick="addFaq()" style="display:flex;align-items:center;gap:.375rem;background:rgba(255,215,0,.1);border:1px solid rgba(255,215,0,.3);color:#FFD700;padding:.25rem .75rem;border-radius:3px;cursor:pointer;font-size:.8rem;font-family:inherit;">
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah FAQ
      </button>
    </div>
    <div id="faq-list" style="display:flex;flex-direction:column;gap:.875rem;">
      @if($a && $a->faqs)
        @foreach($a->faqs as $i => $faq)
        <div class="faq-item" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);padding:1rem;border-radius:4px;">
          <div style="display:flex;justify-content:flex-end;margin-bottom:.5rem;">
            <button type="button" onclick="this.closest('.faq-item').remove()" style="background:none;border:none;color:rgba(255,255,255,.3);cursor:pointer;font-size:.75rem;">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
          </div>
          <input type="text" name="faqs[{{ $i }}][q]" value="{{ $faq['q'] }}" class="form-input" placeholder="Pertanyaan..." style="margin-bottom:.5rem;">
          <textarea name="faqs[{{ $i }}][a]" class="form-input" rows="2" placeholder="Jawaban...">{{ $faq['a'] }}</textarea>
        </div>
        @endforeach
      @endif
    </div>
    <p style="font-size:.75rem;color:rgba(255,255,255,.25);margin:.75rem 0 0;">FAQ otomatis menghasilkan schema FAQPage untuk SEO Google.</p>
  </div>

  {{-- CTA Button --}}
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">CTA Button di Artikel</h3>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.875rem;margin-bottom:.875rem;">
      <div>
        <label class="form-label">Teks Tombol</label>
        <input type="text" name="cta_text" value="{{ old('cta_text', $a?->cta_button['text'] ?? '') }}" class="form-input" placeholder="cth: Konsultasi Gratis">
      </div>
      <div>
        <label class="form-label">Tipe</label>
        <select name="cta_type" class="form-select">
          <option value="wa" {{ (old('cta_type', $a?->cta_button['type'] ?? 'wa')) === 'wa' ? 'selected' : '' }}>WhatsApp (otomatis)</option>
          <option value="url" {{ (old('cta_type', $a?->cta_button['type'] ?? '')) === 'url' ? 'selected' : '' }}>URL Custom</option>
        </select>
      </div>
    </div>
    <div>
      <label class="form-label">URL (jika tipe URL Custom)</label>
      <input type="text" name="cta_url" value="{{ old('cta_url', $a?->cta_button['url'] ?? '') }}" class="form-input" placeholder="https://...">
    </div>
  </div>

  {{-- SEO --}}
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">SEO Settings</h3>
    <div style="display:flex;flex-direction:column;gap:.875rem;">
      <div>
        <label class="form-label">Meta Title <span style="font-weight:400;color:rgba(255,255,255,.3);">(max 70)</span></label>
        <input type="text" name="meta_title" value="{{ old('meta_title',$a?->getRawOriginal('meta_title')) }}" class="form-input" maxlength="70" oninput="document.getElementById('mt-cnt').textContent=this.value.length">
        <div style="font-size:.7rem;color:rgba(255,255,255,.3);margin-top:.25rem;"><span id="mt-cnt">{{ strlen(old('meta_title',$a?->getRawOriginal('meta_title')??'')) }}</span>/70</div>
      </div>
      <div>
        <label class="form-label">Meta Description <span style="font-weight:400;color:rgba(255,255,255,.3);">(max 160)</span></label>
        <textarea name="meta_desc" class="form-input" rows="2" maxlength="160" oninput="document.getElementById('md-cnt').textContent=this.value.length">{{ old('meta_desc',$a?->getRawOriginal('meta_desc')) }}</textarea>
        <div style="font-size:.7rem;color:rgba(255,255,255,.3);margin-top:.25rem;"><span id="md-cnt">{{ strlen(old('meta_desc',$a?->getRawOriginal('meta_desc')??'')) }}</span>/160</div>
      </div>
      <div>
        <label class="form-label">Meta Keywords <span style="font-weight:400;color:rgba(255,255,255,.3);">(pisah koma)</span></label>
        <input type="text" name="meta_keywords" value="{{ old('meta_keywords',$a?->meta_keywords) }}" class="form-input" placeholder="crane surabaya, overhead crane, hoist">
      </div>
    </div>
  </div>

</div>{{-- /LEFT --}}

{{-- RIGHT SIDEBAR --}}
<div style="display:flex;flex-direction:column;gap:1.25rem;">

  {{-- Publish --}}
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Publish</h3>
    <div style="display:flex;flex-direction:column;gap:.875rem;">
      <label style="display:flex;align-items:center;gap:.625rem;cursor:pointer;">
        <input type="hidden" name="is_published" value="0">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published',$a?->is_published) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#FFD700;">
        <span style="font-size:.875rem;color:#D4D4D8;">Publish Sekarang</span>
      </label>
      <div>
        <label class="form-label">Tanggal Publish</label>
        <input type="datetime-local" name="published_at" value="{{ old('published_at', $a?->published_at?->format('Y-m-d\TH:i')) }}" class="form-input">
      </div>
      <div>
        <label class="form-label">Penulis</label>
        <input type="text" name="author" value="{{ old('author',$a?->author ?? 'Tim Karya Perdana Teknik') }}" class="form-input">
      </div>
      <div>
        <label class="form-label">Kategori</label>
        <input type="text" name="category" value="{{ old('category',$a?->category) }}" class="form-input" placeholder="Tips & Panduan">
      </div>
      <div>
        <label class="form-label">Tags <span style="font-weight:400;color:rgba(255,255,255,.3);">(pisah koma)</span></label>
        <input type="text" name="tags" value="{{ old('tags', $a && $a->tags ? implode(', ',$a->tags) : '') }}" class="form-input" placeholder="crane, hoist, maintenance">
      </div>
    </div>
  </div>

  {{-- Featured Image --}}
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Gambar Utama</h3>
    @if($a?->image)
    <img src="{{ asset('storage/'.$a->image) }}" id="img-prev" style="width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:4px;margin-bottom:.75rem;">
    @else
    <img id="img-prev" style="display:none;width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:4px;margin-bottom:.75rem;">
    @endif
    <input type="file" name="image" accept="image/*" class="form-input" style="padding:.5rem;" onchange="previewImg(this,'img-prev')">
    <p style="font-size:.7rem;color:rgba(255,255,255,.25);margin:.5rem 0 0;">Auto WebP + auto OG jika tidak ada OG terpisah.</p>
  </div>

  {{-- OG Image --}}
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">OG Image (1200×630)</h3>
    @if($a?->og_image)
    <img src="{{ asset('storage/'.$a->og_image) }}" id="og-prev" style="width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:4px;margin-bottom:.75rem;">
    @else
    <img id="og-prev" style="display:none;width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:4px;margin-bottom:.75rem;">
    @endif
    <input type="file" name="og_image" accept="image/*" class="form-input" style="padding:.5rem;" onchange="previewImg(this,'og-prev')">
  </div>

  {{-- Options --}}
  <div class="admin-card">
    <h3 style="font-size:.75rem;font-weight:700;color:#FFD700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;">Opsi Lainnya</h3>
    <label style="display:flex;align-items:center;gap:.625rem;cursor:pointer;">
      <input type="hidden" name="show_toc" value="0">
      <input type="checkbox" name="show_toc" value="1" {{ old('show_toc',$a?->show_toc) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#FFD700;">
      <span style="font-size:.875rem;color:#D4D4D8;">Tampilkan Table of Contents</span>
    </label>
  </div>

  <button type="submit" class="btn-primary" style="width:100%;justify-content:center;padding:1rem;">
    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/></svg>
    {{ $a ? 'Update Artikel' : 'Simpan Artikel' }}
  </button>
  <a href="{{ route('admin.articles.index') }}" class="btn-outline" style="width:100%;justify-content:center;text-align:center;">Batal</a>
</div>

</div>
</form>
</div>

@push('scripts')
<script>
let htmlMode = false;
const editor = document.getElementById('editor');
const htmlEd = document.getElementById('html-editor');

function fmt(cmd) { document.execCommand(cmd,false,null); editor.focus(); }
function fmtBlock(tag) { document.execCommand('formatBlock',false,tag); editor.focus(); }
function syncContent() { htmlEd.value = editor.innerHTML; }

function insertLink() {
    const url  = prompt('URL (https://...):');
    if (!url) return;
    const text = prompt('Teks link:') || url;
    document.execCommand('insertHTML', false, `<a href="${url}" target="_blank" rel="noopener">${text}</a>`);
    editor.focus();
}
function insertQuote() {
    const sel = window.getSelection().toString() || 'Kutipan di sini...';
    document.execCommand('insertHTML', false, `<blockquote>${sel}</blockquote>`);
    editor.focus();
}
function insertCode() {
    const sel = window.getSelection().toString() || 'code';
    document.execCommand('insertHTML', false, `<code>${sel}</code>`);
    editor.focus();
}
function toggleHtml() {
    htmlMode = !htmlMode;
    const btn = document.getElementById('html-btn');
    if (htmlMode) {
        htmlEd.value = editor.innerHTML;
        htmlEd.style.display='block'; editor.style.display='none';
        btn.style.color='#FFD700'; btn.style.borderColor='rgba(255,215,0,.4)';
    } else {
        editor.innerHTML = htmlEd.value;
        editor.style.display='block'; htmlEd.style.display='none';
        btn.style.color='rgba(255,255,255,.4)'; btn.style.borderColor='rgba(255,255,255,.1)';
    }
}

document.getElementById('article-form').addEventListener('submit', function() {
    if (!htmlMode) htmlEd.value = editor.innerHTML;
    htmlEd.style.display = 'block';
});

// Auto slug from title
let slugManual = false;
document.getElementById('art-slug').addEventListener('input', () => slugManual = true);
function autoSlug() {
    if (slugManual) return;
    const t = document.getElementById('art-title').value;
    document.getElementById('art-slug').value = t.toLowerCase()
        .replace(/[^a-z0-9\s\-]/g,'').trim().replace(/\s+/g,'-');
}

// Image preview
function previewImg(input, previewId) {
    const img = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        img.src = URL.createObjectURL(input.files[0]);
        img.style.display = 'block';
    }
}

// FAQ
let faqCount = {{ $a && $a->faqs ? count($a->faqs) : 0 }};
function addFaq() {
    const idx = faqCount++;
    const div = document.createElement('div');
    div.className = 'faq-item';
    div.style.cssText = 'background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);padding:1rem;border-radius:4px;';
    div.innerHTML = `
      <div style="display:flex;justify-content:flex-end;margin-bottom:.5rem;">
        <button type="button" onclick="this.closest('.faq-item').remove()" style="background:none;border:none;color:rgba(255,255,255,.3);cursor:pointer;">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <input type="text" name="faqs[${idx}][q]" class="form-input" placeholder="Pertanyaan..." style="margin-bottom:.5rem;">
      <textarea name="faqs[${idx}][a]" class="form-input" rows="2" placeholder="Jawaban..."></textarea>`;
    document.getElementById('faq-list').appendChild(div);
}
</script>
@endpush
@endsection
