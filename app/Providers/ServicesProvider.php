<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\UrlShort\UrlShortInterface;
use App\Services\UrlShort\Default\UrlShorter;
use App\Services\UrlShort\Goggle\GoggleShorter;
use App\Services\UrlShort\Bitly\BitlyShorter;

class RepositoriesServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind(
             'UrlShortInterface',
             'UrlShorter'
         );           
        $this->app->bind(
             'UrlShortInterface',
             'GoogleShorter'
         );           
        $this->app->bind(
             'UrlShortInterface',
             'BitlyShorter'
         );   
    }

}
