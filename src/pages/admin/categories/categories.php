<?php
include(__DIR__ . '/../../../../admin/check_login.php');
include(__DIR__ . '/../../core/connection.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/admin.css" />
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.1.2-web/css/all.css" />
    <script src="/assets/js/confirmDelete.js"></script>
</head>
<body>
<?php include(__DIR__ . '/../../admin/navbar.php'); ?>

<h1> categories</h1>
<a href="ajouter.php"><input type="button" value="Ajouter une categorie"></a>
<?php include(__DIR__ . '/../../admin/afficher_categories.php'); ?>




<script>
    function confirmDelete() {
        return confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ?");
    }
</script>
</body>
</html>
