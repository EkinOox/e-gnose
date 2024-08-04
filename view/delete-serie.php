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
        <p>Veuillez selectionner le serie à supprimer :</p>
        <form action="" method='post'>
            <?php
            // On récupere tout le contenu de la table clients

            require_once("../controller/singleton_connexion.php");
            require_once("../controller/administration.php");
            global $db; ?>
            <select id="id" name="id">
                <?php
                $stmt = $db->query("SELECT id_serie, serie_titre FROM series");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    echo '<option value="' . $row['id_serie'] . '">' . $row['id_serie'] . ' - ' . $row['serie_titre'] . '</option>';
                } ?>
            </select>
            <input type="submit" value="Valider" /><br />
        </form></br>

        <?php
        if (isset($_POST['id'])) {
            $req = $db->prepare("SELECT * FROM series WHERE id_serie = ?");
            $req->bindParam(1, $_POST['id'], PDO::PARAM_INT);
            $req->execute();
            $donnees = $req->fetch(PDO::FETCH_ASSOC);
            echo "Vous voulez supprimer : " . $_POST['id'] . ' - ' . $donnees['serie_titre'] . " ?</br>";
            echo '<form action="" method="post">';
            // On affiche chaque entrée une à une
           
            echo '<input type="int" name="id_serie" value="' . $donnees['id_serie'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_city" value="' . $donnees['serie_city'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_titre" value="' . $donnees['serie_titre'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_realisateur" value="' . $donnees['serie_realisateur'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_description_plus" value="' . $donnees['serie_description_plus'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_duree_episode" value="' . $donnees['serie_duree_episode'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_cover_image" value="' . $donnees['serie_cover_image'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_back_cover" value="' . $donnees['serie_back_cover'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_trailer" value="' . $donnees['serie_trailer'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_nombre_episodes" value="' . $donnees['serie_nombre_episodes'] . '" readonly>' . "<br>";
            echo '<input type="text" name="serie_nombre_saison" value="' . $donnees['serie_nombre_saison'] . '" readonly>' . "<br>";
            echo '<input type="float" name="serie_popularity" value="' . $donnees['serie_popularity'] . '" readonly>' . "<br>";
            echo '<input type="int" name="serie_value" value="' . $donnees['serie_value'] . '"  min="0" max="1" readonly>' . "<br>";
            echo "<input type='submit' value='supprimer définitivement' /><br />";
            echo "</form>";
        }
        $administration->DeleteSerie();
        ?>
</body>

</html>