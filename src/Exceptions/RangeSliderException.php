<?php

namespace YsZ\LwRangeSlider\Exceptions;

use Exception;

class RangeSliderException extends Exception
{
    public function __toString(): string
    {
        return "Livewire Range Slider Component Exception: {$this->message}";
    }
}
