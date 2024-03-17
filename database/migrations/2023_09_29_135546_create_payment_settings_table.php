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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lot_type_id')->constrained('lot_types');
            $table->foreignId('lot_class_id')->constrained('lot_classes')->nullable();
            $table->string('payment_name');
            $table->enum('payment_type', ['Cash', 'Installment']);
            $table->decimal('cash_full_price', 10, 2)->nullable();
            $table->decimal('installment_full_price', 10, 2)->nullable();
            $table->integer('no_year')->nullable();
            $table->decimal('installment_monthly_price', 10, 2)->nullable();
            $table->string('with_rebate')->nullable();
            $table->decimal('rebate_price', 10, 2)->nullable();
            $table->decimal('interest_price', 10, 2)->nullable();
            $table->decimal('min_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
