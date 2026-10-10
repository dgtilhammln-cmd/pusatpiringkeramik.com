<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Article;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap.
     * Pure PHP string — ZERO Blade rendering, ZERO whitespace before <?xml.
     * Includes all products, categories, and articles from DB.
     */
    public function xml()
    {
        $base  = rtrim(config('app.url', 'https://pusatpiringkeramik.com'), '/');
        $today = now()->toDateString();

        // ── Static pages ────────────────────────────────────────────────────
        $entries = [
            [$base,                  '1.0', 'weekly',  $today],
            [$base . '/about',       '0.8', 'monthly', $today],
            [$base . '/product',     '0.9', 'weekly',  $today],
            [$base . '/articles',    '0.8', 'daily',   $today],
            [$base . '/contact',     '0.7', 'monthly', $today],
        ];

        // ── Dynamic pages from DB ────────────────────────────────────────────
        // Wrapped in try/catch so sitemap never crashes if DB is temporarily down
        try {
            foreach (ServiceCategory::all(['slug', 'updated_at']) as $c) {
                $entries[] = [
                    $base . '/k/' . $c->slug,
                    '0.85', 'weekly',
                    optional($c->updated_at)->toDateString() ?? $today,
                ];
            }

            foreach (Service::active()->ordered()->get(['slug', 'updated_at']) as $s) {
                $entries[] = [
                    $base . '/product/' . $s->slug,
                    '0.85', 'monthly',
                    optional($s->updated_at)->toDateString() ?? $today,
                ];
            }

            foreach (Article::published()->latest()->get(['slug', 'updated_at']) as $a) {
                $entries[] = [
                    $base . '/articles/' . $a->slug,
                    '0.7', 'monthly',
                    optional($a->updated_at)->toDateString() ?? $today,
                ];
            }
        } catch (\Throwable $e) {
            // DB unavailable — serve static pages only, never crash
        }

        // ── Build XML — pure PHP string concatenation ────────────────────────
        // ob_start/ob_end_clean ensures absolutely no accidental output before us
        ob_start();
        ob_end_clean();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as [$loc, $priority, $changefreq, $lastmod]) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>'        . htmlspecialchars($loc, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>'        . "\n";
            $xml .= '    <lastmod>'    . htmlspecialchars($lastmod)                              . '</lastmod>'    . "\n";
            $xml .= '    <changefreq>' . htmlspecialchars($changefreq)                           . '</changefreq>' . "\n";
            $xml .= '    <priority>'   . htmlspecialchars($priority)                             . '</priority>'   . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'text/xml; charset=utf-8')
            ->header('X-Robots-Tag', 'noindex')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
