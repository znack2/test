<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Url\UrlInterface;
use App\Repositories\Url\UrlRepository;

class RepositoriesServiceProvider extends ServiceProvider {

    /**
     * Register bindings with IoC container
     */
    public function register()
    {
        $this->app->bind(
            'UrlInterface',
            'UrlRepository'
        );     
    }

}
