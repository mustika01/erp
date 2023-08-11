<?php

namespace Kumi\Jinzai\Widgets\PieStatsWidget;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Htmlable;

class Slice extends Component implements Htmlable
{
    protected ?string $color = null;

    protected array $extraAttributes = [];

    protected ?string $id = null;

    protected string|Htmlable $label;

    protected $value;

    protected int $total;

    final public function __construct(string $label, $value)
    {
        $this->label($label);
        $this->value($value);
    }

    public static function make(string $label, $value): static
    {
        return app(static::class, ['label' => $label, 'value' => $value]);
    }

    public function color(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function extraAttributes(array $attributes): static
    {
        $this->extraAttributes = $attributes;

        return $this;
    }

    public function label(string|Htmlable $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function id(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function value($value): static
    {
        $this->value = $value;

        return $this;
    }

    public function total($total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getColor(): ?string
    {
        $colors = [
            'red' => '#ef4444',
            'orange' => '#f97316',
            'yellow' => '#eab308',
            'green' => '#22c55e',
            'cyan' => '#06b6d4',
            'blue' => '#3b82f6',
            'purple' => '#a855f7',
            'pink' => '#ec4899',
        ];

        return $colors[$this->color];
    }

    public function getExtraAttributes(): array
    {
        return $this->extraAttributes;
    }

    public function getLabel(): string|Htmlable
    {
        return $this->label;
    }

    public function getId(): string
    {
        return $this->id ?? Str::slug($this->getLabel());
    }

    public function getValue()
    {
        return value($this->value);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPercentage()
    {
        return number_format($this->value / $this->total * 100, 1);
    }

    public function getPercentageLabel()
    {
        $percentage = $this->getPercentage();

        return "{$percentage}%";
    }

    public function toHtml(): string
    {
        return $this->render()->render();
    }

    public function render(): View
    {
        return view('jinzai::widgets.simple-pie-stats-widget.slice', $this->data());
    }
}
