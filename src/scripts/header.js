/* Логика для мобильного меню */
const mobileMenuButton = document.querySelector('.header__burger');
const mobileMenu = document.getElementById('mobile-menu');
const mobileOverlay = mobileMenu.querySelector('.mobile-menu__overlay');

mobileMenuButton.addEventListener('click', () => {
  mobileMenuButton.classList.toggle('is-active');
  mobileMenu.classList.toggle('mobile-menu--open');
});

mobileOverlay.addEventListener('click', () => {
  mobileMenuButton.classList.remove('is-active');
  mobileMenu.classList.remove('mobile-menu--open');
});
