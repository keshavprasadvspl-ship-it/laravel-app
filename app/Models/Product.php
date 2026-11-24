<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'attributes_json' => 'array',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function getUrlAttribute(): string
    {
        return url('/' . $this->slug);
    }

    public function getPrimaryCategoryAttribute(): ?Category
    {
        $nonLocation = $this->categories->first(function ($cat) {
            $slug = $cat->slug;
            return !str_contains($slug, '-manufacturers-in-')
                && !str_contains($slug, '-suppliers-in-')
                && !str_contains($slug, '-exporters-in-')
                && !str_contains($slug, '-supplier-in-')
                && !str_contains($slug, '-manufacturer-in-');
        });

        return $nonLocation ?: $this->categories->first();
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->image_url && file_exists(public_path($this->image_url))) {
            return asset($this->image_url);
        }
        if ($this->image_url && file_exists(public_path(ltrim($this->image_url, '/')))) {
            return asset(ltrim($this->image_url, '/'));
        }
        if ($this->image_url && (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://'))) {
            return $this->image_url;
        }
        if ($this->image_url) {
            return 'https://sdinternational.com/wp-content' . (str_starts_with($this->image_url, '/') ? '' : '/') . $this->image_url;
        }
        if (file_exists(public_path('uploads/woocommerce-placeholder-120x120.png'))) {
            return asset('uploads/woocommerce-placeholder-120x120.png');
        }
        return 'https://sdinternational.com/wp-content/uploads/woocommerce-placeholder-120x120.png';
    }
}
