document.addEventListener("DOMContentLoaded", () => {
    const COLOR_TRACK = "#CBD5E1";
    const COLOR_RANGE = "#0F97AA";

    // Get the sliders and tooltips
    const fromSlider = document.querySelector(
        ".widget_item_1 .dropdown-menu #fromSlider"
    );
    const toSlider = document.querySelector(
        ".widget_item_1 .dropdown-menu #toSlider"
    );
    const fromTooltip = document.querySelector(
        ".widget_item_1 .dropdown-menu #fromSliderTooltip"
    );
    const toTooltip = document.querySelector(
        ".widget_item_1 .dropdown-menu #toSliderTooltip"
    );
    // const scale = document.querySelector('.widget_item_1 .dropdown-menu #scale');

    // Get min and max values from the fromSlider element
    const MIN = parseInt(fromSlider.getAttribute("min")); // scale will start from min value (first range slider)
    const MAX = parseInt(fromSlider.getAttribute("max")); // scale will end at max value (first range slider)
    // const STEPS = parseInt(scale.dataset.steps); // update the data-steps attribute value to change the scale points

    function controlFromSlider(fromSlider, toSlider, fromTooltip, toTooltip) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, COLOR_TRACK, COLOR_RANGE, toSlider);
        if (from > to) {
            fromSlider.value = to;
        }
        setTooltip(fromSlider, fromTooltip);
    }

    function controlToSlider(fromSlider, toSlider, fromTooltip, toTooltip) {
        const [from, to] = getParsed(fromSlider, toSlider);
        fillSlider(fromSlider, toSlider, COLOR_TRACK, COLOR_RANGE, toSlider);
        setToggleAccessible(toSlider);
        if (from <= to) {
            toSlider.value = to;
        } else {
            toSlider.value = from;
        }
        setTooltip(toSlider, toTooltip);
    }

    function getParsed(currentFrom, currentTo) {
        const from = parseInt(currentFrom.value, 10);
        const to = parseInt(currentTo.value, 10);
        return [from, to];
    }

    function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
        const rangeDistance = to.max - to.min;
        const fromPosition = from.value - to.min;
        const toPosition = to.value - to.min;
        controlSlider.style.background = `linear-gradient(
        to right,
        ${sliderColor} 0%,
        ${sliderColor} ${(fromPosition / rangeDistance) * 100}%,
        ${rangeColor} ${(fromPosition / rangeDistance) * 100}%,
        ${rangeColor} ${(toPosition / rangeDistance) * 100}%, 
        ${sliderColor} ${(toPosition / rangeDistance) * 100}%, 
        ${sliderColor} 100%)`;
    }

    function setToggleAccessible(currentTarget) {
        const toSlider = document.querySelector("#toSlider");
        if (Number(currentTarget.value) <= 0) {
            toSlider.style.zIndex = 2;
        } else {
            toSlider.style.zIndex = 0;
        }
    }

    function setTooltip(slider, tooltip) {
        const value = slider.value;
        tooltip.textContent = `${value} ngày`;
        const thumbPosition = (value - slider.min) / (slider.max - slider.min);
        const percent = thumbPosition * 100;
        const markerWidth = 20; // Width of the marker in pixels
        const offset = (((percent - 50) / 50) * markerWidth) / 2;
        tooltip.style.left = `calc(${percent}% - ${offset}px)`;
    }

    function createScale(min, max, step) {
        const range = max - min;
        const steps = range / step;
        for (let i = 0; i <= steps; i++) {
            const value = min + i * step;
            const percent = ((value - min) / range) * 100;
            const marker = document.createElement("div");
            marker.style.left = `${percent}%`;
            marker.textContent = `$${value}`;
        }
    }

    // events
    fromSlider.oninput = () =>
        controlFromSlider(fromSlider, toSlider, fromTooltip, toTooltip);
    toSlider.oninput = () =>
        controlToSlider(fromSlider, toSlider, fromTooltip, toTooltip);

    // Initial load
    fillSlider(fromSlider, toSlider, COLOR_TRACK, COLOR_RANGE, toSlider);
    setToggleAccessible(toSlider);
    setTooltip(fromSlider, fromTooltip);
    setTooltip(toSlider, toTooltip);
});
