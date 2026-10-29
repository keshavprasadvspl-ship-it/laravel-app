<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wp_term_id')->nullable()->index();
            $table->unsignedBigInteger('wp_term_taxonomy_id')->nullable()->index();
            $table->string('name');
            $table->string('slug')->index();
            $table->unsignedBigInteger('parent_id')->default(0)->index();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wp_id')->nullable()->index();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->string('brand')->default('S D International');
            $table->string('cas_number')->nullable()->index();
            $table->string('ci_number')->nullable()->index();
            $table->string('relative_name')->nullable();
            $table->string('molecular_formula')->nullable();
            $table->string('molecular_weight')->nullable();
            $table->string('physical_appearance')->nullable();
            $table->string('packaging')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('image_url')->nullable();
            $table->json('attributes_json')->nullable();
            $table->string('status')->default('publish');
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->unique(['product_id', 'category_id']);
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wp_id')->nullable()->index();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->longText('content')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wp_id')->nullable()->index();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        Schema::create('seo_metas', function (Blueprint $table) {
            $table->id();
            $table->string('seoable_type')->index();
            $table->unsignedBigInteger('seoable_id')->index();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('focus_keyword')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots')->default('index,follow');
            $table->string('og_image')->nullable();
            $table->timestamps();
            $table->unique(['seoable_type', 'seoable_id']);
        });

        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('source_pattern')->index();
            $table->string('destination_url');
            $table->integer('status_code')->default(301);
            $table->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_slug')->nullable();
            $table->text('message')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('redirects');
        Schema::dropIfExists('seo_metas');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
