document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal-form');
    const btnOpen = document.querySelectorAll('.open-form a');
    const btnClose = document.querySelector('.close-form');
    const header = document.querySelector('.main-header-lateral');

    if (!modal || btnOpen.length === 0 || !btnClose) {
        return;
    }

    function openModal() {
        console.log('clicou no botao open');
        header.style.zIndex = '0';
        setTimeout(()=>{
            modal.style.display = 'flex';
        }, 200);
    }

    function closeModal() {
        header.style.zIndex = '2';
        modal.style.display = 'none';
    }

    btnOpen.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            openModal();
        });
    });

    btnClose.addEventListener('click', closeModal);

    window.addEventListener('click', function (event) {
        if (!event.target.closest('.wp-block-column')) {
            if (!event.target.closest('.close-form')) {
                closeModal();
            }
        }
    });

});
