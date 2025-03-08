// navigasi scroll
const navbar = document.getElementById('nav');
let lastScrollTop = 0;

window.addEventListener('scroll', () => {
  let scrollTop = window.scrollY;

  if (scrollTop > lastScrollTop) {
    // Scroll ke bawah
    navbar.classList.remove('mt-10'); // Hilangkan margin top
  } else {
    // Scroll ke atas
    navbar.classList.add('mt-10'); // Kembalikan margin top
  }
    
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Menghindari nilai scroll negatif
});