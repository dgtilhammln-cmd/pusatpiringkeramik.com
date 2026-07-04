<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Article;
use App\Models\GalleryProject;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::active()->ordered()->get(['slug', 'name', 'updated_at']);
        $articles = Article::published()->latest()->get(['slug', 'title', 'updated_at']);
        $staticPages = [
            ['url' => route('home'),     'label' => 'Beranda',        'priority' => '1.0', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => route('about'),    'label' => 'Tentang Kami',   'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['url' => route('products'), 'label' => 'Produk',         'priority' => '0.9', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => route('articles'), 'label' => 'Artikel',        'priority' => '0.8', 'changefreq' => 'daily',   'lastmod' => now()->toDateString()],
            ['url' => route('contact'),  'label' => 'Kontak',         'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
        ];

        $serviceUrls = $services->map(fn($s) => [
            'url'        => route('products.show', $s->slug),
            'label'      => $s->name,
            'priority'   => '0.85',
            'changefreq' => 'monthly',
            'lastmod'    => $s->updated_at->toDateString(),
        ])->toArray();

        $articleUrls = $articles->map(fn($a) => [
            'url'        => route('articles.show', $a->slug),
            'label'      => $a->title,
            'priority'   => '0.7',
            'changefreq' => 'monthly',
            'lastmod'    => $a->updated_at->toDateString(),
        ])->toArray();

        $urls = array_merge($staticPages, $serviceUrls, $articleUrls);

        // If /sitemap is requested (HTML view)
        if ($request->is('sitemap')) {
            return view('sitemap-html', compact('staticPages', 'serviceUrls', 'articleUrls', 'urls'));
        }

        // Default: return XML for crawlers
        $content = view('sitemap', compact('urls'))->render();
        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
