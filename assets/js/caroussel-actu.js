document.addEventListener('DOMContentLoaded', function() {
    let currentIndex = 0; // Indice de la diapositive actuelle
    const slides = document.querySelectorAll('.item');
    const interval = 3000; // Intervalle en millisecondes (3 secondes dans cet exemple)

    // Fonction pour afficher la prochaine diapositive
    function showNextSlide() {
        slides[currentIndex].style.display = 'none'; // Masquer la diapositive actuelle
        currentIndex = (currentIndex + 1) % slides.length; // Passer à la prochaine diapositive
        slides[currentIndex].style.display = 'block'; // Afficher la nouvelle diapositive
    }

    // Afficher la première diapositive au démarrage
    slides[currentIndex].style.display = 'block';

    // Démarrer le défilement automatique
    setInterval(showNextSlide, interval);
});
