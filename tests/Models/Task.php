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

    /** @var string */
    public $iidColumn = 'project_id';

    /** @var string */
    protected $table = 'tasks';

    /** @var array */
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
