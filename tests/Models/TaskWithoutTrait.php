<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class TaskWithoutTrait extends Model
{
    /** @var string */
    protected $table = 'tasks';

    /** @var array */
    protected $guarded = [];
}
