<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire PHP</title>
    <link rel="stylesheet" href="/assets/css/servicesproduits.css" />
    <link rel="stylesheet" href="/assets/css/navbar.css" /> 
    <link rel="stylesheet" href="/assets/css/admin.css" /> 
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>
<body>
<?php include(__DIR__ . '/../../admin/navbar.php'); ?>
<h1>Admin : Produits</h1>
    <a href="ajouter.php"><input type="button" value="Ajouter un article"></a>
    <?php include(__DIR__ . '/../../admin/afficher_produits.php'); ?>

</body>
</html>
