<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/service.php');

// Récupérer les catégories
$query = "SELECT id, libelle FROM categorie";
$stmt = $db->query($query);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$categories) {
    echo "Erreur de requête : " . $db->errorInfo()[2];
}

if(isset($_POST['ok'])) {
    // Valider et filtrer les données d'entrée
    $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
    $texte = filter_input(INPUT_POST, 'texte', FILTER_SANITIZE_STRING);
    $alt = filter_input(INPUT_POST, 'alt_text', FILTER_SANITIZE_STRING);
    $categories_id = filter_input(INPUT_POST, 'categories', FILTER_VALIDATE_INT);

    // Vérifier si tous les champs sont remplis
    if (empty($titre) || empty($texte) || empty($alt) || empty($categories_id)) {
        $message = "Tous les champs doivent être remplis.";
        header("Location: ajouter.php?error=$message");
        exit;
    }

    // Vérifier le type de fichier
    $img_name = $_FILES['image']['name'];
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $allowed_exs = array("jpg", "jpeg", "png");

    if (!in_array(strtolower($img_ex), $allowed_exs)) {
        $message = "Extension de fichier non autorisée. Veuillez télécharger une image au format JPG, JPEG ou PNG.";
        header("Location: ajouter.php?error=$message");
        exit;
    }

    // Déplacer le fichier téléchargé
    $new_img_name = uniqid("IMG-", true) . 'services.' .$img_ex;
    $img_upload_path = __DIR__ . '/../../../../images/servicesetproduits/' . $new_img_name;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $img_upload_path)) {
        $message = "Erreur lors du téléchargement de l'image.";
        header("Location: ajouter.php?error=$message");
        exit;
    }

    // Insérer le service dans la base de données
    $service = new service($db);
    $success = $service->insert($titre, $texte, $new_img_name, $alt, $categories_id);

    if ($success) {
        header("Location: ajouter.php?success=Service ajouté avec succès.");
        exit;
    } else {
        $message = "Erreur lors de l'ajout du service.";
        header("Location: ajouter.php?error=$message");
        exit;
    }
}
?>
<?php include(__DIR__ . '/formulaireAjouter.php'); ?>