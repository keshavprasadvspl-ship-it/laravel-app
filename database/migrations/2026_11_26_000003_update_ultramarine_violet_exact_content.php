<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $shortDesc = <<<'HTML'
<p><strong>Ultra Marine voilet (Pigments Voilet 15)</strong> <span style="font-size: 16px;">produced by SD International, are synthetic inorganic pigments renowned for their deep violet hue. These pigments are widely utilized in a range of industries, including paints, coatings, plastics, and printing inks.</span></p>
<p>SD International’s Ultramarine Violet Pigment Violet 15 typically consists of a complex chemical composition, which may include various organic compounds designed to achieve the desired color intensity, stability, and dispersion characteristics. Similar to other ultramarine pigments, Ultramarine Violet Pigment Violet 15 offers excellent lightfastness, ensuring resistance to fading when exposed to light over extended periods. Additionally, these pigments often possess good chemical resistance and stability, making them suitable for diverse applications across different environments and conditions. Due to their intense violet color, Ultramarine Violet Pigment Violet 15 is frequently employed in the formulation of various products where vibrant and long-lasting violet shades are desired. Their versatility and durability make them a favored choice among manufacturers aiming to achieve distinct violet hues in their products.</p>
<p><strong>IDENTIFICATION:</strong></p>
<p>ULTRAMARINE VIOLETS are Sodium Aluminum Sulpho-silicates. <img src="https://sdinternational.com/wp-content/uploads/2024/05/Screenshot-2024-06-30-194502.png" class="alignnone size-full wp-image-13447" alt="Ultramarine Violet Identification" width="720" height="108" /></p>
<p><strong>GENERAL SPECIFICATIONS:</strong></p>
<p><img src="https://sdinternational.com/wp-content/uploads/2024/05/Screenshot-2024-06-30-193638.png" class="alignnone size-full wp-image-13445" alt="Ultramarine Violet General Specifications" width="881" height="117" /></p>
<p><strong>TECHNICAL SPECIFICATIONS:</strong></p>
<p><img src="https://sdinternational.com/wp-content/uploads/2024/05/Screenshot-2024-06-30-215821.png" class="alignnone size-full wp-image-13452" alt="Ultramarine Violet Technical Specifications" width="780" height="268" /></p>
<p><strong style="font-size: 16px;">APPLICATIONS:</strong></p>
<p>ULTRAFINE Ultramarine Violets have, generally, the same wide variety of applications as the Ultramarine Blues</p>
<p><img src="https://sdinternational.com/wp-content/uploads/2024/05/Screenshot-2024-06-30-201828.png" class="alignnone size-full wp-image-13451" alt="Ultramarine Violet Applications" width="888" height="314" /></p>
HTML;

        DB::table('products')->where('slug', 'ultra-marine-voilet')->update([
            'short_description' => $shortDesc,
        ]);
    }

    public function down(): void
    {
    }
};
