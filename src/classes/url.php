<?php

include(__DIR__ . '/../../src/pages/core/connection.php');

class url
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function verifUrl($url, $secret_key) {

        $query = "SELECT * FROM url";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            $decrypted_url = decryptHash($row['url'], $secret_key);
            if ($decrypted_url === $url) {
                return true;
            }
        }
        return false;
    }




    public function selectUrlById($id, $secret_key)
    {
        $query = "SELECT url FROM url WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['url'])) {

            $decrypted_url = decryptHash($result['url'], $secret_key);

            if ($decrypted_url !== false) {
                // Retourner l'URL décryptée si réussie
                return $decrypted_url;
            }
        }

        // Retourner false si l'URL n'a pas été trouvée ou si le décryptage a échoué
        return false;

    }


    public function insert($url, $urlsafe)
    {
        if (isset($url) && !empty($url)) {
            $query = "INSERT INTO url (url, urlsafe) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$url,$urlsafe]);

            if ($success) {
                return true;
            }
        }
    }
}

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