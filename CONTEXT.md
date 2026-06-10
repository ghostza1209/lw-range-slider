# Context

Glossary of terms for the lw-range-slider package.

## Range Slider

The Blade component this package provides: a noUiSlider wrapper bound to a
Livewire property via `wire:model`. Generic — not tied to any particular kind
of value (prices, dates, quantities).

## Price Range Changed (event)

The canonical name of the only event the package dispatches to the slider.
The name is **historical**: the package was extracted from a price-filter use
case, and the event name kept the original domain's vocabulary even though the
slider itself is generic. Decision (2026-06): keep the name through the 2.x
series to avoid a breaking change; a generic rename is a candidate for 3.0.

## Modifier

The `wire:model` update-timing variant chosen by the consumer: `live`, `blur`,
or `defer` (the default when no modifier is given).