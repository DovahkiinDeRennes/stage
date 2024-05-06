<?php

include(__DIR__ . '/../core/connection.php');
include(__DIR__ . '/../../classes/Categorie.php');

// Créer une instance de la classe Categorie avec l'objet de connexion à la base de données
$categorie = new Categorie($db);

// Récupérer toutes les catégories
$categories = $categorie->getAllCategories();

$currentCategory = null;
echo "<center>";
echo "<table>";

foreach ($categories as $row) {
    if ($currentCategory !== $row['libelle']) {
        // Fermer la ligne précédente (si elle existe)
        if ($currentCategory !== null) {
            echo "</td></tr>";
        }

        // Afficher l'en-tête de la nouvelle catégorie
        echo "<tr><td colspan='4'><h2>" . htmlspecialchars($row['libelle']) . "</h2></td></tr>";

        // Mettre à jour la catégorie actuelle
        $currentCategory = $row['libelle'];
    }

    // Afficher les éléments de la catégorie
    echo "<tr><td><a href='/info.php?id=" . $row['id'] . "&amp;titre=" . htmlspecialchars($row['libelle']) . "'>" . htmlspecialchars($row['libelle']) . "</a></td>";

    // Boutons de modification et de suppression
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        echo "<td><a onclick='return confirmDelete();' href='supprimer.php?id=" . $row['id'] . "'><input type='button' value='Supprimer une catégorie'></a></td>";
        echo "<td><a href='modifier.php?id=" . $row['id'] . "'><input type='button'value='modifier une categorie'></a></td>";
        // Ajouter le lien pour afficher les services et produits associés
        echo "<td><a href='categorieWithServiceProduit.php?categorie_id=" . $row['id'] . "'>Voir la liste de tous les services et produits associés</a></td>";
    }
}

// Fermer la dernière ligne
if ($currentCategory !== null) {
    echo "</div></td></tr>";
}

echo "</table>";
echo "</center>";


