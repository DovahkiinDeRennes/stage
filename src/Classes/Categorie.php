<?php


include(__DIR__ . '/../../pages/core/connection.php');

class Categorie
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllCategories()
    {
        $categories  = array();


        $query = "SELECT * FROM categorie";
        $result = mysqli_query($this->db, $query);


        if ($result) {

            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }


            mysqli_free_result($result);
        }

        return $categories;
    }

    public function insert($libelle)
    {

        if (isset($libelle) && !empty($libelle)) {

            $query = "INSERT INTO categorie (libelle) VALUES (?)";
            $statement = mysqli_prepare($this->db, $query);


            mysqli_stmt_bind_param($statement, 's', $libelle);


            $success = mysqli_stmt_execute($statement);


            if ($success) {

                header('Location: categories.php');
                exit;
            }
        }
    }


    function update($db, $id, $libelle) {

        $query = "UPDATE categorie SET libelle = ? WHERE id = ?";


        $statement = mysqli_prepare($db, $query);


        mysqli_stmt_bind_param($statement, 'si', $libelle, $id);


        $success = mysqli_stmt_execute($statement);

        return $success;
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
// test