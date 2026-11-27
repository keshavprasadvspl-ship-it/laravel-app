<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $desc = <<<'HTML'
<div class="row">
<div class="col-md-5"></div>
<div class="col-md-7">SD International is one of the leading suppliers, and exporters of Organic Pigments. SD International offers Organic Pigments well known for using superior purity chemicals from trusted vendors to meet International Industry standards. S D International is one of the leading Organic Pigments exporters and suppliers of high grade and superior quality chemical products in India to an industry-wide customer base.</div>
</div>
<h2>Organic Pigments Supplier</h2>
<p><span style="font-weight: 400">Organic Pigments are chemical compounds reflecting defined wavelengths of visible light that provide in these colourful finishes. Organic Pigments work by changing colour of reflected/transmitted light due to wavelength-selective absorption and find usage for colouring of plastic, fabric, paint, ink, food, cosmetics. Organic Pigments  have properties like superior heat stability, toxicity, tinting strength, staining and dispersion. Other than this, these also have superior opacity or transparency, resistance to alkalis &amp; acids as well as for reactions between pigments. Organic Pigment Powder find extensive use in ink, plastic and crayon industry and is used for preparing of organic ingredients.</span><span style="font-weight: 400"><br/>
</span><b><br/>
Properties of Organic Pigments:</b></p>
<ul>
<li style="font-weight: 400"><span style="font-weight: 400">Do not streak or cake and provide for easy blending.</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Can be used for producing a complete range of colors.</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Can be used for producing paints and coloring material including pastels, chalks, colored pencils, enamels, acrylics, oils.</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Comprises concentrated loose color powder containing ingredients that support adherence to skin.</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">All colors are lime-proof that allow these to be mixed with any suitable binding agent.</span></li>
</ul>
<h3>Applications of Organic Pigments</h3>
<ul>
<li style="font-weight: 400"><span style="font-weight: 400">Colours: Concrete and Plastic Resins.</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Tinting wood fillers and Wood finishing.</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Shading pore filler pastes.</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Wood Putties and Epoxy Paints.</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Coloured waxes and Touch-up on furniture.</span></li>
</ul>
HTML;

        DB::table('categories')->where('slug', 'organic-pigments')->update([
            'description' => $desc,
        ]);
    }

    public function down(): void
    {
    }
};
