<?php

namespace JulianStark999\LaravelModelIid\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use JulianStark999\LaravelModelIid\LaravelModelIidServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /**
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelModelIidServiceProvider::class,
        ];
    }

    /**
     * @param Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * @param Application $app
     *
     * @return void
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->timestamps();
        });

        $app['db']->connection()->getSchemaBuilder()->create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('text');

            $table->unsignedInteger('category_id');
            $table->unsignedInteger('iid')->nullable();

            $table->timestamps();
        });

        $app['db']->connection()->getSchemaBuilder()->create('test_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('text');

            $table->unsignedInteger('category_id');

            $table->timestamps();
        });
    }
}
