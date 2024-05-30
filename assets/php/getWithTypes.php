<?php

function getProduitsWithType($db)
{
    $query = "SELECT *, 'produits' AS type FROM produits ORDER BY ordre ASC";
    $stmt = $db->query($query);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $produits;
}

function getServicesWithType($db)
{
    $query = "SELECT *, 'repository' AS type FROM repository ORDER BY ordre ASC";
    $stmt = $db->query($query);
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $services;
}
?>