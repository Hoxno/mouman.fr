import './bootstrap';

import Alpine from 'alpinejs';
import ScrollReveal from 'scrollreveal';

window.Alpine = Alpine;

Alpine.start();



// Cette fonction sélectionne tous les liens <a> dont l'attribut href commence par '#'
// Elle ajoute un gestionnaire d'événement click à chaque lien pour permettre le défilement fluide
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien (le défilement brusque vers l'ancre)

        // Récupère l'identifiant de l'élément cible à partir de l'attribut href du lien
        const targetId = this.getAttribute('href').substring(1);

        // Recherche l'élément cible dans le document par son identifiant
        const targetElement = document.getElementById(targetId);

        // Vérifie si l'élément cible existe dans le DOM
        if (targetElement) {
            // Obtient la position verticale de l'élément cible par rapport au haut de la page
            const offsetTop = targetElement.offsetTop;

            // Effectue un défilement fluide vers l'élément cible en utilisant window.scrollTo()
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth' // Défilement fluide avec une animation douce
            });
        }
    });
});


var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {

    // Change l'icone dans le bouton
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
    
});

// start: Sidebar
const sidebarToggle = document.querySelector('.sidebar-toggle')
const sidebarOverlay = document.querySelector('.sidebar-overlay')
const sidebarMenu = document.querySelector('.sidebar-menu')
const main = document.querySelector('.main')
sidebarToggle.addEventListener('click', function (e) {
    e.preventDefault()
    main.classList.toggle('active')
    sidebarOverlay.classList.toggle('hidden')
    sidebarMenu.classList.toggle('-translate-x-full')
})
sidebarOverlay.addEventListener('click', function (e) {
    e.preventDefault()
    main.classList.add('active')
    sidebarOverlay.classList.add('hidden')
    sidebarMenu.classList.add('-translate-x-full')
})
document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault()
        const parent = item.closest('.group')
        if (parent.classList.contains('selected')) {
            parent.classList.remove('selected')
        } else {
            document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                i.closest('.group').classList.remove('selected')
            })
            parent.classList.add('selected')
        }
    })
})
// end: Sidebar

/*===== SCROLL REVEAL ANIMATION =====*/
const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2000,
    delay: 200,
//     reset: true
});

sr.reveal('#about__img, #skills__title, #skills__subtitle , #skills__description',{}); 
sr.reveal('#about, #about__description',{delay: 400}); 
sr.reveal('#skills__data, #contact__input',{interval: 200});
sr.reveal('#work, #school,#contact',{interval: 200});

// Ajoutez un événement de clic au bouton de fermeture
document.getElementById('close-flash-message').addEventListener('click', function() {
    // Cachez l'élément flash message en utilisant la propriété style.display
    document.getElementById('flash-message').style.display = 'none';
  });