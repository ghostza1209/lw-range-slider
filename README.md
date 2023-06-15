## Livewire Range Slider
<a href="https://packagist.org/packages/ysz/lw-range-slider"><img src="https://img.shields.io/packagist/v/ysz/lw-range-slider" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/ysz/lw-range-slider"><img src="https://img.shields.io/packagist/dt/ysz/lw-range-slider" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/ysz/lw-range-slider"><img src="https://img.shields.io/packagist/l/ysz/lw-range-slider" alt="License"></a>

#### Inspired by https://github.com/jantinnerezo/livewire-range-slider, Please check it out!

An effortless blade component, [noUiSlider](https://github.com/leongersen/noUiSlider), tailored for your [Livewire](https://github.com/livewire/livewire) Components.

### Installation

You can install the package via composer:
```bash
composer require ysz/lw-range-slider
```

Register the script component to template after the ``@livewireScripts``

```html
<html>
    <body>
        <!-- @livewireScripts -->

        <x-livewire-range-slider::scripts />
    </body>
</html>
```


### Requirements

This package is designed to be used in conjunction with [Livewire](https://laravel-livewire.com/) components. Please ensure that you exclusively utilize it within Livewire projects.

- PHP 7.4 or higher

- Laravel 8 and 9

- [Livewire](https://laravel-livewire.com/)

- [Alpine](https://alpinejs.dev)

- (included) [noUiSlider](https://github.com/leongersen/noUiSlider)


### How to use it!

Please add this properties inside your existing Livewire component.

```php
public $options = [
    'start' => [
        20,
        50
    ],
    'range' => [
        'min' =>  [1],
        'max' => [100]
    ],
    'connect' => true,
    'behaviour' => 'tap-drag',
    'tooltips' => true,
    'pips' => [
        'mode' => 'steps',
        'stepped' => true,
        'density' => 4
    ],
    ...
];

public array $sliderValues;
```

The `$options` property represents the [noUiSlider options](https://refreshless.com/nouislider/slider-options/) that you provide to the component. For additional details and configurations, please refer to [noUiSlider](https://refreshless.com/nouislider/)

The `$sliderValues` property is the model for the range slider values.


#### Livewire's default `wire:model` attribute

```html
<x-range-slider :options="$options" wire:model="sliderValues" />
```

### Deferred Updating

In cases where you don't need data updates to happen live, we have a `.defer` modifier that batches data updates with the next network request.

```html
<x-range-slider :options="$options" wire:model.defer="sliderValues" />
```

### Lazy Updating

You can also use `.lazy` modifier to update the data after the user has finished interacting with the slider.

```html
<x-range-slider :options="$options" wire:model.lazy="sliderValues" />
```

### Emitting events

To update the `start` or `range` values for noUiSlider, call the `firePriceRangeChangedEvent` method.

```php
<?php

namespace App\Http\Livewire;

use Livewire\Component;
use YsZ\LwRangeSlider\Contracts\CanFireEvents;

class AvailableUnits extends Component
{
    use CanFireEvents;
    
    public function updated($name, $value)
    {
        $this->firePriceRangeChangedEvent(min: 80, max: 150, minRange: 100, maxRange: 200);
    }
}
```

this will immediately update the `range` and `start` values for noUiSlider.


### Customizing the slider

You can publish these blade file to `resources/views/vendor/livewire-range-slider` and customize it.

```bash
php artisan vendor:publish --tag=lw-range-slider-views
```
To customize the noUiSlider options from the published file, as certain options cannot be passed from the Livewire component due to them not being valid JSON when used as a callback function.

```html
<div
    x-data='LivewireRangeSlider({
        options: {
            start: [{{ $this->minPrice }}, {{ $this->maxPrice }}],
            connect: true,
            tooltips: true,
            tooltips: {
                to: function (value) {
                    return window?.currencyFormat("site", value);
                },
                from: function (value) {
                    return window?.currencyFormat("site", value);
                }
            },
            range: {
                min: {{ $this->minPrice }},
                max: {{ $this->maxPrice }}
            }
        },
        models: {!! json_encode($getWireModel($attributes)) !!},
        modifier: "{{ $getWireModelModifier($attributes) }}"
    })'
    @focusout="setValue"
    {{ $attributes }}
    wire:ignore
>
    <div x-ref="range"></div>
    {{ $slot }}
</div>
```
