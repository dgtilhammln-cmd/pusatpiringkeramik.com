<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categoriesData = [
            [
                'name'          => 'Mug Promosi Cap Gunung',
                'slug'          => 'mug-promosi-cap-gunung',
                'description'   => 'Mug promosi keramik, porcelain, dan enamel merk Cap Gunung dengan sablon/decal custom logo berkualitas tinggi. Sangat ideal untuk souvenir perusahaan, acara seminar, merchandise kantor, promo event, serta branding cafe & restoran.',
                'meta_title'    => 'Distributor Mug Promosi Cap Gunung Custom Logo Grosir',
                'meta_desc'     => 'Jual Mug Promosi Cap Gunung custom logo perusahaan harga grosir murah. Rekomendasi souvenir event, merchandise kantor & branding HORECA terlengkap.',
                'meta_keywords' => 'mug promosi cap gunung, grosir mug promosi, supplier mug souvenir custom, mug keramik cap gunung, produsen mug promosi surabaya, mug souvenir kantor',
                'parent_slug'   => null,
                'products'      => [
                    [
                        'name'       => 'Mug Promosi Cap Gunung Custom Logo Enamel 350ml',
                        'slug'       => 'mug-promosi-cap-gunung-custom-logo-enamel-350ml',
                        'short_desc' => 'Mug enamel Cap Gunung tahan panas dengan cetak logo custom untuk souvenir outdoor & event kantor.',
                        'meta_title' => 'Jual Mug Promosi Cap Gunung Enamel Custom Logo | UD. Sukses Makmur',
                        'meta_desc'  => 'Mug enamel Cap Gunung 350ml custom logo perusahaan. Tahan karat, tahan panas, dan cocok untuk souvenir outdoor & merchandise event.',
                        'meta_keywords' => 'mug enamel cap gunung, mug promosi enamel, mug souvenir custom logo, mug enamel surabaya',
                    ],
                    [
                        'name'       => 'Mug Keramik Cap Gunung White Glossy Standard 11oz',
                        'slug'       => 'mug-keramik-cap-gunung-white-glossy-11oz',
                        'short_desc' => 'Mug keramik putih polos Cap Gunung 11oz permukaan glossy food grade cocok untuk sablon & decal logo.',
                        'meta_title' => 'Mug Keramik Cap Gunung Putih Polos 11oz Grosir | Supplier Tableware',
                        'meta_desc'  => 'Mug keramik Cap Gunung warna putih glossy 11oz. Standar sablon souvenir, food grade & microwave safe.',
                        'meta_keywords' => 'mug keramik putih cap gunung, mug sablon polos, mug keramik 11oz grosir, mug promosi polos',
                    ],
                    [
                        'name'       => 'Mug Promosi Cap Gunung Two-Tone Color Inner & Handle',
                        'slug'       => 'mug-promosi-cap-gunung-two-tone-color',
                        'short_desc' => 'Mug keramik dua warna Cap Gunung dengan kombinasi warna menarik pada bagian dalam dan pegangan mug.',
                        'meta_title' => 'Mug Keramik Two Tone Cap Gunung Custom Logo Souvenir',
                        'meta_desc'  => 'Jual mug keramik two tone Cap Gunung warna-warni. Mug promosi eksklusif dengan cetak logo presisi tinggi.',
                        'meta_keywords' => 'mug two tone cap gunung, mug warna dalam, mug promosi dua warna, mug souvenir berwarna',
                    ],
                    [
                        'name'       => 'Mug Promosi Cap Gunung Vintage Coating Sablon Logo',
                        'slug'       => 'mug-promosi-cap-gunung-vintage-coating',
                        'short_desc' => 'Mug keramik bergaya vintage klasik Cap Gunung untuk resto, cafe retro, dan merchandise bergaya unik.',
                        'meta_title' => 'Mug Vintage Cap Gunung Keramik Klasik Custom Branding',
                        'meta_desc'  => 'Mug keramik vintage Cap Gunung desain klasik tahan lama. Pilihan favorit cafe & resto bertema retro.',
                        'meta_keywords' => 'mug vintage cap gunung, mug keramik jadul, mug cafe retro, mug promosi unik',
                    ],
                    [
                        'name'       => 'Mug Keramik Cap Gunung Sublimasi Premium Food Grade',
                        'slug'       => 'mug-keramik-cap-gunung-sublimasi-premium',
                        'short_desc' => 'Mug coated khusus sublimasi Cap Gunung dengan hasil cetak warna tajam, jernih, dan tidak mudah mengelupas.',
                        'meta_title' => 'Mug Sublimasi Cap Gunung Premium Food Grade Grosir',
                        'meta_desc'  => 'Distributor mug coating sublimasi Cap Gunung. Siap cetak foto & logo full color hasil tajam mengkilap.',
                        'meta_keywords' => 'mug sublimasi cap gunung, mug coating souvenir, mug pres foto custom, grosir mug sublimasi',
                    ],
                ]
            ],
            [
                'name'          => 'Kaibon',
                'slug'          => 'kaibon',
                'description'   => 'Koleksi piranti makan keramik & porselen Kaibon modern elegan. Dirancang khusus untuk memenuhi standar keindahan estetika serta ketahanan operasional hotel bintang lima, restoran fine dining, cafe kekinian, dan catering profesional.',
                'meta_title'    => 'Distributor Tableware Kaibon Porcelain & Keramik Premium',
                'meta_desc'     => 'Jual perlengkapan makan Kaibon keramik & porselen kualitas ekspor. Piring, mangkok & tea set Kaibon harga grosir distributor terpercaya.',
                'meta_keywords' => 'kaibon ceramic, tableware kaibon, piring keramik kaibon, mangkok porselen kaibon, distributor kaibon surabaya, piring resto kaibon',
                'parent_slug'   => null,
                'products'      => [
                    [
                        'name'       => 'Piring Makan Kaibon Porcelain Dinner Plate 10 Inch',
                        'slug'       => 'piring-makan-kaibon-porcelain-dinner-plate-10-inch',
                        'short_desc' => 'Piring makan porselen Kaibon ukuran 10 inchi berdesain mewah, tahan goresan pisau, dan food-grade.',
                        'meta_title' => 'Piring Makan Kaibon Porcelain 10 Inch Hotel & Resto Grade',
                        'meta_desc'  => 'Jual piring makan Kaibon porselen 10 inch polos mewah. Pilihan utama hotel bintang dan restoran fine dining.',
                        'meta_keywords' => 'piring makan kaibon, kaibon dinner plate, piring porselen 10 inch, piring hotel kaibon',
                    ],
                    [
                        'name'       => 'Mangkok Sup Kaibon Ceramic Deep Bowl 7 Inch',
                        'slug'       => 'mangkok-sup-kaibon-ceramic-deep-bowl-7-inch',
                        'short_desc' => 'Mangkok sup keramik Kaibon 7 inchi bentuk melengkung anggun, tahan panas tinggi dan mudah dibersihkan.',
                        'meta_title' => 'Mangkok Sup Kaibon Ceramic Deep Bowl 7 Inch Grosir',
                        'meta_desc'  => 'Mangkok sup dan soto Kaibon keramik 7 inchi. Tahan panas microwave & dishwasher safe untuk resto.',
                        'meta_keywords' => 'mangkok sup kaibon, mangkok keramik kaibon 7 inch, kaibon deep bowl, mangkok soto kaibon',
                    ],
                    [
                        'name'       => 'Piring Ceper Kaibon Fine Ceramic Salad Plate 8 Inch',
                        'slug'       => 'piring-ceper-kaibon-fine-ceramic-salad-plate-8-inch',
                        'short_desc' => 'Piring ceper 8 inchi Kaibon untuk penyajian appetizer, dessert, kue, dan salad dengan kesan eksklusif.',
                        'meta_title' => 'Piring Ceper Kaibon Salad & Dessert Plate 8 Inch',
                        'meta_desc'  => 'Piring ceper Kaibon 8 inchi porselen halus. Cocok untuk salad, dessert, dan hidangan pembuka restoran.',
                        'meta_keywords' => 'piring ceper kaibon, piring dessert kaibon, kaibon salad plate, piring kue keramik',
                    ],
                    [
                        'name'       => 'Cangkir & Saucer Set Kaibon Porcelain Coffee Cup',
                        'slug'       => 'cangkir-saucer-set-kaibon-porcelain-coffee-cup',
                        'short_desc' => 'Set cangkir kopi dan tatakan porselen Kaibon penyaji kopi dan teh dengan sentuhan kemewahan istimewa.',
                        'meta_title' => 'Cangkir Saucer Set Kaibon Porcelain Kopi & Teh Cafe',
                        'meta_desc'  => 'Set cangkir dan tatakan porselen Kaibon untuk cafe dan hotel. Desain ergonomis dan finishing berkilau.',
                        'meta_keywords' => 'cangkir kaibon, cangkir kopi porcelain kaibon, cangkir saucer set, cangkir teh hotel kaibon',
                    ],
                    [
                        'name'       => 'Piring Saji Kaibon Oval Serving Platter 12 Inch',
                        'slug'       => 'piring-saji-kaibon-oval-serving-platter-12-inch',
                        'short_desc' => 'Piring saji oval Kaibon 12 inchi untuk hidangan ikan bakar, seafood, prasmanan, dan menu tengah meja.',
                        'meta_title' => 'Piring Saji Oval Kaibon 12 Inch Porselen Restoran',
                        'meta_desc'  => 'Jual piring saji bentuk oval merk Kaibon ukuran 12 inchi. Material keramik porselen tebal tahan benturan.',
                        'meta_keywords' => 'piring saji oval kaibon, piring ikan kaibon, kaibon serving platter, piring prasmanan kaibon',
                    ],
                ]
            ],
            [
                'name'          => 'Toyoki',
                'slug'          => 'toyoki',
                'description'   => 'Produk tableware keramik & stoneware gaya Jepang merk Toyoki. Tahan terhadap suhu panas ekstrem, ramah microwave & dishwasher, tahan goresan, serta sangat pas untuk restoran Japanese Food, Ramen Bar, Sushibar, dan Modern Asian Dining.',
                'meta_title'    => 'Supplier Piring & Mangkok Keramik Toyoki HORECA Grosir',
                'meta_desc'     => 'Distributor piring keramik Toyoki & perlengkapan makan ala Jepang terpercaya. Kualitas food grade, microwave safe, harga grosir terbaik.',
                'meta_keywords' => 'piring toyoki, mangkok toyoki keramik, japanese tableware toyoki, supplier toyoki indonesia, piring resto jepang toyoki',
                'parent_slug'   => null,
                'products'      => [
                    [
                        'name'       => 'Piring Keramik Toyoki Japanese Style Rectangular Dish 10 Inch',
                        'slug'       => 'piring-keramik-toyoki-japanese-style-rectangular-10-inch',
                        'short_desc' => 'Piring persegi panjang Toyoki gaya Jepang untuk sajian sushi, sashimi, gyoza, dan gorengan tempura.',
                        'meta_title' => 'Piring Keramik Toyoki Persegi Panjang 10 Inch Japanese Style',
                        'meta_desc'  => 'Piring saji persegi panjang Toyoki 10 inchi. Desain autentik Jepang sangat cocok untuk restoran sushi & ramen.',
                        'meta_keywords' => 'piring toyoki persegi, piring sushi toyoki, japanese dish toyoki, piring saji tempura toyoki',
                    ],
                    [
                        'name'       => 'Mangkok Ramen Toyoki Stoneware Ceramic Bowl 8 Inch',
                        'slug'       => 'mangkok-ramen-toyoki-stoneware-ceramic-bowl-8-inch',
                        'short_desc' => 'Mangkok ramen tebal Toyoki ukuran 8 inchi material stoneware yang mampu menahan suhu kuah ramen panas lebih lama.',
                        'meta_title' => 'Mangkok Ramen Toyoki Stoneware 8 Inch Tahan Panas',
                        'meta_desc'  => 'Jual mangkok ramen Toyoki 8 inch berbahan stoneware tebal. Menjaga kuah tetap hangat, tidak mudah retak.',
                        'meta_keywords' => 'mangkok ramen toyoki, mangkok stoneware toyoki, mangkok kuah jepang, supplier mangkok ramen',
                    ],
                    [
                        'name'       => 'Piring Ceper Toyoki Modern Minimalist Dinner Plate 9 Inch',
                        'slug'       => 'piring-ceper-toyoki-modern-minimalist-9-inch',
                        'short_desc' => 'Piring ceper 9 inchi Toyoki dengan tekstur glaze khas yang memberi nuansa estetis pada hidangan utama.',
                        'meta_title' => 'Piring Ceper Toyoki Modern Minimalist 9 Inch Grosir',
                        'meta_desc'  => 'Piring ceper Toyoki 9 inchi minimalis modern. Pilihan favorit resto bistro dan cafe kekinian.',
                        'meta_keywords' => 'piring ceper toyoki, piring minimalis toyoki, toyoki dinner plate, piring resto kekinian',
                    ],
                    [
                        'name'       => 'Mangkok Nasi Toyoki Ceramic Rice Bowl 5 Inch',
                        'slug'       => 'mangkok-nasi-toyoki-ceramic-rice-bowl-5-inch',
                        'short_desc' => 'Mangkok nasi keramik Toyoki 5 inchi untuk nasi bento, chawanmushi, dan hidangan pendamping.',
                        'meta_title' => 'Mangkok Nasi Toyoki Ceramic Rice Bowl 5 Inch',
                        'meta_desc'  => 'Mangkok nasi keramik Toyoki 5 inch gaya Jepang. Desain kokoh, nyaman digenggam, food grade.',
                        'meta_keywords' => 'mangkok nasi toyoki, toyoki rice bowl, mangkok bento toyoki, mangkok kecil jepang',
                    ],
                    [
                        'name'       => 'Piring Saji Toyoki Fish Platter Heavy Duty Ceramic 12 Inch',
                        'slug'       => 'piring-saji-toyoki-fish-platter-ceramic-12-inch',
                        'short_desc' => 'Piring saji ikan dan hidangan laut Toyoki 12 inchi berbahan keramik tebal heavy-duty anti retak.',
                        'meta_title' => 'Piring Saji Ikan Toyoki Fish Platter 12 Inch Keramik',
                        'meta_desc'  => 'Piring saji bentuk ikan Toyoki 12 inch. Tahan banting, ideal untuk hidangan ikan steam & seafood resto.',
                        'meta_keywords' => 'piring saji ikan toyoki, toyoki fish platter, piring seafood toyoki, piring saji keramik tebal',
                    ],
                ]
            ],
            [
                'name'          => 'Cap Gunung (Stainless Ware)',
                'slug'          => 'cap-gunung-stainless-ware',
                'description'   => 'Lini perlengkapan makan stainless steel Cap Gunung (Stainless Ware) berbahan stainless steel kualitas food-grade tinggi. Anti karat, tebal, tahan lama, mengkilap, dan sangat cocok untuk operasional hotel, restoran, catering, hingga kantin pabrik.',
                'meta_title'    => 'Grosir Peralatan Makan Stainless Ware Cap Gunung Anti Karat',
                'meta_desc'     => 'Supplier sendok, garpu & peralatan makan Cap Gunung Stainless Ware. Bahan stainless steel food grade tebal & tahan karat untuk hotel & restoran.',
                'meta_keywords' => 'cap gunung stainless ware, sendok cap gunung, garpu stainless cap gunung, peralatan makan stainless hotel, grosir alat makan stainless',
                'parent_slug'   => null,
                'products'      => [
                    [
                        'name'       => 'Sendok Makan Cap Gunung Stainless Steel Thick Grade (12 Pcs)',
                        'slug'       => 'sendok-makan-cap-gunung-stainless-steel-thick-12pcs',
                        'short_desc' => 'Sendok makan stainless steel Cap Gunung tebal anti bengkok, permukaan halus mengkilap isi 12 pcs per pax.',
                        'meta_title' => 'Sendok Makan Stainless Cap Gunung Thick Grade Isi 12 Pcs',
                        'meta_desc'  => 'Jual sendok makan stainless Cap Gunung tebal & mengkilap. Anti karat, tahan lama untuk restoran & rumah tangga.',
                        'meta_keywords' => 'sendok makan cap gunung, sendok stainless cap gunung, grosir sendok makan, sendok tebal anti karat',
                    ],
                    [
                        'name'       => 'Garpu Makan Cap Gunung Stainless Steel Heavy Duty (12 Pcs)',
                        'slug'       => 'garpu-makan-cap-gunung-stainless-steel-heavy-duty-12pcs',
                        'short_desc' => 'Garpu makan stainless steel Cap Gunung dengan gerigi presisi, tebal, serta nyaman digunakan.',
                        'meta_title' => 'Garpu Makan Stainless Cap Gunung Heavy Duty Isi 12 Pcs',
                        'meta_desc'  => 'Garpu makan stainless steel Cap Gunung kualitas heavy duty. Anti bengkok dan cocok untuk catering & resto.',
                        'meta_keywords' => 'garpu makan cap gunung, garpu stainless cap gunung, grosir garpu stainless, peralatan makan resto',
                    ],
                    [
                        'name'       => 'Sendok Teh & Kopi Cap Gunung Stainless Steel Premium',
                        'slug'       => 'sendok-teh-kopi-cap-gunung-stainless-steel-premium',
                        'short_desc' => 'Sendok teh dan kopi stainless steel Cap Gunung ukuran mini yang pas untuk cangkir minuman hotel dan cafe.',
                        'meta_title' => 'Sendok Teh & Kopi Cap Gunung Stainless Steel Premium',
                        'meta_desc'  => 'Sendok teh kecil Cap Gunung bahan stainless steel mengkilap. Ideal untuk usaha cafe, resto, dan cangkir kopi.',
                        'meta_keywords' => 'sendok teh cap gunung, sendok kopi stainless, sendok kecil cap gunung, sendok dessert stainless',
                    ],
                    [
                        'name'       => 'Pisau Steak Cap Gunung Stainless Steel Table Knife',
                        'slug'       => 'pisau-steak-cap-gunung-stainless-steel-table-knife',
                        'short_desc' => 'Pisau makan / pisau steak stainless Cap Gunung bergerigi tajam untuk pemotongan daging restoran steakhouse.',
                        'meta_title' => 'Pisau Steak Stainless Cap Gunung Table Knife Restoran',
                        'meta_desc'  => 'Pisau steak stainless steel Cap Gunung tajam & tahan karat. Pegangan mantap untuk kebutuhan resto & hotel.',
                        'meta_keywords' => 'pisau steak cap gunung, table knife stainless, pisau makan cap gunung, pisau resto stainless',
                    ],
                    [
                        'name'       => 'Tray Saji Stainless Steel Cap Gunung Heavy Duty 40cm',
                        'slug'       => 'tray-saji-stainless-steel-cap-gunung-heavy-duty-40cm',
                        'short_desc' => 'Baki / tray saji stainless steel Cap Gunung ukuran 40cm serbaguna untuk pengantaran makanan catering & hotel.',
                        'meta_title' => 'Baki Tray Saji Stainless Steel Cap Gunung 40cm Catering',
                        'meta_desc'  => 'Baki saji stainless steel Cap Gunung 40cm tebal & tidak mudah penyok. Praktis untuk waiter resto & catering.',
                        'meta_keywords' => 'tray saji stainless cap gunung, baki catering stainless, baki makanan stainless, tray saji hotel 40cm',
                    ],
                ]
            ],
            [
                'name'          => 'Piring Cap Gunung',
                'slug'          => 'piring-cap-gunung',
                'description'   => 'Piring keramik & porselen Cap Gunung pilihan terfavorit di Indonesia. Memiliki ketahanan benturan ekstra, glazuur halus mengkilap, food-grade standar internasional, serta tersedia dalam berbagai varian piring cekung, piring ceper, piring list mas, dan piring saji.',
                'meta_title'    => 'Distributor Resmi Piring Cap Gunung Keramik Grosir Pabrik',
                'meta_desc'     => 'Pusat agen resmi piring keramik Cap Gunung. Menyediakan piring ceper, piring cekung & piring saji harga grosir murah untuk restoran & catering.',
                'meta_keywords' => 'piring cap gunung, distributor piring cap gunung, piring keramik cap gunung surabaya, pabrik piring cap gunung, piring cekung cap gunung',
                'parent_slug'   => null,
                'products'      => [
                    [
                        'name'       => 'Piring Cekung Cap Gunung Keramik Putih Polos 9 Inch',
                        'slug'       => 'piring-cekung-cap-gunung-keramik-putih-polos-9-inch',
                        'short_desc' => 'Piring cekung keramik putih polos Cap Gunung 9 inchi standar utama restoran, warung makan, dan catering.',
                        'meta_title' => 'Piring Cekung Cap Gunung Putih Polos 9 Inch Grosir Resto',
                        'meta_desc'  => 'Distributor piring cekung Cap Gunung keramik putih polos 9 inch. Sangat tebal, food grade, dan harga grosir pabrik.',
                        'meta_keywords' => 'piring cekung cap gunung, piring keramik 9 inch, piring makan putih cap gunung, grosir piring resto',
                    ],
                    [
                        'name'       => 'Piring Ceper Cap Gunung Keramik List Mas 10 Inch',
                        'slug'       => 'piring-ceper-cap-gunung-keramik-list-mas-10-inch',
                        'short_desc' => 'Piring ceper keramik Cap Gunung 10 inchi dengan hiasan garis emas (list mas) mewah untuk pesta & gedung pertemuan.',
                        'meta_title' => 'Piring Ceper Cap Gunung Keramik List Mas 10 Inch',
                        'meta_desc'  => 'Jual piring ceper Cap Gunung list mas 10 inch. Menghadirkan kesan elegan pada hidangan pesta & resepsi.',
                        'meta_keywords' => 'piring list mas cap gunung, piring ceper 10 inch, piring pesta keramik, piring emas cap gunung',
                    ],
                    [
                        'name'       => 'Piring Cekung Cap Gunung Motif Bunga Klasik 8 Inch',
                        'slug'       => 'piring-cekung-cap-gunung-motif-bunga-klasik-8-inch',
                        'short_desc' => 'Piring cekung Cap Gunung 8 inchi bermotif bunga klasik legendaris yang disukai rumah tangga & usaha kuliner.',
                        'meta_title' => 'Piring Cekung Cap Gunung Motif Bunga Klasik 8 Inch',
                        'meta_desc'  => 'Piring cekung motif bunga Cap Gunung 8 inch. Motif cetak tahan pudar, keramik tebal anti retak.',
                        'meta_keywords' => 'piring motif bunga cap gunung, piring bunga jadul, piring cekung 8 inch, piring makan keluarga',
                    ],
                    [
                        'name'       => 'Piring Makan Cap Gunung Porcelain White Hotel Grade 9.5 Inch',
                        'slug'       => 'piring-makan-cap-gunung-porcelain-white-hotel-grade',
                        'short_desc' => 'Piring makan porselen putih polos Cap Gunung 9.5 inchi berstandar hotel bintang tiga ke atas.',
                        'meta_title' => 'Piring Makan Porselen Cap Gunung Hotel Grade 9.5 Inch',
                        'meta_desc'  => 'Piring makan porselen putih Cap Gunung 9.5 inchi standar hotel. Kilau sempurna dan ekstra tahan gores.',
                        'meta_keywords' => 'piring porselen cap gunung, piring putih hotel, piring makan 9.5 inch, piring porcelain polos',
                    ],
                    [
                        'name'       => 'Piring Saji Oval Cap Gunung Keramik Tebal 12 Inch',
                        'slug'       => 'piring-saji-oval-cap-gunung-keramik-tebal-12-inch',
                        'short_desc' => 'Piring saji bentuk oval Cap Gunung 12 inchi keramik tebal untuk sajian lauk pauk tengah meja.',
                        'meta_title' => 'Piring Saji Oval Cap Gunung Keramik Tebal 12 Inch',
                        'meta_desc'  => 'Piring saji oval keramik Cap Gunung 12 inch. Ideal untuk lauk makan bersama, ikan goreng, dan prasmanan.',
                        'meta_keywords' => 'piring saji oval cap gunung, piring lauk cap gunung, piring besar keramik, piring oval 12 inch',
                    ],
                ]
            ],
            [
                'name'          => 'Mangkok Cap Gunung',
                'slug'          => 'mangkok-cap-gunung',
                'description'   => 'Mangkok keramik & porselen merk Cap Gunung khusus kuliner Indonesia. Tersedia berbagai ukuran mangkok bakso, mangkok mi ayam, mangkok soto, mangkok sup, hingga mangkok cobek keramik dengan ketahanan panas luar biasa.',
                'meta_title'    => 'Jual Mangkok Keramik Cap Gunung Bakso & Sup Grosir Murah',
                'meta_desc'     => 'Distributor mangkok keramik Cap Gunung terlengkap. Mangkok bakso, mangkok sup, mangkok ayam & mangkok ramen porselen harga grosir pabrik.',
                'meta_keywords' => 'mangkok cap gunung, mangkok keramik cap gunung, mangkok bakso cap gunung, supplier mangkok cap gunung, mangkok sup porselen',
                'parent_slug'   => 'piring-cap-gunung',
                'products'      => [
                    [
                        'name'       => 'Mangkok Bakso Cap Gunung Keramik Putih 7 Inch',
                        'slug'       => 'mangkok-bakso-cap-gunung-keramik-putih-7-inch',
                        'short_desc' => 'Mangkok bakso keramik Cap Gunung 7 inchi standar usaha bakso, mie ayam, dan soto seluruh Indonesia.',
                        'meta_title' => 'Mangkok Bakso Cap Gunung Keramik Putih 7 Inch Grosir',
                        'meta_desc'  => 'Jual mangkok bakso Cap Gunung keramik putih 7 inchi. Tebal, menahan panas kuah lama, dan harga grosir pabrik.',
                        'meta_keywords' => 'mangkok bakso cap gunung, mangkok soto cap gunung, mangkok keramik 7 inch, grosir mangkok bakso',
                    ],
                    [
                        'name'       => 'Mangkok Sup Cekung Cap Gunung Porcelain 6 Inch',
                        'slug'       => 'mangkok-sup-cekung-cap-gunung-porcelain-6-inch',
                        'short_desc' => 'Mangkok sup porselen Cap Gunung 6 inchi bentuk melengkung anggun cocok untuk hidangan sup & prasmanan.',
                        'meta_title' => 'Mangkok Sup Cekung Cap Gunung Porcelain 6 Inch',
                        'meta_desc'  => 'Mangkok sup porselen Cap Gunung 6 inchi. Warna putih bening khas porselen, mudah dicuci dan hygienic.',
                        'meta_keywords' => 'mangkok sup cap gunung, mangkok porselen 6 inch, mangkok prasmanan, mangkok kuah cap gunung',
                    ],
                    [
                        'name'       => 'Mangkok Mie Ayam Cap Gunung Ceramic Deep Bowl 8 Inch',
                        'slug'       => 'mangkok-mie-ayam-cap-gunung-ceramic-deep-bowl-8-inch',
                        'short_desc' => 'Mangkok dalam keramik Cap Gunung 8 inchi kapasitas besar untuk mie ayam komplit, ramen, dan kuah jumbo.',
                        'meta_title' => 'Mangkok Mie Ayam Cap Gunung Ceramic Deep Bowl 8 Inch',
                        'meta_desc'  => 'Mangkok mie ayam Cap Gunung 8 inchi kapasitas jumbo. Keramik kokoh anti pecah untuk warung & restoran.',
                        'meta_keywords' => 'mangkok mie ayam cap gunung, mangkok jumbo cap gunung, mangkok deep bowl 8 inch, mangkok ramen keramik',
                    ],
                    [
                        'name'       => 'Mangkok Kecil Sambal Cap Gunung Keramik 3.5 Inch',
                        'slug'       => 'mangkok-kecil-sambal-cap-gunung-keramik-3-5-inch',
                        'short_desc' => 'Mangkok cuka dan mangkok sambal keramik Cap Gunung 3.5 inchi pelengkap meja makan meja resto.',
                        'meta_title' => 'Mangkok Kecil Sambal & Saucer Cap Gunung Keramik 3.5 Inch',
                        'meta_desc'  => 'Mangkok kecil tempat sambal & kecap Cap Gunung 3.5 inchi. Terbuat dari keramik tebal dan praktis.',
                        'meta_keywords' => 'mangkok sambal cap gunung, mangkok cuka keramik, mangkok kecap kecil, mangkok condiment 3.5 inch',
                    ],
                    [
                        'name'       => 'Mangkok Cobek Keramik Cap Gunung Heavy Duty 7.5 Inch',
                        'slug'       => 'mangkok-cobek-keramik-cap-gunung-heavy-duty-7-5-inch',
                        'short_desc' => 'Mangkok cobek penyajian ayam penyet & bebek goreng Cap Gunung 7.5 inchi berbahan keramik tahan api & minyak.',
                        'meta_title' => 'Mangkok Cobek Keramik Cap Gunung Heavy Duty 7.5 Inch',
                        'meta_desc'  => 'Mangkok cobek penyet Cap Gunung 7.5 inchi keramik tebal khusus penyajian resto ayam & bebek penyet panas.',
                        'meta_keywords' => 'mangkok cobek cap gunung, cobek keramik penyet, mangkok ayam penyet, mangkok cobek tahan panas',
                    ],
                ]
            ],
        ];

        // 1. Create or Update Categories & Map Parent IDs
        $createdCategoryMap = [];

        foreach ($categoriesData as $catData) {
            $parentId = null;
            if (!empty($catData['parent_slug']) && isset($createdCategoryMap[$catData['parent_slug']])) {
                $parentId = $createdCategoryMap[$catData['parent_slug']]->id;
            }

            $category = ServiceCategory::updateOrCreate(
                ['slug' => $catData['slug']],
                [
                    'name'          => $catData['name'],
                    'description'   => $catData['description'],
                    'parent_id'     => $parentId,
                    'meta_title'    => $catData['meta_title'],
                    'meta_desc'     => $catData['meta_desc'],
                    'meta_keywords' => $catData['meta_keywords'],
                ]
            );

            $createdCategoryMap[$catData['slug']] = $category;

            // 2. Create or Update High-Intent Products for each category
            foreach ($catData['products'] as $pIndex => $pData) {
                $productContent = "<h2>Deskripsi Produk {$pData['name']}</h2>"
                    . "<p>{$pData['short_desc']} Produk ini diproduksi dengan standar kualitas internasional food-grade, tahan terhadap suhu panas tinggi, aman digunakan dalam microwave maupun dishwasher, serta didesain khusus untuk daya tahan operasional yang lama.</p>"
                    . "<h2>Spesifikasi & Keunggulan</h2>"
                    . "<ul>"
                    . "<li><strong>Brand / Merk:</strong> " . $catData['name'] . "</li>"
                    . "<li><strong>Material:</strong> High-Grade Ceramic / Porcelain / Stainless Steel</li>"
                    . "<li><strong>Standar Keamanan:</strong> 100% Food Grade Safe, Lead-Free & Cadmium-Free</li>"
                    . "<li><strong>Ketahanan Suhu:</strong> Tahan panas oven, microwave & dishwasher safe</li>"
                    . "<li><strong>Penggunaan:</strong> Ideal untuk Restoran, Hotel, Cafe, Catering, Warung Kuliner, dan Souvenir Promosi</li>"
                    . "</ul>"
                    . "<h2>Layanan Pemesanan & Pengiriman Grosir</h2>"
                    . "<p>UD. Sukses Makmur (Pusat Piring Keramik) melayani pembelian eceran maupun grosir skala besar dengan penawaran harga pabrik terbaik. Setiap pengiriman ke luar kota dilindungi dengan kemasan bubble wrap ekstra dan paking peti kayu tebal untuk memastikan produk sampai tanpa retak atau pecah.</p>";

                Service::updateOrCreate(
                    ['slug' => $pData['slug']],
                    [
                        'service_category_id' => $category->id,
                        'name'                => $pData['name'],
                        'short_desc'          => $pData['short_desc'],
                        'description'         => $productContent,
                        'order'               => $pIndex + 1,
                        'is_active'           => true,
                        'meta_title'          => $pData['meta_title'],
                        'meta_desc'           => $pData['meta_desc'],
                        'meta_keywords'       => $pData['meta_keywords'],
                    ]
                );
            }

            $this->command->info("✓ Category Seeding Success: {$category->name} (ID: {$category->id}) with " . count($catData['products']) . " high-intent products");
        }

        // Clean up old legacy/dummy paint products that don't belong to any of these new categories
        $validCatIds = ServiceCategory::pluck('id')->toArray();
        Service::whereNotIn('service_category_id', $validCatIds)->orWhereNull('service_category_id')->delete();

        $this->command->info('✓ Done! All categories seeded with high-intent SEO metadata and mapped products successfully.');
    }
}
