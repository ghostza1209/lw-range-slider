<?php

namespace YsZ\LwRangeSlider;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use YsZ\LwRangeSlider\Enums\Modifier;
use YsZ\LwRangeSlider\Exceptions\RangeSliderException;

class LwRangeSlider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public int|float $minVal,
        public int|float $maxVal,
        public array     $options = [],
        public int|float $minRange = 0,
        public int|float $maxRange = 0,
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
        if ($attributes->wire('model')->hasModifier('blur')) {
            return Modifier::BLUR->toString();
        }

        if ($attributes->wire('model')->hasModifier('live')) {
            return Modifier::LIVE->toString();
        }

        return Modifier::DEFER->toString();
    }

    /**
     * @return \Closure|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('livewire-range-slider::components.lw-range-slider');
    }
}
