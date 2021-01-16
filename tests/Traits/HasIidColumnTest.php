<?php

namespace JulianStark999\LaravelModelIid\Tests\Traits;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JulianStark999\LaravelModelIid\Exceptions\SchemaDoesNotHasIidColumn;
use JulianStark999\LaravelModelIid\Tests\Models\Project;
use JulianStark999\LaravelModelIid\Tests\Models\Task;
use JulianStark999\LaravelModelIid\Tests\Models\TaskWithoutColumn;
use JulianStark999\LaravelModelIid\Tests\TestCase;

class HasIidColumnTest extends TestCase
{
    use RefreshDatabase;

    public function test_set_iid_first_row(): void
    {
        $task = Task::factory()->for(Project::factory()->create())->create();

        $this->assertEquals(1, $task->iid);
    }

    public function test_set_iid_new_row(): void
    {
        $project = Project::factory()->create();

        Task::factory()->for($project)->create()->update([
            'iid' => 100,
        ]);

        $task = Task::factory()->for($project)->create();

        $this->assertEquals(101, $task->iid);
    }

    public function test_set_iid_when_iidColumn_value_is_null(): void
    {
        $task = Task::factory()->create();

        $this->assertNull($task->iid);
    }

    public function test_set_iid_when_column_not_exists(): void
    {
        $this->expectException(SchemaDoesNotHasIidColumn::class);

        TaskWithoutColumn::factory()->create();
    }
}
