<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

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
            'name'                 => 'required|max:200',
            'service_category_id'  => 'nullable|exists:service_categories,id',
            'slug'          => 'nullable|max:200|regex:/^[a-z0-9\-]*$/',
            'short_desc'    => 'nullable|max:500',
            'description'   => 'nullable',
            'price'          => 'nullable|numeric|min:0',
            'rating'         => 'nullable|numeric|min:0|max:5',
            'sold_count'     => 'nullable|string|max:100',
            'shopee_link'    => 'nullable|url|max:1000',
            'tokopedia_link' => 'nullable|url|max:1000',
            'tiktok_link'    => 'nullable|url|max:1000',
            'icon'          => 'nullable|max:50',
            'order'         => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
            'meta_title'    => 'nullable|max:70',
            'meta_desc'     => 'nullable|max:165',
            'meta_keywords' => 'nullable|max:500',
            'image'         => 'nullable|image|max:5120',
            'brochure'      => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            'og_image'      => 'nullable|image|max:5120',
            'gallery_images.*' => 'nullable|image|max:5120',
            'spec_keys'     => 'nullable|array',
            'spec_keys.*'   => 'nullable|string|max:255',
            'spec_values'   => 'nullable|array',
            'spec_values.*' => 'nullable|string|max:1000',
            'faq_qs'        => 'nullable|array',
            'faq_qs.*'      => 'nullable|string|max:500',
            'faq_as'        => 'nullable|array',
            'faq_as.*'      => 'nullable|string|max:2000',
        ]);

        // Slug
        $slug = Str::slug(!empty($v['slug']) ? $v['slug'] : $v['name']);
        $base = $slug; $i = 1;
        while (Service::where('slug', $slug)->exists()) { $slug = $base.'-'.$i++; }
        $v['slug'] = $slug;

        $v['is_active'] = $request->boolean('is_active', true);
        $v['order']     = $v['order'] ?? 0;

        if (empty($v['meta_title'])) $v['meta_title'] = $v['name'].' | '.\App\Models\Setting::get('company_name', config('app.name'));
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

        if ($request->hasFile('brochure')) {
            $v['brochure'] = $request->file('brochure')->store('brochures', 'public');
        }

        $gallery = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $gallery[] = $this->storeWebP($file, 'services/gallery', 1200, 800);
            }
        }
        $v['gallery'] = $gallery;

        // Process Specs
        $specs = [];
        $specKeys = $request->input('spec_keys', []);
        $specValues = $request->input('spec_values', []);
        foreach ($specKeys as $idx => $key) {
            if (!empty($key) && isset($specValues[$idx])) {
                $specs[] = ['key' => $key, 'value' => $specValues[$idx]];
            }
        }
        $v['specifications'] = $specs;

        // Process FAQs
        $faqs = [];
        $faqQs = $request->input('faq_qs', []);
        $faqAs = $request->input('faq_as', []);
        foreach ($faqQs as $idx => $q) {
            if (!empty($q) && isset($faqAs[$idx])) {
                $faqs[] = ['q' => $q, 'a' => $faqAs[$idx]];
            }
        }
        $v['faqs'] = $faqs;

        Service::create($v);
        Cache::forget('home_page_data');
        Cache::forget('services_page_data');
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service) { return view('admin.services.edit', compact('service')); }

    public function update(Request $request, Service $service)
    {
        $v = $request->validate([
            'name'                 => 'required|max:200',
            'service_category_id'  => 'nullable|exists:service_categories,id',
            'slug'          => 'nullable|max:200|regex:/^[a-z0-9\-]*$/',
            'short_desc'    => 'nullable|max:500',
            'description'   => 'nullable',
            'price'          => 'nullable|numeric|min:0',
            'rating'         => 'nullable|numeric|min:0|max:5',
            'sold_count'     => 'nullable|string|max:100',
            'shopee_link'    => 'nullable|url|max:1000',
            'tokopedia_link' => 'nullable|url|max:1000',
            'tiktok_link'    => 'nullable|url|max:1000',
            'icon'          => 'nullable|max:50',
            'order'         => 'nullable|integer|min:0',
            'is_active'     => 'boolean',
            'meta_title'    => 'nullable|max:70',
            'meta_desc'     => 'nullable|max:165',
            'meta_keywords' => 'nullable|max:500',
            'image'         => 'nullable|image|max:5120',
            'brochure'      => 'nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            'og_image'      => 'nullable|image|max:5120',
            'gallery_images.*' => 'nullable|image|max:5120',
            'spec_keys'     => 'nullable|array',
            'spec_keys.*'   => 'nullable|string|max:255',
            'spec_values'   => 'nullable|array',
            'spec_values.*' => 'nullable|string|max:1000',
            'faq_qs'        => 'nullable|array',
            'faq_qs.*'      => 'nullable|string|max:500',
            'faq_as'        => 'nullable|array',
            'faq_as.*'      => 'nullable|string|max:2000',
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

        if ($request->hasFile('brochure')) {
            $this->deleteStorageFile($service->brochure);
            $v['brochure'] = $request->file('brochure')->store('brochures', 'public');
        }

        $gallery = is_array($service->gallery) ? $service->gallery : [];
        if ($request->has('delete_gallery')) {
            foreach ($request->input('delete_gallery') as $delImg) {
                $this->deleteStorageFile($delImg);
                if (($key = array_search($delImg, $gallery)) !== false) {
                    unset($gallery[$key]);
                }
            }
            $gallery = array_values($gallery);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $gallery[] = $this->storeWebP($file, 'services/gallery', 1200, 800);
            }
        }
        $v['gallery'] = $gallery;

        // Process Specs
        $specs = [];
        $specKeys = $request->input('spec_keys', []);
        $specValues = $request->input('spec_values', []);
        foreach ($specKeys as $idx => $key) {
            if (!empty($key) && isset($specValues[$idx])) {
                $specs[] = ['key' => $key, 'value' => $specValues[$idx]];
            }
        }
        $v['specifications'] = $specs;

        // Process FAQs
        $faqs = [];
        $faqQs = $request->input('faq_qs', []);
        $faqAs = $request->input('faq_as', []);
        foreach ($faqQs as $idx => $q) {
            if (!empty($q) && isset($faqAs[$idx])) {
                $faqs[] = ['q' => $q, 'a' => $faqAs[$idx]];
            }
        }
        $v['faqs'] = $faqs;

        $service->update($v);
        Cache::forget('home_page_data');
        Cache::forget('services_page_data');
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $this->deleteStorageFile($service->image);
        $this->deleteStorageFile($service->brochure);
        $this->deleteStorageFile($service->og_image);
        if (is_array($service->gallery)) {
            foreach ($service->gallery as $img) {
                $this->deleteStorageFile($img);
            }
        }
        $service->delete();
        Cache::forget('home_page_data');
        Cache::forget('services_page_data');
        return back()->with('success', 'Layanan berhasil dihapus.');
    }

        /* ─────────────────────────────────────────
     | CSV IMPORT & TEMPLATE (Enhanced with Category & Product Fields)
     ───────────────────────────────────────── */
    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|max:5120',
        ]);

        $file    = $request->file('csv_file');
        $path    = $file->getRealPath();

        // Deteksi delimiter: koma (,) atau titik-koma (;) Excel Indonesia
        $sampleLine = '';
        $fDetect = fopen($path, 'r');
        if ($fDetect) {
            $sampleLine = fgets($fDetect) ?: '';
            fclose($fDetect);
        }
        $delimiter = (substr_count($sampleLine, ';') > substr_count($sampleLine, ',')) ? ';' : ',';

        $handle  = fopen($path, 'r');
        $headers = null;
        $imported = 0;
        $skipped  = 0;
        $errors   = [];
        $order    = Service::max('order') ?? 0;

        while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
            // First row = headers
            if (!$headers) {
                // Strip UTF-8 BOM jika ada
                if (isset($row[0])) {
                    $row[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row[0]);
                }
                $headers = array_map(function($h) {
                    return strtolower(trim($h));
                }, $row);
                continue;
            }

            if (empty(array_filter($row))) {
                continue; // baris kosong
            }

            // Pastikan jumlah kolom cocok
            if (count($headers) > count($row)) {
                $row = array_pad($row, count($headers), '');
            } elseif (count($row) > count($headers)) {
                $row = array_slice($row, 0, count($headers));
            }

            $data = array_combine($headers, $row);

            // Name is required
            $name = trim($data['name'] ?? $data['nama'] ?? $data['nama_produk'] ?? '');
            if (empty($name)) { 
                $skipped++; 
                continue; 
            }

            // Category matching / auto-create
            $categoryName = trim($data['category'] ?? $data['kategori'] ?? $data['kategori_produk'] ?? $data['category_name'] ?? '');
            $categoryId   = null;

            if (!empty($categoryName)) {
                $cat = ServiceCategory::whereRaw('LOWER(name) = ?', [strtolower($categoryName)])
                    ->orWhere('slug', Str::slug($categoryName))
                    ->first();

                if (!$cat) {
                    $cat = ServiceCategory::create([
                        'name'       => $categoryName,
                        'slug'       => Str::slug($categoryName),
                        'meta_title' => $categoryName . ' - ' . config('app.name'),
                    ]);
                }
                $categoryId = $cat->id;
            }

            // Parse Harga (Price)
            $rawPrice = trim($data['price'] ?? $data['harga'] ?? $data['harga_produk'] ?? '');
            $price = null;
            if (!empty($rawPrice)) {
                $cleanPrice = preg_replace('/[^0-9]/', '', $rawPrice);
                if (is_numeric($cleanPrice)) {
                    $price = (float) $cleanPrice;
                }
            }

            // Parse Rating & Sold Count
            $rawRating = trim($data['rating'] ?? '');
            $rating = 5.0;
            if (!empty($rawRating)) {
                $parsedR = (float) str_replace(',', '.', $rawRating);
                if ($parsedR > 0) $rating = min(5.0, $parsedR);
            }

            $rawSold = trim($data['sold_count'] ?? $data['terjual'] ?? '');
            $soldCount = (!empty($rawSold) && is_numeric($rawSold)) ? (int) $rawSold : null;

            // Marketplace links
            $shopeeLink    = trim($data['shopee_link'] ?? $data['shopee'] ?? '');
            $tokopediaLink = trim($data['tokopedia_link'] ?? $data['tokopedia'] ?? '');
            $tiktokLink    = trim($data['tiktok_link'] ?? $data['tiktok'] ?? '');

            // Generate / clean slug
            $slug = !empty($data['slug']) ? Str::slug(trim($data['slug'])) : Str::slug($name);
            $base = $slug; 
            $i = 1;
            while (Service::where('slug', $slug)->exists()) { 
                $slug = $base . '-' . $i++; 
            }

            // Parse Specs (format: Key1:Value1|Key2:Value2 atau dipisah baris)
            $specs = [];
            $rawSpecs = trim($data['specs'] ?? $data['spesifikasi'] ?? '');
            if (!empty($rawSpecs)) {
                $pairs = preg_split('/[|\r\n]+/', $rawSpecs);
                foreach ($pairs as $pair) {
                    $pair = trim($pair);
                    if (!$pair) continue;
                    $kv = explode(':', $pair, 2);
                    if (count($kv) === 2) {
                        $specs[] = ['key' => trim($kv[0]), 'value' => trim($kv[1])];
                    }
                }
            }

            // Parse FAQs (format: Q1:A1|Q2:A2)
            $faqs = [];
            $rawFaqs = trim($data['faqs'] ?? $data['faq'] ?? '');
            if (!empty($rawFaqs)) {
                $pairs = preg_split('/[|\r\n]+/', $rawFaqs);
                foreach ($pairs as $pair) {
                    $pair = trim($pair);
                    if (!$pair) continue;
                    $kv = explode(':', $pair, 2);
                    if (count($kv) === 2) {
                        $faqs[] = ['q' => trim($kv[0]), 'a' => trim($kv[1])];
                    }
                }
            }

            $shortDesc = trim($data['short_desc'] ?? $data['deskripsi_singkat'] ?? '');
            $desc      = trim($data['description'] ?? $data['deskripsi'] ?? '');

            try {
                Service::create([
                    'service_category_id' => $categoryId,
                    'name'                => $name,
                    'slug'                => $slug,
                    'short_desc'          => $shortDesc,
                    'description'         => $desc,
                    'price'               => $price,
                    'rating'              => $rating,
                    'sold_count'          => $soldCount,
                    'shopee_link'         => $shopeeLink ?: null,
                    'tokopedia_link'      => $tokopediaLink ?: null,
                    'tiktok_link'         => $tiktokLink ?: null,
                    'order'               => is_numeric($data['order'] ?? '') ? (int)$data['order'] : ++$order,
                    'is_active'           => true,
                    'meta_title'          => trim($data['meta_title'] ?? '') ?: $name,
                    'meta_desc'           => trim($data['meta_desc'] ?? '') ?: $shortDesc,
                    'meta_keywords'       => trim($data['meta_keywords'] ?? ''),
                    'gallery'             => [],
                    'specifications'      => $specs,
                    'faqs'                => $faqs,
                ]);
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Baris '$name': " . $e->getMessage();
            }
        }
        fclose($handle);

        Cache::forget('home_page_data');
        Cache::forget('services_page_data');
        Cache::forget('sitemap_xml_content');

        $msg = "Import selesai: $imported produk/layanan berhasil ditambahkan";
        if ($skipped) $msg .= ", $skipped baris dilewati (nama kosong)";
        if ($errors)  $msg .= ". Error: " . implode(' | ', array_slice($errors, 0, 5));

        return redirect()->route('admin.services.index')->with('success', $msg);
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="template-produk-layanan.csv"',
        ];

        $columns = [
            'name',
            'category',
            'price',
            'short_desc',
            'description',
            'rating',
            'sold_count',
            'shopee_link',
            'tokopedia_link',
            'tiktok_link',
            'specs',
            'faqs',
            'order',
            'meta_title',
            'meta_desc',
            'meta_keywords',
        ];

        $callback = function () use ($columns) {
            $h = fopen('php://output', 'w');
            // BOM for Excel UTF-8 agar huruf dan tanda baca terbaca rapi
            fprintf($h, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($h, $columns);

            // 3 baris contoh produk keramik riil
            fputcsv($h, [
                'Piring Keramik Makan Polos 9 Inch',
                'Piring Keramik',
                '25000',
                'Piring makan keramik putih polos standar hotel & resto',
                'Piring makan keramik berkualitas tinggi dengan glasur halus, tahan microwave dan dishwasher safe.',
                '4.9',
                '250',
                'https://shopee.co.id/pusatpiringkeramik',
                'https://tokopedia.com/pusatpiringkeramik',
                '',
                'Material:Keramik Porselen SNI|Diameter:23 cm (9 inch)|Warna:Putih Glossy|Microwave Safe:Ya',
                'Apakah bisa beli grosir?:Bisa, tersedia harga khusus pembelian di atas 50 pcs|Apakah aman kirim luar kota?:Sangat aman dengan packing bubble tebal dan peti kayu',
                '1',
                'Piring Keramik Makan Polos 9 Inch Grosir',
                'Jual piring makan keramik polos 9 inch kualitas terbaik untuk resto dan hotel.',
                'piring keramik, piring makan keramik, piring hotel'
            ]);

            fputcsv($h, [
                'Mangkok Keramik Sup Ramen 7 Inch',
                'Mangkok Keramik',
                '32000',
                'Mangkok keramik tebal untuk sup, ramen, dan bakso',
                'Mangkok keramik tahan panas dengan desain elegan cocok untuk usaha kuliner maupun sajian rumah tangga.',
                '5.0',
                '180',
                '',
                '',
                '',
                'Material:Stoneware Keramik|Kapasitas:800 ml|Diameter:18 cm|Tinggi:8 cm',
                'Apakah bisa custom logo sablon?:Bisa, silakan hubungi tim kami via WhatsApp',
                '2',
                'Mangkok Keramik Sup Ramen 7 Inch',
                'Mangkok keramik sup ramen tebal dan tahan panas.',
                'mangkok keramik, mangkok ramen, mangkok sup'
            ]);

            fputcsv($h, [
                'Mug Keramik Kopi Cangkir Souvenir',
                'Mug & Cangkir',
                '18000',
                'Mug keramik 300ml untuk kopi dan souvenir pernikahan / event',
                'Mug keramik polos siap cetak sablon decal custom kualitas premium dan tahan cuci berkali-kali.',
                '4.8',
                '500',
                '',
                '',
                '',
                'Material:Porcelain Keramik|Volume:330 ml (11 oz)|Warna:Putih Polos',
                'Minimal order untuk sablon berapa pcs?:Minimal order cetak custom 50 pcs',
                '3',
                'Mug Keramik Kopi Cangkir Souvenir Custom',
                'Mug keramik polos dan custom souvenir untuk kantor atau pernikahan.',
                'mug keramik, cangkir souvenir, souvenir keramik'
            ]);

            fclose($h);
        };

        return response()->stream($callback, 200, $headers);
    }
}
