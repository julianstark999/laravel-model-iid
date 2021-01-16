<?php

namespace JulianStark999\LaravelModelIid\Tests\Console;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use JulianStark999\LaravelModelIid\Tests\Models\Project;
use JulianStark999\LaravelModelIid\Tests\Models\Task;
use JulianStark999\LaravelModelIid\Tests\Models\TaskWithoutColumn;
use JulianStark999\LaravelModelIid\Tests\Models\TaskWithoutTrait;
use JulianStark999\LaravelModelIid\Tests\TestCase;

class GenerateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_without_iids()
    {
        $project = Project::factory()->create();

        Task::factory()->count(5)->for($project)->create();

        $project->tasks()->update([
            'iid' => null,
        ]);

        Artisan::call('iid:generate', ['className' => Task::class]);

        $this->assertEquals($project->tasks->count(), $project->tasks->last()->iid);
    }

    /** @test */
    public function test_with_some_iids()
    {
        $project = Project::factory()->create();

        Task::factory()->count(2)->for($project)->create();
        $task = Task::factory()->for($project)->create();
        Task::factory()->count(2)->for($project)->create();

        $task->update([
            'iid' => null,
        ]);

        Artisan::call('iid:generate', ['className' => Task::class]);

        $task->refresh();

        $this->assertEquals($project->tasks->count() + 1, $task->iid);
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
        $return = Artisan::call('iid:generate', ['className' => TaskWithoutTrait::class]);

        $this->assertEquals(-2, $return);
    }

    /** @test */
    public function test_with_table_not_has_column()
    {
        $return = Artisan::call('iid:generate', ['className' => TaskWithoutColumn::class]);

        $this->assertEquals(-3, $return);
    }
}
