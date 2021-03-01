<?php


namespace Papiyas\Api;


use Illuminate\Support\ServiceProvider;
use Papiyas\Api\Response\Api;

class ApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/api.php' => config_path('api.php'),
                __DIR__ . '/../resources/Enums' => app_path('Enums'),
                __DIR__ . '/../resources/lang'  => resource_path('lang'),
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/api.php', 'api');

        $this->app->singleton('api', function () {
            return new Api(config('api.settings'));
        });
    }
}
