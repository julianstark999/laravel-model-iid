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

    /** @test */
    public function test_set_iid_first_row()
    {
        $task = Task::factory()->for(Project::factory()->create())->create();

        $this->assertEquals(1, $task->iid);
    }

    /** @test */
    public function test_set_iid_new_row()
    {
        $project = Project::factory()->create();

        Task::factory()->for($project)->create()->update([
            'iid' => 100,
        ]);

        $task = Task::factory()->for($project)->create();

        $this->assertEquals(101, $task->iid);
    }

    /** @test */
    public function test_set_iid_when_iidColumn_value_is_null()
    {
        $task = Task::factory()->create();

        $this->assertNull($task->iid);
    }

    /** @test */
    public function test_set_iid_when_column_not_exists()
    {
        $this->expectException(SchemaDoesNotHasIidColumn::class);

        TaskWithoutColumn::factory()->create();
    }
}
