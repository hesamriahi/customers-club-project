<?php

namespace Hesamriahi\CustomersClub;

use Illuminate\Support\ServiceProvider;
use Hesamriahi\CustomersClub\Commands\AddNewMission;

class CustomersClubServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('customers-club.php'),
        ], 'customers-club-config');
        $this->publishes([
            __DIR__ . '/database/migrations' => database_path('migrations'),
        ], 'customers-club-migrations');

        $this->commands([
            AddNewMission::class,
        ]);
    }
}
