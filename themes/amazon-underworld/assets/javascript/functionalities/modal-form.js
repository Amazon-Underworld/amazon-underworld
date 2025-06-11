document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal-form');
    const btnOpen = document.querySelectorAll('.open-form a');
    console.log(btnOpen)
    const btnClose = document.querySelector('.close-form');

    if (!modal || btnOpen.length === 0 || !btnClose) {
        return;
    }

    function openModal() {
        modal.style.display = 'flex';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    btnOpen.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            console.log(button);
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
