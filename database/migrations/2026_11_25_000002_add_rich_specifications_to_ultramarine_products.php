<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $voiletContent = <<<HTML
<h2>Ultra Marine voilet</h2>
<p>Ultra Marine voilet (Pigment Violet 15) belongs to the category of high performance inorganic synthetic pigments having CAS number 12769-96-9. The colour index number is Pigment Violet 15 / 77007. The molecular formula is Na<sub>6-10</sub>Al<sub>6</sub>Si<sub>6</sub>O<sub>24</sub>S<sub>2-4</sub>. Ultra Marine voilet offers exceptional thermal stability, outstanding lightfastness, and high resistance to organic solvents, making it the premier choice for vibrant reddish-violet coloration across demanding industrial processes.</p>

<h3>Ultra Marine voilet Identification</h3>
<p>ULTRAMARINE VIOLETS are Sodium Aluminum Sulpho-silicates produced through high-temperature calcination to deliver stable, high-intensity color.</p>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Specification</th>
</tr>
</thead>
<tbody>
<tr><td>Chemical Description</td><td>Sodium Aluminum Sulpho-silicate</td></tr>
<tr><td>C.I. Name</td><td>Pigment Violet 15</td></tr>
<tr><td>C.I. Number</td><td>77007</td></tr>
<tr><td>CAS Number</td><td>12769-96-9</td></tr>
<tr><td>EINECS Number</td><td>235-811-0</td></tr>
<tr><td>Chemical Formula</td><td>Na<sub>6-10</sub>Al<sub>6</sub>Si<sub>6</sub>O<sub>24</sub>S<sub>2-4</sub></td></tr>
</tbody>
</table>

<h3>General Specifications of Ultra Marine voilet</h3>
<table>
<thead>
<tr>
<th>Property</th>
<th>Value / Limit</th>
</tr>
</thead>
<tbody>
<tr><td>Physical Appearance</td><td>Fine Deep Violet Powder</td></tr>
<tr><td>Specific Gravity</td><td>2.30 &ndash; 2.35 g/cm&sup3;</td></tr>
<tr><td>Bulk Density</td><td>0.60 &ndash; 0.75 g/cm&sup3;</td></tr>
<tr><td>Oil Absorption</td><td>30 &ndash; 45 g/100g</td></tr>
<tr><td>Moisture Content</td><td>1.0% max</td></tr>
<tr><td>Water Soluble Matter</td><td>1.0% max</td></tr>
<tr><td>pH of Aqueous Extract</td><td>7.0 &ndash; 8.5</td></tr>
<tr><td>Sieve Residue (325 Mesh / 45 &micro;m)</td><td>0.1% max</td></tr>
</tbody>
</table>

<h3>Technical Specifications &amp; Fastness Properties</h3>
<table>
<thead>
<tr>
<th>Test Parameter</th>
<th>Rating / Result</th>
</tr>
</thead>
<tbody>
<tr><td>Heat Resistance</td><td>Up to 300&deg;C (Excellent)</td></tr>
<tr><td>Light Fastness (Full Shade)</td><td>7 &ndash; 8 (1-8 Scale: 8 is Outstanding)</td></tr>
<tr><td>Light Fastness (Reduced Shade 1:10)</td><td>7 &ndash; 8 (Excellent)</td></tr>
<tr><td>Alkali Resistance (5% NaOH)</td><td>4 &ndash; 5 (5 is Excellent)</td></tr>
<tr><td>Acid Resistance (5% HCl)</td><td>1 &ndash; 2 (Standard for Ultramarine)</td></tr>
<tr><td>Solvent Resistance</td><td>5 (Insoluble in organic solvents)</td></tr>
<tr><td>Migration Resistance in Plastics</td><td>5 (No migration / blooming)</td></tr>
</tbody>
</table>

