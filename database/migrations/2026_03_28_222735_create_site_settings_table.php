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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('academy_name')->default('THINK RIGHT FOOTBALL ACADEMY');
            $table->string('academy_logo')->nullable();
            $table->string('primary_color')->default('#00FF41');
            $table->string('secondary_color')->default('#000000');
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->text('about_us_content')->nullable();
            $table->string('footer_text')->nullable();
            $table->json('social_links')->nullable(); // Instagram, FB, Twitter
            $table->json('navigation_menu')->nullable(); // Primary & Secondary Menu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
