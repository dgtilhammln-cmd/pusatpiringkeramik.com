<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Service;
use App\Models\GalleryProject;
use App\Models\Article;
use App\Models\Client;
use App\Models\Testimonial;
use App\Models\WaSetting;

class HomeController extends Controller
{
    public function index()
    {
        $settings     = Setting::getAllAsArray();
        $services     = Service::active()->ordered()->limit(12)->get();
        $gallery      = GalleryProject::active()->ordered()->limit(8)->get();
        $articles     = Article::published()->latest()->limit(3)->get();
        $clients      = Client::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->get()->unique('name');
        $wa           = WaSetting::primary();

        $seo = [
            'title'       => $settings['meta_title_home'] ?? 'Hoist Crane Lift Specialist | CV. Karya Perdana Teknik Gresik',
            'description' => $settings['meta_desc_home'] ?? 'CV. Karya Perdana Teknik - Spesialis Overhead Crane, Chain Hoist, Wire Rope Hoist & Cargo Lift. Melayani seluruh Indonesia. Hubungi: 081331148731',
            'og_image'    => !empty($settings['logo']) ? asset('storage/'.$settings['logo']) : asset('favicon.ico'),
        ];

        return view('home.index', compact('settings', 'services', 'gallery', 'articles', 'clients', 'testimonials', 'wa', 'seo'));
    }

}
