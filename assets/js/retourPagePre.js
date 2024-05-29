
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne l'élément parent par son id
    var parentElement = document.getElementById("lienRetour");

    // Crée l'élément <a>
    var a = document.createElement("a");

    // Définis ses attributs
    a.href = "javascript:void(0);";
    a.className = "button";
    a.onclick = function() {
        history.back();
    };

    // Définis le texte du lien
    a.textContent = "Retour à la page précédente";

    // Ajoute l'élément <a> à l'élément parent
    parentElement.appendChild(a);
});