<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Photo extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['category_id', 'title', 'caption', 'is_published', 'sort_order'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Crop, 500, 500)
            ->nonQueued();
    }

    public function getImageUrlAttribute(): string
    {
        $media = $this->getFirstMedia('image');

        return $media
            ? $media->getUrl()
            : 'https://placehold.co/600x600/166534/ffffff?text=Photo';
    }

    public function getThumbUrlAttribute(): string
    {
        $media = $this->getFirstMedia('image');

        return $media
            ? $media->getUrl('thumb')
            : 'https://placehold.co/500x500/166534/ffffff?text=Photo';
    }
}