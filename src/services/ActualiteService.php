<?php

include(__DIR__ . '/../pages/core/connection.php');
require_once(__DIR__ . '/../classes/Actualite.php');


class ActualiteService
{
    private $actualite;

    public function __construct($db) {
        $this->actualite = new Actualite($db);
    }
    public function getAllActualites() {
        return $this->actualite->getAllActualites();
    }

    public function insert($titre, $texte, $alt, $new_img_name, $ytb_url) {
        return $this->actualite->insert($titre, $texte, $alt, $new_img_name, $ytb_url);
    }

    public function update($id, $titre, $texte, $alt, $new_img_name, $ytb_url) {
        return $this->actualite->update($id, $titre, $texte, $alt, $new_img_name, $ytb_url);
    }

    public function delete($id) {
        return $this->actualite->delete($id);
    }
}