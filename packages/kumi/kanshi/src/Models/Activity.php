<?php

namespace Kumi\Kanshi\Models;

use Kumi\Kanshi\Database\Factories\ActivityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Activity as BaseActivity;

class Activity extends BaseActivity
{
    use HasFactory;

    public function getCreatedDateAttribute(): string
    {
        $attribute = $this->getAttribute('created_at');

        return $attribute->format('d M');
    }

    public function getCreatedTimeAttribute(): string
    {
        $attribute = $this->getAttribute('created_at');

        return $attribute->format('H:i');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return ActivityFactory::new();
    }
}
