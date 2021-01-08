<?php

namespace JulianStark999\LaravelModelIid\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JulianStark999\LaravelModelIid\Tests\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
        ];
    }
}
