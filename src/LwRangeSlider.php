<?php

namespace YsZ\LwRangeSlider;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Jantinnerezo\LivewireRangeSlider\Exceptions\RangeSliderException;
use Livewire\WireDirective;
use YsZ\LwRangeSlider\Enums\Modifier;

class LwRangeSlider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private int|float $minVal,
        private int|float $maxVal,
        private array     $options = [],
        private int|float $minRange = 0,
        private int|float $maxRange = 0,
    )
    {
        if(!$this->minRange) {
            $this->minRange = $this->minVal;
        }

        if(!$this->maxRange) {
            $this->maxRange = $this->maxVal;
        }
    }

    /**
     * @param ComponentAttributeBag $attributes
     * @return array
     */
    public function getWireModel(ComponentAttributeBag $attributes)
    {
        $attribute = $attributes->wire('model');

        if ((!$attribute->value() || is_bool($attribute->value())) || empty($attribute->value())) {
            throw new RangeSliderException(
                'Missing or empty wire:model attribute.'
            );
        }

        return $attribute->value();
    }

    /**
     * @param ComponentAttributeBag $attributes
     * @return string
     */
    public function getWireModelModifier(ComponentAttributeBag $attributes)
    {
        if ($attributes->wire('model')->hasModifier(Modifier::LAZY->toString())) {
            return Modifier::LAZY->toString();
        }

        if ($attributes->wire('model')->hasModifier(Modifier::DEFER->toString())) {
            return Modifier::DEFER->toString();
        }

        return Modifier::EMPTY->toString();
    }

    /**
     * @return \Closure|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('livewire-range-slider::components.lw-range-slider');
    }
}
