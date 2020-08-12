<?php

namespace BrandStudio\Instagram;

use Illuminate\Support\ServiceProvider;
use BrandStudio\Instagram\InstagramService;
use BrandStudio\Instagram\Console\Commands\AccessToken;
use BrandStudio\Instagram\Console\Commands\RefreshToken;
use BrandStudio\Instagram\Console\Commands\ExchangeToken;
use BrandStudio\Instagram\Console\Commands\FetchData;

class InstagramServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/instagram.php', 'instagram');
        $this->loadRoutesFrom(__DIR__.'/routes/instagram.php');

        if ($this->app->runningInConsole()) {
            $this->publish();
        }

        $this->commands([
            FetchData::class,
            AccessToken::class,
            RefreshToken::class,
            ExchangeToken::class,
        ]);

        $this->app->bind('brandstudio_instagram',function() {
            return new InstagramService(config('instagram'));
        });

    }

    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->publish();
        }
    }

    public function publish()
    {
        $this->publishes([
            __DIR__.'/config/instagram.php' => config_path('instagram.php')
        ], 'config');


    }


}
