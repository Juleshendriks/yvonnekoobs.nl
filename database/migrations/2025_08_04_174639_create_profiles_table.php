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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('naam');
            $table->string('introduction_title');
            $table->string('introduction_description');
            $table->text('why_title')->nullable();
            $table->text('why_description')->nullable();
            $table->text('what_title')->nullable();
            $table->text('what_description')->nullable();
            $table->text('how_title')->nullable();
            $table->text('how_description')->nullable();
            $table->text('outro_message');
            $table->string('cta_image')->nullable();
            $table->string('cta_description');
            $table->string('cta_title');
            $table->string('cta_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
