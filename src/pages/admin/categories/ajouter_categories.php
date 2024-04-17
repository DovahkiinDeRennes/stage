<?php

include '../../../classes/Categorie/categorie.php';
include(__DIR__ . '/../../core/connection.php');

if(isset($_POST['ok'])) {

    $libelle = $_POST["libelle"];

    $categorie = new Categorie();


    $categorie->insert($libelle);

}


