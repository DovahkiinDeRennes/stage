<?php

require_once(__DIR__ . '/../../../../csp_config.php');
include(__DIR__ . '/../../admin/navbar.php');
?>
<link rel="stylesheet" href="/assets/css/admin.css" />
<h2 class="centre">Ajouter une catégorie</h2>
<div class="centre">

<form method="post">
    <label for="libelle">Libellé :</label>
    <input type="text" id="libelle" name="libelle" required>
    <button type="submit" name="ok">Envoyer</button>
</form>
</div>
<a class="centre" href="categories.php"><input type="button" value="Retour"></a>