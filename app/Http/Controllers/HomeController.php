<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Service;
use App\Models\GalleryProject;
use App\Models\Article;
use App\Models\Client;
use App\Models\Testimonial;
use App\Models\WaSetting;
use App\Models\HeroSlide;

class HomeController extends Controller
{
    public function index()
    {
        $settings     = Setting::getAllAsArray();
        $products     = Service::active()->ordered()->limit(5)->get();
        $gallery      = GalleryProject::active()->ordered()->limit(8)->get();
        $articles     = Article::published()->latest()->limit(3)->get();
        $clients      = Client::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->get()->unique('name');
        $wa           = WaSetting::primary();
        $heroSlides   = HeroSlide::active()->ordered()->limit(5)->get();
        if ($heroSlides->count() === 0) {
            HeroSlide::create([
                'title'        => "Solusi Tableware Keramik\nPremium untuk Bisnis F&B",
                'subtitle'     => 'Grosir & Eceran Piring Keramik',
                'description'  => 'Kami menyediakan piring keramik, mangkuk, dan tableware berkualitas tinggi untuk hotel, restoran, katering, dan usaha F&B skala besar di seluruh Indonesia.',
                'tags'         => 'Piring Keramik, Hotel & Restoran, Food Grade, Grosir, Tahan Lama',
                'stat_1_value' => '10+',
                'stat_1_label' => 'Tahun Pengalaman',
                'stat_2_value' => '500+',
                'stat_2_label' => 'Proyek Selesai',
                'stat_3_value' => '50+',
                'stat_3_label' => 'Kota Terjangkau',
                'order'        => 1,
                'is_active'    => true,
                'image'        => null,
            ]);
            HeroSlide::create([
                'title'        => "Keramik Berkualitas\nuntuk Setiap Kebutuhan",
                'subtitle'     => 'Distributor Resmi Keramik Premium',
                'description'  => 'Dari keramik lantai, dinding, hingga tableware porselen — kami hadir sebagai mitra terpercaya untuk kebutuhan keramik bisnis dan hunian Anda.',
                'tags'         => 'Keramik Lantai, Keramik Dinding, Porselen, High Quality, Food Safe',
                'stat_1_value' => '1.000+',
                'stat_1_label' => 'Produk Tersedia',
                'stat_2_value' => '100%',
                'stat_2_label' => 'Kepuasan Klien',
                'stat_3_value' => '30+',
                'stat_3_label' => 'Mitra Horeca',
                'order'        => 2,
                'is_active'    => true,
                'image'        => null,
            ]);
            $heroSlides = HeroSlide::active()->ordered()->limit(5)->get();
        }

        $comp    = Setting::get('company_name', config('app.name'));
        $tagline = Setting::get('company_tagline', '');
        $seo = [
            'title'       => $settings['meta_title_home'] ?? ($comp . ($tagline ? ' — ' . $tagline : '')),
            'description' => $settings['meta_desc_home']  ?? ($tagline ?: $comp),
            'keywords'    => $settings['meta_keywords_home'] ?? '',
            'og_image'    => !empty($settings['og_image_default']) ? asset('storage/'.$settings['og_image_default']) : (!empty($settings['logo']) ? asset('storage/'.$settings['logo']) : asset('favicon.ico')),
            'canonical'   => route('home'),
        ];

        return view('home.index', compact('settings', 'products', 'gallery', 'articles', 'clients', 'testimonials', 'wa', 'seo', 'heroSlides'));
    }
}
