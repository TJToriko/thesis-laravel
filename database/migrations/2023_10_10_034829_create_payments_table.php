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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();   
            $table->decimal('total_amount_paid', 10, 2);
            $table->enum('pay_thru', ['Office', 'Collector']);
            $table->enum('status', ['Fully Paid', 'Partial', 'Cancelled']);
            $table->decimal('downpayment', 10, 2);
            $table->decimal('total_rebate_amount', 10, 2);
            $table->foreignId('lot_id')->constrained('lots');
            $table->foreignId('payment_setting_id')->constrained('payment_settings');
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
