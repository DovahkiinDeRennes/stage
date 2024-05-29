<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../../classes/service.php');
require_once(__DIR__ . '/../../../../csp_config.php');
?>
<?php

include(__DIR__ . '/../../core/connection.php');


// On récupère l'ID dans le lien
$id = $_GET['id'];
// Requête pour afficher les infos d'un produit
$stmt = $db->prepare("SELECT * FROM services WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$query = "SELECT id, libelle FROM categorie";
$stmt = $db->query($query);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$categories) {
    echo "Erreur de requête : " . $db->errorInfo()[2];
    exit; // Arrêter l'exécution du script en cas d'erreur
}

// Vérifier que le bouton Modifier a bien été cliqué
if (isset($_POST['ok'])) {
    $titre = $_POST['titre'] ?? '';
    $texte = $_POST['texte'] ?? '';
    $alt = $_POST['alt_text'] ?? '';
    $categories = $_POST['categories'] ?? '';

    // Récupération du nom de l'image actuelle
    $image_url = $row['image_url'];

    // Vérification si une nouvelle image a été envoyée
    if ($_FILES['image']['error'] == 0) {
        // Suppression de l'image actuelle
        $image_path = __DIR__ . '/../../../../images/servicesetproduits/' . $image_url;
        if (file_exists($image_path)) {
            unlink($image_path); // Supprimer le fichier image
        } else {
            echo "L'image n'existe pas ou a déjà été supprimée.";
        }

        // Traitement de la nouvelle image
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png", "webp");

        // Vérification de l'extension de la nouvelle image
        if (in_array($img_ex_lc, $allowed_exs)) {
            // Génération d'un nom unique pour la nouvelle image
            $new_img_name = uniqid("IMG-", true) . 'services.' . $img_ex_lc;
            $img_upload_path = __DIR__ . '/../../../../images/servicesetproduits/' . $new_img_name;

            // Déplacement de la nouvelle image vers le dossier d'images
            if (move_uploaded_file($tmp_name, $img_upload_path)) {
                // Mise à jour des données dans la base de données avec le nouveau nom de l'image
                $service = new Service($db);
                $result = $service->update($id, $titre, $texte, $new_img_name, $alt, $categories);
                if ($result) {
                    echo "<script nonce='$nonce7'>window.location.href = 'services.php';</script>";
                } else {
                    // Sinon, produit non modifié
                    $message = "Produit non modifié";
                }

            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            echo "Extension de fichier non autorisée. Veuillez télécharger une image au format JPG, JPEG ou PNG.";
        }
    } else {
        // Si aucune nouvelle image n'a été envoyée, conservez le nom de l'image actuelle
        $new_img_name = $image_url;
        $service = new Service($db);
        $result = $service->update($id, $titre, $texte, $new_img_name, $alt, $categories);
        if ($result) {
            echo "<script nonce='$nonce7'>window.location.href = 'services.php';</script>";
        } else {
            // Sinon, produit non modifié
            $message = "Produit non modifié";
        }
    }

}
?>
<?php include(__DIR__ . '/../../admin/navbar.php'); ?>
<?php include(__DIR__ . '/formulaireModifier.php'); ?>

