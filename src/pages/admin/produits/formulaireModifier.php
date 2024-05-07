<?php

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

<?php include(__DIR__ . '/../../admin/navbar.php'); ?>

<div class="form">
    <a href="produits.php" class="back_btn"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                                 viewBox="0 0 448 512">
            <path
                d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg> Retour</a>
    <center>
        <h2>Modifier le produits : <?= $row['titre'] ?> </h2>
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
            <textarea name="texte"><?= htmlspecialchars($row['description']) ?></textarea><br>
            <label>Image actuelle</label><br>
            <img src="/../../images/servicesetproduits/<?= $row['image_url'] ?>" width="150px"><br>
            <input type="text" name="alt_text" value="<?= $row['alt_text'] ?>"
                   placeholder="ALT texte d'image SEO"><br>
            <label>Nouvelle image</label><br>
            <input type="file" name="image"><br>
            <input type="hidden" name="image" value="<?= $row['image_url'] ?>"> <br>
            <select name="categories">
                <?php
                // Afficher les catégories dans la liste déroulante

                foreach ($categories as $categorie) {
                    echo "<option value=\"" . $categorie['id'] . "\">" . $categorie['libelle'] . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="Modifier" name="ok"><br>
        </form>
    </center>
</div>
</body>

</html>