<?php
include(__DIR__ . '/../src/pages/core/connection.php');
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $check_token_query = "SELECT id FROM compte WHERE reset_token = '$token'";
    $token_result = mysqli_query($db, $check_token_query);

    if (mysqli_num_rows($token_result) > 0) {
        // Token is valid, allow the user to reset the password
        if (isset($_POST['reset'])) {
            $new_password = mysqli_real_escape_string($db, $_POST['new_password']);
            $hashed_password = sha1($new_password);

            $row = mysqli_fetch_assoc($token_result);
            $user_id = $row['id'];

            // Update the password and reset token in the database
            $update_password_query = "UPDATE compte SET mdp = '$hashed_password', reset_token = NULL WHERE id = $user_id";
            $update_result = mysqli_query($db, $update_password_query);

            if ($update_result) {
                // Password reset successful, redirect to login page
                header("Location: index.php");
                exit();
            } else {
                // Handle database update failure
                echo "Error updating password.";
            }
        }
    } else {
        // Invalid token
        echo "Invalid token. Please try again.";
    }
} else {
    // No token provided
    echo "Token not provided.";
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
