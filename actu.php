
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/actu.css" />
    <link rel="stylesheet" href="assets/css/footer.css" />

    <link rel="icon" href="images/Fidelilium_Logo_Simple.webp">
    <script src="/assets/js/jquery.min.js" defer></script>
    <script src="/assets/js/seeMore.js" defer></script>
    <title>Actualités</title>

</head>
<body>

<?php
session_start();

include(__DIR__ . '/src/pages/core/connection.php');
include(__DIR__ . '/src/pages/admin/navbar.php');
?>
<center>
<div>
<div class="flex">
<?php
include (__DIR__ . '/src/pages/admin/afficher_actualites.php'); ?>

</div>
</div>
</center>

<?php require_once 'partials/footer.php' ?>

<script src="assets/js/menuburger.js"></script>
<script src="assets/js/boutonafficherplus.js"></script>

<script src="assets/js/actualite.js"></script>
</body>