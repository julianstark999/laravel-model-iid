<?php

namespace JulianStark999\LaravelModelIid\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JulianStark999\LaravelModelIid\Tests\Models\PostWithoutColumn;

class PostWithoutColumnFactory extends Factory
{
    protected $model = PostWithoutColumn::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'text' => $this->faker->paragraph,
        ];
    }
}
