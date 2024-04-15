<?php
    session_start();
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
    session_start();
    include (__DIR__ . '/../../assets/php/connection.php');
    include (__DIR__ . '/../../assets/php/check_login.php');

    // On récupère l'ID dans le lien
    $id = $_GET['id'];
    // Requête pour afficher les infos d'un produit
    $req = mysqli_query($db, "SELECT * FROM produits WHERE id = $id");
    $row = mysqli_fetch_assoc($req);

    // Vérifier que le bouton Modifier a bien été cliqué
    if (isset($_POST['ok'])) {
        $titre = mysqli_real_escape_string($db, $_POST['titre']);
        $texte = mysqli_real_escape_string($db, $_POST['texte']);
        $alt = mysqli_real_escape_string($db, $_POST['alt_text']);

        // Vérifier si un fichier a été uploadé
        if ($_FILES['image']['error'] == 0) {
            $id = $_GET['id'];
$query = "SELECT * FROM produits WHERE id= $id";
$result = $db->query($query);
while ($row = $result->fetch_assoc()) {
    $image_path = __DIR__ . '/../../images/servicesetproduits/' . $row['image_url'];
    echo $image_path;
    // Vérifier si le fichier existe avant de le supprimer
    if (file_exists($image_path)) {
        unlink($image_path); // Supprimer le fichier

    } else {
        echo "L'image n'existe pas ou a déjà été supprimée.";
    }

    $images_directory = __DIR__ . '/../../images/servicesetproduits/';
    $images = scandir($images_directory);

}
            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = __DIR__ . '/../../images/servicesetproduits/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            } else {
                echo "Invalid file type. Allowed types: jpg, jpeg, png.";
                exit();
            }
        } else {
            // No new image uploaded, use the existing one
            $new_img_name = $row['image_url'];
        }

        // Requête de modification
        $update_query = "UPDATE produits SET titre = '$titre' , description = '$texte' , image_url = '$new_img_name' , alt_text = '$alt' WHERE id = $id";
        $req = mysqli_query($db, $update_query);

        if ($req) {
            // Si la requête a été effectuée avec succès, redirection
            // header("location: servicesetproduits_creation.php");
            echo "<script>window.location.href = 'servicesetproduits_creation.php';</script>";
        } else {
            // Sinon, produit non modifié
            $message = "Produit non modifié";
        }
    }

    ?>
<?php include (__DIR__ . '/../../assets/php/navbar.php'); ?>

    <div class="form">
        <a href="servicesetproduits_creation.php" class="back_btn"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Retour</a>
        <center>
            <h2>Modifier le Produit : <?= $row['titre'] ?> </h2>
            <p class="erreur_message">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </p>
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Titre</label><br>
                <input type="text" name="titre" value="<?= $row['titre'] ?>"><br>
                <label>Description</label><br>
                <input type="text" name="texte" value="<?= $row['description'] ?>"><br>
                <label>Image actuelle</label><br>
                <img src="/../../images/servicesetproduits/<?= $row['image_url'] ?>" width="150px"><br>
                <input type="text" name="alt_text" value="<?= $row['alt_text'] ?>"placeholder="ALT texte d'image SEO"><br>
                <label>Nouvelle image</label><br>
                <input type="file" name="image"><br>
                <input type="hidden" name="image" value="<?= $row['image_url'] ?>"> <br>
                <input type="submit" value="Modifier" name="ok"><br>
            </form>
        </center>
    </div>
</body>

</html>
