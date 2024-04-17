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
        $req = "SELECT * FROM categorie";
        $result = $this->db->query($req);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($libelle)
    {
        $reqAdd = "INSERT INTO categorie (libelle) VALUES (:libelle)";
        $prepareAdd = $this->db->prepare($reqAdd);
        return $prepareAdd->execute(array(':libelle' => $libelle));
    }

    public function update($libelle, $id)
    {
        $this->libelle = FormValidation::sanitizeText($libelle);

        $reqUpdate = "UPDATE categorie SET libelle = :libelle WHERE id = :id";
        $prepareUpdate = $this->db->prepare($reqUpdate);
        return $prepareUpdate->execute(array('libelle' => $this->libelle, 'id' => $id));
    }

    public function delete($id)
    {
        $req = "DELETE FROM categorie WHERE id = :id";
        $prepareSup = $this->db->prepare($req);
        return $prepareSup->execute(array('id' => $id));
    }
}