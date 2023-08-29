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
        Schema::create('doctor_work_times', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time')->format('H:i:s');
            $table->enum('status', ['set', 'not set'])->default('not set');
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['date', 'time','id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_work_times');
    }
};
