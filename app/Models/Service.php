<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class Service extends Model
{
    protected $fillable = [
        'service_category_id', 'name', 'slug', 'short_desc', 'description', 'image', 'brochure', 'og_image', 'gallery',
        'specifications', 'faqs',
        'price', 'rating', 'sold_count', 'shopee_link', 'tokopedia_link', 'tiktok_link',
        'icon', 'order', 'is_active',
        'meta_title', 'meta_desc', 'meta_keywords',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'order'          => 'integer',
        'price'          => 'float',
        'rating'         => 'float',
        'gallery'        => 'array',
        'specifications' => 'array',
        'faqs'           => 'array',
    ];

    public function getFormattedPriceAttribute(): ?string
    {
        return $this->price !== null && $this->price > 0 
            ? 'Rp ' . number_format($this->price, 0, ',', '.') 
            : null;
    }

    public function getFormattedRatingAttribute(): ?string
    {
        return $this->rating !== null && $this->rating > 0 
            ? number_format($this->rating, 1) 
            : null;
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
        static::saved(function () {
            Cache::forget('sitemap_xml_content');
        });
        static::deleted(function () {
            Cache::forget('sitemap_xml_content');
        });
    }

    public function scopeActive(Builder $query): Builder { return $query->where('is_active', true); }
    public function scopeOrdered(Builder $query): Builder { return $query->orderBy('order')->orderBy('id'); }

    public function getImageUrlAttribute(): string
    {
        // 1. Product has its own image
        if ($this->image) {
            return asset('storage/'.$this->image);
        }
        // 2. Fallback to category image
        if ($this->category && $this->category->image) {
            return asset('storage/'.$this->category->image);
        }
        // 3. Return brand-based SVG placeholder URL
        $name = strtolower($this->name ?? '');
        if (str_contains($name, 'cap gunung'))  return asset('images/brand-cap-gunung.svg');
        if (str_contains($name, 'kaibon'))      return asset('images/brand-kaibon.svg');
        if (str_contains($name, 'toyoki'))      return asset('images/brand-toyoki.svg');
        return asset('images/brand-default.svg');
    }
    public function getAltTextAttribute($v): string
    {
        $comp = \App\Models\Setting::get('company_name', config('app.name'));
        return $v ?: $this->name . ' - ' . $comp;
    }
    public function getOgImageUrlAttribute(): string
    {
        return $this->og_image ? asset('storage/'.$this->og_image) : $this->image_url;
    }
    public function getGalleryUrlsAttribute(): array
    {
        $urls = [];
        if (is_array($this->gallery)) {
            foreach ($this->gallery as $img) {
                $urls[] = asset('storage/' . $img);
            }
        }
        return $urls;
    }
    public function getMetaTitleAttribute($v): string
    {
        return $v ?: $this->name . ' | ' . \App\Models\Setting::get('company_name', config('app.name'));
    }
    public function getMetaDescAttribute($v): string
    {
        return $v ?: Str::limit(strip_tags($this->short_desc ?? $this->description ?? ''), 155);
    }
    public function getUrlAttribute(): string
    {
        return route('products.show', $this->slug);
    }
}
