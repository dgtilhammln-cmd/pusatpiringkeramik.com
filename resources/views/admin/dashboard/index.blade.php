@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('content')
@php
$totalLeads    = \App\Models\Lead::count();
$todayLeads    = \App\Models\Lead::whereDate('created_at',today())->count();
$monthLeads    = \App\Models\Lead::whereMonth('created_at',now()->month)->count();
$newLeadsCount = \App\Models\Lead::where('status','new')->count();
@endphp

{{-- Page Header --}}
<div style="margin-bottom:1.5rem; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem;">
  <div>
    <h1 style="font-size:1.375rem;font-weight:800;color:#fff;margin:0 0 .25rem;letter-spacing:-.02em;">Overview</h1>
    <p style="font-size:.8125rem;color:var(--text3,#7A7A8A);margin:0;">Ringkasan data website CV. Karya Perdana Teknik</p>
  </div>
  <form method="GET" action="{{ route('admin.dashboard') }}" style="display: flex; gap: 0.5rem; align-items: center;">
    <input type="date" id="dash-start" name="start_date" value="{{ $start_date ?? '' }}" style="padding: 0.5rem; font-size: 0.8rem; background: #161618; border: 1px solid rgba(255,255,255,0.1); border-radius: 4px; color: #fff; font-family: inherit;">
    <span style="color: rgba(255,255,255,0.5);">s/d</span>
    <input type="date" id="dash-end" name="end_date" value="{{ $end_date ?? '' }}" style="padding: 0.5rem; font-size: 0.8rem; background: #161618; border: 1px solid rgba(255,255,255,0.1); border-radius: 4px; color: #fff; font-family: inherit;">
    <button type="submit" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.8rem;">Filter</button>
    <div style="border-left: 1px solid rgba(255,255,255,0.1); margin: 0 0.25rem; height: 30px;"></div>
    <button type="button" onclick="downloadReport('xls')" class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem; border-color: #25D366; color: #25D366;" onmouseover="this.style.background='rgba(37,211,102,0.1)'" onmouseout="this.style.background='transparent'">↓ XLS</button>
    <button type="button" onclick="downloadReport('pdf')" class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem; border-color: #EF4444; color: #EF4444;" onmouseover="this.style.background='rgba(239,68,68,0.1)'" onmouseout="this.style.background='transparent'">↓ PDF</button>
  </form>
</div>
<div style="font-size:0.75rem; color:var(--text3,#7A7A8A); margin-top:-1rem; margin-bottom:1.5rem; text-align:right;">
  *Silakan filter periode tanggal terlebih dahulu sebelum men-download laporan.
</div>

<script>
function downloadReport(format) {
    const start = document.getElementById('dash-start').value;
    const end = document.getElementById('dash-end').value;
    if(!start || !end) {
        alert('Mohon isi rentang tanggal (s/d) lalu klik Filter terlebih dahulu!');
        return;
    }
    const url = `/admin/analytics/export/${format}?start_date=${start}&end_date=${end}`;
    if(format === 'pdf') {
        window.open(url, '_blank');
    } else {
        window.location.href = url;
    }
}
</script>

{{-- STAT CARDS ROW --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;">
  @foreach([
    ['Visitor / Page Views','visitor',$stats['visitor'],'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z','#3B82F6'],
    ['Klik WA','wa_click',$stats['wa_click'],'M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z','#22C55E'],
    ['Total Leads','leads',$stats['leads'],'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','#FFD700'],
    ['Conversion (CTR)','ctr',$stats['ctr'].'%','M13 7h8m0 0v8m0-8l-8 8-4-4-6 6','#8B5CF6'],
  ] as $sc)
  <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.25rem;transition:border-color .2s;" onmouseover="this.style.borderColor='rgba(255,215,0,.2)'" onmouseout="this.style.borderColor='rgba(255,255,255,.07)'">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.875rem;">
      <div style="background:rgba(255,255,255,.05);border-radius:8px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
        <svg width="16" height="16" fill="none" stroke="{{ $sc[4] }}" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $sc[3] }}"/></svg>
      </div>
    </div>
    <div style="font-size:1.875rem;font-weight:900;color:#fff;line-height:1;margin-bottom:.375rem;">{{ $sc[2] }}</div>
    <div style="font-size:.75rem;color:var(--text3,#7A7A8A);font-weight:500;">{{ $sc[0] }}</div>
  </div>
  @endforeach
