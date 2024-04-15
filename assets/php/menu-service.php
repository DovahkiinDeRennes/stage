<?php 

function getMenu($db){
    // Vérifier la connexion à la base de données
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Exécution de la requête SQL pour obtenir les catégories avec le décompte des services
    $query = "SELECT categorie, COUNT(*) AS count FROM services GROUP BY categorie";
    $result = $db->query($query);
    if (!$result) {
        die("Erreur lors de l'exécution de la requête: " . $db->error);
    }

    // Tableau pour stocker les catégories et le nombre de services dans chaque catégorie
    $categories_count = array();
    while ($row = $result->fetch_assoc()){
        $categories_count[$row['categorie']] = $row['count'];
    }
    
    // Retourner le tableau de catégories avec le nombre de services dans chaque catégorie
    return $categories_count;
}

?>
