@extends('layouts.admin')
@section('title','Leads — Request Order')
@section('page-title','Leads & Request Order')
@section('content')

{{-- Page Header --}}
<div style="margin-bottom:1.5rem; display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1rem;">
  <div>
    <h1 style="font-size:1.375rem;font-weight:800;color:#fff;margin:0 0 .25rem;letter-spacing:-.02em;">Leads & Request Order</h1>
    <p style="font-size:.8125rem;color:var(--text3,#7A7A8A);margin:0;">Daftar permintaan order dan kontak masuk dari website</p>
  </div>
  <div style="display:flex; gap:.5rem; align-items:center; flex-wrap:wrap;">
    <input type="date" id="lead-start" style="padding:.5rem; font-size:.8rem; background:#161618; border:1px solid rgba(255,255,255,.1); border-radius:4px; color:#fff; font-family:inherit;">
    <span style="color:rgba(255,255,255,.4);">s/d</span>
    <input type="date" id="lead-end" style="padding:.5rem; font-size:.8rem; background:#161618; border:1px solid rgba(255,255,255,.1); border-radius:4px; color:#fff; font-family:inherit;">
    <div style="border-left:1px solid rgba(255,255,255,.1); margin:0 .25rem; height:30px;"></div>
    <button onclick="downloadLeads('xls')" style="padding:.5rem 1rem; font-size:.8rem; font-weight:700; background:transparent; border:1px solid #25D366; color:#25D366; border-radius:4px; cursor:pointer; transition:all .2s;" onmouseover="this.style.background='rgba(37,211,102,0.1)'" onmouseout="this.style.background='transparent'">↓ XLS</button>
    <button onclick="downloadLeads('pdf')" style="padding:.5rem 1rem; font-size:.8rem; font-weight:700; background:transparent; border:1px solid #EF4444; color:#EF4444; border-radius:4px; cursor:pointer; transition:all .2s;" onmouseover="this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.background='transparent'">↓ PDF</button>
  </div>
</div>
<div style="font-size:.75rem; color:var(--text3,#7A7A8A); margin-top:-1rem; margin-bottom:1.5rem; text-align:right;">
  *Pilih rentang tanggal terlebih dahulu sebelum men-download laporan
</div>

