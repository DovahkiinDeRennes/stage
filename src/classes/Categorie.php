<?php


include(__DIR__ . '/../../src/pages/core/connection.php');

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

        $query = "DELETE FROM categorie WHERE id = ?";
        $stmt = mysqli_prepare($this->db, $query);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);


            $result = mysqli_stmt_execute($stmt);

            if ($result) {

                mysqli_stmt_close($stmt);
                return true;
            } else {

                mysqli_stmt_close($stmt);
                return false;
            }
        } else {

            return false;
        }
    }
}
// test