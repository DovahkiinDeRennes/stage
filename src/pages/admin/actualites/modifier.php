<?php
session_start();
?>

<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/actualite.php');

// On récupère l'ID dans le lien
$id = $_GET['id'];
// Requête pour afficher les infos d'un produit
$req = mysqli_query($db, "SELECT * FROM actualite WHERE id = $id");
$row = mysqli_fetch_assoc($req);

// Vérifier que le bouton Modifier a bien été cliqué
if (isset($_POST['ok'])) {
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $texte = isset($_POST['texte']) ? $_POST['texte'] : '';
    $alt = isset($_POST['alt_text']) ? $_POST['alt_text'] : '';

    // Vérifier si un fichier a été uploadé
    if ($_FILES['image']['error'] == 0) {
        $id = $_GET['id'];
        $query = "SELECT * FROM actualite WHERE id= $id";
        $result = $db->query($query);
        while ($row = $result->fetch_assoc()) {
            $image_path = __DIR__ . '/../../../../images/actualites/' . $row['image'];
            echo $image_path;
            // Vérifier si le fichier existe avant de le supprimer
            if (file_exists($image_path)) {
                unlink($image_path); // Supprimer le fichier
            } else {
                echo "L'image n'existe pas ou a déjà été supprimée.";
            }
            // Affichage des images existantes avec une option de suppression

            $images_directory = __DIR__ . '/../../../../images/actualites/';
            $images = scandir($images_directory);

        }
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = __DIR__ . '/../../../../images/actualites/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
            $ytb_url = "non";
        } else {
            echo "Invalid file type. Allowed types: jpg, jpeg, png.";
            exit();
        }
    } else {
        // No new image uploaded, use the existing one
        $new_img_name = $row['image'];
    }
    if (!empty($_POST['lien-ytb'])) {
        $ytb_url = $_POST['lien-ytb'];
        $new_img_name = "non";
    } else {
        $ytb_url = "non";
    }

    $actualite = new actualite($db);
    $actualite->update($id,$titre, $texte, $alt, $new_img_name, $ytb_url);
    // Requête de modification


    if ($req) {
        // Si la requête a été effectuée avec succès, redirection
        // header("location: actualites_creation.php");
        echo "<script>window.location.href = 'actualites.php';</script>";
    } else {
        // Sinon, produit non modifié
        $message = "Produit non modifié";
    }
}
include(__DIR__ . '/formulaireModifier.php');
?>

