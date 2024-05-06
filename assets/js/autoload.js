document.addEventListener("DOMContentLoaded", () => {
    // Récupérer tous les liens avec la classe 'change-order-link'
    const changeOrderLinks = document.querySelectorAll(".change-order-link");

    // Ajouter un gestionnaire d'événements à chaque lien
    changeOrderLinks.forEach(link => {
        link.addEventListener("click", event => {
            // Empêcher le comportement par défaut du lien
            event.preventDefault();

            // Récupérer la direction et l'ID du service depuis les attributs de données
            const direction = link.dataset.direction;
            const serviceId = link.dataset.serviceId;
            const produitId = link.dataset.produitId;

            // Effectuer une requête GET vers changer_ordre.php avec les données nécessaires
            fetch(`changer_ordre.php?direction=${direction}&service_id=${serviceId}&produit_id=${produitId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La requête a échoué');
                    }
                    // La requête a réussi
                    console.log('Ordre changé avec succès');
                    // Actualiser la page après 1 seconde pour voir les mises à jour
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                })
                .catch(error => {
                    // Gérer les erreurs de la requête
                    console.error(error.message);
                });

            // Restez au même endroit sur la page
            return false;
        });
    });
});