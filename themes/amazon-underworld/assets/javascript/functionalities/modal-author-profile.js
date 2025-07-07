import { waitUntil } from '../shared/wait';

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

        function openModal(link){
            const url = getLocalizedAuthorUrl(link.getAttribute( 'href' ));

            modal.classList.add('open');
            iframe.classList.add('open');
            iframe.setAttribute('src', url);
            iframe.setAttribute('allowFullscreen', 'true');

            waitUntil(() =>  iframe.contentWindow.document.getElementById('modal-card-body'), () => {
                const closeButton = iframe.contentWindow.document.querySelectorAll('.close-modal');
                closeButton.forEach(closeBtn =>{
                    setTimeout(function(){
                        closeBtn.classList.add('open');
                    }, 1000);
                    closeBtn.addEventListener('click', (e) => {
                        if(closeBtn.classList.contains('open')){
                            closeBtn.classList.remove('open');
                        }
                        if(iframe.classList.contains('open')){
                            iframe.classList.remove('open');
                            iframe.setAttribute('src', 'about:blank');
                        }
                        if(modal.classList.contains('open')){
                            modal.classList.remove('open');
                        }

                    })
                })

              }, 50, 5_000)

        }

    }


});