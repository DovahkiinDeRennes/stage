<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include './../../../classes/Categorie.php';


require_once(__DIR__ . '/../../../../csp_config.php');


if (isset($_POST['ok'])) {
    $libelle = htmlspecialchars($_POST['libelle'] ?? '', ENT_QUOTES, 'UTF-8');

    $categorie = new Categorie($db);

    $categorie->insert($libelle);
}

include(__DIR__ . '/formulaireAjouter.php');
?>

