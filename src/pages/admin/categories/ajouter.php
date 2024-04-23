<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include './../../../Classes/Categorie.php';




if(isset($_POST['ok'])) {
    $libelle = isset($_POST["libelle"]) ? $_POST["libelle"] : '';


    $categorie = new Categorie($db);


    $categorie->insert($libelle);
}
?>

<h2>Ajouter une catégorie</h2>

<form method="post">
    <label for="libelle">Libellé :</label>
    <input type="text" id="libelle" name="libelle" required>
    <button type="submit" name="ok">Envoyer</button>
</form>
