document.addEventListener('DOMContentLoaded', function () {
    const carousels = document.querySelectorAll('.wp-block-cb-carousel');

    carousels.forEach(function (carousel) {
        if (carousel.classList.contains('slick-initialized')) {
            jQuery(carousel).slick('unslick');
        }

        const slickSettings = JSON.parse(carousel.getAttribute('data-slick'));

        carousel.setAttribute('data-slick', JSON.stringify(slickSettings));
		jQuery(carousel).slick(slickSettings);

        if(carousel.classList.contains('cards-slider')){
            jQuery(carousel).slick('slickSetOption', {
                cssEase: 'linear',
                slidesToShow: 4.2,
                variableWidth: true,
				responsive: [
					{
						breakpoint: 1440,
						settings: {
							slidesToShow: 4,
						}
					},
                    {
                        breakpoint: 1356,
						settings: {
							slidesToShow: 3.5,
						}
                    },
                    {
                        breakpoint: 768,
						settings: {
							slidesToShow: 1,
                            centerMode: true,
						}
                    }

				]

            }, true);
        }

        if(carousel.classList.contains('logos-carousel')){
            jQuery(carousel).slick('slickSetOption', {
                speed: 5000,
                cssEase: 'linear',
                slidesToShow: 7.2,

            }, true);
        }

    });
});





