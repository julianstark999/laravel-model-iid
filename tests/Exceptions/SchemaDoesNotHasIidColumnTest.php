<?php

namespace JulianStark999\LaravelModelIid\Tests\Exceptions;

use JulianStark999\LaravelModelIid\Exceptions\SchemaDoesNotHasIidColumn;
use JulianStark999\LaravelModelIid\Tests\TestCase;

class SchemaDoesNotHasIidColumnTest extends TestCase
{
    /** @test */
    public function test_message()
    {
        try {
            throw SchemaDoesNotHasIidColumn::create('projects');
        } catch (SchemaDoesNotHasIidColumn $exception) {
            $this->assertEquals($exception->getMessage(), "The `iid` column was not found in `projects` table.");
        }
    }
}
