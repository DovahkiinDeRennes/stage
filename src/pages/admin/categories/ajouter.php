<?php
include(__DIR__ . '/../../core/connection.php');
include '../../../classes/Categorie/categorie.php';




if(isset($_POST['ok'])) {
    $libelle = isset($_POST["libelle"]) ? $_POST["libelle"] : '';

    // Instancier la classe Categorie avec la connexion à la base de données
    $categorie = new Categorie($db);

    // Appeler la méthode insert avec le libellé
    $categorie->insert($libelle);
}
?>

<h2>Ajouter une catégorie</h2>

<form method="post">
    <label for="libelle">Libellé :</label>
    <input type="text" id="libelle" name="libelle" required>
    <button type="submit" name="ok">Envoyer</button>
</form>