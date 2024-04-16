<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
$id = $_GET['id'];
$query = "SELECT * FROM actualite WHERE id= $id";
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
    $image_path = __DIR__ . '/../../images/actualites/' . $row['image'];
    // Vérifier si le fichier existe avant de le supprimer
    if (file_exists($image_path)) {
        unlink($image_path); // Supprimer le fichier
        // Ajoutez ici toute autre logique nécessaire, comme mettre à jour la base de données, etc.

    } else {
        echo "L'image n'existe pas ou a déjà été supprimée.";
    }
    // Affichage des images existantes avec une option de suppression
    if (mysqli_query($db, "DELETE FROM actualite WHERE id = $id")) {
        header("Location: actualites_creation.php");
        }

    $images_directory = __DIR__ . '/../../images/actualites/';
    $images = scandir($images_directory);

}





?>