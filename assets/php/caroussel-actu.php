<?php
include('src/pages/core/connection.php');

$query = "SELECT * FROM actualite ORDER BY date DESC LIMIT 4";
$stmt = $db->query($query);

if ($stmt) {
    $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $actualites = array_reverse($actualites);
} else {
    echo "Erreur de requête: " . $db->errorInfo()[2];
    exit;
}

function getYouTubeVideoID($url) {
    $videoID = "";
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    if (isset($params['v'])) {
        $videoID = $params['v'];
    }
    return $videoID;
}

$stmt->closeCursor();
$db = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Carousel</title>
    <link rel="stylesheet" href="/assets/css/newCaroussel-actu.css">
    <link rel="stylesheet" href="/assets/css/roots.css">
</head>
<body>
<div class="container">
    <div class="flex">
        <?php if (!empty($actualites)): ?>
            <?php foreach ($actualites as $actu): ?>
                <div class="bloc"  data-aos="fade-right" data-aos-duration="1000">
                    <div class="imageBackground">
                        <?php
                        if ($actu['image'] === "non") {
                            $videoID = getYouTubeVideoID($actu['ytb_url']);
                            echo '<iframe class="video-ytb" src="https://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
                        } elseif ($actu['ytb_url'] === "non") {
                            echo '<img src="/images/actualites/' . $actu['image'] . '" loading="lazy" alt="' . $actu['alt_text'] . '" class="image-actualites">';
                        }
                        ?>
                    </div>
                    <h3 class="titreS"><?= htmlspecialchars($actu['titre'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= date('d/m', strtotime($actu['date'])) ?>:&nbsp;&nbsp;&nbsp;<?= strlen($actu['texte']) > 200 ? substr($actu['texte'], 0, 200) . '...' : $actu['texte'] ?></p>
    <div>
        <a href="/actualites.php?scroll=200#<?= $actu['id'] ?>" class="lien-actualite">Lire la suite sur la page des actualités</a>
    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune actualité disponible.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>