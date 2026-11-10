<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('company')->nullable()->after('phone');
            $table->string('country')->nullable()->after('company');
            $table->string('inquiry_type')->default('quote')->after('product_slug');
            $table->string('status')->default('new')->after('ip_address')->index();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->index();
            $table->longText('value')->nullable();
            $table->string('group')->default('general')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');

        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['company', 'country', 'inquiry_type', 'status']);
        });
    }
};
