<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/actualites.css" />
    <link rel="stylesheet" href="assets/css/footer.css" />
    <link rel="stylesheet" href="assets/css/roots.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />



    <link rel="icon" href="images/Fidelilium_Logo_Simple.png">
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
            include(__DIR__ . '/src/fideliliumAdmin/Core/connection.php');
            include (__DIR__ . '/src/fideliliumAdmin/admin/afficher_actualites.php'); ?>
        </center>
    </main>
</section>
	<?php require_once 'partials/footer.php' ?>

			<script src="assets/js/menuburger.js"></script>
	<script src="assets/js/boutonafficherplus.js"></script>
	
	<script>
    window.addEventListener('DOMContentLoaded', function() {
        var urlParams = new URLSearchParams(window.location.search);
        var scrollAmount = urlParams.get('scroll');
        if (scrollAmount) {
            setTimeout(function() {
                var currentScrollPosition = window.scrollY; // Obtenez la position de défilement actuelle
                var targetScrollPosition = currentScrollPosition - 400; // Définissez la position cible en reculant de 400 pixels
                window.scrollTo(0, targetScrollPosition); // Défilez jusqu'à la position cible
            }, 0);
        }
    });
</script>

	

    </body>
    
</html>