<?php
include('getWithTypes.php');
include('src/pages/core/connection.php');

// Obtenez les produits avec la clé 'type'
$produits = getProduitsWithType($db);
// Obtenez les repository avec la clé 'type'
$services = getServicesWithType($db);

// Combinez les produits et les repository dans un tableau unique
$infos = [...$services, ...$produits];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/caroussel.css"> <!-- Corrige la balise link -->
    <script src="/assets/js/caroussel.js"></script>
    <title>Document</title>
</head>
<body>
<h2>Découvrez nos services et produits : </h2>
<div class="carousel-container">
    <div class="carousel">
        <?php foreach ($infos as $info) : ?>
            <?php
            $direction = ($info['type'] === 'produits') ? 'produits' : 'repository';
            ?>
            <div class="carousel-item">
                <a href='/info.php?id=<?= $info['id'] ?>&amp;titre=<?= urlencode($info['titre']) ?>&direction=<?= $direction ?>'>
                    <img src='/images/servicesetproduits/<?= $info['image_url']; ?>' alt='<?= $info['alt_text']; ?>'>
                    <h3><?= $info['titre']; ?></h3>
                    <?php
                    $description = $info['description'];
                    if (strlen($description) > 80) {
                        $description = substr($description, 0, 80) . "...";
                    }
                    ?>
                    <p><?= $description; ?></p>
                </a>
            </div>
        <?php endforeach ?>
    </div>
    <div class="navigation-manuelle">
        <button class="prev"><img src="/images/fleche-gauche.png" alt="Précédent"></button>
        <button class="next"><img src="/images/fleche-droite.webp" alt="Suivant"></button>
    </div>
    <div class="carousel-nav">
        <div class="pagination"></div>
    </div>
</div>
</body>
</html>