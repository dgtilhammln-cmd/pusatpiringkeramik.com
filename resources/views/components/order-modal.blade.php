{{-- Request Order Modal --}}
@php $services = \App\Models\Service::active()->ordered()->pluck('name')->toArray(); @endphp

{{-- Overlay --}}
<div id="order-modal-overlay" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-title" onclick="if(event.target===this)closeOrderModal()">
    <div class="modal-box">

        {{-- Header --}}
        <div style="padding:1.75rem 2rem 1.25rem;border-bottom:1px solid rgba(255,255,255,0.07);display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;">
            <div>
                <h2 id="modal-title" style="font-size:1.375rem;font-weight:800;color:#fff;margin:0 0 0.25rem;letter-spacing:-0.02em;">Request Order</h2>
                <p style="font-size:0.875rem;color:rgba(255,255,255,0.45);margin:0;">Isi form & kami hubungi via WhatsApp</p>
            </div>
            <button onclick="closeOrderModal()" style="background:rgba(255,255,255,0.06);border:none;color:rgba(255,255,255,0.5);width:32px;height:32px;border-radius:4px;cursor:pointer;font-size:1.125rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.12)';this.style.color='#fff'"
                    onmouseout="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.5)'"
                    aria-label="Tutup">✕</button>
        </div>

        {{-- Form --}}
        <form id="order-form" style="padding:1.75rem 2rem 2rem;display:flex;flex-direction:column;gap:1.125rem;">
            @csrf
            <input type="hidden" name="source" id="order-source" value="Website">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <label class="form-label" for="order-name">Nama Lengkap <span style="color:#FFD700;">*</span></label>
                    <input class="form-input" type="text" id="order-name" name="name" placeholder="Nama Anda" required autocomplete="name">
                </div>
                <div>
                    <label class="form-label" for="order-company">Perusahaan</label>
                    <input class="form-input" type="text" id="order-company" name="company" placeholder="Nama perusahaan" autocomplete="organization">
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div>
                    <label class="form-label" for="order-email">Email</label>
                    <input class="form-input" type="email" id="order-email" name="email" placeholder="email@perusahaan.com" autocomplete="email">
                </div>
                <div>
                    <label class="form-label" for="order-phone">Telepon / WA <span style="color:#FFD700;">*</span></label>
                    <input class="form-input" type="tel" id="order-phone" name="phone" placeholder="08xxxxxxxxxx" required autocomplete="tel">
                </div>
            </div>
            <div>
                <label class="form-label" for="order-product">Produk yang Diminati</label>
                <select class="form-select" id="order-product" name="product">
                    <option value="">— Pilih Produk / Layanan —</option>
                    @foreach($services as $svc)
                    <option value="{{ $svc }}">{{ $svc }}</option>
                    @endforeach
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div>
                <label class="form-label" for="order-message">Pesan / Kebutuhan</label>
                <textarea class="form-input" id="order-message" name="message" rows="4"
                          placeholder="Ceritakan kebutuhan Anda: kapasitas angkat, bentang, lokasi, dll."></textarea>
            </div>

            {{-- Error --}}
            <div id="order-error" style="display:none;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#f87171;font-size:0.875rem;padding:0.75rem 1rem;border-radius:4px;"></div>

            {{-- Submit --}}
            <button type="submit" id="order-submit" class="btn-primary" style="justify-content:center;width:100%;padding:1rem;font-size:1rem;gap:0.625rem;">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                Kirim & Lanjut ke WhatsApp
            </button>
            <p style="text-align:center;font-size:0.75rem;color:rgba(255,255,255,0.3);margin:0;">Data Anda aman. Kami tidak pernah menyebarkan informasi pribadi Anda.</p>
        </form>
    </div>
</div>

<script>
async function trackModalWaClick() {
    try {
        const token = document.querySelector('meta[name="csrf-token"]')?.content;
        await fetch('/track/wa_click', {
            method: 'POST',
            keepalive: true,
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
            body: JSON.stringify({ url: window.location.href })
        });
    } catch(e) {}
}

function openOrderModal(source = 'Website') {
    trackModalWaClick();
    const o = document.getElementById('order-modal-overlay');
    const sourceInput = document.getElementById('order-source');
    if (sourceInput) sourceInput.value = source;
    o.classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => document.getElementById('order-name')?.focus(), 300);
}
function closeOrderModal() {
    document.getElementById('order-modal-overlay').classList.remove('active');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeOrderModal(); });

// Form submit
document.getElementById('order-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('order-submit');
    const err = document.getElementById('order-error');
    err.style.display = 'none';
    btn.disabled = true;
    btn.textContent = 'Mengirim...';

    const data = new FormData(this);

    try {
        const res = await fetch('/request-order', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
            body: data,
        });
        const json = await res.json();

        if (json.success && json.wa_url) {
            closeOrderModal();
            this.reset();
            // Small delay so modal closes first
            setTimeout(() => { window.open(json.wa_url, '_blank', 'noopener,noreferrer'); }, 200);
        } else {
            throw new Error(json.message ?? 'Terjadi kesalahan.');
        }
    } catch (ex) {
        err.textContent = ex.message || 'Gagal mengirim. Coba lagi atau hubungi WA langsung.';
        err.style.display = 'block';
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg> Kirim & Lanjut ke WhatsApp';
    }
});
</script>
