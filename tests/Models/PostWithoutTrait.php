<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class PostWithoutTrait extends Model
{
    protected $table = 'test_posts';

    protected $guarded = [];
}
