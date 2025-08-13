import { until } from '../shared/wait';

document.addEventListener('DOMContentLoaded', function() {

    const cards = document.querySelectorAll('.wp-block-newspack-blocks-author-profile');
    const seeBio = document.querySelectorAll('.see-bio');

    if(cards){
        const modal = document.querySelector('#author-modal');
        const iframe = document.createElement('iframe');
        iframe.classList.add('modal-author');
        modal.appendChild(iframe);

        cards.forEach((card) =>{
            const links = card.querySelectorAll('a');

            links.forEach((link) =>{
                link.addEventListener('click', (e) =>{
                    e.preventDefault();
                    openModal(link);

                })
            })

        })

        seeBio.forEach((bio) =>{
            const links = bio.querySelectorAll('a');

            links.forEach((link) =>{
                link.addEventListener('click', (e) =>{
                    e.preventDefault();
                    openModal(link);

                })
            })

        })


        function getLocalizedAuthorUrl(originalUrl){
            const locale = globalThis.hl_modal_author_profile_data.locale;
            if(locale === 'en'){
                return originalUrl;
            }
            else{
                const parsedUrl = new URL(originalUrl);
                parsedUrl.pathname = '/' + locale + parsedUrl.pathname;
                return parsedUrl.toString();
            }
        }

        async function openModal(link){
            const url = getLocalizedAuthorUrl(link.getAttribute( 'href' ));

            modal.classList.add('open');
            iframe.classList.add('open');
            iframe.setAttribute('src', url);
            iframe.setAttribute('allowFullscreen', 'true');

            const [app, card, closeButton] = await Promise.all([
                until(() =>  iframe.contentWindow.document.getElementById('app')),
                until(() =>  iframe.contentWindow.document.getElementById('card-modal')),
                until(() =>  iframe.contentWindow.document.querySelector('.close-modal'))
            ])

            closeButton.classList.add('open');
            closeButton.addEventListener('click', (e) => {
                closeButton.classList.toggle('open', false);
                iframe.classList.toggle('open', false);
                iframe.setAttribute('src', 'about:blank');
                modal.classList.toggle('open', false);

            })

            app.style.display = 'none';
            card.style.display = 'block';

        }

    }


});