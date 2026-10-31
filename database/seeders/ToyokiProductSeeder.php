<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ToyokiProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori Toyoki
        $category = ServiceCategory::updateOrCreate(
            ['slug' => 'toyoki'],
            [
                'name'          => 'Toyoki',
                'description'   => 'Koleksi peralatan makan keramik merk Toyoki terlengkap untuk kebutuhan restoran, warung makan, cafe, dan katering. Menyediakan piring keramik, mangkok ayam jago, cangkir set tropical, tea set, mangkok list coklat, hingga mug keramik food grade berstandar SNI.',
                'meta_title'    => 'Distributor Peralatan Makan Keramik Toyoki Grosir Pabrik',
                'meta_desc'     => 'Pusat grosir dan distributor peralatan makan keramik Toyoki resmi. Suplai piring keramik, mangkok ayam jago, tea set, dan cangkir keramik untuk restoran, hotel, dan katering.',
                'meta_keywords' => 'toyoki keramik, piring toyoki, mangkok ayam jago toyoki, cangkir toyoki, tea set toyoki, distributor peralatan makan keramik, supplier piring keramik, grosir keramik surabaya',
                'parent_id'     => null,
            ]
        );

        $this->command->info("Category ready: Toyoki (ID: {$category->id})");

        // Template deskripsi dengan keyword wajib: supplier, pusat, distributor peralatan makan keramik / distributor piring keramik, peralatan makan keramik
        // Tanpa emdash dan tanda strip panjang
        $desc_template = fn(string $nama, string $peruntukan, string $fitur_khusus) =>
            "<p><strong>{$nama}</strong> merupakan salah satu produk unggulan dari <strong>Toyoki</strong> yang didistribusikan resmi oleh UD. Sukses Makmur sebagai <strong>pusat</strong> dan <strong>distributor peralatan makan keramik</strong> di Indonesia. Sebagai <strong>supplier</strong> terpercaya untuk jaringan HORECA (Hotel, Restoran, Cafe, Catering) dan usaha kuliner, kami menyediakan produk ini langsung dari pabrik dengan jaminan mutu dan standar keamanan pangan.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Material Keramik Berkualitas (Food Grade):</strong> Memenuhi standar SNI untuk kontak makanan panas maupun dingin, bebas zat berbahaya, higienis, dan tidak menyerap noda minyak.</li>\n    <li><strong>Tahan Suhu Tinggi:</strong> Aman digunakan pada microwave pemanas serta tahan pencucian berulang menggunakan mesin pencuci piring komersial (commercial dishwasher safe).</li>\n    <li><strong>Glasur Halus Tahan Gores:</strong> Lapisan glasur mengkilap melindungi motif agar tidak mudah pudar dan permukaan piring tetap bersih elegan.</li>\n    <li><strong>{$fitur_khusus}</strong></li>\n</ul>\n\n<h3>Pilihan Tepat untuk Pengadaan Usaha</h3>\n<p>{$peruntukan} Sebagai <strong>distributor piring keramik</strong> dan <strong>peralatan makan keramik</strong> berpengalaman, kami melayani pemesanan partai besar, pengadaan cabang baru, maupun pasokan rutin ke seluruh wilayah Indonesia dengan proteksi packing berlapis.</p>\n\n<div style=\"background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;\">\n    <h4 style=\"margin:0 0 .5rem;color:#1E293B;font-size:1rem;\">Informasi Pemesanan Grosir & Kemitraan</h4>\n    <p style=\"margin:0 0 .75rem;font-size:.875rem;color:#475569;\">Untuk konsultasi kuantiti dus, ketersediaan stok, sampel produk, dan rekomendasi ekspedisi kargo termurah ke kota Anda, silakan hubungi tim sales kami melalui WhatsApp.</p>\n</div>";

        $faq_umum = [
            ['q' => 'Berapa minimal pemesanan untuk harga grosir?', 'a' => 'Kami melayani pemesanan grosir per karton/dus maupun partai besar untuk proyek restoran dan hotel. Hubungi tim sales kami via WhatsApp untuk penawaran terbaik.'],
            ['q' => 'Apakah aman dikirim ke luar kota atau luar pulau?', 'a' => 'Sangat aman. Setiap pengiriman dilindungi sekat karton tebal, bubble wrap berlapis, dan opsi peti kayu kokoh.'],
        ];

        $products = [

            // 1
            [
                'name'         => 'Cangkir Set Tropical Toyoki',
                'slug'         => 'cangkir-set-tropical-toyoki',
                'short_desc'   => 'Set cangkir dan lepek keramik Toyoki dengan motif floral Tropical warna biru dan merah cerah, cocok untuk penyajian teh dan kopi di kafe, restoran, dan hotel.',
                'description'  => $desc_template(
                    'Cangkir Set Tropical Toyoki',
                    'Sangat cocok untuk kafe bertema tropical, kedai teh, restoran keluarga, hotel, dan katering pesta kebun yang menginginkan nuansa penyajian segar dan ceria.',
                    'Motif bunga Tropical cerah yang dibakar menyatu dengan glasur keramik, memberikan tampilan visual menarik di meja tamu.'
                ),
                'image'        => 'services/toyoki/cangkir-set-tropical-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/cangkir-set-tropical-toyoki-2.webp',
                    'services/toyoki/cangkir-set-tropical-toyoki-3.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe Produk',    'value' => 'Cangkir dan Lepek (Cup and Saucer)'],
                    ['key' => 'Motif / Desain', 'value' => 'Tropical Floral Biru dan Merah'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Ketahanan Suhu', 'value' => 'Microwave Safe dan Dishwasher Safe'],
                    ['key' => 'Peruntukan',     'value' => 'Kafe, Kedai Kopi, Restoran Keluarga, Hotel'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah warna motif tropical tahan lama saat dicuci rutin?', 'a' => 'Ya, motif bunga dibakar pada suhu tinggi sehingga warna tetap cerah dan tidak pudar meski dicuci menggunakan mesin pencuci piring.'],
                ]),
                'meta_title'   => 'Cangkir Set Tropical Toyoki Grosir | Distributor Piring Keramik',
                'meta_desc'    => 'Pusat supplier dan distributor peralatan makan keramik Toyoki resmi. Sedia Cangkir Set Tropical keramik motif bunga untuk kafe, resto, dan hotel.',
                'meta_keywords'=> 'cangkir set tropical toyoki, cangkir motif bunga, cangkir lepek keramik, cangkir kafe tropical, distributor peralatan makan keramik, supplier piring keramik',
                'order'        => 1,
            ],

            // 2
            [
                'name'         => 'Tea Set Keramik Motif Bunga Toyoki',
                'slug'         => 'tea-set-keramik-motif-bunga-toyoki',
                'short_desc'   => 'Set perlengkapan minum teh keramik Toyoki lengkap terdiri dari teko porselen dan 5 set cangkir saucer bermotif bunga carnation merah kuning elegan.',
                'description'  => $desc_template(
                    'Tea Set Keramik Motif Bunga Toyoki',
                    'Pilihan tepat untuk hotel berbintang, ruang pertemuan korporat, restoran oriental, tea house, serta kado souvenir eksklusif acara keluarga dan perusahaan.',
                    'Set lengkap teko porselen berkapasitas besar dengan 5 cangkir dan lepek serasi, dirancang dengan pegangan teko yang seimbang dan corong penuang presisi anti tumpah.'
                ),
                'image'        => 'services/toyoki/tea-set-keramik-motif-bunga-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/tea-set-keramik-motif-bunga-toyoki-2.webp',
                    'services/toyoki/tea-set-keramik-motif-bunga-toyoki-3.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Kelengkapan',    'value' => '1 Teko Keramik + 5 Cangkir + 5 Lepek'],
                    ['key' => 'Motif / Desain', 'value' => 'Bunga Carnation Merah dan Kuning'],
                    ['key' => 'Material',       'value' => 'Fine Ceramic Porselen Tahan Panas'],
                    ['key' => 'Fitur',          'value' => 'Corong Presisi, Tutup Rapat, Handle Ergonomis'],
                    ['key' => 'Peruntukan',     'value' => 'Tea House, Hotel, VIP Meeting, Restoran'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah teko tahan panas untuk seduhan air mendidih langsung?', 'a' => 'Ya, material keramik tebal Toyoki tahan terhadap thermal shock air mendidih untuk menyeduh teh daun atau bunga.'],
                ]),
                'meta_title'   => 'Tea Set Keramik Motif Bunga Toyoki Grosir | Distributor Peralatan Makan Keramik',
                'meta_desc'    => 'Distributor peralatan makan keramik Toyoki. Sedia Tea Set Keramik motif bunga lengkap teko dan cangkir lepek untuk restoran, hotel, dan souvenir.',
                'meta_keywords'=> 'tea set keramik toyoki, teko cangkir set keramik, set teh motif bunga, tea set hotel, distributor peralatan makan keramik, supplier keramik resto',
                'order'        => 2,
            ],

            // 3
            [
                'name'         => 'Dinner Set Ayam Jago Toyoki',
                'slug'         => 'dinner-set-ayam-jago-toyoki',
                'short_desc'   => 'Paket lengkap peralatan makan keramik motif Ayam Jago klasik Toyoki, mencakup piring makan 8 inch, mangkok bakso, mangkok soto, mangkok saus, dan cangkir set.',
                'description'  => $desc_template(
                    'Dinner Set Ayam Jago Toyoki',
                    'Sangat ideal untuk pengadaan awal atau peremajaan tableware restoran masakan nusantara, rumah makan bakso, warung soto modern, dan hotel yang mengusung tema kuliner Indonesia.',
                    'Menghadirkan keseragaman tema Ayam Jago legendaris dari piring makan, mangkok aneka ukuran, hingga cangkir minum di meja tamu.'
                ),
                'image'        => 'services/toyoki/dinner-set-ayam-jago-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/dinner-set-ayam-jago-toyoki-2.webp',
                    'services/toyoki/dinner-set-ayam-jago-toyoki-3.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe Paket',     'value' => 'Full Dinner Set Seri Ayam Jago'],
                    ['key' => 'Kelengkapan',    'value' => 'Piring 8 inch, Mangkok 6.25 inch, Mangkok 4.75 inch, Mangkok Saus, Cangkir Set'],
                    ['key' => 'Motif',          'value' => 'Ayam Jago Tradisional Asli Toyoki'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Peruntukan',     'value' => 'Rumah Makan Nusantara, Restoran Soto Bakso, Katering'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah isi set bisa disesuaikan dengan kebutuhan kuantiti tertentu?', 'a' => 'Bisa. Kami melayani pemesanan paket lengkap maupun satuan per item sesuai kebutuhan usaha Anda.'],
                ]),
                'meta_title'   => 'Dinner Set Ayam Jago Toyoki Grosir | Distributor Piring Keramik',
                'meta_desc'    => 'Pusat supplier dan distributor piring keramik Toyoki. Sedia Dinner Set Ayam Jago lengkap untuk restoran soto, bakso, dan kuliner nusantara.',
                'meta_keywords'=> 'dinner set ayam jago toyoki, paket piring mangkok ayam jago, keramik ayam jago lengkap, distributor piring keramik, supplier peralatan makan keramik',
                'order'        => 3,
            ],

            // 4
            [
                'name'         => 'Mangkok Ayam Jago 6.25 Inch Toyoki',
                'slug'         => 'mangkok-ayam-jago-625-inch-toyoki',
                'short_desc'   => 'Mangkok keramik ukuran 6.25 inch motif Ayam Jago legendaris Toyoki, ukuran standar paling populer untuk sajian bakso, mie ayam, ramen, dan rawon.',
                'description'  => $desc_template(
                    'Mangkok Ayam Jago 6.25 Inch Toyoki',
                    'Pilihan utama untuk pengusaha kuliner bakso, mie ayam, soto mie, cuanki, dan aneka masakan berkuah di seluruh Indonesia.',
                    'Diameter 6.25 inci dengan kedalaman ideal untuk porsi makan kenyang, bibir mangkok tebal tahan benturan ringan dan tidak mudah gompal.'
                ),
                'image'        => 'services/toyoki/mangkok-ayam-jago-625-inch-toyoki-1.webp',
                'gallery'      => [],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Ukuran',         'value' => 'Diameter 6.25 inch (sekitar 16 cm)'],
                    ['key' => 'Motif',          'value' => 'Ayam Jago Tradisional Toyoki'],
                    ['key' => 'Material',       'value' => 'Keramik Tebal Food Grade'],
                    ['key' => 'Ketahanan',      'value' => 'Tahan Panas Kuah Mendidih, Dishwasher Safe'],
                    ['key' => 'Peruntukan',     'value' => 'Warung Bakso, Mie Ayam, Soto Mie, Resto Kuliner'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah mangkok ini kuat dicuci berulang kali di warung ramai?', 'a' => 'Sangat kuat. Dibuat dari keramik padat berkualitas yang tahan benturan ringan pada operasional warung padat.'],
                ]),
                'meta_title'   => 'Mangkok Ayam Jago 6.25 Inch Toyoki Grosir | Distributor Peralatan Makan Keramik',
                'meta_desc'    => 'Distributor peralatan makan keramik Toyoki resmi. Sedia Mangkok Ayam Jago 6.25 inch tebal untuk warung bakso dan mie ayam grosir pabrik.',
                'meta_keywords'=> 'mangkok ayam jago 6.25 inch toyoki, mangkok bakso ayam jago, mangkok mie ayam keramik, supplier mangkok bakso, distributor peralatan makan keramik',
                'order'        => 4,
            ],

            // 5
            [
                'name'         => 'Mangkok Soto Ayam Jago 4.75 Inch Toyoki',
                'slug'         => 'mangkok-soto-ayam-jago-475-inch-toyoki',
                'short_desc'   => 'Mangkok keramik ukuran 4.75 inch motif Ayam Jago Toyoki, dirancang khusus untuk porsi mangkok soto, coto Makassar, sup herbal, dan bubur ayam.',
                'description'  => $desc_template(
                    'Mangkok Soto Ayam Jago 4.75 Inch Toyoki',
                    'Cocok untuk warung soto ayam, soto Betawi, coto Makassar, empal gentong, bubur ayam, dan menu hidangan berkuah hangat porsi sedang.',
                    'Ukuran 4.75 inci yang pas di tangan, menjaga kuah soto tetap hangat lebih lama berkat dinding keramik isolator yang baik.'
                ),
                'image'        => 'services/toyoki/mangkok-soto-ayam-jago-475-inch-toyoki-1.webp',
                'gallery'      => [],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Ukuran',         'value' => 'Diameter 4.75 inch (sekitar 12 cm)'],
                    ['key' => 'Motif',          'value' => 'Ayam Jago Toyoki'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen SNI'],
                    ['key' => 'Keunggulan',     'value' => 'Menahan Panas Kuah, Mudah Ditumpuk'],
                    ['key' => 'Peruntukan',     'value' => 'Warung Soto, Coto Makassar, Sup, Bubur Ayam'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Berapa isi per dus untuk mangkok soto ini?', 'a' => 'Isi per dus umumnya 6 lusin (72 pcs). Hubungi tim kami untuk konfirmasi spesifikasi kemasan dus terkini.'],
                ]),
                'meta_title'   => 'Mangkok Soto Ayam Jago 4.75 Inch Toyoki Grosir | Distributor Piring Keramik',
                'meta_desc'    => 'Pusat distributor peralatan makan keramik Toyoki. Sedia Mangkok Soto Ayam Jago 4.75 inch grosir untuk pengadaan warung soto dan resto nusantara.',
                'meta_keywords'=> 'mangkok soto ayam jago 4.75 inch, mangkok soto keramik toyoki, mangkok soto lamongan, supplier mangkok soto, distributor piring keramik',
                'order'        => 5,
            ],

            // 6
            [
                'name'         => 'Mangkok Saus Sambal Ayam Jago Toyoki',
                'slug'         => 'mangkok-saus-sambal-ayam-jago-toyoki',
                'short_desc'   => 'Mangkok kecil keramik motif Ayam Jago Toyoki untuk wadah sambal, kecap, saus cocolan, acar, dan kondimen pelengkap di meja makan.',
                'description'  => $desc_template(
                    'Mangkok Saus Sambal Ayam Jago Toyoki',
                    'Wadah kondimen wajib untuk meja rumah makan bakso, soto, restoran seafood, dan warung kuliner yang menyajikan aneka sambal dan saus.',
                    'Bentuk mungil namun kokoh dengan motif ayam jago yang presisi, melengkapi tampilan keseluruhan meja makan bertema tradisional.'
                ),
                'image'        => 'services/toyoki/mangkok-saus-sambal-ayam-jago-toyoki-1.webp',
                'gallery'      => [],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe Produk',    'value' => 'Mangkok Kecil Kondimen / Saus Sambal'],
                    ['key' => 'Motif',          'value' => 'Ayam Jago Toyoki'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade'],
                    ['key' => 'Peruntukan',     'value' => 'Sambal, Kecap, Saus Cocolan, Acar, Bawang Goreng'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Bisa pesan mangkok saus ini bersamaan dengan mangkok bakso?', 'a' => 'Bisa. Kami melayani kombinasi order berbagai ukuran mangkok dalam satu pengiriman kargo.'],
                ]),
                'meta_title'   => 'Mangkok Saus Sambal Ayam Jago Toyoki Grosir | Distributor Peralatan Makan Keramik',
                'meta_desc'    => 'Distributor peralatan makan keramik Toyoki. Sedia Mangkok Saus Sambal Ayam Jago kecil keramik untuk rumah makan dan restoran kuliner.',
                'meta_keywords'=> 'mangkok saus ayam jago toyoki, mangkok sambal keramik, piring kecil kecap sambal, tempat sambal resto, distributor peralatan makan keramik',
                'order'        => 6,
            ],

            // 7
            [
                'name'         => 'Piring Makan Ayam Jago 8 Inch Toyoki',
                'slug'         => 'piring-makan-ayam-jago-8-inch-toyoki',
                'short_desc'   => 'Piring makan keramik ukuran 8 inch motif Ayam Jago klasik Toyoki, pilihan piring saji utama untuk hidangan nasi, lauk, dan menu nusantara.',
                'description'  => $desc_template(
                    'Piring Makan Ayam Jago 8 Inch Toyoki',
                    'Sangat cocok untuk rumah makan padang, warung nasi campur, restoran seafood, katering prasmanan, dan kedai makan bernuansa retro Indonesia.',
                    'Diameter 8 inci berdesain cekung sedang (semi-deep) yang serbaguna untuk menu nasi rames, nasi uduk, hingga lauk berkuah kental.'
                ),
                'image'        => 'services/toyoki/piring-makan-ayam-jago-8-inch-toyoki-1.webp',
                'gallery'      => [],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Ukuran',         'value' => 'Diameter 8 inch (sekitar 20 cm)'],
                    ['key' => 'Model',          'value' => 'Piring Cekung Sedang (Semi Deep Plate)'],
                    ['key' => 'Motif',          'value' => 'Ayam Jago Tradisional Toyoki'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen SNI Tahan Panas'],
                    ['key' => 'Peruntukan',     'value' => 'Rumah Makan, Katering, Warung Makan Nusantara'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah piring ini tahan gores sendok garpu?', 'a' => 'Ya, lapisan glasur padat Toyoki dirancang tahan goresan peralatan makan stainless steel sehari-hari.'],
                ]),
                'meta_title'   => 'Piring Makan Ayam Jago 8 Inch Toyoki Grosir | Distributor Piring Keramik',
                'meta_desc'    => 'Pusat supplier dan distributor piring keramik Toyoki resmi. Sedia Piring Makan Ayam Jago 8 inch grosir pabrik untuk restoran dan katering.',
                'meta_keywords'=> 'piring makan ayam jago 8 inch toyoki, piring ayam jago keramik, piring nasi warung makan, supplier piring ayam jago, distributor piring keramik',
                'order'        => 7,
            ],

            // 8
            [
                'name'         => 'Piring dan Mangkok List Coklat Toyoki',
                'slug'         => 'piring-dan-mangkok-list-coklat-toyoki',
                'short_desc'   => 'Koleksi piring makan dan mangkok keramik Toyoki dengan aksen garis tepi List Coklat retro klasik, menghadirkan estetika hangat di meja makan kafe dan resto.',
                'description'  => $desc_template(
                    'Piring dan Mangkok List Coklat Toyoki',
                    'Pilihan ideal untuk kafe bernuansa warm/earthy, warung kopi modern, bistro, dan restoran keluarga yang menyukai gaya tableware klasik vintage.',
                    'Warna dasar krem hangat dengan sentuhan garis list coklat ganda di tepi, memberikan kontras alami yang mempercantik tampilan sajian makanan.'
                ),
                'image'        => 'services/toyoki/piring-dan-mangkok-list-coklat-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/piring-dan-mangkok-list-coklat-toyoki-2.webp',
                    'services/toyoki/piring-dan-mangkok-list-coklat-toyoki-3.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Seri',           'value' => 'List Coklat Double Ring Classic'],
                    ['key' => 'Pilihan Produk', 'value' => 'Piring Makan dan Mangkok 6 inch'],
                    ['key' => 'Material',       'value' => 'Keramik Tebal Food Grade SNI'],
                    ['key' => 'Finishing',       'value' => 'Glasur Halus Glossy Tahan Minyak'],
                    ['key' => 'Peruntukan',     'value' => 'Kafe Warm Tone, Resto Vintage, Kedai Kopi'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah list coklatnya mudah luntur?', 'a' => 'Tidak. Garis list coklat dibakar permanen dalam proses glasir suhu tinggi, aman dicuci berulang kali.'],
                ]),
                'meta_title'   => 'Piring dan Mangkok List Coklat Toyoki Grosir | Distributor Piring Keramik',
                'meta_desc'    => 'Distributor piring keramik dan peralatan makan keramik Toyoki. Sedia seri piring dan mangkok List Coklat klasik retro untuk kafe dan restoran.',
                'meta_keywords'=> 'piring list coklat toyoki, mangkok list coklat, piring keramik retro, tableware kafe vintage, distributor piring keramik, supplier keramik resto',
                'order'        => 8,
            ],

            // 9
            [
                'name'         => 'Piring Makan Keramik Motif Bunga Toyoki',
                'slug'         => 'piring-makan-keramik-motif-bunga-toyoki',
                'short_desc'   => 'Piring makan cekung keramik Toyoki dengan varian motif bunga mawar merah, bunga kuning, dan bunga biru klasik yang anggun untuk sajian hidangan utama.',
                'description'  => $desc_template(
                    'Piring Makan Keramik Motif Bunga Toyoki',
                    'Sangat cocok untuk restoran keluarga, katering pernikahan, prasmanan acara adat, dan usaha kuliner yang mengedepankan nuansa kehangatan nusantara.',
                    'Tersedia dalam variasi motif bunga mawar merah, bunga kuning, dan bunga biru dengan cetakan halus yang tidak luntur dan tahan lama.'
                ),
                'image'        => 'services/toyoki/piring-makan-keramik-motif-bunga-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/piring-makan-keramik-motif-bunga-toyoki-2.webp',
                    'services/toyoki/piring-makan-keramik-motif-bunga-toyoki-3.webp',
                    'services/toyoki/piring-makan-keramik-motif-bunga-toyoki-4.webp',
                    'services/toyoki/piring-makan-keramik-motif-bunga-toyoki-5.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe Produk',    'value' => 'Piring Makan Cekung (Soup / Dinner Plate)'],
                    ['key' => 'Motif Tersedia', 'value' => 'Mawar Merah, Bunga Kuning, Bunga Biru'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Ketahanan',      'value' => 'Aman Microwave, Dishwasher Safe'],
                    ['key' => 'Peruntukan',     'value' => 'Restoran Keluarga, Katering Pesta, Prasmanan'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Bisa pesan satu jenis motif bunga saja secara seragam?', 'a' => 'Bisa. Anda bisa memilih motif mawar merah, kuning, atau biru sesuai tema usaha Anda.'],
                ]),
                'meta_title'   => 'Piring Makan Keramik Motif Bunga Toyoki Grosir | Distributor Piring Keramik',
                'meta_desc'    => 'Pusat supplier dan distributor piring keramik Toyoki resmi. Sedia Piring Makan Motif Bunga mawar dan aneka warna untuk restoran dan katering.',
                'meta_keywords'=> 'piring makan motif bunga toyoki, piring mawar merah keramik, piring bunga kuning, piring prasmanan katering, distributor piring keramik',
                'order'        => 9,
            ],

            // 10
            [
                'name'         => 'Cangkir Set Motif Mawar Toyoki',
                'slug'         => 'cangkir-set-motif-mawar-toyoki',
                'short_desc'   => 'Set cangkir dan lepek keramik Toyoki berhiaskan motif bunga mawar merah dan mawar hijau dengan garis lis warna elegan di tepi cangkir.',
                'description'  => $desc_template(
                    'Cangkir Set Motif Mawar Toyoki',
                    'Pilihan sempurna untuk kedai kopi jadul, restoran peranakan, rumah makan tradisional, hotel, dan sajian kopi tubruk atau teh hangat.',
                    'Aksen lis merah dan lis hijau di bibir cangkir dan lepek memperkuat keindahan motif mawar, memberikan pengalaman minum teh yang berkesan bagi pelanggan.'
                ),
                'image'        => 'services/toyoki/cangkir-set-motif-mawar-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/cangkir-set-motif-mawar-toyoki-2.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe',           'value' => 'Cangkir + Lepek (Cup & Saucer)'],
                    ['key' => 'Pilihan Motif',  'value' => 'Mawar Merah (Lis Merah) dan Mawar Hijau (Lis Hijau)'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade'],
                    ['key' => 'Peruntukan',     'value' => 'Warung Kopi, Resto Peranakan, Hotel, Katering'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah cangkir dan lepek dijual terpisah?', 'a' => 'Umumnya dijual satu set cangkir dan lepek, namun dapat disesuaikan untuk kebutuhan penggantian stok.'],
                ]),
                'meta_title'   => 'Cangkir Set Motif Mawar Toyoki Grosir | Distributor Peralatan Makan Keramik',
                'meta_desc'    => 'Distributor peralatan makan keramik Toyoki. Sedia Cangkir Set Motif Mawar keramik klasik untuk warung kopi dan restoran tradisional grosir pabrik.',
                'meta_keywords'=> 'cangkir set motif mawar toyoki, cangkir kopi mawar, cangkir teh peranakan, cangkir lepek mawar, distributor peralatan makan keramik',
                'order'        => 10,
            ],

            // 11
            [
                'name'         => 'Mug Keramik Mawar Biru Papa Mama Toyoki',
                'slug'         => 'mug-keramik-mawar-biru-papa-mama-toyoki',
                'short_desc'   => 'Mug keramik silinder putih Toyoki bermotif bunga mawar biru anggun bertuliskan Papa dan Mama, pilihan tepat untuk souvenir dan hadiah keluarga.',
                'description'  => $desc_template(
                    'Mug Keramik Mawar Biru Papa Mama Toyoki',
                    'Sangat cocok untuk souvenir hari keluarga, hadiah ulang tahun pernikahan, bingkisan hotel untuk tamu keluarga, hingga hadiah merchandise perusahaan.',
                    'Didesain sepasang dengan tulisan kaligrafi Papa dan Mama berpadu motif mawar biru cerah yang eksklusif di atas keramik putih bersih.'
                ),
                'image'        => 'services/toyoki/mug-keramik-mawar-biru-papa-mama-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/mug-keramik-mawar-biru-papa-mama-toyoki-2.webp',
                    'services/toyoki/mug-keramik-mawar-biru-papa-mama-toyoki-3.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe Produk',    'value' => 'Mug Keramik Standar Pasangan'],
                    ['key' => 'Motif / Tulisan','value' => 'Mawar Biru dengan Tulisan Papa dan Mama'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen SNI'],
                    ['key' => 'Keunggulan',     'value' => 'Cetakan Rapi, Awet, Microwave Safe'],
                    ['key' => 'Peruntukan',     'value' => 'Souvenir Keluarga, Kado Pernikahan, Hotel Merchandise'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Bisa beli satuan atau harus sepasang?', 'a' => 'Bisa dipesan sepasang (Papa dan Mama) maupun dalam kuantiti grosir per karton untuk kebutuhan souvenir.'],
                ]),
                'meta_title'   => 'Mug Keramik Mawar Biru Papa Mama Toyoki | Distributor Peralatan Makan Keramik',
                'meta_desc'    => 'Pusat distributor peralatan makan keramik Toyoki resmi. Sedia Mug Keramik Mawar Biru Papa Mama untuk kado keluarga dan souvenir grosir.',
                'meta_keywords'=> 'mug mawar biru toyoki, mug papa mama keramik, mug souvenir keluarga, mug keramik putih, distributor peralatan makan keramik',
                'order'        => 11,
            ],

            // 12
            [
                'name'         => 'Mangkok Two Tone Pastel Toyoki',
                'slug'         => 'mangkok-two-tone-pastel-toyoki',
                'short_desc'   => 'Mangkok keramik Toyoki desain Two Tone dua warna pastel modern (hijau lime, pink, oranye, dan biru muda) untuk sajian sup, dessert, dan menu cafe kekinian.',
                'description'  => $desc_template(
                    'Mangkok Two Tone Pastel Toyoki',
                    'Dirancang untuk kafe modern, bistro anak muda, kedai dessert, restoran ramen, dan hotel butik yang menginginkan visual meja makan instagramable.',
                    'Paduan dua warna separuh pastel dan separuh putih memberikan daya tarik estetika tinggi, mudah ditumpuk rapi untuk efisiensi tempat di dapur komersial.'
                ),
                'image'        => 'services/toyoki/mangkok-two-tone-pastel-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/mangkok-two-tone-pastel-toyoki-2.webp',
                    'services/toyoki/mangkok-two-tone-pastel-toyoki-3.webp',
                    'services/toyoki/mangkok-two-tone-pastel-toyoki-4.webp',
                    'services/toyoki/mangkok-two-tone-pastel-toyoki-5.webp',
                    'services/toyoki/mangkok-two-tone-pastel-toyoki-6.webp',
                    'services/toyoki/mangkok-two-tone-pastel-toyoki-7.webp',
                    'services/toyoki/mangkok-two-tone-pastel-toyoki-8.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe Produk',    'value' => 'Mangkok Two Tone Pastel'],
                    ['key' => 'Pilihan Warna',  'value' => 'Hijau Lime, Pink Pastel, Oranye, Biru Muda'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Fitur',          'value' => 'Tahan Panas, Microwave Safe, Dishwasher Safe'],
                    ['key' => 'Peruntukan',     'value' => 'Kafe Kekinian, Dessert Bowl, Salad Bowl, Resto'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah warna pastelnya tahan dicuci mesin dishwasher komersial?', 'a' => 'Ya, warna two tone dibakar pada suhu tinggi sehingga tidak luntur dan tahan deterjen pencuci piring.'],
                ]),
                'meta_title'   => 'Mangkok Two Tone Pastel Toyoki Grosir | Distributor Piring Keramik',
                'meta_desc'    => 'Distributor piring keramik dan peralatan makan keramik Toyoki. Sedia Mangkok Two Tone warna pastel untuk kafe kekinian dan restoran modern.',
                'meta_keywords'=> 'mangkok two tone toyoki, mangkok pastel kafe, mangkok keramik dua warna, dessert bowl kafe, distributor piring keramik, supplier keramik resto',
                'order'        => 12,
            ],

            // 13
            [
                'name'         => 'Mug Keramik Two Tone Retro Toyoki',
                'slug'         => 'mug-keramik-two-tone-retro-toyoki',
                'short_desc'   => 'Mug keramik silinder Toyoki dengan kombinasi two tone oranye bata dan putih bernuansa retro vintage, ideal untuk sajian kopi hangat dan teh di kafe estetik.',
                'description'  => $desc_template(
                    'Mug Keramik Two Tone Retro Toyoki',
                    'Cocok untuk kedai kopi specialty, kafe bertema industrial retro, hotel butik, dan kantor yang mencari mug bernuansa santai dan hangat.',
                    'Kombinasi warna oranye bata pada separuh bagian bawah dan putih bersih di atas menghadirkan karakter vintage yang unik dan fotogenik di meja kafe.'
                ),
                'image'        => 'services/toyoki/mug-keramik-two-tone-retro-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/mug-keramik-two-tone-retro-toyoki-2.webp',
                    'services/toyoki/mug-keramik-two-tone-retro-toyoki-3.webp',
                    'services/toyoki/mug-keramik-two-tone-retro-toyoki-4.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe Produk',    'value' => 'Mug Silinder Two Tone Retro'],
                    ['key' => 'Warna',          'value' => 'Kombinasi Oranye Bata dan Putih'],
                    ['key' => 'Material',       'value' => 'Keramik Tebal Food Grade'],
                    ['key' => 'Kapasitas',      'value' => 'Standar Mug Kopi Kafe (sekitar 300 ml)'],
                    ['key' => 'Peruntukan',     'value' => 'Coffee Shop, Kafe Retro, Hotel Butik, Kantor'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah pegangan mug nyaman digenggam saat berisi minuman panas?', 'a' => 'Ya, pegangan mug dirancang ergonomis dengan jarak yang aman agar jari tidak bersentuhan dengan dinding mug yang panas.'],
                ]),
                'meta_title'   => 'Mug Keramik Two Tone Retro Toyoki Grosir | Distributor Peralatan Makan Keramik',
                'meta_desc'    => 'Pusat supplier dan distributor peralatan makan keramik Toyoki resmi. Sedia Mug Keramik Two Tone retro oranye putih untuk coffee shop dan kafe.',
                'meta_keywords'=> 'mug two tone retro toyoki, mug kopi kafe, mug keramik vintage, mug oranye putih, distributor peralatan makan keramik, supplier piring keramik',
                'order'        => 13,
            ],

            // 14
            [
                'name'         => 'Mug Keramik Solid Color Toyoki',
                'slug'         => 'mug-keramik-solid-color-toyoki',
                'short_desc'   => 'Mug keramik Toyoki warna solid biru muda dan coklat glossy yang elegan, pilihan serbaguna untuk kebutuhan operasional kafe, hotel, dan kantor.',
                'description'  => $desc_template(
                    'Mug Keramik Solid Color Toyoki',
                    'Pilihan fleksibel untuk meeting room korporat, pantry kantor, hotel breakfast, kafe modern, dan souvenir perusahaan.',
                    'Finishing warna solid mengkilap yang tebal dan merata, dinding keramik menahan suhu minuman panas lebih lama serta mudah dibersihkan.'
                ),
                'image'        => 'services/toyoki/mug-keramik-solid-color-toyoki-1.webp',
                'gallery'      => [
                    'services/toyoki/mug-keramik-solid-color-toyoki-2.webp',
                    'services/toyoki/mug-keramik-solid-color-toyoki-3.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Toyoki'],
                    ['key' => 'Tipe Produk',    'value' => 'Mug Standar Solid Color'],
                    ['key' => 'Pilihan Warna',  'value' => 'Biru Muda Glossy dan Coklat Glossy'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Ketahanan',      'value' => 'Aman Microwave dan Mesin Cuci Piring'],
                    ['key' => 'Peruntukan',     'value' => 'Hotel, Kantor, Kafe, Pantry, Souvenir Perusahaan'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah bisa ditambahkan sablon logo custom perusahaan?', 'a' => 'Bisa. Kami melayani pemesanan mug custom sablon logo dengan kuantiti minimal tertentu.'],
                ]),
                'meta_title'   => 'Mug Keramik Solid Color Toyoki Grosir | Distributor Piring Keramik',
                'meta_desc'    => 'Distributor piring keramik dan peralatan makan keramik Toyoki. Sedia Mug Keramik Solid Color warna biru dan coklat untuk hotel, kafe, dan kantor.',
                'meta_keywords'=> 'mug solid color toyoki, mug biru keramik, mug coklat kafe, mug kantor hotel, distributor piring keramik, supplier peralatan makan keramik',
                'order'        => 14,
            ],

        ];

        // ── Simpan ke DB ──────────────────────────────────────────────────────
        $count = 0;
        foreach ($products as $p) {
            Service::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'service_category_id' => $category->id,
                    'name'                => $p['name'],
                    'short_desc'          => $p['short_desc'],
                    'description'         => $p['description'],
                    'image'               => $p['image'],
                    'gallery'             => $p['gallery'],
                    'specifications'      => $p['specs'],
                    'faqs'                => $p['faqs'],
                    'meta_title'          => $p['meta_title'],
                    'meta_desc'           => $p['meta_desc'],
                    'meta_keywords'       => $p['meta_keywords'],
                    'order'               => $p['order'],
                    'rating'              => 5.0,
                    'sold_count'          => null,
                    'price'               => null,
                    'is_active'           => true,
                ]
            );
            $count++;
            $this->command->info("  [{$count}/14] {$p['name']}");
        }

        Cache::flush();
        $total = Service::where('service_category_id', $category->id)->count();
        $this->command->info("\n==> SELESAI: {$total} produk Toyoki tersimpan di database.");
    }
}
