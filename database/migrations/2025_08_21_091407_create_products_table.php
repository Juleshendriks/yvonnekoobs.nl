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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Basis product informatie
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();

            // Pricing
            $table->decimal('price', 8, 2)->default(0.00); // 0.00 = gratis
            $table->decimal('original_price', 8, 2)->nullable(); // Voor kortingen
            $table->boolean('is_free')->default(false);

            // Media
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable(); // Array van afbeeldingen
            $table->string('file_path')->nullable(); // Pad naar downloadbaar bestand
            $table->string('file_name')->nullable(); // Originele bestandsnaam
            $table->bigInteger('file_size')->nullable(); // In bytes
            $table->string('file_type')->nullable(); // PDF, ZIP, etc.

            // Categorisatie
            $table->string('category')->nullable();
            $table->json('tags')->nullable(); // Array van tags

            // Status en zichtbaarheid
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();

            // Download settings
            $table->integer('download_limit')->nullable(); // Max downloads per user (null = unlimited)
            $table->integer('download_expiry_days')->nullable(); // Dagen geldig na aankoop

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Ordering
            $table->integer('sort_order')->default(0);

            // Stats
            $table->integer('download_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('purchase_count')->default(0);

            $table->timestamps();

            // Indexes
            $table->index(['is_active', 'published_at']);
            $table->index(['is_featured', 'sort_order']);
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
