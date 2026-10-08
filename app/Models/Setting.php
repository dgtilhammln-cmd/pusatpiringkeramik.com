<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group', 'label'];

    /**
     * Get setting value by key — cache only the raw VALUE string, not the model
     */
    public static function get(string $key, $default = null): mixed
    {
        // Use a sentinel so we can distinguish between "not found" and null
        $sentinel = '__NOT_FOUND__';

        $value = Cache::remember("setting_v_{$key}", 7200, function () use ($key, $sentinel) {
            $row = static::where('key', $key)->value('value');
            return $row ?? $sentinel;
        });

        return ($value === $sentinel) ? $default : $value;
    }

    /**
     * Get App Name with fallback to company_name
     */
    public static function getAppName(): string
    {
        $appName = static::get('app_name');
        if (!empty(trim($appName))) {
            return trim($appName);
        }
        return trim(static::get('company_name', config('app.name', 'Pusat Piring Keramik')));
    }

    /**
     * Get App URL with fallback to config('app.url')
     */
    public static function getAppUrl(): string
    {
        $appUrl = static::get('app_url');
        if (!empty(trim($appUrl))) {
            return rtrim(trim($appUrl), '/');
        }
        return rtrim(config('app.url', 'https://pusatpiringkeramik.hvmdigital.id'), '/');
    }

    /**
     * Set (upsert) a setting value
     */
    public static function set(string $key, $value, string $type = 'text', string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
        Cache::forget("setting_v_{$key}");
        Cache::forget('all_settings_v2');
    }

    /**
     * Get all settings as flat key=>value array — cache only primitives
     */
    public static function getAllAsArray(): array
    {
        return Cache::remember('all_settings_v2', 7200, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache(): void
    {
        Cache::flush();
    }
}
