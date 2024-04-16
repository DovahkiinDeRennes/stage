<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');

// On récupère l'ID dans le lien
$id = $_GET['id'];
// Requête pour afficher les infos d'un produit
$req = mysqli_query($db, "SELECT * FROM contact WHERE id = $id");
$row = mysqli_fetch_assoc($req);

// Vérifier que le bouton Modifier a bien été cliqué
if(isset($_POST['ok'])) {
    if(!empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['email']) && !empty($_POST['société']) && !empty($_POST['objet']) && !empty($_POST['message'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $msg = "adresse e-mail non valide";
          $statut = "error";
            // Gérer l'erreur pour une adresse e-mail non valide
        }
        else {
            $nom = mysqli_real_escape_string($db, $_POST['nom']);
            $prenom = mysqli_real_escape_string($db, $_POST['prénom']);
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $tel = mysqli_real_escape_string($db, $_POST['téléphone']);
            $societe = mysqli_real_escape_string($db, $_POST['société']);
            $fonction = mysqli_real_escape_string($db, $_POST['fonction']);
            $objet = mysqli_real_escape_string($db, $_POST['objet']);
            $message_mail = mysqli_real_escape_string($db, $_POST['message']);
        }

        // Requête de modification
        $update_query = "UPDATE contact SET nom = '$nom', prenom = '$prenom', mail = '$email', tel = '$tel', societe = '$societe', fonction = '$fonction', object = '$objet', message = '$message_mail' WHERE id = $id";
        $reponse = mysqli_query($db, $update_query);
        $to = 'fidelilium@gmail.com';
        $subject = 'Formulaire de contact';
        mail($to, $subject, print_r($_POST, true), "From: $email");
         // Si la requête a été effectuée avec succès, redirection
            $msg = "Votre message a bien été envoyé, Vous allez être redirigé !";
            $statut = "success";
        } else {
            // Sinon, produit non modifié
            $msg = "* Tous les champs doivent être complétés !";
            $statut = "error";
        }
    
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Modifier</title>
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/contact.css">
    <link rel="icon" type="/image/x-icon" href="images/favicon.html">
    <link rel="icon" href="/images/Fidelilium_Logo_Simple.png">
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/assets/css/admin.css" />
</head>

<body>
<?php include(__DIR__ . '/../../admin/navbar.php'); ?>

    <div class="form">
        <a href="mail.php" class="back_btn"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14"
                                                 viewBox="0 0 448 512">
                <path
                    d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg> Retour</a>
        <center>
            <h2>Modifier le mail : <?= $row['object'] ?> </h2>
            <p class="erreur_message">
                <?php
                if (isset($msg)) {
                    echo $msg;
                }
                ?>
            </p>
        </center>
        <!-- Formulaire -->
        <div class="container" data-aos="zoom-in-up" data-aos-duration="2000">
            <form class="contact-form" method="POST">
                <h1>Contactez-nous</h1>
                <div class="separation"></div>
                <div class="corps-formulaire">
                    <!-- Haut du formulaire -->
                    <div class="haut">
                        <div class="groupe">
                            <label>Nom<label class="requis">*</label></label>
                            <input type="text" name="nom" placeholder="Saisissez ici..." value="<?= $row['nom'] ?>"
                                require />
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="groupe">
                            <label>Prénom<label class="requis">*</label></label>
                            <input type="text" name="prénom" placeholder="Saisissez ici..."
                                value="<?= $row['prenom'] ?>" require />
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="groupe">
                            <label>Adresse e-mail<label class="requis">*</label></label>
                            <input type="email" name="email" placeholder="Saisissez ici..." value="<?= $row['mail'] ?>"
                                require />
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="groupe">
                            <label>Téléphone</label>
                            <input type="text" name="téléphone" placeholder="Saisissez ici..."
                                value="<?= $row['tel'] ?>" />
                            <i class="fas fa-mobile"></i>
                        </div>
                        <div class="groupe">
                            <label>Société<label class="requis">*</label></label>
                            <input type="text" name="société" placeholder="Saisissez ici..."
                                value="<?= $row['societe'] ?>" require />
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="groupe">
                            <label>Fonction</label>
                            <input type="text" name="fonction" placeholder="Saisissez ici..."
                                value="<?= $row['fonction'] ?>" />
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <!-- Fin du haut du formulaire -->
                        <!-- Début du bas du formulaire -->
                    </div>
                    <div class="bas">
                        <div class="groupe" id="message">
                            <label>Objet<label class="requis">*</label></label>
                            <input type="text" name="objet" placeholder="Saisissez ici..." value="<?= $row['object'] ?>"
                                require />
                            <i class="fas fa-inbox"></i>
                        </div>
                        <div class="groupe" id="message">
                            <label>Message<label class="requis">*</label></label>
                            <textarea name="message" placeholder="Saisissez ici..."
                                require><?= $row['message'] ?></textarea>
                            <i class="fas fa-message"></i>
                        </div>
                    </div>
                </div>
                <!-- Fin du bas du formulaire -->
                <!-- Pied de page -->
                <div class="groupe">
                    <div class="pied-formulaire">
                        <button type="submit" name="ok">Modifier le mail</button>
                    </div>

                    <?php

if(isset($msg) && $statut == "success")
{
  echo "<script>Swal.fire({
    title: '$msg', icon: '$statut', confirmButtonText: 'Confirmer',
  }).then((result) => {
    if (result.isConfirmed) {
     document.location.href='mail.php';}
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
            </form>
        </div>
    </div>
</body>

</html>