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
        <p>Veuillez selectionner le livre à supprimer :</p>
        <form action="" method='post'>
            <?php
            // On récupere tout le contenu de la table clients

            require_once("../controller/singleton_connexion.php");
            require_once("../controller/administration.php");
            global $db; ?>
            <select id="id" name="id">
                <?php
                $stmt = $db->query("SELECT id_livre, livre_titre FROM livres");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    echo '<option value="' . $row['id_livre'] . '">' . $row['id_livre'] . ' - ' . $row['livre_titre'] . '</option>';
                } ?>
            </select>
            <input type="submit" value="Valider" /><br />
        </form></br>

        <?php
        if (isset($_POST['id'])) {
            $req = $db->prepare("SELECT * FROM livres WHERE id_livre = ?");
            $req->bindParam(1, $_POST['id'], PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch(PDO::FETCH_ASSOC);
            echo "Vous voulez supprimer : " . $_POST['id'] . ' - ' . $donnees['livre_titre'] . " ?</br>";
            echo '<form action="" method="post">';
            // On affiche chaque entrée une à une

            echo '<input type="int" name="id_livre" value="' . $donnees['id_livre'] . '" readonly>' . "<br>";
            echo '<input type="text" name="livre_titre" value="' . $donnees['livre_titre'] . '" readonly>' . "<br>";
            echo '<input type="text" name="livre_editeur" value="' . $donnees['livre_editeur'] . '" readonly>' . "<br>";
            echo '<input type="text" name="livre_auteur" value="' . $donnees['livre_auteur'] . '" readonly>' . "<br>";
            echo '<input type="date" name="livre_date_publication" value="' . $donnees['livre_date_publication'] . '" readonly>' . "<br>";
            echo '<input type="text" name="livre_nombre_page" value="' . $donnees['livre_nombre_page'] . '" readonly>' . "<br>";
            echo '<input type="text" name="livre_cover_image" value="' . $donnees['livre_cover_image'] . '" readonly>' . "<br>";
            echo '<input type="text" name="livre_description" value="' . $donnees['livre_description'] . '" readonly>' . "<br>";
            echo '<input type="float" name="livre_popularity" value="' . $donnees['livre_popularity'] . '" readonly>' . "<br>";
            echo '<input type="int" name="livre_value" value="' . $donnees['livre_value'] . '"  min="0" max="1" readonly>' . "<br>";
            echo "<input type='submit' value='supprimer définitivement' /><br />";
            echo "</form>";
        }
        $administration->DeleteLivre();
        ?>
</body>

</html>