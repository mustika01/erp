<?php

namespace Kumi\Jinzai\Models;

use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DatabaseTableNames;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Disbursement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::DISBURSEMENTS;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'disbursement_method' => AsCollection::class,
        'create_response' => AsCollection::class,
        'processing_response' => AsCollection::class,
        'failed_response' => AsCollection::class,
        'complete_response' => AsCollection::class,
    ];

    public function getAmountFormattedAttribute(): string
    {
        return number_format($this->getAttribute('amount'));
    }
}
