<?php
include('src/pages/core/connection.php');

$query = "SELECT * FROM actualite ORDER BY date DESC LIMIT 4";
$stmt = $db->query($query);

if ($stmt) {
    $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $actualites = array_reverse($actualites);
} else {
    echo "Erreur de requête: " . $db->errorInfo()[2];
}

$stmt->closeCursor();
$db = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Carousel</title>
    <link rel="stylesheet" href="/assets/css/caroussel-actu.css">
    <link rel="stylesheet" href="/assets/css/roots.css">
</head>
<body>
<div class="carousel-wrapper">
    <div id="scene">
        <div id="left-zone">
            <ul class="list">
                <?php foreach ($actualites as $actu) { ?>
                    <li class="item">

                        <input type="radio" id="radio<?= $actu['id'] ?>" name="basic_carousel" value="<?= $actu['id'] ?>" checked>
                        <label for="radio<?= $actu['id'] ?>" class="label"><?= date('d/m', strtotime($actu['date'])) ?>:&nbsp;&nbsp;&nbsp;<?= $actu['titre'] ?></label>

                        <div class="content content<?= $actu['id'] ?>">

                            <span class="picto"></span>
                            <h1><?= $actu['titre'] ?></h1>
                            <p><?= strlen($actu['texte']) > 350 ? substr($actu['texte'], 0, 350) . '...' : $actu['texte'] ?></p>

                            <a href="/actualites.php?scroll=200#<?= $actu['id'] ?>" class="lien-actualite"><button class="button-actu">Lire la suite sur la page des actualités</button></a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div id="middle-border"></div>
        <div id="right-zone"></div>
    </div>
</div>
</body>
</html>
