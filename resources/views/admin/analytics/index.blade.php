@extends('layouts.admin')
@section('title','Analytics')
@section('page-title','Analytics & Statistik')
@section('content')

{{-- Period Selector --}}
<div style="display:flex;gap:0.5rem;margin-bottom:1.5rem;flex-wrap:wrap;align-items:center;">
    <span style="font-size:0.8125rem;color:#A1A1AA;font-weight:600;">Periode:</span>
    @foreach(['7'=>'7 Hari','30'=>'30 Hari','365'=>'1 Tahun'] as $p=>$l)
    <button onclick="loadData('{{ $p }}')" id="btn-{{ $p }}" style="padding:0.375rem 0.875rem;font-size:0.8125rem;font-weight:600;border:1px solid #27272A;background:{{ $p==='30'?'#F5A623':'transparent' }};color:{{ $p==='30'?'#000':'#A1A1AA' }};cursor:pointer;transition:all 0.2s;">{{ $l }}</button>
    @endforeach
    <span style="margin: 0 0.5rem; color:#A1A1AA;">|</span>
    <input type="date" id="date-from" style="padding: 0.375rem; font-size: 0.8rem; background: transparent; border: 1px solid #27272A; color: #fff; font-family: inherit;">
    <span style="color: #A1A1AA;">s/d</span>
    <input type="date" id="date-to" style="padding: 0.375rem; font-size: 0.8rem; background: transparent; border: 1px solid #27272A; color: #fff; font-family: inherit;">
    <button onclick="loadCustomData()" style="padding:0.375rem 0.875rem;font-size:0.8125rem;font-weight:600;border:none;background:#3B82F6;color:#fff;cursor:pointer;transition:all 0.2s;">Filter Custom</button>
</div>

{{-- Summary Cards --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem;margin-bottom:2rem;">
    <div class="admin-card" style="border-left:3px solid #3B82F6;"><div style="font-size:0.75rem;color:#A1A1AA;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem;">Visitor</div><div id="stat-pageview" style="font-size:2rem;font-weight:800;color:#fff;">—</div></div>
    <div class="admin-card" style="border-left:3px solid #25D366;"><div style="font-size:0.75rem;color:#A1A1AA;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem;">Klik WA</div><div id="stat-wa" style="font-size:2rem;font-weight:800;color:#fff;">—</div></div>
    <div class="admin-card" style="border-left:3px solid #F5A623;"><div style="font-size:0.75rem;color:#A1A1AA;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem;">Leads</div><div id="stat-leads" style="font-size:2rem;font-weight:800;color:#fff;">—</div></div>
    <div class="admin-card" style="border-left:3px solid #8B5CF6;"><div style="font-size:0.75rem;color:#A1A1AA;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem;">CTR</div><div id="stat-ctr" style="font-size:2rem;font-weight:800;color:#fff;">—</div></div>
</div>

{{-- Chart + Top Pages --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;margin-bottom:2rem;">
    <div class="admin-card">
        <h3 style="font-size:0.875rem;font-weight:700;color:#A1A1AA;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 1.25rem;">Grafik Kunjungan</h3>
        <canvas id="visits-chart" height="100"></canvas>
    </div>
    <div class="admin-card">
        <h3 style="font-size:0.875rem;font-weight:700;color:#A1A1AA;text-transform:uppercase;letter-spacing:0.08em;margin:0 0 1rem;">Top Halaman</h3>
        <div id="top-pages">
            <div style="text-align:center;padding:2rem;color:#3F3F46;">Memuat...</div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
let chart = null;
let currentPeriod = '30';

async function loadCustomData() {
    const from = document.getElementById('date-from').value;
    const to = document.getElementById('date-to').value;
    if (!from || !to) return alert('Pilih tanggal mulai dan selesai');
    
    currentPeriod = 'custom';
    ['7','30','365'].forEach(p => {
        const btn = document.getElementById('btn-' + p);
        btn.style.background = 'transparent';
        btn.style.color = '#A1A1AA';
    });

    const res  = await fetch('/admin/analytics/data?period=custom&from=' + from + '&to=' + to);
    const data = await res.json();
    renderData(data);
}

async function loadData(period) {
    currentPeriod = period;
    // Update button styles
    ['7','30','365'].forEach(p => {
        const btn = document.getElementById('btn-' + p);
        btn.style.background = p === period ? '#F5A623' : 'transparent';
        btn.style.color = p === period ? '#000' : '#A1A1AA';
    });

    const res  = await fetch('/admin/analytics/data?period=' + period);
    const data = await res.json();
    renderData(data);
}

function renderData(data) {
    // Stats
    document.getElementById('stat-pageview').textContent = (data.summary.pageview || 0).toLocaleString();
    document.getElementById('stat-wa').textContent = (data.summary.wa_click || 0).toLocaleString();
    document.getElementById('stat-leads').textContent = (data.summary.leads || 0).toLocaleString();
    document.getElementById('stat-ctr').textContent = (data.summary.ctr || 0) + '%';

    // Chart
    if (chart) chart.destroy();
    const ctx = document.getElementById('visits-chart');
    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Kunjungan',
                data: data.values,
                borderColor: '#F5A623',
                backgroundColor: 'rgba(245,166,35,0.08)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 2,
                pointBackgroundColor: '#F5A623',
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: '#A1A1AA', font: { size: 10 } } },
                y: { grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: '#A1A1AA', font: { size: 10 } } }
            }
        }
    });

    // Top Pages
    const topPagesEl = document.getElementById('top-pages');
    if (data.top_pages && data.top_pages.length) {
        topPagesEl.innerHTML = data.top_pages.map(p => {
            const path = p.page_url ? (new URL(p.page_url, window.location.origin)).pathname : '/';
            return `<div style="display:flex;justify-content:space-between;padding:0.5rem 0;border-bottom:1px solid #27272A;font-size:0.8125rem;">
                <span style="color:#D4D4D8;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:70%;">${path}</span>
                <span style="font-weight:700;color:#F5A623;flex-shrink:0;">${parseInt(p.views).toLocaleString()}</span>
            </div>`;
        }).join('');
    } else {
        topPagesEl.innerHTML = '<p style="color:#3F3F46;text-align:center;padding:1rem;">Belum ada data.</p>';
    }
}

// Load on page init
loadData('30');
</script>
@endpush
@endsection
