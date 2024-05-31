<?php

include (__DIR__ . '/../pages/core/connection.php');

class Mail
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    function getAllMails()
    {
        $mails = array();
        $query = "SELECT * FROM contact ORDER BY DATE DESC";
        $stmt = $this->db->query($query);

        if ($stmt) {
            $mails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $mails;
    }


    public function insert($nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message, $conditions)
    {

        $query = "INSERT INTO contact (nom, prenom, mail, tel, societe, 
                     fonction, object, message, conditions, date) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message, $conditions]);

         return $success;


    }

    public function update($id, $nom, $prenom, $mail, $tel, $societe, $fonction, $objet, $message)
    {
        $query = "UPDATE contact SET nom = ?, prenom = ?, mail = ?, tel = ?, societe = ?, fonction = ?, `object` = ?, message = ?, date = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$nom, $prenom, $mail, $tel, $societe, $fonction, $objet, $message, $id]);

        return $success; // Retourne true si la mise à jour a réussi, sinon false
    }

    public function delete($id)
    {
        // Utilisation d'une requête préparée pour la suppression
        $query = "DELETE FROM contact WHERE id = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt) {
            // Liaison du paramètre ID
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            // Exécution de la requête
            $result = $stmt->execute();

            if ($result) {
                // La suppression a réussi
                return true;
            } else {
                // Gestion des erreurs en cas d'échec de la suppression
                // Vous pouvez utiliser $stmt->errorInfo() pour obtenir des informations sur l'erreur
                return false;
            }
        } else {
            // Gestion des erreurs en cas d'échec de la préparation de la requête
            // Vous pouvez utiliser $this->db->errorInfo() pour obtenir des informations sur l'erreur
            return false;
        }
    }
}