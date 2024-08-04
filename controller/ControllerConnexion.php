<?php
if (isset($_POST['connexion'])) {
    extract($_POST);

    if (!empty($user_email) && !empty($user_password)) {

        if (isset($_POST['user_email'])) {
            $req = $db->prepare('SELECT * FROM users WHERE user_email = ?');
            $req->execute(array($user_email));
            $result = $req->fetch();
            if ($result == true) {
                if (password_verify($user_password, $result['user_password'])) {
                    $_SESSION["id_user"] = $result['id_user'];
                    $_SESSION["user_nom"] = $result['user_nom'];
                    $_SESSION["user_role"] = $result['user_role'];
                    $_SESSION["user_value"] = $result['user_value'];
                    if ($_SESSION['user_role'] == 1 && $_SESSION['user_value'] == 1) {
                        header('location: ../index.php');
                        exit;
                    } elseif ($_SESSION['user_role'] == 2 && $_SESSION['user_value'] == 1) {
                        header('location: ../index.php');
                        exit;
                    } elseif ($_SESSION['user_role'] == 3 && $_SESSION['user_value'] == 1) {
                        header('location: ../index.php');
                        exit;
                    } else {
                        header('location: 404.html');
                    }
                } else {
                    echo '
               <div class="box">
               <form class= "formBloc">
                <div class="mdpPerdu">
                Le mot de passe est incorrect, rÃ©essayez !
                </div>
               </form>
               </div>';
                }
            } else {
                echo '
               <div class="box">
               <form class= "formBloc">
                <div class="mdpPerdu">
                Les identifiants saisis ne sont pas valides
                </div>
               </form>
               </div>';
            }
        }
    }
}
