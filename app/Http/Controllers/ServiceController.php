<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use App\Models\WaSetting;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();
        $settings = Setting::getAllAsArray();

        $seo = [
            'title'       => 'Produk & Layanan Crane, Hoist & Lift | CV. Karya Perdana Teknik',
            'description' => 'Overhead Crane, Chain Hoist, Wire Rope Hoist, Gantry Crane, Cargo Lift, Jib Crane & Maintenance. Spesialis mesin angkat angkut industri di Gresik Surabaya.',
            'og_image'    => asset('images/og-default.jpg'),
            'canonical'   => route('services'),
        ];

        $schema = json_encode([
            '@context' => 'https://schema.org',
            '@type'    => 'ItemList',
            'name'     => 'Produk & Layanan CV. Karya Perdana Teknik',
            'url'      => route('services'),
            'itemListElement' => $services->map(function($s, $i) {
                return [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'name'     => $s->name,
                    'url'      => route('services.show', $s->slug),
                ];
            })->toArray(),
        ]);

        return view('services.index', compact('services', 'settings', 'seo', 'schema'));
    }

    public function show(string $slug)
    {
        $service  = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $settings = Setting::getAllAsArray();
        $wa       = WaSetting::primary();
        $related  = Service::active()->ordered()->where('id', '!=', $service->id)->limit(4)->get();

        $seo = [
            'title'       => $service->meta_title,
            'description' => $service->meta_desc,
            'og_image'    => $service->og_image ? asset('storage/'.$service->og_image) : asset('images/og-default.jpg'),
            'canonical'   => route('services.show', $slug),
        ];

        $faq = [
            ['q' => 'Apakah CV. Karya Perdana Teknik melayani instalasi '.$service->name.'?', 'a' => 'Ya, kami menyediakan layanan lengkap mulai dari pengadaan, instalasi, hingga maintenance '.$service->name.' di seluruh Indonesia.'],
            ['q' => 'Berapa lama garansi untuk '.$service->name.'?', 'a' => 'Kami memberikan garansi produk dan layanan after-sales. Hubungi tim kami untuk informasi garansi lebih detail.'],
            ['q' => 'Apakah ada layanan maintenance rutin untuk '.$service->name.'?', 'a' => 'Ya, kami menyediakan program maintenance berkala untuk memastikan peralatan Anda selalu dalam kondisi optimal.'],
        ];

        $schema = json_encode([
            [
                '@context'    => 'https://schema.org',
                '@type'       => 'Product',
                'name'        => $service->name,
                'description' => $service->short_desc,
                'url'         => route('services.show', $slug),
                'brand'       => ['@type' => 'Brand', 'name' => 'CV. Karya Perdana Teknik'],
                'offers'      => ['@type' => 'Offer', 'availability' => 'https://schema.org/InStock', 'priceCurrency' => 'IDR', 'seller' => ['@type' => 'Organization', 'name' => 'CV. Karya Perdana Teknik']],
            ],
            [
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => collect($faq)->map(fn($item) => [
                    '@type'          => 'Question',
                    'name'           => $item['q'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => $item['a']
                    ]
                ])->toArray()
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return view('services.show', compact('service', 'settings', 'wa', 'related', 'seo', 'faq', 'schema'));
    }
}
