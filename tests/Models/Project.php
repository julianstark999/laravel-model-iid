<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JulianStark999\LaravelModelIid\Tests\Database\Factories\ProjectFactory;

class Project extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'projects';

    /** @var array */
    protected $guarded = [];

    public function tasks(): HasMany
    {
        return $this->hasMany(TaskWithColumn::class);
    }

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
