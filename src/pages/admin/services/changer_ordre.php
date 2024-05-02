<?php

include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');

if(isset($_GET['service_id'], $_GET['direction'])) {

    $service_id = htmlspecialchars($_GET['service_id']);
    $direction = htmlspecialchars($_GET['direction']);

    // Obtenir la catégorie et l'ordre actuel du service
    $query = "SELECT categories, ordre FROM services WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$service_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $categorie_id = $row['categories'];
    $ancien_ordre = $row['ordre'];


    if ($direction === 'gauche') {
        // Obtenir l'ID du service qui a l'ordre précédent si le service monte
        $query = ($direction === 'gauche') ? "SELECT id FROM services WHERE ordre = ? AND categories = ? AND id != ?" : "SELECT id FROM services WHERE ordre = ? AND categories = ? AND id != ? ORDER BY ordre DESC";
        $stmt = $db->prepare($query);
        $stmt->execute([$ancien_ordre - 1, $categorie_id, $service_id]);
        $service_id_precedent = $stmt->fetchColumn();

        if ($service_id_precedent) {
            // Mettre à jour l'ordre des services
            $query = "UPDATE services SET ordre = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$ancien_ordre, $service_id_precedent]);

            // Mettre à jour l'ordre du service déplacé
            $query = "UPDATE services SET ordre = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$ancien_ordre - 1, $service_id]);
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if ($direction === 'droite') {
        // Obtenir l'ID du service qui a l'ordre suivant si le service descend
        $query = ($direction === 'droite') ? "SELECT id FROM services WHERE ordre = ? AND categories = ? AND id != ?" : "SELECT id FROM services WHERE ordre = ? AND categories = ? AND id != ? ORDER BY ordre ASC";
        $stmt = $db->prepare($query);
        $stmt->execute([$ancien_ordre + 1, $categorie_id, $service_id]);
        $service_id_suivant = $stmt->fetchColumn();
if ($service_id_suivant) {
    // Mettre à jour l'ordre des services
    $query = "UPDATE services SET ordre = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$ancien_ordre, $service_id_suivant]);

    // Mettre à jour l'ordre du service déplacé
    $query = "UPDATE services SET ordre = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$ancien_ordre + 1, $service_id]);
}
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}