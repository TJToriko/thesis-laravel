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
        Schema::create('deceaseds', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->enum('suffix', ['Jr.', 'Sr.', 'I', 'II', 'III', 'IV'])->nullable();
            $table->date('born');
            $table->date('died');
            $table->string('age');
            $table->string('sex');
            $table->string('certificate_image')->nullable();
            $table->foreignId('lot_id')->constrained('lots')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deceaseds');
    }
};
