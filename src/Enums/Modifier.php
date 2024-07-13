<?php

namespace YsZ\LwRangeSlider\Enums;

enum Modifier
{
    case LIVE;
    case BLUR;
    case DEFER;

    /**
     * @return string
     */
    public function toString(): string
    {
        return str($this->name)->lower();
    }
}
