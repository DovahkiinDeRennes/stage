<?php
require_once(__DIR__ . '/../csp_config.php');
?>

<header>
    <div class="menuburger">
        <div id="mySidenav" class="sidenav">
            <a id="closeBtn" href="#" class="close">×</a>
            <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
            <ul>
                <li><a href="/index.php">Accueil</a></li>
                <li><a href="/actualites.php" id="page-actuelle-menu">Actualités</a></li>
                <li><a href="/services.php">Services</a></li>
                <li><a href="/produits.php">Produits</a></li>
                <li><a href="/contact.php">Contact</a></li>
            </ul>
        </div>

        <a href="#" id="openBtn" class="burger-icon">
            <i class="fa-solid fa-bars fa-2xl"></i>
        </a>
        <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
    </div>
    <div class="navbar">
        <nav>
            <a href="/index.php" data-aos="fade-right" data-aos-duration="1000"><img srcset="images/Fifelilium_Logo_Solo_RVB.svg" style="width: 120px;" alt="Logo de fidelilium"></a>
            <div class="onglets" data-aos="fade-left" data-aos-duration="1000">
                <a class="link" href="/index.php">
                    <p class="link">Accueil</p>
                </a>
                <a class="link" href="/actualites.php">
                    <p class="link navHeader" id="page-actuel">Actualités</p>
                </a>
                <a class="link" href="/services.php">
                    <p class="link navHeader">Services</p>
                </a>
                <a class="link" href="/produits.php">
                    <p class="link navHeader">Produits</p>
                </a>
                <a class="link" href="/contact.php">
                    <p class="link navHeader">Contact</p>
                </a>
            </div>
        </nav>
    </div>
</header>