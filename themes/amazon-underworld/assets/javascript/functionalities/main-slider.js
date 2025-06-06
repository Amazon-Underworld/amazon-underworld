document.addEventListener('DOMContentLoaded', function() {

    const slider = document.querySelector('.wp-block-newspack-blocks-carousel.main-slider');

    const pagination = slider.querySelector('.swiper-pagination-bullets');
    const dots = pagination.querySelectorAll('button');

    console.log(dots[0]);

    const wrapper = slider.querySelector('.swiper-wrapper');
    const articles = wrapper.querySelectorAll('article');

    const arrayPosts = Array.prototype.slice.call(articles);
    const arrayDots = Array.prototype.slice.call(dots);

    articles.forEach(article =>{
        const indexPost = arrayPosts.indexOf(article);

        // console.log(article);
        //Pegar thumb e título
        const thumb = article.querySelector('.post-thumbnail img');
        const title = article.querySelector('.entry-title');
        const imageSrc = thumb.getAttribute('src');
        const width = thumb.getAttribute('width');
        const height = thumb.getAttribute('height');
        const alt = thumb.getAttribute('alt');

        const miniatura = document.createElement('img');
        miniatura.classList.add('dot-thumb');
        miniatura.setAttribute('src', imageSrc);
        miniatura.setAttribute('width', width);
        miniatura.setAttribute('height', height);
        miniatura.setAttribute('alt', alt);

        // console.log(miniatura);

        dots.forEach(dot =>{
            const indexDot = arrayDots.indexOf(dot);
            let html = dot.innerHTML;
            // console.log(dot);
            if(indexDot == indexPost){
                // addThumb(dot, miniatura);
                // let url = "url("
                // let href = String(imageSrc)
                // let end = ")"
                // dot.style.backgroundImage = url.concat(imageSrc, end);
                // console.log(dot.style.backgroundImage)
            }

        })
    })

    function addThumb(elem, fig){
        elem.appendChild(fig);
        // elem.innerHTML = fig ;
        console.log(elem);
        console.log(fig);
    }

});