<?php



require_once(__DIR__ . '/../../../../csp_config.php');



if (isset($_POST['ok'])) {

    $urlChiffre = htmlspecialchars($_POST['url'] ?? '', ENT_QUOTES, 'UTF-8');
    $urlSafe = htmlspecialchars($_POST['url'] ?? '', ENT_QUOTES, 'UTF-8');




    $verifUrl = $url->verifUrl($urlChiffre, $secret_key);



    if ($verifUrl) {
        echo "<p>URL déjà enregistrée.</p>";
    } else {
        // Chiffrer l'URL
        $encrypted_url = encryptURL($urlChiffre, $secret_key);

        // Insérer l'URL chiffrée dans la base de données
        $url->insert($encrypted_url,$urlSafe);

        // Afficher un message de succès ou effectuer d'autres actions après l'insertion
        echo "<p>URL insérée avec succès.</p>";
    }
}

// Inclure le formulaire pour ajouter une nouvelle URL
include(__DIR__ . '/formulaireAjouter.php');