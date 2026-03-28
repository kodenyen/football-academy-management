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
        Schema::create('match_fixtures', function (Blueprint $table) {
            $table->id();
            $table->string('opponent');
            $table->string('team_category'); // U10, U13, etc.
            $table->dateTime('match_date');
            $table->string('venue');
            $table->string('status')->default('scheduled'); // scheduled, completed, postponed
            $table->integer('our_score')->nullable();
            $table->integer('opponent_score')->nullable();
            $table->text('match_summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_fixtures');
    }
};
