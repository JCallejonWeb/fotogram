<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormatTimeServiceProvider extends ServiceProvider
{

    public function register()
    {
        require_once app_path() . '/Helpers/FormatTime.php';
    }

  
    public function boot()
    {
        
    }
}
