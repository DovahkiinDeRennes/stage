<?php

require_once(__DIR__ . '/../../../../csp_config.php');
include(__DIR__ . '/../../admin/navbar.php');
?>
<link rel="stylesheet" href="/assets/css/admin.css" />
<h2 class="centre">Modifier une catégorie</h2>
<div class="centre">
<form action="" method="POST" enctype="multipart/form-data">
    <label for="libelle">Libellé</label><br>
    <input type="text" name="libelle" id="libelle" value="<?= $row['libelle'] ?>"><br>
    <button type="submit" name="ok">Envoyer</button>
</form>
</div>
<a class="centre" href="categories.php"><input type="button" value="Retour"></a>