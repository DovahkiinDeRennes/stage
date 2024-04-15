<?php
include(__DIR__ . '/../../assets/php/connection.php');
include(__DIR__ . '/../../assets/php/check_login.php');
$id = $_GET['id'];
if (mysqli_query($db, "DELETE FROM contact WHERE id = $id")) {
    header("Location: mail.php");
}

?>