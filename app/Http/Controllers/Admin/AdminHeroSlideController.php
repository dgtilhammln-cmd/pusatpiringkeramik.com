<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class AdminHeroSlideController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        return redirect()->route('admin.page_management', ['tab' => 'sect-hero']);
    }

    public function create()
    {
        return redirect()->route('admin.page_management', ['tab' => 'sect-hero']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|max:200',
            'subtitle'    => 'nullable|max:200',
            'description' => 'nullable|max:500',
            'tags'        => 'nullable|max:500',
            'icon'        => 'nullable|max:50',
            'image'       => 'nullable|image|max:5096',
            'button_text' => 'nullable|max:100',
            'button_url'  => 'nullable|max:300',
            'order'       => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
            'stat_1_value'=> 'nullable|max:50',
            'stat_1_label'=> 'nullable|max:100',
            'stat_2_value'=> 'nullable|max:50',
            'stat_2_label'=> 'nullable|max:100',
            'stat_3_value'=> 'nullable|max:50',
            'stat_3_label'=> 'nullable|max:100',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $request->input('order', 0);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeWebP($request->file('image'), 'hero_slides', 3448);
        }

        $count = HeroSlide::count();
        if ($count >= 5) {
            return redirect()->route('admin.page_management', ['tab' => 'sect-hero'])->withErrors(['limit' => 'Maksimal 5 slide diperbolehkan.'])->withInput();
        }

        HeroSlide::create($validated);
        return redirect()->route('admin.page_management', ['tab' => 'sect-hero'])->with('success', 'Slide Hero berhasil ditambahkan.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return redirect()->route('admin.page_management', ['tab' => 'sect-hero', 'edit_slide' => $heroSlide->id]);
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'title'       => 'required|max:200',
            'subtitle'    => 'nullable|max:200',
            'description' => 'nullable|max:500',
            'tags'        => 'nullable|max:500',
            'icon'        => 'nullable|max:50',
            'image'       => 'nullable|image|max:5096',
            'button_text' => 'nullable|max:100',
            'button_url'  => 'nullable|max:300',
            'order'       => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
            'stat_1_value'=> 'nullable|max:50',
            'stat_1_label'=> 'nullable|max:100',
            'stat_2_value'=> 'nullable|max:50',
            'stat_2_label'=> 'nullable|max:100',
            'stat_3_value'=> 'nullable|max:50',
            'stat_3_label'=> 'nullable|max:100',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $request->input('order', $heroSlide->order);

        if ($request->hasFile('image')) {
            $this->deleteStorageFile($heroSlide->image);
            $validated['image'] = $this->storeWebP($request->file('image'), 'hero_slides', 3448);
        }

        $heroSlide->update($validated);
        return redirect()->route('admin.page_management', ['tab' => 'sect-hero'])->with('success', 'Slide Hero berhasil diperbarui.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $this->deleteStorageFile($heroSlide->image ?? null);
        $heroSlide->delete();
        return redirect()->route('admin.page_management', ['tab' => 'sect-hero'])->with('success', 'Slide Hero berhasil dihapus.');
    }
}

