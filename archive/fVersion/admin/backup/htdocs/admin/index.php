<?php
    session_start();

    // Vérifie si l'admin est déjà connecté, redirige vers la page d'administration s'il est connecté
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        header("Location: admin_page.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="fr">

<head>
<script src="https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/admin.css" />
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>

<body>
<header>
<div class="menuburger">
			<div id="mySidenav" class="sidenav">
				<a id="closeBtn" href="#" class="close">×</a>
				<a href="index.html" data-aos="fade-right" data-aos-duration="1000"><img
						srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
				<ul>
                <li><a href="/archive/index.html" id="page-actuelle-menu">Accueil</a></li>
				<li><a href="/contact.php">Contact</a></li>
				</ul>
			</div>
	
			<a href="#" id="openBtn" class="burger-icon">
	
            <i class="fa-solid fa-bars"></i>
	
			</a>
			<a href="index.html" data-aos="fade-right" data-aos-duration="1000"><img
					srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
		</div>
        <div class="navbar">
            <nav>
                <a href="/archive/index.html" data-aos="fade-right" data-aos-duration="1000"><img srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
                <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
                <a class="link" href="/src/fideliliumAdmin/admin/index.php"><p class="link" id="page-actuel">Admin</p></a>
                <a class="link" href="/src/fideliliumAdmin/admin/mail/mail.php"><p class="link">Voir les Mails</p></a>
                <a class="link" href="/src/fideliliumAdmin/admin/servicesetproduits/servicesetproduits_creation.php"><p class="link">Créer des Services et Produits</p></a>
                <a class="link" href="/src/fideliliumAdmin/admin/actualites/actualites_creation.php"><p class="link">Créer des Actualités</p></a>
                <a class="link" href="/src/fideliliumAdmin/admin/logout.php"><p class="link">Se deconnecter</p></a>
                </div>
            </nav>
        </div>
</header>
<script src="/assets/js/menuburger.js"></script>
            <center>
                <h2>Connexion Admin</h2>
                <form method="post" action="">
                    <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required><br>
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required><br>

                    <button type="submit">Se connecter</button>
                   <?php // Vérifie si le formulaire de connexion a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include (__DIR__ . '/../assets/php/connection.php');
        $req = mysqli_query($db, "SELECT * FROM compte");
        $row = mysqli_fetch_assoc($req);
        $username = $row['utilisateur'];
        $password = $row['mdp'];
        // Vérifie les informations de connexion
        if ($_POST['username'] === $username && $_POST['password'] === $password) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_page.php");
            
            exit();
        } else {
            echo "Identifiants incorrects Veuillez réessayer.";
        }
    }
?>
                </form>
            </center>
        <script src="/assets/js/menuburger.js"></script>
</body>

</html>