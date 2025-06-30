document.addEventListener('DOMContentLoaded', function () {
    const primaryMenu = document.querySelector('.main-header-lateral__content:not(.main-header-lateral-secondary__content)');
    const secondaryMenu = document.querySelector('.main-header-lateral-secondary__content');

    if (secondaryMenu) {
      secondaryMenu.style.display = 'none';
    }

    function toggleMenus() {
      if (window.scrollY > 100) {
        if (primaryMenu) primaryMenu.style.display = 'none';
        if (secondaryMenu) secondaryMenu.style.display = 'flex';
      } else {
        if (primaryMenu) primaryMenu.style.display = 'flex';
        if (secondaryMenu) secondaryMenu.style.display = 'none';
      }
    }

    window.addEventListener('scroll', toggleMenus);
  });