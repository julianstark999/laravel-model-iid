<?php

namespace JulianStark999\LaravelModelIid;

use Illuminate\Support\ServiceProvider;
use JulianStark999\LaravelModelIid\Console\Generate;

class LaravelModelIidServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                                Generate::class,
            ]);
        }
    }
}
