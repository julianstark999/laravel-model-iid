<?php

namespace JulianStark999\LaravelModelIid\Tests\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use JulianStark999\LaravelModelIid\Tests\Models\Project;
use JulianStark999\LaravelModelIid\Tests\Models\TaskWithColumn;
use JulianStark999\LaravelModelIid\Tests\Models\TaskWithoutColumn;
use JulianStark999\LaravelModelIid\Tests\Models\TaskWithoutTrait;
use JulianStark999\LaravelModelIid\Tests\TestCase;

class GenerateCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_without_iid(): void
    {
        $project = Project::factory()->create();

        TaskWithColumn::factory()->count(5)->for($project)->create();

        $project->tasks()->update([
            'iid' => null,
        ]);

        Artisan::call('iid:generate', ['className' => TaskWithColumn::class]);

        $this->assertEquals($project->tasks->count(), $project->tasks->last()->iid);
    }

    public function test_with_some_iid(): void
    {
        $project = Project::factory()->create();

        TaskWithColumn::factory()->count(2)->for($project)->create();
        $task = TaskWithColumn::factory()->for($project)->create();
        TaskWithColumn::factory()->count(2)->for($project)->create();

        $task->update([
            'iid' => null,
        ]);

        Artisan::call('iid:generate', ['className' => TaskWithColumn::class]);

        $task->refresh();

        $this->assertEquals($project->tasks->count() + 1, $task->iid);
    }

    public function test_with_undefined_class(): void
    {
        $return = Artisan::call('iid:generate', ['className' => "App\Models\Undefined"]);

        $this->assertEquals(-1, $return);
    }

    public function test_with_model_not_uses_trait(): void
    {
        $return = Artisan::call('iid:generate', ['className' => TaskWithoutTrait::class]);

        $this->assertEquals(-2, $return);
    }

    public function test_with_table_not_has_column(): void
    {
        $return = Artisan::call('iid:generate', ['className' => TaskWithoutColumn::class]);

        $this->assertEquals(-3, $return);
    }
}
