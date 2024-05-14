<?php

require_once(__DIR__ . '/../../../../csp_config.php');

?>

<h2>Ajouter une url à chiffré</h2>

<form method="post">

    <label for="url">url :</label>
    <input type="text" id="url" name="url" required>

 <!--  <label for="urlSafe">urlSafe :</label>
    <input type="text" id="urlSafe" name="urlSafe" required> -->

    <button type="submit" name="ok">Envoyer</button>
</form>