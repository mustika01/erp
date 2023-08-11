<?php

namespace Kumi\Kyoka\Filament\Resources\RoleResource\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

trait InteractsWithRoleFormData
{
    public function mutateRoleFormData(array $data): array
    {
        $data['name'] = Str::slug($data['label']);
        $data['is_editable'] = true;

        if (! isset($data['description']) || empty($data['description'])) {
            $data['description'] = $data['label'];
        }

        if (isset($data['permissions'])) {
            $data['permissions'] = Collection::make($data['permissions'])
                ->map(function ($value, $key) {
                    return $value ? $key : null;
                })
                ->filter()
                ->values()
                ->toArray()
            ;
        }

        return $data;
    }
}
