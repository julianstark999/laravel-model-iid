<?php

namespace JulianStark999\LaravelModelIid\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use JulianStark999\LaravelModelIid\LaravelModelIidServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'JulianStark999\\LaravelTestsGenerator\\Tests\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelModelIidServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['db']->connection()->getSchemaBuilder()->create('projects', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('name');

            $table->timestamps();
        });

        $app['db']->connection()->getSchemaBuilder()->create('tasks', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('name');
            $table->text('text');

            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('iid')->nullable();

            $table->timestamps();
        });

        $app['db']->connection()->getSchemaBuilder()->create('tasks2', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('name');
            $table->text('text');

            $table->unsignedInteger('project_id')->nullable();

            $table->timestamps();
        });
    }
}
