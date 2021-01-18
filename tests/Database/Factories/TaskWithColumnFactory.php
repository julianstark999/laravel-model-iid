<?php

namespace JulianStark999\LaravelModelIid\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JulianStark999\LaravelModelIid\Tests\Models\TaskWithColumn;

class TaskWithColumnFactory extends Factory
{
    protected $model = TaskWithColumn::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'text' => $this->faker->paragraph,
        ];
    }
}
