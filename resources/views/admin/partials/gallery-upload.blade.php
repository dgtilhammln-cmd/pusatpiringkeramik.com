{{-- Shared Gallery Upload Partial (Kotak Kecil Preview + X button) --}}
@php
  $galItem = $item ?? null;
  $existingGallery = ($galItem && is_array($galItem->gallery)) ? $galItem->gallery : [];
@endphp

<div style="background:#fff;border-radius:20px;padding:1.5rem;box-shadow:0 2px 20px rgba(0,0,0,0.04);">
  <div style="display:flex;align-items:center;gap:.625rem;margin-bottom:1.25rem;">
    <div style="width:32px;height:32px;background:rgba(139,92,246,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;">
      <svg width="16" height="16" fill="none" stroke="#8B5CF6" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
    </div>
    <h3 style="font-size:.875rem;font-weight:800;color:#1E293B;margin:0;">Foto Galeri Produk</h3>
  </div>

  {{-- Container Hidden Delete Inputs --}}
  <div id="delete-gallery-inputs"></div>

  {{-- Grid Gallery Thumbnails --}}
  <div style="display:flex;flex-wrap:wrap;gap:.75rem;align-items:center;margin-bottom:1rem;" id="gallery-grid-container">
    
    {{-- Existing Gallery Images --}}
    @foreach($existingGallery as $index => $g)
    <div class="existing-gal-item" id="exist_gal_{{ $index }}" style="position:relative;width:95px;height:95px;border-radius:12px;overflow:hidden;border:2px solid #E4E7F0;box-shadow:0 2px 8px rgba(0,0,0,0.05);flex-shrink:0;">
      <img src="{{ asset('storage/'.$g) }}" style="width:100%;height:100%;object-fit:cover;display:block;">
      <button type="button" onclick="removeExistingGallery('{{ $index }}', '{{ $g }}')" title="Hapus foto ini"
              style="position:absolute;top:4px;right:4px;width:22px;height:22px;background:#EF4444;color:#fff;border:1.5px solid #fff;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 5px rgba(239,68,68,0.4);transition:transform .15s;"
              onmouseover="this.style.transform='scale(1.15)'" onmouseout="this.style.transform='scale(1)'">
        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    @endforeach

    {{-- New Selected Gallery Images Container --}}
    <div id="new-gallery-previews" style="display:contents;"></div>

    {{-- Upload Square Button --}}
    <label style="width:95px;height:95px;border:2px dashed #CBD5E1;border-radius:12px;cursor:pointer;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.375rem;background:#F8FAFC;transition:all .2s;flex-shrink:0;text-align:center;padding:.25rem;"
           onmouseover="this.style.borderColor='#8B5CF6';this.style.background='#FAFAFF'" onmouseout="this.style.borderColor='#CBD5E1';this.style.background='#F8FAFC'">
      <div style="width:30px;height:30px;background:#F1F5F9;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#8B5CF6;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      </div>
      <span style="font-size:.7rem;font-weight:700;color:#64748B;">+ Galeri</span>
      <input type="file" id="gallery_images_input" name="gallery_images[]" multiple accept="image/*" style="display:none;" onchange="handleGalleryFilesChange(this)">
    </label>
  </div>

  <div style="font-size:.72rem;color:#94A3B8;display:flex;align-items:center;gap:.375rem;">
    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
    Pilih foto galeri (bisa pilih banyak sekaligus). Klik tombol <strong>X</strong> pada kotak foto untuk menghapus.
  </div>
</div>

<script>
if (typeof selectedGalleryFiles === 'undefined') {
  var selectedGalleryFiles = [];
} else {
  selectedGalleryFiles = [];
}

function compressImageClientSide(file, maxDim, quality, callback) {
  if (!file || !file.type.startsWith('image/') || file.type.includes('svg') || file.size < 400 * 1024) {
    callback(file);
    return;
  }
  var reader = new FileReader();
  reader.onload = function(e) {
    var img = new Image();
    img.onload = function() {
      var w = img.width;
      var h = img.height;
      if (w > maxDim || h > maxDim) {
        if (w > h) {
          h = Math.round((h * maxDim) / w);
          w = maxDim;
        } else {
          w = Math.round((w * maxDim) / h);
          h = maxDim;
        }
      }
      var canvas = document.createElement('canvas');
      canvas.width = w;
      canvas.height = h;
      var ctx = canvas.getContext('2d');
      ctx.drawImage(img, 0, 0, w, h);
      canvas.toBlob(function(blob) {
        if (blob) {
          var compressed = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".jpg", {
            type: 'image/jpeg',
            lastModified: Date.now()
          });
          callback(compressed);
        } else {
          callback(file);
        }
      }, 'image/jpeg', quality);
    };
    img.onerror = function() { callback(file); };
    img.src = e.target.result;
  };
  reader.onerror = function() { callback(file); };
  reader.readAsDataURL(file);
}

function handleGalleryFilesChange(input) {
  if (!input.files || input.files.length === 0) return;
  
  var filesArray = Array.from(input.files);
  var processedCount = 0;
  
  filesArray.forEach(function(file) {
    compressImageClientSide(file, 1600, 0.82, function(finalFile) {
      selectedGalleryFiles.push(finalFile);
      processedCount++;
      if (processedCount === filesArray.length) {
        syncGalleryInput();
        renderNewGalleryPreviews();
      }
    });
  });
}

function syncGalleryInput() {
  const input = document.getElementById('gallery_images_input');
  if (!input) return;
  const dt = new DataTransfer();
  selectedGalleryFiles.forEach(file => dt.items.add(file));
  input.files = dt.files;
}

function renderNewGalleryPreviews() {
  const container = document.getElementById('new-gallery-previews');
  if (!container) return;
  container.innerHTML = '';

  selectedGalleryFiles.forEach((file, index) => {
    const url = URL.createObjectURL(file);
    const box = document.createElement('div');
    box.style.cssText = 'position:relative;width:95px;height:95px;border-radius:12px;overflow:hidden;border:2px solid #8B5CF6;box-shadow:0 2px 8px rgba(139,92,246,0.15);flex-shrink:0;';
    box.innerHTML = `
      <img src="${url}" style="width:100%;height:100%;object-fit:cover;display:block;">
      <button type="button" onclick="removeNewGalleryFile(${index})" title="Batal upload foto ini"
              style="position:absolute;top:4px;right:4px;width:22px;height:22px;background:#EF4444;color:#fff;border:1.5px solid #fff;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 5px rgba(239,68,68,0.4);transition:transform .15s;"
              onmouseover="this.style.transform='scale(1.15)'" onmouseout="this.style.transform='scale(1)'">
        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    `;
    container.appendChild(box);
  });
}

function removeNewGalleryFile(index) {
  selectedGalleryFiles.splice(index, 1);
  syncGalleryInput();
  renderNewGalleryPreviews();
}

function removeExistingGallery(index, path) {
  const elem = document.getElementById('exist_gal_' + index);
  if (elem) elem.remove();

  const deleteContainer = document.getElementById('delete-gallery-inputs');
  if (deleteContainer) {
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'delete_gallery[]';
    hiddenInput.value = path;
    deleteContainer.appendChild(hiddenInput);
  }
}
</script>
