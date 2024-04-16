<?php

class Categorie
{
    public $id;
    public $titre;

    private $db;

    public function __construct()
    {
        $connection = new connection();
        $this->db = $connection->connect();
    }

    public function getAllCategories()
    {
        $req = "SELECT * FROM categories";
        $result = $this->db->query($req);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($titre)
    {
        $this->titre = FormValidation::sanitizeText($titre);

        $reqAdd = "INSERT INTO categories (titre) VALUES (:titre)";
        $prepareAdd = $this->db->prepare($reqAdd);
        return $prepareAdd->execute(array('titre' => $this->titre));
    }

    public function update($titre, $id)
    {
        $this->titre = FormValidation::sanitizeText($titre);

        $reqUpdate = "UPDATE categories SET titre = :titre WHERE id = :id";
        $prepareUpdate = $this->db->prepare($reqUpdate);
        return $prepareUpdate->execute(array('titre' => $this->titre, 'id' => $id));
    }

    public function delete($id)
    {
        $req = "DELETE FROM categories WHERE id = :id";
        $prepareSup = $this->db->prepare($req);
        return $prepareSup->execute(array('id' => $id));
    }
}