<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../services/ActualiteService.php');


require_once(__DIR__ . '/../../../../csp_config.php');


if (isset($_POST['ok'])) {

    $titre =  $_POST['titre'] ?? '';
    $texte =  $_POST['texte'] ?? '';
    $alt =  $_POST['alt_text'] ??'';

    if ($_POST['lien-ytb']) {
        $ytb_url = $_POST['lien-ytb'];
        $new_img_name = "non";
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png", "mp4", "webp");

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . 'actualites.' . $img_ex_lc;
            $img_upload_path = __DIR__ . '/../../../../images/actualites/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
            $ytb_url = "non";
        }
    }

    $actualite = new ActualiteService($db);
    $actualite->insert($titre, $texte, $alt, $new_img_name, $ytb_url);

    // Insert into Database
    header("Location: actualites.php");
} else {
    echo "Erreur";
}

include(__DIR__ . '/formulaireAjouter.php');
?>





