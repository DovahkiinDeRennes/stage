<?php

$secret_key = 'test';

function encryptURL($url, $key)
{
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    return openssl_encrypt($url, 'aes-256-cbc', $key, 0, $iv) . '::' . bin2hex($iv);
}

function decryptHash($hash, $key)
{
    list($encrypted_data, $iv) = explode('::', $hash, 2);
    $iv = hex2bin($iv);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}

$url_unpkg = 'https://unpkg.com';
$url_google = 'https://fonts.googleapis.com';
$url_cdnjs = 'https://cdnjs.cloudflare.com';
$url_kaFonts = 'https://ka-f.fontawesome.com';
$url_kitFonts = 'https://kit.fontawesome.com';
$url_gstatic =  'https://fonts.gstatic.com';
$url_ytb = 'https://www.youtube.com';
$url_cdn = 'https://cdn.jsdelivr.net';

$encrypted_url1 = encryptURL($url_unpkg, $secret_key);
$encrypted_url2 = encryptURL($url_google, $secret_key);
$encrypted_url3 = encryptURL($url_cdnjs, $secret_key);
$encrypted_url4 = encryptURL($url_kaFonts, $secret_key);
$encrypted_url5 = encryptURL($url_kitFonts, $secret_key);
$encrypted_url6 = encryptURL($url_gstatic, $secret_key);
$encrypted_url7 = encryptURL($url_ytb, $secret_key);
$encrypted_url8 = encryptURL($url_cdn, $secret_key);

$decrypted_url1 = decryptHash($encrypted_url1, $secret_key);
$decrypted_url2 = decryptHash($encrypted_url2, $secret_key);
$decrypted_url3 = decryptHash($encrypted_url3, $secret_key);
$decrypted_url4 = decryptHash($encrypted_url4, $secret_key);
$decrypted_url5 = decryptHash($encrypted_url5, $secret_key);
$decrypted_url6 = decryptHash($encrypted_url6, $secret_key);
$decrypted_url7 = decryptHash($encrypted_url7, $secret_key);
$decrypted_url8 = decryptHash($encrypted_url8, $secret_key);

