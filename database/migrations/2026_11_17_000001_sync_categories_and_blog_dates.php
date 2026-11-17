<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Post;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ensure Basic Green 1 is attached to Basic Dyes
        $basicDyes = Category::where('slug', 'basic-dyes')->first();
        $basicGreen1 = Product::where('slug', 'basic-green-1-diamond-green-dyes')->first();
        if ($basicDyes && $basicGreen1) {
            $basicDyes->products()->syncWithoutDetaching([$basicGreen1->id]);
        }

        // 2. Ensure Solvent Dyes category exists and has powder + liquid solvent dyes attached
        $powder = Category::where('slug', 'powder-solvent-dyes')->first();
        $liquid = Category::where('slug', 'liquid-solvent-dyes')->first();

        $solventDyes = Category::firstOrCreate(
            ['slug' => 'solvent-dyes'],
            [
                'name' => 'Solvent Dyes',
                'parent_id' => 77,
                'description' => $powder ? $powder->description : 'SD International is one of the leading supplier, and exporters of Solvent Dyes in India.',
                'image_url' => $powder ? $powder->image_url : null,
            ]
        );

        $productIds = [];
        if ($powder) {
            $productIds = array_merge($productIds, $powder->products()->pluck('products.id')->toArray());
        }
        if ($liquid) {
            $productIds = array_merge($productIds, $liquid->products()->pluck('products.id')->toArray());
        }
        if (!empty($productIds)) {
            $solventDyes->products()->syncWithoutDetaching(array_unique($productIds));
        }

        // 3. Sync authentic blog publication dates for page 1 & 2 sorting
        $dates = [
            13859 => '2026-06-29 12:43:33',
            13863 => '2026-06-29 12:50:01',
            13866 => '2026-06-29 12:56:20',
            13869 => '2026-06-29 13:01:10',
            13872 => '2026-07-22 12:44:42',
            13877 => '2026-07-23 12:49:35',
            13881 => '2026-07-23 12:55:59',
            13885 => '2026-07-23 13:01:21',
            13889 => '2026-08-20 19:27:13',
            13892 => '2026-08-20 19:32:25',
            13898 => '2026-08-21 14:04:07',
            13902 => '2026-08-21 14:10:59',
        ];

        foreach ($dates as $wpId => $realDate) {
            Post::where('wp_id', $wpId)->update([
                'created_at' => $realDate,
                'updated_at' => $realDate,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No destruct needed
    }
};
