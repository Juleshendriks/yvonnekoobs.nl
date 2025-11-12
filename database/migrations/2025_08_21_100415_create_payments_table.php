<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            // Mollie
            $table->string('mollie_payment_id')->unique();
            $table->string('mollie_checkout_url')->nullable();
            $table->enum('status', ['open', 'paid', 'failed', 'cancelled', 'expired'])->default('open');
            $table->string('method')->nullable(); // ideal, creditcard

            // Bedrag
            $table->decimal('amount', 8, 2);
            $table->string('currency', 3)->default('EUR');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
