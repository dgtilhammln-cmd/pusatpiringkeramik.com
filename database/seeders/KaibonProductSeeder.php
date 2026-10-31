<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class KaibonProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori Kaibon
        $category = ServiceCategory::updateOrCreate(
            ['slug' => 'kaibon'],
            [
                'name'          => 'Kaibon',
                'description'   => 'Koleksi piranti makan dan minum keramik merk Kaibon dengan ciri khas desain Twotone - perpaduan dua warna kontemporer yang menonjol di meja restoran, kafe, dan hotel modern. Terdiri dari mangkok, piring, mug, coffee set, tea set motif, hingga parsel siap saji.',
                'meta_title'    => 'Distributor Resmi Keramik Kaibon Twotone - Grosir Mangkok, Piring & Mug',
                'meta_desc'     => 'Pusat grosir piranti makan & minum keramik Kaibon asli. Mangkok twotone, piring, mug, coffee set & tea set untuk restoran, kafe, hotel, dan katering se-Indonesia.',
                'meta_keywords' => 'kaibon twotone, mangkok kaibon, piring kaibon, mug kaibon, coffee set kaibon, grosir keramik kaibon, distributor kaibon surabaya',
                'parent_id'     => null,
            ]
        );

        $this->command->info("Category ready: Kaibon (ID: {$category->id})");

        $desc_template = fn(string $nama, string $peruntukan, string $keunggulan_khusus) =>
            "<p><strong>{$nama}</strong> merupakan salah satu produk unggulan dari <strong>Kaibon</strong> yang didistribusikan resmi oleh UD. Sukses Makmur sebagai <strong>pusat</strong> dan <strong>distributor peralatan makan keramik</strong> di Indonesia. Sebagai <strong>supplier</strong> terpercaya untuk kebutuhan HORECA (Hotel, Restoran, Kafe, Katering) dan retail, kami menghadirkan koleksi keramik Kaibon asli dengan standar mutu dan keamanan pangan tinggi.</p>\n\n<h3>Keunggulan & Karakteristik Produk</h3>\n<ul>\n    <li><strong>Desain Estetik & Fungsional:</strong> Ciri khas tampilan modern yang mempercantik tata meja makan dan mudah diselaraskan dengan tema interior kafe serta restoran.</li>\n    <li><strong>Material Keramik Food Grade:</strong> Bebas zat berbahaya (lead-free dan cadmium-free), higienis, memenuhi standar SNI, serta aman untuk sajian makanan panas maupun dingin.</li>\n    <li><strong>Glasur Halus Tahan Gores:</strong> Lapisan glasur protektif menjaga keramik tetap mengkilap bersih dan awet meski dicuci menggunakan dishwasher komersial.</li>\n    <li><strong>{$keunggulan_khusus}</strong></li>\n</ul>\n\n<h3>Pilihan Ideal untuk Pengadaan Usaha</h3>\n<p>{$peruntukan} Sebagai <strong>distributor piring keramik</strong> dan <strong>peralatan makan keramik</strong> terlengkap, kami melayani pemesanan partai besar, pengadaan restoran baru, dan pasokan grosir ke seluruh pelosok Nusantara dengan garansi proteksi kemasan berlapis.</p>\n\n<div style=\"background:#F8FAFC;border-left:4px solid #3B82F6;padding:1.25rem;border-radius:0 12px 12px 0;margin:1.5rem 0;\">\n    <h4 style=\"margin:0 0 .5rem;color:#1E293B;font-size:1rem;\">Informasi Harga Grosir & Konsultasi Pengadaan</h4>\n    <p style=\"margin:0 0 .75rem;font-size:.875rem;color:#475569;\">Untuk penawaran harga grosir terbaik, ketersediaan stok, sampel produk, dan estimasi ongkir kargo ke kota Anda, silakan hubungi tim sales kami melalui WhatsApp.</p>\n</div>";

        $faq_umum = [
            ['q' => 'Apakah bisa pesan partai besar untuk keperluan restoran atau kafe?', 'a' => 'Bisa. Kami melayani pengadaan skala industri HORECA, pembukaan cabang, maupun kebutuhan catering dalam jumlah besar. Hubungi tim sales kami via WhatsApp untuk konsultasi.'],
            ['q' => 'Apakah aman dikirim ke luar kota atau luar pulau?', 'a' => 'Aman. Setiap pengiriman dikemas dengan sekat karton tebal, bubble wrap berlapis, dan tersedia opsi peti kayu untuk menjamin produk tiba dalam kondisi sempurna.'],
        ];

        $products = [

            // ── 1 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Mangkok Mini Twotone Kaibon',
                'slug'         => 'mangkok-mini-twotone-kaibon',
                'short_desc'   => 'Mangkok kecil keramik Kaibon desain Twotone dua warna, cocok untuk sajian kondimen, sambal, saus, dan snack di meja kafe atau resto modern.',
                'description'  => $desc_template(
                    'Mangkok Mini Twotone Kaibon',
                    'Ideal untuk kafe kekinian, bistro, hotel bintang, maupun rumah makan yang mengedepankan estetika penyajian. Cocok sebagai mangkok kondimen, saus, selai, sambal, dan dessert mini.',
                    'Ukuran compact & ringan, mudah ditumpuk, menghemat penyimpanan di dapur komersial.'
                ),
                'image'        => 'services/kaibon/mangkok-mini-twotone-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/mangkok-mini-twotone-kaibon-2.webp',
                    'services/kaibon/mangkok-mini-twotone-kaibon-3.webp',
                    'services/kaibon/mangkok-mini-twotone-kaibon-4.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',    'value' => 'Kaibon'],
                    ['key' => 'Tipe',            'value' => 'Mangkok Mini / Small Bowl'],
                    ['key' => 'Motif / Desain',  'value' => 'Twotone - Dua Warna Kontemporer'],
                    ['key' => 'Material',        'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Finishing',        'value' => 'Glasur Halus Mengkilap Tahan Gores'],
                    ['key' => 'Peruntukan',      'value' => 'Kondimen, Saus, Sambal, Dessert Mini, Kafe & Resto'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah tersedia dalam beberapa varian warna twotone?', 'a' => 'Ya, tersedia aneka pilihan kombinasi warna. Hubungi kami via WhatsApp untuk melihat katalog warna terkini.'],
                ]),
                'meta_title'   => 'Mangkok Mini Twotone Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Mangkok Mini Twotone Kaibon. Grosir mangkok kecil keramik dua warna untuk kafe, restoran, hotel, dan catering. Pengiriman ke seluruh Indonesia.',
                'meta_keywords'=> 'mangkok mini kaibon, mangkok twotone kaibon, mangkok kondimen keramik, mangkok sambal kafe, mangkok kecil dua warna, grosir mangkok kafe modern',
                'order'        => 1,
            ],

            // ── 2 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Mangkok Twotone Cafe Kaibon',
                'slug'         => 'mangkok-twotone-cafe-kaibon',
                'short_desc'   => 'Mangkok keramik Kaibon ukuran cafe dengan desain Twotone aneka warna pastel - pilihan estetik untuk sajian ramen, salad bowl, sup, dan menu berkuah di restoran modern.',
                'description'  => $desc_template(
                    'Mangkok Twotone Cafe Kaibon',
                    'Dirancang untuk kafe kekinian, restoran ramen, bistro Jepang-Korea, hotel bintang, dan usaha kuliner yang mengedepankan tampilan penyajian estetik. Cocok untuk ramen, udon, soto, bakso premium, salad bowl, dan aneka menu berkuah.',
                    'Kapasitas dalam cukup besar untuk sajian berkuah, dinding mangkok tebal menjaga suhu hidangan lebih lama.'
                ),
                'image'        => 'services/kaibon/mangkok-twotone-cafe-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/mangkok-twotone-cafe-kaibon-2.webp',
                    'services/kaibon/mangkok-twotone-cafe-kaibon-3.webp',
                    'services/kaibon/mangkok-twotone-cafe-kaibon-4.webp',
                    'services/kaibon/mangkok-twotone-cafe-kaibon-5.webp',
                    'services/kaibon/mangkok-twotone-cafe-kaibon-6.webp',
                    'services/kaibon/mangkok-twotone-cafe-kaibon-7.webp',
                    'services/kaibon/mangkok-twotone-cafe-kaibon-8.webp',
                    'services/kaibon/mangkok-twotone-cafe-kaibon-9.webp',
                    'services/kaibon/mangkok-twotone-cafe-kaibon-10.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Mangkok Cafe / Medium Bowl'],
                    ['key' => 'Motif / Desain', 'value' => 'Twotone Pastel - Aneka Varian Warna'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade'],
                    ['key' => 'Keunggulan',     'value' => 'Tahan Panas, Microwave Safe, Dishwasher Safe'],
                    ['key' => 'Peruntukan',     'value' => 'Ramen, Soto, Salad Bowl, Sup, Bakso Premium'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Cocok untuk sajian berkuah panas seperti ramen dan soto?', 'a' => 'Sangat cocok. Material keramik tebal Kaibon tahan panas dan menjaga suhu kuah tetap optimal saat disajikan ke meja tamu.'],
                ]),
                'meta_title'   => 'Mangkok Twotone Cafe Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Mangkok Twotone Cafe Kaibon. Mangkok keramik dua warna pastel untuk ramen, salad bowl, soto, dan menu cafe. Grosir pengiriman seluruh Indonesia.',
                'meta_keywords'=> 'mangkok ramen kaibon, mangkok cafe twotone, mangkok salad bowl keramik, mangkok sup restoran, grosir mangkok dua warna, mangkok pastel kafe',
                'order'        => 2,
            ],

            // ── 3 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Mangkok Rice Bowl Lis Hitam Kaibon',
                'slug'         => 'mangkok-rice-bowl-lis-hitam-kaibon',
                'short_desc'   => 'Mangkok keramik putih bersih dengan aksen garis lis hitam tipis di bibir mangkok - tampilan minimalis elegan untuk restoran dan kafe bergaya modern.',
                'description'  => $desc_template(
                    'Mangkok Rice Bowl Lis Hitam Kaibon',
                    'Pilihan tepat untuk restoran fine dining, kafe minimalis, hotel bintang, dan usaha kuliner yang mengedepankan estetika meja makan simpel namun berkesan. Cocok untuk nasi, soto, ramen, mie, aneka sajian berkuah, hingga salad.',
                    'Desain putih bersih dengan lis hitam tipis menciptakan kontras visual elegan yang menonjolkan warna dan tekstur hidangan.'
                ),
                'image'        => 'services/kaibon/mangkok-rice-bowl-lis-hitam-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/mangkok-rice-bowl-lis-hitam-kaibon-2.webp',
                    'services/kaibon/mangkok-rice-bowl-lis-hitam-kaibon-3.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Rice Bowl / Medium Bowl'],
                    ['key' => 'Motif / Desain', 'value' => 'Putih Bersih Aksen Lis Hitam Minimalis'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Finishing',       'value' => 'Glasur Putih Mengkilap, Lis Hitam Presisi'],
                    ['key' => 'Peruntukan',     'value' => 'Nasi, Ramen, Soto, Salad, Fine Dining & Kafe Minimalis'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah lis hitam tahan dicuci di mesin dishwasher?', 'a' => 'Ya, lis glasur dibakar pada suhu tinggi (in-glaze) sehingga awet dan tidak mudah pudar meski dicuci rutin dengan mesin cuci piring komersial.'],
                ]),
                'meta_title'   => 'Mangkok Rice Bowl Lis Hitam Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Mangkok Rice Bowl Lis Hitam Kaibon. Mangkok keramik putih minimalis aksen lis hitam untuk restoran, kafe, dan hotel. Grosir se-Indonesia.',
                'meta_keywords'=> 'mangkok lis hitam kaibon, mangkok putih minimalis, rice bowl keramik, mangkok restoran minimalis, grosir mangkok kafe elegan',
                'order'        => 3,
            ],

            // ── 4 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Mangkok Kecil Twotone Pastel Kaibon',
                'slug'         => 'mangkok-kecil-twotone-pastel-kaibon',
                'short_desc'   => 'Mangkok kecil keramik Kaibon Twotone warna pastel cerah - pilihan dekoratif sekaligus fungsional untuk sajian snack, sup kecil, dan kondimen di kafe dan hotel.',
                'description'  => $desc_template(
                    'Mangkok Kecil Twotone Pastel Kaibon',
                    'Cocok untuk kafe bergaya colorful, hotel butik, restoran anak-anak, dan usaha kuliner yang ingin tampilan meja lebih hidup dan playful. Ideal untuk sup kecil, snack bowl, puding, dessert, dan kondimen.',
                    'Warna-warna pastel cerah (pink, biru, kuning, oranye) menciptakan tampilan meja yang segar dan menarik perhatian tamu.'
                ),
                'image'        => 'services/kaibon/mangkok-kecil-twotone-pastel-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/mangkok-kecil-twotone-pastel-kaibon-2.webp',
                    'services/kaibon/mangkok-kecil-twotone-pastel-kaibon-3.webp',
                    'services/kaibon/mangkok-kecil-twotone-pastel-kaibon-4.webp',
                    'services/kaibon/mangkok-kecil-twotone-pastel-kaibon-5.webp',
                    'services/kaibon/mangkok-kecil-twotone-pastel-kaibon-6.webp',
                    'services/kaibon/mangkok-kecil-twotone-pastel-kaibon-7.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Mangkok Kecil / Small Bowl'],
                    ['key' => 'Motif / Desain', 'value' => 'Twotone Pastel - Pink, Biru, Kuning, Oranye'],
                    ['key' => 'Material',       'value' => 'Keramik Food Grade'],
                    ['key' => 'Keunggulan',     'value' => 'Warna Stabil, Tidak Pudar, Mudah Ditumpuk'],
                    ['key' => 'Peruntukan',     'value' => 'Sup Kecil, Snack, Puding, Dessert, Kondimen Kafe'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Warna pastelnya awet tidak luntur saat dicuci?', 'a' => 'Awet. Pewarna glasur Kaibon dibakar menyatu dengan permukaan keramik sehingga tidak luntur meski dicuci berulang kali.'],
                ]),
                'meta_title'   => 'Mangkok Kecil Twotone Pastel Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Mangkok Kecil Twotone Pastel Kaibon. Mangkok keramik warna-warni pastel untuk kafe, hotel butik, dan restoran. Grosir pengiriman seluruh Indonesia.',
                'meta_keywords'=> 'mangkok pastel kaibon, mangkok kecil twotone, mangkok warna warni kafe, mangkok snack keramik, grosir mangkok pastel hotel, small bowl pastel',
                'order'        => 4,
            ],

            // ── 5 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Piring Makan Twotone Kaibon',
                'slug'         => 'piring-makan-twotone-kaibon',
                'short_desc'   => 'Piring makan keramik Kaibon desain Twotone aneka warna untuk restoran modern, kafe, dan hotel yang menginginkan tampilan meja lebih segar dan berkarakter.',
                'description'  => $desc_template(
                    'Piring Makan Twotone Kaibon',
                    'Ideal untuk restoran a la carte, kafe brunch, hotel bintang, katering pernikahan, dan usaha kuliner yang ingin membedakan tampilan meja dari tableware biasa. Cocok untuk sajian main course, nasi, lauk, hingga aneka menu western dan fusion.',
                    'Permukaan dalam berwarna putih bersih menonjolkan warna dan plating makanan, sementara bagian luar twotone memberikan kesan premium saat disajikan.'
                ),
                'image'        => 'services/kaibon/piring-makan-twotone-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/piring-makan-twotone-kaibon-2.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Piring Makan / Dinner Plate'],
                    ['key' => 'Motif / Desain', 'value' => 'Twotone - Aneka Varian Warna'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Keunggulan',     'value' => 'Tahan Microwave, Dishwasher Safe, Anti Gores'],
                    ['key' => 'Peruntukan',     'value' => 'Main Course, Nasi, Lauk, Menu Western & Fusion, Brunch Cafe'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Tersedia dalam pilihan warna apa saja?', 'a' => 'Tersedia aneka pilihan warna twotone. Hubungi tim sales kami via WhatsApp untuk katalog warna dan ketersediaan stok terkini.'],
                ]),
                'meta_title'   => 'Piring Makan Twotone Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Piring Makan Twotone Kaibon. Piring keramik dua warna untuk restoran, kafe, hotel, dan katering. Grosir pengiriman seluruh Indonesia.',
                'meta_keywords'=> 'piring makan kaibon, piring twotone, piring keramik dua warna, piring cafe modern, grosir piring kaibon, piring restoran berwarna',
                'order'        => 5,
            ],

            // ── 6 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Mug Standard Putih Kaibon',
                'slug'         => 'mug-standard-putih-kaibon',
                'short_desc'   => 'Mug keramik putih bersih Kaibon dengan bentuk silinder klasik - pilihan serbaguna untuk hotel, kafe, kantor, dan souvenir dengan sablon logo custom.',
                'description'  => $desc_template(
                    'Mug Standard Putih Kaibon',
                    'Pilihan terbaik untuk hotel bintang, kafe, kantor korporat, souvenir perusahaan, katering breakfast, dan bisnis F&B yang membutuhkan mug standar bermutu tinggi. Cocok juga sebagai media sablon logo merek/brand custom.',
                    'Bentuk silinder klasik yang ergonomis, pegangan kuat, dan berdiri stabil - ideal untuk penggunaan operasional harian di skala industri.'
                ),
                'image'        => 'services/kaibon/mug-standard-putih-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/mug-standard-putih-kaibon-2.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Mug Standard / Classic Mug'],
                    ['key' => 'Warna',          'value' => 'Putih Bersih (White)'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade'],
                    ['key' => 'Keunggulan',     'value' => 'Dishwasher Safe, Microwave Safe, Sablon Custom'],
                    ['key' => 'Peruntukan',     'value' => 'Hotel, Kafe, Kantor, Souvenir Custom, Katering'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah bisa pesan dengan sablon logo atau branding perusahaan?', 'a' => 'Bisa, kami melayani mug custom sablon logo dengan minimal order tertentu. Hubungi tim kami via WhatsApp untuk informasi lebih lanjut.'],
                ]),
                'meta_title'   => 'Mug Standard Putih Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Mug Standard Putih Kaibon. Grosir mug keramik putih untuk hotel, kafe, souvenir logo custom, dan katering. Pengiriman seluruh Indonesia.',
                'meta_keywords'=> 'mug putih kaibon, mug keramik standard, mug hotel, mug souvenir custom, grosir mug putih, mug kafe kantor keramik',
                'order'        => 6,
            ],

            // ── 7 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Mug Twotone Slim Kaibon',
                'slug'         => 'mug-twotone-slim-kaibon',
                'short_desc'   => 'Mug keramik Kaibon bentuk slim meruncing dengan desain Twotone warna earthy - tampilan premium untuk kafe specialty coffee, bistro, dan hotel dengan konsep natural modern.',
                'description'  => $desc_template(
                    'Mug Twotone Slim Kaibon',
                    'Cocok untuk kafe specialty coffee, kedai teh premium, hotel butik, bistro bergaya natural/nordic, dan usaha kuliner yang mengedepankan estetika penyajian minuman panas. Ideal untuk kopi, teh, latte, matcha, dan cokelat panas.',
                    'Bentuk slim meruncing ke bawah yang unik membedakan tampilan meja dari mug konvensional - menciptakan foto produk yang menarik untuk konten media sosial restoran.'
                ),
                'image'        => 'services/kaibon/mug-twotone-slim-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/mug-twotone-slim-kaibon-2.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-3.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-4.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-5.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-6.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-7.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-8.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-9.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-10.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-11.webp',
                    'services/kaibon/mug-twotone-slim-kaibon-12.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Mug Slim / Tapered Mug'],
                    ['key' => 'Motif / Desain', 'value' => 'Twotone - Earthy Tones (Hijau, Coklat, Abu-abu)'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade'],
                    ['key' => 'Finishing',       'value' => 'Glasur Matt & Glossy Kombinasi'],
                    ['key' => 'Peruntukan',     'value' => 'Specialty Coffee, Teh Premium, Kafe Nordic, Hotel Butik'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah tersedia dalam berbagai warna twotone lain?', 'a' => 'Ya, tersedia aneka varian warna earthy dan natural. Hubungi tim kami untuk katalog warna dan ketersediaan stok.'],
                ]),
                'meta_title'   => 'Mug Twotone Slim Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Mug Twotone Slim Kaibon. Mug keramik slim dua warna earthy untuk kafe specialty, hotel butik, dan bistro modern. Grosir se-Indonesia.',
                'meta_keywords'=> 'mug slim kaibon, mug twotone earthy, mug keramik nordic, mug kafe specialty coffee, grosir mug desain unik, mug keramik tapered',
                'order'        => 7,
            ],

            // ── 8 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Mug Twotone Standard Kaibon',
                'slug'         => 'mug-twotone-standard-kaibon',
                'short_desc'   => 'Mug keramik Kaibon bentuk standard dengan desain Twotone warna solid - pilihan fungsional sekaligus estetik untuk kafe, kantor, hotel, dan souvenir korporat.',
                'description'  => $desc_template(
                    'Mug Twotone Standard Kaibon',
                    'Cocok untuk kafe modern, kantor korporat, hotel bintang, dan usaha kuliner yang mencari mug bermutu dengan tampilan lebih berkarakter dari mug polos biasa. Bisa juga untuk souvenir acara dengan custom decal.',
                    'Warna twotone solid yang berani (biru kobalt, dll.) membuat mug ini mudah dikenali dan memiliki daya tarik visual yang kuat di display toko maupun di meja makan.'
                ),
                'image'        => 'services/kaibon/mug-twotone-standard-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/mug-twotone-standard-kaibon-2.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-3.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-4.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-5.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-6.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-7.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-8.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-9.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-10.webp',
                    'services/kaibon/mug-twotone-standard-kaibon-11.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Mug Standard Twotone'],
                    ['key' => 'Motif / Desain', 'value' => 'Twotone Solid - Aneka Varian Warna'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade SNI'],
                    ['key' => 'Keunggulan',     'value' => 'Microwave Safe, Dishwasher Safe, Warna Stabil'],
                    ['key' => 'Peruntukan',     'value' => 'Kafe, Kantor, Hotel, Souvenir, Kopi & Teh'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Bisa request warna twotone tertentu?', 'a' => 'Untuk ketersediaan pilihan warna terkini, silakan hubungi tim sales kami via WhatsApp.'],
                ]),
                'meta_title'   => 'Mug Twotone Standard Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Mug Twotone Standard Kaibon. Mug keramik dua warna solid untuk kafe, hotel, kantor, dan souvenir. Grosir pengiriman seluruh Indonesia.',
                'meta_keywords'=> 'mug twotone kaibon, mug standard keramik, mug biru kaibon, mug dua warna, grosir mug kafe, mug keramik souvenir korporat',
                'order'        => 8,
            ],

            // ── 9 ──────────────────────────────────────────────────────────────
            [
                'name'         => 'Coffee Set Twotone Kaibon',
                'slug'         => 'coffee-set-twotone-kaibon',
                'short_desc'   => 'Set perlengkapan kopi keramik Kaibon terdiri dari teko, cangkir, dan lepek desain Twotone pastel - pilihan elegan untuk penyajian kopi dan teh di kafe dan hotel.',
                'description'  => $desc_template(
                    'Coffee Set Twotone Kaibon',
                    'Dirancang untuk kafe premium, hotel bintang, meeting room korporat, dan usaha kuliner yang menginginkan penyajian minuman panas lebih berkesan. Cocok untuk kopi, teh, herbal drink, dan sajian minuman panas lainnya.',
                    'Set lengkap teko-cangkir-lepek dengan desain twotone yang selaras memberikan kesan keseragaman premium saat disajikan di meja tamu.'
                ),
                'image'        => 'services/kaibon/coffee-set-twotone-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/coffee-set-twotone-kaibon-2.webp',
                    'services/kaibon/coffee-set-twotone-kaibon-3.webp',
                    'services/kaibon/coffee-set-twotone-kaibon-4.webp',
                    'services/kaibon/coffee-set-twotone-kaibon-5.webp',
                    'services/kaibon/coffee-set-twotone-kaibon-6.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Coffee Set / Tea Set (Teko + Cangkir + Lepek)'],
                    ['key' => 'Motif / Desain', 'value' => 'Twotone Pastel - Aneka Pilihan Warna'],
                    ['key' => 'Material',       'value' => 'Keramik Porselen Food Grade'],
                    ['key' => 'Keunggulan',     'value' => 'Set Lengkap Seragam, Tahan Panas, Elegan'],
                    ['key' => 'Peruntukan',     'value' => 'Kafe Premium, Hotel Bintang, Meeting Room, Catering'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah teko dan cangkir bisa dibeli terpisah?', 'a' => 'Bisa dipesan set lengkap maupun komponen terpisah sesuai kebutuhan. Hubungi tim kami untuk detailnya.'],
                ]),
                'meta_title'   => 'Coffee Set Twotone Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Coffee Set Twotone Kaibon. Set teko cangkir lepek keramik pastel untuk kafe, hotel, dan meeting room. Grosir pengiriman seluruh Indonesia.',
                'meta_keywords'=> 'coffee set kaibon, tea set twotone kaibon, teko cangkir keramik, set minum kafe hotel, grosir coffee set keramik, set penyajian teh kafe',
                'order'        => 9,
            ],

            // ── 10 ─────────────────────────────────────────────────────────────
            [
                'name'         => 'Tea Set Keramik Motif Vintage Kaibon',
                'slug'         => 'tea-set-motif-vintage-kaibon',
                'short_desc'   => 'Set cangkir dan lepek keramik Kaibon dengan motif vintage klasik - pilihan timeless untuk penyajian teh tradisional di restoran keluarga, hotel, dan kafe bergaya retro.',
                'description'  => $desc_template(
                    'Tea Set Keramik Motif Vintage Kaibon',
                    'Pilihan tepat untuk restoran keluarga bergaya klasik, hotel tradisional, kafe vintage/retro, katering pernikahan adat, dan usaha kuliner yang mengedepankan nuansa kehangatan dan kekeluargaan. Cocok untuk penyajian teh, kopi tubruk, dan minuman tradisional.',
                    'Motif vintage klasik khas yang dibakar menggunakan teknik in-glaze - warna motif menyatu permanen dengan permukaan keramik sehingga awet puluhan tahun meski dicuci terus-menerus.'
                ),
                'image'        => 'services/kaibon/tea-set-motif-vintage-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/tea-set-motif-vintage-kaibon-2.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-3.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-4.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-5.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-6.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-7.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-8.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-9.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-10.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-11.webp',
                    'services/kaibon/tea-set-motif-vintage-kaibon-12.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Tea Set / Cangkir + Lepek Motif'],
                    ['key' => 'Motif / Desain', 'value' => 'Motif Vintage Klasik Khas Kaibon'],
                    ['key' => 'Material',       'value' => 'Keramik Tradisional Food Grade'],
                    ['key' => 'Teknik Motif',   'value' => 'In-Glaze Fired - Awet & Tidak Pudar'],
                    ['key' => 'Peruntukan',     'value' => 'Teh Tradisional, Kafe Vintage, Hotel Klasik, Katering Adat'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah motif vintage ini tahan dicuci mesin dishwasher?', 'a' => 'Ya, motif dibakar menggunakan teknik in-glaze sehingga warna menyatu permanen dan tidak luntur meski dicuci mesin setiap hari.'],
                    ['q' => 'Bisa pesan hanya cangkir tanpa teko/lepek?', 'a' => 'Bisa, kami melayani pemesanan komponen terpisah maupun set lengkap sesuai kebutuhan operasional Anda.'],
                ]),
                'meta_title'   => 'Tea Set Keramik Motif Vintage Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Tea Set Keramik Motif Vintage Kaibon. Set cangkir lepek keramik motif bunga klasik untuk restoran, hotel, dan kafe vintage. Grosir se-Indonesia.',
                'meta_keywords'=> 'tea set motif bunga kaibon, cangkir motif bunga, set teh keramik klasik, cangkir kafe vintage, grosir tea set keramik, set minum teh tradisional',
                'order'        => 10,
            ],

            // ── 11 ─────────────────────────────────────────────────────────────
            [
                'name'         => 'Piring Motif Batik Kaibon',
                'slug'         => 'piring-motif-batik-kaibon',
                'short_desc'   => 'Piring keramik Kaibon bermotif arabesque biru putih khas - pilihan unik berkelas untuk restoran fine dining, kafe instagramable, dan koleksi tableware bermotif etnik.',
                'description'  => $desc_template(
                    'Piring Motif Batik Kaibon',
                    'Cocok untuk restoran fine dining dengan konsep batik/tradisional, kafe instagramable, hotel berbintang bertema heritage Indonesia, pameran kerajinan, dan kolektor tableware bermotif unik. Bisa juga sebagai souvenir atau hadiah eksklusif.',
                    'Motif arabesque biru putih yang rumit dan detail menunjukkan keahlian pengrajin keramik Kaibon - menjadikan setiap piring sebagai karya seni fungsional di meja makan.'
                ),
                'image'        => 'services/kaibon/piring-motif-batik-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/piring-motif-batik-kaibon-2.webp',
                    'services/kaibon/piring-motif-batik-kaibon-3.webp',
                    'services/kaibon/piring-motif-batik-kaibon-4.webp',
                    'services/kaibon/piring-motif-batik-kaibon-5.webp',
                    'services/kaibon/piring-motif-batik-kaibon-6.webp',
                    'services/kaibon/piring-motif-batik-kaibon-7.webp',
                    'services/kaibon/piring-motif-batik-kaibon-8.webp',
                    'services/kaibon/piring-motif-batik-kaibon-9.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon - Asli Buatan Indonesia'],
                    ['key' => 'Tipe',           'value' => 'Piring Kecil / Side Plate / Dessert Plate'],
                    ['key' => 'Motif / Desain', 'value' => 'Arabesque / Batik Biru Putih - Full Motif'],
                    ['key' => 'Material',       'value' => 'Keramik Food Grade, Bersertifikat SNI'],
                    ['key' => 'Teknik Motif',   'value' => 'Cetak In-Glaze, Detail Tinggi, Awet'],
                    ['key' => 'Peruntukan',     'value' => 'Fine Dining, Kafe Instagramable, Hotel Heritage, Souvenir'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah motifnya termasuk SNI asli buatan Indonesia?', 'a' => 'Ya, Kaibon adalah merek keramik asli buatan Indonesia yang telah bersertifikat SNI, sesuai tertera di bagian bawah produk.'],
                    ['q' => 'Cocok untuk dijadikan souvenir pernikahan atau korporat?', 'a' => 'Sangat cocok. Motif batik yang khas menjadikannya souvenir eksklusif bernilai tinggi. Hubungi kami untuk pemesanan souvenir custom.'],
                ]),
                'meta_title'   => 'Piring Motif Batik Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Piring Motif Batik Kaibon. Piring keramik arabesque biru putih SNI untuk restoran fine dining, kafe instagramable, dan souvenir. Grosir se-Indonesia.',
                'meta_keywords'=> 'piring motif batik kaibon, piring arabesque biru putih, piring keramik etnik, piring fine dining motif, grosir piring batik indonesia, piring motif khas',
                'order'        => 11,
            ],

            // ── 12 ─────────────────────────────────────────────────────────────
            [
                'name'         => 'Parcel Mangkok Kaibon',
                'slug'         => 'parcel-mangkok-kaibon',
                'short_desc'   => 'Paket parsel mangkok keramik Kaibon Twotone dalam keranjang anyaman siap saji - pilihan hadiah eksklusif untuk hari raya, ulang tahun, dan acara korporat.',
                'description'  => $desc_template(
                    'Parcel Mangkok Kaibon',
                    'Pilihan hadiah premium untuk hari raya Lebaran, Natal, Tahun Baru, ulang tahun perusahaan, dan acara korporat. Cocok juga untuk souvenir pernikahan adat, doorprize, hingga hamper eksklusif klien bisnis.',
                    'Dikemas dalam keranjang anyaman rotan premium yang siap saji - tidak perlu packing ulang, langsung bisa diserahkan sebagai hadiah dengan tampilan yang mewah dan berkesan.'
                ),
                'image'        => 'services/kaibon/parcel-mangkok-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/parcel-mangkok-kaibon-2.webp',
                    'services/kaibon/parcel-mangkok-kaibon-3.webp',
                    'services/kaibon/parcel-mangkok-kaibon-4.webp',
                    'services/kaibon/parcel-mangkok-kaibon-5.webp',
                    'services/kaibon/parcel-mangkok-kaibon-6.webp',
                    'services/kaibon/parcel-mangkok-kaibon-7.webp',
                    'services/kaibon/parcel-mangkok-kaibon-8.webp',
                    'services/kaibon/parcel-mangkok-kaibon-9.webp',
                    'services/kaibon/parcel-mangkok-kaibon-10.webp',
                    'services/kaibon/parcel-mangkok-kaibon-11.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',     'value' => 'Kaibon'],
                    ['key' => 'Tipe',             'value' => 'Parsel / Hamper Keramik Siap Saji'],
                    ['key' => 'Isi',              'value' => 'Mangkok Keramik Twotone dalam Keranjang Anyaman'],
                    ['key' => 'Kemasan',          'value' => 'Keranjang Rotan Premium + Plastik Wrap Pita'],
                    ['key' => 'Peruntukan',       'value' => 'Lebaran, Natal, Souvenir Pernikahan, Hadiah Korporat'],
                ],
                'faqs'         => [
                    ['q' => 'Bisa pesan parsel dalam jumlah banyak untuk korporat atau event?', 'a' => 'Bisa, kami melayani pemesanan parsel dalam jumlah besar untuk keperluan korporat, doorprize, dan event perusahaan. Hubungi tim kami via WhatsApp.'],
                    ['q' => 'Apakah bisa custom isi mangkok atau warna twotone?', 'a' => 'Bisa dikonsultasikan sesuai kebutuhan dan ketersediaan stok. Hubungi tim sales kami untuk opsi kustomisasi.'],
                    ['q' => 'Apakah bisa dikirim ke seluruh Indonesia?', 'a' => 'Bisa, kami melayani pengiriman ke seluruh Indonesia dengan packing aman berlapis.'],
                ],
                'meta_title'   => 'Parcel Mangkok Twotone Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Parcel Mangkok Kaibon. Hamper mangkok keramik twotone dalam keranjang anyaman untuk hadiah Lebaran, korporat, dan souvenir. Grosir se-Indonesia.',
                'meta_keywords'=> 'parcel mangkok kaibon, hamper keramik kaibon, parcel lebaran keramik, hadiah korporat mangkok, parsel pernikahan keramik, hamper twotone',
                'order'        => 12,
            ],

            // ── 13 ─────────────────────────────────────────────────────────────
            [
                'name'         => 'Cangkir Keramik Motif Vintage Kaibon',
                'slug'         => 'cangkir-motif-vintage-kaibon',
                'short_desc'   => 'Cangkir kopi keramik Kaibon bermotif bunga ukir dengan tatakan lepek - pilihan klasik hangat untuk penyajian kopi dan teh di restoran keluarga, warung, dan hotel.',
                'description'  => $desc_template(
                    'Cangkir Keramik Motif Vintage Kaibon',
                    'Cocok untuk warung kopi tradisional, restoran keluarga bergaya klasik, hotel, dan usaha kuliner yang ingin nuansa penyajian lebih personal dan hangat. Ideal untuk kopi, teh, wedang jahe, dan minuman tradisional.',
                    'Motif vintage yang detail dan ukiran khas menjadikan cangkir ini bukan sekadar alat minum - melainkan pengalaman visual yang menambah nilai penyajian di meja tamu.'
                ),
                'image'        => 'services/kaibon/cangkir-motif-vintage-kaibon-1.webp',
                'gallery'      => [
                    'services/kaibon/cangkir-motif-vintage-kaibon-2.webp',
                    'services/kaibon/cangkir-motif-vintage-kaibon-3.webp',
                    'services/kaibon/cangkir-motif-vintage-kaibon-4.webp',
                ],
                'specs'        => [
                    ['key' => 'Brand / Merk',   'value' => 'Kaibon'],
                    ['key' => 'Tipe',           'value' => 'Cangkir + Lepek / Cup & Saucer'],
                    ['key' => 'Motif / Desain', 'value' => 'Motif Vintage Klasik Khas Kaibon'],
                    ['key' => 'Material',       'value' => 'Keramik Tradisional Food Grade'],
                    ['key' => 'Teknik Motif',   'value' => 'In-Glaze, Tahan Dicuci Rutin'],
                    ['key' => 'Peruntukan',     'value' => 'Warung Kopi, Restoran Keluarga, Hotel, Kafe Tradisional'],
                ],
                'faqs'         => array_merge($faq_umum, [
                    ['q' => 'Apakah lepek dijual terpisah dari cangkir?', 'a' => 'Bisa dipesan set lengkap cangkir + lepek maupun satuan. Hubungi tim kami untuk info ketersediaan dan harga.'],
                ]),
                'meta_title'   => 'Cangkir Keramik Motif Vintage Kaibon Grosir - Distributor Resmi | Pusat Piring Keramik',
                'meta_desc'    => 'Distributor resmi Cangkir Keramik Motif Vintage Kaibon. Cangkir kopi keramik bermotif bunga klasik untuk warung, restoran keluarga, dan hotel. Grosir se-Indonesia.',
                'meta_keywords'=> 'cangkir motif bunga kaibon, cangkir kopi keramik klasik, cangkir lepek motif, cangkir warung kopi, grosir cangkir keramik, cangkir teh tradisional',
                'order'        => 13,
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
            $this->command->info("  [{$count}/13] {$p['name']}");
        }

        Cache::flush();
        $total = Service::where('service_category_id', $category->id)->count();
        $this->command->info("\n==> SELESAI: {$total} produk Kaibon tersimpan di database.");
    }
}

