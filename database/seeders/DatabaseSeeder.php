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
            // Page Heroes (About, Product, Article, Contact)
            ['key'=>'page_about_hero_label',  'value'=>'PROFIL PERUSAHAAN', 'type'=>'text','group'=>'page_hero','label'=>'About Hero Label'],
            ['key'=>'page_about_hero_title',  'value'=>'Mitra Solusi Tableware & Piring Keramik Terpercaya', 'type'=>'text','group'=>'page_hero','label'=>'About Hero Title'],
            ['key'=>'page_about_hero_desc',   'value'=>'UD. Sukses Makmur (Pusat Piring Keramik) hadir untuk menjawab kebutuhan produk piring keramik, porselen, dan tableware berkualitas tinggi di seluruh wilayah Indonesia dengan standar terbaik.', 'type'=>'text','group'=>'page_hero','label'=>'About Hero Description'],

            ['key'=>'page_product_hero_label','value'=>'KATALOG PRODUK', 'type'=>'text','group'=>'page_hero','label'=>'Product Hero Label'],
            ['key'=>'page_product_hero_title','value'=>'Katalog Piring Keramik & Tableware Berkualitas', 'type'=>'text','group'=>'page_hero','label'=>'Product Hero Title'],
            ['key'=>'page_product_hero_desc', 'value'=>'Jelajahi koleksi piring keramik, mangkuk, cangkir, dan perlengkapan meja makan dari UD. Sukses Makmur untuk resto, hotel, cafe, dan rumah tangga.', 'type'=>'text','group'=>'page_hero','label'=>'Product Hero Description'],

            ['key'=>'page_article_hero_label','value'=>'INFORMASI & WAWASAN', 'type'=>'text','group'=>'page_hero','label'=>'Article Hero Label'],
            ['key'=>'page_article_hero_title','value'=>'Artikel, Tips & Wawasan Tableware Keramik', 'type'=>'text','group'=>'page_hero','label'=>'Article Hero Title'],
            ['key'=>'page_article_hero_desc', 'value'=>'Temukan berbagai artikel menarik, panduan memilih piring keramik, serta tips perawatan tableware dari UD. Sukses Makmur.', 'type'=>'text','group'=>'page_hero','label'=>'Article Hero Description'],

            ['key'=>'page_contact_hero_label','value'=>'KONTAK KAMI', 'type'=>'text','group'=>'page_hero','label'=>'Contact Hero Label'],
            ['key'=>'page_contact_hero_title','value'=>'Hubungi UD. Sukses Makmur / Pusat Piring Keramik', 'type'=>'text','group'=>'page_hero','label'=>'Contact Hero Title'],
            ['key'=>'page_contact_hero_desc', 'value'=>'Tim UD. Sukses Makmur siap membantu menemukan produk piring dan keramik terbaik untuk kebutuhan Anda. Hubungi kami sekarang - respon cepat!', 'type'=>'text','group'=>'page_hero','label'=>'Contact Hero Description'],
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
                'title'        => '5 Tips Memilih Piring Keramik Food Grade untuk Restoran & Hotel',
                'slug'         => 'tips-memilih-piring-keramik-food-grade',
                'excerpt'      => 'Kualitas tableware menentukan keamanan dan kesan pertama restoran Anda. Ketahui 5 tips memilih piring keramik food grade berstandar internasional.',
                'category'     => 'Tips Industri',
                'is_published' => true,
                'published_at' => now()->subDays(4),
                'author'       => 'Tim UD. Sukses Makmur',
                'meta_title'   => '5 Tips Memilih Piring Keramik Food Grade | UD. Sukses Makmur',
                'meta_desc'    => 'Panduan memilih piring keramik food grade berkualitas untuk restoran, hotel, dan catering dari UD. Sukses Makmur.',
            ],
            [
                'title'        => 'Perbedaan Ceramic, Porcelain, dan Stoneware Tableware: Mana Yang Terbaik?',
                'slug'         => 'perbedaan-ceramic-porcelain-stoneware',
                'excerpt'      => 'Setiap material tableware memiliki keunggulan dan daya tahan berbeda. Pelajari perbedaan karakteristik keramik, porselen, dan stoneware sebelum membeli.',
                'category'     => 'Edukasi',
                'is_published' => true,
                'published_at' => now()->subDays(11),
                'author'       => 'Tim UD. Sukses Makmur',
                'meta_title'   => 'Perbedaan Keramik, Porselen & Stoneware | UD. Sukses Makmur',
                'meta_desc'    => 'Panduan lengkap membedakan tableware keramik, porselen, dan stoneware untuk kebutuhan bisnis F&B Anda.',
            ],
            [
                'title'        => 'Cara Merawat Piring Keramik Agar Tahan Lama & Tidak Mudah Gores',
                'slug'         => 'cara-merawat-piring-keramik-tahan-lama',
                'excerpt'      => 'Perawatan yang tepat memperpanjang umur piring keramik dan menjaga kilau glazuur. Ikuti panduan praktis dari UD. Sukses Makmur.',
                'category'     => 'Panduan',
                'is_published' => true,
                'published_at' => now()->subDays(19),
                'author'       => 'Tim UD. Sukses Makmur',
                'meta_title'   => 'Cara Merawat Piring Keramik Agar Tahan Lama | UD. Sukses Makmur',
                'meta_desc'    => 'Tips dan trik merawat piring keramik restoran dan rumah tangga agar awet, mengkilap, dan bebas goresan.',
            ],
        ];
        $contentTemplate = '<h2>Pendahuluan</h2><p>Pemilihan piring keramik dan tableware yang tepat merupakan langkah vital untuk menghadirkan sajian yang estetis, higienis, dan berkesan bagi pelanggan. UD. Sukses Makmur (Pusat Piring Keramik) berkomitmen menghadirkan produk tableware berkualitas tinggi.</p><h2>Detail Pembahasan</h2><p>Sebagai supplier & distributor resmi tableware terpercaya di Indonesia, kami menyediakan koleksi lengkap <strong>piring keramik</strong>, <strong>mangkuk porselen</strong>, <strong>cangkir</strong>, dan <strong>piranti meja makan</strong> yang telah teruji food-grade dan tahan panas tinggi.</p><p>Tim kami berpengalaman melayani pemesanan grosir untuk HORECA (Hotel, Restaurant, Cafe, Catering) serta pengiriman aman dengan paking peti kayu ke seluruh wilayah Indonesia.</p><h2>Kesimpulan</h2><p>Hubungi tim UD. Sukses Makmur di <strong>0856-2682-888</strong> untuk konsultasi kebutuhan tableware dan katalog produk lengkap dengan penawaran harga grosir terbaik.</p>';
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

