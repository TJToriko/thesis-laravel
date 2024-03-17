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
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('lot_no');
            $table->foreignId('lot_type_id')->constrained('lot_types');
            $table->foreignId('lot_class_id')->constrained('lot_classes')->nullable();
            $table->foreignId('customer_id')->constrained('customers')->nullable();
            $table->enum('lot_status', ['Intered', 'Available', 'Reserved', 'Unavailable']);
            $table->string('coordinates');
            $table->string('lot_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
