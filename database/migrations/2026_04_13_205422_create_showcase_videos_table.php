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
        Schema::create('showcase_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->string('position')->nullable();
            $table->string('youtube_url');
            $table->string('video_id'); // Extracted ID for thumbnails
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showcase_videos');
    }
};
