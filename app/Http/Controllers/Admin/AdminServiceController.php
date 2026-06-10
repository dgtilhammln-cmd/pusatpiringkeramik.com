<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $services = Service::ordered()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create() { return view('admin.services.create'); }

    public function store(Request $request)
    {
        $v = $request->validate([
            'name'          => 'required|max:200',
            'slug'          => 'nullable|max:200|regex:/^[a-z0-9\-]*$/',
            'short_desc'    => 'nullable|max:500',
            'description'   => 'nullable',
            'icon'          => 'nullable|max:50',
            'order'         => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
            'meta_title'    => 'nullable|max:70',
            'meta_desc'     => 'nullable|max:165',
            'meta_keywords' => 'nullable|max:500',
            'image'         => 'nullable|image|max:5120',
            'og_image'      => 'nullable|image|max:5120',
        ]);

        // Slug
        $slug = Str::slug(!empty($v['slug']) ? $v['slug'] : $v['name']);
        $base = $slug; $i = 1;
        while (Service::where('slug', $slug)->exists()) { $slug = $base.'-'.$i++; }
        $v['slug'] = $slug;

        $v['is_active'] = $request->boolean('is_active', true);
        $v['order']     = $v['order'] ?? 0;

        if (empty($v['meta_title'])) $v['meta_title'] = $v['name'].' | CV. Karya Perdana Teknik';
        if (empty($v['meta_desc']))  $v['meta_desc']  = Str::limit(strip_tags($v['short_desc'] ?? ''), 155);

        if ($request->hasFile('image')) {
            $v['image'] = $this->storeWebP($request->file('image'), 'services', 1200, 800);
            if (!$request->hasFile('og_image')) {
                $v['og_image'] = $this->storeOgWebP($request->file('image'), 'services/og');
            }
        }
        if ($request->hasFile('og_image')) {
            $v['og_image'] = $this->storeOgWebP($request->file('og_image'), 'services/og');
        }

        Service::create($v);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service) { return view('admin.services.edit', compact('service')); }

    public function update(Request $request, Service $service)
    {
        $v = $request->validate([
            'name'          => 'required|max:200',
            'slug'          => 'nullable|max:200|regex:/^[a-z0-9\-]*$/',
            'short_desc'    => 'nullable|max:500',
            'description'   => 'nullable',
            'icon'          => 'nullable|max:50',
            'order'         => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
            'meta_title'    => 'nullable|max:70',
            'meta_desc'     => 'nullable|max:165',
            'meta_keywords' => 'nullable|max:500',
            'image'         => 'nullable|image|max:5120',
            'og_image'      => 'nullable|image|max:5120',
        ]);

        // Slug update
        if (!empty($v['slug'])) {
            $slug = Str::slug($v['slug']);
            $base = $slug; $i = 1;
            while (Service::where('slug', $slug)->where('id','!=',$service->id)->exists()) { $slug = $base.'-'.$i++; }
            $v['slug'] = $slug;
        }

        $v['is_active'] = $request->boolean('is_active', true);
        $v['order']     = $v['order'] ?? $service->order;

        if ($request->hasFile('image')) {
            $this->deleteStorageFile($service->image);
            $v['image'] = $this->storeWebP($request->file('image'), 'services', 1200, 800);
            if (!$request->hasFile('og_image') && !$service->og_image) {
                $v['og_image'] = $this->storeOgWebP($request->file('image'), 'services/og');
            }
        }
        if ($request->hasFile('og_image')) {
            $this->deleteStorageFile($service->og_image);
            $v['og_image'] = $this->storeOgWebP($request->file('og_image'), 'services/og');
        }

        $service->update($v);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $this->deleteStorageFile($service->image);
        $this->deleteStorageFile($service->og_image);
        $service->delete();
        return back()->with('success', 'Layanan berhasil dihapus.');
    }
}
