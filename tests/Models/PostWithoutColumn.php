<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class PostWithoutColumn extends Model
{
    use HasIidColumn;

    protected $table = 'test_posts';

    protected $guarded = [];
}
