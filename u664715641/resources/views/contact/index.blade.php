@extends('layouts.app')
@section('content')

<div class="page-hero">
    <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">
        <nav class="breadcrumb" style="margin-bottom:1.5rem;">
            <a href="{{ route('home') }}">Home</a><span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">Contact</span>
        </nav>
        <div class="section-label" style="margin-bottom:0.75rem;">Hubungi Kami</div>
        <h1 class="section-title">Konsultasi Gratis<br>dengan Tim Ahli Kami</h1>
        <p class="section-desc" style="margin-top:1rem;max-width:500px;">Kami siap membantu menemukan solusi crane, hoist & lift terbaik untuk industri Anda.</p>
    </div>
</div>

<section style="padding:5rem 1.5rem;" data-aos="fade-up">
    <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:3fr 2fr;gap:5rem;align-items:start;">

        {{-- Contact Form --}}
        <div>
            <h2 style="font-size:1.375rem;font-weight:700;margin:0 0 2rem;">Kirim Pesan</h2>

            @if(session('success'))
            <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);padding:1.25rem;margin-bottom:1.5rem;border-radius:4px;">
                <p style="margin:0;color:#4ade80;font-size:0.9375rem;">{{ session('success') }}</p>
            </div>
            @endif

            <form method="POST" action="{{ route('contact.send') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                    <div>
                        <label class="form-label">Nama Lengkap <span style="color:#F5A623;">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Nama Anda" required>
                        @error('name')<p style="color:#f87171;font-size:0.8125rem;margin:0.25rem 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">Perusahaan</label>
                        <input type="text" name="company" value="{{ old('company') }}" class="form-input" placeholder="Nama perusahaan">
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                    <div>
                        <label class="form-label">Email <span style="color:#F5A623;">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="email@perusahaan.com" required>
                        @error('email')<p style="color:#f87171;font-size:0.8125rem;margin:0.25rem 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">Telepon <span style="color:#F5A623;">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="08xxxxxxxxxx" required>
                        @error('phone')<p style="color:#f87171;font-size:0.8125rem;margin:0.25rem 0 0;">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="form-label">Produk yang Diminati</label>
                    <select name="product" class="form-select">
                        <option value="">-- Pilih Produk --</option>
                        @foreach(['Overhead Crane Single Girder','Overhead Crane Double Girder','Chain Hoist','Wire Rope Hoist','Gantry Crane','Jib Crane','Cargo Lift / Lift Barang','Semi Passenger Lift','Dumb Waiter','Spare Parts','Maintenance & Service','Lainnya'] as $p)
                        <option value="{{ $p }}" {{ old('product')===$p?'selected':'' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Pesan <span style="color:#F5A623;">*</span></label>
                    <textarea name="message" class="form-input" rows="6" placeholder="Ceritakan kebutuhan Anda: kapasitas angkat, bentang, lokasi, dll." required style="resize:vertical;">{{ old('message') }}</textarea>
                    @error('message')<p style="color:#f87171;font-size:0.8125rem;margin:0.25rem 0 0;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <button type="submit" class="btn-primary" style="font-size:1rem;padding:0.875rem 2.5rem;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>

        {{-- Contact Info --}}
        <div>
            <h2 style="font-size:1.375rem;font-weight:700;margin:0 0 2rem;">Informasi Kontak</h2>
            <div style="display:flex;flex-direction:column;gap:1.25rem;">
                <div style="background:#18181B;border:1px solid #27272A;padding:1.5rem;display:flex;gap:1rem;">
                    <div style="width:44px;height:44px;background:rgba(245,166,35,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;border-radius:4px;">
                        <svg width="20" height="20" fill="none" stroke="#F5A623" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.9a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#F5A623;margin-bottom:0.375rem;">Telepon</div>
                        <a href="tel:+623199171407" data-track="phone" style="font-size:1rem;font-weight:600;color:#fff;text-decoration:none;">{{ $settings['phone'] ?? '031 - 99171407' }}</a>
                    </div>
                </div>
                @foreach($waList as $w)
                <div style="background:#18181B;border:1px solid #27272A;padding:1.5rem;display:flex;gap:1rem;">
                    <div style="width:44px;height:44px;background:rgba(37,211,102,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;border-radius:4px;">
                        <svg width="20" height="20" fill="#25D366" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#25D366;margin-bottom:0.375rem;">{{ $w->label }}</div>
                        <a href="{{ $w->wa_url }}" target="_blank" rel="noopener" data-track="wa" style="font-size:1rem;font-weight:600;color:#fff;text-decoration:none;">{{ $w->nomor_wa }}</a>
                    </div>
                </div>
                @endforeach
                <div style="background:#18181B;border:1px solid #27272A;padding:1.5rem;display:flex;gap:1rem;">
                    <div style="width:44px;height:44px;background:rgba(245,166,35,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;border-radius:4px;">
                        <svg width="20" height="20" fill="none" stroke="#F5A623" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                        <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#F5A623;margin-bottom:0.375rem;">Email</div>
                        <a href="mailto:{{ $settings['email']??'karyaperdanateknik@gmail.com' }}" data-track="email" style="font-size:0.9375rem;font-weight:600;color:#fff;text-decoration:none;">{{ $settings['email']??'karyaperdanateknik@gmail.com' }}</a>
                    </div>
                </div>
                <div style="background:#18181B;border:1px solid #27272A;padding:1.5rem;display:flex;gap:1rem;">
                    <div style="width:44px;height:44px;background:rgba(245,166,35,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;border-radius:4px;">
                        <svg width="20" height="20" fill="none" stroke="#F5A623" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#F5A623;margin-bottom:0.375rem;">Alamat</div>
                        <p style="font-size:0.9rem;color:#D4D4D8;margin:0;line-height:1.6;">{{ $settings['address']??'Pergudangan Legundi Business Park Blok D-11, Legundi - Gresik - Jawa Timur' }}</p>
                        <div style="font-size:0.8125rem;color:#A1A1AA;margin-top:0.375rem;">Senin - Sabtu: 08.00 - 17.00 WIB</div>
                    </div>
                </div>
            </div>

            {{-- Maps --}}
            <div style="margin-top:1.5rem;aspect-ratio:4/3;background:#18181B;border:1px solid #27272A;overflow:hidden;">
                <iframe src="{{ $settings['maps_embed']??'https://maps.google.com/maps?q=-7.1583,112.6515&output=embed' }}"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Lokasi CV. Karya Perdana Teknik"></iframe>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section style="padding:5rem 1.5rem;background:#0D0D0D;border-top:1px solid #27272A;" data-aos="fade-up">
    <div style="max-width:800px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:2.5rem;">
            <div class="section-label" style="margin-bottom:0.75rem;">FAQ</div>
            <h2 class="section-title">Pertanyaan yang Sering Ditanya</h2>
        </div>
        @foreach($faq as $i => $f)
        <div style="border:1px solid #27272A;margin-bottom:0.625rem;background:#18181B;">
            <button onclick="toggleFaq({{ $i }})" style="width:100%;text-align:left;padding:1.25rem 1.5rem;background:none;border:none;color:#fff;font-size:0.9375rem;font-weight:600;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:1rem;">
                <span>{{ $f['q'] }}</span>
                <svg id="fi-{{ $i }}" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;transition:transform 0.2s;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </button>
            <div id="faq-{{ $i }}" style="display:none;padding:0 1.5rem 1.25rem;color:#A1A1AA;font-size:0.9375rem;line-height:1.75;">{{ $f['a'] }}</div>
        </div>
        @endforeach
    </div>
</section>

<script>
function toggleFaq(i) {
    const el=document.getElementById('faq-'+i),icon=document.getElementById('fi-'+i),open=el.style.display==='block';
    el.style.display=open?'none':'block'; icon.style.transform=open?'':'rotate(45deg)';
}
</script>
<style>
@media(max-width:900px){ section [style*="grid-template-columns:3fr 2fr"]{grid-template-columns:1fr!important;} }
@media(max-width:600px){ section [style*="grid-template-columns:1fr 1fr"]{grid-template-columns:1fr!important;} }
</style>
@endsection
