<?php
include(__DIR__ . '/../../../../../admin/check_login.php');
include(__DIR__ . '/../../../core/connection.php');
require_once(__DIR__ . '/../../../../../csp_config.php');
include(__DIR__ . '/../../../admin/navbar.php');

?>


<link rel="stylesheet" href="/assets/css/urlChiffrage.css" />
<link rel="stylesheet" href="/assets/css/admin.css" />
<script src="/assets/js/affichagePassword.js"></script>

    <?php require_once (__DIR__ . '/ajouterModifier.php'); ?>
