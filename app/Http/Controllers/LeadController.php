<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\WaSetting;
use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|min:2|max:100',
            'company' => 'nullable|max:150',
            'email'   => 'nullable|email|max:100',
            'phone'   => 'required|min:7|max:20',
            'product' => 'nullable|max:200',
            'message' => 'nullable|max:2000',
        ]);

        // Get primary WA
        $wa = WaSetting::primary();

        // Build WA message
        $comp = \App\Models\Setting::get('company_name', config('app.name'));
        $msg = "Halo {$comp},\n\n";
        $msg .= "Nama: {$validated['name']}\n";
        if (!empty($validated['company'])) $msg .= "Perusahaan: {$validated['company']}\n";
        if (!empty($validated['email']))   $msg .= "Email: {$validated['email']}\n";
        $msg .= "Telepon: {$validated['phone']}\n";
        if (!empty($validated['product'])) $msg .= "Produk: {$validated['product']}\n";
        if (!empty($validated['message'])) $msg .= "\nPesan: {$validated['message']}\n";
        $msg .= "\nTerima kasih.";

        // Build WA URL — only if a primary WA number is configured in admin
        $nomor = null;
        $waUrl = null;
        if ($wa && $wa->nomor_wa) {
            $nomor = preg_replace('/[^0-9]/', '', $wa->nomor_wa);
            if (str_starts_with($nomor, '0')) $nomor = '62' . substr($nomor, 1);
            $waUrl = 'https://wa.me/' . $nomor . '?text=' . urlencode($msg);
        }

        // Save lead
        $lead = Lead::create(array_merge($validated, [
            'source'       => $request->input('source', 'Website'),
            'page_url'     => $request->header('Referer'),
            'ip_address'   => $request->ip(),
            'device_type'  => \App\Models\AnalyticsEvent::detectDevice($request->userAgent() ?? ''),
            'wa_number'    => $nomor,
            'utm_source'   => $request->session()->get('utm_source'),
            'utm_medium'   => $request->session()->get('utm_medium'),
            'utm_campaign' => $request->session()->get('utm_campaign'),
            'utm_term'     => $request->session()->get('utm_term'),
            'utm_content'  => $request->session()->get('utm_content'),
        ]));

        // Track analytics
        AnalyticsEvent::record('lead', $request->header('Referer'), [
            'page_title' => 'Request Order - ' . $validated['name'],
        ]);

        // Return WA redirect URL to frontend
        return response()->json([
            'success' => true,
            'wa_url'  => $waUrl,
            'lead_id' => $lead->id,
        ]);
    }

    /**
     * Direct WA Redirect with Unique Reference Code (Mode Kode WA: UDSM-0001, UDSM-9999, UDSM-10000...)
     */
    public function waRedirect(Request $request)
    {
        // 1. Get primary WA setting
        $wa = WaSetting::primary();
        $nomor = null;
        if ($wa && $wa->nomor_wa) {
            $nomor = preg_replace('/[^0-9]/', '', $wa->nomor_wa);
            if (str_starts_with($nomor, '0')) $nomor = '62' . substr($nomor, 1);
        }

        // 2. Generate atomic continuous ref code (UDSM-0001, UDSM-9999, UDSM-10000...)
        $refData = Lead::generateNextRefCode();
        $refCode = $refData['ref_code'];

        // 3. Determine Page URL & Page Path
        $pageUrl = $request->input('page_url') ?? $request->header('Referer') ?? url()->previous();
        $pagePath = parse_url($pageUrl, PHP_URL_PATH) ?: '/';

        $sourceText = $request->input('source', 'Tombol WhatsApp');
        if ($pagePath && $pagePath !== '/') {
            $sourceText .= ' (' . $pagePath . ')';
        }

        // 4. Build WA Template Message
        $comp = \App\Models\Setting::get('company_name', config('app.name'));
        $defaultTpl = "Halo {$comp}, saya tertarik dengan produk piring & tableware keramik. (Kode Referensi: {code}, Halaman: {page})";
        $rawTpl = \App\Models\Setting::get('wa_template_text', $defaultTpl);
        if (empty(trim($rawTpl))) {
            $rawTpl = $defaultTpl;
        }
        $msg = str_replace(
            ['{code}', '{kode}', '{page}', '{halaman}', '{url}'],
            [$refCode, $refCode, $pagePath, $pagePath, $pageUrl],
            $rawTpl
        );

        $waUrl = 'https://wa.me/' . ($nomor ?: '6281805890181') . '?text=' . urlencode($msg);

        // 5. Instant millisecond logging to DB (preserves lead record even if visitor cancels opening WA)
        $lead = Lead::create([
            'lead_type'   => 'wa_code',
            'ref_code'    => $refCode,
            'seq_number'  => $refData['seq_number'],
            'name'        => 'WA Visitor (' . $refCode . ')',
            'phone'       => $nomor ? ('+' . $nomor) : '-',
            'company'     => '-',
            'source'      => $sourceText,
            'page_url'    => $pageUrl,
            'ip_address'  => $request->ip(),
            'device_type' => AnalyticsEvent::detectDevice($request->userAgent() ?? ''),
            'wa_number'   => $nomor,
            'status'      => 'new',
            'utm_source'  => $request->session()->get('utm_source'),
            'utm_medium'  => $request->session()->get('utm_medium'),
            'utm_campaign'=> $request->session()->get('utm_campaign'),
            'utm_term'    => $request->session()->get('utm_term'),
            'utm_content' => $request->session()->get('utm_content'),
        ]);

        // 6. Track Analytics
        AnalyticsEvent::record('lead_wa_code', $pageUrl, [
            'page_title' => 'WA Direct Click - ' . $refCode,
            'ref_code'   => $refCode,
        ]);

        return response()->json([
            'success'  => true,
            'wa_url'   => $waUrl,
            'ref_code' => $refCode,
            'lead_id'  => $lead->id,
            'page_url' => $pageUrl,
        ]);
    }
}
