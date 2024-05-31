<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/service.php');
require_once(__DIR__ . '/../../../../csp_config.php');

// Valider et filtrer l'ID du service
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "ID de service invalide";

    exit;
}

// Requête pour récupérer les informations du service
$query = "SELECT * FROM services WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "Service non trouvé";
    exit;
}

$image_url = $row['image_url'];

$image_path = __DIR__ . '/../../../../images/servicesetproduits/' . $image_url;

if (!file_exists($image_path)) {
    echo "L'image n'existe pas ou a déjà été supprimée.";
    exit;
}

if (unlink($image_path)) {
    $service = new Service($db);
    if ($service->delete($id)) {
        header("Location: services.php");
        exit;
    } else {
        echo "Aucun Service à été supprimé.";
        exit;
    }
} else {
    echo "Erreur lors de la suppression de l'image.";
    exit;
}
?>