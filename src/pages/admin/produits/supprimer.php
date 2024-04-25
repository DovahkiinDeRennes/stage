<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/produit.php');

// Valider et filtrer l'ID du produit
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "ID de produit invalide";
    exit;
}

// Requête pour récupérer les informations du produit
$query = "SELECT * FROM produits WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "Produit non trouvé";
    exit;
}

$image_url = $row['image_url'];
$image_path = __DIR__ . '/../../../../images/servicesetproduits/' . $image_url;

if (!file_exists($image_path)) {
    echo "L'image n'existe pas ou a déjà été supprimée.";
    exit;
}

if (unlink($image_path)) {
    $produit = new produit($db);
    if ($produit->delete($id)) {
        header("Location: produits.php");
        exit;
    } else {
        echo "Erreur lors de la suppression du produit.";
        exit;
    }
} else {
    echo "Erreur lors de la suppression de l'image.";
    exit;
}
?>