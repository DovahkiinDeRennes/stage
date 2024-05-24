<?php

include(__DIR__ . '/../pages/core/connection.php');

class Produit
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllProduits(): array
    {
        $produits = array();

        $query = "SELECT produits.*, categorie.libelle AS libelle 
        FROM produits 
        LEFT JOIN categorie ON produits.categories = categorie.id 
        ORDER BY categorie.libelle ASC, produits.ordre ASC";
        $stmt = $this->db->query($query);

        if ($stmt) {
            $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $produits;
    }

    public function insert($titre, $texte, $image_url, $alt_text, $categories): void
    {
        // Récupérer le nombre total de produits pour la catégorie donnée
        $query = "SELECT COUNT(*) AS total FROM produits WHERE categories = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categories]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $ordre = $row['total'] + 1; // Ajouter 1 pour déterminer l'ordre du nouveau produit

        // Insérer le nouveau produit avec l'ordre déterminé
        $query = "INSERT INTO produits (titre, description, image_url, alt_text, date, categories, ordre) VALUES (?, ?, ?, ?, NOW(), ?, ?)";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$titre, $texte, $image_url, $alt_text, $categories, $ordre]);

        if ($success) {
            header('Location: produits.php');
            exit;
        } else {
            // Gérer les erreurs d'insertion
            echo "Erreur lors de l'insertion : " . $stmt->errorInfo()[2];
        }
    }

    public function update($id, $titre, $texte, $new_img_name, $alt, $categories): bool
    {
        $query = "UPDATE produits SET titre = ?, description = ?, image_url = ?, alt_text = ?, categories = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $categories, $id]);

        return $success;
    }

    public function delete($id): bool
    {
        // Utilisation d'une requête préparée pour la suppression
        $query = "DELETE FROM produits WHERE id = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt) {
            // Liaison du paramètre ID
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            // Exécution de la requête
            $result = $stmt->execute();

            if ($result) {
                // La suppression a réussi
                return true;
            } else {
                // Gestion des erreurs en cas d'échec de la suppression
                // Vous pouvez utiliser $stmt->errorInfo() pour obtenir des informations sur l'erreur
                return false;
            }
        } else {
            // Gestion des erreurs en cas d'échec de la préparation de la requête
            // Vous pouvez utiliser $this->db->errorInfo() pour obtenir des informations sur l'erreur
            return false;
        }
    }
}

?>
