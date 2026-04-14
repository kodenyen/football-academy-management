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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('heading_font')->default('Inter');
            $table->string('body_font')->default('Inter');
            $table->string('hero_heading_size')->default('text-5xl md:text-8xl');
            $table->string('hero_subheading_size')->default('text-lg md:text-xl');
            $table->string('section_heading_size')->default('text-4xl md:text-6xl');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['heading_font', 'body_font', 'hero_heading_size', 'hero_subheading_size', 'section_heading_size']);
        });
    }
};
