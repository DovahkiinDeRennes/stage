<?php 

function getMenu($db){
    // Vérifier la connexion à la base de données
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Exécution de la requête SQL pour obtenir les catégories avec le décompte des repository
    $query = "SELECT ordre, COUNT(*) AS count FROM repository GROUP BY ordre";
    $result = $db->query($query);
    if (!$result) {
        die("Erreur lors de l'exécution de la requête: " . $db->error);
    }

    // Tableau pour stocker les catégories et le nombre de repository dans chaque catégorie
    $categories_count = array();
    while ($row = $result->fetch_assoc()){
        $categories_count[$row['ordre']] = $row['count'];
    }
    
    // Retourner le tableau de catégories avec le nombre de repository dans chaque catégorie
    return $categories_count;
}

?>
