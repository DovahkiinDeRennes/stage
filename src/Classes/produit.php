<?php

include(__DIR__ . '/../pages/core/connection.php');
class produit
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function insert($titre, $texte, $image_url, $alt_text, $categories)
    {
        // Récupérer le nombre total de produits pour la catégorie donnée
        $query = "SELECT COUNT(*) AS total FROM produits WHERE categories = ?";
        $statement = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($statement, 's', $categories);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_assoc($result);
        $ordre = $row['total'] + 1; // Ajouter 1 pour déterminer l'ordre du nouveau produit

        // Insérer le nouveau produit avec l'ordre déterminé
        $query = "INSERT INTO produits (titre, description, image_url, alt_text, date, categories, ordre) VALUES (?, ?, ?, ?, NOW(), ?, ?)";
        $statement = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($statement, 'ssssii', $titre, $texte, $image_url, $alt_text, $categories, $ordre);
        $success = mysqli_stmt_execute($statement);

        if ($success) {
            header('Location: produits.php');
            exit;
        } else {
            // Gérer les erreurs d'insertion
            echo "Erreur lors de l'insertion : " . mysqli_error($this->db);
        }
    }

}

