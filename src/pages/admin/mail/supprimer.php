<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../services/MailService.php');
require_once(__DIR__ . '/../../../../csp_config.php');

$id = $_GET['id'];

$mail = new MailService($db);

if ($mail->delete($id)) {
    header("Location: mail.php");
    exit(); // Ajout de exit() pour arrêter l'exécution du script après la redirection
}
