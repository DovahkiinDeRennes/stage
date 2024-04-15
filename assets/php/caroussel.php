<?php


include('getWithTypes.php');
include('src/fideliliumAdmin/Core/connection.php');

// Obtenez les produits avec la clé 'type'
$produits = getProduitsWithType($db);
// Obtenez les services avec la clé 'type'
$services = getServicesWithType($db);

// Combinez les produits et les services dans un tableau unique
$infos = array_merge($services,$produits);

$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="/assets/css/caroussel.css" href="caroussel.css"> 
    <script src="/assets/js/caroussel.js"></script>
    <title>Document</title>
</head>
<body>
    <h2>Découvrez nos services et produits : </h2>
    <div class="carousel-container">
        <div class="carousel">
            
        <?php foreach ($infos as $info) : ?>
            <?php if ($info['type'] === 'produits') {
                $direction = 'produits';
            } elseif ($info['type'] === 'services') {
                $direction = 'services';
            } ?>
            
            
            
                <div class="carousel-item"> 
                <a href='/info.php?id=<?= $info['id'] ?>&amp;titre=<?= urlencode($info['titre']) ?>&direction=<?=$direction ?>'>
                    <img src='/images/servicesetproduits/<?php echo $info['image_url']; ?>' alt='<?php echo $info['alt_text']; ?>'>
                    <h3><?php echo $info['titre']; ?></h3>
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
        <button class="prev"><img src="/images/fleche-gauche.png" alt="Précédént"></button>
        <button class="next"><img src="/images/fleche-droite.png" alt="Suivant"></button>
        </div>
        <div class="carousel-nav">
    <div class="pagination"></div>
  </div>
    </div>
</body>
</html>