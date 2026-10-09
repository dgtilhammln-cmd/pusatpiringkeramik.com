@extends('layouts.admin')
@section('title','Pengaturan WhatsApp & Mode Lead')
@section('page-title','Pengaturan WhatsApp & Mode Lead')
@section('content')
<div style="max-width:960px;display:flex;flex-direction:column;gap:1.75rem;font-family:'Montserrat',sans-serif;">

    {{-- CARD 1: Mode Penangkapan Leads --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:14px;padding:1.75rem;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:1.25rem;padding-bottom:1rem;border-bottom:1px solid #F1F5F9;">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;color:#3B82F6;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <h3 style="font-size:1rem;font-weight:800;color:#0F172A;margin:0;">Mode Penangkapan Leads & Direct WA</h3>
                <div style="font-size:0.75rem;color:#64748B;">Pilih mekanisme aksi saat pengunjung mengklik tombol WhatsApp atau Konsultasi di seluruh website</div>
            </div>
        </div>

        @php
            $activeMode = $settings['lead_mode'] ?? 'popup';
            $defaultTpl = "Halo UD. Sukses Makmur, saya tertarik dengan produk piring & tableware keramik. (Kode Referensi: {code}, Halaman: {page})";
            $tplText    = $settings['wa_template_text'] ?? $defaultTpl;
        @endphp

        <form method="POST" action="{{ route('admin.wa.update') }}">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.5rem;">
                {{-- Mode 1: Popup Form --}}
                <label style="border:2px solid {{ $activeMode === 'popup' ? '#0F172A' : '#E2E8F0' }};padding:1.25rem;border-radius:12px;background:{{ $activeMode === 'popup' ? '#F8FAFC' : '#FFFFFF' }};cursor:pointer;display:flex;flex-direction:column;gap:0.5rem;transition:all 0.2s;">
                    <div style="display:flex;align-items:center;gap:0.5rem;">
                        <input type="radio" name="lead_mode" value="popup" {{ $activeMode === 'popup' ? 'checked' : '' }} style="accent-color:#0F172A;width:16px;height:16px;">
                        <strong style="color:#0F172A;font-size:0.9375rem;font-weight:800;">1. Mode Form Popup</strong>
                    </div>
                    <span style="font-size:0.8rem;color:#64748B;line-height:1.45;">
                        Pengunjung mengisi Form Popup (Nama, No. Telepon, Perusahaan, Kebutuhan) sebelum diarahkan ke WA.
                    </span>
                </label>

                {{-- Mode 2: Kode Referensi WA --}}
                <label style="border:2px solid {{ $activeMode === 'wa_code' ? '#10B981' : '#E2E8F0' }};padding:1.25rem;border-radius:12px;background:{{ $activeMode === 'wa_code' ? '#F0FDF4' : '#FFFFFF' }};cursor:pointer;display:flex;flex-direction:column;gap:0.5rem;transition:all 0.2s;">
                    <div style="display:flex;align-items:center;gap:0.5rem;">
                        <input type="radio" name="lead_mode" value="wa_code" {{ $activeMode === 'wa_code' ? 'checked' : '' }} style="accent-color:#10B981;width:16px;height:16px;">
                        <strong style="color:#065F46;font-size:0.9375rem;font-weight:800;">2. Mode Kode Referensi WA</strong>
                    </div>
                    <span style="font-size:0.8rem;color:#475569;line-height:1.45;">
                        Direct Redirect ke WA dengan Kode Unik Kontinu (<code style="color:#059669;font-weight:700;">UDSM-0001</code>, <code style="color:#059669;font-weight:700;">UDSM-9999</code>). Instant Logging milidetik di DB.
                    </span>
                </label>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label style="font-size:0.8125rem;font-weight:700;color:#334155;margin-bottom:0.4rem;display:flex;justify-content:space-between;align-items:center;">
                    <span>Template Pesan WhatsApp (Mode Kode Referensi)</span>
                    <span style="font-size:0.75rem;color:#0284C7;font-weight:600;">Gunakan Tag: {code}, {page}</span>
                </label>
                <textarea name="wa_template_text" style="width:100%;background:#FFFFFF;border:1.5px solid #CBD5E1;color:#0F172A;border-radius:10px;padding:0.75rem 1rem;font-size:0.875rem;font-family:Montserrat,sans-serif;outline:none;transition:all 0.2s;" rows="3" placeholder="Halo, saya tertarik dengan produk piring keramik. (Kode Referensi: {code}, Halaman: {page})">{{ $tplText }}</textarea>
                <div style="font-size:0.75rem;color:#64748B;margin-top:0.4rem;line-height:1.4;">
                    *Tag <code style="color:#0F172A;font-weight:700;">{code}</code> = Nomor urut unik tanpa reset (contoh: UDSM-0001, UDSM-9999, dst).<br>
                    *Tag <code style="color:#0F172A;font-weight:700;">{page}</code> = Path URL halaman tempat tombol diklik (contoh: <code>/products/piring-keramik</code>).
                </div>
            </div>

            <button type="submit" style="background:#0F172A;color:#FFFFFF;font-size:0.875rem;font-weight:700;padding:0.75rem 1.5rem;border-radius:10px;border:none;cursor:pointer;transition:all 0.2s;">
                Simpan Mode Leads
            </button>
        </form>
    </div>

    {{-- CARD 2: Nomor WA Aktif --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:14px;padding:1.75rem;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:1.25rem;padding-bottom:1rem;border-bottom:1px solid #F1F5F9;">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(34,197,94,0.1);display:flex;align-items:center;justify-content:center;color:#16A34A;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
            </div>
            <div>
                <h3 style="font-size:1rem;font-weight:800;color:#0F172A;margin:0;">Daftar Nomor WhatsApp Aktif</h3>
                <div style="font-size:0.75rem;color:#64748B;">Kelola nomor tujuan WhatsApp utama dan floating button website</div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.wa.update') }}">
            @csrf
            @forelse($waSettings as $wa)
            <input type="hidden" name="ids[]" value="{{ $wa->id }}">
            <div style="border:1px solid #E2E8F0;padding:1.25rem;margin-bottom:1rem;border-radius:12px;background:#F8FAFC;">
                <div style="display:grid;grid-template-columns:1fr 1fr 120px auto;gap:1rem;align-items:start;">
                    <div>
                        <label style="font-size:0.75rem;font-weight:700;color:#475569;margin-bottom:0.35rem;display:block;">Label</label>
                        <input type="text" name="label[{{ $wa->id }}]" value="{{ $wa->label }}" style="width:100%;background:#FFFFFF;border:1.5px solid #CBD5E1;color:#1E293B;border-radius:8px;padding:0.6rem 0.75rem;font-size:0.875rem;font-family:Montserrat,sans-serif;">
                    </div>
                    <div>
                        <label style="font-size:0.75rem;font-weight:700;color:#475569;margin-bottom:0.35rem;display:block;">Nomor WA (tanpa +)</label>
                        <input type="text" name="nomor_wa[{{ $wa->id }}]" value="{{ $wa->nomor_wa }}" style="width:100%;background:#FFFFFF;border:1.5px solid #CBD5E1;color:#1E293B;border-radius:8px;padding:0.6rem 0.75rem;font-size:0.875rem;font-family:Montserrat,sans-serif;" placeholder="628xxxxxxxxxx">
                    </div>
                    <div>
                        <label style="font-size:0.75rem;font-weight:700;color:#475569;margin-bottom:0.35rem;display:block;">Urutan</label>
                        <input type="number" name="order[{{ $wa->id }}]" value="{{ $wa->order }}" style="width:100%;background:#FFFFFF;border:1.5px solid #CBD5E1;color:#1E293B;border-radius:8px;padding:0.6rem 0.75rem;font-size:0.875rem;font-family:Montserrat,sans-serif;" min="0">
                    </div>
                    <div>
                        <label style="font-size:0.75rem;font-weight:700;color:#475569;margin-bottom:0.35rem;display:block;">Aksi</label>
                        <form method="POST" action="{{ route('admin.wa.destroy', $wa->id) }}" onsubmit="return confirm('Hapus nomor ini?')" style="margin:0;">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:#FEE2E2;border:1px solid #FCA5A5;color:#991B1B;padding:0.55rem 0.75rem;border-radius:8px;cursor:pointer;font-size:0.8125rem;font-weight:600;display:flex;align-items:center;justify-content:center;">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div style="margin-top:0.875rem;">
                    <label style="font-size:0.75rem;font-weight:700;color:#475569;margin-bottom:0.35rem;display:block;">Template Pesan Floating Button</label>
                    <textarea name="template_pesan[{{ $wa->id }}]" style="width:100%;background:#FFFFFF;border:1.5px solid #CBD5E1;color:#1E293B;border-radius:8px;padding:0.6rem 0.75rem;font-size:0.875rem;font-family:Montserrat,sans-serif;" rows="2">{{ $wa->template_pesan }}</textarea>
                </div>
                <div style="display:flex;gap:2rem;margin-top:0.875rem;">
                    <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.8125rem;font-weight:600;color:#334155;">
                        <input type="hidden" name="is_active[{{ $wa->id }}]" value="0">
                        <input type="checkbox" name="is_active[{{ $wa->id }}]" value="1" {{ $wa->is_active?'checked':'' }} style="accent-color:#0F172A;width:16px;height:16px;">
                        Aktifkan Nomor
                    </label>
                    <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.8125rem;font-weight:600;color:#334155;">
                        <input type="radio" name="primary" value="{{ $wa->id }}" {{ $wa->is_primary?'checked':'' }} style="accent-color:#0F172A;width:16px;height:16px;">
                        Jadikan Primary (Floating Button Website)
                    </label>
                </div>
            </div>
            @empty
            <p style="color:#64748B;font-size:0.875rem;">Belum ada nomor WA. Tambahkan nomor di bawah.</p>
            @endforelse

            @if($waSettings->count())
            <button type="submit" style="background:#0F172A;color:#FFFFFF;font-size:0.875rem;font-weight:700;padding:0.65rem 1.25rem;border-radius:8px;border:none;cursor:pointer;margin-top:0.5rem;">
                Simpan Perubahan Nomor
            </button>
            @endif
        </form>
    </div>

    {{-- CARD 3: Tambah Nomor WA Baru --}}
    <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:14px;padding:1.75rem;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="display:flex;align-items:center;gap:0.625rem;margin-bottom:1.25rem;padding-bottom:1rem;border-bottom:1px solid #F1F5F9;">
            <div style="width:36px;height:36px;border-radius:10px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;color:#3B82F6;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </div>
            <div>
                <h3 style="font-size:1rem;font-weight:800;color:#0F172A;margin:0;">Tambah Nomor WhatsApp Baru</h3>
                <div style="font-size:0.75rem;color:#64748B;">Tambahkan nomor admin / sales baru untuk penerima pesan WA</div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.wa.store') }}">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem;">
                <div>
                    <label style="font-size:0.75rem;font-weight:700;color:#475569;margin-bottom:0.35rem;display:block;">Label <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="label" style="width:100%;background:#FFFFFF;border:1.5px solid #CBD5E1;color:#1E293B;border-radius:8px;padding:0.65rem 0.875rem;font-size:0.875rem;font-family:Montserrat,sans-serif;" placeholder="Sales / CS Utama" required>
                </div>
                <div>
                    <label style="font-size:0.75rem;font-weight:700;color:#475569;margin-bottom:0.35rem;display:block;">Nomor WA (Gunakan 62) <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="nomor_wa" style="width:100%;background:#FFFFFF;border:1.5px solid #CBD5E1;color:#1E293B;border-radius:8px;padding:0.65rem 0.875rem;font-size:0.875rem;font-family:Montserrat,sans-serif;" placeholder="628xxxxxxxxxx" required>
                </div>
            </div>
            <div style="margin-bottom:1.25rem;">
                <label style="font-size:0.75rem;font-weight:700;color:#475569;margin-bottom:0.35rem;display:block;">Template Pesan Default <span style="color:#EF4444;">*</span></label>
                <textarea name="template_pesan" style="width:100%;background:#FFFFFF;border:1.5px solid #CBD5E1;color:#1E293B;border-radius:8px;padding:0.65rem 0.875rem;font-size:0.875rem;font-family:Montserrat,sans-serif;" rows="2" placeholder="Halo, saya ingin menanyakan produk..." required></textarea>
            </div>
            <button type="submit" style="background:#0F172A;color:#FFFFFF;font-size:0.875rem;font-weight:700;padding:0.65rem 1.25rem;border-radius:8px;border:none;cursor:pointer;">
                + Tambah Nomor Baru
            </button>
        </form>
    </div>
</div>
@endsection
