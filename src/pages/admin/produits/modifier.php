<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../../classes/produit.php');

?>


<?php

include(__DIR__ . '/../../core/connection.php');


// On récupère l'ID dans le lien
$id = $_GET['id'];
// Requête pour afficher les infos d'un produit
$req = mysqli_query($db, "SELECT * FROM produits WHERE id = $id");
$row = mysqli_fetch_assoc($req);

$query = "SELECT id, libelle FROM categorie";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $categories = array();
    while ($rowCat = mysqli_fetch_assoc($result)) {
        $categories[] = array(
            'id' => $rowCat['id'],
            'libelle' => $rowCat['libelle']
        );
    }
} else {
    echo "Erreur de requête : " . mysqli_error($db);
}


// Vérifier que le bouton Modifier a bien été cliqué
if (isset($_POST['ok'])) {
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $texte = isset($_POST['texte']) ? $_POST['texte'] : '';
    $alt = isset($_POST['alt_text']) ? $_POST['alt_text'] : '';
    $categories = isset($_POST['categories']) ? $_POST['categories'] : '';

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
        $allowed_exs = array("jpg", "jpeg", "png");

        // Vérification de l'extension de la nouvelle image
        if (in_array($img_ex_lc, $allowed_exs)) {
            // Génération d'un nom unique pour la nouvelle image
            $new_img_name = uniqid("IMG-", true) . 'produits.' . $img_ex_lc;
            $img_upload_path = __DIR__ . '/../../../../images/servicesetproduits/' . $new_img_name;

            // Déplacement de la nouvelle image vers le dossier d'images
            if (move_uploaded_file($tmp_name, $img_upload_path)) {
                // Mise à jour des données dans la base de données avec le nouveau nom de l'image
                $produit = new Produit($db);
              $result =  $produit->update($id, $titre, $texte, $new_img_name, $alt, $categories);
                if ($result) {
                    echo "<script>window.location.href = 'produits.php';</script>";
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
        $produit = new Produit($db);
        $result = $produit->update($id, $titre, $texte, $new_img_name, $alt, $categories);

        if ($result) {
            echo "<script>window.location.href = 'produits.php';</script>";
        } else {
            // Sinon, produit non modifié
            $message = "Produit non modifié";
        }
    }
}
include(__DIR__ . '/formulaireModifier.php');
?>


