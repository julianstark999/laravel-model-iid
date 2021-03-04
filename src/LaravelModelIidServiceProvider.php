<?php

namespace JulianStark999\LaravelModelIid;

use JulianStark999\LaravelModelIid\Commands\GenerateCommand;
use JulianStark999\LaravelModelIid\Commands\InitCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelModelIidServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-model-iid')
            ->hasCommands([
                InitCommand::class,
                GenerateCommand::class,
            ]);
    }
}
