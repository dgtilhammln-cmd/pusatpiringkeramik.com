<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Article;

class SitemapController extends Controller
{
    public function index()
    {
        $services = Service::active()->get(['slug', 'updated_at']);
        $articles = Article::published()->get(['slug', 'updated_at']);

        $staticPages = [
            ['url' => route('home'),     'priority' => '1.0', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => route('about'),    'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['url' => route('services'), 'priority' => '0.9', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => route('gallery'),  'priority' => '0.7', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => route('articles'), 'priority' => '0.8', 'changefreq' => 'daily',   'lastmod' => now()->toDateString()],
            ['url' => route('contact'),  'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
        ];

        $serviceUrls = $services->map(fn($s) => [
            'url'        => route('services.show', $s->slug),
            'priority'   => '0.8',
            'changefreq' => 'monthly',
            'lastmod'    => $s->updated_at->toDateString(),
        ])->toArray();

        $articleUrls = $articles->map(fn($a) => [
            'url'        => route('articles.show', $a->slug),
            'priority'   => '0.7',
            'changefreq' => 'monthly',
            'lastmod'    => $a->updated_at->toDateString(),
        ])->toArray();

        $urls = array_merge($staticPages, $serviceUrls, $articleUrls);

        $content = view('sitemap', compact('urls'))->render();

        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
