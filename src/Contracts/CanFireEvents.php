<?php

namespace YsZ\LwRangeSlider\Contracts;

use YsZ\LwRangeSlider\Enums\EventName;

trait CanFireEvents
{
    /**
     * @param float|int $min
     * @param float|int $max
     * @param float|int|null $minRange
     * @param float|int|null $maxRange
     * @return void
     */
    public function firePriceRangeChangedEvent(
        float|int      $min,
        float|int      $max,
        float|int|null $minRange = null,
        float|int|null $maxRange = null
    ): void
    {
        $this->dispatch(
            EventName::PRICE_RANGE_CHANGED->value,
            $min,
            $max,
            $minRange ?? $min,
            $maxRange ?? $max
        );
    }
}
