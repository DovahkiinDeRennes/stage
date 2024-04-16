<?php

class categorie
{
    public $id;
    public $libelle;

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

    public function insert($libelle)
    {
        $this->libelle = FormValidation::sanitizeText($libelle);

        $reqAdd = "INSERT INTO categories (libelle) VALUES (:libelle)";
        $prepareAdd = $this->db->prepare($reqAdd);
        return $prepareAdd->execute(array('libelle' => $this->libelle));
    }

    public function update($libelle, $id)
    {
        $this->libelle = FormValidation::sanitizeText($libelle);

        $reqUpdate = "UPDATE categories SET libelle = :libelle WHERE id = :id";
        $prepareUpdate = $this->db->prepare($reqUpdate);
        return $prepareUpdate->execute(array('libelle' => $this->libelle, 'id' => $id));
    }

    public function delete($id)
    {
        $req = "DELETE FROM categories WHERE id = :id";
        $prepareSup = $this->db->prepare($req);
        return $prepareSup->execute(array('id' => $id));
    }
}