document.addEventListener("DOMContentLoaded", function() {
    // Récupérer tous les liens avec la classe 'change-order-link'
    var changeOrderLinks = document.querySelectorAll(".change-order-link");

    // Ajouter un gestionnaire d'événements à chaque lien
    changeOrderLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            // Empêcher le comportement par défaut du lien
            event.preventDefault();

            // Récupérer la direction et l'ID du service depuis les attributs de données
            var direction = this.getAttribute("data-direction");
            var serviceId = this.getAttribute("data-service-id");

            // Effectuer une requête GET vers changer_ordre.php avec les données nécessaires
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'changer_ordre.php?direction=' + direction + '&service_id=' + serviceId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // La requête a réussi
                    console.log('Ordre changé avec succès');
                    // Actualiser la page après 1 seconde pour voir les mises à jour
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    // La requête a échoué
                    console.error('La requête a échoué');
                }
            };
            xhr.send();

            // Restez au même endroit sur la page
            return false;
        });
    });
});