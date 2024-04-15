<?php include 'assets/php/connection.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/servicesproduits.css">
    <link rel="icon" href="images/Fidelilium_Logo_Simple.png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
    <title>Services et Produits</title>
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
					<li><a href="actualites.php" id="page-actuelle-menu"><p class="link">Nos Actualités</p></a></li>
				</ul>
			</div>
	
			<a href="#" id="openBtn" class="burger-icon">
				<i class="fa-solid fa-bars"></i>
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
        <h1 data-aos="fade-up" data-aos-duration="2000">Nos services et produits</h1>
        <section class="services" data-aos="fade-up" data-aos-duration="2000">
            <h2>Nos services</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo distinctio, delectus nihil, tenetur
                expedita placeat, natus libero tempora labore maiores recusandae. Voluptatem odio, obcaecati quia velit
                aperiam nemo eveniet sunt!
                Magni unde, delectus sequi earum, ducimus pariatur consectetur natus quaerat aut aliquam voluptas rerum
                atque facilis maxime exercitationem? Fugiat quisquam unde ab soluta atque placeat odio consequuntur
                culpa fugit similique.
                Totam, pariatur esse, repellendus ad, ullam quidem odit doloribus atque facilis rerum repellat! Optio
                dignissimos, accusamus deleniti quas totam quam maxime tempora sapiente facilis, illum, in quia officia
                illo voluptatum.</p>
        </section>
        <section data-aos="fade-up" data-aos-duration="2000">
            <h2>Nos produits</h2>
            <div class="gallerie-produits">
                <?php include 'assets/php/afficher_produits.php'; ?>
                

            </div>
        </section>
    </main>
    <footer>
        <div class="gauche-foot">
            <p class="charte">Nous avons signé la
                <a href=https://www.cybermalveillance.gouv.fr/tous-nos-contenus/actualites/chartecyber> CharteCyber.</a>
                    </p> <a href=https://www.cybermalveillance.gouv.fr/tous-nos-contenus/actualites/chartecyber> <img
                    src="images/arch230621_Logo_CharteCyber_Organisation_0.png" width="50" /></a>
        </div>
        <div class="droite-foot">

            <p>&copy; 2023 FIDELILIUM</p>
            <p class="charte">&nbsp;&nbsp;&nbsp;
                <a href="Mentions_Legales.html">
                    Mentions légales</a></p>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/menuburger.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>