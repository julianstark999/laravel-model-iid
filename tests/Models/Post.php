<?php

namespace JulianStark999\LaravelModelIid\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JulianStark999\LaravelModelIid\Tests\Database\Factories\PostFactory;
use JulianStark999\LaravelModelIid\Traits\HasIidColumn;

class Post extends Model
{
    use HasFactory;
    use HasIidColumn;

    public $iidColumn = 'category_id';

    protected $table = 'posts';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
