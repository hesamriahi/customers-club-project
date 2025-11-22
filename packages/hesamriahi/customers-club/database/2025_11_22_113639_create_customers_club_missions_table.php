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
        Schema::create('customers_club_missions', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('key')->unique();
            $table->integer('bon_value');
            $table->integer('score_value');
            $table->boolean('is_active');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_club_missions');
    }
};
