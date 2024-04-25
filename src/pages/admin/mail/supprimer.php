<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/Mail.php');
$id = $_GET['id'];

$mail = new Mail($db);


if ($mail->delete($id)) {
    header("Location: mail.php");
}

