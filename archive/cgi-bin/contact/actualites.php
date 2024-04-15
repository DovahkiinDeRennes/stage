<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/actualites.css" />
    <link rel="icon" href="images/Fidelilium_Logo_Simple.png">
    <link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
	<script src="https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>
	
    <title>Actualités</title>
</head>
<body>
    <header>
    <div class="menuburger">
			<div id="mySidenav" class="sidenav">
				<a id="closeBtn" href="#" class="close">×</a>
				<a href="index.html" data-aos="fade-right" data-aos-duration="1000"><img
						srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
				<ul>
					<li><a href="index.html" >Accueil</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="actualites.php" id="page-actuelle-menu">Nos Actualités</a></li>
				</ul>
			</div>
	
			<a href="#" id="openBtn" class="burger-icon">
			<i class="fa-solid fa-bars fa-2xl"></i>
			</a>
			<a href="index.html" data-aos="fade-right" data-aos-duration="1000"><img
					srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
		</div>
		<div class="navbar">
		<nav>
			  <a href="index.html" data-aos="fade-right" data-aos-duration="1000"><img srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
			  <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
			  <a class="link" href="index.html"><p class="link">Accueil</p></a>
			  <a class="link" href="contact.php"><p class="link">Nous contacter</p></a>
			  <a class="link" href="actualites.php"><p class="link" id="page-actuel">Nos Actualités</p></a>
			</div>
		  </nav>
		</div>
    </header>
    <main>
        <h1>Nos actualites</h1>
        <center>
        <div class="gallerie-actualites">
        <?php
            session_start();
            include (__DIR__ . '/assets/php/connection.php');
            include (__DIR__ . '/assets/php/afficher_actualites.php'); ?>
        </center>
    </main>
	<footer>
					<div class="gauche-foot">
					<p class="charte">Nous avons signé la  
					<a href=https://www.cybermalveillance.gouv.fr/tous-nos-contenus/actualites/chartecyber>
					CharteCyber.</a></p>
					<a href=https://www.cybermalveillance.gouv.fr/tous-nos-contenus/actualites/chartecyber>
					<img src="images/arch230621_Logo_CharteCyber_Organisation_0.png" width="50" alt="Logo de la charte cyber"/></a>
					</div>
					<div class="droite-foot">

						<p>&copy; 2023 - 2024 FIDELILIUM</p>
						<p class="charte">&nbsp;&nbsp;&nbsp;
							<a href="Mentions_Legales.html">
							Mentions légales</a></p>
					</div>	
			</footer>
	<script src="assets/js/menuburger.js"></script>
    </body>
    
</html>