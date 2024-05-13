<?php

require_once(__DIR__ . '/chiffrageUrl.php');

// Génération des nonces
$nonce1 = base64_encode(random_bytes(16));
$nonce2 = base64_encode(random_bytes(16));
$nonce3 = base64_encode(random_bytes(16));
$nonce4 = base64_encode(random_bytes(16));
$nonce5 = base64_encode(random_bytes(16));
$nonce6 = base64_encode(random_bytes(16));
$nonce7 = base64_encode(random_bytes(16));





// Définir la directive CSP avec les nonces
$csp_directive = "default-src 'self' $decrypted_url1 ; ";
$csp_directive .= "script-src 'self'  $decrypted_url1 $decrypted_url5 $decrypted_url8 'nonce-" . $nonce1 . "' 'nonce-" . $nonce2 . "' 'nonce-" . $nonce3 . "' 'nonce-" . $nonce4 . "' 'nonce-" . $nonce5 . "' 'nonce-" . $nonce6 . "' 'nonce-" . $nonce7 . "' ; ";
$csp_directive .= "style-src 'self' 'unsafe-inline' $decrypted_url1 $decrypted_url2 $decrypted_url3; ";
$csp_directive .= "connect-src 'self' $decrypted_url4 $decrypted_url5; ";
$csp_directive .= "font-src 'self' $decrypted_url6 $decrypted_url3 $decrypted_url4 $decrypted_url5; ";
$csp_directive .= "frame-src 'self' $decrypted_url7;";
$csp_directive .= "base-uri 'self';";

// Ajouter la directive CSP à l'en-tête HTTP
header("Content-Security-Policy: " . $csp_directive);

?>



