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
    <meta property="og:title" content="Supprimer un film | e-Gnose"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <meta property="og:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="Supprimer un film | e-Gnose"/>
    <meta name="twitter:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="twitter:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <title>Supprimer un film | e-Gnose</title>

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

<div id="preloader">
    <?php include_once('../controller/preloader.php'); ?>
</div>


<?php
include_once('../_navbar/navbar.php');
?>
<section>
    <div class="container">
        <div class="title">
            <h1>Supprimer un film</h1>
        </div>

        <div class="user_infos--container">
            <p>Sélectionnez le film à supprimer :</p>

            <form action="" method='post'>
                <?php
                // On récupere tout le contenu de la table clients

                require_once("../controller/singleton_connexion.php");
                require_once("../controller/administration.php");
                global $db; ?>
                <select id="id" name="id">
                    <?php
                    $stmt = $db->query("SELECT id_film, film_titre FROM films");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo '<option value="' . $row['id_film'] . '">' . $row['id_film'] . ' - ' . $row['film_titre'] . '</option>';
                    } ?>
                </select>
                <input class="subscribe__btn" type="submit" value="Valider"/>
            </form></br>

            <?php
            if (isset($_POST['id'])) {
                $req = $db->prepare("SELECT * FROM films WHERE id_film = ?");
                $req->bindParam(1, $_POST['id'], PDO::PARAM_INT);
                $req->execute();
                $donnees = $req->fetch(PDO::FETCH_ASSOC);
                echo "Vous voulez supprimer : " . $_POST['id'] . ' - ' . $donnees['film_titre'] . " ?</br>";
                echo '<form action="" method="post">';
                // On affiche chaque entrée une à une

                echo '<div class="form-group">

                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_film" value="' . $donnees['id_film'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_city">Film City</label>
                    <input type="text" class="form-control" name="film_city" value="' . $donnees['film_city'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_titre">Titre</label>
                    <input type="text" class="form-control" name="film_titre" value="' . $donnees['film_titre'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_description">Description</label>
                    <input type="text" class="form-control" name="film_description" value="' . $donnees['film_description'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_realisateur">Réalisateur(s)</label>
                    <input type="text" class="form-control" name="film_realisateur" value="' . $donnees['film_realisateur'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_cover_image">Image de couverture</label>
                    <input type="text" class="form-control" name="film_cover_image" value="' . $donnees['film_cover_image'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_back_image">Image d\'arrière-plan</label>
                    <input type="text" class="form-control" name="film_back_image" value="' . $donnees['film_back_image'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_trailer">Trailer</label>
                    <input type="text" class="form-control" name="film_trailer" value="' . $donnees['film_trailer'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_duree">Durée</label>
                    <input type="number" class="form-control" name="film_duree" value="' . $donnees['film_duree'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_date">Date de publication</label>
                    <input type="date" class="form-control" name="film_date" value="' . $donnees['film_date'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_popularity">Popularité</label>
                    <input type="number" step="0.1" class="form-control" name="film_popularity" value="' . $donnees['film_popularity'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="film_value">Valeur</label>
                    <input type="number" class="form-control" name="film_value" value="' . $donnees['film_value'] . '" min="0" max="1" readonly>
                </div>';

                echo '<input style="width: 15rem;" class="subscribe__btn" type="submit" value="Supprimer définitivement">';

                echo "</form>";
            }
            $administration->Deletefilm();
            ?>
        </div>
    </div>
</section>
</body>

</html>