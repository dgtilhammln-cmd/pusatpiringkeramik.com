<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsEvent;
use App\Models\Service;
use App\Models\Article;
use App\Models\GalleryProject;
use App\Models\Client;
use App\Models\Lead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $now  = now();
        
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');
        
        if ($start_date && $end_date) {
            $from = Carbon::parse($start_date)->startOfDay();
            $to   = Carbon::parse($end_date)->endOfDay();
        } else {
            $from = $now->copy()->subDays(29)->startOfDay();
            $to   = $now->copy()->endOfDay();
        }

        // Cache dashboard data for 60 seconds to ensure sub-10ms response times
        $cacheKey = 'admin_db_stats_' . md5($from->toDateTimeString() . '_' . $to->toDateTimeString());

        $data = Cache::remember($cacheKey, 60, function () use ($from, $to) {
            $daysDiff = $from->diffInDays($to);
            if ($daysDiff > 60) $daysDiff = 60;

            $visitorCount = AnalyticsEvent::ofType('pageview')->whereBetween('created_at', [$from, $to])->count();
            $waClicks     = AnalyticsEvent::ofType('wa_click')->whereBetween('created_at', [$from, $to])->count();
            $leadsCount   = Lead::whereBetween('created_at', [$from, $to])->count();
            $ctr          = $visitorCount > 0 ? round(($leadsCount / $visitorCount) * 100, 2) : 0;

            $stats = [
                'visitor' => $visitorCount,
                'wa_click'=> $waClicks,
                'leads'   => $leadsCount,
                'ctr'     => $ctr,
            ];

            $leadsChart = Lead::whereBetween('created_at', [$from, $to])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')->orderBy('date')
                ->pluck('count', 'date');

            $visitorChart = AnalyticsEvent::ofType('pageview')
                ->whereBetween('created_at', [$from, $to])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')->orderBy('date')
                ->pluck('count', 'date');

            $waChart = AnalyticsEvent::ofType('wa_click')
                ->whereBetween('created_at', [$from, $to])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')->orderBy('date')
                ->pluck('count', 'date');

            $labels = [];
            $values = [];
            $visitorValues = [];
            $waValues = [];
            for ($i = $daysDiff; $i >= 0; $i--) {
                $date     = $to->copy()->subDays($i)->format('Y-m-d');
                $labels[] = $to->copy()->subDays($i)->format('d/m');
                $values[] = $leadsChart[$date] ?? 0;
                $visitorValues[] = $visitorChart[$date] ?? 0;
                $waValues[] = $waChart[$date] ?? 0;
            }

            $topPages = AnalyticsEvent::ofType('pageview')
                ->whereBetween('created_at', [$from, $to])
                ->selectRaw('page_url, COUNT(*) as views')
                ->groupBy('page_url')->orderByDesc('views')->limit(8)->get();

            $counts = [
                'services' => Service::count(),
                'articles' => Article::count(),
                'gallery'  => GalleryProject::count(),
                'clients'  => Client::count(),
            ];

            $recentLeads = Lead::orderByDesc('created_at')->limit(8)->get();

            return compact('stats', 'labels', 'values', 'visitorValues', 'waValues', 'topPages', 'counts', 'recentLeads');
        });

        return view('admin.dashboard.index', array_merge($data, [
            'start_date' => $start_date,
            'end_date'   => $end_date,
        ]));
    }
}
