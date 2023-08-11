<?php

namespace Kumi\Jinzai\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Filament\Widgets\Concerns\CanPoll;
use Kumi\Jinzai\Widgets\PieStatsWidget\Slice;

class SimplePieStatsWidget extends Widget
{
    use CanPoll;

    protected static ?string $heading = null;

    protected ?array $cachedSlices = null;

    protected int|string|array $columnSpan = 1;

    protected static string $view = 'jinzai::widgets.simple-pie-stats-widget';

    public function getTotal(): string
    {
        return Collection::make($this->getCachedSlices())
            ->sum(function (Slice $item) {
                return $item->getValue();
            })
        ;
    }

    public function getSlicePercentage(Slice $item): string
    {
        return $item->getValue() / $this->getTotal() * 100;
    }

    protected function getHeading(): ?string
    {
        return static::$heading;
    }

    protected function getCachedSlices(): array
    {
        return $this->cachedSlices ??= $this->getSlices();
    }

    protected function getSlices(): array
    {
        return [];
    }
}
