<?php

include(__DIR__ . '/../core/connection.php');
include(__DIR__ . '/../../Classes/Categorie/Categorie.php');
// Créer une instance de la classe Categorie avec l'objet de connexion à la base de données
$categorie = new Categorie($db);

// Récupérer toutes les catégories
$categories = $categorie->getAllCategories();

$currentCategory = null;

foreach ($categories as $row) {
    if ($currentCategory !== $row['libelle']) {
        // Fermer la div précédente (si elle existe)
        if ($currentCategory !== null) {
            echo "</div>";
        }

        // Afficher l'en-tête de la nouvelle catégorie
        echo "<h2>" . htmlspecialchars($row['libelle']) . "</h2>";
        $currentCategory = $row['libelle'];

        // Ouvrir une nouvelle div pour la catégorie
        echo "<div class='categorie'>";
    }

    // Afficher les éléments de la catégorie
    echo "<a href='/info.php?id=" . $row['id'] . "&amp;titre=" . htmlspecialchars($row['libelle']) . "'>" . htmlspecialchars($row['libelle']) . "</a>";

    // Boutons de modification et de suppression
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        echo "<a onclick='return confirmDelete();' href='supprimer.php?id=" . $row['id'] . "'><input type='button' value='Supprimer une catégorie'></a>";
        echo "<a href='modifier.php?id=" . $row['id'] . "'><input type='button'value='modifier une categorie'></a>";
    }
}

// Fermer la dernière div
if ($currentCategory !== null) {
    echo "</div>";
}
?>
