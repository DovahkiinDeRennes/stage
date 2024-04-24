<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
include(__DIR__ . '/../../../classes/service.php');

$query = "SELECT id, libelle FROM categorie";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $categories = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = array(
            'id' => $row['id'],
            'libelle' => $row['libelle']
        );
    }
} else {
    echo "Erreur de requête : " . mysqli_error($db);
}

if(isset($_POST['ok'])) {
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $texte = isset($_POST['texte']) ? $_POST['texte'] : '';
    $alt = isset($_POST['alt_text']) ? $_POST['alt_text'] : '';
    $categories = isset($_POST['categories']) ? $_POST['categories'] : '';

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true) . 'services.' .$img_ex_lc;
        $img_upload_path = __DIR__ . '/../../../../images/servicesetproduits/' . $new_img_name;
        if (move_uploaded_file($tmp_name, $img_upload_path)) {

            $service = new service($db);
            $service->insert($titre, $texte, $new_img_name, $alt, $categories);

        } else {

            $message ="Il vous faut une image pour ajouter un service.";
            header("Location: ajouter.php");


        }
    } else {
             $message ="Extension de fichier non autorisée. Veuillez télécharger une image au format JPG, JPEG ou PNG.";
             header("Location: ajouter.php");




    }



}


?>
<?php include(__DIR__ . '/formulaireAjouter.php'); ?>