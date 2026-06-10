<?php

namespace YsZ\LwRangeSlider\Tests;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\ComponentAttributeBag;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase;
use YsZ\LwRangeSlider\Exceptions\RangeSliderException;
use YsZ\LwRangeSlider\LwRangeSlider;
use YsZ\LwRangeSlider\LwRangeSliderServiceProvider;

class SmokeTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            LwRangeSliderServiceProvider::class,
        ];
    }

    public function test_component_renders_with_wire_model(): void
    {
        $html = Blade::render(
            '<x-range-slider :options="[\'start\' => [20, 50]]" :min-val="0" :max-val="100" wire:model="sliderValues" />'
        );

        $this->assertStringContainsString('LivewireRangeSlider(', $html);
        $this->assertStringContainsString('"sliderValues"', $html);
        $this->assertStringContainsString('modifier: "defer"', $html);
    }

    public function test_live_modifier_is_detected(): void
    {
        $html = Blade::render(
            '<x-range-slider :options="[]" :min-val="0" :max-val="100" wire:model.live="sliderValues" />'
        );

        $this->assertStringContainsString('modifier: "live"', $html);
    }

    public function test_blur_modifier_is_detected(): void
    {
        $html = Blade::render(
            '<x-range-slider :options="[]" :min-val="0" :max-val="100" wire:model.blur="sliderValues" />'
        );

        $this->assertStringContainsString('modifier: "blur"', $html);
    }

    public function test_missing_wire_model_throws(): void
    {
        $component = new LwRangeSlider(minVal: 0, maxVal: 100);

        $this->expectException(RangeSliderException::class);

        $component->getWireModel(new ComponentAttributeBag([]));
    }

    public function test_scripts_component_inlines_bundled_js(): void
    {
        $html = Blade::render('<x-livewire-range-slider::scripts />');

        $this->assertStringContainsString('window.LivewireRangeSlider', $html);
    }
}
