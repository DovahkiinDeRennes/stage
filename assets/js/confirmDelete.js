document.addEventListener("DOMContentLoaded", function() {
    const deleteLinks = document.querySelectorAll(".adminDelete");

    deleteLinks.forEach(function(deleteLink) {
        deleteLink.addEventListener("click", function(event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien (redirection)

            if (confirm("Êtes-vous sûr de vouloir supprimer?")) {
                // Si l'utilisateur confirme, continuer avec le comportement du lien
                window.location.href = deleteLink.href;
            } else {
                // Si l'utilisateur annule, ne rien faire
            }
        });
    });
});


