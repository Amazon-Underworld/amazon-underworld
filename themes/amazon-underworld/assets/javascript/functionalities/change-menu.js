document.addEventListener('DOMContentLoaded', function () {
    const primaryMenu = document.querySelector('.main-header-lateral__content:not(.main-header-lateral-secondary__content)');
    const secondaryMenu = document.querySelector('.main-header-lateral-secondary__content');

    if (!primaryMenu || !secondaryMenu) return;

    secondaryMenu.classList.remove('is-visible');
    primaryMenu.style.opacity = '1';

    function toggleMenus() {
      if (window.scrollY > 100) {
        primaryMenu.style.opacity = '0';
        secondaryMenu.classList.add('is-visible');
      } else {
        primaryMenu.style.opacity = '1';
        secondaryMenu.classList.remove('is-visible');
      }
    }

    window.addEventListener('scroll', toggleMenus);
  });