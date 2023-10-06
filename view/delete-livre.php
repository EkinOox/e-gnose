<?php
session_start();
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 1) {
        // l'utilisateur a un r�le d'administrateur
    } else if ($_SESSION['user_role'] == 3) {
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
    <meta property="og:title" content="Supprimer un livre | e-Gnose"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <meta property="og:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="Supprimer un livre | e-Gnose"/>
    <meta name="twitter:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="twitter:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <title>Supprimer un livre | e-Gnose</title>

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
            <h1>Supprimer un livre</h1>
        </div>

        <div class="user_infos--container">
            <p>Sélectionnez le livre à supprimer :</p>

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
                <input class="subscribe__btn" type="submit" value="Valider"/>
            </form>
            </br>

            <?php
            if (isset($_POST['id'])) {
                $req = $db->prepare("SELECT * FROM livres WHERE id_livre = ?");
                $req->bindParam(1, $_POST['id'], PDO::PARAM_INT);
                $req->execute();
                $donnees = $req->fetch(PDO::FETCH_ASSOC);
                echo "Vous voulez supprimer : " . $_POST['id'] . ' - ' . $donnees['livre_titre'] . " ?</br>";
                echo '<form action="" method="post">';
                // On affiche chaque entrée une à une

                echo '<div class="form-group">

                <div class="form-group">
                    <input type="int" class="form-control" name="id_livre" value="' . $donnees['id_livre'] . '" readonly>
                </div>
                
                <div class="form-group">
                <label for="livre_titre">Titre du livre</label>
                    <input type="text" class="form-control" name="livre_titre" value="' . $donnees['livre_titre'] . '" readonly>
                </div>
            
                <div class="form-group">
                <label for="livre_editeur">Éditeur</label>
                    <input type="text" class="form-control" name="livre_editeur" value="' . $donnees['livre_editeur'] . '" readonly>
                </div>
            
                <div class="form-group">
                <label for="livre_auteur">Auteur</label>
                    <input type="text" class="form-control" name="livre_auteur" value="' . $donnees['livre_auteur'] . '" readonly>
                </div>
            
                <div class="form-group">
                <label for="livre_date_publication">Date de publication</label>
                    <input type="date" class="form-control" name="livre_date_publication" value="' . $donnees['livre_date_publication'] . '" readonly>
                </div>
            
                <div class="form-group">
                <label for="livre_nombre_page">Nombre de pages</label>
                    <input type="text" class="form-control" name="livre_nombre_page" value="' . $donnees['livre_nombre_page'] . '" readonly>
                </div>
            
                <div class="form-group">
                <label for="livre_cover_image">Image de couverture</label>
                    <input type="text" class="form-control" name="livre_cover_image" value="' . $donnees['livre_cover_image'] . '" readonly>
                </div>
            
                <div class="form-group">
                <label for="livre_description">Description</label>
                    <input type="text" class="form-control" name="livre_description" value="' . $donnees['livre_description'] . '" readonly>
                </div>
            
                <div class="form-group">
                <label for="livre_popularity">Popularité</label>
                    <input type="float" class="form-control" name="livre_popularity" value="' . $donnees['livre_popularity'] . '" readonly>
                </div>
            
                <div class="form-group">
                <label for="livre_value">Valeur</label>
                    <input type="int" class="form-control" name="livre_value" value="' . $donnees['livre_value'] . '" min="0" max="1" readonly>
                </div>';

                echo '<input style="width: 15rem;" class="subscribe__btn" type="submit" value="Supprimer définitivement">';

                echo "</form>";
            }
            $administration->DeleteLivre();
            ?>
</body>

</html>