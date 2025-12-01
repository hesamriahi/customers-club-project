<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hesamriahi\CustomersClub\Models\CustomersClubLevel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection(config('customers-club.connection_name'))->create('customers_club_score_level_clients', function (Blueprint $table) {
            $table->id();

            $table->morphs('client');
            $table->foreignId('level_id')->nullable()->constrained((new CustomersClubLevel())->getTable());
            $table->integer('sum_score')->default(0);
            $table->integer('sum_bon')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(config('customers-club.connection_name'))->dropIfExists('customers_club_score_level_clients');
    }
};
