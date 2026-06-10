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
        $waList   = WaSetting::active()->ordered()->get();

        $seo = [
            'title'       => 'Hubungi Kami | CV. Karya Perdana Teknik - Konsultasi Crane & Hoist',
            'description' => 'Hubungi CV. Karya Perdana Teknik untuk konsultasi overhead crane, chain hoist & cargo lift. WA: 081331148731. Alamat: Pergudangan Legundi Business Park, Gresik.',
            'og_image'    => asset('images/og-default.jpg'),
            'canonical'   => route('contact'),
        ];

        $faq = [
            ['q' => 'Di mana lokasi CV. Karya Perdana Teknik?', 'a' => 'Kami berlokasi di Pergudangan Legundi Business Park Blok D-11, Legundi - Gresik - Jawa Timur.'],
            ['q' => 'Apakah konsultasi gratis?', 'a' => 'Ya, kami menyediakan konsultasi gratis. Hubungi kami melalui WhatsApp atau telepon untuk diskusi kebutuhan Anda.'],
            ['q' => 'Apakah ada layanan survei lokasi?', 'a' => 'Ya, kami menyediakan layanan survei lokasi sebelum pemasangan untuk memastikan solusi yang tepat.'],
            ['q' => 'Berapa lama proses pengiriman dan instalasi?', 'a' => 'Tergantung jenis produk dan lokasi. Kami berkomitmen pada jadwal yang telah disepakati bersama.'],
        ];

        $schema = json_encode([
            '@context' => 'https://schema.org',
            '@type'    => 'FAQPage',
            'mainEntity' => collect($faq)->map(fn($f) => [
                '@type'          => 'Question',
                'name'           => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ])->toArray(),
        ]);

        return view('contact.index', compact('settings', 'waList', 'seo', 'faq', 'schema'));
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

        return back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan menghubungi Anda segera. Atau langsung WhatsApp kami di 081331148731.');
    }
}
