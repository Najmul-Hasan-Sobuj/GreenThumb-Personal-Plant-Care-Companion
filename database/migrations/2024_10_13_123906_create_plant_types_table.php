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
        Schema::create('plant_types', function (Blueprint $table) {
            $table->id();
            $table->string('scientific_name');
            $table->string('common_name')->nullable();
            $table->enum('care_difficulty', ['Easy', 'Moderate', 'Difficult']);
            $table->text('light_requirements');
            $table->text('water_requirements');
            $table->string('temperature_range', 50);
            $table->text('humidity_requirements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_types');
    }
};
