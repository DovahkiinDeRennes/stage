<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/produit.php');
require_once(__DIR__ . '/../../../../csp_config.php');
// Récupération des catégories depuis la base de données
$query = "SELECT id, libelle FROM categorie";
$stmt = $db->prepare($query);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['ok'])) {


    $titre = htmlspecialchars($_POST['titre'] ?? '', ENT_QUOTES, 'UTF-8');
    $texte = htmlspecialchars($_POST['texte'] ?? '', ENT_QUOTES, 'UTF-8');
    $alt = htmlspecialchars($_POST['alt_text'] ?? '', ENT_QUOTES, 'UTF-8');
    $categories = filter_var($_POST['categories'] ?? '', FILTER_VALIDATE_INT);

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png", "webp");

    if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true) . 'produits.' .$img_ex_lc;
        $img_upload_path = __DIR__ . '/../../../../images/servicesetproduits/' . $new_img_name;
        if (move_uploaded_file($tmp_name, $img_upload_path)) {

            $produit = new produit($db);
            $produit->insert($titre, $texte, $new_img_name, $alt, $categories);

            // Redirection après l'ajout
            header("Location: produits.php");
            exit();
        } else {
            $message = "Il vous faut une image pour ajouter un service.";
        }
    } else {
        $message = "Extension de fichier non autorisée. Veuillez télécharger une image au format JPG, JPEG ou PNG.";
    }
}

include(__DIR__ . '/formulaireAjouter.php');
?>