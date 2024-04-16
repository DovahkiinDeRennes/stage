<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
$id = $_GET['id'];
if (mysqli_query($db, "DELETE FROM contact WHERE id = $id")) {
    header("Location: mail.php");
}

?>