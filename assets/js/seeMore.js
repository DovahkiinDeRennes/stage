$(document).ready(function() {
    // Fonction pour tronquer le texte et gérer le bouton "Lire plus"
    function truncateText() {
        $(".text-content").each(function() {
            var html = $(this).html().split(" ");
            var truncatedHtml = html.slice(0, 20).join(" ") + '<span class="dots">...</span><span class="full-text"> ' + html.slice(100).join(" ") + '</span>'; // Ajout d'un espace après les points de suspension
            $(this).html(truncatedHtml);
            $(this).find('.full-text').hide(); // Cacher le contenu complet
        });
    }

    // Appel de la fonction une fois au chargement de la page
    truncateText();

    // Gestion du clic sur le bouton "Lire plus" (utilisation du délégué d'événement)
    $(document).on('click', '.readmore-btn', function(event) {
        event.preventDefault();
        var fullText = $(this).siblings(".text-content").find(".full-text");
        var dots = $(this).siblings(".text-content").find(".dots");
        fullText.toggle(); // Afficher ou masquer le contenu complet
        dots.toggle(); // Afficher ou masquer les points de suspension
        $(this).html(fullText.is(":visible") ? 'Lire moins' : 'Lire plus');
    });

    // Réinitialiser le texte tronqué après l'ajout d'une nouvelle actualité
    $('#summernote').on('summernote.blur', function() {
        truncateText();
    });
});
