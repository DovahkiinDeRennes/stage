document.addEventListener('DOMContentLoaded', function() {
    // Événement de clic pour chaque lien d'actualité
    var links = document.querySelectorAll('.lien-actualite');
    links.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du lien

            // Récupérer l'identifiant de la section ciblée par le lien
            var targetId = this.getAttribute('href').substring(1);
            var targetSection = document.getElementById(targetId);

            // Définir la nouvelle position de défilement en tenant compte de la hauteur de la navbar (en pixels)
            var navbarHeight = 1000; // Remplacez 100 par la hauteur de votre navbar en pixels
            var targetOffsetTop = targetSection.offsetTop - navbarHeight;

            // Définir la nouvelle position de défilement de la page
            window.scrollTo({
                top: targetOffsetTop,
                behavior: 'smooth' // Ajouter un défilement fluide
            });
        });
    });
});
