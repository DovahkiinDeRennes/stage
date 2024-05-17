<?php


require_once(__DIR__ . '/src/classes/url.php');

// Génération des nonces
$nonce1 = bin2hex(random_bytes(16));
$nonce2 = bin2hex(random_bytes(16));
$nonce3 = bin2hex(random_bytes(16));
$nonce4 = bin2hex(random_bytes(16));
$nonce5 = bin2hex(random_bytes(16));
$nonce6 = bin2hex(random_bytes(16));
$nonce7 = bin2hex(random_bytes(16));



$url = new Url($db);

$query = "SELECT mdp FROM mdpurl";
$stmt = $db->query($query);

$mdps = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($mdps)) {
    // Récupérer le premier mot de passe
    $first_mdp = $mdps[0]['mdp'];

    // Utiliser ce premier mot de passe
    $secret_key = $first_mdp;
} else {
    echo 'Mot de passe introuvable.';
}


if (!isset($secret_key)) {
    $secret_key = 's3cr3t_k3y';
    echo 'Mot de passe introuvable.';
}

$urlAosCss = $url->selectUrlById(1, $secret_key);
$urlAosJs = $url->selectUrlById(2, $secret_key);
$urlFontAwesomeJs = $url->selectUrlById(3, $secret_key);
$urlCyberGouvFormation = $url->selectUrlById(4, $secret_key);
$urlCyberGouv = $url->selectUrlById(5, $secret_key);
$urlGouvCharteCyber = $url->selectUrlById(6, $secret_key);
$urlLinkedin = $url->selectUrlById(7, $secret_key);
$urlCdnjsCloud = $url->selectUrlById(8, $secret_key);
$urlCdnJsdelivr = $url->selectUrlById(9, $secret_key);
$url_unpkg = $url->selectUrlById(10, $secret_key);
$url_google = $url->selectUrlById(11, $secret_key);
$url_cdnjs = $url->selectUrlById(12, $secret_key);
$url_kaFonts = $url->selectUrlById(13, $secret_key);
$url_kitFonts = $url->selectUrlById(14, $secret_key);
$url_gstatic = $url->selectUrlById(15, $secret_key);
$url_ytb = $url->selectUrlById(16, $secret_key);
$url_cdn = $url->selectUrlById(17, $secret_key);





// Définir la directive CSP avec les nonces
$csp_directive = "default-src 'self' $url_unpkg; ";
$csp_directive .= "script-src 'self' $url_unpkg $url_kitFonts $url_cdn 'nonce-" . $nonce1 . "' 'nonce-" . $nonce2 . "' 'nonce-" . $nonce3 . "' 'nonce-" . $nonce4 . "' 'nonce-" . $nonce5 . "' 'nonce-" . $nonce6 . "' 'nonce-" . $nonce7 . "' ; ";
$csp_directive .= "style-src 'self' 'unsafe-inline' $url_unpkg $url_google $url_cdnjs; ";
$csp_directive .= "connect-src 'self' $url_kaFonts $url_kitFonts; ";
$csp_directive .= "font-src 'self' $url_gstatic $url_cdnjs $url_kaFonts $url_kitFonts; ";
$csp_directive .= "frame-src 'self' $url_ytb;";
$csp_directive .= "base-uri 'self';";

// Ajouter la directive CSP à l'en-tête HTTP
header("Content-Security-Policy: " . $csp_directive);

?>


