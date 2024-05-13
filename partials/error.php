<?php
require_once(__DIR__ . '/../csp_config.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/roots.css" />
    <link rel="stylesheet" href="/assets/css/header.css" />
    <link rel="stylesheet" href="/assets/css/footer.css" />
    <link rel="stylesheet" href="/assets/css/info.css" />
    <title>Document</title>
</head>
<body>
<?php require_once 'header.php' ?>


    <main>
<div class="division-erreur">
    <div class="error-text" >
        <h1 >Oops ! </h1>
        <p>Malheuresement, le produit que vous cherché n'existe plus ou cette page n'a jamais existé.</p>
        <p>Mais pas de soucis, vous pouvez :</p>
        <a href="/index.php"><button class="bouton-redirection">Retourner à la page d'accueil</button></a>
        <a href="/produits.php"><button class="bouton-redirection">Aller sur la page produits</button></a>
        <a href="/services.php"><button class="bouton-redirection">Aller sur la page Services</button></a>
    </div>
    <div class="image-erreur">
        <img src="/images/image_page_erreur.png" alt="">
    </div>
</div>
</main>
<?php require_once 'footer.php' ?>

</body>
</html>

