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
        Schema::create('academy_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // U10, U13, etc.
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('training_schedule')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academy_programs');
    }
};
