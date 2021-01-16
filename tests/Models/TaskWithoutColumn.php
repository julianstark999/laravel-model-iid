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

    protected $table = 'tasks2';

    protected $guarded = [];

    protected static function newFactory()
    {
        return TaskWithoutColumnFactory::new();
    }
}