<h3>Applications of Ultra Marine voilet</h3>
<p>ULTRAFINE Ultramarine Violets have a wide variety of industrial and commercial applications similar to Ultramarine Blues:</p>
<ul>
<li><strong>Plastics &amp; Masterbatches:</strong> Highly recommended for Polyolefins (LDPE, LLDPE, HDPE, PP), Polystyrene (PS, HIPS), Engineering Thermoplastics (ABS, SAN, PET, PBT, Polyamides/Nylon), and Rigid PVC where high processing temperatures require superior heat stability.</li>
<li><strong>Printing Inks:</strong> Widely utilized in gravure, flexographic, screen, and offset printing inks, providing sharp reddish-violet shades without bleeding into solvent systems.</li>
<li><strong>Paints &amp; Industrial Coatings:</strong> Suitable for powder coatings, automotive finishes, coil coatings, industrial baking enamels, and architectural emulsions.</li>
<li><strong>Cosmetics &amp; Personal Care:</strong> Non-toxic and skin-friendly colorant compliant for cosmetic formulations, eye shadows, soaps, and body washes.</li>
<li><strong>Detergents &amp; Optical Brightening:</strong> Used as an effective bluing/violeting agent to eliminate yellowish undertones in detergents, soaps, and laundry powders.</li>
<li><strong>Rubber &amp; EVA:</strong> Outstanding dispersibility in natural and synthetic rubbers, footwear soles, and EVA foam compounds without affecting vulcanization.</li>
</ul>

<h3>Ultra Marine voilet Latest Price</h3>
<table>
<tbody>
<tr>
<td>Ultra Marine voilet latest price:</td>
<td>NA*</td>
</tr>
</tbody>
</table>
<p><strong><em>*Prices shown above are provisional prices and may change due to different market conditions for latest prices please Contact Us at +91 99206 69561 or send enquiry through the Enquiry Form to get the final price within hours.</em></strong></p>

<h4>Specifications of Ultra Marine voilet</h4>
<p>Ultra Marine voilet Technical Parameters / Specifications, please <img class="alignnone wp-image-11703" src="/wp-content/uploads/2020/09/download.jpg" alt="" width="170" height="52" /></p>
<p><em><strong>Note: Looking for something specific? Customisation is also available with above products. Please specify in the Enquire now page.</strong></em></p>
HTML;

        $blueContent = <<<HTML
<h2>Ultra Marine Blue</h2>
<p>Ultra Marine Blue (Pigment Blue 29) is a synthetic inorganic sodium aluminum silicate pigment widely recognized as one of the most brilliant and clean reddish-blue colorants in the world. It provides exceptional light fastness, heat resistance up to 300&deg;C, excellent weather stability, and complete non-toxicity.</p>

<h3>Features &amp; Key Benefits of Ultra Marine Blue</h3>
<ul>
<li><strong>Skin Friendly &amp; Non-Toxic:</strong> Compliant with international safety norms; hypoallergenic and safe for cosmetics, soaps, and laundry detergents.</li>
<li><strong>Smooth and Soft on Fabrics:</strong> Imparts bright whitening effect and optical correction without harsh chemical degradation of textiles.</li>
<li><strong>Affordable &amp; Cost-Effective:</strong> Superior tinting power ensures cost efficiency at low dosage percentages.</li>
<li><strong>Great and Even Coloring:</strong> Uniform micronized particle size ensures quick dispersion without specking or agglomeration.</li>
<li><strong>Leaves No Blotchy Marks:</strong> Completely dispersible across polymer melts, water bases, and liquid formulations.</li>
<li><strong>Extra Brightness:</strong> Neutralizes yellowish tint in plastics, fibers, papers, and coatings to yield pure white appearance.</li>
</ul>

