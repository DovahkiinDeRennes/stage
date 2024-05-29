<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../services/CategorieService.php');


require_once(__DIR__ . '/../../../../csp_config.php');


if (isset($_POST['ok'])) {
    $libelle = $_POST["libelle"] ?? '';

    $categorie = new CategorieService($db);

    $categorie->insert($libelle);
}

include(__DIR__ . '/formulaireAjouter.php');
?>

