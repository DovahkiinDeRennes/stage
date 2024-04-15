<?php
   session_start();
    ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les actualités</title>
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/admin.css" />
</head>
<body>
    <?php
    include (__DIR__ . '/../assets/php/connection.php');
    include (__DIR__ . '/../assets/php/check_login.php');

    // On récupère l'ID dans le lien
    $id = $_GET['id'];
    // Requête pour afficher les infos d'un produit
    $req = mysqli_query($db, "SELECT * FROM compte WHERE id = $id");
    $row = mysqli_fetch_assoc($req);

    // Vérifier que le bouton Modifier a bien été cliqué
    if (isset($_POST['ok'])) {
        $password = $row['mdp'];
        // Vérifie les informations de connexion
        if ($_POST['oldmdp'] === $password) {
        $utilisateur = mysqli_real_escape_string($db, $_POST['newusername']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $update_query = "UPDATE compte SET utilisateur = '$utilisateur' , mdp = '$mdp' WHERE id = $id";
        $req = mysqli_query($db, $update_query);

        if ($req) {
            // Si la requête a été effectuée avec succès, redirection
            // header("location: actualites_creation.php");
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            // Sinon, produit non modifié
            $message = "Produit non modifié";
        }
    
    }
    else{
        $message = "Mot de passe incorrect";
    }
}
if (isset($_POST['reset'])) {
    $email = "alzzrtt@gmail.com"; // Change this to your email address

    // Generate a random password reset token
    $token = bin2hex(random_bytes(32));

    // Update the user's database record with the token
    $update_query = "UPDATE compte SET reset_token = '$token' WHERE id = $id";
    $update_result = mysqli_query($db, $update_query);

    if ($update_result) {
        // Compose the email
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: http://fidelilium.com/admin/reset_password.php?token=$token";

        // Additional headers
        $headers = "From: alzzrtt@gmail.com"; // Your email address

        // Send the email
        $mail_sent = mail($email, $subject, $message, $headers);

        if ($mail_sent) {
            // Redirect or display a success message
            echo "<script>alert('Password reset link sent to your email.');</script>";
        } else {
            // Handle email sending failure
            echo "<script>alert('Error sending email.');</script>";
        }
    } else {
        // Handle database update failure
        echo "<script>alert('Error updating database.');</script>";
    }
}
    ?>
<?php include (__DIR__ . '/../assets/php/navbar.php'); ?>

    <div class="form">
        <a href="actualites_creation.php" class="back_btn"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Retour</a>
        <center>
            <h2>Modifier admin : <?php echo
             $row['utilisateur'];
             ?> </h2>
            
            <p class="erreur_message">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </p>
            <form action="" method="POST" enctype="multipart/form-data">
                <label>Nom d'utilisateur</label><br>
                <input type="text" name="newusername" value="<?php echo $row['utilisateur'] ?>"><br>
                <label>Nouveau mot de passe</label><br>
                <input type="password" name="mdp" value="" placeholder="Veuillez saisir ici..."><br>
                <label>Ancien mot de passe</label><br>
                <input type="password" name="oldmdp" value=""placeholder="Veuillez saisir ici..."><br>
                <input type="submit" value="Modifier" name="ok"><br>
                <input type="submit" value="Reset Password" name="reset"><br>
            </form>
        </center>
    </div>
</body>

</html>