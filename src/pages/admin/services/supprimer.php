<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/service.php');
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Vérifier si l'ID est défini
if ($id !== null) {
    // Créer une nouvelle instance de la classe Service
    $service = new service($db);

    // Supprimer le service et son image associée
    if ($service->delete($id)) {
        // Récupérer le chemin de l'image
        $image_path = __DIR__ . '/../../../../images/servicesetproduits/' . $row['image_url'];

        // Vérifier si le fichier image existe avant de le supprimer
        if (file_exists($image_path)) {
            unlink($image_path); // Supprimer le fichier image
        } else {
            echo "L'image n'existe pas ou a déjà été supprimée.";
        }

        // Rediriger l'utilisateur vers la page des services après la suppression
        header("Location: services.php");
        exit(); // Arrêter l'exécution du script après la redirection
    } else {
        echo "Une erreur s'est produite lors de la suppression du service.";
    }
} else {
    echo "ID de service non spécifié.";
}

