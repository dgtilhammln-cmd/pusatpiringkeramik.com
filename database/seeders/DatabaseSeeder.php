<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;
use App\Models\Service;
use App\Models\GalleryProject;
use App\Models\Article;
use App\Models\Client;
use App\Models\Testimonial;
use App\Models\WaSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Call Other Seeders ──────────────────────────────────────
        $this->call([
            ProductSlugSeeder::class,
            CategorySeeder::class,
            HeroSlideSeeder::class,
            SeoSeeder::class,
        ]);

        // ── Admin user ──────────────────────────────────────────────
        User::updateOrCreate(['email' => 'admin@ptbiner.co.id'], [
            'name'      => 'Admin CV. Bintang Energy Surabaya',
            'password'  => Hash::make('BintangEnergy@2026!'),
            'role'      => 'admin',
            'is_active' => true,
        ]);

        // ── WA Settings ─────────────────────────────────────────────
        if (\App\Models\WaSetting::count() === 0) {
            WaSetting::insert([
                ['label'=>'WA Utama','nomor_wa'=>'081296565757','template_pesan'=>'Halo CV. Bintang Energy Surabaya, saya ingin menanyakan produk [nama produk]. Mohon informasi harga dan ketersediaannya. Terima kasih.','is_active'=>1,'is_primary'=>1,'order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ]);
        }

        // ── Site Settings ────────────────────────────────────────────
        $settings = [
            // Company
            ['key'=>'company_name',     'value'=>'Pusat Piring Keramik',                       'type'=>'text','group'=>'general','label'=>'Nama Perusahaan'],
            ['key'=>'company_phone',    'value'=>'0856-2682-888',                              'type'=>'text','group'=>'contact','label'=>'Telepon / WA Utama'],
            // Hero
            ['key'=>'hero_headline',    'value'=>'Distributor Piring Keramik & Tableware Premium #1', 'type'=>'text','group'=>'hero','label'=>'Hero Headline'],
            ['key'=>'hero_subheadline', 'value'=>'Pusat Piring Keramik — distributor resmi piring keramik, mangkuk, piranti porselen, dan stainless steel terpercaya untuk HORECA, catering, dan grosir di seluruh Indonesia.','type'=>'text','group'=>'hero','label'=>'Hero Sub-headline'],
            ['key'=>'hero_cta_primary', 'value'=>'Hubungi WhatsApp',                           'type'=>'text','group'=>'hero','label'=>'CTA Primary Text'],
            ['key'=>'hero_cta_secondary','value'=>'Lihat Katalog Produk',                     'type'=>'text','group'=>'hero','label'=>'CTA Secondary Text'],
            // Section 1: KEUNGGULAN
            ['key'=>'value_section_label', 'value'=>'KEUNGGULAN',                              'type'=>'text','group'=>'section','label'=>'Label Keunggulan'],
            ['key'=>'value_section_title', 'value'=>'Mengapa Pilih Pusat Piring Keramik?',      'type'=>'text','group'=>'section','label'=>'Judul Keunggulan'],
            ['key'=>'value_section_desc',  'value'=>'Solusi suplai tableware dan piring keramik berkualitas tinggi untuk kebutuhan restoran, hotel, catering, dan bisnis F&B di seluruh Indonesia.','type'=>'text','group'=>'section','label'=>'Deskripsi Keunggulan'],
            // Section 2: APLIKASI
            ['key'=>'aplikasi_section_label', 'value'=>'APLIKASI',                             'type'=>'text','group'=>'section','label'=>'Label Aplikasi'],
            ['key'=>'aplikasi_section_title', 'value'=>"Cocok untuk\nBerbagai Industri",        'type'=>'text','group'=>'section','label'=>'Judul Aplikasi'],
            ['key'=>'aplikasi_section_desc',  'value'=>'Pusat Piring Keramik menyediakan perlengkapan meja makan dan tableware premium yang dirancang khusus untuk memenuhi standar operasional berbagai sektor bisnis F&B.','type'=>'text','group'=>'section','label'=>'Deskripsi Aplikasi'],
            // Section 3: JANGKAUAN KOTA
            ['key'=>'kota_section_title', 'value'=>'Melayani seluruh Indonesia dengan jangkauan 50+ Kota.', 'type'=>'text','group'=>'section','label'=>'Judul Jangkauan Kota'],
            ['key'=>'kota_section_desc',  'value'=>'Pusat Piring Keramik bermitra dengan layanan ekspedisi kargo terpercaya untuk mendistribusikan produk piring keramik dan tableware berkualitas ke seluruh penjuru Nusantara secara cepat dan aman.','type'=>'text','group'=>'section','label'=>'Deskripsi Jangkauan Kota'],
            // About
            ['key'=>'about_heading',    'value'=>'Distributor Piring Keramik<br>Berstandar Restoran & Hotel',  'type'=>'text','group'=>'about','label'=>'About Heading'],
            ['key'=>'about_text',       'value'=>'Pusat Piring Keramik adalah supplier dan distributor tableware keramik berkualitas tinggi. Kami menyediakan ribuan pilihan piring keramik, mangkuk, cangkir, dan perlengkapan meja makan untuk hotel, restoran, kafe, catering, dan bisnis F&B di seluruh Indonesia.','type'=>'text','group'=>'about','label'=>'About Text'],
            ['key'=>'visi',             'value'=>'Menjadi distributor piring keramik dan tableware HORECA terpercaya #1 di Indonesia yang berorientasi pada kepuasan pelanggan, kualitas produk food-grade, dan kecepatan pengiriman.','type'=>'text','group'=>'about','label'=>'Visi'],
            ['key'=>'misi',             'value'=>'Menyediakan produk piring keramik dan perlengkapan makan berkualitas tinggi dengan layanan cepat, harga grosir kompetitif, serta pengiriman aman ke seluruh wilayah Indonesia.','type'=>'text','group'=>'about','label'=>'Misi'],
            // Stats
            ['key'=>'stat_years',    'value'=>'10+',                'type'=>'text','group'=>'stats','label'=>'Tahun Pengalaman'],
            ['key'=>'stat_clients',  'value'=>'500+',               'type'=>'text','group'=>'stats','label'=>'Klien Aktif'],
            ['key'=>'stat_products', 'value'=>'1.000+',             'type'=>'text','group'=>'stats','label'=>'SKU Produk'],
            ['key'=>'stat_coverage', 'value'=>'50+ Kota Indonesia', 'type'=>'text','group'=>'stats','label'=>'Jangkauan Kota'],
            // Contact
            ['key'=>'phone',    'value'=>'0856-2682-888',                                          'type'=>'text','group'=>'contact','label'=>'Telepon'],
            ['key'=>'wa1',      'value'=>'08562682888',                                            'type'=>'text','group'=>'contact','label'=>'WhatsApp Utama'],
            ['key'=>'email',    'value'=>'info@pusatpiringkeramik.com',                            'type'=>'text','group'=>'contact','label'=>'Email'],
            ['key'=>'address',  'value'=>'Pusat Piring Keramik - Surabaya, Jawa Timur, Indonesia', 'type'=>'text','group'=>'contact','label'=>'Alamat'],
            // Footer
            ['key'=>'footer_desc', 'value'=>'Distributor piring keramik dan tableware premium terpercaya. Melayani kebutuhan hotel, restoran, catering, dan grosir seluruh Indonesia.','type'=>'text','group'=>'footer','label'=>'Footer Description'],
            ['key'=>'copyright',   'value'=>'© 2016–2026 Pusat Piring Keramik. All rights reserved.','type'=>'text','group'=>'footer','label'=>'Copyright'],
            // SEO
            ['key'=>'meta_title_home','value'=>'Pusat Piring Keramik — Distributor Piring Keramik & Tableware HORECA #1',  'type'=>'text','group'=>'seo','label'=>'Meta Title Home'],
            ['key'=>'meta_desc_home', 'value'=>'Distributor resmi piring keramik, mangkuk, dan tableware restoran & hotel. Melayani grosir & eceran seluruh Indonesia. Hubungi WA: 0856-2682-888.','type'=>'text','group'=>'seo','label'=>'Meta Desc Home'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], array_merge($s, ['created_at'=>now(),'updated_at'=>now()]));
        }

        // ── Gallery Projects (Cleared so gallery auto-hides until real images are uploaded) ───────────
        GalleryProject::query()->delete();

        // ── Articles ─────────────────────────────────────────────────
        $articles = [
            [
                'title'        => '5 Alasan Mengapa Cat Jotun Cocok untuk Proyek Maritim Indonesia',
                'slug'         => 'cat-jotun-untuk-proyek-maritim',
                'excerpt'      => 'Lingkungan laut yang korosif membutuhkan perlindungan ekstra. Ketahui mengapa cat Jotun menjadi pilihan utama untuk kapal dan struktur offshore di Indonesia.',
                'category'     => 'Tips Industri',
                'is_published' => true,
                'published_at' => now()->subDays(4),
                'author'       => 'Tim CV. Bintang Energy Surabaya',
                'meta_title'   => '5 Alasan Cat Jotun untuk Proyek Maritim | CV. Bintang Energy Surabaya',
                'meta_desc'    => 'Kenapa Jotun jadi pilihan utama untuk cat maritim? Simak 5 alasan teknisnya di sini.',
            ],
            [
                'title'        => 'Perbedaan Epoxy, Polyurethane, dan Alkyd: Pilih yang Mana?',
                'slug'         => 'perbedaan-epoxy-polyurethane-alkyd',
                'excerpt'      => 'Banyak pelanggan bingung menentukan jenis coating yang tepat. Artikel ini membantu Anda memahami perbedaan karakteristik dan aplikasi masing-masing jenis.',
                'category'     => 'Edukasi',
                'is_published' => true,
                'published_at' => now()->subDays(11),
                'author'       => 'Tim CV. Bintang Energy Surabaya',
                'meta_title'   => 'Epoxy vs Polyurethane vs Alkyd: Perbedaan & Kegunaannya',
                'meta_desc'    => 'Panduan memilih jenis coating yang tepat antara epoxy, polyurethane, dan alkyd untuk berbagai aplikasi industri.',
            ],
            [
                'title'        => 'Cara Menghitung Kebutuhan Cat untuk Proyek Industri Skala Besar',
                'slug'         => 'cara-menghitung-kebutuhan-cat-industri',
                'excerpt'      => 'Salah menghitung kebutuhan cat bisa membuat proyek molor atau boros anggaran. Ikuti panduan teknis kami untuk estimasi yang akurat.',
                'category'     => 'Panduan',
                'is_published' => true,
                'published_at' => now()->subDays(19),
                'author'       => 'Tim CV. Bintang Energy Surabaya',
                'meta_title'   => 'Cara Menghitung Kebutuhan Cat Industri | CV. Bintang Energy Surabaya',
                'meta_desc'    => 'Panduan teknis menghitung volume cat yang dibutuhkan berdasarkan luas permukaan, DFT, dan spreading rate.',
            ],
        ];
        $contentTemplate = '<h2>Pendahuluan</h2><p>Pemilihan produk cat dan coating yang tepat adalah investasi jangka panjang yang menentukan umur aset Anda. CV. Bintang Energy Surabaya hadir sebagai mitra terpercaya dalam menyediakan solusi proteksi permukaan terbaik.</p><h2>Detail Pembahasan</h2><p>Sebagai distributor resmi cat industri dari merek-merek terkemuka dunia seperti <strong>Jotun</strong>, <strong>PPG Sigma</strong>, <strong>Hempel</strong>, dan <strong>AkzoNobel</strong>, kami memastikan setiap produk yang kami suplai memenuhi standar kualitas internasional dan sesuai dengan spesifikasi teknis proyek Anda.</p><p>Tim konsultan teknis kami yang berpengalaman siap membantu mulai dari pemilihan sistem coating yang tepat, kalkulasi kebutuhan material, hingga pendampingan teknis di lapangan.</p><h2>Kesimpulan</h2><p>Hubungi tim ahli CV. Bintang Energy Surabaya di <strong>0812-9656-5757</strong> untuk konsultasi gratis dan penawaran harga terbaik untuk kebutuhan proyek Anda.</p>';
        foreach ($articles as $a) {
            Article::updateOrCreate(['slug'=>$a['slug']], array_merge($a, [
                'content'=>$contentTemplate, 'views'=>rand(80,600),
                'created_at'=>now(),'updated_at'=>now()
            ]));
        }

        // ── Clients ──────────────────────────────────────────────────
        $clients = [
            ['name'=>'PT. Pertamina (Persero)',         'city'=>'Jakarta',      'order'=>1],
            ['name'=>'PT. PLN (Persero)',                'city'=>'Jakarta',      'order'=>2],
            ['name'=>'PT. Pelabuhan Indonesia III',      'city'=>'Surabaya',     'order'=>3],
            ['name'=>'PT. Wijaya Karya (Persero)',       'city'=>'Jakarta',      'order'=>4],
            ['name'=>'PT. Astra Daihatsu Motor',         'city'=>'Karawang',     'order'=>5],
            ['name'=>'PT. Chandra Asri Petrochemical',   'city'=>'Cilegon',      'order'=>6],
            ['name'=>'PT. Semen Indonesia (Persero)',    'city'=>'Gresik',       'order'=>7],
            ['name'=>'PT. Krakatau Steel (Persero)',     'city'=>'Cilegon',      'order'=>8],
        ];
        foreach ($clients as $c) {
            Client::updateOrCreate(['name'=>$c['name']], array_merge($c, [
                'is_active'=>true,'created_at'=>now(),'updated_at'=>now()
            ]));
        }

        // ── Testimonials ─────────────────────────────────────────────
        if (\App\Models\Testimonial::count() === 0) {
            Testimonial::insert([
                [
                    'name'=>'Ir. Bambang Sutrisno',
                    'company'=>'PT. Pelabuhan Indonesia III',
                    'position'=>'Project Manager',
                    'content'=>'CV. Bintang Energy Surabaya membuktikan diri sebagai mitra yang sangat profesional. Produk cat anti korosi Jotun yang mereka suplai terbukti tahan di lingkungan pelabuhan yang sangat korosif. Pengiriman tepat waktu dan tim teknisnya sangat responsif.',
                    'rating'=>5,'is_active'=>1,'order'=>1,'created_at'=>now(),'updated_at'=>now()
                ],
                [
                    'name'=>'Drs. Hendra Wijaya',
                    'company'=>'PT. Chandra Asri Petrochemical',
                    'position'=>'Maintenance Superintendent',
                    'content'=>'Sudah 5 tahun kami mempercayakan kebutuhan coating untuk unit kilang kami ke CV. Bintang Energy Surabaya. Kualitas produk dan konsistensi layanan mereka tidak perlu diragukan lagi. Sangat direkomendasikan untuk proyek oil & gas.',
                    'rating'=>5,'is_active'=>1,'order'=>2,'created_at'=>now(),'updated_at'=>now()
                ],
                [
                    'name'=>'Agus Firmansyah, ST.',
                    'company'=>'PT. Wijaya Karya (Persero)',
                    'position'=>'Site Engineer',
                    'content'=>'Kami menggunakan produk PPG Sigma dari CV. Bintang Energy Surabaya untuk proyek jembatan di Jawa Timur. Hasilnya sangat memuaskan — adhesion kuat, tidak mudah terkelupas, dan warnanya tetap terjaga meski terpapar cuaca ekstrem.',
                    'rating'=>5,'is_active'=>1,'order'=>3,'created_at'=>now(),'updated_at'=>now()
                ],
            ]);
        }
    }
}

