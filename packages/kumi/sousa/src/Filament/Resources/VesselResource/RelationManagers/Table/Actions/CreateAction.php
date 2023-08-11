<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\RelationManagers\Table\Actions;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Tables\Actions\CreateAction as BaseCreateAction;

class CreateAction extends BaseCreateAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->disableCreateAnother();

        $this->using(function (array $data): Model {
            $data['slug'] = Str::slug($data['name']);

            $model = $this->getModel();
            $relationship = $this->getRelationship();

            if (! $relationship) {
                return $model::create($data);
            }

            if ($relationship instanceof BelongsToMany) {
                $pivotColumns = $relationship->getPivotColumns();

                return $relationship->create(
                    Arr::except($data, $pivotColumns),
                    Arr::only($data, $pivotColumns),
                );
            }

            return $relationship->create($data);
        });
    }
}
