document.addEventListener('DOMContentLoaded', function() {

    const header = document.querySelectorAll('.main-header-lateral');

    header.forEach(header =>{

        //Adiciona clique nos itens de menu com filhos
        const itemWithChild = header.querySelectorAll('.menu .menu-item-has-children');

        itemWithChild.forEach(itemWithChild =>{
            const arrow = itemWithChild.querySelector('.submenu-toggle');
            arrow.addEventListener('click', function(ev){
                ev.preventDefault();
                if(itemWithChild.classList.contains('open')){
                    itemWithChild.classList.remove('open');
                    header.classList.remove('submenu-open');
                }
                else{
                    itemWithChild.classList.add('open');
                    header.classList.add('submenu-open');
                }
            })
        })

        //Adiciona clique no dropdown do seletor de idiomas para tablet e mobile
        const languageSelector = header.querySelectorAll('.wpml-language-switcher');

        languageSelector.forEach(languageSelector =>{
            const dropdown = languageSelector.querySelector('.wpml-ls-item-toggle');
            dropdown.addEventListener('click', function(e){
                e.preventDefault();
                if(languageSelector.classList.contains('open')){
                    languageSelector.classList.remove('open');
                }
                else{
                    languageSelector.classList.add('open');
                }
            })

        })
    })


});