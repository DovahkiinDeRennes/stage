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

    public function update($id, $titre, $texte, $new_img_name, $alt, $categories)
    {
        $query = "UPDATE services SET titre = ?, description = ?, image_url = ?, alt_text = ?, categories = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $categories, $id]);

        return $success;
    }

    public function delete($id)
    {
        // Utilisation d'une requête préparée pour la suppression
        $query = "DELETE FROM services WHERE id = ?";
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