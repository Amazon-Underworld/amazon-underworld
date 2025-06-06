import { waitUntil } from '../shared/wait';

document.addEventListener('DOMContentLoaded', function() {

    waitUntil(() => document.querySelector('.swiper-initialized'), () => {

        const slider = document.querySelector('.wp-block-newspack-blocks-carousel.main-slider');

        const pagination = slider.querySelector('.swiper-pagination-bullets');
        const dots = pagination.querySelectorAll('button');

        const wrapper = slider.querySelector('.swiper-wrapper');
        const articles = wrapper.querySelectorAll('article');

        const arrayPosts = Array.prototype.slice.call(articles);
        const arrayDots = Array.prototype.slice.call(dots);

        articles.forEach(article =>{
            const indexPost = arrayPosts.indexOf(article);

            const thumb = article.querySelector('.post-thumbnail img');
            const title = article.querySelector('.entry-title a');
            const imageSrc = thumb.getAttribute('src');
            const width = thumb.getAttribute('width');
            const height = thumb.getAttribute('height');
            const alt = thumb.getAttribute('alt');

            const textTitle = title.innerHTML;
            const minTitle = document.createElement('p');
            minTitle.innerText = textTitle;
            minTitle.classList.add('dot-title');

            const miniatura = document.createElement('img');
            miniatura.classList.add('dot-thumb');
            miniatura.setAttribute('src', imageSrc);
            miniatura.setAttribute('width', width);
            miniatura.setAttribute('height', height);
            miniatura.setAttribute('alt', alt);

            dots.forEach(dot =>{
                const indexDot = arrayDots.indexOf(dot);
                if(indexDot == indexPost){
                    addThumb(dot, miniatura, minTitle);
                }

            })
        })

    }, 50, 5_000)

    function addThumb(elem, fig, text){
        elem.appendChild(fig);
        elem.appendChild(text);
    }

});