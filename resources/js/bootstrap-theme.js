import * as bootstrap from 'bootstrap';

// Código para el toggle de light/dark mode
document.addEventListener('DOMContentLoaded', () => {
  const storedTheme = localStorage.getItem('theme') || 'auto';
  const html = document.documentElement;
  const themeButtons = document.querySelectorAll('[data-bs-theme-value]');

  const setTheme = (theme) => {
    html.setAttribute('data-bs-theme', theme === 'auto' ? 'light' : theme);
    localStorage.setItem('theme', theme);
  };

  themeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const theme = btn.getAttribute('data-bs-theme-value');
      setTheme(theme);
    });
  });

  setTheme(storedTheme);
});
