<?php

namespace App\Vendor\Spatie\MediaLibrary\Support\PathGenerator;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator as BaseDefaultPathGenerator;

class DefaultPathGenerator extends BaseDefaultPathGenerator implements PathGenerator
{
    protected static $pathPrefix = 'media-library';

    // Get the path for the given media, relative to the root storage path.
    public function getPath(Media $media): string
    {
        return $this->getPathPrefix() . '/' . parent::getPath($media);
    }

    // Get the path for conversions of the given media, relative to the root storage path.
    public function getPathForConversions(Media $media): string
    {
        return $this->getPathPrefix() . '/' . parent::getPathForConversions($media);
    }

    // Get the path for responsive images of the given media, relative to the root storage path.
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPathPrefix() . '/' . parent::getPathForResponsiveImages($media);
    }

    protected function getPathPrefix(): string
    {
        return self::$pathPrefix;
    }
}
