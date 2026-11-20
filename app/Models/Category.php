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
        // 1. Explicit image_url or image on model
        $img = $this->image_url ?: $this->image;
        if ($img) {
            $trimmed = ltrim($img, '/');
            if (file_exists(public_path($trimmed))) {
                return asset($trimmed);
            }
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                return $img;
            }
            return 'https://sdinternational.com/wp-content/' . $trimmed;
        }

        // 2. other-products banner
        if ($this->slug === 'other-products' || $this->slug === 'other_products') {
            if (file_exists(public_path('uploads/2022/05/other-product.jpg'))) {
                return asset('uploads/2022/05/other-product.jpg');
            }
            return 'https://sdinternational.com/wp-content/uploads/2022/05/other-product.jpg';
        }

        // liquid-solvent-dyes banner
        if ($this->slug === 'liquid-solvent-dyes') {
            if (file_exists(public_path('uploads/2026/04/solvent-dyes-e1775805465464.jpg'))) {
                return asset('uploads/2026/04/solvent-dyes-e1775805465464.jpg');
            }
            return 'https://sdinternational.com/wp-content/uploads/2026/04/solvent-dyes-e1775805465464.jpg';
        }

        // 3. Local slug path
        $slugPath = 'uploads/2022/04/' . $this->slug . '.jpg';
        if (file_exists(public_path($slugPath))) {
            return asset($slugPath);
        }

        // 4. Parent category image
        if ($this->parent) {
            $parentSlug = $this->parent->slug;
            if ($parentSlug === 'other-products' || $parentSlug === 'other_products') {
                if (file_exists(public_path('uploads/2022/05/other-product.jpg'))) {
                    return asset('uploads/2022/05/other-product.jpg');
                }
                return 'https://sdinternational.com/wp-content/uploads/2022/05/other-product.jpg';
            }
            $parentPath = 'uploads/2022/04/' . $parentSlug . '.jpg';
            if (file_exists(public_path($parentPath))) {
                return asset($parentPath);
            }
        }

        // 5. If local dyes.jpg exists
        if (file_exists(public_path('uploads/2022/04/dyes.jpg'))) {
            return asset('uploads/2022/04/dyes.jpg');
        }

        // 6. Live site fallback
        return "https://sdinternational.com/wp-content/uploads/2022/04/{$this->slug}.jpg";
    }

    public function getThumbnailUrlAttribute(): string
    {
        $thumbPath = 'uploads/2022/04/' . $this->slug . '-120x120.jpg';
        if (file_exists(public_path($thumbPath))) {
            return asset($thumbPath);
        }

        // If full image exists locally, return it
        $slugPath = 'uploads/2022/04/' . $this->slug . '.jpg';
        if (file_exists(public_path($slugPath))) {
            return asset($slugPath);
        }

        // Live site CDN fallback
        return "https://sdinternational.com/wp-content/uploads/2022/04/{$this->slug}-120x120.jpg";
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
