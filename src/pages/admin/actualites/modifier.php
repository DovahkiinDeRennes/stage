<?php
session_start();
?>

<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/actualite.php');

$id = $_GET['id'];
// Requête pour afficher les infos d'un produit
$stmt = $db->prepare("SELECT * FROM actualite WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier que le bouton Modifier a bien été cliqué
if (isset($_POST['ok'])) {
    $titre =  $_POST['titre'] ?? '';
    $texte =  $_POST['texte'] ?? '';
    $alt =  $_POST['alt_text'] ??'';

    // Vérifier si un fichier a été uploadé
    if ($_FILES['image']['error'] == 0) {
        // Supprimer l'ancienne image
        $image_path = __DIR__ . '/../../../../images/actualites/' . $row['image'];
        if (file_exists($image_path)) {
            unlink($image_path); // Supprimer le fichier
        }

        // Charger la nouvelle image
        $img_name = $_FILES['image']['name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array(strtolower($img_ex), $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex;
            $img_upload_path = __DIR__ . '/../../../../images/actualites/' . $new_img_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $img_upload_path);
            $ytb_url = "non";
        } else {
            echo "Invalid file type. Allowed types: jpg, jpeg, png.";
            exit();
        }
    } else {
        // No new image uploaded, use the existing one
        $new_img_name = $row['image'];
    }

    // Vérifier s'il y a une URL YouTube
    if (!empty($_POST['lien-ytb'])) {
        $image_path = __DIR__ . '/../../../../images/actualites/' . $row['image'];
        if (file_exists($image_path)) {
            unlink($image_path); // Supprimer le fichier
        }

        $ytb_url = $_POST['lien-ytb'];
        $new_img_name = "non";


    } else {
        $ytb_url = "non";
    }

    // Effectuer la mise à jour
    $stmt = $db->prepare("UPDATE actualite SET titre = ?, texte = ?, image = ?, alt_text = ?, ytb_url = ? WHERE id = ?");
    $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $ytb_url, $id]);

    if ($success) {
        // Si la requête a été effectuée avec succès, redirection
        header("Location: actualites.php");
        exit();
    } else {
        // Sinon, produit non modifié
        $message = "Produit non modifié";
    }
}

include(__DIR__ . '/formulaireModifier.php');

