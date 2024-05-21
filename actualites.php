<?php

include './src/pages/core/connection.php';
require_once(__DIR__ . '/csp_config.php');


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/roots.css"/>
    <link rel="stylesheet" href="assets/css/actu.css" />
    <link rel="stylesheet" href="assets/css/footer.css" />
    <link rel="stylesheet" href="assets/css/caroussel-actu.css" />
    <script src="/assets/js/confirmDelete.js"></script>
    <link rel="icon" href="images/Fidelilium_Logo_Simple.webp">
    <script src="/assets/js/jquery.min.js" defer></script>
    <script src="/assets/js/seeMore.js" defer></script>
    <link href="<?php echo $urlAosCss; ?>" rel="stylesheet">
    <script src="<?php echo $urlFontAwesomeJs; ?>" crossorigin="anonymous"></script>
    <title>Actualités</title>

</head>

<body>
<?php require_once 'partials/header.php' ?>
<?php
session_start();

include(__DIR__ . '/src/pages/core/connection.php');

?>
<center>
    <section data-aos="fade-up" data-aos-duration="2000" class="margH150">
<div class="flex">
<?php
include (__DIR__ . '/src/pages/admin/afficher_actualites.php'); ?>

</div>
    </section>
</center>

<?php require_once 'partials/footer.php' ?>

<script src="assets/js/menuburger.js"></script>
<script src="assets/js/boutonafficherplus.js"></script>
<script src="<?php echo $urlAosJs; ?>"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/actualite.js"></script>
</body>