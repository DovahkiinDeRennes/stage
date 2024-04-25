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
        $categories = array();

        $query = "SELECT * FROM categorie";
        $stmt = $this->db->query($query);

        if ($stmt) {
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Erreur de requête: " . $this->db->errorInfo()[2];
        }

        return $categories;
    }

    public function insert($libelle)
    {
        if (isset($libelle) && !empty($libelle)) {
            $query = "INSERT INTO categorie (libelle) VALUES (?)";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$libelle]);

            if ($success) {
                header('Location: categories.php');
                exit;
            }
        }
    }

    public function update($id, $libelle)
    {
        $query = "UPDATE categorie SET libelle = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$libelle, $id]);

        return $success;
    }

    public function delete($id)
    {
        $query = "DELETE FROM categorie WHERE id = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt) {
            $result = $stmt->execute([$id]);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}