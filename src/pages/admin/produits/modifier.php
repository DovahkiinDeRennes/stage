<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../../services/ProduitService.php');
include(__DIR__ . '/../../core/connection.php');
require_once(__DIR__ . '/../../../../csp_config.php');

// On récupère l'ID dans le lien
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Vérifier si l'ID est valide
if (!$id) {
    echo "ID de produit invalide";
    exit;
}

// Requête pour afficher les infos d'un produit
$stmt = $db->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "Produit non trouvé";
    exit;
}

// Récupération des catégories
$stmt = $db->query("SELECT id, libelle FROM categorie");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$categories) {
    echo "Aucune catégorie trouvée";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ok'])) {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'] ?? '';
    $texte = $_POST['texte'] ?? '';
    $alt = $_POST['alt_text'] ?? '';
    $categories = $_POST['categories'] ?? '';

    // Traitement de l'image
    $new_img_name = $row['image_url']; // Par défaut, conservez le nom de l'image actuelle
    if ($_FILES['image']['error'] === 0) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $allowed_exs = array("jpg", "jpeg", "png", "webp");

        if (in_array($img_ex, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . 'produits.' . $img_ex;
            $img_upload_path = __DIR__ . '/../../../../images/servicesetproduits/' . $new_img_name;
            if (move_uploaded_file($tmp_name, $img_upload_path)) {
                // Supprimer l'ancienne image si nécessaire
                $old_img_path = __DIR__ . '/../../../../images/servicesetproduits/' . $row['image_url'];
                if (file_exists($old_img_path)) {
                    unlink($old_img_path);
                }
            } else {
                echo "Erreur lors du téléchargement de l'image.";
                exit;
            }
        } else {
            echo "Extension de fichier non autorisée. Veuillez télécharger une image au format JPG, JPEG ou PNG.";
            exit;
        }
    }

    // Mettre à jour le produit dans la base de données
    $produit = new ProduitService($db);
    $result = $produit->update($id, $titre, $texte, $new_img_name, $alt, $categories);

    if ($result) {
        header("Location: produits.php");
        exit;
    } else {
        // Sinon, produit non modifié
        echo "Produit non modifié";
        exit;
    }
}

include(__DIR__ . '/formulaireModifier.php');
