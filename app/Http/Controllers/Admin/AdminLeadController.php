<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class AdminLeadController extends Controller
{
    public function index()
    {
        $leads      = Lead::latest()->paginate(25);
        $stats = [
            'total'     => Lead::count(),
            'today'     => Lead::today()->count(),
            'this_month'=> Lead::thisMonth()->count(),
            'new'       => Lead::new()->count(),
        ];
        return view('admin.leads.index', compact('leads', 'stats'));
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
        $query = Lead::latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $leads = $query->get();

        $filename = 'leads-kpt-' . now()->format('Ymd-His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($leads) {
            $handle = fopen('php://output', 'w');
            // BOM untuk Excel agar karakter Indonesia tampil benar
            fwrite($handle, "\xEF\xBB\xBF");

            // Header row
            fputcsv($handle, [
                'ID', 'Nama', 'Perusahaan', 'Email', 'Telepon/WA',
                'Produk Diminati', 'Pesan/Kebutuhan',
                'Sumber', 'URL Halaman', 'Status', 'Catatan',
                'Perangkat', 'IP Address', 'Tanggal Masuk',
            ]);

            foreach ($leads as $lead) {
                fputcsv($handle, [
                    $lead->id,
                    $lead->name,
                    $lead->company ?? '',
                    $lead->email ?? '',
                    $lead->phone,
                    $lead->product ?? '',
                    $lead->message ?? '',
                    $lead->source ?? 'Website',
                    $lead->page_url ?? '',
                    $lead->status_label,
                    $lead->notes ?? '',
                    $lead->device_type ?? '',
                    $lead->ip_address ?? '',
                    $lead->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
