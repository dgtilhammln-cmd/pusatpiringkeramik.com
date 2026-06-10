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

<div class="admin-card" style="padding:0;overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;" class="admin-table">
        <thead><tr>
            <th>#</th><th>Nama</th><th>Produk</th><th>Kontak</th><th>Waktu</th><th>Status</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        @forelse($leads as $lead)
        <tr>
            <td style="color:#3F3F46;font-size:0.75rem;">{{ $lead->id }}</td>
            <td>
                <div style="font-weight:700;color:#fff;">{{ $lead->name }}</div>
                <div style="font-size:0.75rem;color:#A1A1AA;">{{ $lead->company }}</div>
            </td>
            <td style="color:#A1A1AA;max-width:160px;">
                <div style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $lead->product ?: '-' }}</div>
            </td>
            <td>
                <div style="font-size:0.8125rem;color:#D4D4D8;">{{ $lead->phone }}</div>
                @if($lead->email)<div style="font-size:0.75rem;color:#A1A1AA;">{{ $lead->email }}</div>@endif
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
        <tr><td colspan="7" style="text-align:center;padding:4rem;color:#A1A1AA;">
            <div style="font-size:2.5rem;margin-bottom:1rem;">📭</div>
            Belum ada leads masuk.
        </td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top:1.5rem;">{{ $leads->links() }}</div>
@endsection
