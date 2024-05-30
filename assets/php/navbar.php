<html>
<head>
    <link rel="icon" href="/images/Fidelilium_Logo_Simple.png">
    <script src="https://kit.fontawesome.com/0d6d431c4d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/navbar.css" />
</head>
<body>
    <header>
        <?php
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo '<div class="menuburger">
        <div id="mySidenav" class="sidenav">
            <a id="closeBtn" href="#" class="close">×</a>
            <a href="index.php" data-aos="fade-right" data-aos-duration="1000"><img
                    srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
            <ul>
                <li><a href="index.php" id="page-actuelle-menu">Accueil</a></li>
                <li><a href="actualites.php">Actualités</a></li>
                <li><a href="repository.php">Services</a></li>
                <li><a href="produits.php">Produits</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <a href="#" id="openBtn" class="burger-icon">
            <i class="fa-solid fa-bars fa-2xl"></i>
        </a>
        <a href="index.php" data-aos="fade-right" data-aos-duration="1000"><img
                srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
    </div>
    <div class="navbar">
    <nav>
          <a href="index.php" data-aos="fade-right" data-aos-duration="1000"><img srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
          <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
          <a class="link" href="index.php"><p class="link"  id="page-actuel">Accueil</p></a>
          <a class="link" href="actualites.php"><p class="link">Actualités</p></a>
          <a class="link" href="repository.php"><p class="link">Services</p></a>
          <a class="link" href="produits.php"><p class="link">Produits</p></a>
          <a class="link" href="contact.php"><p class="link">Contact</p></a>
        </div>
      </nav>
    </div>';
        }
        else {
            echo '<div class="menuburger">
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">×</a>
                <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                        srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
                <ul>
                    <li><a class="link" href="/admin/index.php">
                            <p class="link" id="page-actuel">Admin</p>
                        </a>
                    <li><a class="link" href="/admin/mail/mail.php">
                            <p class="link">Mails</p>
                        </a></li>
                    <li><a class="link" href="/admin/repository/repository.php">
                            <p class="link">Services</p>
                        </a></li>
                    <li><a class="link" href="/admin/produits/produits.php">
                            <p class="link">Produits</p>
                        </a></li>
                    <li><a class="link" href="/admin/actualites/actualites_creation.php">
                            <p class="link">Actualités</p>
                        </a></li>
                    <li><a class="link" href="/admin/logout.php">
                            <p class="link">Se deconnecter</p>
                        </a></li>
                </ul>
            </div>
            <a href="#" id="openBtn" class="burger-icon">
                <i class="fa-solid fa-bars"></i>
            </a>
            <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                    srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
        </div>
        <div class="navbar">
            <nav>
                <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                        srcset="/images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;"></a>
                <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
                    <a class="link" href="/admin/index.php">
                        <p class="link" id="page-actuel">Admin</p>
                    </a>
                    <a class="link" href="/admin/mail/mail.php">
                        <p class="link">Mails</p>
                    </a>
                    <a class="link" href="/admin/repository/repository.php">
                        <p class="link">Services</p>
                    </a>
                    <a class="link" href="/admin/produits/produits.php">
                        <p class="link">Produits</p>
                    </a>
                    <a class="link" href="/admin/actualites/actualites_creation.php">
                        <p class="link">Actualités</p>
                    </a>
                    <a class="link" href="/admin/logout.php">
                        <p class="link">Se deconnecter</p>
                    </a>
                </div>
            </nav>
        </div>';
        }
        ?>

    </header>
    <script src="/assets/js/menuburger.js"></script>
</body>
</html>