<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>
<body>
    <?php
    session_start();

    // Vérifie si l'admin est déjà connecté, redirige vers la page d'administration s'il est connecté
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        header("Location: admin_page.php");
        exit();
    }

    // Vérifie si le formulaire de connexion a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = 'admin';
        $password = 'admin123';

        // Vérifie les informations de connexion
        if ($_POST['username'] === $username && $_POST['password'] === $password) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_page.php");
            exit();
        } else {
            echo "Identifiants incorrects. Veuillez réessayer.";
        }
    }
    ?>
    		<div class="navbar">
		<nav>
			  <a href="index.html" data-aos="fade-right" data-aos-duration="1000"><img srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
			  <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
			  <a class="link" href="index.html"><p class="link"  id="page-actuel">Accueil</p></a>
			  <a class="link" href="contact.php"><p class="link">Nous contacter</p></a>
			</div>
		  </nav>
		</div>
    <center>
    <h2>Connexion Admin</h2>
    <form method="post" action="">
        <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required><br>

        <button type="submit">Se connecter</button>
    </form>
</center>
</body>
</html>
