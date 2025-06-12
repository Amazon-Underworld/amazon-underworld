document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal-form');
    const btnOpen = document.querySelectorAll('.open-form a');
    const btnClose = document.querySelector('.close-form');
    const header = document.querySelector('.main-header-lateral');

    if (!modal || btnOpen.length === 0 || !btnClose) {
        return;
    }

    function openModal() {
        modal.style.display = 'flex';
        header.style.zIndex = '0';
    }

    function closeModal() {
        modal.style.display = 'none';
        header.style.zIndex = '2';
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
