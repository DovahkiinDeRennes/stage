<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// require 'C:\wamp64\www\PHPMailer\src/Exception.php';
// require 'C:\wamp64\www\PHPMailer\src/PHPMailer.php';
// require 'C:\wamp64\www\PHPMailer\src/SMTP.php';

// $phpmailer = new PHPMailer;
// $phpmailer->isSMTP();
// $phpmailer->Host = 'smtp.gmail.com';
// $phpmailer->SMTPAuth = true;
// $phpmailer->Port = 587;
// $phpmailer->Username = 'alzzrtt@gmail.com';
// $phpmailer->Password = 'gqcn ohar uxui dplv';


// $to = 'alzzrtt@gmail.com';
// $subject = 'Formulaire de contact';
// $message = 'ceci est un message';
// // $message = $_POST['message'];
// if (mail($to, $subject, $message)) {
//     echo "Votre mail a bien été envoyé";
// }
// else {
//     echo "il y a eu un probleme lors de l'envoie du mail";
// }
?>
<?php

   
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "fidelilium";

    $prénom = $_POST["prénom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $téléphone = $_POST["téléphone"];
    $société = $_POST["société"];
    $fonction = $_POST["fonction"];
    $objet = $_POST["objet"];
    $message = $_POST["message"];
    $mysqli = new mysqli($host, $username, $password, $db);
    mysqli_query($db, "INSERT INTO contact VALUES 
    ('$prénom','$nom','$email','$téléphone','$société','$fonction','$objet','$message')");
?>