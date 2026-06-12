<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type', 'description'];

    protected static function booted(): void
    {
        static::saving(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name) ?: Str::random(8);
            }
        });
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    /** Categories used for blog posts / activities. */
    public function scopeForPosts($query)
    {
        return $query->where('type', 'post');
    }

    /** Categories used for the photo gallery. */
    public function scopeForPhotos($query)
    {
        return $query->where('type', 'photo');
    }
}