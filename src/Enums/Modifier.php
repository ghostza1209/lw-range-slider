<?php

namespace YsZ\LwRangeSlider\Enums;

enum Modifier
{
    case EMPTY;
    case LAZY;
    case DEFER;

    /**
     * @return string
     */
    public function toString(): string
    {
        return str($this->name)->lower();
    }
}
