<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JulianStark999\LaravelModelIid\Tests\Database\Factories\TaskFactory;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class Task extends Model
{
    use HasFactory;
    use HasIidColumn;

    public $iidColumn = 'project_id';

    protected $table = 'tasks';

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected static function newFactory()
    {
        return TaskFactory::new();
    }
}