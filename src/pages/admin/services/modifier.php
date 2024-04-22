<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../../classes/service.php');

    ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/admin.css" />
</head>

<body>
    <?php

    include(__DIR__ . '/../../core/connection.php');
    

    // On récupère l'ID dans le lien
    $id = $_GET['id'];
    // Requête pour afficher les infos d'un produit
    $req = mysqli_query($db, "SELECT * FROM services WHERE id = $id");
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

        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        $id = $_GET['id'];
        $service = new Service($db);

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . 'services' . $img_ex_lc;
            $img_upload_path = __DIR__ . '/../../../../images/servicesetproduits/' . $new_img_name;
            if (move_uploaded_file($tmp_name, $img_upload_path)) {
                // Appel de la fonction update pour mettre à jour les données dans la base de données
                $service->update($id, $titre, $texte, $new_img_name, $alt, $categories);

            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }
        } else {
            echo "Extension de fichier non autorisée. Veuillez télécharger une image au format JPG, JPEG ou PNG.";
        }
        $new_img_name = $row['image_url'];
        $service->update($id, $titre, $texte, $new_img_name, $alt, $categories);
    }

    ?>
    <?php include(__DIR__ . '/../../admin/navbar.php'); ?>
    <?php include(__DIR__ . '/formulaireModifier.php'); ?>
