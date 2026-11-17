<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Category extends Model
{
    protected $guarded = [];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'wp_term_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'wp_term_id');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function getUrlAttribute(): string
    {
        return url('/' . $this->slug);
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        $slugPath = 'uploads/2022/04/' . $this->slug . '.jpg';
        if (file_exists(public_path($slugPath))) {
            return asset($slugPath);
        }

        if ($this->slug === 'other-products' && file_exists(public_path('uploads/2022/05/other-product.jpg'))) {
            return asset('uploads/2022/05/other-product.jpg');
        }

        if ($this->parent && file_exists(public_path('uploads/2022/04/' . $this->parent->slug . '.jpg'))) {
            return asset('uploads/2022/04/' . $this->parent->slug . '.jpg');
        }

        return asset('uploads/2022/04/dyes.jpg');
    }

    public function getThumbnailUrlAttribute(): string
    {
        $thumbPath = 'uploads/2022/04/' . $this->slug . '-120x120.jpg';
        if (file_exists(public_path($thumbPath))) {
            return asset($thumbPath);
        }
        return $this->featured_image_url;
    }

    public static function getSidebarCategories()
    {
        return static::whereHas('products')
            ->where('name', 'not like', '%Manufacturer%')
            ->where('name', 'not like', '%Exporter%')
            ->where('name', 'not like', '%Supplier%')
            ->where('name', 'not like', '%In %')
            ->withCount('products')
            ->orderBy('name')
            ->get();
    }
}
