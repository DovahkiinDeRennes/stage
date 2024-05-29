<?php
include(__DIR__ . '/../pages/core/connection.php');
require_once(__DIR__ . '/../classes/produit.php');
class ProduitService {
    private $produit;

    public function __construct(PDO $db) {
        $this->produit = new Produit($db);
    }

    public function getAllProduits(): array {
        return $this->produit->getAllProduits();
    }

    public function insert($titre, $texte, $image_url, $alt_text, $categories): void {
        $this->produit->insert($titre, $texte, $image_url, $alt_text, $categories);
    }

    public function update($id, $titre, $texte, $new_img_name, $alt, $categories): bool {
        return $this->produit->update($id, $titre, $texte, $new_img_name, $alt, $categories);
    }

    public function delete($id): bool {
        return $this->produit->delete($id);
    }
}
