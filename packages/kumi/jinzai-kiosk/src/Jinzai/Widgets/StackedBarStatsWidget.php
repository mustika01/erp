<?php

namespace Kumi\Jinzai\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Filament\Widgets\Concerns\CanPoll;
use Kumi\Jinzai\Widgets\StackedBarStatsWidget\LineItem;

class StackedBarStatsWidget extends Widget
{
    use CanPoll;

    protected static ?string $heading = null;

    protected ?array $cachedLineItems = null;

    protected int|string|array $columnSpan = 1;

    protected static string $view = 'jinzai::widgets.stacked-bar-stats-widget';

    public function getTotal(): string
    {
        return Collection::make($this->getCachedLineItems())
            ->sum(function (LineItem $item) {
                return $item->getValue();
            })
        ;
    }

    protected function getHeading(): ?string
    {
        return static::$heading;
    }

    protected function getCachedLineItems(): array
    {
        return $this->cachedLineItems ??= $this->getLineItems();
    }

    protected function getLineItems(): array
    {
        return [];
    }
}
