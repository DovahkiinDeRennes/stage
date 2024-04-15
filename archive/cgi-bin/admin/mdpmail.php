<?php
include(__DIR__ . '/../assets/php/check_login.php');
include(__DIR__ . '/../assets/php/connection.php');
$to = "alzzrtt@gmail.com";
$subject = "Réinitialiser le mot de passe";
$message = '<form action="" method="POST" enctype="multipart/form-data">
<label>
<label>Nouveau mot de passe</label><br>
<input type="password" name="mdp" value="" placeholder="Veuillez saisir ici..."><br>
<input type="submit" value="Modifier" name="ok"><br>
</form>';
mail($to, $subject, $message, "From: $to");
// if (isset($_POST['ok'])) {
//     $update_query = "UPDATE compte SET  mdp = '$mdp' WHERE id = $id";
//     $req = mysqli_query($db, $update_query);

//     if ($req) {
//         // Si la requête a été effectuée avec succès, redirection
//         // header("location: actualites_creation.php");
//     } else {
//         // Sinon, produit non modifié
//         $message = "Produit non modifié";
//     }

// }
// else{
//     $message = "Mot de passe incorrect";
// }
?>