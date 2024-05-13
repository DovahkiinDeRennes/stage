<?php

require_once(__DIR__ . '/../../../csp_config.php');
include(__DIR__ . '/../core/connection.php');
include(__DIR__ . '/../../classes/actualite.php');

// Déclaration de la fonction getYouTubeVideoID()
function getYouTubeVideoID($url) {
    $videoID = "";
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    if (isset($params['v'])) {
        $videoID = $params['v'];
    }
    return $videoID;
}

// Instanciation de la classe d'actualite
$actualite = new Actualite($db);

// Récupérer toutes les actualités
$actualites = $actualite->getAllActualites();

foreach ($actualites as $row) {
    echo '<div id="' . $row['id'] . '" class="card">';

    echo '<div class="groupe gauche" data-aos="fade-right">';

    // Ajouter le contenu en fonction du type
    if ($row['image'] !== "non") {
        echo '<img width="560" height="315" src="/images/actualites/'.$row['image'].'" loading="lazy" alt="' . $row['alt_text'] . '" class="image-actualites">';
    } elseif ($row['ytb_url'] !== "non") {
        $url = $row['ytb_url'];
        $videoID = getYouTubeVideoID($url);
        $embedCode = '<iframe class="video-ytb"  src="https://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
        echo $embedCode;
    }

    echo '</div>';

    echo '<div class="groupe droite" data-aos="fade-left">';
    echo '<div class="paragraphe">';
    echo '<div>';
    echo '<h3>' . $row['titre'] . '</h3>';
    echo '</div>';
    echo '<p id = "texte" class="p-block-3 text-content">' . nl2br(htmlspecialchars($row['texte'])) . '</p>';
    echo '<div class="readmore-btn">Lire plus</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Afficher les actions administratives si l'utilisateur est connecté en tant qu'admin
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        echo "<div class='admin'>";
        echo "<a href='/src/pages/admin/actualites/modifier.php?id=" . $row['id'] . "' class='admin_action_special'><svg xmlns='http://www.w3.org/2000/svg' height='16' width='16' viewBox='0 0 512 512'><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z'/></svg></a>";
        echo "<a class='adminDelete' href='/src/pages/admin/actualites/supprimer.php?id=" . $row['id'] . "' class='admin_action_special'><svg xmlns='http://www.w3.org/2000/svg' height='16' width='18' viewBox='0 0 576 512'><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d='M576 128c0-35.3-28.7-64-64-64H205.3c-17 0-33.3 6.7-45.3 18.7L9.4 233.4c-6 6-9.4 14.1-9.4 22.6s3.4 16.6 9.4 22.6L160 429.3c12 12 28.3 18.7 45.3 18.7H512c35.3 0 64-28.7 64-64V128zM271 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z'/></svg></a>";
        echo "</div>";
        echo "<br>";
    }
    echo '<img src="/images/fidelilium_line.png" class="line">';
}
$db = null;
?>


