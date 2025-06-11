document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal-our-methodology');
    const btnOpen = document.querySelectorAll('.open-our-methodology a');

    const btnClose = document.querySelector('.close-our-methodology');

    if (!modal || btnOpen.length === 0 || !btnClose) {
        return;
    }

    function openModal() {
        document.body.classList.add('modal-is-open');
        modal.style.display = 'flex';
    }

    function closeModal() {
        document.body.classList.remove('modal-is-open');
        modal.style.display = 'none';
    }

    btnOpen.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            openModal();
        });
    });

    btnClose.addEventListener('click', closeModal);

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

});
