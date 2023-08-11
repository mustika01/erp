<?php

namespace Kumi\Senzou\Tests\Filament\Resources\ActivityResource\Pages;

use Kumi\Senzou\Filament\Resources\ItemResource\Pages\ListItems;
use Kumi\Senzou\Models\Item;
use Kumi\Senzou\Tests\Cases\AdministratorTestCase;
use Livewire\Livewire;

/**
 * @internal
 */
class ListItemsTest extends AdministratorTestCase
{
    public function test_render_list_items_page()
    {
        Livewire::test(ListItems::class)
            ->assertSuccessful()
        ;
    }

    public function test_list_items()
    {
        $items = Item::factory()->count(5)->create();

        Livewire::test(ListItems::class)
            ->assertCanSeeTableRecords($items)
        ;
    }

    public function test_list_items_name()
    {
        Item::factory()->count(5)->create();

        Livewire::test(ListItems::class)
            ->assertCanRenderTableColumn('name')
            ->assertCanRenderTableColumn('unit_of_measurement')
            ->assertCanRenderTableColumn('measurement_symbol')

        ;
    }

    public function test_search_product_name()
    {
        $product = Item::factory()->count(10)->create();
        $name = $product->first()->name;

        Livewire::test(ListItems::class)
            ->searchTable($name)
            ->assertCanSeeTableRecords($product->where('name', $name))
            ->assertCanNotSeeTableRecords($product->where('name', '!=', $name))
        ;
    }
}
