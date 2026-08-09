<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSlide::truncate();

        HeroSlide::create([
            'title' => "Perlindungan Maksimal untuk\nKapal & Industri Anda",
            'subtitle' => 'Premium Industrial Coating Solutions',
            'description' => 'PT Bintang Energy Surabaya hadir sebagai distributor resmi cat internasional terkemuka. Kami menyediakan solusi pelapisan cat anti karat, epoxy lantai, dan cat besi terbaik di Indonesia.',
            'tags' => 'Marine Coating, Protective Coating, Industrial Coating',
            'button_primary_text' => 'Lihat Produk',
            'button_primary_link' => '/products',
            'button_secondary_text' => 'Hubungi Kami',
            'button_secondary_link' => '/contact',
            'order' => 1,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'title' => "Distributor Resmi Cat\nKelas Dunia",
            'subtitle' => 'Verified Supplier & Trusted Partner',
            'description' => 'Menyediakan lebih dari 300+ varian produk dari merek ternama seperti Hempel, International Paint, Jotun, Sigma PPG, Chugoku, dan Agatha Paint.',
            'tags' => 'Hempel Paint, Jotun, Sigma PPG, Chugoku',
            'button_primary_text' => 'Katalog Produk',
            'button_primary_link' => '/products',
            'button_secondary_text' => 'Konsultasi Gratis',
            'button_secondary_link' => '/contact',
            'order' => 2,
            'is_active' => true,
        ]);
    }
}
