<?php


require_once(__DIR__ . '/../csp_config.php');

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
    <script src="/https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="icon" href="/images/Fidelilium_Logo_Simple.png">
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/admin.css" />
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>

<body>
<header>
    <div class="menuburger">
        <div id="mySidenav" class="sidenav">
            <a id="closeBtn" href="#" class="close">×</a>
            <a href="/admin/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                        srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
            <ul>
                <li><a href="/index.php" id="page-actuelle-menu">Accueil</a></li>
                <li><a href="/contact.php">Contact</a></li>
                <li><a href="/actualites.php">Actualités</a></li>
            </ul>
        </div>

        <a href="#" id="openBtn" class="burger-icon">
            <i class="fa-solid fa-bars fa-2xl"></i>
        </a>
        <a href="index.php" data-aos="fade-right" data-aos-duration="1000"><img
                    srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
    </div>
    <div class="navbar">
        <nav>
            <a href="/admin/index.php" data-aos="fade-right" data-aos-duration="1000"><img srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
            <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
                <a class="link" href="/index.php"><p class="link"  id="page-actuel">Accueil</p></a>
                <a class="link" href="/contact.php"><p class="link">Contact</p></a>
                <a class="link" href="/actualites.php"><p class="link">Actualités</p></a>
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
        <a href="mdpmail.php?id=1" name="reset">Mot de passe oublié ?</a><br>
        <button type="submit">Se connecter</button>
        <?php // Vérifie si le formulaire de connexion a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../src/pages/core/connection.php';
            $stmt = $db->prepare("SELECT * FROM compte");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $username = $row['utilisateur'];
            $password = $row['mdp'];
            $password_write = sha1($_POST['password']);
            // Vérifie les informations de connexion
            if ($_POST['username'] === $username AND $password_write === $password) {
                $_SESSION['admin_logged_in'] = true;
                echo "<script src = '/assets/js/connection.js'></script>";
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