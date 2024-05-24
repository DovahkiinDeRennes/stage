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
    <link rel="stylesheet" href="/assets/css/servicesproduits.css" />
    <link rel="stylesheet" href="/assets/css/navbar.css" /> 
    <link rel="stylesheet" href="/assets/css/admin.css" /> 
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
    <script src="/assets/js/autoload.js"></script>
    <script src="/assets/js/confirmDelete.js"></script>
</head>
<body>
<?php include(__DIR__ . '/../../admin/navbar.php'); ?>
    <center>
<h1>Admin : Services</h1>
    <a href="ajouter.php"><input type="button" value="Ajouter un article"></a>
    <?php include(__DIR__ . '/../../admin/afficher_services.php'); ?>

</center>

</body>
</html>
