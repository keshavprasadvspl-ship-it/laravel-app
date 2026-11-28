<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $saltsDesc = <<<'HTML'
<div class="row">
<div class="col-md-5"></div>
<div class="col-md-7">SD International is one of the leading suppliers, and exporter of Fast Colour Salts. SD International offers Fast Colour Salts well known for using superior purity chemicals from trusted vendors to meet International Industry standards. S D International is one of the leading Fast Colour Salts exporters and suppliers of high grade and superior quality chemical products in India to an industry-wide customer base.</div>
</div>
<h2>Fast Colour Salts Supplier</h2>
<p>Fast Colour Salts are extensively used in combination with Naphthols for Textile Dyeing &amp; Printing. As Fast Colour Salts are stabilized with metal, they are easily soluble in water. There is no need of using Sodium Nitrate, Hydro-Chloride Acid. Fast Bases &#8211; Salts are highly sensitive to heat and moisture and need to be always stored in cool dry place. Being freely soluble in water, it is used in the dyeing process in two stages. The first stage involves material getting impregnated with naphthol solution. In the second stage, further development takes place with the use of a diazotized fast base.</p>
<p>Combining chemically with naphthol, it gets absorbed by fiber thus providing insoluble dye on fiber. These can be used in different dyeing methods including tub-dip, open beck, jigger, circulating liquor and padding methods where different material to liquor ratio is used in different dyestuff concentrations for achieving defined shades. These dyes are skin friendly and easy to apply.</p>
<h3>Applications of Fast Colour Salts</h3>
<p><span style="font-weight: 400">Fast Colour Salts find wide use in the textile industry in processes involving wax print and African print. Finding wide usage in textile, plastic, chemical and pharmaceutical industry, these when dyeing with naphthols offer economical usage. Further, these are also used in achieving blue, maroon, yellow colour shades that are not possible with other dyestuff. These dyes possess superior colour fastness properties.</span></p>
<p><strong>These colour bases are widely used in:</strong></p>
<ul>
<li style="font-weight: 400"><span style="font-weight: 400">Textile</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Chemical</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Pharmaceutical</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Plastic</span></li>
</ul>
</div>
HTML;

        DB::table('categories')->where('slug', 'fast-colour-salts')->update(['description' => $saltsDesc]);

        $basesDesc = <<<'HTML'
<div class="row">
<div class="col-md-5"></div>
<div class="col-md-7">SD International is one of the leading suppliers, and exporter of Fast Colour Bases. SD International offers Fast Colour Bases well known for using superior purity chemicals from trusted vendors to meet International Industry standards. S D International is one of the leading Fast Colour Bases exporters and suppliers of high grade and superior quality chemical products in India to an industry-wide customer base.</div>
</div>
<h2>Fast Colour Bases Supplier</h2>
<p>Fast Colour Bases are extensively used in combination with Naphthols for Textile Dyeing &amp; Printing. As Fast Colour Salts are stabilized with metal, they are easily soluble in water. There is no need of using Sodium Nitrate, Hydro-Chloride Acid. Fast Bases &#8211; Salts are highly sensitive to heat and moisture and need to be always stored in cool dry place. Being freely soluble in water, it is used in the dyeing process in two stages. The first stage involves material getting impregnated with naphthol solution. In the second stage, further development takes place with the use of a diazotized fast base.</p>
<p>Combining chemically with naphthol, it gets absorbed by fiber thus providing insoluble dye on fiber. These can be used in different dyeing methods including tub-dip, open beck, jigger, circulating liquor and padding methods where different material to liquor ratio is used in different dyestuff concentrations for achieving defined shades. These dyes are skin friendly and easy to apply.</p>
<h3>Applications of Fast Colour Bases</h3>
<p><span style="font-weight: 400">Fast Colour Bases find wide use in the textile industry in processes involving wax print and African print. Finding wide usage in textile, plastic, chemical and pharmaceutical industry, these when dyeing with naphthols offer economical usage. Further, these are also used in achieving blue, maroon, yellow colour shades that are not possible with other dyestuff. These dyes possess superior colour fastness properties.</span></p>
<p><span style="font-weight: 400">These colour bases are widely used in:</span></p>
<ul>
<li style="font-weight: 400"><span style="font-weight: 400">Textile</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Chemical</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Pharmaceutical</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Plastic</span></li>
</ul>
</div>
HTML;

        DB::table('categories')->where('slug', 'fast-colour-bases')->update(['description' => $basesDesc]);

        $naphDesc = <<<'HTML'
<div class="row">
<div class="col-md-5"></div>
<div class="col-md-7">SD International is one of the leading supplier, and exporter of Napthols. SD International offers Napthols well known for using superior purity chemicals from trusted vendors to meet International Industry standards. S D International is one of the leading Napthols exporters and suppliers of high grade and superior quality chemical products in India to an industry-wide customer base.</div>
</div>
<h2>Napthols Supplier</h2>
<p>Naphthols are also known as certified colours and artificial colours, and can be used in a varied range of combinations to make nearly any colour conceivable for cosmetic products.</p>
<p><strong>Properties of Naphthols:</strong><br />
1-Naphthol, or α-naphthol, is a fluorescent organic compound with the formula C10H7OH. It is a white solid. These are highly sensitive to heat and moisture and need to be always stored in a cool dry place. Being freely soluble in water, it is used in the dyeing process in two stages. The first stage involves material getting impregnated with naphthol solution. In the second stage, further development takes place with use of a diazotized fast base. When combined chemically with naphthol, it gets absorbed by fiber thus providing insoluble dye. These can be used in different dyeing methods including tub-dip, open beck, jigger, circulating liquor and padding methods where different material to liquor ratio is used in different dyestuff concentrations for achieving defined shades. These dyes are skin friendly and easy to apply.</p>
<h3>Applications of Napthols</h3>
<p><span style="font-weight: 400">Naphthols find wide use in the textile industry in processes involving wax print and African print. Finding wide usage in textile, plastic, chemical and pharmaceutical industries, these when dyeing with naphthols offer economical usage. Further, these are also used in achieving blue, maroon, yellow colour shades that are not possible with other dyes. These dyes possess superior colour fastness properties.</span></p>
<p><strong>These colour bases are widely used in:</strong></p>
<ul>
<li style="font-weight: 400"><span style="font-weight: 400">Textile</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Chemical</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Pharmaceutical</span></li>
<li style="font-weight: 400"><span style="font-weight: 400">Plastic</span></li>
</ul>
</div>
HTML;

        DB::table('categories')->where('slug', 'naphthols')->update(['description' => $naphDesc]);
    }

    public function down(): void
    {
    }
};