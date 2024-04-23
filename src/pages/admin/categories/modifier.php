<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include './../../../Classes/Categorie.php';


// Récupération des informations de la catégorie à modifier
$id = mysqli_real_escape_string($db, $_GET['id']);
$req = mysqli_query($db, "SELECT * FROM categorie WHERE id = $id");
$row = mysqli_fetch_assoc($req);

if (isset($_POST['ok'])) {
    $id = $_GET['id'];
    $libelle = $_POST['libelle'];

    // Créez une instance de la classe Categorie
    $categorie = new Categorie($db);

    // Appelez la méthode update() pour mettre à jour la catégorie
    $result = $categorie->update($db, $id, $libelle);

    if ($result) {
        // Redirection après la mise à jour
        header("Location:categories.php");
        exit();
    } else {
        // En cas d'erreur lors de la mise à jour
        $message = "CATEGORIE non modifié";
    }
}


?>

<form action="" method="POST" enctype="multipart/form-data">
    <label>Libellé</label><br>
    <input type="text" name="libelle" value="<?= $row['libelle'] ?>"><br>
    <input type="submit" value="Modifier" name="ok"><br>
</form>
