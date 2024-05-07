<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire PHP</title>
    <link rel="stylesheet" href="/assets/css/admin.css" />
    <link rel="stylesheet" href="/assets/css/servicesproduits.css" />
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>
<body>
<?php include(__DIR__ . '/../../admin/navbar.php'); ?>

<center>
    <h1>Ajouter un service</h1>

    <?php

    if (!empty($message)) {
        echo "<p style='color: red;'>$message</p>";
    }
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="Votre Titre" required><br>
        <textarea name="texte" rows="4" placeholder="Votre description" required></textarea><br>
        <input type="file" name="image" accept="image/*">
        <br>
        <input type="text" name="alt_text" placeholder="ALT texte d'image SEO"><br>

        <select name="categories">
            <?php
            foreach ($categories as $categorie) {
                echo "<option value=\"" . $categorie['id'] . "\">" . $categorie['libelle'] . "</option>";
            }
            ?>
        </select><br>
        <Button type="submit" name="ok">Envoyer</Button>
    </form>
</center>
</body>
</html>