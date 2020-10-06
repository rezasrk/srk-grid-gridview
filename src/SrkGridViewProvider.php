<?php

namespace SrkGrid\GridView;

use Illuminate\Support\ServiceProvider;
use SrkGrid\GridView\Core\CommandCreateGridClass;

class SrkGridViewProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands(CommandCreateGridClass::class);

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('srkgridview.php'),
        ], 'config');
    }

    public function register()
    {
        //
    }
}
