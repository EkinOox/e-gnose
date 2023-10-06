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
<html lang=fr>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="robots" content="index, follow"/>
    <meta property="og:title" content="Supprimer une série | e-Gnose"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <meta property="og:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="Supprimer une série | e-Gnose"/>
    <meta name="twitter:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="twitter:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <title>Supprimer une série | e-Gnose</title>

    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">

    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.usebootstrap.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css' rel="stylesheet">
    <link href="../assets/css/modify-pages.css" rel="stylesheet" type="text/css" media="screen">
    <script src="https://kit.fontawesome.com/d51f8b0cc0.js" crossorigin="anonymous" defer></script>
</head>

<body class="unselectable">

<?php
include_once('../_navbar/navbar.php');
?>

<section>
    <div class="container">
        <div class="title">
            <h1>Supprimer une série</h1>
        </div>

        <div class="user_infos--container">
            <p>Sélectionnez la série à supprimer :</p>
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
            <input class="subscribe__btn" type="submit" value="Valider"/>
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
            echo'<div class="form-group">
            
            <div class="form-group">
            <label for="id_serie">ID Série</label>
                <input type="int" class="form-control" name="id_serie" value="' . $donnees['id_serie'] . '" readonly>
            </div>

            <div class="form-group">
            <label for="serie_city">Ville</label>
                <input type="text" class="form-control" name="serie_city" value="' . $donnees['serie_city'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_titre">Titre de la série</label>
                <input type="text" class="form-control" name="serie_titre" value="' . $donnees['serie_titre'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_realisateur">Réalisateur</label>
                <input type="text" class="form-control" name="serie_realisateur" value="' . $donnees['serie_realisateur'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_description_plus">Description</label>
                <input type="text" class="form-control" name="serie_description_plus" value="' . $donnees['serie_description_plus'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_duree_episode">Durée d\'un épisode</label>
                <input type="text" class="form-control" name="serie_duree_episode" value="' . $donnees['serie_duree_episode'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_cover_image">Image de couverture</label>
                <input type="text" class="form-control" name="serie_cover_image" value="' . $donnees['serie_cover_image'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_back_cover">Image de couverture arrière</label>
                <input type="text" class="form-control" name="serie_back_cover" value="' . $donnees['serie_back_cover'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_trailer">Bande annonce</label>
                <input type="text" class="form-control" name="serie_trailer" value="' . $donnees['serie_trailer'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_nombre_episodes">Nombre d\'épisodes</label>
                <input type="text" class="form-control" name="serie_nombre_episodes" value="' . $donnees['serie_nombre_episodes'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_nombre_saison">Nombre de saisons</label>
                <input type="text" class="form-control" name="serie_nombre_saison" value="' . $donnees['serie_nombre_saison'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_popularity">Popularité</label>
                <input type="float" class="form-control" name="serie_popularity" value="' . $donnees['serie_popularity'] . '" readonly>
            </div>
            
            <div class="form-group">
            <label for="serie_value">Valeur</label>
                <input type="int" class="form-control" name="serie_value" value="' . $donnees['serie_value'] . '" min="0" max="1" readonly>
            </div>';
            
            echo '<input style="width: 15rem;" class="subscribe__btn" type="submit" value="Supprimer définitivement">';
            echo "</form>";

        }
        $administration->DeleteSerie();
        ?>
        </div>
    </div>
</section>
</body>

</html>