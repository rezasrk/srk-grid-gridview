<?php

namespace SrkGrid\GridView;

use Illuminate\Support\ServiceProvider;

class SrkGridViewProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('srkgridview.php'),
        ], 'config');
    }

    public function register()
    {
        //
    }
}