<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JulianStark999\LaravelModelIid\Tests\Database\Factories\PostWithoutColumnFactory;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class PostWithoutColumn extends Model
{
    use HasFactory;
    use HasIidColumn;

    protected $table = 'test_posts';

    protected $guarded = [];

    protected static function newFactory()
    {
        return PostWithoutColumnFactory::new();
    }
}
