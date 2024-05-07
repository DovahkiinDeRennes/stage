<?php



session_start();
# Vérifie si l'admin est connecté, redirige vers la page de connexion s'il n'est pas connecté
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /admin/index.php");
    exit();
}
