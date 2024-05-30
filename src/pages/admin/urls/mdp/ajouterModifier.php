<?php

include(__DIR__ . '/../../../core/connection.php');

include(__DIR__ . '/../../../admin/navbar.php');
echo '<link rel="stylesheet" href="/assets/css/urlChiffrage.css" />';
echo '<link rel="stylesheet" href="/assets/css/admin.css" />';

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}


if (isset($_POST['ok'])) {
    $stmt = $db->query("SELECT mdp, ancienmdp FROM mdpurl WHERE id = 1");
    $count = $stmt->rowCount();
    if($count > 0){
        echo "Mot de passe existant.";
    } else {
        $mdp = htmlspecialchars($_POST['mdp'] ?? '', ENT_QUOTES, 'UTF-8');

        $stmt = $db->query("SELECT mdp FROM mdpurl WHERE id = 1");
        $old_secret_key = $stmt->fetchColumn();

        $new_secret_key = hashPassword($mdp);

        if ($new_secret_key){
            $stmt = $db->prepare("INSERT INTO mdpurl (mdp) VALUES (:new_key)");
            $stmt->bindParam(":new_key", $new_secret_key);
            $result = $stmt->execute();
            if($result){
                echo "Mot de passe mis à jour.";

                $stmt = $db->query("SELECT id, urlSafe FROM url");
                $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($urls as $row) {
                    $url_safe = $row['urlSafe'];

                    $encrypted_url = encryptURL($url_safe, $new_secret_key);

                    $stmt = $db->prepare("UPDATE url SET url = :url WHERE id = :id");
                    $stmt->bindParam(":url", $encrypted_url);
                    $stmt->bindParam(":id", $row['id']);
                    $test = $stmt->execute();
                    if($test){
                        echo "URL mise à jour.";
                    }else{
                        echo "URL non mise à jour.";
                    }
                }

            }
        }
    }
}

if (isset($_POST['modifier'])) {

    $ancienmdp = htmlspecialchars($_POST['ancienmdp'] ?? '', ENT_QUOTES, 'UTF-8');
    $mdp = htmlspecialchars($_POST['newmdp'] ?? '', ENT_QUOTES, 'UTF-8');
    $confirmmdp = htmlspecialchars($_POST['confmdp'] ?? '', ENT_QUOTES, 'UTF-8');

    $stmt = $db->query("SELECT mdp FROM mdpurl WHERE id = 1");
    $mdpactuel = $stmt->fetchColumn();

    $mdpactuel = verifyPassword($ancienmdp, $mdpactuel);

    if ($mdpactuel) {
        if ($mdp === $confirmmdp) {


            $stmt = $db->query("SELECT mdp FROM mdpurl WHERE id = 1");
            $ancienmdp = $stmt->fetchColumn();

            $stmt = $db->prepare("UPDATE mdpurl SET ancienmdp = :old_key WHERE id = 1");
            $stmt->bindParam(":old_key", $ancienmdp); // Utilisez $ancienmdp au lieu de $old_secret_key
            $result = $stmt->execute(); // Assurez-vous que $result est utilisé ici

            if ($result) {
                $new_secret_key = hashPassword($mdp);
                $stmt = $db->prepare("UPDATE mdpurl SET mdp = :new_key WHERE id = 1");
                $stmt->bindParam(":new_key", $new_secret_key);
                $result = $stmt->execute();

                if ($result) {
                    echo "Mot de passe mis à jour.";

                    $stmt = $db->query("SELECT id, urlSafe FROM url");
                    $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($urls as $row) {
                        $url_safe = $row['urlSafe'];

                        $encrypted_url = encryptURL($url_safe, $new_secret_key);

                        $stmt = $db->prepare("UPDATE url SET url = :url WHERE id = :id");
                        $stmt->bindParam(":url", $encrypted_url);
                        $stmt->bindParam(":id", $row['id']);
                        $test = $stmt->execute();
                        if ($test) {
                            echo "URL mise à jour.";
                        } else {
                            echo "URL non mise à jour.";
                        }
                    }
                } else {
                    echo "Échec de la mise à jour de l'ancien mot de passe.";
                }
            } else {
                echo "Échec de la mise à jour du mot de passe.";
            }
        } else {
            echo "Les deux mots de passe ne sont pas identiques.";
        }
    } else {
        echo "Le mot de passe actuel est incorrect.";

    }
}


require_once(__DIR__ . '/formulaireModiferAjouterMdp.php');

$db = null;
?>