<?php
include(__DIR__ . '/../../core/connection.php');

require_once __DIR__ . '/../../../classes/service.php';

require_once __DIR__ . '/../../../classes/produit.php';
include(__DIR__ . '/../../../../admin/check_login.php');

require_once(__DIR__ . '/../../../../csp_config.php');

include(__DIR__ . '/../../admin/navbar.php');
$service = new Service($db);



// Vérifie si une catégorie a été sélectionnée
if (isset($_GET['categorie_id'])) {
    $categorie_id = htmlspecialchars($_GET['categorie_id']);

    $query = "SELECT * FROM services WHERE categories = :categorie_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $nombreElement = count($services);

    echo "Catégorie sélectionnée (Services) : " . $nombreElement;
    // ...


    // Récupère les services pour la catégorie spécifiée


    // Affiche les services correspondant à la catégorie sélectionnée
    foreach ($services as  $row) {
        echo "<br><tr><td><a href='/info.php?id=" . $row['id'] . "&amp;titre=" . htmlspecialchars($row['titre']) . "'>" . htmlspecialchars($row['titre']) . "</a></td></tr><br>";
    }
} else {
    // Si aucun paramètre 'categorie_id' n'est défini dans l'URL, affiche tous les services
    $query = "SELECT * FROM services";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affiche tous les services
    foreach ($services as  $row) {
        echo "<tr><td><a href='/info.php?id=" . $row['id'] . "&amp;titre=" . htmlspecialchars($row['titre']) . "'>" . htmlspecialchars($row['titre']) . "</a></td></tr>";
    }
}
$produit = new produit($db);

// Vérifie si une catégorie a été sélectionnée
if (isset($_GET['categorie_id'])) {
    $categorie_id = htmlspecialchars($_GET['categorie_id']);

    $query = "SELECT * FROM produits WHERE categories = :categorie_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $nombreElement = count($produits);

    echo "Catégorie sélectionnée (Produits) : " . $nombreElement;
    // ...


    // Récupère les services pour la catégorie spécifiée


    // Affiche les services correspondant à la catégorie sélectionnée
    foreach ($produits as  $row) {
        echo "<br><tr><td><a href='/info.php?id=" . $row['id'] . "&amp;titre=" . htmlspecialchars($row['titre']) . "'>" . htmlspecialchars($row['titre']) . "</a></td></tr><br>";
    }
} else {
    // Si aucun paramètre 'categorie_id' n'est défini dans l'URL, affiche tous les services
    $query = "SELECT * FROM produits";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affiche tous les services
    foreach ($produits as  $row) {
        echo "<tr><td><a href='/info.php?id=" . $row['id'] . "&amp;titre=" . htmlspecialchars($row['titre']) . "'>" . htmlspecialchars($row['titre']) . "</a></td></tr>";
    }
}
?>
