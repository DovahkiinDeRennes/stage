<?php


require_once(__DIR__ . '/../csp_config.php');


session_start();

// Détruit toutes les données de session, ce qui déconnecte l'administrateur
session_destroy();

// Redirige vers la page de connexion
header("Location: index.php");
exit();
?>
