<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Post;

return new class extends Migration
{
    public function up(): void
    {
        $slugs = [
            "acid-dyes-for-silk-wool-and-nylon",
            "acid-dyes-vs-reactive-dyes",
            "disperse-dyes-vs-reactive-dyes",
            "types-of-disperse-dyes-and-their-uses",
            "different-types-of-vat-dyes-and-their-uses",
            "what-is-a-vat-dyed-pool-towel",
            "is-eosin-an-acidic-dye",
            "why-do-acidic-dyes-leave-bacterial-cells-unstained",
            "reactive-dyes",
            "what-is-reactive-dye-and-its-process",
            "best-applications-of-direct-dyes-for-paper-industry",
            "how-much-does-direct-dye-typically-cost",
            "which-vat-dye-and-often-used-in-dyeing-jeans",
            "ice-dyeing-with-acid-dye-on-wool-and-silk",
            "why-is-oxidation-done-after-dyeing-with-vat-dye",
            "is-indigo-similar-to-vat-dye",
            "what-foods-contain-carmoisine-colour",
            "which-dye-is-banned-in-the-textile-industry",
            "is-carmoisine-a-natural-or-synthetic-dye",
            "is-carmoisine-color-safe-to-use",
            "what-is-direct-dyes",
            "what-are-natural-dyes",
            "what-are-metal-complex-solvent-dyes-and-their-uses",
            "what-is-liquid-solvent-dyes",
            "what-are-anthraquinone-dyes-and-its-example",
            "solvent-dyes-vs-oil-based-paint-which-is-the-best-to-use",
            "what-is-the-difference-between-loading-dye-and-tracking-dye",
            "can-solvent-dyes-improve-the-appearance-of-stainless-steel",
            "what-are-liquid-solvent-dyes-and-how-do-they-work",
            "7-top-leading-exporters-of-solvent-dyes-in-mumbai",
            "what-is-the-role-of-solvents-in-the-chemical-dye-industry",
            "why-indigo-remains-one-of-the-most-fascinating-vat-dyes",
            "10-essential-chemicals-used-in-vat-dyeing-cotton-fabrics",
            "10-best-vat-dyes-manufacturers-and-suppliers-in-croatia",
            "top-10-vat-dyes-manufacturers-and-suppliers-in-bulgaria",
            "10-best-vat-dyes-manufacturers-in-belgium",
            "top-10-vat-dyes-manufacturers-in-austria",
            "top-10-disperse-dyes-manufacturers-in-vapi",
            "top-10-disperse-dyes-manufacturers-in-ahmedabad",
            "top-10-disperse-dyes-manufacturers-in-surat",
            "top-10-disperse-dyes-manufacturers-in-gujarat",
            "the-characteristics-of-disperse-dyes",
            "difference-between-sulphur-and-vat-dyes",
            "what-is-the-solubilised-vat-dyes",
            "top-10-vat-dyes-manufacturers-in-ahmedabad-vat-dyes-suppliers-exporters",
            "vat-dye-have-good-fastness-property",
            "uses-of-disperse-dyes-in-various-industries",
            "what-are-the-classification-of-disperse-dyes-in-textile",
            "10-essential-facts-about-using-vat-dyes-on-cotton-fabrics",
            "mordant-vs-vat-dyes-whats-the-difference",
            "10-applications-of-solvent-dye-in-smoke-bombs",
            "why-solvent-dyes-are-the-future-of-plastic-coloring",
            "7-benefits-of-using-solvent-dyes-on-metal-surfaces",
            "which-compounds-are-used-in-vat-dyeing",
            "do-vat-dyes-have-good-fastness-property",
            "top-10-disperse-dyes-manufacturers-in-india",
            "difference-between-acid-dye-and-basic-dye-acid-dyes-manufacturers",
            "acid-dye-and-how-to-use-acid-dyes-manufacturers-suppliers-exporters",
            "buy-disperse-dyes-trusted-disperse-dyes-manufacturer-suppliers-exporters",
            "disperse-dyes-used-for-polyester-fiber",
            "differences-between-direct-dye-and-acid-dye",
            "common-dyes-are-used-in-dyes",
            "how-to-select-a-good-pigment-and-solvent-dyes-supplier",
            "inovative-uses-of-vat-dyes-in-high-performances-textiles",
            "vat-dyes-better-than-reactive-dyes",
            "how-sublimation-disperse-dyes-are-different-from-normal-dyes",
            "what-is-disperse-dye-and-its-application",
            "what-is-vat-dye-in-textile",
            "top-10-solvent-dyes-manufacturers-in-india",
            "top-10-vat-dyes-manufacturers-in-india",
            "solvent-dye-for-smoke-bombs-application-and-color-selection",
            "what-is-solvent-dye-its-applications",
            "advantages-and-disadvantages-of-vat-dyes",
            "what-is-vat-dyeing-and-its-process"
        ];

        $baseTime = strtotime('2026-11-20 12:00:00');
        foreach ($slugs as $i => $slug) {
            $timestamp = date('Y-m-d H:i:s', $baseTime - ($i * 3600));
            Post::where('slug', $slug)->update([
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }

    public function down(): void
    {
    }
};
