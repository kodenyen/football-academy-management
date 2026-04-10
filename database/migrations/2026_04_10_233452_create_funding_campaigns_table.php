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
        Schema::create('funding_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('target_amount', 15, 2)->nullable();
            $table->decimal('current_amount', 15, 2)->default(0);
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('show_progress')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funding_campaigns');
    }
};
