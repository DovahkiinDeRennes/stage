<?php

require_once(__DIR__ . '/../../../../csp_config.php');

?>

<form action="" method="POST" enctype="multipart/form-data">
    <label>Libellé</label><br>
    <input type="text" name="libelle" value="<?= $row['libelle'] ?>"><br>
    <input type="submit" value="Modifier" name="ok"><br>
</form>
