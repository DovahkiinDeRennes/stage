<?php

include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');

if (isset($_GET['produit_id'], $_GET['direction'])) {

    $produit_id = htmlspecialchars($_GET['produit_id']);
    $direction = htmlspecialchars($_GET['direction']);

    // Obtenir la catégorie et l'ordre actuel du produit
    $query = "SELECT categories, ordre FROM produits WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$produit_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $categorie_id = $row['categories'];
    $ancien_ordre = $row['ordre'];


    if ($direction === 'gauche') {
        var_dump($direction);
        var_dump($produit_id);
        // Obtenir l'ID du produit qui a l'ordre précédent si le produit monte
        $query = ($direction === 'gauche') ? "SELECT id FROM produits WHERE ordre = ? AND categories = ? AND id != ?" : "SELECT id FROM produits WHERE ordre = ? AND categories = ? AND id != ? ORDER BY ordre DESC";
        $stmt = $db->prepare($query);
        $stmt->execute([$ancien_ordre - 1, $categorie_id, $produit_id]);
        $produit_id_precedent = $stmt->fetchColumn();

        if ($produit_id_precedent) {
            // Mettre à jour l'ordre des produit
            $query = "UPDATE produits SET ordre = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$ancien_ordre, $produit_id_precedent]);

            // Mettre à jour l'ordre du produit déplacé
            $query = "UPDATE produits SET ordre = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$ancien_ordre - 1, $produit_id]);
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if ($direction === 'droite') {
        var_dump($direction);
        var_dump($produit_id);
        // Obtenir l'ID du produit qui a l'ordre suivant si le produit descend
        $query = ($direction === 'droite') ? "SELECT id FROM produits WHERE ordre = ? AND categories = ? AND id != ?" : "SELECT id FROM produits WHERE ordre = ? AND categories = ? AND id != ? ORDER BY ordre ASC";

        $stmt = $db->prepare($query);
        $stmt->execute([$ancien_ordre + 1, $categorie_id, $produit_id]);


        $produit_id_suivant = $stmt->fetchColumn();
        var_dump($produit_id_suivant);

        if ($produit_id_suivant) {
            $prout = "prout";
            // Mettre à jour l'ordre des produit
            $query = "UPDATE produits SET ordre = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$ancien_ordre, $produit_id_suivant]);
            var_dump($prout);

            // Mettre à jour l'ordre du produit déplacé
            $query = "UPDATE produits SET ordre = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$ancien_ordre + 1, $produit_id]);

        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>