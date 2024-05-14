<?php
require_once(__DIR__ . '/../../chiffrageUrl.php');
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

        // Déchiffrer chaque URL
        foreach ($results as $row) {
            $decrypted_url = decryptHash($row['url'], $secret_key);
            if ($decrypted_url === $url) {
                return true;
            }
        }

        return false;
    }







    public function insert($url)
    {
        if (isset($url) && !empty($url)) {
            $query = "INSERT INTO url (url) VALUES (?)";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$url]);

            if ($success) {
                header('Location: url.php');
                exit;
            }
        }
    }
}