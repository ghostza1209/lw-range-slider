import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';

/**
 * @type {string}
 */
const CHANGE_EVENT = 'change';

/**
 * @type {string}
 */
const LIVE_MODIFER = 'live';

/**
 * @type {string}
 */
const BLUR_MODIFIER = 'blur';

/**
 *
 * @type {string}
 */
const DEFER_MODIFIER = 'defer';

/**
 * @type {string}
 */
const PRICE_RANGE_CHANGED_EVENT = 'priceRangeChanged';

window.LivewireRangeSlider = function (data) {
    return {
        rangeSlider: null,
        models: null,
        modifier: LIVE_MODIFER,
        handleHistory: null,
        init() {
            Livewire.on(PRICE_RANGE_CHANGED_EVENT, ({min, max, minRange, maxRange}) => {
                this.rangeSlider.updateOptions({
                    range: {
                        min: minRange,
                        max: maxRange
                    },
                    start: [min, max],
                });
            })
            this.setup();
        },
        setup() {
            noUiSlider.create(this.$refs.range, {
                ...data.options
            })
            this.rangeSlider = this.$refs.range.noUiSlider;
            this.rangeSlider.on(CHANGE_EVENT,
                (values, handle) => this.handleUpdate(values, handle)
            );
        },
        handleUpdate(values, handle) {
            if (this.models && this.modifier !== BLUR_MODIFIER) {
                this.$wire.set(this.models, values, this.isDeferred());
            }
        },
        isBlur() {
            return this.modifier === BLUR_MODIFIER;
        },
        isDeferred() {
            return this.modifier === DEFER_MODIFIER;
        },
        setValue() {
            var model = this.models ?? false;

            if (this.isBlur() && model) {
                this.$wire.set(model, this.rangeSlider.get());
            }
        },
        ...data
    }
}
