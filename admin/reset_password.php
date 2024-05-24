<?php


require_once(__DIR__ . '/../csp_config.php');


require_once __DIR__ . '/../src/pages/core/connection.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $check_token_query = "SELECT id FROM compte WHERE reset_token = :token";
    $check_token_stmt = $db->prepare($check_token_query);
    $check_token_stmt->bindParam(':token', $token);
    $check_token_stmt->execute();

    if ($check_token_stmt->rowCount() > 0) {
        // Token is valid, allow the user to reset the password
        if (isset($_POST['reset'])) {
            $new_password = htmlspecialchars($_POST['new_password']);
            $confirm_new_password = htmlspecialchars($_POST['confirm_new_password']);

            // Check if passwords match
            if ($new_password === $confirm_new_password) {
                $hashed_password = sha1($new_password);

                $row = $check_token_stmt->fetch(PDO::FETCH_ASSOC);
                $user_id = $row['id'];

                // Update the password and reset token in the database
                $update_password_query = "UPDATE compte SET mdp = :hashed_password, reset_token = NULL WHERE id = :user_id";
                $update_password_stmt = $db->prepare($update_password_query);
                $update_password_stmt->bindParam(':hashed_password', $hashed_password);
                $update_password_stmt->bindParam(':user_id', $user_id);
                if ($update_password_stmt->execute()) {
                    // Password reset successful, redirect to login page
                    header("Location: index.php");
                    exit();
                } else {
                    // Handle database update failure
                    echo "Error updating password.";
                }
            } else {
                echo "Les mots de passe ne correspondent pas.";
            }
        }
    } else {
        // Invalid token
        echo "Jeton invalide. Veuillez réessayer.";
    }
} else {
    // No token provided
    echo "Jeton non fourni.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <!-- Add your CSS stylesheets if needed -->
</head>

<body>
<h2>Réinitialiser le mot de passe</h2>

<form action="" method="POST">
    <label>Nouveau mot de passe</label><br>
    <input type="password" name="new_password" required><br>
    <label>Confirmer le nouveau mot de passe</label><br>
    <input type="password" name="confirm_new_password" required><br>
    <input type="submit" value="Réinitialiser" name="reset"><br>
</form>
</body>

</html>