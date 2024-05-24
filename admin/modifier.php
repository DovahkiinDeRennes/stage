<?php


require_once(__DIR__ . '/../csp_config.php');


session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les actualités</title>
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <link rel="stylesheet" href="/assets/css/admin.css" />
</head>

<body>
<?php
require_once __DIR__ . '/../src/pages/core/connection.php';
require_once __DIR__ . '/../admin/check_login.php';

// On récupère l'ID dans le lien
$id = $_GET['id'];
// Requête pour afficher les infos d'un produit
$stmt = $db->prepare("SELECT * FROM compte WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['ok'])) {
    $password = $row['mdp'];
    if ($_POST['mdp'] === $_POST['mdp-confirm']) {
        $oldmdp = sha1($_POST['oldmdp']);
        if ($oldmdp === $password) {
            $utilisateur = htmlspecialchars($_POST['newusername']);
            $mdp = sha1($_POST['mdp']);
            $update_query = "UPDATE compte SET utilisateur = :utilisateur , mdp = :mdp WHERE id = :id";
            $update_stmt = $db->prepare($update_query);
            $update_stmt->bindParam(':utilisateur', $utilisateur);
            $update_stmt->bindParam(':mdp', $mdp);
            $update_stmt->bindParam(':id', $id);
            if ($update_stmt->execute()) {
                echo "<script>window.location.href = 'index.php';</script>";
            } else {
                $message = "Erreur lors de la mise à jour du compte.";
            }
        } else {
            $message = "Mot de passe incorrect";
        }
    } else {
        $message = "Les mots de passe ne correspondent pas";
    }
}
?>
<?php include(__DIR__ . '/../src/pages/admin/navbar.php'); ?>

<div class="form">
    <a href="actualites_creation.php" class="back_btn"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg> Retour</a>
    <center>
        <h2>Modifier admin : <?php echo htmlspecialchars($row['utilisateur']); ?> </h2>

        <p class="erreur_message">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Nom d'utilisateur</label><br>
            <input type="text" name="newusername" value="<?php echo htmlspecialchars($row['utilisateur']); ?>"><br>
            <label>Nouveau mot de passe</label><br>
            <input type="password" name="mdp" value="" placeholder="Veuillez saisir ici..."><br>
            <label>Confirmer le nouveau mot de passe</label><br>
            <input type="password" name="mdp-confirm" value="" placeholder="Veuillez saisir ici..."><br>
            <label>Ancien mot de passe</label><br>
            <input type="password" name="oldmdp" value="" placeholder="Veuillez saisir ici..."><br>
            <input type="submit" value="Modifier" name="ok"><br>
            <a href="mdpmail.php?id=<?= $id ?>" name="reset">Mot de passe oublie ?</a><br>
        </form>
    </center>
</div>
</body>

</html>