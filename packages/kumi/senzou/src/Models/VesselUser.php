<?php

namespace Kumi\Senzou\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kumi\Senzou\Database\Factories\VesselUserFactory;
use Kumi\Senzou\Support\DatabaseTableNames;
use Kumi\Senzou\Support\Enums\Position;
use Kumi\Sousa\Models\Vessel;

class VesselUser extends Authenticatable
{
    use HasFactory;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = DatabaseTableNames::VESSEL_USERS;

    protected $guarded = [];

    public function vessel(): BelongsTo
    {
        return $this->belongsTo(Vessel::class);
    }

    public function isNahkoda(): bool
    {
        return $this->position === Position::NAHKODA;
    }

    public function isKKM(): bool
    {
        return $this->position === Position::KKM;
    }

    public function isChiefOfficer(): bool
    {
        return $this->position === Position::CHIEF_OFFICER;
    }

    protected static function newFactory()
    {
        return VesselUserFactory::new();
    }
}
