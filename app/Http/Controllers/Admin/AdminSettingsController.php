<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $imageKeys = ['hero_bg_image', 'about_image', 'og_image_default', 'logo', 'favicon'];
        $data      = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            if (is_array($value)) continue; // skip file array
            $existing = Setting::where('key', $key)->first();
            $type     = $existing?->type ?? 'text';
            if ($type !== 'image') {
                Setting::set($key, $value ?? '', $type);
            }
        }

        // Handle image uploads
        foreach ($request->allFiles() as $key => $file) {
            if (!$file->isValid()) continue;

            // Handle favicon separately (ico/png, no WebP conversion)
            if ($key === 'favicon') {
                $path = 'settings/favicon.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));
                Setting::set($key, $path, 'image');
                // Also copy to public/
                copy($file->getRealPath(), base_path('public_html/favicon.ico'));
                continue;
            }

            if ($key === 'logo') {
                $path = $this->storeWebP($file, 'settings', 400, 200, 90);
                Setting::set($key, $path, 'image');
                continue;
            }

            $path = $this->storeWebP($file, 'settings', 1920, 1080, 85);
            Setting::set($key, $path, 'image');
        }

        Setting::clearCache();
        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
