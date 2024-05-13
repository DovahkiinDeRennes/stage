<?php
require_once (__DIR__ . '/csp_config.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/header.css" />
    <link rel="stylesheet" href="/assets/css/actualites.css" />
    <link rel="stylesheet" href="/assets/css/footer.css" />
    <link rel="stylesheet" href="/assets/css/roots.css" />
    <link rel="stylesheet" href="/assets/css/styles.css" />



    <link rel="icon" href="/images/Fidelilium_Logo_Simple.png">
    <script src="/assets/js/jquery.min.js" defer></script>
    <script src="/assets/js/seeMore.js" defer></script>
    <link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
	<script src="https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>

    <title>Actualités</title>
</head>
<body>
<?php require_once 'partials/header.php' ?>

<section data-aos="fade-up" data-aos-duration="2000" class="main-services margB65">
<div class="sous-titre">
    <h1>Actualités</h1>
</div>
    <main>

        <center>
        <div class="gallerie-actualites">
        <?php
            session_start();
            include(__DIR__ . '/src/pages/core/connection.php');

            include (__DIR__ . '/src/pages/admin/afficher_actualites.php'); ?>
        </center>
    </main>
</section>
	<?php require_once 'partials/footer.php' ?>

			<script src="assets/js/menuburger.js"></script>
	<script src="assets/js/boutonafficherplus.js"></script>
	
	<script src="assets/js/actualite.js"></script>

	

    </body>
    
</html>