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
        $query = "SELECT * FROM contact";
        $result = mysqli_query($this->db, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $mails[] = $row;
            }
            mysqli_free_result($result);

        }
        return $mails;
    }


    public function insert($nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message, $conditions)
    {


        $query = "INSERT INTO contact (nom, prenom, mail, tel, societe, fonction, `object`, message, conditions, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $statement = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($statement, 'sssssssss', $nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message, $conditions);
        $success = mysqli_stmt_execute($statement);



        if ($success) {
            // Insertion réussie, afficher une alerte SweetAlert pour informer l'utilisateur
            $msg = "Votre message a bien été envoyé, Vous allez être redirigé !";
            $statut = "success";


            echo "<script>Swal.fire({
            title: '$msg', icon: '$statut', confirmButtonText: 'Confirmer'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href='index.php';
            }
            
        });
        </script>";
        } else {
            // Gérer les erreurs d'insertion
            $msg = "Erreur lors de l'insertion : " . mysqli_error($this->db);
            $statut = "error";
            echo "<script>Swal.fire({
            title: '$msg', icon: '$statut', confirmButtonText: 'Confirmer'
        });
        </script>";
        }
    }



    public function update($id, $prenom, $nom, $fonction, $tel, $mail, $societe, $message, $objet) {
        $query = "UPDATE contact SET nom = ?, prenom = ?, mail = ?, tel = ?, societe = ?, fonction = ?, object = ?, message = ? WHERE id = ?";
        $statement = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($statement, 'sssssssss', $prenom, $nom, $fonction, $tel, $mail, $societe, $message, $objet, $id);
        $success = mysqli_stmt_execute($statement);

        if ($success) {
            // Mise à jour réussie, afficher une alerte SweetAlert pour informer l'utilisateur
            $msg = "La mise à jour a été effectuée avec succès !";
            $statut = "success";
        } else {
            // Gérer les erreurs de mise à jour
            $msg = "Erreur lors de la mise à jour : " . mysqli_error($this->db);
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