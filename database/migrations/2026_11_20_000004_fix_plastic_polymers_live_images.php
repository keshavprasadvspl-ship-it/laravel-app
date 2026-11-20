<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $partialPath = resource_path('views/pages/partials/plastic_polymers_content.html');
        if (file_exists($partialPath)) {
            $content = file_get_contents($partialPath);
            Page::where('slug', 'plastic-polymers')->update(['content' => $content]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};
