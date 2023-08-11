<?php

namespace Kumi\Sousa\Models\Vessel\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait InteractsWithFeaturedImage
{
    /**
     * Initialize trait.
     */
    public function initializeInteractsWithFeaturedImage(): void
    {
        $this->appends[] = 'featured_image_url';

        $this->addMediaCollection('featured_image')
            ->singleFile()
        ;
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->hasFeaturedImage()
            ? $this->getFeaturedImage()->getFullUrl()
            : null;
    }

    public function getFeaturedImage(): Media
    {
        return $this->getFirstMedia('featured_image');
    }

    public function hasFeaturedImage()
    {
        return $this->hasMedia('featured_image');
    }
}
