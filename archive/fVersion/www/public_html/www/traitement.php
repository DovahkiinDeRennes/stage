<!DOCTYPE HTML>
<html>
	
<head>
		<title>Fidelilium</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="icon" type="image/x-icon" href="images/favicon.html">
		<link rel="icon" href="images/Fidelilium_Logo_Simple.png">
		<link rel="stylesheet" href="assets/css/styles.css" />
		<link rel="stylesheet" href="assets/css/navbar.css" />
		<link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.html" /></noscript>
</head>
	<body>
		<div class="navbar">
		<nav>
			  <a href="newindex.html"><img srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
			  <div class="onglets">
			  <a class="link" href="index.html"><p class="link"  id="page-actuel">Accueil</p></a>
			  <a class="link" href="contact.html"><p class="link">Nous contacter</p></a>
			</div>
		  </nav>
		</div>
<?php
$prénom = $_POST["prénom"];
$nom = $_POST["nom"];
$email = $_POST["email"];
$téléphone = $_POST["téléphone"];
$société = $_POST["société"];
$fonction = $_POST["fonction"];
$objet = $_POST["objet"];
$message = $_POST["message"];
$to = 'alzzrtt@gmail.com';
$subject = 'Formulaire de contact';

if (mail($to, $subject, print_r($_POST, true), "From: $email")) {
    echo "<H1>Votre mail a bien été envoyé </H1>";
	echo "<H1><a>cliquez ici pour revenir a l'accueil</a><H1>";
}
else {
    echo "<H1>Il y a eu un probleme lors de l'envoie du mail,</h1>";
	echo "<a href='contact.html'><H1>cliquez ici pour revenir a la page de Contact</H1></a><br>";
}

	$db = mysqli_connect("localhost", "copo4474_fidelilium", "sFhOyiKn8i21yOpH6U");
	mysqli_select_db($db,"copo4474_fidelilium");
	mysqli_query($db, "INSERT INTO contact VALUES('$prénom','$nom','$email','$téléphone','$société','$fonction','$objet','$message')");
?>
<br>