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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->default('profile.png');
            $table->enum('gender',['male','female'])->default('male');
            $table->string('credit_card_number');
            $table->integer('age');
            $table->integer('height');
            $table->integer('weight');
            $table->enum('active_status',['Idle','Slack','Active sometimes','Very active']);
            $table->integer('calories')->nullable();
            $table->string('verfication_code')->nullable();
            $table->dateTime('expire_at')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
