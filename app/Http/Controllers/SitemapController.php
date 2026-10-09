<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Article;
use App\Models\Setting;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        $categories = ServiceCategory::all(['slug', 'name', 'updated_at']);
        $services   = Service::active()->ordered()->get(['slug', 'name', 'updated_at']);
        $articles   = Article::published()->latest()->get(['slug', 'title', 'updated_at']);

        // Dynamic app & company info from settings
        $companyName    = Setting::getAppName();
        $companyTagline = Setting::get('company_tagline', '');
        $addressFull    = Setting::get('address_full', '');
        $siteUrl        = rtrim(config('app.url', 'https://pusatpiringkeramik.com'), '/');

        $staticPages = [
            ['url' => $siteUrl,                  'label' => 'Beranda',      'priority' => '1.0', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => $siteUrl . '/about',       'label' => 'Tentang Kami', 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['url' => $siteUrl . '/product',     'label' => 'Produk',       'priority' => '0.9', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => $siteUrl . '/articles',    'label' => 'Artikel',      'priority' => '0.8', 'changefreq' => 'daily',   'lastmod' => now()->toDateString()],
            ['url' => $siteUrl . '/contact',     'label' => 'Kontak',       'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
        ];

        $categoryUrls = $categories->map(fn($c) => [
            'url'        => $siteUrl . '/k/' . $c->slug,
            'label'      => 'Kategori: ' . $c->name,
            'priority'   => '0.85',
            'changefreq' => 'weekly',
            'lastmod'    => $c->updated_at ? $c->updated_at->toDateString() : now()->toDateString(),
        ])->toArray();

        $serviceUrls = $services->map(fn($s) => [
            'url'        => $siteUrl . '/product/' . $s->slug,
            'label'      => $s->name,
            'priority'   => '0.85',
            'changefreq' => 'monthly',
            'lastmod'    => $s->updated_at->toDateString(),
        ])->toArray();

        $articleUrls = $articles->map(fn($a) => [
            'url'        => $siteUrl . '/articles/' . $a->slug,
            'label'      => $a->title,
            'priority'   => '0.7',
            'changefreq' => 'monthly',
            'lastmod'    => $a->updated_at->toDateString(),
        ])->toArray();

        $urls = array_merge($staticPages, $categoryUrls, $serviceUrls, $articleUrls);

        // HTML view
        if ($request->is('sitemap')) {
            return view('sitemap-html', compact(
                'staticPages', 'categoryUrls', 'serviceUrls', 'articleUrls', 'urls',
                'companyName', 'companyTagline', 'addressFull', 'siteUrl'
            ));
        }

        // XML for crawlers — pass company name for schema
        $content = view('sitemap', compact('urls', 'companyName', 'siteUrl'))->render();
        return response($content, 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
