<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class TaskWithoutTrait extends Model
{
    protected $table = 'tasks2';

    protected $guarded = [];
}
