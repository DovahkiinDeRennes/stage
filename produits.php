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
    <link rel="stylesheet" href="assets/css/servicesproduits.css">
    <link rel="stylesheet" href="assets/css/footer.css" />
    <link rel="stylesheet" href="assets/css/roots.css"/>

    <link rel="icon" href="images/Fidelilium_Logo_Simple.png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
    <script src="https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.css" />
    <title>Produits</title>
</head>

<body>

<?php require_once 'partials/header.php' ?>


        <section data-aos="fade-up" data-aos-duration="2000" class="main-services margB65">
            <div class="sous-titre">
            <h1>Produits</h1>
            </div>
            <div class="gallerie-services">
                <?php include 'src/pages/admin/afficher_produits.php'; ?>
                

            </div>
        </section>

        <?php require_once 'partials/footer.php' ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/menuburger.js"></script>
<script src="assets/js/aos.js"></script>
</body>

</html>