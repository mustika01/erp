<?php

namespace Kumi\Senzou\Tests\Filament\Resources\ActivityResource\Pages;

use Kumi\Senzou\Filament\Resources\ItemResource\Pages\CreateItem;
use Kumi\Senzou\Models\Item;
use Kumi\Senzou\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */
class CreateItemTest extends AdministratorTestCase
{
    public function test_render_create_item_page()
    {
        Livewire::test(CreateItem::class)
            ->assertSuccessful()
        ;
    }

    public function test_create_item()
    {
        $newData = Item::factory()->make();

        Livewire::test(CreateItem::class)
            ->fillForm([
                'name' => $newData->name,
                'unit_of_measurement' => $newData->unit_of_measurement,
                'measurement_symbol' => $newData->measurement_symbol,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Item::class, [
            'name' => $newData->name,
            'unit_of_measurement' => $newData->unit_of_measurement,
            'measurement_symbol' => $newData->measurement_symbol,
        ]);
    }

    public function test_validate_item_name()
    {
        $newData = Item::factory()->make();

        Livewire::test(CreateItem::class)
            ->fillForm([
                'name' => null,
                'unit_of_measurement' => $newData->unit_of_measurement,
                'measurement_symbol' => $newData->measurement_symbol,
            ])
            ->call('create')
            ->assertHasFormErrors(['name' => 'required'])
        ;
    }

    public function test_validate_item_unit_of_measurement()
    {
        $newData = Item::factory()->make();

        Livewire::test(CreateItem::class)
            ->fillForm([
                'name' => $newData->name,
                'unit_of_measurement' => null,
                'measurement_symbol' => $newData->measurement_symbol,
            ])
            ->call('create')
            ->assertHasFormErrors(['unit_of_measurement' => 'required'])
        ;
    }

    public function test_validate_item_measurement_symbol()
    {
        $newData = Item::factory()->make();

        Livewire::test(CreateItem::class)
            ->fillForm([
                'name' => $newData->name,
                'unit_of_measurement' => $newData->unit_of_measurement,
                'measurement_symbol' => null,
            ])
            ->call('create')
            ->assertHasFormErrors(['measurement_symbol' => 'required'])
        ;
    }
}
