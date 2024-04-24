<?php
include (__DIR__ . '/../pages/core/connection.php');
class Mail
{
    private $db;
    function update($id, $prenom, $nom, $fonction, $adresse, $mail, $societe, $message, $sujet, $libelle) {

        $query = "UPDATE contact SET prenom = ?, nom = ?, fonction = ?, adresse = ?, mail = ?, societe = ?, message = ?, sujet = ?, libelle = ? WHERE id = ?";

        $statement = mysqli_prepare($db, $query);

        mysqli_stmt_bind_param($statement, $prenom, $nom, $fonction, $adresse, $mail, $societe, $message, $sujet, $libelle, $id);

        $success = mysqli_stmt_execute($statement);

        return $success;
    }

    public function delete($id)
    {
        // Utilisation d'une requête préparée pour la suppression
        $query = "DELETE FROM contact WHERE id = ?";
        $stmt = mysqli_prepare($this->db, $query);

        if ($stmt) {
            // Liaison du paramètre ID
            mysqli_stmt_bind_param($stmt, "i", $id);

            // Exécution de la requête
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // La suppression a réussi
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // Gestion des erreurs en cas d'échec de la suppression
                // Vous pouvez utiliser mysqli_stmt_error() pour obtenir des informations sur l'erreur
                mysqli_stmt_close($stmt);
                return false;
            }
        } else {
            // Gestion des erreurs en cas d'échec de la préparation de la requête
            // Vous pouvez utiliser mysqli_error() pour obtenir des informations sur l'erreur
            return false;
        }
    }
}