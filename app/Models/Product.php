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
        return $this->categories->first();
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->image_url && file_exists(public_path($this->image_url))) {
            return asset($this->image_url);
        }
        if ($this->image_url && file_exists(public_path(ltrim($this->image_url, '/')))) {
            return asset(ltrim($this->image_url, '/'));
        }
        return asset('uploads/woocommerce-placeholder-120x120.png');
    }
}
