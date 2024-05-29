<?php

include(__DIR__ . '/../pages/core/connection.php');
require_once(__DIR__ . '/../classes/service.php');

class ServiceService {
    private $service;

    public function __construct(PDO $db) {
        $this->service = new Service($db);
    }

    public function getAllServices() {
        return $this->service->getAllServices();
    }

    public function insert($titre, $texte, $new_img_name, $alt, $categories) {
        return $this->service->insert($titre, $texte, $new_img_name, $alt, $categories);
    }

    public function update($id, $titre, $texte, $new_img_name, $alt, $categories) {
        return $this->service->update($id, $titre, $texte, $new_img_name, $alt, $categories);
    }

    public function delete($id) {
        return $this->service->delete($id);
    }
}

?>