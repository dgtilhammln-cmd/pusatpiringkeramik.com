<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class AdminLeadController extends Controller
{
    public function index(Request $request)
    {
        $currentType = $request->query('type', 'all');

        $query = Lead::latest();
        if ($currentType === 'popup') {
            $query->popup();
        } elseif ($currentType === 'wa_code') {
            $query->waCode();
        }

        $leads = $query->paginate(25)->appends($request->query());

        $stats = [
            'total'      => Lead::count(),
            'popup'      => Lead::popup()->count(),
            'wa_code'    => Lead::waCode()->count(),
            'today'      => Lead::today()->count(),
            'this_month' => Lead::thisMonth()->count(),
            'new'        => Lead::new()->count(),
        ];

        $activeMode = \App\Models\Setting::get('lead_mode', 'popup');

        return view('admin.leads.index', compact('leads', 'stats', 'currentType', 'activeMode'));
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate(['status' => 'required|in:new,contacted,closed']);
        $lead->update(['status' => $request->status]);
        return back()->with('success', 'Status lead diperbarui.');
    }

    public function markAllRead()
    {
        Lead::where('status', 'new')->update(['status' => 'contacted']);
        return back()->with('success', 'Semua notifikasi baru telah ditandai sebagai dibaca.');
    }

    public function updateNote(Request $request, Lead $lead)
    {
        $request->validate(['notes' => 'nullable|max:2000']);
        $lead->update(['notes' => $request->notes]);
        return back()->with('success', 'Catatan disimpan.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return back()->with('success', 'Lead dihapus.');
    }

    public function export(Request $request)
    {
        if (!$request->filled('start_date') || !$request->filled('end_date')) {
            return back()->with('error', 'Silakan pilih periode tanggal terlebih dahulu sebelum download laporan.');
        }

        $type  = $request->query('type', 'all');
        $query = Lead::latest();
        $query->whereDate('created_at', '>=', $request->start_date);
        $query->whereDate('created_at', '<=', $request->end_date);

        if ($type === 'popup') {
            $query->popup();
        } elseif ($type === 'wa_code') {
            $query->waCode();
        }

        $leads = $query->get();
        $filename = 'leads-export-' . $type . '-' . $request->start_date . '_' . $request->end_date . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($leads, $type) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF"); // BOM for Excel

            // Watermark / info rows
            fputcsv($handle, ['Laporan Leads & Request Order:', strtoupper($type)]);
            fputcsv($handle, ['Tanggal Cetak:', now()->format('d/m/Y H:i')]);
            fputcsv($handle, []);

            if ($type === 'wa_code') {
                // Mode Kode Referensi WA Column Schema
                fputcsv($handle, [
                    'Nomor Urut / Unique Code', 'Tanggal Klik', 'Waktu Klik',
                    'Nomor WA Tujuan', 'Sumber Halaman', 'Perangkat', 'Status', 'Catatan'
                ]);
                foreach ($leads as $lead) {
                    fputcsv($handle, [
                        $lead->ref_code ?? ('UDSM-' . str_pad((string)$lead->seq_number, 4, '0', STR_PAD_LEFT)),
                        $lead->created_at->format('d/m/Y'),
                        $lead->created_at->format('H:i:s'),
                        $lead->wa_number ? ('+' . $lead->wa_number) : '-',
                        $lead->source ?? 'Tombol WhatsApp',
                        $lead->device_type ?? 'Unknown',
                        $lead->status_label,
                        $lead->notes ?? '',
                    ]);
                }
            } elseif ($type === 'popup') {
                // Mode Popup Form Column Schema
                fputcsv($handle, [
                    'Tanggal', 'Waktu', 'Nama Lengkap', 'Perusahaan',
                    'Email', 'Telepon / WA', 'Produk / Kebutuhan',
                    'Sumber Halaman', 'Perangkat', 'Status', 'Pesan'
                ]);
                foreach ($leads as $lead) {
                    fputcsv($handle, [
                        $lead->created_at->format('d/m/Y'),
                        $lead->created_at->format('H:i:s'),
                        $lead->name,
                        $lead->company ?? '-',
                        $lead->email ?? '-',
                        $lead->phone,
                        $lead->product ?? '-',
                        $lead->source ?? 'Website',
                        $lead->device_type ?? '',
                        $lead->status_label,
                        $lead->message ?? '',
                    ]);
                }
            } else {
                // All / Rekap Mode
                fputcsv($handle, [
                    'Tipe Mode', 'Kode Unik / ID', 'Tanggal', 'Waktu',
                    'Nama / Identitas', 'Telepon / WA', 'Perusahaan',
                    'Kebutuhan / Pesan', 'Sumber Halaman', 'Perangkat', 'Status'
                ]);
                foreach ($leads as $lead) {
                    fputcsv($handle, [
                        $lead->lead_type === 'wa_code' ? 'Kode WA' : 'Popup Form',
                        $lead->ref_code ?? ('ID-' . $lead->id),
                        $lead->created_at->format('d/m/Y'),
                        $lead->created_at->format('H:i:s'),
                        $lead->name,
                        $lead->phone,
                        $lead->company ?? '-',
                        $lead->message ?? ($lead->product ?? '-'),
                        $lead->source ?? 'Website',
                        $lead->device_type ?? '',
                        $lead->status_label,
                    ]);
                }
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        if (!$request->filled('start_date') || !$request->filled('end_date')) {
            return back()->with('error', 'Silakan pilih periode tanggal terlebih dahulu sebelum download PDF.');
        }

        $type  = $request->query('type', 'all');
        $query = Lead::latest();
        $query->whereDate('created_at', '>=', $request->start_date);
        $query->whereDate('created_at', '<=', $request->end_date);

        if ($type === 'popup') {
            $query->popup();
        } elseif ($type === 'wa_code') {
            $query->waCode();
        }

        $leads = $query->get();
        $from  = \Carbon\Carbon::parse($request->start_date);
        $to    = \Carbon\Carbon::parse($request->end_date);

        return view('admin.exports.leads_pdf', compact('leads', 'from', 'to', 'type'));
    }
}
