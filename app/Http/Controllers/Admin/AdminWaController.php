<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaSetting;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminWaController extends Controller
{
    public function index()
    {
        $waSettings = WaSetting::ordered()->get();
        return view('admin.wa.index', compact('waSettings'));
    }

    public function update(Request $request)
    {
        $ids = array_filter((array) $request->input('ids', []));
        $primaryId = $request->input('primary');

        if (empty($ids) && $request->has('label')) {
            $ids = array_keys((array) $request->input('label'));
        }

        foreach ($ids as $id) {
            $wa = WaSetting::find($id);
            if ($wa) {
                $rawNomor = $request->input("nomor_wa.$id", $wa->nomor_wa);
                $cleanNomor = preg_replace('/[^0-9]/', '', $rawNomor);
                
                $wa->update([
                    'label'          => $request->input("label.$id", $wa->label),
                    'nomor_wa'       => !empty($cleanNomor) ? $cleanNomor : $wa->nomor_wa,
                    'template_pesan' => $request->input("template_pesan.$id", $wa->template_pesan),
                    'is_active'      => $request->has("is_active.$id") ? $request->boolean("is_active.$id") : true,
                    'is_primary'     => $primaryId ? ($primaryId == $id) : $wa->is_primary,
                    'order'          => $request->input("order.$id", $wa->order ?? 0),
                ]);
            }
        }

        if ($primaryId) {
            WaSetting::where('id', '!=', $primaryId)->update(['is_primary' => false]);
            WaSetting::where('id', $primaryId)->update(['is_primary' => true]);
        }

        // Ensure at least one primary WA setting exists
        $primaryWa = WaSetting::where('is_active', true)->where('is_primary', true)->first();
        if (!$primaryWa) {
            $primaryWa = WaSetting::where('is_active', true)->first();
            if ($primaryWa) {
                $primaryWa->update(['is_primary' => true]);
            }
        }

        // Sync with Setting model so all global fallbacks stay in sync
        if ($primaryWa) {
            Setting::set('company_whatsapp', $primaryWa->nomor_wa, 'text');
            Setting::set('phone', $primaryWa->nomor_wa, 'text');
            Setting::set('whatsapp', $primaryWa->nomor_wa, 'text');
            Setting::clearCache();
        }

        return back()->with('success', 'Pengaturan WhatsApp berhasil disimpan.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label'          => 'required|max:100',
            'nomor_wa'       => 'required',
            'template_pesan' => 'required',
        ]);

        $cleanNomor = preg_replace('/[^0-9]/', '', $request->nomor_wa);
        $hasExistingPrimary = WaSetting::where('is_primary', true)->exists();

        $wa = WaSetting::create([
            'label'          => $request->label,
            'nomor_wa'       => $cleanNomor,
            'template_pesan' => $request->template_pesan,
            'is_active'      => true,
            'is_primary'     => !$hasExistingPrimary,
            'order'          => (WaSetting::max('order') ?? 0) + 1,
        ]);

        if (!$hasExistingPrimary) {
            Setting::set('company_whatsapp', $wa->nomor_wa, 'text');
            Setting::set('phone', $wa->nomor_wa, 'text');
            Setting::set('whatsapp', $wa->nomor_wa, 'text');
            Setting::clearCache();
        }

        return back()->with('success', 'Nomor WhatsApp baru berhasil ditambahkan.');
    }

    public function destroy(int $id)
    {
        $wa = WaSetting::findOrFail($id);
        $wasPrimary = $wa->is_primary;
        $wa->delete();

        if ($wasPrimary) {
            $newPrimary = WaSetting::where('is_active', true)->first();
            if ($newPrimary) {
                $newPrimary->update(['is_primary' => true]);
                Setting::set('company_whatsapp', $newPrimary->nomor_wa, 'text');
                Setting::set('phone', $newPrimary->nomor_wa, 'text');
                Setting::set('whatsapp', $newPrimary->nomor_wa, 'text');
                Setting::clearCache();
            }
        }

        return back()->with('success', 'Nomor WhatsApp berhasil dihapus.');
    }
}
