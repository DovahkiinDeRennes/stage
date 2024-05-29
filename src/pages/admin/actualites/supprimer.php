<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../services/ActualiteService.php');


require_once(__DIR__ . '/../../../../csp_config.php');


$id = $_GET['id'];

// Requête pour obtenir les informations de l'actualité
$stmt = $db->prepare("SELECT * FROM actualite WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $image_path = __DIR__ . '/../../../../images/actualites/' . $row['image'];

    // Vérifier si le fichier existe avant de le supprimer
    if (file_exists($image_path)) {
        unlink($image_path); // Supprimer le fichier
    }else {
        echo "L'image n'existe pas ou a déjà été supprimée.";
    }
        // Supprimer l'actualité de la base de données
    $actualiteService = new ActualiteService($db);
        if ($actualiteService->delete($id)) {
            header("Location: actualites.php");
            exit(); // Arrêter l'exécution du script après la redirection
        } else {
            echo "Erreur lors de la suppression de l'actualité dans la base de données.";
        }

} else {
    echo "Aucune actualité trouvée avec l'identifiant $id.";
}








