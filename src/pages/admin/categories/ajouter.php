<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include './../../../classes/Categorie.php';




if (isset($_POST['ok'])) {
    $libelle = $_POST["libelle"] ?? '';

    $categorie = new Categorie($db);

    $categorie->insert($libelle);
}

include(__DIR__ . '/formulaireAjouter.php');
?>

