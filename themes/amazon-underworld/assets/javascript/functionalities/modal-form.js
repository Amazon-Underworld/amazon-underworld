document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal-form');
    const btnOpen = document.querySelectorAll('.open-form a');
    const btnClose = document.querySelector('.close-form');
    const header = document.querySelector('.main-header-lateral');
    const footer = document.querySelector('.main-footer');

    if (!modal || btnOpen.length === 0 || !btnClose) {
        return;
    }

    function openModal() {
        modal.style.zIndex = '1000';
        setTimeout(() => {
            if (header) {
                header.style.display = 'none';
            }
        }, 50);

        setTimeout(() => {
            if (footer) {
                footer.style.setProperty('display', 'none', 'important');
            }
        }, 50);

        setTimeout(() => {
            modal.style.display = 'flex';
        }, 200);
    }

    function closeModal() {
        if (header) {
            header.style.display = 'block';
        }
        if (footer) {
            footer.style.display = 'block';
        }
        modal.style.display = 'none';
        modal.style.zIndex = '99';
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
