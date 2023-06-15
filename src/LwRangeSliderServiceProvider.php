<?php

namespace YsZ\LwRangeSlider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class LwRangeSliderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-range-slider');

        Blade::component('range-slider', LwRangeSlider::class);

        View::composer('livewire-range-slider::components.scripts', function (\Illuminate\View\View $view) {
            $view->with('jsPath', __DIR__.'/../dist/lw-range-slider.js');
        });

        $this->publishes([
            __DIR__.'/../resources/views/components/lw-range-slider.blade.php' => resource_path('views/vendor/livewire-range-slider/components/lw-range-slider.blade.php'),
        ],'lw-range-slider-views');
    }
}
