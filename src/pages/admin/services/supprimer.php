<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/service.php');

$id = $_GET['id'];
$query = "SELECT * FROM services WHERE id= $id";
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
    $image_path = __DIR__ . '/../../../../images/servicesetproduits/' . $row['image_url'];
    // Vérifier si le fichier existe avant de le supprimer
    $service = new service($db);
    if (file_exists($image_path)) {
        unlink($image_path); // Supprimer le fichier
        // Ajoutez ici toute autre logique nécessaire, comme mettre à jour la base de données, etc.
        if ($service->delete($id)) {
            header("Location: services.php");
        }
    } else {
        echo "L'image n'existe pas ou a déjà été supprimée.";
    }
    // Affichage des images existantes avec une option de suppression

    $images_directory = __DIR__ . '/../../../../images/servicesetproduits/';
    $images = scandir($images_directory);

}
?>