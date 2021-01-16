<?php

namespace JulianStark999\LaravelModelIid\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JulianStark999\LaravelModelIid\Tests\Models\TaskWithoutColumn;

class TaskWithoutColumnFactory extends Factory
{
    protected $model = TaskWithoutColumn::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'text' => $this->faker->paragraph,
        ];
    }
}
