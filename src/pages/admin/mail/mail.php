<?php
include_once(__DIR__ . '/../../../../admin/check_login.php');
include_once(__DIR__ . '/../../core/connection.php');
include_once(__DIR__ . '/../../../classes/mail.php');

$mail = new Mail($db);
$mails = $mail->getAllMails();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/admin.css" />
</head>
<body>
<?php include_once(__DIR__ . '/../../admin/navbar.php'); ?>
<center>
    <h2>Page de mail Fidelilium</h2>
    <p>Contenu protégé réservé à l'administrateur.</p>

    <a href="/admin/logout.php">Déconnexion</a>

    <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Tel</th>
            <th>Société</th>
            <th>Fonction</th>
            <th>Object</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($mails as $donnees) {
            echo "<tr>
                    <td>" . $donnees['nom'] . "</td>
                    <td>" . $donnees['prenom'] . "</td>
                    <td>" . $donnees['mail'] . "</td>
                    <td>" . $donnees['tel'] . "</td>
                    <td>" . $donnees['societe'] . "</td>
                    <td>" . $donnees['fonction'] . "</td>
                    <td>" . $donnees['object'] . "</td>
                    <td>" . $donnees['message'] . "</td>
                    <td>" . $donnees['date'] . "</td>
                    <td> <a href='modifier.php?id=" . $donnees['id'] . "'><svg xmlns='http://www.w3.org/2000/svg' height='16' width='16' viewBox='0 0 512 512'><path d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z'/></svg></a></td>
                    <td> <a href='supprimer.php?id=" . $donnees['id'] . "'><svg xmlns='http://www.w3.org/2000/svg' height='16' width='18' viewBox='0 0 576 512'><path d='M576 128c0-35.3-28.7-64-64-64H205.3c-17 0-33.3 6.7-45.3 18.7L9.4 233.4c-6 6-9.4 14.1-9.4 22.6s3.4 16.6 9.4 22.6L160 429.3c12 12 28.3 18.7 45.3 18.7H512c35.3 0 64-28.7 64-64V128zM271 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z'/></svg></a></td>
                </tr>";
        }
        ?>

        </tbody>
    </table>
</center>
<?php
// Fermer la connexion
mysqli_close($db);
?>
</body>
</html>