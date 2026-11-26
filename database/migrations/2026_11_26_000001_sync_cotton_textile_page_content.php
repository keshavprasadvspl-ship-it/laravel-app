<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $cottonPath = resource_path('views/pages/partials/cotton_textile_content.html');
        if (file_exists($cottonPath)) {
            $content = file_get_contents($cottonPath);
            DB::table('pages')
                ->where('slug', 'cotton-textile')
                ->update(['content' => $content]);
        }
    }

    public function down(): void
    {
        // Non-destructive
    }
};
