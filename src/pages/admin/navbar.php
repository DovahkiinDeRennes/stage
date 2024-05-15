<?php

require_once(__DIR__ . '/../../../csp_config.php');

?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="icon" href="/images/Fidelilium_Logo_Simple.webp">
    <script src="<?php echo $urlFontAwesomeJs; ?>" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/navbar.css" />
</head>
<body>
<header>
    <?php
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        echo '<div class="menuburger">
        <div id="mySidenav" class="sidenav">
            <a id="closeBtn" href="#" class="close">×</a>
            <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                    srcset="/images/Fifelilium_Logo_Solo_RVB.webp" style="width: 120px;" alt="Logo de fidelilium"></a>
            <ul>
                <li><a href="/index.php" id="page-actuelle-menu">Accueil</a></li>
                <li><a href="/actualites.php">Actualités</a></li>
                <li><a href="/services.php">Services</a></li>
                <li><a href="/produits.php">Produits</a></li>
                <li><a href="/contact.php">Contact</a></li>
            </ul>
        </div>

        <a href="#" id="openBtn" class="burger-icon">
            <i class="fa-solid fa-bars fa-2xl"></i>
        </a>
        <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                srcset="/images/Fifelilium_Logo_Solo_RVB.webp" style="width: 120px;" alt="Logo de fidelilium"></a>
    </div>
    <div class="navbar">
    <nav>
          <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img srcset="/images/Fifelilium_Logo_Solo_RVB.webp" style="width: 120px;" alt="Logo de fidelilium"></a>
          <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
          <a class="link" href="/index.php"><p class="link"  id="page-actuel">Accueil</p></a>
          <a class="link" href="/actualites.php"><p class="link">Actualités</p></a>
          <a class="link" href="/services.php"><p class="link">Services</p></a>
          <a class="link" href="/produits.php"><p class="link">Produits</p></a>
          <a class="link" href="/contact.php"><p class="link">Contact</p></a>
          
        </div>
      </nav>
    </div>';
    }
    else {
        echo '<div class="menuburger">
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">×</a>
                <a href="/admin/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                        srcset="/images/Fifelilium_Logo_Solo_RVB.webp" style="width: 120px;"></a>
                <ul>
                    <li><a class="link" href="/admin/index.php">
                            <p class="link" id="page-actuel">Admin</p>
                        </a>
                    <li><a class="link" href="/src/pages/admin/mail/mail.php">
                            <p class="link">Mails</p>
                        </a></li>
                    <li><a class="link" href="/src/pages/admin/services/services.php">
                            <p class="link">Services</p>
                        </a></li>
                    <li><a class="link" href="/src/pages/admin/produits/produits.php">
                            <p class="link">Produits</p>
                        </a></li>
                    <li><a class="link" href="/src/pages/admin/actualites/actualites.php">
                            <p class="link">Actualités</p>
                        </a></li>
                       <li> 
                        <p class="link">Catégories</p>
                       <a class="link" href="/src/pages/admin/categories/categories.php">
                    </a></li>
                    <li> 
                        <p class="link">Url Chiffrage</p>
                       <a class="link" href="/src/pages/admin/urls/url.php">
                    </a></li>
                    <li>
                    <a class="link" href="/admin/logout.php">
                            <p class="link">Se deconnecter</p>
                        </a></li>
                </ul>
            </div>
            <a href="#" id="openBtn" class="burger-icon">
                <i class="fa-solid fa-bars"></i>
            </a>
            <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                    srcset="/images/Fifelilium_Logo_Solo_RVB.webp" style="width: 120px;"></a>
        </div>
        <div class="navbar">
            <nav>
                <a href="/admin/index.php" data-aos="fade-right" data-aos-duration="1000"><img
                        srcset="/images/Fifelilium_Logo_Solo_RVB.webp" style="width: 120px;"></a>
                <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
                    <a class="link" href="/admin/index.php">
                        <p class="link" id="page-actuel">Admin</p>
                    </a>
                    <a class="link" href="/src/pages/admin/mail/mail.php">
                        <p class="link">Mails</p>
                    </a>
                    <a class="link" href="/src/pages/admin/services/services.php">
                        <p class="link">Services</p>
                    </a>
                    <a class="link" href="/src/pages/admin/produits/produits.php">
                        <p class="link">Produits</p>
                    </a>
                    <a class="link" href="/src/pages/admin/actualites/actualites.php">
                        <p class="link">Actualités</p>
                    </a>
                      <a class="link" href="/src/pages/admin/categories/categories.php">
                        <p class="link">Catégories</p>
                    </a>
                      
                       
                       <a class="link" href="/src/pages/admin/urls/url.php">
          <p class="link">Url Chiffrage</p>
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