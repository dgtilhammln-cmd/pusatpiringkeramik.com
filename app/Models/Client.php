<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Client extends Model
{
    protected $fillable = ['name', 'logo', 'alt_text', 'city', 'industry', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('name');
    }

    public function getLogoUrlAttribute(): string
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : null;
    }

    public function getAutoAltAttribute(): string
    {
        $companyName = Setting::get('company_name') ?: 'Pusat Piring Keramik';
        if (!empty($this->alt_text)) {
            if (str_contains(strtolower($this->alt_text), 'customer')) {
                return $this->alt_text;
            }
            return "{$this->alt_text} customer {$companyName}";
        }
        return "{$this->name} customer {$companyName}";
    }
}
