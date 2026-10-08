<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    /**
     * Seed 2 Hero Slides untuk homepage Pusat Piring Keramik.
     * Upload gambar via: Admin -> Page Management -> Tab "Hero Section" -> Edit slide.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat jika dijalankan ulang
        HeroSlide::truncate();

        $slides = [
            [
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
            ],
            [
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
            ],
            [
                'title'        => "Peralatan Makan Keramik & Stainless\nKualitas Terbaik",
                'subtitle'     => 'UD. Sukses Makmur',
                'description'  => 'Distributor resmi peralatan makan keramik dan stainless terpercaya untuk kebutuhan usaha F&B, resto, katering, dan rumah tangga.',
                'tags'         => 'Peralatan Makan, Stainless Steel, Piring Set, Mangkok Keramik, Grosir Murah',
                'stat_1_value' => '100%',
                'stat_1_label' => 'Porselen Asli',
                'stat_2_value' => '24/7',
                'stat_2_label' => 'Layanan Katering',
                'stat_3_value' => '10.000+',
                'stat_3_label' => 'Stok Terjaga',
                'order'        => 3,
                'is_active'    => true,
                'image'        => null,
            ],
        ];

        foreach ($slides as $data) {
            HeroSlide::create($data);
        }

        $this->command->info('[OK] HeroSlideSeeder: 3 slide hero berhasil dibuat.');
        $this->command->info('     Upload gambar via Admin -> Page Management -> tab Hero Section.');
    }
}
