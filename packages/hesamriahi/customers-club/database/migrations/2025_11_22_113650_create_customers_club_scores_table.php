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
        Schema::connection(config('customers-club.connection_name'))->create('customers_club_scores', function (Blueprint $table) {
            $table->id();

            $table->morphs('client');
            $table->foreignId('mission_id')->constrained((new CustomersClubMission())->getTable());

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
        Schema::connection(config('customers-club.connection_name'))->dropIfExists('customers_club_scores');
    }
};
