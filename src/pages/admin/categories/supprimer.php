<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include '../../../classes/Categorie/categorie.php';

$id = $_GET['id'];

$query = "SELECT * FROM categorie WHERE id= $id";
$result = $db->query($query);
$row = $result->fetch_assoc();

// Vérifier si des services utilisent cette catégorie
$query_check_services = "SELECT COUNT(*) as count FROM services WHERE categories = $id";
$result_check_services = $db->query($query_check_services);
$row_check_services = $result_check_services->fetch_assoc();

if ($row_check_services['count'] > 0) {
    // Afficher un message d'erreur indiquant que la catégorie est utilisée par des services
    echo "Impossible de supprimer la catégorie '".$row['libelle']."' car elle est utilisée par des services. Vous devez d'abord supprimer tous les services associés à cette catégorie avant de pouvoir la supprimer.<br>";
    echo "<a href='categories.php'>Retour</a>";
} else {
    // Supprimer la catégorie si elle n'est pas utilisée par des services
    if (mysqli_query($db, "DELETE FROM categorie WHERE id = $id")) {
        header("Location: categories.php");
    } else {
        echo "Une erreur s'est produite lors de la suppression de la catégorie '".$row['libelle']."'. Veuillez réessayer plus tard.<br>";
        echo "Error deleting record: " . $db->error;
    }
}
