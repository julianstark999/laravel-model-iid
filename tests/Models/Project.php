<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JulianStark999\LaravelModelIid\Tests\Database\Factories\ProjectFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    protected static function newFactory()
    {
        return ProjectFactory::new();
    }
}
