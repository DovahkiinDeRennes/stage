<?php
include (__DIR__ . './src/pages/core/connection.php');

if (isset($_POST['ok'])) {
    if (isset($_POST["ma_checkbox"])) {
        $conditions = "Oui";

        if (!empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['message'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "Adresse e-mail non valide";
                $statut = "error";
            } else {
                $nom = $_POST["nom"];
                $prenom = $_POST["prénom"];
                $telephone = $_POST["téléphone"];
                $societe = $_POST["société"];
                $fonction = $_POST["fonction"];
                $objet = $_POST["objet"];
                $message = htmlspecialchars($_POST["message"]);

                // Utilisation de requêtes préparées pour éviter les injections SQL
                $stmt = $db->prepare("INSERT INTO contact (nom, prenom, mail, tel, societe, fonction, object, message, conditions, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt->bind_param("sssssssss", $nom, $prenom, $email, $telephone, $societe, $fonction, $objet, $message, $conditions);
                $stmt->execute();
                $stmt->close();

                $to = 'fidelilium@gmail.com';
                $subject = 'Formulaire de contact';

                // Utilisation d'une bibliothèque de messagerie (par exemple, PHPMailer) est recommandée
                mail($to, $subject, print_r($_POST, true), "From: $email");

                $msg = "Votre message a bien été envoyé, Vous allez être redirigé !";
                $statut = "success";
            }
        } else {
            $msg = "* Tous les champs doivent être complétés !";
            $statut = "error";
        }
    } else {
        $statut = "error";
        $msg = "Vous devez accepter nos conditions";
    }
}
?>
<html lang="fr">
    <head>
		<title>Page de contact</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="icon" type="image/x-icon" href="images/favicon.html">
		<link rel="icon" href="images/Fidelilium_Logo_Simple.png">
		<link rel="stylesheet" href="assets/css/contact.css" />
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/footer.css" />

		<link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.html" /></noscript>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>
    
       
  </head>
  <body>
  <div class="all">
  <div class="menuburger">
			<div id="mySidenav" class="sidenav">
				<a id="closeBtn" href="#" class="close">×</a>
				<a href="index.php" data-aos="fade-right" data-aos-duration="1000"><img
						srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
				<ul>
					<li><a href="index.php">Accueil</a></li>
					<li><a href="actualites.php">Actualités</a></li>
					<li><a href="services.php">Services</a></li>
					<li><a href="contact.php" id="page-actuelle-menu">Contact</a></li>
				</ul>
			</div>
	
			<a href="#" id="openBtn" class="burger-icon">
				<i class="fa-solid fa-bars fa-2xl"></i>
			</a>
			<a href="index.php" data-aos="fade-right" data-aos-duration="1000"><img
					srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
		</div>
		<div class="navbar">
		<nav>
			  <a href="index.php" data-aos="fade-right" data-aos-duration="1000"><img srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
			  <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
			  <a class="link" href="index.php"><p class="link">Accueil</p></a>
			  <a class="link" href="actualites.php"><p class="link">Actualités</p></a>
			  <a class="link" href="services.php"><p class="link">Services</p></a>
        <a class="link" href="produits.php"><p class="link">Produits</p></a>
			  <a class="link" href="contact.php"><p class="link" id="page-actuel">Contact</p></a>
			</div>
		  </nav>
		</div>
    <!-- Fin de la navbar -->
    <!-- Formulaire -->
      <div class="container" data-aos="zoom-in-up" data-aos-duration="2000">
      <form class="contact-form" method="POST" >
          <div class="titre">
      <h1>Contactez-nous</h1>
          </div>
      <div class="separation"></div>
      <div class="corps-formulaire">
        <!-- Haut du formulaire -->
        <div class="haut">
          <div class="groupe">
            <label>Nom<label class="requis">*</label></label>
            <input type="text" name="nom" placeholder="Saisissez ici..." value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" require/>
            <i class="fas fa-user"></i>
            </div>
            <div class="groupe">
              <label>Prénom<label class="requis">*</label></label>
              <input type="text" name="prénom" placeholder="Saisissez ici..." value="<?php if(isset($_POST['prénom'])) { echo $_POST['prénom']; } ?>" require/>
              <i class="fas fa-user"></i>
            </div>   
            <div class="groupe">
            <label>Adresse e-mail<label class="requis">*</label></label>
            <input type="email" name="email"placeholder="Saisissez ici..." value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" require/>
            <i class="fas fa-envelope"></i>
            </div>
            <div class="groupe">
            <label>Téléphone</label>
            <input type="text" name="téléphone" placeholder="Saisissez ici..." value="<?php if(isset($_POST['téléphone'])) { echo $_POST['téléphone']; } ?>"/>
            <i class="fas fa-mobile"></i>
            </div>
            <div class="groupe">
            <label>Société</label>
            <input type="text" name="société" placeholder="Saisissez ici..." value="<?php if(isset($_POST['société'])) { echo $_POST['société']; } ?>" require/>
            <i class="fas fa-building"></i>
            </div>
            <div class="groupe">
            <label>Fonction</label>
            <input type="text" name="fonction"placeholder="Saisissez ici..." value="<?php if(isset($_POST['fonction'])) { echo $_POST['fonction']; } ?>"/>
            <i class="fas fa-briefcase"></i>
      </div>
      <!-- Fin du haut du formulaire -->
      <!-- Début du bas du formulaire -->
        </div>                 
        <div class="bas">
          <div class="groupe" id="message">
            <label>Objet<label class="requis">*</label></label>
            <input type="text" name="objet" placeholder="Saisissez ici..." value="<?php if(isset($_POST['objet'])) { echo $_POST['objet']; } ?>" require/>
            <i class="fas fa-inbox"></i>
          </div>
          <div class="groupe" id="message">
            <label>Message<label class="requis">*</label></label>
            <textarea name="message"placeholder="Saisissez ici..." value="<?php if(isset($_POST['message'])) { echo $_POST['message']; } ?>" require></textarea>
            <i class="fas fa-message"></i>
          </div>
        </div>
      </div>
      <!-- Fin du bas du formulaire -->
      <!-- Pied de page -->
      <div class="groupe">
      <input type="checkbox" id="ma_checkbox" name="ma_checkbox">
    <label for="ma_checkbox" class=" mentions">J'ai lu et accepté les <a  href="Mentions_Legales.html">mentions légales</a></label>
    <span class="requis">*</span>
</div>

      <div class="pied-formulaire">
        <button type="submit" name="ok">Envoyer le message</button>
      </div>
      <?php

      if(isset($msg) && $statut == "success")
      {
        echo "<script>Swal.fire({
          title: '$msg', icon: '$statut', confirmButtonText: 'Confirmer',
        }).then((result) => {
          if (result.isConfirmed) {
           document.location.href='index.php';}
        });
      </script>";
      
      }
      if(isset($msg) && $statut == "error")
      {
        echo "<script>Swal.fire({
          title: '$msg', icon: '$statut', confirmButtonText: 'Confirmer',});
      </script>";
      
      }
      
	  ?>

      <!-- Fin de pied de page -->
    </form>
  </div>
  </div>
  <!-- Fin du formulaire -->
  <?php require_once 'partials/footer.php' ?>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="assets/js/menuburger.js"></script>
			<script>
				AOS.init();
			  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>