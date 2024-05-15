<?php
include (__DIR__ . '/src/pages/core/connection.php');
include (__DIR__ . '/src/pages/admin/mail/ajouter.php');
require_once(__DIR__ . '/csp_config.php');







?>
<html lang="fr">

<head>
    <title>Page de contact</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="icon" type="image/x-icon" href="images/favicon.html">
    <link rel="icon" href="images/Fidelilium_Logo_Simple.webp">
    <link rel="stylesheet" href="assets/css/contact.css" />
    <link rel="stylesheet" href="assets/css/navbar.css" />
    <link rel="stylesheet" href="assets/css/footer.css" />
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/fontawesome-free-6.1.2-web/css/all.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.html" /></noscript>
    <link href="<?php echo $urlAosCss; ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $urlCdnjsCloud; ?>"/>
    <script src="<?php echo $urlCdnJsdelivr; ?>"></script>
    <script src="<?php echo $urlFontAwesomeJs; ?>" crossorigin="anonymous"></script>


</head>
<body>


<?php require_once 'partials/header.php' ?>
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
            <label for="ma_checkbox" class=" mentions">J'ai lu et accepté les <a  href="Mentions_Legales.php">mentions légales</a></label>
            <span class="requis">*</span>
        </div>

        <div class="pied-formulaire">
            <button type="submit" name="ok">Envoyer le message</button>
        </div>
        <?php
        // Génération des nonces


        if (isset($msg) && $statut == "success") {
            echo "<script nonce=\"{$nonce1}\">Swal.fire({
      title: '{$msg}', icon: '{$statut}', confirmButtonText: 'Confirmer'
    }).then((result) => {
      if (result.isConfirmed) {
       document.location.href='index.php';
      }
    });
  </script>";
        }

        if (isset($msg) && $statut == "/error") {
            echo "<script nonce=\"{$nonce2}\">Swal.fire({
      title: '{$msg}', icon: '{$statut}', confirmButtonText: 'Confirmer'
    });
  </script>";
        }
        ?>

        <!-- Fin de pied de page -->
    </form>
</div>
</div>
<!-- Fin du formulaire -->
<?php require_once 'partials/footer.php' ?>

<script src="<?php echo $urlAosJs; ?>"></script>
<script src="assets/js/menuburger.js"></script>
<script src="assets/js/aos.js"></script>

</body>
</html>