<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update contact settings
        $contactSettings = [
            'phone'                => '0818-0589-0181',
            'company_phone'        => '0818-0589-0181',
            'phone_number'         => '0818-0589-0181',
            'company_whatsapp'     => '081805890181',
            'wa1'                  => '081805890181',
            'phone_international'  => '+6281805890181',
            'email'                => 'admin@pusatpiringkeramik.com',
            'contact_email'        => 'admin@pusatpiringkeramik.com',
            'address'              => 'Pusat Piring Keramik - Semarang, Jawa Tengah, Indonesia',
            'address_full'         => 'Semarang, Jawa Tengah, Indonesia',
            'address_city'         => 'Semarang',
            'address_city_name'    => 'Semarang',
            'address_province'     => 'Jawa Tengah',
            'address_province_name'=> 'Jawa Tengah',
            'seo_area_served'      => 'Semarang, Jawa Tengah, Indonesia',
            'app_url'              => 'https://pusatpiringkeramik.com',
        ];

        foreach ($contactSettings as $key => $val) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $val, 'updated_at' => now()]
            );
        }

        // 2. Replace any leftover 0856 in settings values
        $allSettings = DB::table('settings')->get();
        foreach ($allSettings as $s) {
            $val = $s->value ?? '';
            $newVal = $val;

            if (str_contains($val, '0856-2682-888') || str_contains($val, '08562682888')) {
                $newVal = str_replace(
                    ['0856-2682-888', '08562682888', '0856 2682 888'],
                    ['0818-0589-0181', '081805890181', '0818-0589-0181'],
                    $newVal
                );
            }

            if (str_contains(strtolower($newVal), 'solusi cat dan coating')) {
                $newVal = 'Solusi piring keramik dan tableware premium terpercaya untuk hotel, restoran, dan katering di Indonesia.';
            }

            if (str_contains($newVal, 'Semaran ')) {
                $newVal = str_replace('Semaran ', 'Semarang ', $newVal);
            }

            if ($s->key === 'about_c1_keywords') {
                $newVal = str_replace(['Keramik Dinding', 'Keramik Lantai'], ['Mangkok Keramik', 'Piring Keramik'], $newVal);
            }

            if ($s->key === 'product_cta1_url' && (empty(trim($newVal)) || $newVal === '/produk')) {
                $newVal = '/product';
            }

            if ($newVal !== $val) {
                DB::table('settings')->where('id', $s->id)->update(['value' => $newVal, 'updated_at' => now()]);
            }
        }

        // 3. Update wa_settings
        if (DB::getSchemaBuilder()->hasTable('wa_settings')) {
            DB::table('wa_settings')
                ->where('nomor_wa', 'like', '%0856%')
                ->update(['nomor_wa' => '081805890181', 'updated_at' => now()]);

            $primaryWa = DB::table('wa_settings')->where('is_primary', true)->first();
            if ($primaryWa) {
                DB::table('wa_settings')->where('id', $primaryWa->id)->update(['nomor_wa' => '081805890181', 'updated_at' => now()]);
            } else {
                $firstWa = DB::table('wa_settings')->first();
                if ($firstWa) {
                    DB::table('wa_settings')->where('id', $firstWa->id)->update(['nomor_wa' => '081805890181', 'is_primary' => true, 'updated_at' => now()]);
                }
            }
        }

        // 4. Clean articles content
        if (DB::getSchemaBuilder()->hasTable('articles')) {
            $articles = DB::table('articles')->get();
            foreach ($articles as $a) {
                $content = $a->content ?? '';
                $newContent = str_replace(
                    ['0856-2682-888', '08562682888', '0856 2682 888'],
                    ['0818-0589-0181', '081805890181', '0818-0589-0181'],
                    $content
                );
                $metaDesc = $a->meta_desc ?? '';
                $newMetaDesc = str_replace(
                    ['0856-2682-888', '08562682888', '0856 2682 888'],
                    ['0818-0589-0181', '081805890181', '0818-0589-0181'],
                    $metaDesc
                );

                if ($newContent !== $content || $newMetaDesc !== $metaDesc) {
                    DB::table('articles')->where('id', $a->id)->update([
                        'content'   => $newContent,
                        'meta_desc' => $newMetaDesc,
                        'updated_at'=> now(),
                    ]);
                }
            }
        }

        // 5. Clean hero_slides
        if (DB::getSchemaBuilder()->hasTable('hero_slides')) {
            $slides = DB::table('hero_slides')->get();
            foreach ($slides as $slide) {
                $tags = $slide->tags ?? '';
                $desc = $slide->description ?? '';
                $newTags = str_replace(
                    ['Keramik Lantai, Keramik Dinding, Porselen, High Quality, Food Safe'],
                    ['Piring Keramik, Mangkok, Mug Promosi, Stainless Ware, Grosir'],
                    $tags
                );
                $newDesc = str_replace(
                    'Dari keramik lantai, dinding, hingga tableware porselen — kami hadir sebagai mitra terpercaya untuk kebutuhan keramik bisnis dan hunian Anda.',
                    'Dari piring keramik, mangkok, mug promosi, hingga tableware stainless — kami hadir sebagai mitra terpercaya untuk kebutuhan tableware hotel, resto, dan katering.',
                    $desc
                );

                if ($newTags !== $tags || $newDesc !== $desc) {
                    DB::table('hero_slides')->where('id', $slide->id)->update([
                        'tags'        => $newTags,
                        'description' => $newDesc,
                        'updated_at'  => now(),
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        // No-op
    }
};
