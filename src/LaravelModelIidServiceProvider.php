<?php

namespace JulianStark999\LaravelModelIid;

use Illuminate\Support\ServiceProvider;
use JulianStark999\LaravelModelIid\Console\Generate;
use JulianStark999\LaravelModelIid\Console\Init;

class LaravelModelIidServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Init::class,
                Generate::class,
            ]);
        }
    }
}