{{-- Stat Cards --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;">
  @foreach([
    ['Total Leads', $stats['total'], '#FFD700', 'M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z M22,6 12,13 2,6'],
    ['Hari Ini', $stats['today'], '#22C55E', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
    ['Bulan Ini', $stats['this_month'], '#3B82F6', 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
    ['Belum Ditindak', $stats['new'], '#F59E0B', 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
  ] as $sc)
  <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.25rem;transition:border-color .2s;" onmouseover="this.style.borderColor='rgba(255,215,0,.2)'" onmouseout="this.style.borderColor='rgba(255,255,255,.07)'">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.875rem;">
      <div style="background:rgba(255,255,255,.05);border-radius:8px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
        <svg width="16" height="16" fill="none" stroke="{{ $sc[2] }}" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $sc[3] }}"/></svg>
      </div>
    </div>
    <div style="font-size:1.875rem;font-weight:900;color:#fff;line-height:1;margin-bottom:.375rem;">{{ number_format($sc[1]) }}</div>
    <div style="font-size:.75rem;color:var(--text3,#7A7A8A);font-weight:500;">{{ $sc[0] }}</div>
  </div>
  @endforeach
</div>

{{-- Leads Table --}}
<div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;overflow:hidden;">
  <div style="padding:1.25rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;justify-content:space-between;">
    <div>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--text3);">Semua Leads</div>
      <div style="font-size:.8rem;color:rgba(255,255,255,.3);margin-top:.1rem;">{{ $leads->total() }} total entri</div>
    </div>
  </div>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr>
          @foreach(['#','Nama & Perusahaan','Telepon / Email','Produk','Sumber','Perangkat','Waktu','Status','Aksi'] as $h)
          <th style="padding:.75rem 1.25rem;text-align:left;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text3,#7A7A8A);background:rgba(255,255,255,.02);white-space:nowrap;">{{ $h }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse($leads as $lead)
        <tr style="border-top:1px solid rgba(255,255,255,.04);transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.02)'" onmouseout="this.style.background='transparent'">
          <td style="padding:.875rem 1.25rem;font-size:.7rem;color:var(--text3);">{{ $lead->id }}</td>
          <td style="padding:.875rem 1.25rem;">
            <div style="font-size:.8125rem;font-weight:700;color:#fff;">{{ $lead->name }}</div>
            @if($lead->company)<div style="font-size:.7rem;color:var(--text3);">{{ $lead->company }}</div>@endif
          </td>
          <td style="padding:.875rem 1.25rem;">
            <div style="font-size:.8125rem;color:#D4D4D8;font-weight:600;white-space:nowrap;">{{ $lead->phone }}</div>
            @if($lead->email)<div style="font-size:.7rem;color:#3B82F6;">{{ $lead->email }}</div>@endif
          </td>
          <td style="padding:.875rem 1.25rem;font-size:.8rem;color:var(--text3);max-width:140px;">
            <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;">{{ $lead->product ?: '—' }}</span>
          </td>
          <td style="padding:.875rem 1.25rem;">
            @php
              $src = $lead->source ?? 'Website';
              $srcColor = match(true) {
                str_contains($src,'Hero')     => '#FFD700',
                str_contains($src,'Navbar')   => '#3B82F6',
                str_contains($src,'Footer')   => '#8B5CF6',
                str_contains($src,'Artikel')  => '#F97316',
                str_contains($src,'Layanan')  => '#22C55E',
                str_contains($src,'Galeri')   => '#EC4899',
                str_contains($src,'Kontak')   => '#14B8A6',
                str_contains($src,'Floating') => '#25D366',
                default                       => '#7A7A8A',
              };
            @endphp
            <span style="font-size:.65rem;padding:.2rem .5rem;border-radius:100px;background:{{ $srcColor }}22;color:{{ $srcColor }};border:1px solid {{ $srcColor }}44;white-space:nowrap;">
              {{ Str::limit($src, 20) }}
            </span>
          </td>
          <td style="padding:.875rem 1.25rem;font-size:.75rem;color:var(--text3);white-space:nowrap;">{{ $lead->device_type ?: '—' }}</td>
          <td style="padding:.875rem 1.25rem;font-size:.75rem;color:var(--text3);white-space:nowrap;">{{ $lead->created_at->diffForHumans() }}</td>
          <td style="padding:.875rem 1.25rem;">
            @php
              $sc = match($lead->status) {
                'new'       => ['#FFD700','rgba(255,215,0,.15)','Baru'],
                'contacted' => ['#3B82F6','rgba(59,130,246,.15)','Diproses'],
                'closed'    => ['#22C55E','rgba(34,197,94,.15)','Selesai'],
                default     => ['#7A7A8A','rgba(122,122,138,.15)','Lainnya'],
              };
            @endphp
            <span style="background:{{ $sc[1] }};color:{{ $sc[0] }};font-size:.6rem;font-weight:700;padding:.2rem .625rem;border-radius:100px;white-space:nowrap;">{{ $sc[2] }}</span>
          </td>
          <td style="padding:.875rem 1.25rem;">
            <div style="display:flex;gap:.625rem;align-items:center;">
              <a href="{{ route('admin.leads.show',$lead) }}" style="font-size:.8rem;color:#FFD700;text-decoration:none;font-weight:600;white-space:nowrap;">Detail</a>
              @if($lead->wa_number)
              <a href="https://wa.me/{{ $lead->wa_number }}?text={{ urlencode('Follow up lead: '.$lead->name.' - '.$lead->phone) }}" target="_blank" style="font-size:.8rem;color:#25D366;text-decoration:none;font-weight:600;">WA</a>
              @endif
              <form method="POST" action="{{ route('admin.leads.destroy',$lead) }}" onsubmit="return confirm('Hapus lead ini?')" style="margin:0;">
                @csrf @method('DELETE')
                <button type="submit" style="font-size:.8rem;color:#f87171;background:none;border:none;cursor:pointer;font-weight:600;padding:0;">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="9" style="padding:4rem;text-align:center;color:var(--text3);">
            <div style="font-size:2.5rem;margin-bottom:1rem;">📭</div>
            Belum ada leads masuk.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div style="margin-top:1.5rem;">{{ $leads->links() }}</div>

@push('scripts')
<script>
function downloadLeads(format) {
    const start = document.getElementById('lead-start').value;
    const end = document.getElementById('lead-end').value;
    if (!start || !end) {
        alert('Mohon isi rentang tanggal (s/d) terlebih dahulu sebelum men-download laporan!');
        return;
    }
    if (format === 'xls') {
        window.location.href = `/admin/leads/export?start_date=${start}&end_date=${end}`;
    } else {
        window.open(`/admin/leads/export-pdf?start_date=${start}&end_date=${end}`, '_blank');
    }
}
</script>
@endpush
@endsection
