<?php

namespace App\Models;

use Wave\Post as WavePost;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends WavePost implements HasMedia
{
    use InteractsWithMedia;

    public $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
    }
}
