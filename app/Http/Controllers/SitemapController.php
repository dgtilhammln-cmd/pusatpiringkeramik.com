<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Article;
use App\Models\GalleryProject;
use App\Models\Setting;

class SitemapController extends Controller
{
    /**
     * Build the raw XML sitemap string.
     * Pure PHP string concatenation — zero Blade rendering, zero leading whitespace.
     */
    public static function buildXml(): string
    {
        $base = rtrim(config('app.url', 'https://pusatpiringkeramik.com'), '/');
        try {
            $dbUrl = Setting::get('app_url');
            if (!empty($dbUrl)) {
                $base = rtrim($dbUrl, '/');
            }
        } catch (\Throwable $e) {
            // Use config app.url as fallback
        }

        // ── Static pages with dynamic file modification date ────────────────
        $viewsPath = resource_path('views');
        $fileModDate = function (string $relPath) use ($viewsPath) {
            $full = $viewsPath . '/' . ltrim($relPath, '/');
            return file_exists($full) ? date('Y-m-d', filemtime($full)) : date('Y-m-d');
        };

        // Format: [$loc, $lastmod, $changefreq, $priority]
        $entries = [
            [$base,               $fileModDate('home/index.blade.php'),     'daily',   '1.0'],
            [$base . '/about',    $fileModDate('about/index.blade.php'),    'monthly', '0.8'],
            [$base . '/product',  $fileModDate('services/index.blade.php'), 'daily',   '0.9'],
            [$base . '/gallery',  $fileModDate('gallery/index.blade.php'),  'weekly',  '0.8'],
            [$base . '/articles', $fileModDate('articles/index.blade.php'), 'daily',   '0.8'],
            [$base . '/contact',  $fileModDate('contact/index.blade.php'),  'monthly', '0.7'],
        ];

        // ── Dynamic pages from DB ────────────────────────────────────────────
        $today = date('Y-m-d');
        try {
            foreach (ServiceCategory::all(['slug', 'updated_at']) as $c) {
                if (!empty($c->slug)) {
                    $entries[] = [
                        $base . '/k/' . $c->slug,
                        optional($c->updated_at)->toDateString() ?? $today,
                        'weekly',
                        '0.8',
                    ];
                }
            }

            foreach (Service::active()->ordered()->get(['slug', 'updated_at']) as $s) {
                if (!empty($s->slug)) {
                    $entries[] = [
                        $base . '/product/' . $s->slug,
                        optional($s->updated_at)->toDateString() ?? $today,
                        'weekly',
                        '0.8',
                    ];
                }
            }

            foreach (Article::published()->latest()->get(['slug', 'updated_at', 'published_at']) as $a) {
                if (!empty($a->slug)) {
                    $lastmod = optional($a->updated_at ?? $a->published_at)->toDateString() ?? $today;
                    $entries[] = [
                        $base . '/articles/' . $a->slug,
                        $lastmod,
                        'monthly',
                        '0.7',
                    ];
                }
            }

            foreach (GalleryProject::active()->published()->ordered()->get(['slug', 'updated_at']) as $g) {
                if (!empty($g->slug)) {
                    $entries[] = [
                        $base . '/gallery/' . $g->slug,
                        optional($g->updated_at)->toDateString() ?? $today,
                        'monthly',
                        '0.6',
                    ];
                }
            }
        } catch (\Throwable $e) {
            // DB fallback: keep static pages
        }

        // ── Build XML string ─────────────────────────────────────────────────
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as [$loc, $lastmod, $changefreq, $priority]) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= '    <lastmod>' . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8') . "</lastmod>\n";
            $xml .= '    <changefreq>' . $changefreq . "</changefreq>\n";
            $xml .= '    <priority>' . $priority . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Serve dynamic XML sitemap with correct Content-Type header.
     */
    public function xml()
    {
        if (ob_get_level()) {
            ob_end_clean();
        }

        $xml = self::buildXml();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}


