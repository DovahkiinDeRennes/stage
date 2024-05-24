window.addEventListener('DOMContentLoaded', function() {
    var urlParams = new URLSearchParams(window.location.search);
    var scrollAmount = urlParams.get('scroll');
    if (scrollAmount) {
        setTimeout(function() {
            var currentScrollPosition = window.scrollY; // Obtenez la position de défilement actuelle
            var targetScrollPosition = currentScrollPosition - 400; // Définissez la position cible en reculant de 400 pixels
            window.scrollTo(0, targetScrollPosition); // Défilez jusqu'à la position cible
        }, 0);
    }
});