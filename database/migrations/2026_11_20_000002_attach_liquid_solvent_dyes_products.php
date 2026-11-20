<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $liquid = Category::where('slug', 'liquid-solvent-dyes')->first();
        $solventDyes = Category::where('slug', 'solvent-dyes')->first();

        $slugs = [
            'solvent-blue-79',
            'solvent-blue-98',
            'solvent-green-33',
            'solvent-orange-98',
            'solvent-red-164',
            'solvent-red-19e',
            'solvent-yellow-107',
            'solvent-yellow-124',
            'solvent-yellow-175',
        ];

        $productIds = Product::whereIn('slug', $slugs)->pluck('id')->toArray();

        if ($liquid && !empty($productIds)) {
            $liquid->products()->syncWithoutDetaching($productIds);
            if (empty($liquid->image_url)) {
                $liquid->image_url = '/uploads/2026/04/solvent-dyes-e1775805465464.jpg';
                $liquid->save();
            }
        }

        if ($solventDyes && !empty($productIds)) {
            $solventDyes->products()->syncWithoutDetaching($productIds);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $liquid = Category::where('slug', 'liquid-solvent-dyes')->first();
        if ($liquid) {
            $slugs = [
                'solvent-blue-79',
                'solvent-blue-98',
                'solvent-green-33',
                'solvent-orange-98',
                'solvent-red-164',
                'solvent-red-19e',
                'solvent-yellow-107',
                'solvent-yellow-124',
                'solvent-yellow-175',
            ];
            $productIds = Product::whereIn('slug', $slugs)->pluck('id')->toArray();
            $liquid->products()->detach($productIds);
        }
    }
};
