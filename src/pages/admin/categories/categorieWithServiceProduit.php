<?php
include(__DIR__ . '/../../core/connection.php');

// Vérifie si un ID de catégorie est passé dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Récupération des produits associés à la catégorie
    $query_products = "SELECT produits.id, produits.titre FROM produits 
                        INNER JOIN categorie AS cat_produits ON produits.categories = cat_produits.id 
                        WHERE cat_produits.id = :id";
    $stmt_products = $db->prepare($query_products);
    $stmt_products->bindParam(':id', $id, PDO::PARAM_INT); // Utilisation de $id ici
    $stmt_products->execute();
    $products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);

    // Récupération des services associés à la catégorie
    $query_services = "SELECT services.id, services.titre FROM services 
                        INNER JOIN categorie AS cat_services ON services.categories = cat_services.id 
                        WHERE cat_services.id = :id";
    $stmt_services = $db->prepare($query_services);
    $stmt_services->bindParam(':id', $id, PDO::PARAM_INT); // Utilisation de $id ici
    $stmt_services->execute();
    $services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);

    // Affichage des produits et services
    echo "<h2>Produits :</h2>";
    echo "<ul>";
    foreach ($products as $product) {
        echo "<li>{$product['titre']}</li>";
    }
    echo "</ul>";

    echo "<h2>Services :</h2>";
    echo "<ul>";
    foreach ($services as $service) {
        echo "<li>{$service['titre']}</li>";
    }
    echo "</ul>";
} else {
    echo "Sélectionnez une catégorie pour afficher les produits et services associés.";
}
?>