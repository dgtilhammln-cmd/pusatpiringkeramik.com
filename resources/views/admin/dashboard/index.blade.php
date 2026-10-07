@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('content')
@php
$totalLeads    = \App\Models\Lead::count();
$todayLeads    = \App\Models\Lead::whereDate('created_at',today())->count();
$monthLeads    = \App\Models\Lead::whereMonth('created_at',now()->month)->count();
$newLeadsCount = \App\Models\Lead::where('status','new')->count();

$hour = now()->timezone('Asia/Jakarta')->format('H');
if ($hour < 11) { $greeting = 'pagi'; }
elseif ($hour < 15) { $greeting = 'siang'; }
elseif ($hour < 18) { $greeting = 'sore'; }
else { $greeting = 'malam'; }

$quotes = [
    "Pertumbuhan berawal dari tekad untuk terus melangkah, satu pencapaian setiap harinya.",
    "Setiap tantangan adalah anak tangga menuju kesuksesan perusahaan yang lebih besar.",
    "Inovasi hari ini adalah pondasi kokoh untuk kejayaan esok hari.",
    "Kolaborasi dan dedikasi adalah kunci utama menuju pertumbuhan tanpa batas.",
    "Tidak ada hasil gemilang tanpa kerja keras dan sinergi bersama.",
    "Terus bergerak maju, karena potensi perusahaan kita tidak memiliki batas akhir.",
    "Keberhasilan besar dimulai dari langkah-langkah kecil yang konsisten.",
    "Jadilah pelopor perubahan, ciptakan standar baru dalam industri kita.",
    "Fokus pada kualitas akan selalu membawa kita pada kuantitas kesuksesan.",
    "Visi yang jelas dan kerja keras akan mewujudkan masa depan gemilang.",
    "Jadikan setiap masalah sebagai peluang untuk berkembang lebih pesat.",
    "Ketekunan hari ini adalah jaminan kemakmuran perusahaan di masa depan.",
    "Kita membangun lebih dari sekadar bisnis; kita membangun mahakarya.",
    "Pertumbuhan sejati terjadi ketika kita melampaui batas zona nyaman.",
    "Energi positif dan kerja cerdas adalah katalisator pertumbuhan kita.",
    "Perubahan adalah satu-satunya konstanta; beradaptasi adalah kunci untuk menang.",
    "Tetap fokus pada tujuan, dan biarkan hasil kerja keras kita yang berbicara.",
    "Visi besar membutuhkan eksekusi yang konsisten dan semangat tak pantang menyerah.",
    "Jangan pernah berhenti berinovasi, karena dunia terus bergerak maju.",
    "Kesuksesan adalah perjalanan, bukan tujuan akhir; mari terus bertumbuh.",
    "Setiap pelanggan yang puas adalah fondasi dari kerajaan bisnis kita.",
    "Keunggulan bukanlah tindakan sesekali, melainkan kebiasaan kita sehari-hari.",
    "Bersama-sama kita kuat, bersama-sama kita menembus batas ketidakmungkinan.",
    "Pemimpin sejati menciptakan peluang pertumbuhan di setiap kondisi.",
    "Percaya pada proses, kerja keras kita akan berbuah manis pada waktunya.",
    "Jangan takut mencoba hal baru; di sanalah tersembunyi inovasi terbesar.",
    "Kunci keberhasilan adalah fokus pada solusi, bukan pada masalah.",
    "Mari tingkatkan standar kita dan tunjukkan pada dunia apa yang kita bisa.",
    "Kemajuan kecil setiap hari akan menghasilkan pencapaian masif di akhir tahun.",
    "Teruslah melangkah, sejarah kejayaan perusahaan ini sedang kita tulis bersama."
];
$dayOfYear = now()->timezone('Asia/Jakarta')->dayOfYear;
$dailyQuote = $quotes[$dayOfYear % count($quotes)];
$adminName = session('admin_name', 'Administrator');
@endphp

