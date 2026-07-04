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
        // Admin user
        User::updateOrCreate(['email' => 'admin@karyaperdanateknik.co.id'], [
            'name'     => 'Admin KPT',
            'password' => Hash::make('Admin@KPT2024'),
            'role'     => 'admin',
            'is_active'=> true,
        ]);

        // WA Settings
        WaSetting::insert([
            ['label'=>'WA 1 - Layanan Utama','nomor_wa'=>'081331148731','template_pesan'=>'Halo CV. Karya Perdana Teknik, saya ingin konsultasi mengenai [produk]. Mohon informasinya. Terima kasih.','is_active'=>1,'is_primary'=>1,'order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['label'=>'WA 2 - Backup','nomor_wa'=>'085731907040','template_pesan'=>'Halo CV. Karya Perdana Teknik, saya ingin konsultasi mengenai [produk]. Mohon informasinya. Terima kasih.','is_active'=>1,'is_primary'=>0,'order'=>2,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // Settings
        $settings = [
            // Hero
            ['key'=>'hero_headline','value'=>'Solusi Angkat & Angkut Industri Terpercaya','type'=>'text','group'=>'hero','label'=>'Hero Headline'],
            ['key'=>'hero_subheadline','value'=>'Spesialis Hoist, Crane System & Cargo Lift — Melayani Seluruh Indonesia dengan Standar Keselamatan Tertinggi','type'=>'text','group'=>'hero','label'=>'Hero Sub-headline'],
            ['key'=>'hero_cta_primary','value'=>'Konsultasi Gratis','type'=>'text','group'=>'hero','label'=>'CTA Primary Text'],
            ['key'=>'hero_cta_secondary','value'=>'Lihat Produk Kami','type'=>'text','group'=>'hero','label'=>'CTA Secondary Text'],
            ['key'=>'hero_bg_image','value'=>'','type'=>'image','group'=>'hero','label'=>'Hero Background Image'],
            // About
            ['key'=>'about_text','value'=>'CV. Karya Perdana Teknik berdiri sejak 2013, bergerak di bidang penyediaan, instalasi, dan perawatan mesin angkat & angkut industri. Kami telah melayani lebih dari 28 perusahaan besar di seluruh Indonesia dengan komitmen kualitas dan keselamatan kerja.','type'=>'text','group'=>'about','label'=>'About Text'],
            ['key'=>'about_image','value'=>'','type'=>'image','group'=>'about','label'=>'About Image'],
            ['key'=>'visi','value'=>'Menjadi Perusahaan yang berkompeten dibidang penyediaan mesin angkat & angkut dengan management yang profesional.','type'=>'text','group'=>'about','label'=>'Visi'],
            ['key'=>'misi','value'=>'Menciptakan pelayanan dan solusi menyeluruh dengan kualitas terbaik dalam pengadaan mesin angkat & angkut untuk meningkatkan nilai investasi pelanggan serta mengutamakan keselamatan dan kesehatan kerja.','type'=>'text','group'=>'about','label'=>'Misi'],
            // Stats
            ['key'=>'stat_years','value'=>'10+','type'=>'text','group'=>'stats','label'=>'Tahun Pengalaman'],
            ['key'=>'stat_clients','value'=>'28+','type'=>'text','group'=>'stats','label'=>'Klien'],
            ['key'=>'stat_products','value'=>'12','type'=>'text','group'=>'stats','label'=>'Jenis Produk'],
            ['key'=>'stat_coverage','value'=>'Seluruh Indonesia','type'=>'text','group'=>'stats','label'=>'Jangkauan'],
            // Contact
            ['key'=>'phone','value'=>'031 - 99171407','type'=>'text','group'=>'contact','label'=>'Telepon'],
            ['key'=>'wa1','value'=>'081331148731','type'=>'text','group'=>'contact','label'=>'WhatsApp 1'],
            ['key'=>'wa2','value'=>'085731907040','type'=>'text','group'=>'contact','label'=>'WhatsApp 2'],
            ['key'=>'email','value'=>'karyaperdanateknik@gmail.com','type'=>'text','group'=>'contact','label'=>'Email'],
            ['key'=>'address','value'=>'Pergudangan Legundi Business Park Blok D-11, Legundi - Gresik - Jawa Timur','type'=>'text','group'=>'contact','label'=>'Alamat'],
            ['key'=>'maps_embed','value'=>'https://maps.google.com/maps?q=-7.1583,112.6515&output=embed','type'=>'text','group'=>'contact','label'=>'Maps Embed URL'],
            // Social
            ['key'=>'instagram','value'=>'','type'=>'text','group'=>'social','label'=>'Instagram URL'],
            ['key'=>'facebook','value'=>'','type'=>'text','group'=>'social','label'=>'Facebook URL'],
            ['key'=>'youtube','value'=>'','type'=>'text','group'=>'social','label'=>'YouTube URL'],
            // Footer
            ['key'=>'footer_desc','value'=>'Spesialis Hoist, Crane System & Cargo Lift. Melayani pengadaan, instalasi, fabrikasi & maintenance di seluruh Indonesia.','type'=>'text','group'=>'footer','label'=>'Footer Description'],
            ['key'=>'copyright','value'=>'© 2024 CV. Karya Perdana Teknik. All rights reserved.','type'=>'text','group'=>'footer','label'=>'Copyright'],
            // SEO
            ['key'=>'meta_title_home','value'=>'Hoist Crane Lift Specialist | CV. Karya Perdana Teknik Gresik','type'=>'text','group'=>'seo','label'=>'Meta Title Home'],
            ['key'=>'meta_desc_home','value'=>'CV. Karya Perdana Teknik - Spesialis Overhead Crane, Chain Hoist, Wire Rope Hoist & Cargo Lift. Melayani seluruh Indonesia. Hubungi: 081331148731','type'=>'text','group'=>'seo','label'=>'Meta Desc Home'],
            ['key'=>'og_image_default','value'=>'','type'=>'image','group'=>'seo','label'=>'Default OG Image (1200x630)'],
            // Legal
            ['key'=>'npwp','value'=>'31.817.130.3-603.000','type'=>'text','group'=>'legal','label'=>'NPWP'],
            ['key'=>'nib','value'=>'9120105110524','type'=>'text','group'=>'legal','label'=>'NIB'],
            ['key'=>'akte','value'=>'No. 47/1093/CV/VIII/2013','type'=>'text','group'=>'legal','label'=>'Akte Notaris'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], array_merge($s, ['created_at'=>now(),'updated_at'=>now()]));
        }

        // Services
        $services = [
            ['name'=>'Overhead Crane Single Girder','slug'=>'overhead-crane-single-girder','short_desc'=>'Overhead Crane Single Girder kapasitas 1–20 ton, cocok untuk industri manufaktur dan pergudangan.','icon'=>'crane','order'=>1],
            ['name'=>'Overhead Crane Double Girder','slug'=>'overhead-crane-double-girder','short_desc'=>'Overhead Crane Double Girder kapasitas tinggi hingga 50 ton untuk industri berat.','icon'=>'crane-double','order'=>2],
            ['name'=>'Monorail Hoist & Underhung Crane','slug'=>'monorail-hoist-underhung-crane','short_desc'=>'Sistem monorail hoist fleksibel untuk jalur produksi dan assembly line.','icon'=>'rail','order'=>3],
            ['name'=>'Gantry Crane & Portable Gantry','slug'=>'gantry-crane-portable','short_desc'=>'Gantry crane portabel dan permanen untuk outdoor maupun indoor.','icon'=>'gantry','order'=>4],
            ['name'=>'Jib Crane & Wall Jib','slug'=>'jib-crane-wall-jib','short_desc'=>'Jib crane dan wall jib untuk area kerja terbatas dengan jangkauan optimal.','icon'=>'jib','order'=>5],
            ['name'=>'Chain Hoist (0.25–50 Ton)','slug'=>'chain-hoist','short_desc'=>'Chain hoist merek Nitchi, Hitachi, Hinatsu, Samsung kapasitas 0.25–50 ton.','icon'=>'chain','order'=>6],
            ['name'=>'Wire Rope Hoist (3–30 Ton)','slug'=>'wire-rope-hoist','short_desc'=>'Wire rope hoist Korean/Japan/China/European brand, kapasitas 3–30 ton.','icon'=>'wire','order'=>7],
            ['name'=>'Cargo Elevator / Lift Barang','slug'=>'cargo-elevator-lift-barang','short_desc'=>'Lift barang industri kapasitas besar untuk gudang dan pabrik.','icon'=>'lift','order'=>8],
            ['name'=>'Semi Passenger Lift','slug'=>'semi-passenger-lift','short_desc'=>'Semi passenger lift untuk industri dengan standar keselamatan tinggi.','icon'=>'elevator','order'=>9],
            ['name'=>'Dumb Waiter','slug'=>'dumb-waiter','short_desc'=>'Dumb waiter untuk restoran, hotel, rumah sakit dan bangunan komersial.','icon'=>'dumbwaiter','order'=>10],
            ['name'=>'Spare Parts Crane & Lift','slug'=>'spare-parts-crane-lift','short_desc'=>'Suplai spare parts crane dan lift berkualitas dari brand terpercaya.','icon'=>'parts','order'=>11],
            ['name'=>'Fabrikasi, Instalasi & Maintenance','slug'=>'fabrikasi-instalasi-maintenance','short_desc'=>'Layanan fabrikasi, modifikasi, instalasi, maintenance & service crane dan lift.','icon'=>'service','order'=>12],
        ];
        foreach ($services as $s) {
            Service::updateOrCreate(['slug'=>$s['slug']], array_merge($s, [
                'description' => '<p>'.$s['short_desc'].'</p><p>CV. Karya Perdana Teknik menyediakan solusi terbaik dengan garansi after-sales dan harga kompetitif. Hubungi kami untuk konsultasi gratis.</p>',
                'is_active' => true, 'created_at'=>now(),'updated_at'=>now()
            ]));
        }

        // Gallery Projects
        $galleries = [
            ['title'=>'Pemasangan Overhead Crane 10 Ton','category'=>'overhead-crane','client'=>'PT. Daesang Ingredient Indonesia','location'=>'Gresik','year'=>2023,'order'=>1],
            ['title'=>'Instalasi Chain Hoist 5 Ton','category'=>'chain-hoist','client'=>'PT. Surya Intrindo Makmur','location'=>'Sidoarjo','year'=>2023,'order'=>2],
            ['title'=>'Gantry Crane Outdoor 20 Ton','category'=>'gantry-crane','client'=>'PT. Omya Indonesia','location'=>'Tuban','year'=>2022,'order'=>3],
            ['title'=>'Cargo Lift Barang 3 Lantai','category'=>'cargo-lift','client'=>'PT. Hartono Istana Teknologi','location'=>'Semarang','year'=>2023,'order'=>4],
            ['title'=>'Wire Rope Hoist Double Girder','category'=>'overhead-crane','client'=>'PT. Bintang Internasional','location'=>'Makassar','year'=>2022,'order'=>5],
            ['title'=>'Monorail System Produksi','category'=>'monorail','client'=>'PT. Sinar Kencana Agung','location'=>'Malang','year'=>2022,'order'=>6],
            ['title'=>'Jib Crane Wall Mount 2 Ton','category'=>'jib-crane','client'=>'PT. Mitra Surya Persada','location'=>'Surabaya','year'=>2023,'order'=>7],
            ['title'=>'Maintenance Overhead Crane Tahunan','category'=>'maintenance','client'=>'PT. Indoflora Kencana','location'=>'Malang','year'=>2024,'order'=>8],
        ];
        foreach ($galleries as $g) {
            GalleryProject::updateOrCreate(['title'=>$g['title']], array_merge($g, [
                'description' => 'Proyek pemasangan dan instalasi oleh CV. Karya Perdana Teknik dengan standar keselamatan terbaik.',
                'image'       => '',
                'alt_text'    => $g['title'].' - CV. Karya Perdana Teknik',
                'is_active'   => true, 'created_at'=>now(),'updated_at'=>now()
            ]));
        }

        // Articles
        $articles = [
            [
                'title'        => 'Cara Memilih Overhead Crane yang Tepat untuk Industri Anda',
                'slug'         => 'cara-memilih-overhead-crane-untuk-industri',
                'excerpt'      => 'Memilih overhead crane yang tepat sangat krusial untuk efisiensi dan keselamatan operasional industri. Pelajari panduan lengkapnya di sini.',
                'category'     => 'Tips & Panduan',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'author'       => 'Tim Karya Perdana Teknik',
                'meta_title'   => 'Cara Memilih Overhead Crane yang Tepat | CV. Karya Perdana Teknik',
                'meta_desc'    => 'Panduan lengkap memilih overhead crane single girder vs double girder. Kapasitas, bentang, dan tips keselamatan dari spesialis crane Indonesia.',
            ],
            [
                'title'        => 'Perbedaan Chain Hoist dan Wire Rope Hoist: Mana yang Cocok?',
                'slug'         => 'perbedaan-chain-hoist-vs-wire-rope-hoist',
                'excerpt'      => 'Chain hoist dan wire rope hoist punya keunggulan masing-masing. Simak perbandingan lengkap untuk menentukan pilihan terbaik.',
                'category'     => 'Produk',
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'author'       => 'Tim Karya Perdana Teknik',
                'meta_title'   => 'Chain Hoist vs Wire Rope Hoist: Perbedaan & Keunggulan | KPT',
                'meta_desc'    => 'Perbandingan chain hoist dan wire rope hoist dari sisi kapasitas, kecepatan, dan perawatan. Panduan dari spesialis crane Surabaya Gresik.',
            ],
            [
                'title'        => 'Pentingnya Maintenance Rutin pada Crane dan Hoist Industri',
                'slug'         => 'pentingnya-maintenance-rutin-crane-hoist-industri',
                'excerpt'      => 'Maintenance rutin pada crane dan hoist bukan hanya soal efisiensi, tapi soal keselamatan jiwa pekerja dan aset perusahaan.',
                'category'     => 'Maintenance',
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'author'       => 'Tim Karya Perdana Teknik',
                'meta_title'   => 'Pentingnya Maintenance Rutin Crane & Hoist Industri | KPT',
                'meta_desc'    => 'Jadwal dan manfaat maintenance rutin overhead crane, chain hoist & cargo lift. Tips dari teknisi berpengalaman CV. Karya Perdana Teknik.',
            ],
        ];
        $contentTemplate = '<h2>Pendahuluan</h2><p>Industri modern sangat bergantung pada sistem mesin angkat & angkut yang andal. CV. Karya Perdana Teknik hadir sebagai mitra terpercaya sejak 2013.</p><h2>Isi Utama</h2><p>Dengan pengalaman lebih dari 10 tahun dan lebih dari 28 klien perusahaan besar di seluruh Indonesia, kami memahami kebutuhan industri secara mendalam.</p><h2>Kesimpulan</h2><p>Hubungi kami di <strong>081331148731</strong> untuk konsultasi gratis dan penawaran terbaik.</p>';
        foreach ($articles as $a) {
            Article::updateOrCreate(['slug'=>$a['slug']], array_merge($a, [
                'content'=>$contentTemplate, 'views'=>rand(50,300),
                'created_at'=>now(),'updated_at'=>now()
            ]));
        }

        // Clients
        $clients = [
            ['name'=>'PT. Enjine Asia Megha Jaya','city'=>'Sidoarjo','order'=>1],
            ['name'=>'PT. Bintang Jaya Santika','city'=>'Bekasi','order'=>2],
            ['name'=>'PT. Daesang Ingredient Indonesia','city'=>'Gresik','order'=>3],
            ['name'=>'PT. Karya Sinar Cipta','city'=>'Pomalaa Sultra','order'=>4],
            ['name'=>'PT. Omya Indonesia','city'=>'Tuban','order'=>5],
            ['name'=>'PT. Supraco Indonesia','city'=>'Jakarta','order'=>6],
            ['name'=>'PT. Elmar Mitra Perkasa','city'=>'Lombok','order'=>7],
            ['name'=>'PT. Sinar Kencana Agung','city'=>'Malang','order'=>8],
            ['name'=>'PT. Surya Intrindo Makmur','city'=>'Sidoarjo','order'=>9],
            ['name'=>'PT. Panca Indah Jaya Mahe','city'=>'Surabaya','order'=>10],
            ['name'=>'PT. Mitra Surya Persada','city'=>'Surabaya','order'=>11],
            ['name'=>'PT. Lestari Mulya','city'=>'Sidoarjo','order'=>12],
            ['name'=>'UD. Victory Gold','city'=>'Surabaya','order'=>13],
            ['name'=>'CV. Tribert','city'=>'Singaraja Bali','order'=>14],
            ['name'=>'PT. Bintang Internasional','city'=>'Makassar','order'=>15],
            ['name'=>'PT. Unggul Regantris Digdjoyo','city'=>'Gresik','order'=>16],
            ['name'=>'UD. Baja Mandiri','city'=>'Solo','order'=>17],
            ['name'=>'PT. Hartono Istana Teknologi','city'=>'Semarang','order'=>18],
            ['name'=>'PT. Prambanan Putra','city'=>'Denpasar','order'=>19],
            ['name'=>'PT. Indoflora Kencana','city'=>'Malang','order'=>20],
            ['name'=>'PT. Bintang Internasional','city'=>'Manado','order'=>21],
            ['name'=>'UD. Sukses Sejahtera','city'=>'Denpasar','order'=>22],
            ['name'=>'CV. Mandiri Teknik','city'=>'Surabaya','order'=>23],
            ['name'=>'PT Aira Health Industries','city'=>'Surabaya','order'=>24],
            ['name'=>'PT Balindo Mitra Perkasa','city'=>'Denpasar','order'=>25],
            ['name'=>'CV Sinar Jaya','city'=>'Lombok','order'=>26],
            ['name'=>'Pabrik Atap Baja Ringan BP Rendy','city'=>'Denpasar Bali','order'=>27],
            ['name'=>'PT. Lestari Mulya','city'=>'Sidoarjo','order'=>28],
        ];
        foreach ($clients as $c) {
            Client::updateOrCreate(['name'=>$c['name'],'city'=>$c['city']], array_merge($c, [
                'is_active'=>true,'created_at'=>now(),'updated_at'=>now()
            ]));
        }

        // Testimonials
        Testimonial::insert([
            ['name'=>'Bapak Hendra','company'=>'PT. Daesang Ingredient Indonesia','position'=>'Engineering Manager','content'=>'CV. Karya Perdana Teknik sangat profesional dalam pemasangan overhead crane kami. Hasil pemasangan rapi, tepat waktu, dan tim teknisinya sangat berpengalaman.','rating'=>5,'is_active'=>1,'order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Ibu Sari','company'=>'PT. Hartono Istana Teknologi','position'=>'Purchasing Manager','content'=>'Harga kompetitif, kualitas produk bagus, dan layanan after-sales yang responsif. Kami sudah berlangganan selama 3 tahun.','rating'=>5,'is_active'=>1,'order'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Pak Agus','company'=>'PT. Surya Intrindo Makmur','position'=>'Plant Manager','content'=>'Maintenance rutin dari KPT membuat crane kami selalu dalam kondisi prima. Sangat direkomendasikan untuk industri manufaktur.','rating'=>5,'is_active'=>1,'order'=>3,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
