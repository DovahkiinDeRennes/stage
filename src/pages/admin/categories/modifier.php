<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/Categorie.php');

// Récupération des informations de la catégorie à modifier
$id = $_GET['id'];
$req = $db->prepare("SELECT * FROM categorie WHERE id = ?");
$req->execute([$id]);
$row = $req->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['ok'])) {
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];

    // Créez une instance de la classe Categorie
    $categorie = new Categorie($db);

    // Appelez la méthode update() pour mettre à jour la catégorie
    $result = $categorie->update($id, $libelle);

    if ($result) {
        // Redirection après la mise à jour
        header("Location: categories.php");
        exit();
    } else {
        // En cas d'erreur lors de la mise à jour
        $message = "CATEGORIE non modifié";
    }
}

include(__DIR__ . '/formulaireModifier.php');


