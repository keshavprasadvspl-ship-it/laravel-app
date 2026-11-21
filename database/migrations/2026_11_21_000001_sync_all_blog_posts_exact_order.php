<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

return new class extends Migration
{
    public function up(): void
    {
        $postsOrder = array (
  0 => 
  array (
    'slug' => 'acid-dyes-for-silk-wool-and-nylon',
    'wp_id' => 13933,
    'created_at' => '2026-10-27 10:00:00',
  ),
  1 => 
  array (
    'slug' => 'acid-dyes-vs-reactive-dyes',
    'wp_id' => 13928,
    'created_at' => '2026-10-27 09:00:00',
  ),
  2 => 
  array (
    'slug' => 'disperse-dyes-vs-reactive-dyes',
    'wp_id' => 13925,
    'created_at' => '2026-10-27 08:00:00',
  ),
  3 => 
  array (
    'slug' => 'types-of-disperse-dyes-and-their-uses',
    'wp_id' => 13921,
    'created_at' => '2026-10-27 07:00:00',
  ),
  4 => 
  array (
    'slug' => 'different-types-of-vat-dyes-and-their-uses',
    'wp_id' => 13917,
    'created_at' => '2026-10-27 06:00:00',
  ),
  5 => 
  array (
    'slug' => 'what-is-a-vat-dyed-pool-towel',
    'wp_id' => 13914,
    'created_at' => '2026-10-27 05:00:00',
  ),
  6 => 
  array (
    'slug' => 'is-eosin-an-acidic-dye',
    'wp_id' => 13911,
    'created_at' => '2026-10-27 04:00:00',
  ),
  7 => 
  array (
    'slug' => 'why-do-acidic-dyes-leave-bacterial-cells-unstained',
    'wp_id' => 13908,
    'created_at' => '2026-10-27 03:00:00',
  ),
  8 => 
  array (
    'slug' => 'reactive-dyes',
    'wp_id' => 13902,
    'created_at' => '2026-10-27 02:00:00',
  ),
  9 => 
  array (
    'slug' => 'what-is-reactive-dye-and-its-process',
    'wp_id' => 13898,
    'created_at' => '2026-10-27 01:00:00',
  ),
  10 => 
  array (
    'slug' => 'best-applications-of-direct-dyes-for-paper-industry',
    'wp_id' => 13892,
    'created_at' => '2026-10-27 00:00:00',
  ),
  11 => 
  array (
    'slug' => 'how-much-does-direct-dye-typically-cost',
    'wp_id' => 13889,
    'created_at' => '2026-10-26 23:00:00',
  ),
  12 => 
  array (
    'slug' => 'which-vat-dye-and-often-used-in-dyeing-jeans',
    'wp_id' => 13885,
    'created_at' => '2026-10-26 22:00:00',
  ),
  13 => 
  array (
    'slug' => 'ice-dyeing-with-acid-dye-on-wool-and-silk',
    'wp_id' => 13881,
    'created_at' => '2026-10-26 21:00:00',
  ),
  14 => 
  array (
    'slug' => 'why-is-oxidation-done-after-dyeing-with-vat-dye',
    'wp_id' => 13877,
    'created_at' => '2026-10-26 20:00:00',
  ),
  15 => 
  array (
    'slug' => 'is-indigo-similar-to-vat-dye',
    'wp_id' => 13872,
    'created_at' => '2026-10-26 19:00:00',
  ),
  16 => 
  array (
    'slug' => 'what-foods-contain-carmoisine-colour',
    'wp_id' => 13869,
    'created_at' => '2026-10-26 18:00:00',
  ),
  17 => 
  array (
    'slug' => 'which-dye-is-banned-in-the-textile-industry',
    'wp_id' => 13866,
    'created_at' => '2026-10-26 17:00:00',
  ),
  18 => 
  array (
    'slug' => 'is-carmoisine-a-natural-or-synthetic-dye',
    'wp_id' => 13863,
    'created_at' => '2026-10-26 16:00:00',
  ),
  19 => 
  array (
    'slug' => 'is-carmoisine-color-safe-to-use',
    'wp_id' => 13859,
    'created_at' => '2026-10-26 15:00:00',
  ),
  20 => 
  array (
    'slug' => 'what-is-direct-dyes',
    'wp_id' => 13829,
    'created_at' => '2026-10-26 14:00:00',
  ),
  21 => 
  array (
    'slug' => 'what-are-natural-dyes',
    'wp_id' => 13826,
    'created_at' => '2026-10-26 13:00:00',
  ),
  22 => 
  array (
    'slug' => 'what-are-metal-complex-solvent-dyes-and-their-uses',
    'wp_id' => 13823,
    'created_at' => '2026-10-26 12:00:00',
  ),
  23 => 
  array (
    'slug' => 'what-is-liquid-solvent-dyes',
    'wp_id' => 13820,
    'created_at' => '2026-10-26 11:00:00',
  ),
  24 => 
  array (
    'slug' => 'what-are-anthraquinone-dyes-and-its-example',
    'wp_id' => 13817,
    'created_at' => '2026-10-26 10:00:00',
  ),
  25 => 
  array (
    'slug' => 'solvent-dyes-vs-oil-based-paint-which-is-the-best-to-use',
    'wp_id' => 13812,
    'created_at' => '2026-10-26 09:00:00',
  ),
  26 => 
  array (
    'slug' => 'what-is-the-difference-between-loading-dye-and-tracking-dye',
    'wp_id' => 13809,
    'created_at' => '2026-10-26 08:00:00',
  ),
  27 => 
  array (
    'slug' => 'can-solvent-dyes-improve-the-appearance-of-stainless-steel',
    'wp_id' => 13806,
    'created_at' => '2026-10-26 07:00:00',
  ),
  28 => 
  array (
    'slug' => 'what-are-liquid-solvent-dyes-and-how-do-they-work',
    'wp_id' => 13803,
    'created_at' => '2026-10-26 06:00:00',
  ),
  29 => 
  array (
    'slug' => '7-top-leading-exporters-of-solvent-dyes-in-mumbai',
    'wp_id' => 13790,
    'created_at' => '2026-10-26 05:00:00',
  ),
  30 => 
  array (
    'slug' => 'what-is-the-role-of-solvents-in-the-chemical-dye-industry',
    'wp_id' => 13787,
    'created_at' => '2026-10-26 04:00:00',
  ),
  31 => 
  array (
    'slug' => 'why-indigo-remains-one-of-the-most-fascinating-vat-dyes',
    'wp_id' => 13784,
    'created_at' => '2026-10-26 03:00:00',
  ),
  32 => 
  array (
    'slug' => '10-essential-chemicals-used-in-vat-dyeing-cotton-fabrics',
    'wp_id' => 13781,
    'created_at' => '2026-10-26 02:00:00',
  ),
  33 => 
  array (
    'slug' => '10-best-vat-dyes-manufacturers-and-suppliers-in-croatia',
    'wp_id' => 13773,
    'created_at' => '2026-10-26 01:00:00',
  ),
  34 => 
  array (
    'slug' => 'top-10-vat-dyes-manufacturers-and-suppliers-in-bulgaria',
    'wp_id' => 13770,
    'created_at' => '2026-10-26 00:00:00',
  ),
  35 => 
  array (
    'slug' => '10-best-vat-dyes-manufacturers-in-belgium',
    'wp_id' => 13767,
    'created_at' => '2026-10-25 23:00:00',
  ),
  36 => 
  array (
    'slug' => 'top-10-vat-dyes-manufacturers-in-austria',
    'wp_id' => 13764,
    'created_at' => '2026-10-25 22:00:00',
  ),
  37 => 
  array (
    'slug' => 'top-10-disperse-dyes-manufacturers-in-vapi',
    'wp_id' => 13761,
    'created_at' => '2026-10-25 21:00:00',
  ),
  38 => 
  array (
    'slug' => 'top-10-disperse-dyes-manufacturers-in-ahmedabad',
    'wp_id' => 13758,
    'created_at' => '2026-10-25 20:00:00',
  ),
  39 => 
  array (
    'slug' => 'top-10-disperse-dyes-manufacturers-in-surat',
    'wp_id' => 13756,
    'created_at' => '2026-10-25 19:00:00',
  ),
  40 => 
  array (
    'slug' => 'top-10-disperse-dyes-manufacturers-in-gujarat',
    'wp_id' => 13750,
    'created_at' => '2026-10-25 18:00:00',
  ),
  41 => 
  array (
    'slug' => 'the-characteristics-of-disperse-dyes',
    'wp_id' => 13746,
    'created_at' => '2026-10-25 17:00:00',
  ),
  42 => 
  array (
    'slug' => 'difference-between-sulphur-and-vat-dyes',
    'wp_id' => 13741,
    'created_at' => '2026-10-25 16:00:00',
  ),
  43 => 
  array (
    'slug' => 'what-is-the-solubilised-vat-dyes',
    'wp_id' => 13738,
    'created_at' => '2026-10-25 15:00:00',
  ),
  44 => 
  array (
    'slug' => 'top-10-vat-dyes-manufacturers-in-ahmedabad-vat-dyes-suppliers-exporters',
    'wp_id' => 13735,
    'created_at' => '2026-10-25 14:00:00',
  ),
  45 => 
  array (
    'slug' => 'vat-dye-have-good-fastness-property',
    'wp_id' => 13730,
    'created_at' => '2026-10-25 13:00:00',
  ),
  46 => 
  array (
    'slug' => 'uses-of-disperse-dyes-in-various-industries',
    'wp_id' => 13726,
    'created_at' => '2026-10-25 12:00:00',
  ),
  47 => 
  array (
    'slug' => 'what-are-the-classification-of-disperse-dyes-in-textile',
    'wp_id' => 13723,
    'created_at' => '2026-10-25 11:00:00',
  ),
  48 => 
  array (
    'slug' => '10-essential-facts-about-using-vat-dyes-on-cotton-fabrics',
    'wp_id' => 13720,
    'created_at' => '2026-10-25 10:00:00',
  ),
  49 => 
  array (
    'slug' => 'mordant-vs-vat-dyes-whats-the-difference',
    'wp_id' => 13714,
    'created_at' => '2026-10-25 09:00:00',
  ),
  50 => 
  array (
    'slug' => '10-applications-of-solvent-dye-in-smoke-bombs',
    'wp_id' => 13694,
    'created_at' => '2026-10-25 08:00:00',
  ),
  51 => 
  array (
    'slug' => 'why-solvent-dyes-are-the-future-of-plastic-coloring',
    'wp_id' => 13690,
    'created_at' => '2026-10-25 07:00:00',
  ),
  52 => 
  array (
    'slug' => '7-benefits-of-using-solvent-dyes-on-metal-surfaces',
    'wp_id' => 13687,
    'created_at' => '2026-10-25 06:00:00',
  ),
  53 => 
  array (
    'slug' => 'which-compounds-are-used-in-vat-dyeing',
    'wp_id' => 13684,
    'created_at' => '2026-10-25 05:00:00',
  ),
  54 => 
  array (
    'slug' => 'do-vat-dyes-have-good-fastness-property',
    'wp_id' => 13681,
    'created_at' => '2026-10-25 04:00:00',
  ),
  55 => 
  array (
    'slug' => 'top-10-disperse-dyes-manufacturers-in-india',
    'wp_id' => 13677,
    'created_at' => '2026-10-25 03:00:00',
  ),
  56 => 
  array (
    'slug' => 'difference-between-acid-dye-and-basic-dye-acid-dyes-manufacturers',
    'wp_id' => 13668,
    'created_at' => '2026-10-25 02:00:00',
  ),
  57 => 
  array (
    'slug' => 'acid-dye-and-how-to-use-acid-dyes-manufacturers-suppliers-exporters',
    'wp_id' => 13665,
    'created_at' => '2026-10-25 02:00:00',
  ),
  58 => 
  array (
    'slug' => 'buy-disperse-dyes-trusted-disperse-dyes-manufacturer-suppliers-exporters',
    'wp_id' => 13662,
    'created_at' => '2026-10-25 01:00:00',
  ),
  59 => 
  array (
    'slug' => 'disperse-dyes-used-for-polyester-fiber',
    'wp_id' => 13656,
    'created_at' => '2026-10-25 00:00:00',
  ),
  60 => 
  array (
    'slug' => 'differences-between-direct-dye-and-acid-dye',
    'wp_id' => 13651,
    'created_at' => '2026-10-24 23:00:00',
  ),
  61 => 
  array (
    'slug' => 'common-dyes-are-used-in-dyes',
    'wp_id' => 13647,
    'created_at' => '2026-10-24 22:00:00',
  ),
  62 => 
  array (
    'slug' => 'how-to-select-a-good-pigment-and-solvent-dyes-supplier',
    'wp_id' => 13643,
    'created_at' => '2026-10-24 21:00:00',
  ),
  63 => 
  array (
    'slug' => 'inovative-uses-of-vat-dyes-in-high-performances-textiles',
    'wp_id' => 13640,
    'created_at' => '2026-10-24 20:00:00',
  ),
  64 => 
  array (
    'slug' => 'vat-dyes-better-than-reactive-dyes',
    'wp_id' => 13635,
    'created_at' => '2026-10-24 19:00:00',
  ),
  65 => 
  array (
    'slug' => 'how-sublimation-disperse-dyes-are-different-from-normal-dyes',
    'wp_id' => 13630,
    'created_at' => '2026-10-24 18:00:00',
  ),
  66 => 
  array (
    'slug' => 'what-is-disperse-dye-and-its-application',
    'wp_id' => 13626,
    'created_at' => '2026-10-24 17:00:00',
  ),
  67 => 
  array (
    'slug' => 'what-is-vat-dye-in-textile',
    'wp_id' => 13623,
    'created_at' => '2026-10-24 16:00:00',
  ),
  68 => 
  array (
    'slug' => 'top-10-solvent-dyes-manufacturers-in-india',
    'wp_id' => 13619,
    'created_at' => '2026-10-24 15:00:00',
  ),
  69 => 
  array (
    'slug' => 'top-10-vat-dyes-manufacturers-in-india',
    'wp_id' => 13616,
    'created_at' => '2026-10-24 14:00:00',
  ),
  70 => 
  array (
    'slug' => 'solvent-dye-for-smoke-bombs-application-and-color-selection',
    'wp_id' => 13609,
    'created_at' => '2026-10-24 13:00:00',
  ),
  71 => 
  array (
    'slug' => 'what-is-solvent-dye-its-applications',
    'wp_id' => 13606,
    'created_at' => '2026-10-24 12:00:00',
  ),
  72 => 
  array (
    'slug' => 'advantages-and-disadvantages-of-vat-dyes',
    'wp_id' => 13601,
    'created_at' => '2026-10-24 11:00:00',
  ),
  73 => 
  array (
    'slug' => 'what-is-vat-dyeing-and-its-process',
    'wp_id' => 13596,
    'created_at' => '2026-10-24 10:00:00',
  ),
);

        foreach ($postsOrder as $item) {
            Post::where('slug', $item['slug'])
                ->orWhere('wp_id', $item['wp_id'])
                ->update([
                    'wp_id' => $item['wp_id'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['created_at'],
                ]);
        }
    }

    public function down(): void
    {
    }
};
