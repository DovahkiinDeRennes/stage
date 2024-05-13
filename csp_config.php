<?php
// Génération des nonces
$nonce1 = base64_encode(random_bytes(16));
$nonce2 = base64_encode(random_bytes(16));
$nonce3 = base64_encode(random_bytes(16));
$nonce4 = base64_encode(random_bytes(16));
$nonce5 = base64_encode(random_bytes(16));
$nonce6 = base64_encode(random_bytes(16));
$nonce7 = base64_encode(random_bytes(16));

// Définir la directive CSP avec les nonces
$csp_directive = "default-src 'self' https://unpkg.com ; ";
$csp_directive .= "script-src 'self'  https://unpkg.com https://kit.fontawesome.com https://cdn.jsdelivr.net 'nonce-" . $nonce1 . "' 'nonce-" . $nonce2 . "' 'nonce-" . $nonce3 . "' 'nonce-" . $nonce4 . "' 'nonce-" . $nonce5 . "' 'nonce-" . $nonce6 . "' 'nonce-" . $nonce7 . "' ; ";
$csp_directive .= "style-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com https://cdnjs.cloudflare.com; ";
$csp_directive .= "connect-src 'self' https://ka-f.fontawesome.com https://kit.fontawesome.com; ";
$csp_directive .= "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com https://ka-f.fontawesome.com https://kit.fontawesome.com; ";
$csp_directive .= "frame-src 'self' https://www.youtube.com;";
$csp_directive .= "base-uri 'self';";

// Ajouter la directive CSP à l'en-tête HTTP
header("Content-Security-Policy: " . $csp_directive);
?>