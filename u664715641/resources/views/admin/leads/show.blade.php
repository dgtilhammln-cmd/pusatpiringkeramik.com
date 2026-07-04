@extends('layouts.admin')
@section('title','Detail Lead #'.$lead->id)
@section('page-title','Detail Lead')
@section('content')
<div style="max-width:800px;display:flex;flex-direction:column;gap:1.5rem;">

    {{-- Header --}}
    <div class="admin-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:1rem;">
            <div>
                <h2 style="font-size:1.25rem;font-weight:800;color:#fff;margin:0 0 0.25rem;">{{ $lead->name }}</h2>
                <div style="font-size:0.875rem;color:#A1A1AA;">{{ $lead->company }} · Masuk {{ $lead->created_at->format('d M Y, H:i') }}</div>
            </div>
            <span style="padding:0.375rem 1rem;border-radius:100px;background:{{ $lead->status_color }}22;color:{{ $lead->status_color }};border:1px solid {{ $lead->status_color }}44;font-weight:700;font-size:0.875rem;">{{ $lead->status_label }}</span>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
        {{-- Info --}}
        <div class="admin-card">
            <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;text-transform:uppercase;margin:0 0 1rem;">Informasi Kontak</h3>
            <dl style="display:flex;flex-direction:column;gap:0.875rem;">
                @foreach([['Telepon',$lead->phone],['Email',$lead->email ?: '-'],['Perusahaan',$lead->company ?: '-'],['Produk',$lead->product ?: '-'],['Sumber',$lead->source],['Perangkat',$lead->device_type],['IP',$lead->ip_address]] as $row)
                <div style="display:flex;justify-content:space-between;gap:1rem;padding-bottom:0.75rem;border-bottom:1px solid #1f1f22;">
                    <dt style="font-size:0.8125rem;color:#A1A1AA;">{{ $row[0] }}</dt>
                    <dd style="font-size:0.8125rem;color:#fff;font-weight:600;text-align:right;">{{ $row[1] }}</dd>
                </div>
                @endforeach
            </dl>
            @if($lead->wa_number)
            <a href="https://wa.me/{{ $lead->wa_number }}?text={{ urlencode('Halo '.$lead->name.', kami dari CV. Karya Perdana Teknik ingin menindaklanjuti permintaan Anda.') }}" target="_blank"
               style="margin-top:1rem;display:inline-flex;align-items:center;gap:0.5rem;background:#25D366;color:#fff;padding:0.625rem 1.25rem;font-weight:700;font-size:0.875rem;border-radius:6px;text-decoration:none;">
                💬 Follow Up via WhatsApp
            </a>
            @endif
        </div>

        {{-- Pesan & Status --}}
        <div style="display:flex;flex-direction:column;gap:1.25rem;">
            @if($lead->message)
            <div class="admin-card">
                <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;text-transform:uppercase;margin:0 0 1rem;">Pesan</h3>
                <p style="font-size:0.9375rem;color:#D4D4D8;line-height:1.75;margin:0;">{{ $lead->message }}</p>
            </div>
            @endif
            <div class="admin-card">
                <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;text-transform:uppercase;margin:0 0 1rem;">Update Status</h3>
                <form method="POST" action="{{ route('admin.leads.status',$lead) }}">
                    @csrf
                    <select name="status" class="form-select" style="margin-bottom:0.75rem;">
                        <option value="new" {{ $lead->status=='new'?'selected':'' }}>Baru</option>
                        <option value="contacted" {{ $lead->status=='contacted'?'selected':'' }}>Dihubungi</option>
                        <option value="closed" {{ $lead->status=='closed'?'selected':'' }}>Selesai</option>
                    </select>
                    <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">Simpan Status</button>
                </form>
            </div>
            <div class="admin-card">
                <h3 style="font-size:0.875rem;font-weight:700;color:#FFD700;text-transform:uppercase;margin:0 0 1rem;">Catatan Admin</h3>
                <form method="POST" action="{{ route('admin.leads.notes',$lead) }}">
                    @csrf
                    <textarea name="notes" class="form-input" rows="4" placeholder="Catatan internal...">{{ $lead->notes }}</textarea>
                    <button type="submit" class="btn-primary" style="margin-top:0.75rem;width:100%;justify-content:center;">Simpan Catatan</button>
                </form>
            </div>
        </div>
    </div>

    <div>
        <a href="{{ route('admin.leads.index') }}" class="btn-outline">← Kembali ke Daftar Leads</a>
    </div>
</div>
@endsection
