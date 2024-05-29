<?php
include(__DIR__ . '/../pages/core/connection.php');

class Actualite
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllActualites()
    {
        $actualites = array();
        $query = "SELECT * FROM actualite ORDER BY date DESC";
        $stmt = $this->db->query($query);

        if ($stmt) {
            $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Erreur de requête: " . $this->db->errorInfo()[2];
        }

        return $actualites;
    }

    public function insert($titre, $texte, $alt, $new_img_name, $ytb_url)
    {
        $query = "INSERT INTO actualite (titre, texte, image, alt_text, date, ytb_url) 
        VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $ytb_url]);
        if ($success) {
            header('Location: actualites.php');
            exit;
        } else {
            echo "Erreur lors de l'insertion : " . $stmt->errorInfo()[2];
        }
    }

    public function update($id, $titre, $texte, $alt, $new_img_name, $ytb_url)
    {
        $query = "UPDATE actualite 
        SET titre = ?, texte = ?, image = ?, alt_text = ?, ytb_url = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$titre, $texte, $new_img_name, $alt, $ytb_url, $id]);

        if ($success) {
            header('Location: actualites.php');
            exit;
        } else {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->errorInfo()[2];
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM actualite WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute([$id]);

        if ($result) {
            return true;
        } else {
            echo "Erreur lors de l'exécution de la requête : " . $stmt->errorInfo()[2];
            return false;
        }
    }
}
?>


