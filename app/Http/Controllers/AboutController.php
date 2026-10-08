<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Client;

class AboutController extends Controller
{
    public function index()
    {
        $settings     = Setting::getAllAsArray();
        $testimonials = Testimonial::active()->ordered()->get()->unique('name');
        $clients      = Client::active()->ordered()->get();
        $wa           = \App\Models\WaSetting::primary();

        $comp    = $settings['company_name'] ?? config('app.name');
        $tagline = $settings['company_tagline'] ?? '';

        $seo = [
            'title'       => $settings['meta_title_about'] ?? ('Tentang Kami | ' . $comp),
            'description' => $settings['meta_desc_about'] ?? ($tagline ?: ('Profil Perusahaan ' . $comp)),
            'keywords'    => $settings['meta_keywords_about'] ?? '',
            'og_image'    => !empty($settings['og_image_default']) ? asset('storage/'.$settings['og_image_default']) : (!empty($settings['logo']) ? asset('storage/'.$settings['logo']) : asset('images/og-default.jpg')),
            'canonical'   => route('about'),
        ];

        // Stats from settings (editable via /admin/settings)
        $stats = [
            'years'    => $settings['stat_years']    ?? '10+',
            'clients'  => $settings['stat_clients']  ?? '500+',
            'cities'   => $settings['stat_cities']   ?? '50+',
            'products' => $settings['stat_products'] ?? '1000+',
        ];

        return view('about.index', compact(
            'settings', 'testimonials', 'clients', 'seo',
            'wa', 'stats'
        ));
    }
}
