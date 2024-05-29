<?php
include(__DIR__ . '/../pages/core/connection.php');
include(__DIR__ . '/../classes/categorie.php');
class CategorieService
{
    private $categorie;

    public function __construct($db) {
        $this->categorie = new Categorie($db);
    }

    public function getAllCategories() {
        return $this->categorie->getAllCategories();
    }

    public function insert($libelle) {
        return $this->categorie->insert($libelle);
    }

    public function update($id, $libelle) {
        return $this->categorie->update($id, $libelle);
    }

    public function delete($id) {
        return $this->categorie->delete($id);
    }
}