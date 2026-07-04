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

class AdminDashboardController extends Controller
{
    public function index()
    {
        $now  = now();
        $from = $now->copy()->subDays(29)->startOfDay();
        $to   = $now->copy()->endOfDay();

        // Analytics stats (30 days)
        $stats = [
            'pageviews'    => AnalyticsEvent::ofType('pageview')->whereBetween('created_at',[$from,$to])->count(),
            'wa_clicks'    => AnalyticsEvent::ofType('wa_click')->whereBetween('created_at',[$from,$to])->count(),
            'phone_clicks' => AnalyticsEvent::ofType('phone_click')->whereBetween('created_at',[$from,$to])->count(),
            'email_clicks' => AnalyticsEvent::ofType('email_click')->whereBetween('created_at',[$from,$to])->count(),
        ];

        // Leads daily chart (30 days)
        $leadsChart = Lead::whereBetween('created_at',[$from,$to])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')->orderBy('date')
            ->pluck('count','date');

        $labels = [];
        $values = [];
        for ($i = 29; $i >= 0; $i--) {
            $date     = $now->copy()->subDays($i)->format('Y-m-d');
            $labels[] = $now->copy()->subDays($i)->format('d/m');
            $values[] = $leadsChart[$date] ?? 0;
        }

        // Top pages
        $topPages = AnalyticsEvent::ofType('pageview')
            ->whereBetween('created_at',[$from,$to])
            ->selectRaw('page_url, COUNT(*) as views')
            ->groupBy('page_url')->orderByDesc('views')->limit(8)->get();

        // Content counts
        $counts = [
            'services' => Service::count(),
            'articles' => Article::count(),
            'gallery'  => GalleryProject::count(),
            'clients'  => Client::count(),
        ];

        // Recent leads
        $recentLeads = Lead::orderByDesc('created_at')->limit(8)->get();

        return view('admin.dashboard.index', compact('stats','labels','values','topPages','counts','recentLeads'));
    }
}
