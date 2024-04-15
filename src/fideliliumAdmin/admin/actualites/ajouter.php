<?php
include(__DIR__ . '/../../admin/check_login.php');
include(__DIR__ . '/../../Core/connection.php');

if (isset($_POST['ok'])) {
    $titre = mysqli_real_escape_string($db, $_POST['titre']);
    $texte = mysqli_real_escape_string($db, $_POST['texte']);
    $alt = mysqli_real_escape_string($db, $_POST['alt_text']);
    if ($_POST['lien-ytb']) {
        $ytb_url = $_POST['lien-ytb'];
        $new_img_name = "non";
    }
    else {
        // Vérifier si un fichier a été téléchargé
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
    
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png" ,"mp4");
    
        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . 'actualites' . $img_ex_lc;
            $img_upload_path = __DIR__ . '/../../images/actualites/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
            $ytb_url = "non";

    }
    }



        // Insert into Database
        mysqli_query($db, "INSERT INTO actualite (titre, texte, image, ytb_url, alt_text, date) VALUES ('$titre','$texte','$new_img_name', '$ytb_url','$alt', NOW())");
        header("Location: actualites_creation.php");
    } else {
        echo "Erreur";
    }

mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire PHP</title>
    <link rel="stylesheet" href="/assets/css/servicesproduits.css" />
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
</head>

<body>
<?php include(__DIR__ . '/../../admin/navbar.php'); ?>
    <center>
        <h1>Ajouter une actualité</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <input type="text" name="titre" placeholder="Votre Titre" required><br>
            <textarea name="texte" rows="4" placeholder="Votre description" required></textarea><br>
            <input type="file" name="image" accept="image/*"><br>
            <input type="text" name="lien-ytb" placeholder="Mettre un lien youtube"><br>
            <input type="text" name="alt_text" placeholder="ALT texte d'image SEO"><br>
            <Button type="submit" name="ok">Envoyer</Button>
        </form>
    </center>
</body>

</html>
