<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPageManagementController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $settings = Setting::getAllAsArray();
        return view('admin.page_management.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        // Save normal input fields & JSON arrays
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Encode array inputs (cards/items) to JSON string
                $value = json_encode(array_values(array_filter($value)));
            }

            $existing = Setting::where('key', $key)->first();
            $type     = $existing?->type ?? 'text';
            if ($type !== 'image') {
                Setting::set($key, $value ?? '', $type, 'page_management');
            }
        }

        // Save image file uploads
        foreach ($request->allFiles() as $key => $file) {
            if (!$file->isValid()) continue;
            $path = $this->storeWebP($file, 'pages', 1920, 1080, 85);
            Setting::set($key, $path, 'image', 'page_management');
        }

        Setting::clearCache();
        return back()->with('success', 'Halaman berhasil diperbarui!');
    }
}
