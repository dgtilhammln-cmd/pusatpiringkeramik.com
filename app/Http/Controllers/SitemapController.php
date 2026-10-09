<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Article;

class SitemapController extends Controller
{
    public function xml()
    {
        $base = rtrim(config('app.url', 'https://pusatpiringkeramik.com'), '/');
        $today = now()->toDateString();

        // Static pages
        $entries = [
            [$base,                  '1.0', 'weekly',  $today],
            [$base . '/about',       '0.8', 'monthly', $today],
            [$base . '/product',     '0.9', 'weekly',  $today],
            [$base . '/articles',    '0.8', 'daily',   $today],
            [$base . '/contact',     '0.7', 'monthly', $today],
        ];

        // Dynamic pages — wrapped in try/catch so sitemap still works if DB is down
        try {
            foreach (ServiceCategory::all(['slug', 'updated_at']) as $c) {
                $entries[] = [
                    $base . '/k/' . $c->slug,
                    '0.85', 'weekly',
                    $c->updated_at ? $c->updated_at->toDateString() : $today,
                ];
            }
            foreach (Service::active()->ordered()->get(['slug', 'updated_at']) as $s) {
                $entries[] = [
                    $base . '/product/' . $s->slug,
                    '0.85', 'monthly',
                    $s->updated_at ? $s->updated_at->toDateString() : $today,
                ];
            }
            foreach (Article::published()->latest()->get(['slug', 'updated_at']) as $a) {
                $entries[] = [
                    $base . '/articles/' . $a->slug,
                    '0.7', 'monthly',
                    $a->updated_at ? $a->updated_at->toDateString() : $today,
                ];
            }
        } catch (\Throwable $e) {
            // DB unavailable — static pages only, no crash
        }

        // Build XML — pure PHP string, absolutely zero whitespace before <?xml
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
             . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as [$loc, $priority, $changefreq, $lastmod]) {
            $xml .= '  <url>' . "\n"
                  . '    <loc>'         . htmlspecialchars($loc, ENT_XML1) . '</loc>'         . "\n"
                  . '    <lastmod>'     . $lastmod                         . '</lastmod>'     . "\n"
                  . '    <changefreq>'  . $changefreq                      . '</changefreq>'  . "\n"
                  . '    <priority>'    . $priority                        . '</priority>'    . "\n"
                  . '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
