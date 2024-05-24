<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
require_once(__DIR__ . '/../../../../csp_config.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire PHP</title>
    <link rel="stylesheet" href="/assets/css/actu.css" />
    <link rel="stylesheet" href="/assets/css/navbar.css" /> 
    <link rel="stylesheet" href="/assets/css/admin.css" /> 
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
    <script src="/assets/js/jquery.min.js" defer></script>
    <script src="/assets/js/seeMore.js" defer></script>
    <script src="/assets/js/confirmDelete.js"></script>
</head>
<body>

<?php include(__DIR__ . '/../../admin/navbar.php'); ?>
    <center>
<h1>Admin : Actualités</h1>
    <a href="ajouter.php"><input type="button" value="Ajouter un article"></a>

    <?php

// // Récupérer les données de la base de données

include(__DIR__ . '/../../admin/afficher_actualites.php');

        ?>
</center>
</body>




</html>
