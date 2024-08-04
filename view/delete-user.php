<?php
session_start();
if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role'] == 1){
        // l'utilisateur a un r�le d'administrateur
    } else if($_SESSION['user_role'] == 3){
        // l'utilisateur a un r�le de mod�rateur
        header('location: ../index.php');
        exit;
    } else {
        // l'utilisateur a un r�le ind�fini
        header('location: ../view/error/403.php');
        exit;
    }
} else {
    // la variable de session n'est pas initialis�e
    header('location: ../view/error/403.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
</head>

<body>
    <center>
        <p>Veuillez selectionner le user à supprimer :</p>
        <form action="" method='post'>
            <?php
            // On récupère tout le contenu de la table clients

            require_once("../controller/singleton_connexion.php");
            require_once("../controller/administration.php");
            global $db; ?>
            <select id="id" name="id">
                <?php
                $stmt = $db->query("SELECT id_user, user_nom FROM users");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    echo '<option value="' . $row['id_user'] . '">' . $row['id_user'] . ' - ' . $row['user_nom'] . '</option>';
                } ?>
            </select>
            <input type="submit" value="Valider" /><br />
        </form></br>

        <?php
        if (isset($_POST['id'])) {
            $req = $db->prepare("SELECT * FROM users WHERE id_user = ?");
            $req->bindParam(1, $_POST['id'], PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch(PDO::FETCH_ASSOC);
            echo "Vous voulez supprimer : " . $_POST['id'] . ' - ' . $donnees['user_nom'] . " ? </br>";
            echo '<form action="" method="post">';
            // On affiche chaque entrée une à une

            echo '<input type="int" name="id_user" value="' . $donnees['id_user'] . '"readonly> <br>';
            echo '<input type="text" name="user_nom" value="' . $donnees['user_nom'] . '" readonly><br>';
            echo '<input type="email" name="user_email" value="' . $donnees['user_email'] . '" readonly><br>';
            echo '<input type="number" name="user_role" value="' . $donnees['user_role'] . '" min="1" max="3" readonly><br>';
            echo '<input type="text" name="user_telephone" value="' . $donnees['user_telephone'] . '" readonly><br>';
            echo '<input type="date" name="user_date_naissance" value="' . $donnees['user_date_naissance'] . '" readonly><br>';
            echo '<input type="number" name="user_value" value="' . $donnees['user_value'] . '" min="0" max="1" readonly><br>';
            echo '<input type="number" name="id_abonnement" value="' . $donnees['id_abonnement'] . '" min="1" max="3" readonly><br>';
            echo "<input type='submit' value='supprimer définitivement' /><br />";
            echo "</form>";
        }
        $administration->DeleteUser();
        ?>
</body>

</html>