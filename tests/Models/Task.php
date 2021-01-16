<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JulianStark999\LaravelModelIid\Tests\Database\Factories\TaskFactory;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class Task extends Model
{
    use HasFactory;
    use HasIidColumn;

    public $iidColumn = 'project_id';

    protected $table = 'tasks';

    protected $guarded = [];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }
}
