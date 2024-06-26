<!DOCTYPE HTML>
<html>

<head>
	<title>Fidelilium</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Les experts en cyberdéfense et transformation numérique de FIDELILIUM proposent audits, tests d'intrusion, intervention en cas de cyberattaques, conformité, sensibilisation, et solutions numériques sécurisées">
	<link rel="icon" href="images/Fidelilium_Logo_Simple.png">
	<link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/roots.css"/>
    <link rel="stylesheet" href="/assets/css/caroussel.css"/>
	<link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/footer.css" />
	<link rel="stylesheet" href="assets/css/caroussel-actu.css" />
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
    <script src="https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.css" />




	<link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.html" />
	</noscript>

	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
<?php require_once 'partials/header.php' ?>

<div class="header" data-aos="zoom-out-up" data-aos-duration="2000">
    <center>
        <img src="images/Fidelilium_Logo_Sign_FR_RVB.png" alt="Logo de fidelilium" />
        <br />

            

    </center>
</div>
		<div class="btn-navbar-container">
			<a href="/contact.php">
			<button class="btn-navbar" id="delayedSection" style="display:none">
                <p>Vous êtes attaqués ? Nos équipes peuvent vous aider ! </p>
            </button></a>
			<script src="/assets/js/delayedSection.js"></script>
	
	<!-- Premier bloc -->
	<div class="bloc-1">
		<?php include_once('assets/php/caroussel.php') ?>
	</div>
	
	<main>

	<!-- Quatrième bloc -->
	<div class="bloc-4">
		<center>
			<h2>Nos valeurs</h2>
			<div class="valeurs">
				<div class="valeur" data-aos="fade-right" data-aos-duration="1000">
					<h3>Souveraineté</h3>
					<p>Vous accompagner dans la maîtrise de votre destin numérique.</p>
					<span class="image fit"><img src="images/pic02.jpg" alt="Bandeau de couleur" height="20" /></span>
				</div>
				<div class="valeur" data-aos="fade-down" data-aos-duration="1000">
					<h3>Excellence</h3>
					<p>Vous offrir le meilleur de la transformation numérique, en toute cybersécurité.</p>
					<span class="image fit"><img src="images/pic03.jpg" alt="Bandeau de couleur" height="20" /></span>
				</div>
				<div class="valeur" data-aos="fade-up" data-aos-duration="1000">
					<h3>Confiance</h3>
					<p>Préserver la confidentialité, l'intégrité, et la disponibilité de vos actifs numériques.</p>
					<span class="image fit"><img src="images/pic04.jpg" alt="Bandeau de couleur" height="20" /></span>
				</div>
			</div>
		</center>
	</div>
</main>

	<div class="caroussel-actualites">
	<h2>Nos dernières actualités : </h2>
	<?php include_once('assets/php/caroussel-actu.php') ?>
	</div>

<main>

	<!-- deuxieme bloc -->
	<div class="bloc-2">
		<h2 data-aos="fade-right">Équipage</h2>
		<div class="division ">
			<p class="text-essi " data-aos="fade-right">Fidelilium est une société fondée par deux détenteurs du titre d'expert en sécurité des systèmes d'information de l'ANSSI (Agence Nationale de Sécurité des Systèmes d'Information). Ils cumulent à eux deux plus de 40 ans d’expérience dans la défense des systèmes d’information. Forts d’un riche réseau professionnel, ils ont à cœur de mettre à la disposition de leurs clients, les services d’experts reconnus du milieu de la cybersécurité et du numérique.</p>
			<a href="https://cyber.gouv.fr/formation-essi-expert-en-securite-des-systemes-dinformation" target="_blank">
				<img class="img-essi" src="images/logoEssi.png" alt="logo Essi"></a>
		</div>


	</div>
	
	<!-- Fin du deuxieme bloc -->

	<center><span class="image fit"><img class="séparation" src="images/fidelilium_line.png" height="5" alt="séparation" /></span></center>
	<!-- Troisieme bloc -->
	<div class="bloc-3">
		<div class="groupe-gauche" data-aos="fade-right">
			<a href="https://cybermalveillance.gouv.fr">
				<img src="images/Bloc_ReferenceSurLaPlateformeCybermalveillance_RVB.jpg" loading="lazy" alt="Logo cybermalveillance.gouv.fr" class="image-cybermalveillance">
			</a>
		</div>
		<div class="cybermalveillance">
		<div class="groupe-droite" data-aos="fade-up">
			<div class="paragraphe"><a href="https://Cybermalveillance.gouv.fr">
					</a>
                <p>
                    <a href="https://cybermalveillance.gouv.fr"><span>Cybermalveillance.gouv.fr </span></a>est le dispositif national d'assistance aux victimes d'actes de cybermalveillance,
				de sensibilisation des publics aux risques numériques et d'observation de la menace en France.
				Ses publics sont les particuliers, les entreprises et les collectivités territoriales.
                </p>
            </div>
		</div>
	</div>
	</div>
	<center><span class="image fit"><img class="séparation" src="images/fidelilium_line.png" alt="séparation" height="5" /></span></center>
	
	
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="assets/js/menuburger.js"></script>
	<script>
		AOS.init();
	</script>
	</div>

	</main>
<?php require_once 'partials/footer.php' ?>
</body>




</html>