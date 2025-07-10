/**
 * Controla o comportamento de abrir/fechar o menu de filtros em telas mobile.
 */
document.addEventListener('DOMContentLoaded', function() {
    const filterContainer = document.querySelector('.filter-posts');
    if (!filterContainer) return;

    const toggleButton = filterContainer.querySelector('.filter-posts__toggle');
    if (!toggleButton) return;

    const buttonTextSpan = toggleButton.querySelector('.filter-by');
    if (!buttonTextSpan) return;

    let previousButtonText = '';
    let previousButtonClasses = '';

    toggleButton.addEventListener('click', function() {
        const isOpening = !filterContainer.classList.contains('is-open');

        if (isOpening) {
            previousButtonText = buttonTextSpan.textContent;
            previousButtonClasses = toggleButton.className;

            buttonTextSpan.textContent = 'Close';
            toggleButton.className = 'filter-posts__toggle is-close-btn';

        } else {
            buttonTextSpan.textContent = previousButtonText;
            toggleButton.className = previousButtonClasses;
        }

        filterContainer.classList.toggle('is-open');
    });
});
