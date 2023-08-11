<?php

namespace Kumi\Kiosk\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Kumi\Kiosk\Models\TicketCategory;

/**
 * @codeCoverageIgnore
 */
class InitTicketCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kiosk:init-ticket-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize categories to be used in tickets';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Collection::make($this->getCategories())
            ->each(function ($value, $key) {
                $category = TicketCategory::firstOrCreate([
                    'label' => $value,
                    'slug' => $key,
                ]);

                Collection::make($this->getChildCategories($category->slug))
                    ->each(function ($value, $key) use ($category) {
                        $child = TicketCategory::firstOrCreate([
                            'parent_id' => $category->id,
                            'label' => $value,
                            'slug' => $key,
                        ]);

                        Collection::make($this->getGrandChildCategories($child->slug))
                            ->each(function ($value, $key) use ($child) {
                                TicketCategory::firstOrCreate([
                                    'parent_id' => $child->id,
                                    'label' => $value,
                                    'slug' => $key,
                                ]);
                            })
                        ;
                    })
                ;
            })
        ;

        $this->info('Success! Ticket categoris has been initialized.');

        return static::SUCCESS;
    }

    protected function getCategories()
    {
        return [
            // 'office-equipments' => 'Office Equipments',
            TicketCategory::KEY_SALARY => __('kiosk::filament/resources/ticket-category.labels.' . TicketCategory::KEY_SALARY),
            TicketCategory::KEY_ATTENDANCE => __('kiosk::filament/resources/ticket-category.labels.' . TicketCategory::KEY_ATTENDANCE),
        ];
    }

    protected static function getChildCategories($category)
    {
        $categories = [
            'office-equipments' => [
                'copier' => 'Copier',
                'printer' => 'Printer',
            ],
            TicketCategory::KEY_SALARY => [
                TicketCategory::KEY_SALARY_ADVANCE => __('kiosk::filament/resources/ticket-category.labels.' . TicketCategory::KEY_SALARY_ADVANCE),
                // TicketCategory::KEY_SALARY_INCREASE => __('kiosk::filament/resources/ticket-category.labels.' . TicketCategory::KEY_SALARY_INCREASE),
            ],
            TicketCategory::KEY_ATTENDANCE => [
                TicketCategory::KEY_LEAVE_REQUEST => __('kiosk::filament/resources/ticket-category.labels.' . TicketCategory::KEY_LEAVE_REQUEST),
                // TicketCategory::KEY_SALARY_INCREASE => __('kiosk::filament/resources/ticket-category.labels.' . TicketCategory::KEY_SALARY_INCREASE),
            ],
        ];

        return array_key_exists($category, $categories) ? $categories[$category] : [];
    }

    protected static function getGrandChildCategories($category)
    {
        $categories = [
            'copier' => [
                'scanner-isnt-working' => 'The scanner is not working',
                'copier-isnt-working' => 'The copier is not working',
            ],
        ];

        return array_key_exists($category, $categories) ? $categories[$category] : [];
    }
}
