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
        Schema::create('care_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plant_id')->constrained()->onDelete('cascade');
            $table->enum('care_type', ['Watering', 'Fertilizing', 'Pruning', 'Repotting']);
            $table->integer('frequency');
            $table->enum('frequency_unit', ['Days', 'Weeks', 'Months']);
            $table->date('last_performed_date')->nullable();
            $table->date('next_due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('care_schedules');
    }
};
