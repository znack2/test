<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UrlHasher;

class UtilitiesServiceProvider extends ServiceProvider {
    /**
     * Register in IoC container
     */
    public function register()
    {
        $this->app->bind('App\Services\UrlShort\Default\UrlHasher', function()
        {
            return new UrlHasher(5);
        });
    }
}
