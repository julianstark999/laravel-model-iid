<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JulianStark999\LaravelModelIid\Tests\Database\Factories\TaskWithoutColumnFactory;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class TaskWithoutColumn extends Model
{
    use HasFactory;
    use HasIidColumn;

    /** @var string */
    protected $table = 'tasks2';

    /** @var array */
    protected $guarded = [];

    protected static function newFactory(): TaskWithoutColumnFactory
    {
        return TaskWithoutColumnFactory::new();
    }
}
