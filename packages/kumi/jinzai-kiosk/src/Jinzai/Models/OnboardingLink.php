<?php

namespace Kumi\Jinzai\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kumi\Jinzai\Database\Factories\OnboardingLinkFactory;

class OnboardingLink extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::ONBOARDING_LINKS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getEditUrl(): string
    {
        return route('filament.onboarding.edit', ['link' => $this]);
    }

    public function isExpired(): bool
    {
        $attribute = $this->getAttribute('expired_at');

        return ! is_null($attribute) && $attribute->isPast();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return OnboardingLinkFactory::new();
    }
}
