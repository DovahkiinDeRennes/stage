<?php
session_start();
include(__DIR__ . '/../assets/php/check_login.php');
include(__DIR__ . '/../assets/php/connection.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/admin.css" />
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>
<body>
    <?php include(__DIR__ . '/../assets/php/navbar.php'); ?>
    <center>
    <h2>Bienvenue sur la page d'administration</h2>
    <p>Contenu protégé réservé à l'administrateur.</p>
    <a href="logout.php">Déconnexion</a>
    </center>
</body>
</html>