<?php
include(__DIR__ . '/../../core/connection.php');

require_once __DIR__ . '/../../../classes/service.php';

$service = new Service($db);

// Vérifie si une catégorie a été sélectionnée
if (isset($_GET['categorie_id'])) {
    $categorie_id = htmlspecialchars($_GET['categorie_id']);
    echo "Catégorie sélectionnée : " . $categorie_id;
    // ...


    // Récupère les services pour la catégorie spécifiée
    $query = "SELECT * FROM services WHERE categories = :categorie_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affiche les services correspondant à la catégorie sélectionnée
    foreach ($services as $service => $row) {
        echo "<br><tr><td><a href='/info.php?id=" . $row['id'] . "&amp;titre=" . htmlspecialchars($row['titre']) . "'>" . htmlspecialchars($row['titre']) . "</a></td></tr><br>";
    }
} else {
    // Si aucun paramètre 'categorie_id' n'est défini dans l'URL, affiche tous les services
    $query = "SELECT * FROM services";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affiche tous les services
    foreach ($services as $service => $row) {
        echo "<tr><td><a href='/info.php?id=" . $row['id'] . "&amp;titre=" . htmlspecialchars($row['titre']) . "'>" . htmlspecialchars($row['titre']) . "</a></td></tr>";
    }
}
?>
