<?php

namespace JulianStark999\LaravelModelIid\Tests\Traits;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JulianStark999\LaravelModelIid\Tests\Models\Category;
use JulianStark999\LaravelModelIid\Tests\TestCase;

class HasIidColumnTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testSetIidForFirstEntry()
    {
        $category = Category::create([
            'name' => $this->faker->city,
        ]);

        $post = $category->posts()->create([
            'name' => $this->faker->lastName,
            'text' => $this->faker->text,
        ]);

        $this->assertEquals(1, $post->iid);
    }
}
