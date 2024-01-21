<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $files = glob(app_path('Helpers') . "/*.php");
        foreach ($files as $key => $file) {
            require_once $file;
        }
        // require_once "app/Helpers/Helper.php";
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
