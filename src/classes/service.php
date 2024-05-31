<?php

include(__DIR__ . '/../pages/core/connection.php');

class Service
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllServices()
    {
        $services = array();

        $query = "SELECT services.*, categorie.libelle AS libelle 
        FROM services 
        LEFT JOIN categorie ON services.categories = categorie.id 
        ORDER BY categorie.ordre ASC, services.ordre ASC";
        $stmt = $this->db->query($query);

        if ($stmt) {
            $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $services;
    }

    public function insert($titre, $texte, $new_img_name, $alt, $categories)
    {
        // Récupérer le nombre total de services pour la catégorie donnée
        $query = "SELECT COUNT(*) AS total FROM services WHERE categories = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categories]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $ordre = $row['total'] + 1; // Ajouter 1 pour déterminer l'ordre du nouveau service

        // Insérer le nouveau service avec l'ordre déterminé
        $query = "INSERT INTO services (titre, description, image_url, alt_text, date, categories, ordre) VALUES (?, ?, ?, ?, NOW(), ?, ?)";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $categories, $ordre]);

        return $success;

    }

    public function update($id, $titre, $texte, $new_img_name, $alt, $new_category): bool
    {
        // Obtenir l'ancienne catégorie et l'ordre du service
        $query = "SELECT categories, ordre FROM services WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $old_category = $row['categories'];

        // Vérifier si la catégorie a changé
        if ($old_category !== $new_category) {
            // Mettre à jour le service avec la nouvelle catégorie
            $query = "UPDATE services SET titre = ?, description = ?, image_url = ?, alt_text = ?, categories = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $new_category, $id]);

            // Réinitialiser les ordres dans l'ancienne catégorie
            $this->verifOrdre($old_category);
            $this->verifOrdre($new_category);
        } else {
            // Si la catégorie n'a pas changé, simplement mettre à jour le service
            $query = "UPDATE services SET titre = ?, description = ?, image_url = ?, alt_text = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $id]);
        }

        return $success;
    }

    public function delete($id)
    {
        // Récupérer la catégorie du service à supprimer
        $query = "SELECT categories FROM services WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $service = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($service) {
            $category = $service['categories'];

            // Utilisation d'une requête préparée pour la suppression
            $query = "DELETE FROM services WHERE id = ?";
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
            // Service non trouvé
            return false;
        }
    }



    private function verifOrdre($category)
    {
        $query = "SELECT id FROM services WHERE categories = ? ORDER BY ordre";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$category]);
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ordre = 1;
        foreach ($services as $service) {

            $updateQuery = "UPDATE services SET ordre = ? WHERE id = ?";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->execute([$ordre, $service['id']]);
            $ordre++;
        }
    }



}