<?php
include(__DIR__ . '/../../../classes/Mail.php');
include(__DIR__ . '/../../core/connection.php');
require_once(__DIR__ . '/../../../../csp_config.php');
if (isset($_POST['ok'])) {

    if (isset($_POST["ma_checkbox"])) {

        $conditions = "Oui";

        if (!empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['message'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "Adresse e-mail non valide";
                $statut = "error";
            }

                $nom = $_POST['nom'] ?? '';
                $prenom = $_POST["prénom"] ?? '';
                $telephone = $_POST["téléphone"] ?? '';
                $societe = $_POST["société"] ?? '';
                $fonction = $_POST["fonction"] ?? '';
                $objet = $_POST["objet"] ?? '';
                $message = htmlspecialchars($_POST["message"]) ?? '';

                // Utilisation de requêtes préparées pour éviter les injections SQL
                $mail = new Mail($db);
                $mail->insert($nom, $prenom, $email, $telephone, $societe, $fonction, $objet, $message, $conditions);

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
    } else {
        $statut = "error";
        $msg = "Vous devez accepter nos conditions";
    }
}






