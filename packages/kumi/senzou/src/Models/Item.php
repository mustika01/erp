<?php

namespace Kumi\Senzou\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kumi\Senzou\Database\Factories\ItemFactory;
use Kumi\Senzou\Support\DatabaseTableNames;

class Item extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DatabaseTableNames::ITEMS;

    protected $guarded = [];

    public function entries(): HasMany
    {
        return $this->hasMany(DeliveryNoteEntry::class);
    }

    protected static function newFactory()
    {
        return ItemFactory::new();
    }
}
