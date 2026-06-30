<?php

namespace App\Support\MediaLibrary;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

class ModelPathGenerator extends DefaultPathGenerator
{
    /**
     * Map a media owner model to the parent folder its files live under.
     */
    protected array $folders = [
        \App\Models\Photo::class => 'gallery',
        \App\Models\Video::class => 'videos',
        \App\Models\TeamMember::class => 'team',
    ];

    protected function getBasePath(Media $media): string
    {
        $folder = $this->folders[$media->model_type]
            ?? Str::plural(Str::kebab(class_basename($media->model_type)));

        $base = $folder.'/'.$media->getKey();

        $prefix = config('media-library.prefix', '');

        return $prefix !== '' ? $prefix.'/'.$base : $base;
    }
}
