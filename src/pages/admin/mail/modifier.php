<?php
include(__DIR__ . '/../../../classes/Mail.php');
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');

// On récupère l'ID dans le lien
$id = $_GET['id'];

// Requête pour afficher les infos d'un produit
$stmt = $db->prepare("SELECT * FROM contact WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier que le bouton Modifier a bien été cliqué
if(isset($_POST['ok'])) {
    if(!empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['message'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Adresse e-mail non valide";
            $statut = "error";
        } else {
            $nom = $_POST['nom'];
            $prenom = $_POST['prénom'];
            $email = $_POST['email'];
            $tel = $_POST['téléphone'];
            $societe = $_POST['société'];
            $fonction = $_POST['fonction'];
            $objet = $_POST['objet'];
            $message_mail = $_POST['message'];
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
