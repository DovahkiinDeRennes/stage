<?php
include (__DIR__ . '/assets/php/connection.php'); 
if(isset($_POST['ok'])) {
    if(!empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['email']) && !empty($_POST['société']) && !empty($_POST['objet']) && !empty($_POST['message'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $msg = "adresse e-mail non valide";
          $statut = "error";
            // Gérer l'erreur pour une adresse e-mail non valide
        }
        else {
          
          $prénom = $_POST["prénom"];
          $nom = $_POST["nom"];
          $téléphone = $_POST["téléphone"];
          $société = $_POST["société"];
          $fonction = $_POST["fonction"];
          $objet = $_POST["objet"];
          $message = htmlspecialchars($_POST["message"]);
          $date = date("Y-m-d H:i:s");  // This gets the current date and time in the correct format

        }
          
        $stmt = $db->prepare("INSERT INTO contact (nom, prenom, mail, tel, societe, fonction, object, message, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssssssss", $nom, $prénom, $email, $téléphone, $société, $fonction, $objet, $message);        
        $stmt->execute();
        $stmt->close();

        $to = 'fidelilium@gmail.com';
        $subject = 'Formulaire de contact';

        // Utilisation d'une bibliothèque de messagerie (par exemple, PHPMailer) est recommandée
        mail($to, $subject, print_r($_POST, true), "From: $email");

        $msg = "Votre message a bien été envoyé, Vous allez être redirigé !";
        $statut = "success";
    } else {
        $msg = "* Tous les champs doivent être complétés !";
        $statut = "error";
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
		<link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.html" /></noscript>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
       
  </head>
  <body>
  <div class="all">
    <!-- Début de la navbar -->     
		<div class="navbar">
		<nav>
			  <a href="index.html" data-aos="fade-right" data-aos-duration="1000"><img srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
			  <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
			  <a class="link" href="index.html"><p class="link"  >Accueil</p></a>
			  <a class="link" href="contact.php"><p class="link" id="page-actuel">Nous contacter</p></a>
			</div>
		  </nav>
		</div>
    <!-- Fin de la navbar -->
    <!-- Formulaire -->
      <div class="container" data-aos="zoom-in-up" data-aos-duration="2000">
      <form class="contact-form" method="POST" >
      <h1>Contactez-nous</h1>
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
            <label>Société<label class="requis">*</label></label>
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
            <textarea name="message"placeholder="Saisissez ici..."  require><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea>
            <i class="fas fa-message"></i>
          </div>
        </div>
      </div>
      <!-- Fin du bas du formulaire -->
      <!-- Pied de page -->
      <div class="groupe">
      <input type="radio" id="huey" name="drone" value="huey" checked />
    <label for="huey">Huey</label>
  </div>
      <div class="pied-formulaire">
        <input type="radio">
        <button type="submit" name="ok">Envoyer le message</button>
      </div>
      <?php

      if(isset($msg) && $statut == "success")
      {
        echo "<script>Swal.fire({
          title: '$msg', icon: '$statut', confirmButtonText: 'Confirmer',
        }).then((result) => {
          if (result.isConfirmed) {
           document.location.href='index.html';}
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
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
			<script>
				AOS.init();
			  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>