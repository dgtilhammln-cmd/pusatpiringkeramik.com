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
        $testimonials = Testimonial::active()->ordered()->get();
        $clients      = Client::active()->ordered()->get();

        $seo = [
            'title'       => 'Tentang Kami | CV. Karya Perdana Teknik - Spesialis Crane & Hoist',
            'description' => 'Profil CV. Karya Perdana Teknik, spesialis Hoist, Crane System & Cargo Lift berdiri 2013. Melayani 28+ perusahaan industri di seluruh Indonesia.',
            'og_image'    => $settings['og_image_default'] ? asset('storage/'.$settings['og_image_default']) : asset('images/og-default.jpg'),
            'canonical'   => route('about'),
        ];

        $keunggulan = [
            ['icon' => 'star', 'title' => 'Produk Berkualitas', 'desc' => 'Semua produk dari brand terpercaya dengan standar internasional'],
            ['icon' => 'shield', 'title' => 'Garansi After Sales', 'desc' => 'Layanan purna jual & maintenance berkala yang responsif'],
            ['icon' => 'tag', 'title' => 'Harga Kompetitif', 'desc' => 'Harga terbaik tanpa mengorbankan kualitas produk'],
            ['icon' => 'map', 'title' => 'Jangkauan Nasional', 'desc' => 'Melayani pengiriman & instalasi ke seluruh Indonesia'],
            ['icon' => 'clock', 'title' => 'Tepat Waktu', 'desc' => 'Komitmen jadwal pengiriman dan pemasangan sesuai target'],
            ['icon' => 'hard-hat', 'title' => 'Prioritas Keselamatan', 'desc' => 'Mengutamakan K3 (Keselamatan & Kesehatan Kerja) di setiap pekerjaan'],
        ];

        $legalitas = [
            ['label' => 'Akte Notaris', 'value' => $settings['akte'] ?? 'No. 47/1093/CV/VIII/2013'],
            ['label' => 'NPWP', 'value' => $settings['npwp'] ?? '31.817.130.3-603.000'],
            ['label' => 'NIB', 'value' => $settings['nib'] ?? '9120105110524'],
            ['label' => 'SPPKP', 'value' => 'S-93PKP/WPJ.24/KP.0103/2019'],
        ];

        return view('about.index', compact('settings', 'testimonials', 'clients', 'seo', 'keunggulan', 'legalitas'));
    }
}
