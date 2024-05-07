<?php
require_once __DIR__ . '/../src/pages/core/connection.php';
?>

<head>
    <script src="https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="icon" href="/images/Fidelilium_Logo_Simple.png">
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/admin.css" />
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>

<body>
<center>
    <h2>Mot de passe oublié sécurité</h2>
    <form method="post" action="">
        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
        <?php // Vérifie si le formulaire de connexion a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../src/pages/core/connection.php';
            $stmt = $db->prepare("SELECT * FROM compte_passerelle");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $username = $row['utilisateur'];
            $password = $row['mdp'];
            $password_write = sha1($_POST['password']);
            // Vérifie les informations de connexion
            if ($_POST['username'] === $username AND $password_write === $password) {
                $id = $_GET['id'];
                // Requête pour afficher les infos d'un produit
                $stmt = $db->prepare("SELECT * FROM compte WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $email = "fidelilium@gmail.com"; // Change this to your email address

                // Generate a random password reset token
                $token = bin2hex(random_bytes(32));

                // Update the user's database record with the token
                $update_query = "UPDATE compte SET reset_token = :token WHERE id = :id";
                $update_stmt = $db->prepare($update_query);
                $update_stmt->bindParam(':token', $token);
                $update_stmt->bindParam(':id', $id);
                $update_result = $update_stmt->execute();

                if ($update_result) {
                    // Compose the email
                    $subject = "Password Reset";
                    $message_mail = "Click the following link to reset your password: https://fidelilium.com/admin/reset_password.php?id=$id?token=$token";

                    // Additional headers
                    $headers = "From: fidelilium@gmail.com"; // Your email address

                    // Send the email
                    $mail_sent = mail($email, $subject, $message_mail, $headers);

                    if ($mail_sent) {
                        // Redirect or display a success message
                        echo "<script>alert('Password reset link sent to your email.');</script>";
                        echo "<script>window.location.href = 'index.php';</script>";
                    } else {
                        // Handle email sending failure
                        echo "<script>alert('Error sending email.');</script>";
                    }
                } else {
                    // Handle database update failure
                    echo "<script>alert('Error updating database.');</script>";
                }
            } else {
                echo "Identifiants incorrects Veuillez réessayer.";
            }
        }
        ?>
    </form>
</center>
</body>