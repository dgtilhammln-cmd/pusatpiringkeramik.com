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
        $imageKeys = ['hero_bg_image', 'hero_main_image', 'hero_secondary_image', 'about_image', 'about_c3_image', 'og_image_default', 'logo', 'favicon', 'coverage_map'];
        $data      = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = json_encode(array_values(array_filter($value)));
            }
            
            $existing = Setting::where('key', $key)->first();
            $type     = $existing?->type ?? 'text';
            if ($type !== 'image') {
                Setting::set($key, $value ?? '', $type);
            }
        }

        // Handle URL Domain (APP_URL) and APP_NAME synchronization to .env
        $envUpdates = [];
        if ($request->has('app_url')) {
            $cleanUrl = rtrim(trim($request->input('app_url')), '/');
            if (!empty($cleanUrl)) {
                Setting::set('app_url', $cleanUrl, 'text', 'seo');
                $envUpdates['APP_URL'] = $cleanUrl;
            }
        }

        if ($request->has('app_name') || $request->has('company_name')) {
            $appName  = trim($request->input('app_name', ''));
            $compName = trim($request->input('company_name', Setting::get('company_name', 'Pusat Piring Keramik')));
            Setting::set('app_name', $appName, 'text', 'seo');
            
            $effectiveName = !empty($appName) ? $appName : $compName;
            if (!empty($effectiveName)) {
                $envUpdates['APP_NAME'] = $effectiveName;
            }
        }

        if (!empty($envUpdates)) {
            $this->syncEnvFile($envUpdates);
        }

        // Handle image uploads
        foreach ($request->allFiles() as $key => $file) {
            if (!$file->isValid()) continue;

            if ($key === 'favicon') {
                try {
                    $ext  = strtolower($file->getClientOriginalExtension());
                    $path = 'settings/favicon.' . ($ext ?: 'ico');
                    Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));
                    Setting::set($key, $path, 'image');

                    $pubHtmlFavicon = base_path('public_html/favicon.ico');
                    $pubFavicon     = public_path('favicon.ico');

                    if (file_exists(base_path('public_html'))) {
                        @copy($file->getRealPath(), $pubHtmlFavicon);
                    }
                    if (file_exists(public_path())) {
                        @copy($file->getRealPath(), $pubFavicon);
                    }
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error('Favicon upload error: ' . $e->getMessage());
                }
                continue;
            }

            if ($key === 'compro') {
                $path = 'settings/compro_' . time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));
                Setting::set($key, $path, 'file');
                continue;
            }

            if ($key === 'logo') {
                $path = $this->storeWebP($file, 'settings', 400, 200, 90);
                Setting::set($key, $path, 'image');
                continue;
            }

            if ($key === 'coverage_map') {
                $path = $this->storeWebP($file, 'settings', 2400, 1200, 90);
                Setting::set($key, $path, 'image');
                continue;
            }

            $path = $this->storeWebP($file, 'settings', 1920, 1080, 85);
            Setting::set($key, $path, 'image');
        }

        Setting::clearCache();
        return back()->with('success', 'Pengaturan berhasil disimpan dan disinkronkan!');
    }

    /**
     * Safely update values inside the .env file
     */
    protected function syncEnvFile(array $keyValues): void
    {
        $envPath = base_path('.env');
        if (!file_exists($envPath)) {
            return;
        }

        try {
            $envContent = file_get_contents($envPath);

            foreach ($keyValues as $key => $val) {
                $envKey = strtoupper($key);
                $val = str_replace(["\r", "\n"], '', $val);
                $escapedVal = (str_contains($val, ' ') && !str_starts_with($val, '"')) ? '"' . $val . '"' : $val;

                if (preg_match("/^{$envKey}=.*/m", $envContent)) {
                    $envContent = preg_replace("/^{$envKey}=.*/m", "{$envKey}={$escapedVal}", $envContent);
                } else {
                    $envContent .= "\n{$envKey}={$escapedVal}";
                }
            }

            file_put_contents($envPath, $envContent);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Env sync error: ' . $e->getMessage());
        }
    }
}
