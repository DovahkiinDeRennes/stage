<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../services/CategorieService.php');


require_once(__DIR__ . '/../../../../csp_config.php');


$id = $_GET['id'];

$categorie = new CategorieService($db);

// Vérification si la catégorie est utilisée par des services
$query_check_services = "SELECT COUNT(*) as count FROM services WHERE categories = ?";
$stmt_check_services = $db->prepare($query_check_services);
$stmt_check_services->execute([$id]);
$row_check_services = $stmt_check_services->fetch(PDO::FETCH_ASSOC);

if ($row_check_services['count'] > 0) {
    echo "Impossible de supprimer la catégorie car elle est utilisée par des services. Vous devez d'abord supprimer tous les services associés à cette catégorie avant de pouvoir la supprimer.<br>";
    echo "<a href='categories.php'>Retour</a>";
} else {
    $result = $categorie->delete($id);

    if ($result) {
        header("Location: categories.php");
    } else {
        echo "Une erreur s'est produite lors de la suppression de la catégorie. Veuillez réessayer plus tard.<br>";
    }
}
?>

