<?php

include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');

if(isset($_GET['service_id'], $_GET['direction'])) {

    $service_id = mysqli_real_escape_string($db, $_GET['service_id']);
    $direction = mysqli_real_escape_string($db, $_GET['direction']);

    // Obtenir la catégorie du service
    $query = "SELECT categories FROM services WHERE id = '$service_id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $categorie_id = $row['categories'];

    // Obtenir l'ordre actuel du service
    $query = "SELECT ordre FROM services WHERE id = '$service_id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $ancien_ordre = $row['ordre'];

    // Compter le nombre de services dans la même catégorie
    $query = "SELECT COUNT(*) AS count FROM services WHERE categories = '$categorie_id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $nombre_de_services = $row['count'];

    // Calculer le nouvel ordre en fonction de la direction
    $nouvel_ordre = ($direction === 'up') ? max($ancien_ordre - 1, 1) : min($ancien_ordre + 1, $nombre_de_services);

    // Vérifier si le nouvel ordre est déjà utilisé par un autre service
    $query = "SELECT id FROM services WHERE ordre = '$nouvel_ordre' AND categories = '$categorie_id' AND id != '$service_id'";
    $result = mysqli_query($db, $query);
    $existing_service_id = mysqli_fetch_assoc($result)['id'];

    if ($existing_service_id) {
        // Décaler les numéros d'ordre des services en dessous du nouvel ordre
        $query = "UPDATE services SET ordre = ordre + 1 WHERE ordre >= '$nouvel_ordre' AND categories = '$categorie_id' AND id != '$service_id'";

        mysqli_query($db, $query);
    }

    // Mettre à jour l'ordre du service déplacé
    $query = "UPDATE services SET ordre = '$nouvel_ordre' WHERE id = '$service_id'";
    mysqli_query($db, $query);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>