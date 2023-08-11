<?php

namespace Kumi\Tobira\Models;

use Kumi\Kanshi\Models\Activity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Kumi\Kyoka\Support\DefaultRoles;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Tobira\Auth\MustActivateAccount;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Kumi\Kanshi\Traits\InteractsWithNullCauser;
use Kumi\Tobira\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kumi\Kyoka\Support\DefaultPermissions as KyokaDefaultPermissions;
use Kumi\Tobira\Support\DefaultPermissions as TobiraDefaultPermissions;

class User extends Authenticatable implements HasMedia, MustVerifyEmail, FilamentUser
{
    use HasFactory;
    use Notifiable;
    use InteractsWithMedia;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use MustActivateAccount;
    use LogsActivity;
    use InteractsWithNullCauser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'activated_at' => 'datetime',
    ];

    public function canAccessFilament(): bool
    {
        return $this->can(TobiraDefaultPermissions::ACCESS_FILAMENT);
    }

    public function getActivityLogNameAttribute(): string
    {
        return $this->getAttribute('name');
    }

    public function scopeWithoutSensitive(Builder $builder): Builder
    {
        return $builder->whereDoesntHave('roles', function (Builder $query) {
            $query->whereIn('name', [
                DefaultRoles::SUPER_ADMINISTRATOR,
                DefaultRoles::SYSTEM,
                DefaultRoles::BOT,
            ]);
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(function (string $event) {
                return __('kyoka::filament/resources/user.events.' . $event);
            })
            ->logAll()
            ->logOnlyDirty()
        ;
    }

    public function tapActivity(Activity $activity, string $event)
    {
        if (self::eventsToBeRecorded()->contains($event)) {
            $activity = $this->handleNullCauser($activity);
        }
    }

    public function canImpersonate()
    {
        return $this->can(KyokaDefaultPermissions::IMPERSONATE_USER);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
