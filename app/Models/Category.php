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
