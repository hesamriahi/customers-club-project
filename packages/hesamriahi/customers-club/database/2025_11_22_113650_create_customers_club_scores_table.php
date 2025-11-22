<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hesamriahi\CustomersClub\Models\CustomersClubMission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers_club_scores', function (Blueprint $table) {
            $table->id();

            $table->morphs('client');
            $table->foreignId('mission_id')->constrained(CustomersClubMission::class);

            $table->integer('score');
            $table->integer('bon');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_club_scores');
    }
};
