<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coaching_types', function (Blueprint $table) {
            $table->id();

            // Basistitel en URL slug voor SEO
            $table->string('title')->index();
            $table->string('slug')->unique();

            // Korte introductie (bovenaan pagina)
            $table->string('subtitle')->nullable();
            $table->text('summary')->nullable();

            // Sectie: Uitdagingen / problemen die worden opgelost
            $table->text('challenges')->nullable();

            // Sectie: Wat je kan verwachten / aanpak
            $table->text('approach')->nullable();

            // Sectie: Voor wie is het? doelgroep
            $table->text('target_audience')->nullable();

            // Sectie: Resultaten / voordelen
            $table->text('benefits')->nullable();

            // Call to action, contact info of link naar intake
            $table->text('call_to_action')->nullable();

            // Optioneel: afbeelding banner of icoon
            $table->string('banner_image')->nullable();

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });

        // Polymorfe pivot tabel voor reviews
        Schema::create('reviewables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained()->cascadeOnDelete();
            $table->morphs('reviewable'); // reviewable_id + reviewable_type
            $table->timestamps();
        });

        // Polymorfe pivot tabel voor faqs
        Schema::create('faqables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_id')->constrained()->cascadeOnDelete();
            $table->morphs('faqable'); // faqable_id + faqable_type
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqables');
        Schema::dropIfExists('reviewables');
        Schema::dropIfExists('coaching_types');
    }
};
