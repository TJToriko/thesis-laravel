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
        Schema::create('paymenttrackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments');
            $table->date('date')->nullable();
            $table->date('due_date');
            $table->enum('payment_status', ['Pending', 'Paid', 'Overdue']);
            $table->decimal('price_monthly', 10, 2);
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->string('customer_id');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymenttrackers');
    }
};