<h3>Ultra Marine Blue Specifications &amp; Technical Parameters</h3>
<table>
<thead>
<tr>
<th>Property</th>
<th>Value / Limit</th>
</tr>
</thead>
<tbody>
<tr><td>Chemical Classification</td><td>Sodium Aluminum Silicate with Polysulfide (Pigment Blue 29)</td></tr>
<tr><td>C.I. Number</td><td>77007</td></tr>
<tr><td>CAS Number</td><td>57455-37-5 / 101357-30-6</td></tr>
<tr><td>EINECS Number</td><td>309-928-3</td></tr>
<tr><td>Physical Appearance</td><td>Ultra-fine Intense Blue Powder</td></tr>
<tr><td>Specific Gravity</td><td>2.35 g/cm&sup3;</td></tr>
<tr><td>Heat Resistance</td><td>300&deg;C (Stable during polymer extrusion and injection moulding)</td></tr>
<tr><td>Light Fastness (Full Shade)</td><td>7 &ndash; 8 (1-8 Scale: 8 is Maximum)</td></tr>
<tr><td>Alkali Resistance</td><td>5 (Excellent in cement, detergents, and alkaline media)</td></tr>
<tr><td>Acid Resistance</td><td>1 &ndash; 2 (Standard for Ultramarine)</td></tr>
<tr><td>Moisture Content</td><td>1.0% max</td></tr>
<tr><td>Water Soluble Matter</td><td>1.0% max</td></tr>
</tbody>
</table>

<h3>Packaging &amp; Available Sizes</h3>
<p>The standard packaging sizes for Ultra Marine Blue include:</p>
<ul>
<li><strong>Retail / Small Pouches:</strong> 4 Gms, 10 Gms, 100 Gms pouches</li>
<li><strong>Boxes / Intermediate Packs:</strong> 50 Gms, 100 Gms, 200 Gms cartons</li>
<li><strong>Bulk Industrial Packaging:</strong> 25 kg HDPE woven bags with inner poly-liner, and 500 kg jumbo bags</li>
</ul>
<p><strong>Note:</strong> The information provided above is for general guidelines only and subject to change without prior notice.</p>

<h3>Applications of Ultra Marine Blue</h3>
<ul>
<li><strong>Plastics &amp; Masterbatches:</strong> Polyethylene (PE), Polypropylene (PP), PVC, Polystyrene, and Engineering plastics for optical whitening and deep blue coloration.</li>
<li><strong>Laundry &amp; Detergents:</strong> Bluing agent in laundry soaps, powders, and bar detergents to impart brilliant whiteness to cottons and synthetic linens.</li>
<li><strong>Paints &amp; Industrial Coatings:</strong> Architectural paints, decorative enamels, artists' colours, and powder coatings.</li>
<li><strong>Printing Inks:</strong> Flexographic, screen, gravure, and water-based inks.</li>
<li><strong>Cosmetics &amp; Personal Care:</strong> Eye makeup, mineral cosmetics, toilet soaps, and bath salts.</li>
<li><strong>Paper &amp; Pulp:</strong> Optical tinting to brighten fine writing and printing paper grades.</li>
</ul>

<h3>Ultra Marine Blue Latest Price</h3>
<table>
<tbody>
<tr>
<td>Ultra Marine Blue latest price:</td>
<td>NA*</td>
</tr>
</tbody>
</table>
<p><strong><em>*Prices shown above are provisional prices and may change due to different market conditions for latest prices please Contact Us at +91 99206 69561 or send enquiry through the Enquiry Form to get the final price within hours.</em></strong></p>

<h4>Specifications of Ultra Marine Blue</h4>
<p>Ultra Marine Blue Technical Parameters / Specifications, please <img class="alignnone wp-image-11703" src="/wp-content/uploads/2020/09/download.jpg" alt="" width="170" height="52" /></p>
<p><em><strong>Note: Looking for something specific? Customisation is also available with above products. Please specify in the Enquire now page.</strong></em></p>
HTML;

        DB::table('products')
            ->where('slug', 'ultra-marine-voilet')
            ->update([
                'content' => $voiletContent,
            ]);

        DB::table('products')
            ->where('slug', 'ultra-marine-blue')
            ->update([
                'content' => $blueContent,
            ]);
    }

    public function down(): void
    {
        // Non-destructive
    }
};
