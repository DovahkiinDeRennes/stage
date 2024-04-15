<?php

global $db;
$query = "SELECT categorie.* FROM categorie";
$result = $db->query($query);

$currentCategory = null;

while ($row = $result->fetch_assoc()) {
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

    // Fermer la div de la catégorie
    echo "</div>";
}

// Fermer la dernière div
if ($currentCategory !== null) {
    echo "</div>";
}

$result->close();
?>
