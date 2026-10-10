<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Article;

class GenerateSitemap extends Command
{
    protected $signature   = 'sitemap:generate';
    protected $description = 'Generate physical sitemap.xml in public_html/';

    public function handle(): int
    {
        $base  = rtrim(config('app.url', 'https://pusatpiringkeramik.com'), '/');
        $today = now()->toDateString();

        $entries = [
            [$base,               '1.0',  'weekly',  $today],
            [$base . '/about',    '0.8',  'monthly', $today],
            [$base . '/product',  '0.9',  'weekly',  $today],
            [$base . '/articles', '0.8',  'daily',   $today],
            [$base . '/contact',  '0.7',  'monthly', $today],
        ];

        try {
            foreach (ServiceCategory::all(['slug', 'updated_at']) as $c) {
                $entries[] = [
                    $base . '/k/' . $c->slug, '0.85', 'weekly',
                    optional($c->updated_at)->toDateString() ?? $today,
                ];
            }
            foreach (Service::active()->ordered()->get(['slug', 'updated_at']) as $s) {
                $entries[] = [
                    $base . '/product/' . $s->slug, '0.85', 'monthly',
                    optional($s->updated_at)->toDateString() ?? $today,
                ];
            }
            foreach (Article::published()->latest()->get(['slug', 'updated_at']) as $a) {
                $entries[] = [
                    $base . '/articles/' . $a->slug, '0.7', 'monthly',
                    optional($a->updated_at)->toDateString() ?? $today,
                ];
            }
        } catch (\Throwable $e) {
            $this->warn('DB unavailable, using static pages only: ' . $e->getMessage());
        }

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as [$loc, $priority, $changefreq, $lastmod]) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'         . htmlspecialchars($loc, ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= '    <lastmod>'     . $lastmod      . "</lastmod>\n";
            $xml .= '    <changefreq>'  . $changefreq   . "</changefreq>\n";
            $xml .= '    <priority>'    . $priority     . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        // Write to public/ — gets symlinked / copied to public_html by deploy
        $dest = public_path('sitemap.xml');
        file_put_contents($dest, $xml);
        $this->info("Sitemap generated: {$dest} (" . count($entries) . ' URLs)');

        // Also try public_html/ directly if it exists
        $altDest = base_path('../public_html/sitemap.xml');
        if (is_dir(dirname($altDest))) {
            file_put_contents($altDest, $xml);
            $this->info("Copied to: {$altDest}");
        }

        return self::SUCCESS;
    }
}
