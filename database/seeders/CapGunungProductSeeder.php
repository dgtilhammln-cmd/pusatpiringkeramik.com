<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class CapGunungProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori Cap Gunung tunggal
        $capGunungCategory = ServiceCategory::updateOrCreate(
            ['slug' => 'cap-gunung'],
            [
                'name'          => 'Cap Gunung',
                'description'   => 'Koleksi lengkap piranti makan keramik, porcelain, dan stoneware merk Cap Gunung. Terdiri dari piring ceper, piring cekung, mangkok soto, mangkok bakso, mug promosi, sendok keramik, hingga tea set susun standar HORECA.',
                'meta_title'    => 'Distributor Resmi Piring & Mangkok Keramik Cap Gunung Grosir',
                'meta_desc'     => 'Pusat grosir piranti makan keramik Cap Gunung asli terlengkap. Piring, mangkok, mug & tea set harga pabrik untuk restoran, cafe, hotel, dan katering.',
                'meta_keywords' => 'piring cap gunung, mangkok cap gunung, grosir keramik cap gunung, distributor cap gunung surabaya, supplier piring resto hotel, pabrik keramik cap gunung',
                'parent_id'     => null,
            ]
        );

        $this->command->info("✓ Category ready: Cap Gunung (ID: {$capGunungCategory->id})");

        // 2. Daftar 22 produk lengkap hasil ekstraksi folder Cap Gunung
        $products = [
            [
                'name' => 'Piring Keramik Cap Gunung 6339 Series',
                'slug' => 'piring-keramik-cap-gunung-6339-series',
                'short_desc' => 'Piring keramik Cap Gunung seri 6339 berdesain motif elegan untuk pengadaan resto, cafe, dan hotel bintang.',
                'description' => '<p><strong>Piring Keramik Cap Gunung 6339 Series</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-keramik-cap-gunung-6339-series-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-keramik-cap-gunung-6339-series-2.webp',
                    'services/cap-gunung/piring-keramik-cap-gunung-6339-series-3.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Seri Model',
                        'value' => '6339 Series',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Porselen Food Grade SNI',
                    ],
                    [
                        'key' => 'Finishing',
                        'value' => 'Glossy Glaze Halus Tahan Gores',
                    ],
                    [
                        'key' => 'Ketahanan Suhu',
                        'value' => 'Microwave Safe, Dishwasher Safe & Oven Safe',
                    ],
                    [
                        'key' => 'Rekomendasi',
                        'value' => 'Restoran, Cafe, Hotel, Catering & Souvenir',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Berapa minimal pemesanan untuk harga grosir?',
                        'a' => 'Kami melayani pemesanan grosir per dus/karton maupun partai besar untuk proyek HORECA. Silakan hubungi tim sales kami via WhatsApp untuk penawaran terbaik.',
                    ],
                    [
                        'q' => 'Apakah aman dikirim ke luar kota atau luar pulau?',
                        'a' => 'Sangat aman. Setiap pengiriman dilindungi dengan sekat tebal, bubble wrap berlapis, dan opsi packing peti kayu kokoh.',
                    ],
                ],
                'meta_title' => 'Piring Keramik Cap Gunung 6339 Series Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Keramik Cap Gunung 6339 Series. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring keramik cap gunung 6339, piring motif resto, grosir piring cap gunung, supplier piring hotel horeka, distributor piring keramik surabaya',
                'order' => 1,
            ],
            [
                'name' => 'Piring Keramik Cap Gunung 6409 Series',
                'slug' => 'piring-keramik-cap-gunung-6409-series',
                'short_desc' => 'Piring keramik Cap Gunung seri 6409 motif klasik berkelas dengan glazuur tebal anti gores untuk operasional kuliner.',
                'description' => '<p><strong>Piring Keramik Cap Gunung 6409 Series</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-keramik-cap-gunung-6409-series-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-keramik-cap-gunung-6409-series-2.webp',
                    'services/cap-gunung/piring-keramik-cap-gunung-6409-series-3.webp',
                    'services/cap-gunung/piring-keramik-cap-gunung-6409-series-4.webp',
                    'services/cap-gunung/piring-keramik-cap-gunung-6409-series-5.webp',
                    'services/cap-gunung/piring-keramik-cap-gunung-6409-series-6.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Seri Model',
                        'value' => '6409 Series',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Porselen SNI Food Grade',
                    ],
                    [
                        'key' => 'Fitur',
                        'value' => 'Tahan Panas, Tahan Minyak, Mudah Dibersihkan',
                    ],
                    [
                        'key' => 'Peruntukan',
                        'value' => 'Usaha Kuliner, Rumah Makan, Resto Keluarga, Hotel',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Bagaimana cara mendapatkan katalog lengkap seri ini?',
                        'a' => 'Silakan klik tombol WhatsApp di halaman ini, tim kami akan mengirimkan PDF katalog dan price list grosir.',
                    ],
                    [
                        'q' => 'Apakah motif mudah pudar saat dicuci rutin di dishwasher?',
                        'a' => 'Motif dibakar pada suhu tinggi (in-glaze firing) sehingga warna awet menyatu dan tidak mudah pudar.',
                    ],
                ],
                'meta_title' => 'Piring Keramik Cap Gunung 6409 Series Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Keramik Cap Gunung 6409 Series. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring keramik cap gunung 6409, piring motif klasik, distributor piring cap gunung, piring catering grosir, supplier piranti makan horeka',
                'order' => 2,
            ],
            [
                'name' => 'Lepek Keramik & Mangkok Puding Cap Gunung',
                'slug' => 'lepek-keramik-dan-mangkok-pudding-cap-gunung',
                'short_desc' => 'Piring tatakan kecil (lepek) dan mangkok puding keramik Cap Gunung untuk sajian dessert, saus, dan kondimen resto.',
                'description' => '<p><strong>Lepek Keramik & Mangkok Puding Cap Gunung</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/lepek-keramik-dan-mangkok-pudding-cap-gunung-1.webp',
                'gallery' => [
                    'services/cap-gunung/lepek-keramik-dan-mangkok-pudding-cap-gunung-2.webp',
                    'services/cap-gunung/lepek-keramik-dan-mangkok-pudding-cap-gunung-3.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Tipe Produk',
                        'value' => 'Lepek / Saucer & Mangkok Puding (Dessert Bowl)',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Porselen Putih Bersih',
                    ],
                    [
                        'key' => 'Karakteristik',
                        'value' => 'Hygienic, Bebas Timbal (Lead-Free), Food Safe',
                    ],
                    [
                        'key' => 'Aplikasi',
                        'value' => 'Dessert, Puding, Kue, Saus Cocolan, Condiments',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Bisa pesan campur antara lepek dan mangkok puding?',
                        'a' => 'Bisa, kami melayani kombinasi order sesuai kebutuhan usaha kuliner atau cafe Anda.',
                    ],
                    [
                        'q' => 'Apakah produk ini aman untuk pemakaian microwave?',
                        'a' => 'Ya, 100% aman untuk microwave, dishwasher, dan chiller lemari es.',
                    ],
                ],
                'meta_title' => 'Lepek Keramik & Mangkok Puding Cap Gunung Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Lepek Keramik & Mangkok Puding Cap Gunung. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'lepek keramik cap gunung, mangkok puding keramik, piring tatakan kecil, mangkok dessert resto, piring kecap sambal keramik grosir',
                'order' => 3,
            ],
            [
                'name' => 'Piring & Mangkok Cap Gunung Lis Warna Solid Series',
                'slug' => 'piring-mangkok-cap-gunung-lis-warna-solid-series',
                'short_desc' => 'Koleksi piranti makan keramik Cap Gunung dengan garis tepi warna solid modern, cocok untuk cafe kekinian dan bistro.',
                'description' => '<p><strong>Piring & Mangkok Cap Gunung Lis Warna Solid Series</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-mangkok-cap-gunung-lis-warna-solid-series-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-mangkok-cap-gunung-lis-warna-solid-series-2.webp',
                    'services/cap-gunung/piring-mangkok-cap-gunung-lis-warna-solid-series-3.webp',
                    'services/cap-gunung/piring-mangkok-cap-gunung-lis-warna-solid-series-4.webp',
                    'services/cap-gunung/piring-mangkok-cap-gunung-lis-warna-solid-series-5.webp',
                    'services/cap-gunung/piring-mangkok-cap-gunung-lis-warna-solid-series-6.webp',
                    'services/cap-gunung/piring-mangkok-cap-gunung-lis-warna-solid-series-7.webp',
                    'services/cap-gunung/piring-mangkok-cap-gunung-lis-warna-solid-series-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Seri',
                        'value' => 'Solid Color Rim Series',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Fine Ceramic Food Grade',
                    ],
                    [
                        'key' => 'Warna Aksen',
                        'value' => 'Pilihan Lis Warna Solid Kontemporer',
                    ],
                    [
                        'key' => 'Keunggulan',
                        'value' => 'Tampilan visual estetik, menonjolkan warna hidangan',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Warna apa saja yang tersedia untuk lis solid ini?',
                        'a' => 'Tersedia aneka varian warna tepi pilihan. Hubungi tim kami via WhatsApp untuk ketersediaan stok terkini.',
                    ],
                    [
                        'q' => 'Apakah bisa sablon logo cafe di bagian tengah?',
                        'a' => 'Kami melayani custom decal sablon logo permanen dengan minimal order tertentu.',
                    ],
                ],
                'meta_title' => 'Piring & Mangkok Cap Gunung Lis Warna Solid Series Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring & Mangkok Cap Gunung Lis Warna Solid Series. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring lis warna cap gunung, mangkok lis warna solid, piring cafe kekinian, piring keramik estetik grosir, tableware cafe modern',
                'order' => 4,
            ],
            [
                'name' => 'Mangkok Keramik Bohemian Cap Gunung 6 - 8 Inch',
                'slug' => 'mangkok-keramik-bohemian-cap-gunung-6-8-inch',
                'short_desc' => 'Mangkok keramik motif Bohemian artistik 6 hingga 8 inci Cap Gunung untuk sajian ramen, salad bowl, dan sup signature.',
                'description' => '<p><strong>Mangkok Keramik Bohemian Cap Gunung 6 - 8 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/mangkok-keramik-bohemian-cap-gunung-6-8-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/mangkok-keramik-bohemian-cap-gunung-6-8-inch-2.webp',
                    'services/cap-gunung/mangkok-keramik-bohemian-cap-gunung-6-8-inch-3.webp',
                    'services/cap-gunung/mangkok-keramik-bohemian-cap-gunung-6-8-inch-4.webp',
                    'services/cap-gunung/mangkok-keramik-bohemian-cap-gunung-6-8-inch-5.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Motif / Desain',
                        'value' => 'Bohemian Pattern Artistic',
                    ],
                    [
                        'key' => 'Pilihan Ukuran',
                        'value' => 'Diameter 6 inch (15 cm) s/d 8 inch (20 cm)',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Stoneware / Keramik Tebal Tahan Panas',
                    ],
                    [
                        'key' => 'Karakteristik',
                        'value' => 'Kapasitas dalam, menjaga kuah hangat lebih lama',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah motif bohemian ini aman untuk kontak makanan panas?',
                        'a' => 'Sangat aman, menggunakan pewarna glasur food grade berstandar SNI tanpa zat berbahaya.',
                    ],
                    [
                        'q' => 'Bagaimana cara pemesanan grosir untuk restoran ramen / cafe?',
                        'a' => 'Silakan klik tombol WhatsApp untuk konsultasi kuantiti, ketersediaan ukuran, dan ekspedisi.',
                    ],
                ],
                'meta_title' => 'Mangkok Keramik Bohemian Cap Gunung 6 - 8 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Mangkok Keramik Bohemian Cap Gunung 6 - 8 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'mangkok bohemian cap gunung, mangkok motif etnik, mangkok ramen bohemian, mangkok salad keramik, grosir mangkok estetik resto',
                'order' => 5,
            ],
            [
                'name' => 'Mangkok Keramik Lohan Cap Gunung 3.75 - 5 Inch',
                'slug' => 'mangkok-keramik-lohan-cap-gunung-375-5-inch',
                'short_desc' => 'Mangkok keramik model Lohan klasik tebal 3.75 hingga 5 inci untuk nasi tim, sup herbal, dimsum, dan resto oriental.',
                'description' => '<p><strong>Mangkok Keramik Lohan Cap Gunung 3.75 - 5 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/mangkok-keramik-lohan-cap-gunung-375-5-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/mangkok-keramik-lohan-cap-gunung-375-5-inch-2.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Model / Tipe',
                        'value' => 'Mangkok Lohan (Cekung Dalam Tebal)',
                    ],
                    [
                        'key' => 'Ukuran Tersedia',
                        'value' => '3.75 inch, 4.5 inch, 5 inch',
                    ],
                    [
                        'key' => 'Ketahanan',
                        'value' => 'Tahan kukusan (steamer safe) dan microwave safe',
                    ],
                    [
                        'key' => 'Aplikasi',
                        'value' => 'Nasi Tim, Sup Sarang Burung, Dimsum, Kuah Soto Kecil',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah mangkok ini kuat untuk proses kukus / steaming suhu tinggi?',
                        'a' => 'Ya, keramik Lohan Cap Gunung berbahan tebal yang tahan panas pemanasan dandang/steamer.',
                    ],
                    [
                        'q' => 'Berapa isi per karton/dus?',
                        'a' => 'Isi per dus bervariasi sesuai ukuran inch. Hubungi kami via WA untuk rincian packing list.',
                    ],
                ],
                'meta_title' => 'Mangkok Keramik Lohan Cap Gunung 3.75 - 5 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Mangkok Keramik Lohan Cap Gunung 3.75 - 5 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'mangkok lohan cap gunung, mangkok nasi tim keramik, mangkok dimsum oriental, mangkok kuah kecil keramik, supplier mangkok resto chinese food',
                'order' => 6,
            ],
            [
                'name' => 'Mangkok Keramik Soto Cap Gunung Motif 4.5 - 5.5 Inch',
                'slug' => 'mangkok-keramik-soto-cap-gunung-motif-45-55-inch',
                'short_desc' => 'Mangkok soto keramik Cap Gunung motif legendaris 4.5 - 5.5 inci, standar usaha soto, bakso, dan kuliner nusantara se-Indonesia.',
                'description' => '<p><strong>Mangkok Keramik Soto Cap Gunung Motif 4.5 - 5.5 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/mangkok-keramik-soto-cap-gunung-motif-45-55-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/mangkok-keramik-soto-cap-gunung-motif-45-55-inch-2.webp',
                    'services/cap-gunung/mangkok-keramik-soto-cap-gunung-motif-45-55-inch-3.webp',
                    'services/cap-gunung/mangkok-keramik-soto-cap-gunung-motif-45-55-inch-4.webp',
                    'services/cap-gunung/mangkok-keramik-soto-cap-gunung-motif-45-55-inch-5.webp',
                    'services/cap-gunung/mangkok-keramik-soto-cap-gunung-motif-45-55-inch-6.webp',
                    'services/cap-gunung/mangkok-keramik-soto-cap-gunung-motif-45-55-inch-7.webp',
                    'services/cap-gunung/mangkok-keramik-soto-cap-gunung-motif-45-55-inch-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Model',
                        'value' => 'Mangkok Soto Tradisional Motif',
                    ],
                    [
                        'key' => 'Ukuran Pilihan',
                        'value' => '4.5 inch, 5 inch, 5.5 inch',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Porselen Tebal Anti Sompel',
                    ],
                    [
                        'key' => 'Peruntukan',
                        'value' => 'Warung Soto, Bakso, Rawon, Coto Makassar, Mie Ayam',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah bisa kirim partai besar untuk pembukaan cabang warung soto?',
                        'a' => 'Bisa, kami telah memasok ratusan jaringan rumah makan dan warung kuliner di berbagai kota.',
                    ],
                    [
                        'q' => 'Apakah motifnya tahan lama dicuci berkali-kali?',
                        'a' => 'Ya, motif glasur Cap Gunung terbukti puluhan tahun awet untuk operasional warung yang padat.',
                    ],
                ],
                'meta_title' => 'Mangkok Keramik Soto Cap Gunung Motif 4.5 - 5.5 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Mangkok Keramik Soto Cap Gunung Motif 4.5 - 5.5 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'mangkok soto cap gunung, mangkok bakso motif bunga, mangkok soto lamongan keramik, supplier mangkok warung soto, grosir mangkok soto surabaya',
                'order' => 7,
            ],
            [
                'name' => 'Mangkok Sayur Keramik Cap Gunung 6 - 7 Inch',
                'slug' => 'mangkok-sayur-keramik-cap-gunung-6-7-inch',
                'short_desc' => 'Mangkok saji sayur dan kuah ukuran 6 hingga 7 inci Cap Gunung untuk meja makan tengah resto keluarga, prasmanan, dan katering.',
                'description' => '<p><strong>Mangkok Sayur Keramik Cap Gunung 6 - 7 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/mangkok-sayur-keramik-cap-gunung-6-7-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/mangkok-sayur-keramik-cap-gunung-6-7-inch-2.webp',
                    'services/cap-gunung/mangkok-sayur-keramik-cap-gunung-6-7-inch-3.webp',
                    'services/cap-gunung/mangkok-sayur-keramik-cap-gunung-6-7-inch-4.webp',
                    'services/cap-gunung/mangkok-sayur-keramik-cap-gunung-6-7-inch-5.webp',
                    'services/cap-gunung/mangkok-sayur-keramik-cap-gunung-6-7-inch-6.webp',
                    'services/cap-gunung/mangkok-sayur-keramik-cap-gunung-6-7-inch-7.webp',
                    'services/cap-gunung/mangkok-sayur-keramik-cap-gunung-6-7-inch-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Fungsi Utama',
                        'value' => 'Mangkok Saji Sayur & Lauk Berkuah',
                    ],
                    [
                        'key' => 'Ukuran',
                        'value' => 'Diameter 6 inch (15 cm) s/d 7 inch (18 cm)',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Porselen SNI Tahan Panas',
                    ],
                    [
                        'key' => 'Keunggulan',
                        'value' => 'Bibir mangkok halus, mudah diangkat saat panas',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah cocok untuk sayur panas seperti asam-asam, sop buntut, dan lodeh?',
                        'a' => 'Sangat cocok, keramik tebal menahan panas kuah agar tetap nikmat saat disantap di meja.',
                    ],
                    [
                        'q' => 'Bisa beli sampel sebelum beli partai besar?',
                        'a' => 'Bisa, silakan hubungi tim sales kami untuk informasi pembelian sampel dan konfirmasi stok.',
                    ],
                ],
                'meta_title' => 'Mangkok Sayur Keramik Cap Gunung 6 - 7 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Mangkok Sayur Keramik Cap Gunung 6 - 7 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'mangkok sayur cap gunung, mangkok kuah 7 inch, mangkok saji keramik besar, mangkok prasmanan katering, distributor mangkok cap gunung',
                'order' => 8,
            ],
            [
                'name' => 'Mug Keramik Cap Gunung Sablon Non-Coating 11 Oz',
                'slug' => 'mug-keramik-cap-gunung-sablon-non-coating-11-oz',
                'short_desc' => 'Mug keramik 11 oz Cap Gunung food-grade khusus sablon decal bakar suhu tinggi untuk merchandise korporat, cafe, dan souvenir.',
                'description' => '<p><strong>Mug Keramik Cap Gunung Sablon Non-Coating 11 Oz</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/mug-keramik-cap-gunung-sablon-non-coating-11-oz-1.webp',
                'gallery' => [
                    'services/cap-gunung/mug-keramik-cap-gunung-sablon-non-coating-11-oz-2.webp',
                    'services/cap-gunung/mug-keramik-cap-gunung-sablon-non-coating-11-oz-3.webp',
                    'services/cap-gunung/mug-keramik-cap-gunung-sablon-non-coating-11-oz-4.webp',
                    'services/cap-gunung/mug-keramik-cap-gunung-sablon-non-coating-11-oz-5.webp',
                    'services/cap-gunung/mug-keramik-cap-gunung-sablon-non-coating-11-oz-6.webp',
                    'services/cap-gunung/mug-keramik-cap-gunung-sablon-non-coating-11-oz-7.webp',
                    'services/cap-gunung/mug-keramik-cap-gunung-sablon-non-coating-11-oz-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Kapasitas',
                        'value' => '11 Oz (±330 ml)',
                    ],
                    [
                        'key' => 'Tipe',
                        'value' => 'Keramik Putih Polos Non-Coating (Decal Bakar Ready)',
                    ],
                    [
                        'key' => 'Standar',
                        'value' => 'Food Grade 100%, Microwave & Dishwasher Safe',
                    ],
                    [
                        'key' => 'Kegunaan',
                        'value' => 'Sablon Decal Bakar, Souvenir Kantor, Merchandise Event',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apa perbedaan mug non-coating dengan mug sublimasi?',
                        'a' => 'Mug non-coating ditujukan untuk teknik sablon decal bakar suhu tinggi (oven ceramic) yang hasilnya permanen menyatu dengan glasur.',
                    ],
                    [
                        'q' => 'Berapa minimal order untuk harga grosir distributor?',
                        'a' => 'Minimal order grosir per dus (36-48 pcs). Hubungi WhatsApp sales untuk pricelist grosir.',
                    ],
                ],
                'meta_title' => 'Mug Keramik Cap Gunung Sablon Non-Coating 11 Oz Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Mug Keramik Cap Gunung Sablon Non-Coating 11 Oz. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'mug keramik cap gunung 11 oz, mug sablon non coating, mug promosi grosir, supplier mug polos souvenir, mug keramik putih polos surabaya',
                'order' => 9,
            ],
            [
                'name' => 'Piring & Mangkok Set Cap Gunung LUK Series (Dus Kado)',
                'slug' => 'piring-mangkok-set-cap-gunung-luk-series-dus-kado',
                'short_desc' => 'Set piranti makan keramik Cap Gunung LUK Series dikemas dus kado elegan untuk kebutuhan souvenir korporat, hampers, dan hadiah.',
                'description' => '<p><strong>Piring & Mangkok Set Cap Gunung LUK Series (Dus Kado)</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-mangkok-set-cap-gunung-luk-series-dus-kado-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-mangkok-set-cap-gunung-luk-series-dus-kado-2.webp',
                    'services/cap-gunung/piring-mangkok-set-cap-gunung-luk-series-dus-kado-3.webp',
                    'services/cap-gunung/piring-mangkok-set-cap-gunung-luk-series-dus-kado-4.webp',
                    'services/cap-gunung/piring-mangkok-set-cap-gunung-luk-series-dus-kado-5.webp',
                    'services/cap-gunung/piring-mangkok-set-cap-gunung-luk-series-dus-kado-6.webp',
                    'services/cap-gunung/piring-mangkok-set-cap-gunung-luk-series-dus-kado-7.webp',
                    'services/cap-gunung/piring-mangkok-set-cap-gunung-luk-series-dus-kado-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Seri',
                        'value' => 'LUK Series Exclusive Gift Set',
                    ],
                    [
                        'key' => 'Kemasan',
                        'value' => 'Dus Kado / Gift Box Eksklusif Siap Pakai',
                    ],
                    [
                        'key' => 'Isi Set',
                        'value' => 'Kombinasi Piring & Mangkok Keramik Presisi',
                    ],
                    [
                        'key' => 'Pilihan Tepat Untuk',
                        'value' => 'Hampers Lebaran, Souvenir Pernikahan, Merchandise Perusahaan',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah dus kado sudah termasuk pelindung di dalamnya?',
                        'a' => 'Ya, setiap set sudah tertata rapi di dalam dus kado bersekat yang aman.',
                    ],
                    [
                        'q' => 'Bisa cetak logo perusahaan pada box dan produk?',
                        'a' => 'Bisa untuk pemesanan jumlah tertentu dengan waktu produksi yang disepakati.',
                    ],
                ],
                'meta_title' => 'Piring & Mangkok Set Cap Gunung LUK Series (Dus Kado) Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring & Mangkok Set Cap Gunung LUK Series (Dus Kado). Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring mangkok set cap gunung, tableware set dus kado, souvenir piring set kado, hampers keramik corporate, gift set piring mangkok grosir',
                'order' => 10,
            ],
            [
                'name' => 'Piring Ceper Lis Emas Cap Gunung 10.5 Inch',
                'slug' => 'piring-ceper-lis-emas-cap-gunung-105-inch',
                'short_desc' => 'Piring ceper besar 10.5 inci Cap Gunung bertepi emas mewah untuk banquet hall hotel, gedung pertemuan, resepsi pernikahan, dan katering.',
                'description' => '<p><strong>Piring Ceper Lis Emas Cap Gunung 10.5 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-ceper-lis-emas-cap-gunung-105-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-ceper-lis-emas-cap-gunung-105-inch-2.webp',
                    'services/cap-gunung/piring-ceper-lis-emas-cap-gunung-105-inch-3.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Model',
                        'value' => 'Piring Ceper (Flat Dinner Plate) Lis Emas',
                    ],
                    [
                        'key' => 'Diameter',
                        'value' => '10.5 Inch (±26.7 cm)',
                    ],
                    [
                        'key' => 'Aksen',
                        'value' => 'Gold Rim Glaze Mewah',
                    ],
                    [
                        'key' => 'Peruntukan',
                        'value' => 'Pesta Pernikahan, Banquet Hotel, Gala Dinner, Catering VIP',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah lis emasnya tahan saat dicuci berkali-kali?',
                        'a' => 'Lis emas Cap Gunung menggunakan lapisan firing berkualitas tinggi, disarankan pencucian dengan spons lembut untuk menjaga kilau abadi.',
                    ],
                    [
                        'q' => 'Bagaimana cara pemesanan untuk kebutuhan catering resepsi?',
                        'a' => 'Hubungi tim sales kami melalui WhatsApp untuk reservasi kuantiti dan penyesuaian jadwal acara.',
                    ],
                ],
                'meta_title' => 'Piring Ceper Lis Emas Cap Gunung 10.5 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Ceper Lis Emas Cap Gunung 10.5 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring ceper emas 10.5 inch, piring lis mas cap gunung, piring banquet hotel, piring wedding catering, piring makan mewah keramik',
                'order' => 11,
            ],
            [
                'name' => 'Piring Ceper Lis Warna Cap Gunung 10.5 Inch',
                'slug' => 'piring-ceper-lis-warna-cap-gunung-105-inch',
                'short_desc' => 'Piring ceper lebar 10.5 inci Cap Gunung beraksen garis warna tepi, memberikan sentuhan ceria dan kontemporer pada hidangan utama.',
                'description' => '<p><strong>Piring Ceper Lis Warna Cap Gunung 10.5 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-ceper-lis-warna-cap-gunung-105-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-ceper-lis-warna-cap-gunung-105-inch-2.webp',
                    'services/cap-gunung/piring-ceper-lis-warna-cap-gunung-105-inch-3.webp',
                    'services/cap-gunung/piring-ceper-lis-warna-cap-gunung-105-inch-4.webp',
                    'services/cap-gunung/piring-ceper-lis-warna-cap-gunung-105-inch-5.webp',
                    'services/cap-gunung/piring-ceper-lis-warna-cap-gunung-105-inch-6.webp',
                    'services/cap-gunung/piring-ceper-lis-warna-cap-gunung-105-inch-7.webp',
                    'services/cap-gunung/piring-ceper-lis-warna-cap-gunung-105-inch-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Ukuran',
                        'value' => 'Diameter 10.5 Inch (26.7 cm)',
                    ],
                    [
                        'key' => 'Bentuk',
                        'value' => 'Ceper Datar (Flat Plate)',
                    ],
                    [
                        'key' => 'Finishing',
                        'value' => 'Garis Tepi Berwarna Solid + Permukaan Putih Halus',
                    ],
                    [
                        'key' => 'Ketahanan',
                        'value' => 'Food Grade, Microwave Safe, Dishwasher Safe',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah piring ini cukup lebar untuk steak dan hidangan barat?',
                        'a' => 'Sangat ideal, ukuran 10.5 inci adalah standar internasional untuk main course dan steak.',
                    ],
                    [
                        'q' => 'Bisa kirim sampel untuk presentasi manajemen resto?',
                        'a' => 'Tentu, silakan WhatsApp tim kami untuk pengaturan pengiriman sampel.',
                    ],
                ],
                'meta_title' => 'Piring Ceper Lis Warna Cap Gunung 10.5 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Ceper Lis Warna Cap Gunung 10.5 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring ceper lis warna, piring ceper 10.5 inch cap gunung, piring resto modern, piring main course cafe, distributor piring keramik hotel',
                'order' => 12,
            ],
            [
                'name' => 'Piring Ceper & Piring Kotak Cap Gunung Putih Polos 8 - 10.5 Inch',
                'slug' => 'piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch',
                'short_desc' => 'Koleksi piring ceper bulat dan piring kotak putih polos Cap Gunung 8 hingga 10.5 inci, standar wajib hotel berbintang dan restoran.',
                'description' => '<p><strong>Piring Ceper & Piring Kotak Cap Gunung Putih Polos 8 - 10.5 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch-2.webp',
                    'services/cap-gunung/piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch-3.webp',
                    'services/cap-gunung/piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch-4.webp',
                    'services/cap-gunung/piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch-5.webp',
                    'services/cap-gunung/piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch-6.webp',
                    'services/cap-gunung/piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch-7.webp',
                    'services/cap-gunung/piring-ceper-dan-kotak-cap-gunung-putih-polos-8-105-inch-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Varian Bentuk',
                        'value' => 'Bulat Ceper & Kotak (Square Plate)',
                    ],
                    [
                        'key' => 'Rentang Ukuran',
                        'value' => '8 inch, 9 inch, 10 inch, 10.5 inch',
                    ],
                    [
                        'key' => 'Warna',
                        'value' => 'Pure White Porcelain Glossy',
                    ],
                    [
                        'key' => 'Standar Mutu',
                        'value' => 'Heavy Duty Commercial Grade HORECA',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah piring putih polos ini mudah tergores pisau makan?',
                        'a' => 'Glasur porselen Cap Gunung memiliki tingkat kekerasan tinggi dan tahan terhadap goresan cutlery standar.',
                    ],
                    [
                        'q' => 'Berapa stok yang ready untuk pengadaan hotel baru?',
                        'a' => 'Kami memegang stok ribuan lusin di gudang untuk pengadaan proyek baru. Silakan WA untuk cek ketersediaan.',
                    ],
                ],
                'meta_title' => 'Piring Ceper & Piring Kotak Cap Gunung Putih Polos 8 - 10.5 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Ceper & Piring Kotak Cap Gunung Putih Polos 8 - 10.5 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring putih polos cap gunung, piring kotak keramik, piring ceper hotel putih, piring kotak resto, supplier piring putih polos grosir',
                'order' => 13,
            ],
            [
                'name' => 'Piring Kecil Keramik Cap Gunung Motif 6 Inch',
                'slug' => 'piring-kecil-keramik-cap-gunung-motif-6-inch',
                'short_desc' => 'Piring kecil diameter 6 inci (15 cm) bermotif Cap Gunung untuk tatakan roti, cake, hidangan pembuka, dan snack cafe.',
                'description' => '<p><strong>Piring Kecil Keramik Cap Gunung Motif 6 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-kecil-keramik-cap-gunung-motif-6-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-kecil-keramik-cap-gunung-motif-6-inch-2.webp',
                    'services/cap-gunung/piring-kecil-keramik-cap-gunung-motif-6-inch-3.webp',
                    'services/cap-gunung/piring-kecil-keramik-cap-gunung-motif-6-inch-4.webp',
                    'services/cap-gunung/piring-kecil-keramik-cap-gunung-motif-6-inch-5.webp',
                    'services/cap-gunung/piring-kecil-keramik-cap-gunung-motif-6-inch-6.webp',
                    'services/cap-gunung/piring-kecil-keramik-cap-gunung-motif-6-inch-7.webp',
                    'services/cap-gunung/piring-kecil-keramik-cap-gunung-motif-6-inch-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Diameter',
                        'value' => '6 Inch (±15.2 cm)',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Porselen Berkualitas',
                    ],
                    [
                        'key' => 'Aplikasi',
                        'value' => 'Side Plate, Dessert, Roti, Snack, Tatakan Cangkir',
                    ],
                    [
                        'key' => 'Perawatan',
                        'value' => 'Mudah dibersihkan, tahan cuci mesin otomatis',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah piring ini praktis untuk display pastry cafe?',
                        'a' => 'Sangat pas untuk ukuran sepotong cake, roti panggang, maupun dimsum.',
                    ],
                    [
                        'q' => 'Berapa jumlah pembelian minimumnya?',
                        'a' => 'Pembelian grosir dimulai dari per dus. WhatsApp kami untuk rincian kuantiti.',
                    ],
                ],
                'meta_title' => 'Piring Kecil Keramik Cap Gunung Motif 6 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Kecil Keramik Cap Gunung Motif 6 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring kecil cap gunung, piring 6 inch motif, piring kue keramik, piring tatakan roti resto, piring snack cafe grosir',
                'order' => 14,
            ],
            [
                'name' => 'Piring Keramik Bohemian Cap Gunung 8 Inch (Diameter 20 cm)',
                'slug' => 'piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm',
                'short_desc' => 'Piring makan keramik motif Bohemian diameter 20 cm Cap Gunung untuk plating menu pasta, hidangan cafe, dan sajian estetik.',
                'description' => '<p><strong>Piring Keramik Bohemian Cap Gunung 8 Inch (Diameter 20 cm)</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm-2.webp',
                    'services/cap-gunung/piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm-3.webp',
                    'services/cap-gunung/piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm-4.webp',
                    'services/cap-gunung/piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm-5.webp',
                    'services/cap-gunung/piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm-6.webp',
                    'services/cap-gunung/piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm-7.webp',
                    'services/cap-gunung/piring-keramik-bohemian-cap-gunung-8-inch-diameter-20cm-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Desain',
                        'value' => 'Bohemian Pattern Full Color',
                    ],
                    [
                        'key' => 'Diameter',
                        'value' => '8 Inch (20 cm)',
                    ],
                    [
                        'key' => 'Bahan',
                        'value' => 'Stoneware Ceramic Food Grade SNI',
                    ],
                    [
                        'key' => 'Keunggulan',
                        'value' => 'Desain visual memikat, sangat fotogenik untuk foto menu',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah motifnya aman bersentuhan langsung dengan makanan berminyak / asam?',
                        'a' => 'Ya, 100% food grade safe, tidak bereaksi dengan asam saus pasta atau minyak.',
                    ],
                    [
                        'q' => 'Apakah tersedia seri mangkok yang bermotif senada?',
                        'a' => 'Tersedia! Anda bisa memadukan dengan Mangkok Keramik Bohemian Cap Gunung untuk set lengkap.',
                    ],
                ],
                'meta_title' => 'Piring Keramik Bohemian Cap Gunung 8 Inch (Diameter 20 cm) Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Keramik Bohemian Cap Gunung 8 Inch (Diameter 20 cm). Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring bohemian cap gunung, piring keramik 8 inch motif, piring pasta bohemian, piring cafe estetik, distributor piring motif etnik',
                'order' => 15,
            ],
            [
                'name' => 'Piring Keramik Makan Lis Emas Cap Gunung 8 - 9 Inch',
                'slug' => 'piring-keramik-makan-lis-emas-cap-gunung-8-9-inch',
                'short_desc' => 'Piring makan keramik lis emas klasik ukuran 8 hingga 9 inci Cap Gunung untuk hidangan makan utama catering resepsi dan resto keluarga.',
                'description' => '<p><strong>Piring Keramik Makan Lis Emas Cap Gunung 8 - 9 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-keramik-makan-lis-emas-cap-gunung-8-9-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-keramik-makan-lis-emas-cap-gunung-8-9-inch-2.webp',
                    'services/cap-gunung/piring-keramik-makan-lis-emas-cap-gunung-8-9-inch-3.webp',
                    'services/cap-gunung/piring-keramik-makan-lis-emas-cap-gunung-8-9-inch-4.webp',
                    'services/cap-gunung/piring-keramik-makan-lis-emas-cap-gunung-8-9-inch-5.webp',
                    'services/cap-gunung/piring-keramik-makan-lis-emas-cap-gunung-8-9-inch-6.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Pilihan Ukuran',
                        'value' => '8 Inch (20 cm) dan 9 Inch (23 cm)',
                    ],
                    [
                        'key' => 'Bentuk',
                        'value' => 'Cekung Sedang (Dinner Rim Plate)',
                    ],
                    [
                        'key' => 'Hiasan',
                        'value' => 'Garis Emas Murni Tepi Mewah',
                    ],
                    [
                        'key' => 'Karakteristik',
                        'value' => 'Kapasitas nasi dan lauk pas untuk porsi makan Indonesia',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Mengapa piring lis emas Cap Gunung sangat diminati pengusaha catering?',
                        'a' => 'Karena kombinasi kilau emas yang mewah dengan harga bersahabat dan ketahanan material yang teruji di ratusan event.',
                    ],
                    [
                        'q' => 'Bagaimana kemasan kirim untuk luar pulau Jawa?',
                        'a' => 'Kami berpengalaman mengirim kontainer dan armada truk ke Sumatera, Kalimantan, Sulawesi, hingga Papua dengan proteksi maksimal.',
                    ],
                ],
                'meta_title' => 'Piring Keramik Makan Lis Emas Cap Gunung 8 - 9 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Keramik Makan Lis Emas Cap Gunung 8 - 9 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring makan lis emas cap gunung, piring 9 inch list emas, piring keramik catering, piring makan pesta grosir, piring cap gunung surabaya',
                'order' => 16,
            ],
            [
                'name' => 'Piring Lengkok Cap Gunung Motif Rose 8 Inch (Diameter 20 cm)',
                'slug' => 'piring-lengkok-cap-gunung-motif-rose-8-inch-diameter-20cm',
                'short_desc' => 'Piring lengkok cekung motif bunga mawar Cap Gunung diameter 20 cm, model legendaris terfavorit rumah makan dan warung kuliner.',
                'description' => '<p><strong>Piring Lengkok Cap Gunung Motif Rose 8 Inch (Diameter 20 cm)</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-lengkok-cap-gunung-motif-rose-8-inch-diameter-20cm-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-lengkok-cap-gunung-motif-rose-8-inch-diameter-20cm-2.webp',
                    'services/cap-gunung/piring-lengkok-cap-gunung-motif-rose-8-inch-diameter-20cm-3.webp',
                    'services/cap-gunung/piring-lengkok-cap-gunung-motif-rose-8-inch-diameter-20cm-4.webp',
                    'services/cap-gunung/piring-lengkok-cap-gunung-motif-rose-8-inch-diameter-20cm-5.webp',
                    'services/cap-gunung/piring-lengkok-cap-gunung-motif-rose-8-inch-diameter-20cm-6.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Model',
                        'value' => 'Piring Lengkok Cekung (Deep Plate)',
                    ],
                    [
                        'key' => 'Motif',
                        'value' => 'Bunga Rose (Mawar Klasik Cap Gunung)',
                    ],
                    [
                        'key' => 'Diameter',
                        'value' => '8 Inch (20 cm)',
                    ],
                    [
                        'key' => 'Karakteristik',
                        'value' => 'Bisa menampung makanan dengan kuah tanpa tumpah',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah motif rose ini produk original Cap Gunung?',
                        'a' => '100% Original Cap Gunung dengan cap stempel autentik di bagian bawah piring.',
                    ],
                    [
                        'q' => 'Bagaimana cara pemesanan grosir per koli / karton?',
                        'a' => 'Silakan klik tombol WhatsApp kami untuk informasi jumlah isi koli dan expedisi cargo termurah.',
                    ],
                ],
                'meta_title' => 'Piring Lengkok Cap Gunung Motif Rose 8 Inch (Diameter 20 cm) Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Lengkok Cap Gunung Motif Rose 8 Inch (Diameter 20 cm). Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring motif rose cap gunung, piring bunga mawar keramik, piring lengkok 8 inch, piring makan jadul cap gunung, grosir piring motif bunga',
                'order' => 17,
            ],
            [
                'name' => 'Piring Oval Saji Cap Gunung 12 - 18 Inch',
                'slug' => 'piring-oval-saji-cap-gunung-12-18-inch',
                'short_desc' => 'Piring saji oval keramik tebal 12 hingga 18 inci Cap Gunung untuk menu ikan bakar, seafood platter, dan hidangan prasmanan tengah meja.',
                'description' => '<p><strong>Piring Oval Saji Cap Gunung 12 - 18 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-oval-saji-cap-gunung-12-18-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-oval-saji-cap-gunung-12-18-inch-2.webp',
                    'services/cap-gunung/piring-oval-saji-cap-gunung-12-18-inch-3.webp',
                    'services/cap-gunung/piring-oval-saji-cap-gunung-12-18-inch-4.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Bentuk',
                        'value' => 'Oval Panjang Saji (Fish / Meat Platter)',
                    ],
                    [
                        'key' => 'Pilihan Ukuran',
                        'value' => '12 inch, 14 inch, 16 inch, 18 inch',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Tebal Heavy Duty',
                    ],
                    [
                        'key' => 'Kegunaan',
                        'value' => 'Ikan Gurame / Kakap Bakar, Kepiting, Bebek Goreng, Prasmanan',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah piring oval 18 inch kuat menahan beban ikan bakar besar?',
                        'a' => 'Sangat kuat, dirancang khusus dengan ketebalan ekstra dan penopang bawah yang stabil.',
                    ],
                    [
                        'q' => 'Apakah tersedia warna selain putih?',
                        'a' => 'Standar produksi adalah putih porselen bersih. Hubungi kami via WA untuk ketersediaan motif khusus.',
                    ],
                ],
                'meta_title' => 'Piring Oval Saji Cap Gunung 12 - 18 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Oval Saji Cap Gunung 12 - 18 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring oval cap gunung, piring saji ikan bakar, piring oval keramik besar, piring seafood platter, piring oval 14 inch 16 inch grosir',
                'order' => 18,
            ],
            [
                'name' => 'Piring Stoneware Cap Gunung Motif 10.5 Inch',
                'slug' => 'piring-stoneware-cap-gunung-motif-105-inch',
                'short_desc' => 'Piring bahan stoneware 10.5 inci Cap Gunung bermotif elegan untuk restoran modern, steakhouse, dan resort perhotelan.',
                'description' => '<p><strong>Piring Stoneware Cap Gunung Motif 10.5 Inch</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-stoneware-cap-gunung-motif-105-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-stoneware-cap-gunung-motif-105-inch-2.webp',
                    'services/cap-gunung/piring-stoneware-cap-gunung-motif-105-inch-3.webp',
                    'services/cap-gunung/piring-stoneware-cap-gunung-motif-105-inch-4.webp',
                    'services/cap-gunung/piring-stoneware-cap-gunung-motif-105-inch-5.webp',
                    'services/cap-gunung/piring-stoneware-cap-gunung-motif-105-inch-6.webp',
                    'services/cap-gunung/piring-stoneware-cap-gunung-motif-105-inch-7.webp',
                    'services/cap-gunung/piring-stoneware-cap-gunung-motif-105-inch-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Premium Stoneware Ceramic (High Fired)',
                    ],
                    [
                        'key' => 'Ukuran',
                        'value' => '10.5 Inch (26.7 cm)',
                    ],
                    [
                        'key' => 'Tekstur',
                        'value' => 'Glaze Kokoh, Tahan Benturan dan Goresan Cutlery',
                    ],
                    [
                        'key' => 'Rekomendasi',
                        'value' => 'Restoran Fine Casual, Steakhouse, Hotel Resort',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apa keunggulan piring stoneware dibanding keramik biasa?',
                        'a' => 'Stoneware dibakar pada suhu lebih tinggi sehingga memiliki densitas lebih padat, tahan cuci komersial, dan berkesan lebih kokoh.',
                    ],
                    [
                        'q' => 'Bagaimana prosedur order untuk proyek horeka baru?',
                        'a' => 'Hubungi tim kami via WhatsApp untuk mendapatkan quotation resmi dan konsultasi jadwal pengiriman.',
                    ],
                ],
                'meta_title' => 'Piring Stoneware Cap Gunung Motif 10.5 Inch Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Stoneware Cap Gunung Motif 10.5 Inch. Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring stoneware cap gunung, piring stoneware 10.5 inch, piring steak stoneware, tableware keramik tebal, grosir piring resto premium',
                'order' => 19,
            ],
            [
                'name' => 'Piring Topi Cap Gunung Motif 8.5 Inch (Rimmed Soup)',
                'slug' => 'piring-topi-cap-gunung-motif-85-inch',
                'short_desc' => 'Piring model topi (rimmed soup / pasta plate) 8.5 inci Cap Gunung dengan bibir lebar elegan untuk pasta, risotto, dan sup kental.',
                'description' => '<p><strong>Piring Topi Cap Gunung Motif 8.5 Inch (Rimmed Soup)</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/piring-topi-cap-gunung-motif-85-inch-1.webp',
                'gallery' => [
                    'services/cap-gunung/piring-topi-cap-gunung-motif-85-inch-2.webp',
                    'services/cap-gunung/piring-topi-cap-gunung-motif-85-inch-3.webp',
                    'services/cap-gunung/piring-topi-cap-gunung-motif-85-inch-4.webp',
                    'services/cap-gunung/piring-topi-cap-gunung-motif-85-inch-5.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Tipe Model',
                        'value' => 'Piring Topi / Rimmed Pasta & Soup Plate',
                    ],
                    [
                        'key' => 'Diameter Total',
                        'value' => '8.5 Inch (±21.5 cm)',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Porselen Glaze Mengkilap',
                    ],
                    [
                        'key' => 'Aplikasi Menu',
                        'value' => 'Pasta Spaghetti, Risotto, Zuppa Soup, Cream Soup',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah model piring topi ini cocok untuk cafe bergaya western?',
                        'a' => 'Sangat cocok, bibir lebar memberikan ruang garnish yang luas untuk plating berstandar chef.',
                    ],
                    [
                        'q' => 'Apakah bisa dibeli dalam jumlah grosir?',
                        'a' => 'Ya, kami melayani suplai grosir rutin untuk cafe dan restoran di seluruh Indonesia.',
                    ],
                ],
                'meta_title' => 'Piring Topi Cap Gunung Motif 8.5 Inch (Rimmed Soup) Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Piring Topi Cap Gunung Motif 8.5 Inch (Rimmed Soup). Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'piring topi cap gunung, piring pasta rimmed, piring topi 8.5 inch, piring sup bibir lebar, supplier piring resto italia cafe',
                'order' => 20,
            ],
            [
                'name' => 'Sendok Bebek Keramik Cap Gunung (Sup & Bubur)',
                'slug' => 'sendok-bebek-keramik-cap-gunung-sup-bubur',
                'short_desc' => 'Sendok bebek keramik porselen Cap Gunung tahan panas kuah mendidih, higienis untuk resto Chinese food, bakso, mie, dan bubur.',
                'description' => '<p><strong>Sendok Bebek Keramik Cap Gunung (Sup & Bubur)</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/sendok-bebek-keramik-cap-gunung-sup-bubur-1.webp',
                'gallery' => [
                    'services/cap-gunung/sendok-bebek-keramik-cap-gunung-sup-bubur-2.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Bentuk / Tipe',
                        'value' => 'Sendok Bebek Tradisional (Asian Soup Spoon)',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Keramik Porselen 100% Food Safe',
                    ],
                    [
                        'key' => 'Fitur',
                        'value' => 'Tahan Panas Kuah Mendidih, Tidak Menghantarkan Panas ke Tangan',
                    ],
                    [
                        'key' => 'Aplikasi',
                        'value' => 'Bubur Ayam, Bakso, Soto, Ramen, Dimsum, Sup',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah sendok bebek ini tersedia varian polos dan motif?',
                        'a' => 'Ya, tersedia pilihan putih polos klasik dan pilihan motif bunga Cap Gunung.',
                    ],
                    [
                        'q' => 'Berapa isi per box untuk pembelian sendok bebek?',
                        'a' => 'Biasanya dikemas per lusin (12 pcs) atau grosir per karton besar. Hubungi sales kami di WhatsApp.',
                    ],
                ],
                'meta_title' => 'Sendok Bebek Keramik Cap Gunung (Sup & Bubur) Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Sendok Bebek Keramik Cap Gunung (Sup & Bubur). Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'sendok bebek keramik cap gunung, sendok bubur keramik, sendok sup keramik, sendok chinese food keramik, grosir sendok keramik resto',
                'order' => 21,
            ],
            [
                'name' => 'Tea Set Susun Keramik Cap Gunung (Teapot & Cangkir)',
                'slug' => 'tea-set-susun-keramik-cap-gunung-teapot-cangkir',
                'short_desc' => 'Set teko teh susun keramik Cap Gunung yang kompak dan hemat tempat, ideal untuk layanan teh cafe, hotel lounge, dan gift eksklusif.',
                'description' => '<p><strong>Tea Set Susun Keramik Cap Gunung (Teapot & Cangkir)</strong> merupakan salah satu produk piranti makan unggulan dari <strong>Cap Gunung</strong> yang didistribusikan secara resmi oleh <strong>UD. Sukses Makmur (Pusat Piring Keramik)</strong>. Dirancang khusus untuk memenuhi standar operasional industri HORECA (Hotel, Restoran, Cafe, Catering) dan jaringan kuliner, produk ini menggabungkan kekuatan material keramik berkualitas tinggi dengan estetika penyajian yang profesional.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar keamanan kontak pangan (SNI), bebas zat berbahaya (lead-free & cadmium-free), higienis, serta tidak menyerap bau maupun noda minyak.</li>\n    <li><strong>Ketahanan Suhu Tinggi:</strong> Aman digunakan pada microwave, oven pemanas, serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Ketebalan & Durabilitas Teruji:</strong> Formulasi keramik Cap Gunung memiliki kepadatan ekstra yang tahan benturan ringan, menjadikannya pilihan investasi hemat jangka panjang bagi pelaku usaha kuliner.</li>\n    <li><strong>Presisi Tampilan & Finishing:</strong> Lapisan glasur halus mengkilap memberikan kesan sajian yang bersih, elegan, dan meningkatkan selera makan para tamu restoran Anda.</li>\n</ul>\n\n<h3>Kebutuhan Grosir & Pengadaan B2B</h3>\n<p>Kami melayani pembelian partai besar, pengadaan piranti makan untuk pembukaan cabang restoran baru, perlengkapan catering pernikahan, hingga pasokan toko pecah belah dan reseller di seluruh Indonesia. Setiap pengiriman ke luar kota dan luar pulau dikemas menggunakan proteksi berlapis (sekat karton tebal, bubble wrap tebal, dan opsi peti kayu) untuk menjamin pesanan sampai di lokasi Anda dengan utuh dan aman.</p>\n\n<div style="background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;">\n    <h4 style="margin:0 0 .5rem;color:#1E293B;font-size:1rem;">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style="margin:0 0 .75rem;font-size:.875rem;color:#475569;">Untuk informasi penawaran harga grosir terbaik, ketersediaan stok volume besar, sampel produk, serta perhitungan ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui tombol WhatsApp yang tersedia.</p>\n</div>',
                'image' => 'services/cap-gunung/tea-set-susun-keramik-cap-gunung-teapot-cangkir-1.webp',
                'gallery' => [
                    'services/cap-gunung/tea-set-susun-keramik-cap-gunung-teapot-cangkir-2.webp',
                    'services/cap-gunung/tea-set-susun-keramik-cap-gunung-teapot-cangkir-3.webp',
                    'services/cap-gunung/tea-set-susun-keramik-cap-gunung-teapot-cangkir-4.webp',
                    'services/cap-gunung/tea-set-susun-keramik-cap-gunung-teapot-cangkir-5.webp',
                    'services/cap-gunung/tea-set-susun-keramik-cap-gunung-teapot-cangkir-6.webp',
                    'services/cap-gunung/tea-set-susun-keramik-cap-gunung-teapot-cangkir-7.webp',
                    'services/cap-gunung/tea-set-susun-keramik-cap-gunung-teapot-cangkir-8.webp',
                ],
                'specs' => [
                    [
                        'key' => 'Brand / Merk',
                        'value' => 'Cap Gunung',
                    ],
                    [
                        'key' => 'Konsep',
                        'value' => 'Stackable Tea-for-One (Teko Menumpuk di Atas Cangkir)',
                    ],
                    [
                        'key' => 'Material',
                        'value' => 'Fine Ceramic Tahan Panas Seduhan Teh',
                    ],
                    [
                        'key' => 'Komponen',
                        'value' => '1 Teapot dengan Tutup + 1 Cangkir Teh Pasang',
                    ],
                    [
                        'key' => 'Keunggulan',
                        'value' => 'Penyimpanan ringkas, tampilan unik, sajian teh personal',
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah teko sudah dilengkapi saringan daun teh di bagian corong?',
                        'a' => 'Ya, corong dalam memiliki lubang saring bawaan untuk menyaring ampas daun teh kasar.',
                    ],
                    [
                        'q' => 'Bisa dijadikan hampers atau souvenir eksklusif?',
                        'a' => 'Sangat diminati untuk souvenir kantor, event gathering, dan paket hampers eksklusif.',
                    ],
                ],
                'meta_title' => 'Tea Set Susun Keramik Cap Gunung (Teapot & Cangkir) Grosir Distributor | Pusat Piring Keramik',
                'meta_desc' => 'Distributor resmi Tea Set Susun Keramik Cap Gunung (Teapot & Cangkir). Suplai piring & mangkok keramik grosir pabrik untuk restoran, cafe, hotel, dan catering.',
                'meta_keywords' => 'tea set susun cap gunung, teko teh keramik susun, tea for one set, tea set cafe hotel, souvenir tea set keramik grosir',
                'order' => 22,
            ],
        ];

        foreach ($products as $p) {
            $desc = str_replace('\\n', "\n", $p['description']);

            Service::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'service_category_id' => $capGunungCategory->id,
                    'name'                => $p['name'],
                    'short_desc'          => $p['short_desc'],
                    'description'         => $desc,
                    'image'               => $p['image'],
                    'gallery'             => $p['gallery'],
                    'specifications'      => $p['specs'],
                    'faqs'                => $p['faqs'],
                    'price'               => null, // Tanpa harga, arahkan hubungi via WA
                    'rating'              => 5.0,
                    'sold_count'          => null,
                    'order'               => $p['order'],
                    'is_active'           => true,
                    'meta_title'          => $p['meta_title'],
                    'meta_desc'           => $p['meta_desc'],
                    'meta_keywords'       => $p['meta_keywords'],
                ]
            );
            $this->command->info("  + Seeded product: {$p['name']}");
        }

        // 3. Clear cache
        Cache::forget('home_page_data');
        Cache::forget('services_page_data');
        Cache::forget('sitemap_xml_content');

        $this->command->info("✓ Successfully seeded all 22 Cap Gunung products with WebP images and B2B content!");
    }
}
