<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/actualite.php');

$id = $_GET['id'];


$actualite = new actualite($db);


if ($actualite->delete($id)) {

    $result = mysqli_query($db, "SELECT image FROM actualite WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $image_name = $row['image'];


    $image_path = __DIR__ . '/../../../../images/actualites/' . $image_name;


    if (file_exists($image_path)) {
        unlink($image_path);
    } else {
        echo "L'image n'existe pas ou a déjà été supprimée.";
    }


    header("Location: actualites.php");


    $images_directory = __DIR__ . '/../../../../images/actualites/';
    $images = scandir($images_directory);
    echo "Images restantes :";
    foreach ($images as $image) {
        if (!in_array($image, array(".", ".."))) {
            echo "<img src='/../../../../images/actualites/$image' width='100px'>";
        }
    }
} else {
    echo "Erreur lors de la suppression de l'actualité.";
}
?>


