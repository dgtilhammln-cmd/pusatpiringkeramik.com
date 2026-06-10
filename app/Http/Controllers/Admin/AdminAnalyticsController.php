<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;

class AdminAnalyticsController extends Controller
{
    public function index()
    {
        return view('admin.analytics.index');
    }

    public function data(Request $request)
    {
        $period = $request->input('period', '30');
        $from   = match($period) {
            '7'      => now()->subDays(6)->startOfDay(),
            '30'     => now()->subDays(29)->startOfDay(),
            '365'    => now()->subDays(364)->startOfDay(),
            'custom' => \Carbon\Carbon::parse($request->input('from'))->startOfDay(),
            default  => now()->subDays(29)->startOfDay(),
        };
        $to = $period === 'custom'
            ? \Carbon\Carbon::parse($request->input('to'))->endOfDay()
            : now()->endOfDay();

        $types = ['pageview', 'wa_click'];
        $summary = [];
        foreach ($types as $type) {
            $summary[$type] = AnalyticsEvent::ofType($type)->whereBetween('created_at', [$from, $to])->count();
        }

        $leadsCount = \App\Models\Lead::whereBetween('created_at', [$from, $to])->count();
        $summary['leads'] = $leadsCount;
        $summary['ctr'] = $summary['pageview'] > 0 ? round(($leadsCount / $summary['pageview']) * 100, 2) : 0;

        // Daily chart
        $daily = AnalyticsEvent::ofType('pageview')
            ->whereBetween('created_at', [$from, $to])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')->orderBy('date')
            ->pluck('count', 'date');

        $days   = (int) $from->diffInDays($to) + 1;
        $labels = [];
        $values = [];
        for ($i = 0; $i < $days; $i++) {
            $date     = $from->copy()->addDays($i)->format('Y-m-d');
            $labels[] = $from->copy()->addDays($i)->format('d/m');
            $values[] = $daily[$date] ?? 0;
        }

        // Device breakdown
        $devices = AnalyticsEvent::ofType('pageview')
            ->whereBetween('created_at', [$from, $to])
            ->selectRaw('device_type, COUNT(*) as count')
            ->groupBy('device_type')
            ->pluck('count', 'device_type');

        // Top pages
        $topPages = AnalyticsEvent::ofType('pageview')
            ->whereBetween('created_at', [$from, $to])
            ->selectRaw('page_url, COUNT(*) as views')
            ->groupBy('page_url')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        return response()->json([
            'summary'   => $summary,
            'labels'    => $labels,
            'values'    => $values,
            'devices'   => $devices,
            'top_pages' => $topPages,
        ]);
    }
}
