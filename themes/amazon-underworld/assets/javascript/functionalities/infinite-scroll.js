document.addEventListener('DOMContentLoaded', () => {
    const postContainer = document.querySelector('.posts-grid__content');
    const trigger = document.querySelector('#infinite-scroll-trigger');

    if (!postContainer || !trigger) {
        return;
    }

    let currentPage = 2;
    let isLoading = false;
    const urlParams = new URLSearchParams(window.location.search);
    const filterTerm = urlParams.get('filter_term') || 'all';

    const loadMorePosts = async () => {
        if (isLoading) return;
        isLoading = true;
        trigger.classList.add('is-loading');

        const { ajaxUrl, nonce } = hl_infinite_scroll_data;

        const formData = new FormData();
        formData.append('action', 'load_more_posts');
        formData.append('nonce', nonce);
        formData.append('page', currentPage);
        formData.append('filter_term', filterTerm);

        try {
            const response = await fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();

            if (result.success) {
                postContainer.insertAdjacentHTML('beforeend', result.data.html);
                currentPage++;
                isLoading = false;
                trigger.classList.remove('is-loading');
            } else {
                observer.disconnect();
                trigger.remove();
            }
        } catch (error) {
            console.error('Erro ao carregar mais posts:', error);
            isLoading = false;
            trigger.classList.remove('is-loading');
        }
    };

    const observer = new IntersectionObserver(
        (entries) => {
            if (entries[0].isIntersecting) {
                loadMorePosts();
            }
        },
        { rootMargin: '600px' }
    );

    observer.observe(trigger);
});
