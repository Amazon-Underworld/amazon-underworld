import { waitUntil } from '../shared/wait';
import { __ } from '@wordpress/i18n';

document.addEventListener('DOMContentLoaded', function () {

    waitUntil(() => document.querySelector('.swiper-initialized'), () => {

        const slider = document.querySelector('.wp-block-newspack-blocks-carousel.main-slider');
        const pagination = slider.querySelector('.swiper-pagination-bullets');
        const wrapper = slider.querySelector('.swiper-wrapper');

        // Adiciona título à paginação
            const titlePagination = document.createElement('span');
            titlePagination.innerText = __( 'Most featured', 'hacklabr' );
            titlePagination.classList.add('most-featured');
            slider.appendChild(titlePagination);

        const articles = Array.from(wrapper.querySelectorAll('article'));


        function createThumbContent(article) {
            const thumb = article.querySelector('.post-thumbnail img');
            const title = article.querySelector('.entry-title a');

            if (!thumb || !title) return null;

            const imageSrc = thumb.getAttribute('src');
            const width = thumb.getAttribute('width');
            const height = thumb.getAttribute('height');
            const alt = thumb.getAttribute('alt');
            const textTitle = title.textContent;

            const img = document.createElement('img');
            img.className = 'dot-thumb';
            img.src = imageSrc;
            img.width = width;
            img.height = height;
            img.alt = alt;

            const p = document.createElement('p');
            p.className = 'dot-title';
            p.textContent = textTitle;

            return { img, p };
        }

        function applyDotsContent() {
            const dots = pagination.querySelectorAll('button');
            dots.forEach((dot, index) => {
                if (!dot.querySelector('img') && articles[index]) {
                    const content = createThumbContent(articles[index]);
                    if (content) {
                        dot.appendChild(content.img);
                        dot.appendChild(content.p);
                    }
                }
            });
        }

        // Aplicação inicial
        applyDotsContent();

        // Observer: reexecuta applyDotsContent sempre que os dots forem recriados
        const observer = new MutationObserver(() => {
            applyDotsContent();
        });

        observer.observe(pagination, { childList: true, subtree: true });

        // Cria botão Read More com o link da matéria
        const contentWrappers = wrapper.querySelectorAll('.entry-wrapper');
        contentWrappers.forEach(contentWrapper =>{
            const readMore = document.createElement('button');
            readMore.classList.add('read-more');


            const link = contentWrapper.querySelector('.entry-title a');
            const url = link.getAttribute('href');

            const buttonLink = document.createElement('a');
            buttonLink.setAttribute('href', url);
            readMore.appendChild(buttonLink);
            buttonLink.innerText = __( 'Read More', 'hacklabr' );

            contentWrapper.appendChild(readMore);

        });


    }, 50, 5000);

});
