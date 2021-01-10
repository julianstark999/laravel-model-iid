<?php

namespace JulianStark999\LaravelModelIid\Tests\Traits;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JulianStark999\LaravelModelIid\Tests\Models\Category;
use JulianStark999\LaravelModelIid\Tests\Models\Post;
use JulianStark999\LaravelModelIid\Tests\TestCase;

class HasIidColumnTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_set_iid_first_row()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->for($category)->create();

        $this->assertEquals(1, $post->iid);
    }

    /** @test */
    public function test_set_iid_new_row()
    {
        $category = Category::factory()->create();

        $firstPost = Post::factory()->for($category)->create();
        $firstPost->update([
            'iid' => 100,
        ]);

        $secondPost = Post::factory()->for($category)->create();

        $this->assertEquals(101, $secondPost->iid);
    }

    /** @test */
    public function test_set_iid_when_iidColumn_value_is_null()
    {
        $post = Post::factory()->create();

        $this->assertNull($post->iid);
    }
}
