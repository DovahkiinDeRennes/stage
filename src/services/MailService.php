<?php
include(__DIR__ . '/../pages/core/connection.php');
require_once(__DIR__ . '/../classes/mail.php');
class MailService {
    private $mail;

    public function __construct($db) {
        $this->mail = new Mail($db);
    }

    public function getAllMails() {
        return $this->mail->getAllMails();
    }

    public function insert($nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message, $conditions) {
        return $this->mail->insert($nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message, $conditions);
    }

    public function update($id, $nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message) {
        return $this->mail->update($id, $nom, $prenom, $email, $tel, $societe, $fonction, $objet, $message);
    }

    public function delete($id) {
        return $this->mail->delete($id);
    }
}