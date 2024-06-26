<?php
include (__DIR__ . '/src/pages/core/connection.php');


$id = $_GET['id'];
$produit = $_GET['titre'];
$table = $_GET['direction'];
$query = "SELECT * FROM $table WHERE id = $id";
$result = $db->query($query);

// Récupérer la première ligne (car chaque produit a un seul nom)
if ($row = $result->fetch_assoc()) {
    // Définir le titre de la page avec le nom du produit
    $pageTitle = $row['titre'];
    echo "<html lang='fr'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>" . htmlspecialchars($pageTitle) . "</title>";
    echo "<link rel='stylesheet' href='assets/css/info.css'>";
    echo " <link rel='stylesheet' href='assets/css/footer.css' />";
    echo "<link rel='stylesheet' href='assets/css/styles.css'>";
    echo "</head>";
    echo "<body>";
    include (__DIR__ . '/src/pages/admin/navbar.php');

    do {
        echo "<div class='card'>";
        echo "<img src='/images/servicesetproduits/" . $row['image_url'] . "' alt='". $row['alt_text'] ."'>";
        echo "<h3>" . $row['titre'] . "</h3>";
        echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
        
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            echo "<div class='admin'>";
            echo "<a href='/src/pages/admin/modifier.php?id=" . $row['id'] . "' class='admin_action_special'><svg xmlns='http://www.w3.org/2000/svg' height='16' width='16' viewBox='0 0 512 512'><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z'/></svg></a>";
            echo "<a href='supprimer.php?id=" . $row['id'] . "' class='admin_action_special'><svg xmlns='http://www.w3.org/2000/svg' height='16' width='18' viewBox='0 0 576 512'><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d='M576 128c0-35.3-28.7-64-64-64H205.3c-17 0-33.3 6.7-45.3 18.7L9.4 233.4c-6 6-9.4 14.1-9.4 22.6s3.4 16.6 9.4 22.6L160 429.3c12 12 28.3 18.7 45.3 18.7H512c35.3 0 64-28.7 64-64V128zM271 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z'/></svg></a>";
            echo "</div>";
        }

        // Bouton à la fin de la card
        echo "<a href='contact.php' class='button'>Nous Contacter</a>";
        echo "<a href='javascript:void(0);' onclick='history.back();' class='button'>Retour à la page précédente</a>";



        echo "</div>";
    } while ($row = $result->fetch_assoc());
    ?>
            <?php require_once 'partials/footer.php' ?>

        <?php
    echo "</body>";
    echo "</html>";
} else {
    // Produit non trouvé, rediriger ou afficher un message d'erreur

    header('Location: /partials/error.php');


}

$result->close();
?>
