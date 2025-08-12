import { tns } from 'tiny-slider';
import 'tiny-slider/dist/tiny-slider.css';

document.addEventListener('DOMContentLoaded', function () {
    const sliderElements = document.querySelectorAll('.amazon-tiny-slider-container');

    sliderElements.forEach(sliderEl => {
        const blockWrapper = sliderEl.closest('.wp-block-hacklabr-amazon-slider');

        let prevButton = null;
        let nextButton = null;

        let sliderOptions = {
            container: sliderEl,
            items: 1,
            slideBy: 'page',
            mouseDrag: true,
            loop: false,
            controls: true,
            nav: false,
            gutter: 15,
            responsive: {
                640: { items: 2, gutter: 20 },
                1024: { items: 3, gutter: 30 }
            }
        };

        if (blockWrapper) {
            const desktopItems = parseInt(sliderEl.dataset.slidesDesktop, 10);
            const tabletItems = parseInt(sliderEl.dataset.slidesTablet, 10);
            const mobileItems = parseInt(sliderEl.dataset.slidesMobile, 10);
            const loop = sliderEl.dataset.loop === 'true';

            sliderOptions.loop = loop;
            sliderOptions.items = mobileItems || 1;
            if (sliderOptions.responsive && sliderOptions.responsive[1024]) {
                sliderOptions.responsive[1024].items = desktopItems || (sliderOptions.responsive[1024].items || 3);
            }
            if (sliderOptions.responsive && sliderOptions.responsive[640]) {
                sliderOptions.responsive[640].items = tabletItems || (sliderOptions.responsive[640].items || 2);
            }

            prevButton = blockWrapper.querySelector('.amazon-slider-prev');
            nextButton = blockWrapper.querySelector('.amazon-slider-next');
        }

        if (prevButton && nextButton) {
            sliderOptions.prevButton = prevButton;
            sliderOptions.nextButton = nextButton;
        } else {
            console.warn('Amazon Slider: Custom prev/next buttons not found. Using default tiny-slider controls (if enabled).');
            sliderOptions.controlsText = ['‹', '›'];
        }

        if (typeof tns === 'undefined') {
            console.error('FATAL: tns (tiny-slider) function is not defined! Ensure tiny-slider JS is loaded.');
            return;
        }

        try {
            const sliderInstance = tns(sliderOptions);
        } catch (e) {
            console.error("Error initializing Tiny Slider for amazon-slider:", e, sliderEl);
        }
    });
});