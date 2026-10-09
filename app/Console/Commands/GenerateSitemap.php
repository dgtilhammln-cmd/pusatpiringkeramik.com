<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Article;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate physical static sitemap.xml file into public and public_html';

    public function handle()
    {
        $siteUrl = rtrim(config('app.url', 'https://pusatpiringkeramik.com'), '/');
        if (!str_starts_with($siteUrl, 'http')) {
            $siteUrl = 'https://pusatpiringkeramik.com';
        }

        $categories = ServiceCategory::all(['slug', 'updated_at']);
        $services   = Service::active()->ordered()->get(['slug', 'updated_at']);
        $articles   = Article::published()->latest()->get(['slug', 'updated_at']);

        $urls = [
            ['url' => $siteUrl,                  'priority' => '1.0', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => $siteUrl . '/about',       'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['url' => $siteUrl . '/product',     'priority' => '0.9', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => $siteUrl . '/articles',    'priority' => '0.8', 'changefreq' => 'daily',   'lastmod' => now()->toDateString()],
            ['url' => $siteUrl . '/contact',     'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
        ];

        foreach ($categories as $c) {
            $urls[] = [
                'url'        => $siteUrl . '/k/' . $c->slug,
                'priority'   => '0.85',
                'changefreq' => 'weekly',
                'lastmod'    => $c->updated_at ? $c->updated_at->toDateString() : now()->toDateString(),
            ];
        }

        foreach ($services as $s) {
            $urls[] = [
                'url'        => $siteUrl . '/product/' . $s->slug,
                'priority'   => '0.85',
                'changefreq' => 'monthly',
                'lastmod'    => $s->updated_at ? $s->updated_at->toDateString() : now()->toDateString(),
            ];
        }

        foreach ($articles as $a) {
            $urls[] = [
                'url'        => $siteUrl . '/articles/' . $a->slug,
                'priority'   => '0.7',
                'changefreq' => 'monthly',
                'lastmod'    => $a->updated_at ? $a->updated_at->toDateString() : now()->toDateString(),
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $u) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($u['url']) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . $u['lastmod'] . '</lastmod>' . "\n";
            $xml .= '    <changefreq>' . $u['changefreq'] . '</changefreq>' . "\n";
            $xml .= '    <priority>' . $u['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>' . "\n";

        $paths = [
            public_path('sitemap.xml'),
            base_path('public_html/sitemap.xml'),
        ];

        foreach ($paths as $path) {
            @file_put_contents($path, $xml);
            $this->info("Generated static sitemap at: {$path}");
        }

        $this->info("Sitemap successfully generated (" . count($urls) . " URLs).");
        return 0;
    }
}
