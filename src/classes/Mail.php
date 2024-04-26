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

        $query = "INSERT INTO contact (nom, prenom, mail, tel, societe, fonction, object, message, conditions, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message, $conditions]);

        if ($success) {
            // Insertion réussie, afficher une alerte SweetAlert pour informer l'utilisateur
            $msg = "Votre message a bien été envoyé, Vous allez être redirigé !";
            $statut = "success";

            echo "<script>Swal.fire({
                title: '$msg', 
                icon: '$statut', 
                confirmButtonText: 'Confirmer'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href='index.php';
                }
            });
            </script>";
        } else {
            // Gérer les erreurs d'insertion
            $msg = "Erreur lors de l'insertion : " . $stmt->errorInfo()[2];
            $statut = "error";
            echo "<script>Swal.fire({
                title: '$msg', 
                icon: '$statut', 
                confirmButtonText: 'Confirmer'
            });
            </script>";
        }
    }

    public function update($nom, $prenom, $mail, $tel, $societe, $fonction, $objet, $message, $id)
    {
        $query = "UPDATE contact SET nom = ?, prenom = ?, mail = ?, tel = ?, societe = ?, fonction = ?, `object` = ?, message = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $success = $stmt->execute([$nom, $prenom, $mail, $tel, $societe, $fonction, $objet, $message, $id]);

        if ($success) {
            // Mise à jour réussie, afficher une alerte SweetAlert pour informer l'utilisateur
            $msg = "La mise à jour a été effectuée avec succès !";
            $statut = "success";
        } else {
            // Gérer les erreurs de mise à jour
            $msg = "Erreur lors de la mise à jour : " . $stmt->errorInfo()[2];
            $statut = "error";
        }

        // Afficher l'alerte SweetAlert
        echo "<script>Swal.fire({
                title: '$msg', 
                icon: '$statut', 
                confirmButtonText: 'Confirmer'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Rediriger vers la page d'accueil après la confirmation
                    window.location.href = 'index.php';
                }
            });
            </script>";

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