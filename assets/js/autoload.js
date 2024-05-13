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
        console.log (link.dataset.direction, link.dataset.serviceId);
        // Effectuer une requête GET vers changer_ordre2.php avec les données nécessaires
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `changer_ordre.php?direction=${direction}&service_id=${serviceId}`, true);
        console.log(`changer_ordre.php?direction=${direction}&service_id=${serviceId}`);
        xhr.onload = () => {
            if (xhr.status === 200) {
                // La requête a réussi
                console.log('Ordre changé avec succès');
                // Actualiser la page après 1 seconde pour voir les mises à jour
                setTimeout(() => {
                    location.reload();
                }, 500);
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