<?php

namespace CountryStateCity;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/2021_04_28_121647_create_timezones_table.php' => database_path('migrations/2021_04_28_121647_create_timezones_table.php'),
            __DIR__ . '/database/migrations/2021_04_28_115030_create_countries_table.php' => database_path('migrations/2021_04_28_115030_create_countries_table.php'),
            __DIR__ . '/database/migrations/2021_04_28_140621_create_country_timezones_table.php' => database_path('migrations/2021_04_28_140621_create_country_timezones_table.php'),
            __DIR__ . '/database/migrations/2021_04_28_115040_create_states_table.php' => database_path('migrations/2021_04_28_115040_create_states_table.php'),
            __DIR__ . '/database/migrations/2021_04_28_115058_create_cities_table.php' => database_path('migrations/2021_04_28_115058_create_cities_table.php'),
        ], 'countrystatecity-migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InitCommand::class,
            ]);
        }
    }

    public function register()
    {
        //
    }
}
