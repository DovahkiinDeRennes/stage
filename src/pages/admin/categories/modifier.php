<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/Categorie.php');


require_once(__DIR__ . '/../../../../csp_config.php');


// Récupération de l'ID de la catégorie à modifier
$id = $_GET['id'] ?? null;
if (!$id) {
    // Gérer le cas où l'ID n'est pas fourni
    echo "ID de catégorie manquant";
    exit();
}

// Récupération des informations de la catégorie à modifier
$stmt = $db->prepare("SELECT * FROM categorie WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['ok'])) {
    $libelle = $_POST['libelle'] ?? null;

    if (!$libelle) {
        // Gérer le cas où le libellé n'est pas fourni
        echo "Libellé manquant";
        exit();
    }

    // Créer une instance de la classe Categorie
    $categorie = new Categorie($db);

    // Appeler la méthode update() pour mettre à jour le libellé de la catégorie
    $result = $categorie->update($id, $libelle);

    if ($result) {
        // Redirection après la mise à jour
        header("Location: categories.php");
        exit();
    } else {
        // En cas d'erreur lors de la mise à jour
        $message = "Catégorie non modifiée";
    }
}

include(__DIR__ . '/formulaireModifier.php');
