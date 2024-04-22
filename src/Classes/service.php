<?php
include(__DIR__ . '/../pages/core/connection.php');
class service
{
    private $db;

    private $new_img_name;

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
        ORDER BY categorie.ordre ASC, services.ordre ASC ";
        $result = mysqli_query($this->db, $query);

        if ($result) {

            while ($row = mysqli_fetch_assoc($result)) {
                $services[] = $row;
            }
            mysqli_free_result($result);
        }
        return $services;
    }


    public function insert($titre, $texte, $new_img_name, $alt, $categories)
    {
        // Récupérer le nombre total de services pour la catégorie donnée
        $query = "SELECT COUNT(*) AS total FROM services WHERE categories = ?";
        $statement = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($statement, 's', $categories);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $row = mysqli_fetch_assoc($result);
        $ordre = $row['total'] + 1; // Ajouter 1 pour déterminer l'ordre du nouveau service

        // Insérer le nouveau service avec l'ordre déterminé
        $query = "INSERT INTO services (titre, description, image_url, alt_text, date, categories, ordre) VALUES (?, ?, ?, ?, NOW(), ?, ?)";
        $statement = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($statement, 'ssssii', $titre, $texte, $new_img_name, $alt, $categories, $ordre);
        $success = mysqli_stmt_execute($statement);

        if ($success) {
            header('Location: services.php');
            exit;
        } else {
            // Gérer les erreurs d'insertion
            echo "Erreur lors de l'insertion : " . mysqli_error($this->db);
        }
    }

    public function update($id, $titre, $texte, $new_img_name, $alt, $categories)
    {
        $query = "UPDATE services SET titre = ?, description = ?, image_url = ?, alt_text = ?, categories = ? WHERE id = ?";
        $statement = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($statement, 'ssssii', $titre, $texte, $new_img_name, $alt, $categories, $id);
        $success = mysqli_stmt_execute($statement);

        if ($success) {

            header('Location: services.php');
            exit;
        } else {

            echo "Erreur lors de la mise à jour du service : " . mysqli_error($this->db);
            return false;
        }
    }


    public function delete($id)
    {
        // Utilisation d'une requête préparée pour la suppression
        $query = "DELETE FROM services WHERE id = ?";
        $stmt = mysqli_prepare($this->db, $query);

        if ($stmt) {
            // Liaison du paramètre ID
            mysqli_stmt_bind_param($stmt, "i", $id);

            // Exécution de la requête
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // La suppression a réussi
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // Gestion des erreurs en cas d'échec de la suppression
                // Vous pouvez utiliser mysqli_stmt_error() pour obtenir des informations sur l'erreur
                mysqli_stmt_close($stmt);
                return false;
            }
        } else {
            // Gestion des erreurs en cas d'échec de la préparation de la requête
            // Vous pouvez utiliser mysqli_error() pour obtenir des informations sur l'erreur
            return false;
        }
    }

}