<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $map = [
            'cotton-textile' => 'cotton_textile_content.html',
            'polyester-fabric' => 'polyester_fabric_content.html',
            'acrylic-fibre' => 'acrylic_fibre_content.html',
            'nylon' => 'nylon_content.html',
            'wool' => 'wool_content.html',
            'silk' => 'silk_content.html',
            'plastic-polymers' => 'plastic_polymers_content.html',
            'paper-pulp' => 'paper_pulp_content.html',
            'leather' => 'leather_content.html',
            'petroleum-lubricants' => 'petroleum_lubricants_content.html',
            'printing-inks' => 'printing_inks_content.html',
            'wood-stains' => 'wood_stains_content.html',
            'smoke-dyes' => 'smoke_dyes_content.html',
            'glass' => 'glass_content.html',
            'intermediates' => 'intermediates_content.html',
        ];

        foreach ($map as $slug => $file) {
            $path = resource_path('views/pages/partials/' . $file);
            if (file_exists($path)) {
                $content = file_get_contents($path);
                DB::table('pages')->where('slug', $slug)->update(['content' => $content]);
            }
        }
    }

    public function down(): void
    {
        // Non-destructive
    }
};
