<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        return redirect()->route('admin.page_management', ['tab' => 'sect-client']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|max:200',
            'city'      => 'nullable|max:100',
            'industry'  => 'nullable|max:100',
            'alt_text'  => 'nullable|max:200',
            'logo'      => 'nullable|image|max:4096',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $companyName = Setting::get('company_name') ?: 'Pusat Piring Keramik';
        if (empty($validated['alt_text'])) {
            $validated['alt_text'] = $validated['name'] . ' customer ' . $companyName;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeWebP($request->file('logo'), 'clients', 400, 200);
        }

        Client::create($validated);
        return redirect()->route('admin.page_management', ['tab' => 'sect-client'])
            ->with('success', 'Klien berhasil ditambahkan!')
            ->with('active_tab', 'sect-client');
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'      => 'required|max:200',
            'city'      => 'nullable|max:100',
            'industry'  => 'nullable|max:100',
            'alt_text'  => 'nullable|max:200',
            'logo'      => 'nullable|image|max:4096',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $companyName = Setting::get('company_name') ?: 'Pusat Piring Keramik';
        if (empty($validated['alt_text'])) {
            $validated['alt_text'] = $validated['name'] . ' customer ' . $companyName;
        }

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : $client->is_active;

        if ($request->hasFile('logo')) {
            if ($client->logo) {
                $this->deleteStorageFile($client->logo);
            }
            $validated['logo'] = $this->storeWebP($request->file('logo'), 'clients', 400, 200);
        }

        $client->update($validated);
        return redirect()->route('admin.page_management', ['tab' => 'sect-client'])
            ->with('success', 'Data Klien berhasil diperbarui!')
            ->with('active_tab', 'sect-client');
    }

    public function destroy(Client $client)
    {
        if ($client->logo) {
            $this->deleteStorageFile($client->logo);
        }
        $client->delete();
        return redirect()->route('admin.page_management', ['tab' => 'sect-client'])
            ->with('success', 'Klien berhasil dihapus!')
            ->with('active_tab', 'sect-client');
    }
}
