<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Page extends Model
{
    protected $guarded = [];

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function getUrlAttribute(): string
    {
        $slug = $this->slug;
        if (str_starts_with($slug, 'dyes-supplier-in-')) {
            return url('/dyes/' . $slug . '/');
        } elseif (str_starts_with($slug, 'pigments-supplier-in-')) {
            return url('/pigments/' . $slug . '/');
        } elseif (str_starts_with($slug, 'f-d-c-colours-supplier-in-')) {
            return url('/f-d-c-colours/' . $slug . '/');
        } elseif (str_starts_with($slug, 'naphthols-fast-bases-fast-salts-supplier-in-')) {
            return url('/naphthols-fast-bases-fast-salts/' . $slug . '/');
        } elseif (str_starts_with($slug, 'intermediates-supplier-in-')) {
            return url('/intermediates/' . $slug . '/');
        }
        return url('/' . $slug . '/');
    }
}