@push('styles')
<style>
/* ═══════ 4 SECONDS SMOOTH ENTRANCE ANIMATION FOR DASHBOARD ═══════ */
@keyframes animateBannerDown {
  0% {
    opacity: 0;
    transform: translateY(-40px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes animateCardUpOpposite {
  0% {
    opacity: 0;
    transform: translateY(50px) scale(0.97);
  }
  100% {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

@keyframes animateChartFromRight {
  0% {
    opacity: 0;
    transform: translateX(60px) scale(0.97);
  }
  100% {
    opacity: 1;
    transform: translateX(0) scale(1);
  }
}

.welcome-banner-card {
  animation: animateBannerDown 4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.stat-card-anim {
  opacity: 0;
  animation: animateCardUpOpposite 4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.chart-card-anim {
  opacity: 0;
  animation: animateChartFromRight 4s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards;
}

.content-card-anim {
  opacity: 0;
  animation: animateCardUpOpposite 4s cubic-bezier(0.16, 1, 0.3, 1) 0.45s forwards;
}

.table-card-anim {
  opacity: 0;
  animation: animateCardUpOpposite 4s cubic-bezier(0.16, 1, 0.3, 1) 0.6s forwards;
}

.qa-card-anim {
  opacity: 0;
  animation: animateCardUpOpposite 4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.welcome-widget-capsule {
  background: #0F172A;
  border-radius: 20px;
  padding: 1.1rem 1.6rem;
  display: flex;
  align-items: center;
  gap: 1.25rem;
  border: 1px solid rgba(255,255,255,0.08);
  box-shadow: 0 10px 25px rgba(15,23,42,0.12);
  font-family: 'Montserrat', sans-serif;
  position: relative;
  z-index: 1;
  max-width: 100%;
}

.welcome-clock-main {
  font-size: 2.35rem;
  font-weight: 800;
  color: #FFFFFF;
  line-height: 1;
  letter-spacing: -0.02em;
  font-variant-numeric: tabular-nums;
}

.welcome-clock-sec {
  font-size: 0.95rem;
  font-weight: 700;
  color: #94A3B8;
  margin-top: 1px;
  font-variant-numeric: tabular-nums;
}

.welcome-widget-divider {
  width: 1px;
  height: 42px;
  background: rgba(255,255,255,0.15);
  flex-shrink: 0;
}

.welcome-title-text {
  font-family: 'Montserrat', sans-serif;
  font-size: 1.75rem;
  font-weight: 300;
  color: #0F172A;
  margin: 0 0 0.4rem;
  letter-spacing: -0.01em;
}

.welcome-quote-text {
  font-family: 'Montserrat', sans-serif;
  font-size: 0.9rem;
  color: #64748B;
  margin: 0;
  line-height: 1.6;
  max-width: 580px;
  font-weight: 300;
}

@media (max-width: 768px) {
  .welcome-banner-card {
    padding: 1.25rem 1.25rem;
    gap: 1.25rem;
    border-radius: 20px;
    margin-bottom: 1.25rem;
  }

  .welcome-title-text {
    font-size: 1.35rem;
    margin-bottom: 0.3rem;
  }

  .welcome-quote-text {
    font-size: 0.825rem;
    line-height: 1.5;
  }

  .welcome-widget-capsule {
    width: 100%;
    justify-content: space-between;
    padding: 0.9rem 1.1rem;
    gap: 0.85rem;
    border-radius: 16px;
  }

  .welcome-clock-main {
    font-size: 1.85rem;
  }

  .welcome-clock-sec {
    font-size: 0.8rem;
  }

  .welcome-widget-divider {
    height: 36px;
  }

  #clock-day {
    font-size: 1.05rem !important;
  }

  #clock-date {
    font-size: 0.675rem !important;
    margin-bottom: 0.2rem !important;
  }

  #weather-info {
    font-size: 0.725rem !important;
    gap: 3px !important;
  }
}

@media (max-width: 520px) {
  .welcome-banner-card {
    padding: 1rem;
    border-radius: 18px;
  }

  .welcome-widget-capsule {
    padding: 0.85rem 0.9rem;
    gap: 0.65rem;
    flex-wrap: wrap;
    justify-content: flex-start;
  }

  .welcome-clock-main {
    font-size: 1.6rem;
  }

  .welcome-widget-divider {
    display: none;
  }

  #weather-info {
    font-size: 0.7rem !important;
    line-height: 1.4;
  }
}
</style>
@endpush

{{-- Welcome Box --}}
<div class="welcome-banner-card">
  <div style="flex: 1; min-width: 240px; position: relative; z-index: 1;">
    <h2 class="welcome-title-text">
      Selamat {{ ucfirst($greeting) }}, <span style="font-weight: 600;">{{ $adminName }}!</span>
    </h2>
    <p class="welcome-quote-text">
      "{{ $dailyQuote }}"
    </p>
  </div>

  <!-- Realtime Widget Container (Image 2 style) -->
  <div class="welcome-widget-capsule">
    <!-- Big Clock with Superscript Seconds -->
    <div style="display: flex; align-items: flex-start; gap: 2px; flex-shrink: 0;">
      <div id="clock-main" class="welcome-clock-main">00:00</div>
      <div id="clock-sec" class="welcome-clock-sec">00</div>
    </div>
    
    <!-- Vertical Divider -->
    <div class="welcome-widget-divider"></div>

    <!-- Date, Weather & Location Info -->
    <div style="display: flex; flex-direction: column; justify-content: center; min-width: 0; flex: 1;">
      <div id="clock-day" style="font-size: 1.2rem; font-weight: 700; color: #FFFFFF; line-height: 1.2; letter-spacing: 0.01em;">Hari</div>
      <div id="clock-date" style="font-size: 0.725rem; font-weight: 500; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.35rem;">00 JANUARI 0000</div>
      
      <!-- Weather & Location Details -->
      <div id="weather-info" style="font-size: 0.775rem; display: flex; align-items: center; flex-wrap: wrap; gap: 4px; color: #E2E8F0;">
        <span style="color:#FBBF24;">☀️</span> 
        <strong style="color:#FFFFFF; font-weight:700;">28°C</strong> 
        <span style="color:#E2E8F0; font-weight:500;">Cerah</span> 
        <span style="color:rgba(255,255,255,0.25); margin: 0 2px;">·</span> 
        <span style="color:#CBD5E1; font-weight:500;">💧 77%</span> 
        <span style="color:rgba(255,255,255,0.25); margin: 0 2px;">·</span> 
        <span style="color:#94A3B8; font-weight:500;">📍 Surabaya, Jawa Timur</span>
      </div>
    </div>
  </div>
</div>

{{-- Page Header --}}
<div style="margin-bottom:1.5rem; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem;">
  <div>
    <h1 style="font-size:1.375rem;font-weight:700;color:var(--text1);margin:0 0 .25rem;letter-spacing:-.02em;">Overview</h1>
    <p style="font-size:.8125rem;color:var(--text3);margin:0;">Ringkasan data website {{ \App\Models\Setting::get('company_name', config('app.name')) }}</p>
  </div>
  <form method="GET" action="{{ route('admin.dashboard') }}" style="display: flex; gap: 0.5rem; align-items: center;">
    <input type="date" id="dash-start" name="start_date" value="{{ $start_date ?? '' }}" style="padding: 0.5rem 0.75rem; font-size: 0.8rem; background: #fff; border: 1px solid var(--border); border-radius: 50px; color: var(--text1); font-family: inherit; font-weight: 500;">
    <span style="color: var(--text3); font-weight: 500; font-size: 0.8rem;">s/d</span>
    <input type="date" id="dash-end" name="end_date" value="{{ $end_date ?? '' }}" style="padding: 0.5rem 0.75rem; font-size: 0.8rem; background: #fff; border: 1px solid var(--border); border-radius: 50px; color: var(--text1); font-family: inherit; font-weight: 500;">
    <button type="submit" class="btn-primary" style="padding: 0.5rem 1.35rem; font-size: 0.8rem; border-radius: 50px; background: #0F172A; color: #fff; border: none; cursor: pointer; font-weight: 600; box-shadow: 0 4px 12px rgba(15,23,42,0.15); transition: background 0.2s;" onmouseover="this.style.background='#1E293B';" onmouseout="this.style.background='#0F172A';">Filter</button>
    <div style="border-left: 1px solid var(--border); margin: 0 0.25rem; height: 30px;"></div>
    <button type="button" onclick="downloadReport('xls')" class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem; border: 1px solid var(--border); border-radius: 50px; color: var(--text2); background: #fff; cursor: pointer; font-weight: 600; display:flex; gap:0.3rem; align-items:center;" onmouseover="this.style.borderColor='#3B82F6'; this.style.color='#3B82F6';" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text2)';">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg> XLS
    </button>
    <button type="button" onclick="downloadReport('pdf')" class="btn-outline" style="padding: 0.5rem 1rem; font-size: 0.8rem; border: 1px solid var(--border); border-radius: 50px; color: var(--text2); background: #fff; cursor: pointer; font-weight: 600; display:flex; gap:0.3rem; align-items:center;" onmouseover="this.style.borderColor='#EF4444'; this.style.color='#EF4444';" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text2)';">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg> PDF
    </button>
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
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-bottom:2rem;">
  @foreach([
    ['Visitor / Page Views','visitor',$stats['visitor'],'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z','#475569', '#F1F5F9'],
    ['Klik WA','wa_click',$stats['wa_click'],'M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z','#475569', '#F1F5F9'],
    ['Total Leads','leads',$stats['leads'],'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z','#475569', '#F1F5F9'],
    ['Conversion (CTR)','ctr',$stats['ctr'].'%','M13 7h8m0 0v8m0-8l-8 8-4-4-6 6','#475569', '#F1F5F9'],
  ] as $sc)
  <div class="stat-card-anim" style="animation-delay:{{ 0.15 * ($loop->index + 1) }}s;background:#FFFFFF;border-radius:20px;padding:1.5rem;box-shadow:0 4px 15px rgba(0,0,0,0.03);display:flex;flex-direction:column;gap:1rem;transition:transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.06)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.03)';">
    <div style="display:flex;align-items:center;gap:1rem;">
      <div style="background:{{ $sc[5] }};border-radius:12px;width:48px;height:48px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <svg width="24" height="24" fill="none" stroke="{{ $sc[4] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="{{ $sc[3] }}"/></svg>
      </div>
      <div>
        <div style="font-size:0.875rem;color:var(--text3);font-weight:500;margin-bottom:0.2rem;">{{ $sc[0] }}</div>
        <div class="count-up-val" data-target="{{ $sc[2] }}" style="font-size:1.75rem;font-weight:800;color:var(--text1);line-height:1;">0</div>
      </div>
    </div>
  </div>
  @endforeach
</div>

{{-- MIDDLE ROW: Chart + Content Stats --}}
<div style="display:grid;grid-template-columns:1.6fr 1fr;gap:1.5rem;margin-bottom:2rem;">

  {{-- Leads Chart --}}
  <div class="chart-card-anim" style="background:#FFFFFF;border-radius:24px;padding:1.75rem 1.75rem 1.5rem;box-shadow:0 2px 20px rgba(0,0,0,0.04);">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1.75rem;">
      <div>
        <div style="font-size:.8rem;font-weight:700;color:#94A3B8;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.35rem;">Traffic &amp; Leads</div>
        <div style="font-size:1.85rem;font-weight:800;color:#1E293B;line-height:1;"><span class="count-up-val" data-target="{{ $monthLeads }}">0</span> <span style="font-size:.875rem;font-weight:500;color:#94A3B8;">leads bulan ini</span></div>
      </div>
      <div style="display:flex;gap:.625rem;align-items:center;padding:.5rem .875rem;background:#F8FAFC;border-radius:100px;">
        <div style="display:flex;align-items:center;gap:.35rem;font-size:.72rem;font-weight:700;color:#64748B;"><span style="display:inline-block;width:10px;height:3px;background:#A3AED0;border-radius:2px;"></span>Visitor</div>
        <div style="display:flex;align-items:center;gap:.35rem;font-size:.72rem;font-weight:700;color:#64748B;"><span style="display:inline-block;width:10px;height:3px;background:#10B981;border-radius:2px;"></span>WA</div>
        <div style="display:flex;align-items:center;gap:.35rem;font-size:.72rem;font-weight:700;color:#64748B;"><span style="display:inline-block;width:10px;height:3px;background:#3B82F6;border-radius:2px;"></span>Leads</div>
      </div>
    </div>
    <canvas id="leads-chart" height="105"></canvas>
  </div>

  {{-- Content Overview --}}
  <div class="content-card-anim" style="background:#FFFFFF;border-radius:20px;padding:1.5rem;box-shadow:0 4px 15px rgba(0,0,0,0.03);">
    <div style="font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--text3);margin-bottom:1.25rem;">Konten Website</div>
    <div style="display:flex; flex-direction:column; gap:0.5rem;">
    @foreach([
      ['Layanan',route('admin.services.index'),$counts['services'],'#475569','M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z', '#F1F5F9'],
      ['Galeri',route('admin.gallery.index'),$counts['gallery'],'#475569','M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', '#F1F5F9'],
      ['Artikel',route('admin.articles.index'),$counts['articles'],'#475569','M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', '#F1F5F9'],
      ['Klien',route('admin.clients.index'),$counts['clients'],'#475569','M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', '#F1F5F9'],
    ] as $cc)
    <a href="{{ $cc[1] }}" style="display:flex;align-items:center;justify-content:space-between;padding:.75rem 1rem;border-radius:12px;text-decoration:none;transition:background .2s;" onmouseover="this.style.background='var(--bg3)'" onmouseout="this.style.background='transparent'">
      <div style="display:flex;align-items:center;gap:.75rem;">
        <div style="width:36px;height:36px;background:{{ $cc[5] }};border-radius:10px;display:flex;align-items:center;justify-content:center;">
          <svg width="18" height="18" fill="none" stroke="{{ $cc[3] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="{{ $cc[4] }}"/></svg>
        </div>
        <span style="font-size:.875rem;color:var(--text1);font-weight:600;">{{ $cc[0] }}</span>
      </div>
      <div style="display:flex;align-items:center;gap:.5rem;">
        <span class="count-up-val" data-target="{{ $cc[2] }}" style="font-size:1.125rem;font-weight:800;color:#0F172A;">0</span>
        <svg width="14" height="14" fill="none" stroke="var(--text3)" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </a>
    @endforeach
    </div>
  </div>
</div>

{{-- RECENT LEADS TABLE --}}
<div class="table-card-anim" style="background:#FFFFFF;border-radius:20px;box-shadow:0 4px 15px rgba(0,0,0,0.03);overflow:hidden;">
  <div style="display:flex;align-items:center;justify-content:space-between;padding:1.5rem 2rem;border-bottom:1px solid var(--border);">
    <div>
      <div style="font-size:1.125rem;font-weight:700;color:var(--text1);">Checkup progress / Leads</div>
      <div style="font-size:.8rem;color:var(--text3);margin-top:.25rem;">Data Request Order terbaru</div>
    </div>
    <a href="{{ route('admin.leads.index') }}" style="display:inline-flex;align-items:center;gap:.375rem;font-size:.875rem;font-weight:600;color:#3B82F6;text-decoration:none;">
      Lihat Semua
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
  </div>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr>
          @foreach(['Nama','Produk','Telepon','Waktu','Status'] as $h)
          <th style="padding:1rem 2rem;text-align:left;font-size:.75rem;font-weight:700;color:var(--text3);background:var(--bg3);white-space:nowrap; border-bottom:1px solid var(--border);">{{ $h }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse($recentLeads as $lead)
        <tr style="border-bottom:1px solid var(--border);transition:background .2s;" onmouseover="this.style.background='var(--bg3)'" onmouseout="this.style.background='transparent'">
          <td style="padding:1rem 2rem;">
            <div style="font-size:.875rem;font-weight:700;color:var(--text1);">{{ $lead->name }}</div>
            @if($lead->company)<div style="font-size:.75rem;color:var(--text3);margin-top:0.15rem;">{{ $lead->company }}</div>@endif
          </td>
          <td style="padding:1rem 2rem;font-size:.875rem;color:var(--text2);max-width:180px;font-weight:500;">
            <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;">{{ $lead->product ?? '-' }}</span>
          </td>
          <td style="padding:1rem 2rem;font-size:.875rem;color:var(--text2);white-space:nowrap;font-weight:500;">{{ $lead->phone }}</td>
          <td style="padding:1rem 2rem;font-size:.875rem;color:var(--text3);white-space:nowrap;font-weight:500;">{{ $lead->created_at->diffForHumans() }}</td>
          <td style="padding:1rem 2rem;">
            @php
              $sc = match($lead->status){
                'new'=>['#F59E0B','rgba(245, 158, 11, 0.1)','Baru'],
                'contacted'=>['#3B82F6','rgba(59, 130, 246, 0.1)','Dihubungi'],
                'closed'=>['#10B981','rgba(16, 185, 129, 0.1)','Selesai'],
                default=>['#64748B','rgba(100, 116, 139, 0.1)','Lainnya']};
            @endphp
            <span style="background:{{ $sc[1] }};color:{{ $sc[0] }};font-size:.7rem;font-weight:700;padding:.375rem .75rem;border-radius:100px;white-space:nowrap;">{{ $sc[2] }}</span>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" style="padding:3rem;text-align:center;color:var(--text3);font-size:1rem;font-weight:500;">Belum ada leads masuk</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- Quick Actions --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-top:2rem;">
  @foreach([
    ['Tambah Layanan',route('admin.services.create'),'#475569','#F1F5F9','M12 4v16m8-8H4'],
    ['Upload Foto',route('admin.gallery.create'),'#475569','#F1F5F9','M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01'],
    ['Tulis Artikel',route('admin.articles.create'),'#475569','#F1F5F9','M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
    ['Pengaturan WA',route('admin.wa.index'),'#475569','#F1F5F9','M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15'],
  ] as $qa)
  <a href="{{ $qa[1] }}" class="qa-card-anim" style="animation-delay:{{ 0.85 + (0.12 * $loop->index) }}s;background:#FFFFFF;border-radius:16px;padding:1.25rem;display:flex;align-items:center;gap:1rem;text-decoration:none;box-shadow:0 4px 15px rgba(0,0,0,0.03);transition:transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.06)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.03)';">
    <div style="width:42px;height:42px;background:{{ $qa[3] }};border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <svg width="20" height="20" fill="none" stroke="{{ $qa[2] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="{{ $qa[4] }}"/></svg>
    </div>
    <span style="font-size:.9rem;font-weight:700;color:var(--text1);">{{ $qa[0] }}</span>
  </a>
  @endforeach
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Number Count Up Animation (0 to Target over 4s)
function animateCounterUp(el, targetStr, duration = 4000) {
    const isPercent = String(targetStr).includes('%');
    const numericValue = parseFloat(String(targetStr).replace(/[^0-9.]/g, ''));
    if (isNaN(numericValue) || numericValue === 0) {
        el.textContent = targetStr;
        return;
    }

    const isDecimal = String(numericValue).includes('.');
    const decimalPlaces = isDecimal ? (String(numericValue).split('.')[1] || '').length : 0;
    
    let startTime = null;
    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        const progress = Math.min((timestamp - startTime) / duration, 1);
        const easedProgress = 1 - Math.pow(1 - progress, 4); // easeOutQuart
        const currentValue = easedProgress * numericValue;

        let formatted = isDecimal ? currentValue.toFixed(decimalPlaces) : Math.floor(currentValue);
        if (isPercent) formatted += '%';

        el.textContent = formatted;

        if (progress < 1) {
            requestAnimationFrame(step);
        } else {
            el.textContent = targetStr;
        }
    }
    requestAnimationFrame(step);
}

function initDashboardCounters() {
    document.querySelectorAll('.count-up-val').forEach(el => {
        const target = el.getAttribute('data-target');
        if (target !== null) {
            animateCounterUp(el, target, 4000);
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDashboardCounters);
} else {
    initDashboardCounters();
}

// Realtime Clock & Weather Widget with Device Geolocation
function updateDashboardClock() {
    const now = new Date();
    
    const h = String(now.getHours()).padStart(2, '0');
    const m = String(now.getMinutes()).padStart(2, '0');
    const s = String(now.getSeconds()).padStart(2, '0');
    
    const mainElem = document.getElementById('clock-main');
    const secElem = document.getElementById('clock-sec');
    if (mainElem) mainElem.textContent = `${h}:${m}`;
    if (secElem) secElem.textContent = s;
    
    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER'];
    
    const dayElem = document.getElementById('clock-day');
    const dateElem = document.getElementById('clock-date');
    if (dayElem) dayElem.textContent = days[now.getDay()];
    if (dateElem) dateElem.textContent = `${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
}

function getWeatherIconAndDesc(code) {
    if (code === 0) return { icon: '☀️', desc: 'Cerah' };
    if (code >= 1 && code <= 3) return { icon: '⛅', desc: 'Cerah Berawan' };
    if (code === 45 || code === 48) return { icon: '🌫️', desc: 'Berkabut' };
    if (code >= 51 && code <= 57) return { icon: '🌧️', desc: 'Gerimis' };
    if (code >= 61 && code <= 67) return { icon: '🌧️', desc: 'Hujan' };
    if (code >= 71 && code <= 77) return { icon: '❄️', desc: 'Salju' };
    if (code >= 80 && code <= 82) return { icon: '🌧️', desc: 'Hujan Lebat' };
    if (code >= 95 && code <= 99) return { icon: '⛈️', desc: 'Hujan Petir' };
    return { icon: '🌤️', desc: 'Cerah' };
}

async function loadWeatherAndLocation(lat, lon, fallbackCity = null) {
    try {
        let locationLabel = fallbackCity;
        if (!locationLabel) {
            try {
                const geoRes = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`);
                if (geoRes.ok) {
                    const geoData = await geoRes.json();
                    const addr = geoData.address || {};
                    const city = addr.city || addr.regency || addr.town || addr.county || addr.city_district || addr.municipality || '';
                    const state = addr.state || addr.region || '';
                    if (city && state) {
                        locationLabel = `${city}, ${state}`;
                    } else if (city) {
                        locationLabel = city;
                    } else if (state) {
                        locationLabel = state;
                    }
                }
            } catch (geoErr) {
                console.warn('Reverse geocoding error:', geoErr);
            }
        }
        if (!locationLabel) locationLabel = 'Surabaya, Jawa Timur';

        const weatherRes = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true&hourly=relative_humidity_2m&timezone=auto`);
        if (weatherRes.ok) {
            const wData = await weatherRes.json();
            const current = wData.current_weather;
            const temp = Math.round(current.temperature);
            const wInfo = getWeatherIconAndDesc(current.weathercode);
            
            let humidity = 77;
            if (wData.hourly && wData.hourly.relative_humidity_2m) {
                const currentHour = new Date().getHours();
                humidity = wData.hourly.relative_humidity_2m[currentHour] ?? 77;
            }

            const weatherElem = document.getElementById('weather-info');
            if (weatherElem) {
                weatherElem.innerHTML = `
                    <span style="color:#FBBF24;">${wInfo.icon}</span> 
                    <strong style="color:#FFFFFF; font-weight:700;">${temp}°C</strong> 
                    <span style="color:#E2E8F0; font-weight:500;">${wInfo.desc}</span> 
                    <span style="color:rgba(255,255,255,0.25); margin: 0 2px;">·</span> 
                    <span style="color:#CBD5E1; font-weight:500;">💧 ${humidity}%</span> 
                    <span style="color:rgba(255,255,255,0.25); margin: 0 2px;">·</span> 
                    <span style="color:#94A3B8; font-weight:500;">📍 ${locationLabel}</span>
                `;
            }
        }
    } catch (err) {
        console.error('Weather fetching error:', err);
    }
}

function initDashboardWeather() {
    updateDashboardClock();
    setInterval(updateDashboardClock, 1000);

    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            function(pos) {
                loadWeatherAndLocation(pos.coords.latitude, pos.coords.longitude);
            },
            function(err) {
                console.warn('Geolocation denied or failed, using fallback location:', err);
                loadWeatherAndLocation(-7.2575, 112.7521, 'Surabaya, Jawa Timur');
            },
            { enableHighAccuracy: true, timeout: 8000 }
        );
    } else {
        loadWeatherAndLocation(-7.2575, 112.7521, 'Surabaya, Jawa Timur');
    }
}

initDashboardWeather();

// ─── PREMIUM CHART CONFIG ───
Chart.defaults.font.family = "'Inter','Segoe UI',sans-serif";

// Crosshair plugin
const crosshairPlugin = {
  id: 'crosshair',
  afterDraw(chart) {
    if (chart.tooltip._active && chart.tooltip._active.length) {
      const ctx = chart.ctx;
      const x = chart.tooltip._active[0].element.x;
      ctx.save();
      ctx.beginPath();
      ctx.moveTo(x, chart.scales.y.top);
      ctx.lineTo(x, chart.scales.y.bottom);
      ctx.lineWidth = 1;
      ctx.strokeStyle = 'rgba(59,130,246,0.2)';
      ctx.setLineDash([5, 4]);
      ctx.stroke();
      ctx.restore();
    }
  }
};
Chart.register(crosshairPlugin);

// Build gradients
const dashCtx = document.getElementById('leads-chart').getContext('2d');
const gVisitor = dashCtx.createLinearGradient(0, 0, 0, 280);
gVisitor.addColorStop(0, 'rgba(163,174,208,0.20)');
gVisitor.addColorStop(1, 'rgba(163,174,208,0.00)');

const gWa = dashCtx.createLinearGradient(0, 0, 0, 280);
gWa.addColorStop(0, 'rgba(16,185,129,0.15)');
gWa.addColorStop(1, 'rgba(16,185,129,0.00)');

const gLeads = dashCtx.createLinearGradient(0, 0, 0, 280);
gLeads.addColorStop(0, 'rgba(59,130,246,0.25)');
gLeads.addColorStop(1, 'rgba(59,130,246,0.00)');

new Chart(dashCtx, {
  type: 'line',
  data: {
    labels: {!! json_encode($labels) !!},
    datasets: [
      {
        label: 'Visitor',
        data: {!! json_encode($visitorValues) !!},
        borderColor: '#A3AED0',
        backgroundColor: gVisitor,
        borderWidth: 2.5,
        tension: 0.45,
        fill: true,
        pointRadius: 0,
        pointHoverRadius: 5,
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#A3AED0',
        pointHoverBorderWidth: 2.5,
      },
      {
        label: 'WA Click',
        data: {!! json_encode($waValues) !!},
        borderColor: '#10B981',
        backgroundColor: gWa,
        borderWidth: 2.5,
        tension: 0.45,
        fill: true,
        pointRadius: 0,
        pointHoverRadius: 5,
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#10B981',
        pointHoverBorderWidth: 2.5,
      },
      {
        label: 'Leads',
        data: {!! json_encode($values) !!},
        borderColor: '#3B82F6',
        backgroundColor: gLeads,
        borderWidth: 2.5,
        tension: 0.45,
        fill: true,
        pointRadius: 0,
        pointHoverRadius: 6,
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#3B82F6',
        pointHoverBorderWidth: 2.5,
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: true,
    animation: {
      duration: 4000,
      easing: 'easeOutQuart'
    },
    interaction: { mode: 'index', intersect: false },
    plugins: {
      legend: { display: false },
      tooltip: {
        enabled: true,
        backgroundColor: '#FFFFFF',
        titleColor: '#1E293B',
        bodyColor: '#64748B',
        borderColor: '#E4E7F0',
        borderWidth: 1,
        padding: { x: 14, y: 10 },
        cornerRadius: 12,
        titleFont: { size: 12, weight: '700' },
        bodyFont: { size: 12, weight: '600' },
        callbacks: {
          label: function(ctx) {
            const dots = { 'Visitor': '⬤ ', 'WA Click': '⬤ ', 'Leads': '⬤ ' };
            return `  ${ctx.parsed.y}  ${ctx.dataset.label}`;
          }
        }
      }
    },
    scales: {
      x: {
        grid: { display: false },
        border: { display: false },
        ticks: { color: '#94A3B8', font: { size: 11 }, maxRotation: 0, maxTicksLimit: 8 }
      },
      y: {
        grid: { color: '#F1F5F9', lineWidth: 1, borderDash: [5, 4] },
        border: { display: false },
        ticks: { color: '#94A3B8', font: { size: 11 }, stepSize: 1, precision: 0 }
      }
    }
  }
});
</script>
@endpush
@endsection
