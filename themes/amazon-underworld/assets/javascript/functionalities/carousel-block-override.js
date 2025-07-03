document.addEventListener('DOMContentLoaded', function () {
    const carousels = document.querySelectorAll('.wp-block-cb-carousel');

    carousels.forEach(function (carousel) {
        if (carousel.classList.contains('slick-initialized')) {
            jQuery(carousel).slick('unslick');
        }

        const slickSettings = JSON.parse(carousel.getAttribute('data-slick'));

        // Adiciona configurações responsivas
        slickSettings.responsive = [
            {
                breakpoint: 768, // Configurações para telas com largura menor ou igual a 768px
                settings: {
                    centerMode: true,
                    centerPadding: '16px',
                    slidesToShow: 1, // Exemplo: mostra 1 slide
                },
            },
            {
                breakpoint: 480, // Configurações para telas com largura menor ou igual a 480px
                settings: {
                    centerMode: true,
                    centerPadding: '30px',
                    slidesToShow: 1, // Exemplo: mostra 1 slide

                },
            },
        ];

        carousel.setAttribute('data-slick', JSON.stringify(slickSettings));
		jQuery(carousel).slick(slickSettings);

        if(carousel.classList.contains('cards-slider')){
            jQuery(carousel).slick('slickSetOption', {
                cssEase: 'linear',
                slidesToShow: 4.2,

            }, true);
        }

        if(carousel.classList.contains('logos-carousel')){
            jQuery(carousel).slick('slickSetOption', {
                speed: 5000,
                cssEase: 'linear',
                slidesToShow: 8.2,

            }, true);
        }

    });
});





