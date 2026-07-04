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
        $testimonials = Testimonial::active()->ordered()->get();
        $wa           = WaSetting::primary();

        $seo = [
            'title'       => $settings['meta_title_home'] ?? 'Hoist Crane Lift Specialist | CV. Karya Perdana Teknik Gresik',
            'description' => $settings['meta_desc_home'] ?? 'CV. Karya Perdana Teknik - Spesialis Overhead Crane, Chain Hoist, Wire Rope Hoist & Cargo Lift. Melayani seluruh Indonesia. Hubungi: 081331148731',
            'og_image'    => !empty($settings['og_image_default']) ? asset('storage/'.$settings['og_image_default']) : asset('images/og-default.jpg'),
        ];

        $schema = json_encode($this->getLocalBusinessSchema());

        return view('home.index', compact('settings', 'services', 'gallery', 'articles', 'clients', 'testimonials', 'wa', 'seo', 'schema'));
    }

    private function getLocalBusinessSchema(): array
    {
        return [
            '@context'        => 'https://schema.org',
            '@type'           => 'LocalBusiness',
            'name'            => 'CV. Karya Perdana Teknik',
            'description'     => 'Spesialis Hoist, Crane System & Cargo Lift. Melayani pengadaan, instalasi, fabrikasi & maintenance di seluruh Indonesia.',
            'url'             => 'https://www.karyaperdanateknik.co.id',
            'telephone'       => '+62-31-99171407',
            'email'           => 'karyaperdanateknik@gmail.com',
            'image'           => asset('images/og-default.jpg'),
            'priceRange'      => '$$',
            'openingHours'    => 'Mo-Sa 08:00-17:00',
            'areaServed'      => 'Indonesia',
            'address'         => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Pergudangan Legundi Business Park Blok D-11',
                'addressLocality' => 'Gresik',
                'addressRegion'   => 'Jawa Timur',
                'postalCode'      => '61177',
                'addressCountry'  => 'ID',
            ],
            'geo'             => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => '-7.1583',
                'longitude' => '112.6515',
            ],
            'contactPoint'    => [
                '@type'       => 'ContactPoint',
                'telephone'   => '+62-81331148731',
                'contactType' => 'sales',
                'areaServed'  => 'ID',
                'availableLanguage' => 'Indonesian',
            ],
            'sameAs'          => [
                'https://www.karyaperdanateknik.co.id',
                'https://www.hoistcranelift.com',
            ],
        ];
    }
}
