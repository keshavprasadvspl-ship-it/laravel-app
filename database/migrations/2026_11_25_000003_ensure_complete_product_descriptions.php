<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ensure Ultra Marine voilet (ID 1247 / slug ultra-marine-voilet) has full unabridged text
        $voiletShortDesc = "<p><strong>Ultra Marine voilet (Pigments Voilet 15)</strong> produced by SD International, are synthetic inorganic pigments renowned for their deep violet hue. These pigments are widely utilized in a range of industries, including paints, coatings, plastics, and printing inks.</p>\n"
            . "<p>SD International's Ultramarine Violet Pigment Violet 15 typically consists of a complex chemical composition, which may include various organic compounds designed to achieve the desired color intensity, stability, and dispersion characteristics. Similar to other ultramarine pigments, Ultramarine Violet Pigment Violet 15 offers excellent lightfastness, ensuring resistance to fading when exposed to light over extended periods. Additionally, these pigments often possess good chemical resistance and stability, making them suitable for diverse applications across different environments and conditions. Due to their intense violet color, Ultramarine Violet Pigment Violet 15 is frequently employed in the formulation of various products where vibrant and long-lasting violet shades are desired. Their versatility and durability make them a favored choice among manufacturers aiming to achieve distinct violet hues in their products.</p>";

        DB::table('products')
            ->where('slug', 'ultra-marine-voilet')
            ->update([
                'short_description' => $voiletShortDesc,
            ]);

        // 2. Ensure Ultra Marine Blue (ID 1246 / slug ultra-marine-blue) has full unabridged text
        $blueShortDesc = "<p><strong>Ultra Marine Blue (Pigments blue 29)</strong> often referred to as &ldquo;pigments blue 29,&rdquo; are synthetic inorganic pigments widely used in various industries such as paints, coatings, plastics, and printing inks. These pigments are known for their vibrant blue hue, which ranges from deep blue to violet-blue, depending on the specific formulation and processing.</p>\n"
            . "<p>SD International is a company that specializes in the production and distribution of pigments, including ultramarine blue. Their ultramarine blue pigments, like those of other manufacturers, are typically composed of sodium aluminum silicate, often with additional modifiers to enhance color stability, dispersion, and other properties. Ultramarine blue pigments have excellent light fastness, meaning they resist fading when exposed to light over time. They also offer good chemical resistance and are relatively inert, making them suitable for a wide range of applications. Additionally, they are heat-stable, which allows for their use in high-temperature processes such as plastics manufacturing.</p>\n"
            . "<p>Overall, ultramarine blue pigments are valued for their intense color, versatility, and durability, making them a popular choice in many industries for achieving various shades of blue.</p>";

        DB::table('products')
            ->where('slug', 'ultra-marine-blue')
            ->update([
                'short_description' => $blueShortDesc,
            ]);
    }

    public function down(): void
    {
        // Non-destructive
    }
};
