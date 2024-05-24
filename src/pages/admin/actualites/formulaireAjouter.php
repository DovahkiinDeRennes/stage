<?php

require_once(__DIR__ . '/../../../../csp_config.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire PHP</title>
    <link rel="stylesheet" href="/assets/css/servicesproduits.css" />
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>

<body>
<?php include(__DIR__ . '/../../admin/navbar.php'); ?>
<center>
    <h1>Ajouter une actualité</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
          enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="Votre Titre" required><br>

        <textarea name="texte" rows="4" placeholder="Votre description" required id="texte"></textarea><br>



        <input type="file" name="image" accept="image/*"><br>
        <input type="text" name="lien-ytb" placeholder="Mettre un lien youtube"><br>
        <input type="text" name="alt_text" placeholder="ALT texte d'image SEO"><br>
        <Button type="submit" name="ok">Envoyer</Button>
    </form>
</center>

</body>

</html>
