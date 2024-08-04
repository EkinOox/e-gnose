<?php
require_once('../controller/singleton_connexion.php');
if (isset($_POST['inscription'])) {

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password_2 = $_POST['user_password_2'];
    $user_nom = $_POST['user_nom'];
    $user_telephone = $_POST['user_telephone'];
    $user_date_naissance = $_POST['user_date_naissance'];

    if (!empty($user_email) && !empty($user_password) && !empty($user_password_2)) {

        if ($user_password == $user_password_2) {
            $option = ['cost' => 12,];
            $hashpass = password_hash($user_password, PASSWORD_BCRYPT, $option);
            if (isset($_POST['user_nom'])) {
                $req = $db->prepare('INSERT INTO users(`user_nom`,`user_email`,`user_password`,`user_telephone`,`user_date_naissance`,`user_role`,`user_value`,`id_abonnement` )
 VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
                $req->execute(array(
                    $user_nom,
                    $user_email, $hashpass,
                    $user_telephone, $user_date_naissance, 3, 1, 1

                ));
                echo "<p style='color:white;'>inscription réussie</p>";
            }
        }
    }
}
?>