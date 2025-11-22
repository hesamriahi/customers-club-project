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
        Schema::create('customers_club_levels', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->integer('min_score');
            $table->integer('max_score');
            $table->string('color_code');
            $table->string('icon_path')->nullable();
            $table->string('image_path')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_club_levels');
    }
};
