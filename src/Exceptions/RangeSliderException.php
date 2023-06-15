<?php

namespace YsZ\LwRangeSlider\Exceptions;

class RangeSliderException
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;

        parent::__construct();
    }

    public function __toString()
    {
        return "Livewire Range Slider Component Exception: {$this->message}";
    }
}
