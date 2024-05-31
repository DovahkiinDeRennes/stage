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

    public function update($id, $titre, $texte, $new_img_name, $alt, $new_category): bool
    {
        // Obtenir l'ancienne catégorie et l'ordre du produit
        $query = "SELECT categories, ordre FROM produits WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $old_category = $row['categories'];

        // Vérifier si la catégorie a changé
        if ($old_category !== $new_category) {
            // Mettre à jour le produit avec la nouvelle catégorie
            $query = "UPDATE produits SET titre = ?, description = ?, image_url = ?, alt_text = ?, categories = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $new_category, $id]);

            // Réinitialiser les ordres dans l'ancienne catégorie
            $this->verifOrdre($old_category);
            $this->verifOrdre($new_category);
        } else {
            // Si la catégorie n'a pas changé, simplement mettre à jour le produit
            $query = "UPDATE produits SET titre = ?, description = ?, image_url = ?, alt_text = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $id]);
        }

        return $success;
    }

    public function delete($id): bool
    {
        // Récupérer la catégorie du produit à supprimer
        $query = "SELECT categories FROM produits WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produit) {
            $category = $produit['categories'];

            // Utilisation d'une requête préparée pour la suppression
            $query = "DELETE FROM produits WHERE id = ?";
            $stmt = $this->db->prepare($query);

            if ($stmt) {
                // Liaison du paramètre ID
                $stmt->bindParam(1, $id, PDO::PARAM_INT);

                // Exécution de la requête
                $result = $stmt->execute();

                if ($result) {
                    // La suppression a réussi, maintenant réorganiser les ordres pour la catégorie spécifique
                    $this->verifOrdre($category);
                    return true;
                } else {
                    // Gestion des erreurs en cas d'échec de la suppression
                    return false;
                }
            } else {
                // Gestion des erreurs en cas d'échec de la préparation de la requête
                return false;
            }
        } else {
            // Produit non trouvé
            return false;
        }
    }
    private function verifOrdre($category)
    {
        // Récupérer tous les produits de la catégorie triés par ordre
        $query = "SELECT id FROM produits WHERE categories = ? ORDER BY ordre";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$category]);
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Réinitialiser l'ordre pour la catégorie spécifique
        $ordre = 1;
        foreach ($produits as $produit) {
            // Mettre à jour l'ordre du produit
            $updateQuery = "UPDATE produits SET ordre = ? WHERE id = ?";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->execute([$ordre, $produit['id']]);
            $ordre++;
        }
    }




}



?>
