<?php

function getProduitsWithType($db)
{
    $query = "SELECT *, 'produits' AS type FROM produits ORDER BY ordre ASC";
    $result = $db->query($query);
    $produits = array();
    while ($row = $result->fetch_assoc()) {
        $produits[] = $row;
    }
    return $produits;
}

function getServicesWithType($db)
{
    $query = "SELECT *, 'services' AS type FROM services ORDER BY ordre ASC";
    $result = $db->query($query);
    $services = array();
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
    return $services;
}