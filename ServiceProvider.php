<?php

namespace KSPEdu\Countries;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
    }

    public function register()
    {
        //
    }
}
