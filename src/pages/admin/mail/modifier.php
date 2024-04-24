<?php
include(__DIR__ . '/../../../classes/mail.php');
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');

// On récupère l'ID dans le lien
$id = $_GET['id'];
// Requête pour afficher les infos d'un produit
$req = mysqli_query($db, "SELECT * FROM contact WHERE id = $id");
$row = mysqli_fetch_assoc($req);

// Vérifier que le bouton Modifier a bien été cliqué
if(isset($_POST['ok'])) {
    if(!empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['message'])) {
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
        $mail = new Mail($db);
        $mail->update($id, $nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message_mail);


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
include(__DIR__ . '/formulaireModifier.php');
?>
