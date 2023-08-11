<?php

namespace Kumi\Senzou\Tests\Filament\Resources\ActivityResource\Pages;

use Kumi\Senzou\Filament\Resources\ItemResource\Pages\EditItem;
use Kumi\Senzou\Models\Item;
use Kumi\Senzou\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */
class EditItemTest extends AdministratorTestCase
{
    public function test_render_edit_item_page()
    {
        $item = Item::factory()->create();

        Livewire::test(EditItem::class, [
            'record' => $item->getKey(),
        ])
            ->assertSuccessful()
        ;
    }

    public function test_update_item()
    {
        $item = Item::factory()->create();
        $newData = Item::factory()->make();

        Livewire::test(EditItem::class, [
            'record' => $item->getKey(),
        ])
            ->assertFormSet([
                'name' => $item->name,
                'unit_of_measurement' => $item->unit_of_measurement,
                'measurement_symbol' => $item->measurement_symbol,
            ])
            ->fillForm([
                'name' => $newData->name,
                'unit_of_measurement' => $newData->unit_of_measurement,
                'measurement_symbol' => $newData->measurement_symbol,
            ])
            ->call('save')
            ->assertHasNoFormErrors()
        ;

        $this->assertDatabaseHas(Item::class, [
            'id' => $item->getKey(),
            'name' => $newData->name,
            'unit_of_measurement' => $newData->unit_of_measurement,
            'measurement_symbol' => $newData->measurement_symbol,
        ]);
    }

    public function test_validate_item_name()
    {
        $item = Item::factory()->create();

        Livewire::test(EditItem::class, [
            'record' => $item->getKey(),
        ])
            ->fillForm([
                'name' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['name' => 'required'])
        ;
    }

    public function test_validate_item_unit_of_measurement()
    {
        $item = Item::factory()->create();

        Livewire::test(EditItem::class, [
            'record' => $item->getKey(),
        ])
            ->fillForm([
                'unit_of_measurement' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['unit_of_measurement' => 'required'])
        ;
    }

    public function test_validate_item_measurement_symbol()
    {
        $item = Item::factory()->create();

        Livewire::test(EditItem::class, [
            'record' => $item->getKey(),
        ])
            ->fillForm([
                'measurement_symbol' => null,
            ])
            ->call('save')
            ->assertHasFormErrors(['measurement_symbol' => 'required'])
        ;
    }
}
