@extends('layouts.admin')
@section('title','Leads — Request Order')
@section('page-title','Leads & Request Order')
@section('content')

{{-- Stats --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem;margin-bottom:2rem;">
    <div class="admin-card" style="border-left:3px solid #FFD700;">
        <div style="font-size:0.75rem;color:#A1A1AA;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem;">Total Leads</div>
        <div style="font-size:2rem;font-weight:800;color:#fff;">{{ number_format($stats['total']) }}</div>
    </div>
    <div class="admin-card" style="border-left:3px solid #22C55E;">
        <div style="font-size:0.75rem;color:#A1A1AA;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem;">Hari Ini</div>
        <div style="font-size:2rem;font-weight:800;color:#fff;">{{ $stats['today'] }}</div>
    </div>
    <div class="admin-card" style="border-left:3px solid #3B82F6;">
        <div style="font-size:0.75rem;color:#A1A1AA;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem;">Bulan Ini</div>
        <div style="font-size:2rem;font-weight:800;color:#fff;">{{ $stats['this_month'] }}</div>
    </div>
    <div class="admin-card" style="border-left:3px solid #F59E0B;">
        <div style="font-size:0.75rem;color:#A1A1AA;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem;">Belum Ditindak</div>
        <div style="font-size:2rem;font-weight:800;color:#fff;">{{ $stats['new'] }}</div>
    </div>
</div>

{{-- Export & Filter Bar --}}
<div class="admin-card" style="margin-bottom:1.5rem;padding:1.25rem 1.5rem;">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:1.5rem;flex-wrap:wrap;">
        <div style="font-size:0.875rem;font-weight:700;color:#FFD700;display:flex;align-items:center;gap:0.5rem;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Unduh Data Leads (CSV / Excel)
        </div>
        <form method="GET" action="{{ route('admin.leads.export') }}" style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:0.5rem;">
                <label style="font-size:0.8125rem;color:#A1A1AA;white-space:nowrap;">Dari:</label>
                <input type="date" name="start_date" style="background:#1C1C1E;border:1px solid #3F3F46;color:#fff;border-radius:6px;padding:0.375rem 0.75rem;font-size:0.8125rem;" value="{{ request('start_date') }}">
            </div>
            <div style="display:flex;align-items:center;gap:0.5rem;">
                <label style="font-size:0.8125rem;color:#A1A1AA;white-space:nowrap;">Sampai:</label>
                <input type="date" name="end_date" style="background:#1C1C1E;border:1px solid #3F3F46;color:#fff;border-radius:6px;padding:0.375rem 0.75rem;font-size:0.8125rem;" value="{{ request('end_date') }}">
            </div>
            <button type="submit" style="background:#FFD700;color:#0A0A0A;border:none;border-radius:6px;padding:0.5rem 1.25rem;font-size:0.875rem;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:0.5rem;white-space:nowrap;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Unduh CSV
            </button>
            <a href="{{ route('admin.leads.export') }}" style="font-size:0.8125rem;color:#A1A1AA;text-decoration:underline;">Semua Data</a>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card" style="padding:0;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;" class="admin-table">
        <thead><tr>
            <th>#</th><th>Nama</th><th>Produk</th><th>Kontak</th>
            <th>Sumber</th>
            <th>Waktu</th><th>Status</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        @forelse($leads as $lead)
        <tr>
            <td style="color:#3F3F46;font-size:0.75rem;">{{ $lead->id }}</td>
            <td>
                <div style="font-weight:700;color:#fff;">{{ $lead->name }}</div>
                <div style="font-size:0.75rem;color:#A1A1AA;">{{ $lead->company }}</div>
            </td>
            <td style="color:#A1A1AA;max-width:140px;">
                <div style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $lead->product ?: '-' }}</div>
            </td>
            <td>
                <div style="font-size:0.8125rem;color:#D4D4D8;">{{ $lead->phone }}</div>
                @if($lead->email)<div style="font-size:0.75rem;color:#A1A1AA;">{{ $lead->email }}</div>@endif
            </td>
            <td>
                @php
                    $src = $lead->source ?? 'Website';
                    $srcColor = '#A1A1AA';
                    if (str_contains($src, 'Hero'))        $srcColor = '#FFD700';
                    elseif (str_contains($src, 'Navbar'))  $srcColor = '#3B82F6';
                    elseif (str_contains($src, 'Footer'))  $srcColor = '#8B5CF6';
                    elseif (str_contains($src, 'Artikel')) $srcColor = '#F97316';
                    elseif (str_contains($src, 'Layanan')) $srcColor = '#22C55E';
                    elseif (str_contains($src, 'Galeri'))  $srcColor = '#EC4899';
                    elseif (str_contains($src, 'Kontak'))  $srcColor = '#14B8A6';
                    elseif (str_contains($src, 'Floating'))$srcColor = '#25D366';
                @endphp
                <span style="font-size:0.7rem;padding:0.2rem 0.5rem;border-radius:100px;background:{{ $srcColor }}22;color:{{ $srcColor }};border:1px solid {{ $srcColor }}44;white-space:nowrap;display:inline-block;max-width:140px;overflow:hidden;text-overflow:ellipsis;" title="{{ $src }}">
                    {{ Str::limit($src, 22) }}
                </span>
            </td>
            <td style="font-size:0.75rem;color:#A1A1AA;white-space:nowrap;">{{ $lead->created_at->diffForHumans() }}</td>
            <td>
                <span style="font-size:0.75rem;padding:0.2rem 0.625rem;border-radius:100px;background:{{ $lead->status_color }}22;color:{{ $lead->status_color }};border:1px solid {{ $lead->status_color }}44;">
                    {{ $lead->status_label }}
                </span>
            </td>
            <td>
                <div style="display:flex;gap:0.5rem;">
                    <a href="{{ route('admin.leads.show',$lead) }}" style="font-size:0.8125rem;color:#FFD700;text-decoration:none;font-weight:600;">Detail</a>
                    @if($lead->wa_number)
                    <a href="https://wa.me/{{ $lead->wa_number }}?text={{ urlencode('Follow up lead: '.$lead->name.' - '.$lead->phone) }}" target="_blank"
                       style="font-size:0.8125rem;color:#25D366;text-decoration:none;font-weight:600;">WA</a>
                    @endif
                    <form method="POST" action="{{ route('admin.leads.destroy',$lead) }}" onsubmit="return confirm('Hapus lead ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="font-size:0.8125rem;color:#f87171;background:none;border:none;cursor:pointer;font-weight:600;padding:0;">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:4rem;color:#A1A1AA;">
            <div style="font-size:2.5rem;margin-bottom:1rem;">📭</div>
            Belum ada leads masuk.
        </td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:1.5rem;">{{ $leads->links() }}</div>
@endsection
