<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\WaSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Setting::getAllAsArray();
        $wa       = WaSetting::primary();

        $comp    = Setting::get('company_name', config('app.name'));
        $tagline = Setting::get('company_tagline', '');

        $seo = [
            'title'       => $settings['meta_title_contact'] ?? ('Hubungi Kami | ' . $comp),
            'description' => $settings['meta_desc_contact'] ?? ($tagline ?: ('Hubungi ' . $comp . ' untuk konsultasi dan informasi lebih lanjut.')),
            'keywords'    => $settings['meta_keywords_contact'] ?? '',
            'og_image'    => !empty($settings['og_image_default']) ? asset('storage/'.$settings['og_image_default']) : (!empty($settings['logo']) ? asset('storage/'.$settings['logo']) : asset('images/og-default.jpg')),
            'canonical'   => route('contact'),
        ];

        $defaultFaqs = [
            [
                'q' => 'Apakah Pusat Piring Keramik melayani pemesanan grosir untuk restoran, cafe, dan hotel?',
                'a' => 'Ya, kami melayani pengadaan piring keramik & tableware secara grosir dengan harga pabrik langsung. Kami rutin memasok kebutuhan peralatan makan untuk restoran, kafe, hotel, catering, dan usaha F&B di seluruh Indonesia.'
            ],
            [
                'q' => 'Apakah piring keramik dijamin aman untuk microwave, oven, dan dishwasher (Food Grade)?',
                'a' => 'Tentu saja. Seluruh piring keramik dan tableware kami terbuat dari material porselen/stoneware berkualitas tinggi yang 100% Food Grade, bebas timbal & cadmium, serta tahan panas aman digunakan di microwave, oven, maupun mesin cuci piring.'
            ],
            [
                'q' => 'Apakah pengiriman piring keramik aman dan garansi pecah saat perjalanan luar kota?',
                'a' => 'Pengiriman kami sangat aman. Setiap produk dikemas rapi memakai bubble wrap tebal, dus khusus, dan palet/peti kayu kuat. Kami memberikan garansi pecah saat pengiriman — jika produk diterima pecah, akan langsung kami ganti baru.'
            ],
            [
                'q' => 'Berapa minimal order (MOQ) untuk pembelian grosir atau cetak custom logo?',
                'a' => 'Untuk produk ready stock, kami menerima pemesanan grosir tanpa minimum order yang memberatkan. Khusus pemesanan custom logo resto atau desain khusus, MOQ menyesuaikan dengan tipe produk dan teknik cetak yang diinginkan.'
            ],
            [
                'q' => 'Bagaimana cara meminta penawaran harga (pricelist) atau sampel produk?',
                'a' => 'Anda dapat dengan mudah menghubungi tim customer service kami melalui tombol WhatsApp yang tersedia atau mengisi form kontak di halaman ini. Tim kami akan segera mengirimkan katalog digital beserta daftar harga grosir terbaik.'
            ]
        ];

        $rawContactFaqs = $settings['contact_faq_json'] ?? null;
        $faq = [];
        if (!empty($rawContactFaqs)) {
            $parsed = is_string($rawContactFaqs) ? json_decode($rawContactFaqs, true) : $rawContactFaqs;
            if (is_array($parsed) && count($parsed) > 0) {
                foreach (array_slice($parsed, 0, 5) as $item) {
                    $q = $item['q'] ?? ($item['question'] ?? '');
                    $a = $item['a'] ?? ($item['answer'] ?? '');
                    $show = $item['show'] ?? '1';
                    if (!empty($q) && !empty($a) && ($show == '1' || $show === true || $show === 'on')) {
                        $faq[] = ['q' => $q, 'a' => $a];
                    }
                }
            }
        }

        if (empty($faq)) {
            $faq = $defaultFaqs;
        }

        $schema = json_encode([
            '@context' => 'https://schema.org',
            '@type'    => 'FAQPage',
            'mainEntity' => collect($faq)->map(fn($f) => [
                '@type'          => 'Question',
                'name'           => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ])->toArray(),
        ]);

        return view('contact.index', compact('settings', 'wa', 'seo', 'faq', 'schema'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|min:2|max:100',
            'company'   => 'nullable|max:100',
            'email'     => 'required|email|max:100',
            'phone'     => 'required|min:8|max:20',
            'product'   => 'nullable|max:100',
            'message'   => 'required|min:10|max:2000',
        ]);

        // Log to database (analytics)
        \App\Models\AnalyticsEvent::record('contact_form', route('contact'), [
            'page_title' => 'Contact Form - ' . $validated['name'],
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan menghubungi Anda segera. Atau langsung chat via WhatsApp untuk respon lebih cepat.');
    }
}
