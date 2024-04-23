<?php
include(__DIR__ . '/../pages/core/connection.php');
class actualite
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllActualites()
    {

        $actualites = array();
        $query = "SELECT * FROM actualite ORDER BY date DESC";
        $result = mysqli_query($this->db, $query);


        if ($result) {

            while ($row = mysqli_fetch_assoc($result)) {
                $actualites[] = $row;
            }
            mysqli_free_result($result);
        }

        return $actualites;
    }

public function insert($titre,$texte,$alt,$new_img_name,$ytb_url)
{

    $query = "INSERT INTO actualite (titre, texte, image, alt_text, date, ytb_url) VALUES (?, ?, ?, ?, NOW(), ?)";
    $statement = mysqli_prepare($this->db, $query);
    mysqli_stmt_bind_param($statement, 'sssss', $titre, $texte, $new_img_name, $alt, $ytb_url);
    $success = mysqli_stmt_execute($statement);
    if ($success) {
        header('Location: actualites.php');
        exit;
    } else {
        echo "Erreur lors de l'insertion : " . mysqli_error($this->db);
    }

}

    public function update($id, $titre, $texte, $alt, $new_img_name, $ytb_url)
    {
        $query = "UPDATE actualite SET titre = ?, texte = ?, image = ?, alt_text = ?, ytb_url = ? WHERE id = ?";
        $statement = mysqli_prepare($this->db, $query);

        // Vérifie si la préparation de la requête a réussi
        if ($statement === false) {
            echo "Erreur lors de la préparation de la requête : " . mysqli_error($this->db);
            return false;
        }

        mysqli_stmt_bind_param($statement, 'sssssi', $titre, $texte, $new_img_name, $alt, $ytb_url, $id);
        $success = mysqli_stmt_execute($statement);

        if ($success) {
            header('Location: actualites.php');
            exit;
        } else {
            echo "Erreur lors de l'exécution de la requête : " . mysqli_error($this->db);
            return false;
        }
    }

public function delete($id)
{
    $query = "DELETE FROM actualite WHERE id = ?";
    $statement = mysqli_prepare($this->db, $query);

    if ($statement) {
        // Liaison du paramètre ID
        mysqli_stmt_bind_param($statement, "i", $id);

        // Exécution de la requête
        $result = mysqli_stmt_execute($statement);

        if ($result) {
            // La suppression a réussi
            mysqli_stmt_close($statement);
            return true;
        } else {
            // Gestion des erreurs en cas d'échec de la suppression
            // Vous pouvez utiliser mysqli_stmt_error() pour obtenir des informations sur l'erreur
            mysqli_stmt_close($statement);
            return false;
        }
    } else {
        // Gestion des erreurs en cas d'échec de la préparation de la requête
        // Vous pouvez utiliser mysqli_error() pour obtenir des informations sur l'erreur
        return false;
    }
}

}


