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
        $query = "SELECT * FROM categorie";
        $statement = $this->db->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($libelle)
    {
        $libelle = isset($_POST["libelle"]) ? $_POST["libelle"] : '';

        if (!empty($libelle)) {

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
        $id = mysqli_real_escape_string($db, $id);
        $libelle = mysqli_real_escape_string($db, $libelle);

        $update_query = "UPDATE categorie SET libelle = '$libelle' WHERE id = $id";
        $req = mysqli_query($db, $update_query);

        return $req;
    }

    public function delete($id)
    {
        $query = "DELETE FROM categorie WHERE id = ?";
        $statement = $this->db->prepare($query);
        return $statement->execute(array($id));

    }
}
