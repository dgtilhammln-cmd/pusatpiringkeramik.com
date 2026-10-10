<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Article;

class SitemapController extends Controller
{
    /**
     * Build the raw XML sitemap string.
     * Pure PHP string concatenation — zero Blade rendering, zero leading whitespace.
     */
    public static function buildXml(): string
    {
        $base = 'https://pusatpiringkeramik.com';

        // ── Static pages with dynamic file modification date ────────────────
        $viewsPath = resource_path('views');
        $fileModDate = function (string $relPath) use ($viewsPath) {
            $full = $viewsPath . '/' . ltrim($relPath, '/');
            return file_exists($full) ? date('Y-m-d', filemtime($full)) : date('Y-m-d');
        };

        $entries = [
            [$base,               $fileModDate('home/index.blade.php')],
            [$base . '/about',    $fileModDate('about/index.blade.php')],
            [$base . '/product',  $fileModDate('services/index.blade.php')],
            [$base . '/gallery',  $fileModDate('gallery/index.blade.php')],
            [$base . '/articles', $fileModDate('articles/index.blade.php')],
            [$base . '/contact',  $fileModDate('contact/index.blade.php')],
        ];

        // ── Dynamic pages from DB ────────────────────────────────────────────
        $today = date('Y-m-d');
        try {
            foreach (ServiceCategory::all(['slug', 'updated_at']) as $c) {
                if (!empty($c->slug)) {
                    $entries[] = [
                        $base . '/k/' . $c->slug,
                        optional($c->updated_at)->toDateString() ?? $today,
                    ];
                }
            }

            foreach (Service::active()->ordered()->get(['slug', 'updated_at']) as $s) {
                if (!empty($s->slug)) {
                    $entries[] = [
                        $base . '/product/' . $s->slug,
                        optional($s->updated_at)->toDateString() ?? $today,
                    ];
                }
            }

            foreach (Article::published()->latest()->get(['slug', 'updated_at', 'published_at']) as $a) {
                if (!empty($a->slug)) {
                    $lastmod = optional($a->updated_at ?? $a->published_at)->toDateString() ?? $today;
                    $entries[] = [
                        $base . '/articles/' . $a->slug,
                        $lastmod,
                    ];
                }
            }
        } catch (\Throwable $e) {
            // DB fallback: keep static pages
        }

        // ── Build XML string ─────────────────────────────────────────────────
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as [$loc, $lastmod]) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= '    <lastmod>' . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8') . "</lastmod>\n";
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
        ob_start();
        ob_end_clean();

        $xml = self::buildXml();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}

