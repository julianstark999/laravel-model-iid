<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JulianStark999\LaravelModelIid\Tests\Database\Factories\ProjectFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $guarded = [];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
