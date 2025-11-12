<?php
// create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Totalen
            $table->decimal('subtotal', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('currency', 3)->default('EUR');

            // Status
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');

            // Klantinfo (backup)
            $table->string('customer_email');
            $table->string('customer_name');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
