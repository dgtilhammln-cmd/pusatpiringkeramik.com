<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SeoSeeder extends Seeder
{
    public function run(): void
    {
        $companyName = Setting::get('company_name', 'Pusat Piring Keramik');

        $seo = [
            'home' => [
                'title'    => $companyName . ' | Grosir Piring Keramik untuk Hotel, Restoran & Kafe',
                'desc'     => 'Pusat Piring Keramik - supplier & distributor piring keramik, porselen, dan peralatan makan grosir terpercaya di Indonesia. Melayani hotel bintang, restoran, kafe, katering, dan EO. Harga kompetitif, kualitas premium, pengiriman ke seluruh Indonesia.',
                'keywords' => 'grosir piring keramik, supplier piring hotel, distributor piring restoran, piring porselen grosir, peralatan makan hotel bintang, piring kafe, grosir peralatan makan indonesia, supplier tableware indonesia',
            ],
            'about' => [
                'title'    => 'Tentang ' . $companyName . ' | Supplier Tableware B2B Terpercaya',
                'desc'     => $companyName . ' adalah distributor dan supplier tableware keramik terpercaya untuk segmen B2B. Melayani hotel, restoran, kafe, dan katering di seluruh Indonesia dengan produk berstandar food-grade internasional.',
                'keywords' => 'profil pusat piring keramik, supplier tableware b2b indonesia, distributor peralatan makan hotel, vendor tableware restoran indonesia, mitra katering peralatan makan',
            ],
            'services' => [
                'title'    => 'Katalog Produk Keramik & Tableware Grosir | ' . $companyName,
                'desc'     => 'Temukan koleksi lengkap piring keramik, mangkuk, cangkir, piring porselen, dan aksesori makan lainnya. Tersedia dalam berbagai ukuran dan model untuk hotel, restoran, kafe, dan catering. Pembelian partai besar harga spesial.',
                'keywords' => 'katalog piring keramik, piring makan grosir, mangkuk keramik hotel, cangkir porselen restoran, set tableware kafe, piring partai besar, peralatan makan catering, harga tableware grosir indonesia',
            ],
            'gallery' => [
                'title'    => 'Galeri Produk & Portofolio Klien | ' . $companyName,
                'desc'     => 'Koleksi tableware dan piring keramik kami yang telah digunakan oleh hotel bintang 5, restoran fine dining, kafe modern, dan katering ternama di Indonesia. Kualitas premium, desain elegan.',
                'keywords' => 'galeri piring keramik, portofolio tableware hotel, foto piring restoran, koleksi keramik kafe, referensi peralatan makan catering, tableware hotel bintang 5',
            ],
            'articles' => [
                'title'    => 'Tips & Panduan Memilih Tableware untuk Bisnis F&B | ' . $companyName,
                'desc'     => 'Artikel, tips, dan panduan lengkap seputar pemilihan piring keramik dan tableware untuk hotel, restoran, kafe, dan bisnis F&B. Dapatkan insight dari para ahli ' . $companyName . '.',
                'keywords' => 'tips memilih piring hotel, panduan tableware restoran, cara pilih piring kafe, standar tableware f&b, keramik food grade hotel, edukasi peralatan makan bisnis',
            ],
            'contact' => [
                'title'    => 'Hubungi Kami - Konsultasi & Penawaran Grosir | ' . $companyName,
                'desc'     => 'Dapatkan penawaran harga grosir piring keramik dan tableware terbaik untuk bisnis Anda. Konsultasi gratis, request sampel produk, dan negosiasi harga untuk pembelian partai besar.',
                'keywords' => 'kontak grosir piring keramik, penawaran tableware hotel, konsultasi peralatan makan restoran, order piring kafe grosir, nomor wa supplier tableware, request sampel piring porselen',
            ],
        ];

        foreach ($seo as $page => $data) {
            Setting::set('meta_title_'    . $page, $data['title'],    'text',     'seo');
            Setting::set('meta_desc_'     . $page, $data['desc'],     'textarea', 'seo');
            Setting::set('meta_keywords_' . $page, $data['keywords'], 'text',     'seo');
        }

        if ($this->command) {
            $this->command->info('SEO settings seeded untuk target market Hotel, Restoran, Kafe, dan Katering B2B.');
        }
    }
}
