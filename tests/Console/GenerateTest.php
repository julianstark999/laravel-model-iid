<?php

namespace JulianStark999\LaravelModelIid\Tests\Console;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use JulianStark999\LaravelModelIid\Tests\Models\Category;
use JulianStark999\LaravelModelIid\Tests\Models\Post;
use JulianStark999\LaravelModelIid\Tests\Models\PostWithoutColumn;
use JulianStark999\LaravelModelIid\Tests\Models\PostWithoutTrait;
use JulianStark999\LaravelModelIid\Tests\TestCase;

class GenerateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_without_iids()
    {
        $category = Category::factory()->create();

        Post::factory()->count(5)->for($category)->create();

        $category->posts()->update([
            'iid' => null,
        ]);

        Artisan::call('iid:generate', ['className' => Post::class]);

        $this->assertEquals($category->posts->count(), $category->posts->last()->iid);
    }

    /** @test */
    public function test_with_some_iids()
    {
        $category = Category::factory()->create();

        Post::factory()->count(2)->for($category)->create();
        $post = Post::factory()->for($category)->create();
        Post::factory()->count(2)->for($category)->create();

        $post->update([
            'iid' => null,
        ]);

        Artisan::call('iid:generate', ['className' => Post::class]);

        $post->refresh();

        $this->assertEquals($category->posts->count() + 1, $post->iid);
    }

    /** @test */
    public function test_with_undefined_class()
    {
        $return = Artisan::call('iid:generate', ['className' => "App\Models\Undefined"]);

        $this->assertEquals(-1, $return);
    }

    /** @test */
    public function test_with_model_not_uses_trait()
    {
        $return = Artisan::call('iid:generate', ['className' => PostWithoutTrait::class]);

        $this->assertEquals(-2, $return);
    }

    /** @test */
    public function test_with_table_not_has_column()
    {
        $return = Artisan::call('iid:generate', ['className' => PostWithoutColumn::class]);

        $this->assertEquals(-3, $return);
    }
}