</div>

{{-- MIDDLE ROW: Chart + Content Stats --}}
<div style="display:grid;grid-template-columns:1.6fr 1fr;gap:1rem;margin-bottom:1.5rem;">

  {{-- Leads Chart --}}
  <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.25rem;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
      <div>
        <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--text3);margin-bottom:.25rem;">Leads Masuk</div>
        <div style="font-size:1.5rem;font-weight:900;color:#fff;">{{ $monthLeads }} <span style="font-size:.875rem;font-weight:400;color:var(--text3);">bulan ini</span></div>
      </div>
      <div style="display:flex;gap:.375rem;">
        <span style="background:rgba(255,215,0,.15);border:1px solid rgba(255,215,0,.3);color:#FFD700;font-size:.7rem;font-weight:700;padding:.25rem .625rem;border-radius:100px;">30 Hari</span>
      </div>
    </div>
    <canvas id="leads-chart" height="100"></canvas>
  </div>

  {{-- Content Overview --}}
  <div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1.25rem;">
    <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--text3);margin-bottom:1.25rem;">Konten Website</div>
    @foreach([
      ['Layanan',route('admin.services.index'),$counts['services'],'#FFD700','M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z'],
      ['Galeri',route('admin.gallery.index'),$counts['gallery'],'#3B82F6','M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
      ['Artikel',route('admin.articles.index'),$counts['articles'],'#8B5CF6','M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
      ['Klien',route('admin.clients.index'),$counts['clients'],'#22C55E','M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
    ] as $cc)
    <a href="{{ $cc[1] }}" style="display:flex;align-items:center;justify-content:space-between;padding:.75rem 0;border-bottom:1px solid rgba(255,255,255,.04);text-decoration:none;transition:opacity .2s;" onmouseover="this.style.opacity='.7'" onmouseout="this.style.opacity='1'">
      <div style="display:flex;align-items:center;gap:.625rem;">
        <div style="width:30px;height:30px;background:rgba(255,255,255,.04);border-radius:6px;display:flex;align-items:center;justify-content:center;">
          <svg width="13" height="13" fill="none" stroke="{{ $cc[3] }}" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $cc[4] }}"/></svg>
        </div>
        <span style="font-size:.8125rem;color:#D4D4D8;font-weight:500;">{{ $cc[0] }}</span>
      </div>
      <div style="display:flex;align-items:center;gap:.5rem;">
        <span style="font-size:1.125rem;font-weight:800;color:{{ $cc[3] }};">{{ $cc[2] }}</span>
        <svg width="12" height="12" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </a>
    @endforeach
  </div>
</div>

{{-- RECENT LEADS TABLE --}}
<div style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;overflow:hidden;">
  <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.06);">
    <div>
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--text3);">Recent Leads</div>
      <div style="font-size:.8rem;color:rgba(255,255,255,.3);margin-top:.1rem;">Request Order terbaru</div>
    </div>
    <a href="{{ route('admin.leads.index') }}" style="display:inline-flex;align-items:center;gap:.375rem;font-size:.75rem;font-weight:600;color:#FFD700;text-decoration:none;">
      Lihat Semua
      <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
  </div>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr>
          @foreach(['Nama','Produk','Telepon','Waktu','Status'] as $h)
          <th style="padding:.75rem 1.5rem;text-align:left;font-size:.6875rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text3);background:rgba(255,255,255,.02);white-space:nowrap;">{{ $h }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse($recentLeads as $lead)
        <tr style="border-top:1px solid rgba(255,255,255,.04);transition:background .15s;" onmouseover="this.style.background='rgba(255,255,255,.02)'" onmouseout="this.style.background='transparent'">
          <td style="padding:.875rem 1.5rem;">
            <div style="font-size:.8125rem;font-weight:600;color:#fff;">{{ $lead->name }}</div>
            @if($lead->company)<div style="font-size:.7rem;color:var(--text3);">{{ $lead->company }}</div>@endif
          </td>
          <td style="padding:.875rem 1.5rem;font-size:.8125rem;color:#D4D4D8;max-width:180px;">
            <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;">{{ $lead->product ?? '-' }}</span>
          </td>
          <td style="padding:.875rem 1.5rem;font-size:.8125rem;color:#D4D4D8;white-space:nowrap;">{{ $lead->phone }}</td>
          <td style="padding:.875rem 1.5rem;font-size:.75rem;color:var(--text3);white-space:nowrap;">{{ $lead->created_at->diffForHumans() }}</td>
          <td style="padding:.875rem 1.5rem;">
            @php
              $sc = match($lead->status){
                'new'=>['#FFD700','rgba(255,215,0,.15)','Baru'],
                'contacted'=>['#3B82F6','rgba(59,130,246,.15)','Dihubungi'],
                'closed'=>['#22C55E','rgba(34,197,94,.15)','Selesai'],
                default=>['#7A7A8A','rgba(122,122,138,.15)','Lainnya']};
            @endphp
            <span style="background:{{ $sc[1] }};color:{{ $sc[0] }};font-size:.65rem;font-weight:700;padding:.2rem .625rem;border-radius:100px;white-space:nowrap;">{{ $sc[2] }}</span>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" style="padding:2.5rem;text-align:center;color:var(--text3);font-size:.875rem;">Belum ada leads masuk</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Quick Actions --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:.875rem;margin-top:1.5rem;">
  @foreach([
    ['Tambah Layanan',route('admin.services.create'),'#FFD700','M12 4v16m8-8H4'],
    ['Upload Foto',route('admin.gallery.create'),'#3B82F6','M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01'],
    ['Tulis Artikel',route('admin.articles.create'),'#8B5CF6','M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
    ['Pengaturan WA',route('admin.wa.index'),'#22C55E','M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15'],
  ] as $qa)
  <a href="{{ $qa[1] }}" style="background:#161618;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:1rem;display:flex;align-items:center;gap:.75rem;text-decoration:none;transition:all .2s;" onmouseover="this.style.borderColor='{{ $qa[2] }}';this.style.background='rgba(255,255,255,.03)'" onmouseout="this.style.borderColor='rgba(255,255,255,.07)';this.style.background='#161618'">
    <div style="width:36px;height:36px;background:rgba(255,255,255,.05);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <svg width="16" height="16" fill="none" stroke="{{ $qa[2] }}" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $qa[3] }}"/></svg>
    </div>
    <span style="font-size:.8125rem;font-weight:600;color:#D4D4D8;">{{ $qa[0] }}</span>
  </a>
  @endforeach
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
Chart.defaults.color='#7A7A8A';
Chart.defaults.borderColor='rgba(255,255,255,.06)';
new Chart(document.getElementById('leads-chart'),{
  type:'bar',
  data:{
    labels:{!! json_encode($labels) !!},
    datasets:[{
      label:'Leads',
      data:{!! json_encode($values) !!},
      backgroundColor:function(ctx){
        var g=ctx.chart.ctx.createLinearGradient(0,0,0,200);
        g.addColorStop(0,'rgba(255,215,0,.8)');
        g.addColorStop(1,'rgba(255,215,0,.05)');
        return g;
      },
      borderRadius:6,
      borderSkipped:false,
    }]
  },
  options:{
    responsive:true,maintainAspectRatio:true,
    plugins:{legend:{display:false},tooltip:{callbacks:{label:function(c){return ' '+c.parsed.y+' leads';}}}},
    scales:{
      x:{grid:{display:false},ticks:{font:{size:10},maxRotation:0}},
      y:{grid:{color:'rgba(255,255,255,.04)'},ticks:{font:{size:10},stepSize:1,precision:0}}
    }
  }
});
</script>
@endpush
@endsection
