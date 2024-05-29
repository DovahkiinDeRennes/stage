<?php
include(__DIR__ . '/../../../services/MailService.php');
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
require_once(__DIR__ . '/../../../../csp_config.php');

// On récupère l'ID dans le lien
$id = $_GET['id'] ?? null;

if ($id !== null) {
    // Requête pour afficher les infos d'un produit
    $stmt = $db->prepare("SELECT * FROM contact WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($id);
    //var_dump($stmt);

}

// Vérifier que le bouton Modifier a bien été cliqué
if(isset($_POST['ok'])) {
    $msg = '';
    $statut = '';

    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['message'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Adresse e-mail non valide";
            $statut = "error";
        }
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $telephone = $_POST['telephone'] ?? '';
            $societe = $_POST['societe'] ?? '';
            $fonction = $_POST['fonction'] ?? '';
            $objet = $_POST['objet'] ?? '';


            $message = htmlspecialchars($_POST['message']) ?? '';





            // Requête de modification
            $mail = new MailService($db);
            $mail->update($id, $nom, $prenom, $email, $telephone, $societe, $fonction, $objet, $message);

            $to = 'fidelilium@gmail.com';
            $subject = 'Formulaire de contact';
            mail($to, $subject, print_r($_POST, true), "From: $email");

            // Si la requête a été effectuée avec succès, redirection
            $msg = "Votre message a bien été envoyé, Vous allez être redirigé !";
            $statut = "success";
            header('Location: mail.php');
            exit();
        }else {
        // Sinon, produit non modifié
        $msg = "* Tous les champs doivent être complétés !";
        $statut = "error";

    }
    }

include(__DIR__ . '/formulaireModifier.php');
