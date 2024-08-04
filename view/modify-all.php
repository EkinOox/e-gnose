<!DOCTYPE html>
<html lang=fr>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="robots" content="index, follow"/>
    <meta property="og:title" content="Authentification | e-Gnose"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="../assets/img/favicon.png"/>
    <meta property="og:url" content="../view/authentification.php"/>
    <meta property="og:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="Authentification | e-Gnose"/>
    <meta name="twitter:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="twitter:image" content="../assets/img/favicon.png"/>
    <title>Authentification | e-Gnose</title>

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


<p>Veuillez selectionner l'immatriculation de l'embarcation à modifier:</p>

<form action="" method='post'>
    <?php
    // On r�cup�re tout le contenu de la table clients

    require_once("../controller/singleton_connexion.php");
    require_once("../controller/administration.php");
    global $db;

    echo '<select id="choix" name="choix">
                    <option value="user">Utilisateurs</option>
                    <option value="film">Films</option>
                    <option value="genre">Genres</option>
                </select>
                <input type="submit" value="Valider" /><br />';


    if (isset($_POST['choix'])) {
    $choix = $_POST['choix'];
    ?>
    <select id="id" name="id">
        <?php
        $stmt = $db->query("SELECT id_" . $choix . " FROM " . $choix . "s");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            echo '<option value="' . $row['id_' . $choix] . '">' . $row['id_' . $choix] . '</option>';
        } ?>
    </select>
    <input type="submit" value="Valider"/><br/>
</form>

<?php
if (isset($_POST['id'])) {
    $req = $db->prepare("SELECT * FROM " . $choix . "s WHERE id_" . $choix . " = " . $_POST['id'] . "");
    $req->execute();
    $donnees = $req->fetch(PDO::FETCH_ASSOC);
    echo '<form action="" method="post">';
    // On affiche chaque entrée une à une
    if ($choix == "user") {
        echo '<input type="int" name="id_user" value="' . $donnees['id_user'] . '"readonly> <br>';
        echo '<input type="text" name="user_nom" value="' . $donnees['user_nom'] . '" required><br>';
        echo '<input type="email" name="user_email" value="' . $donnees['user_email'] . '" required><br>';
        echo '<input type="number" name="user_role" value="' . $donnees['user_role'] . '" min="1" max="3" required><br>';
        echo '<input type="text" name="user_telephone" value="' . $donnees['user_telephone'] . '" required><br>';
        echo '<input type="date" name="user_date_naissance" value="' . $donnees['user_date_naissance'] . '" required><br>';
        echo '<input type="number" name="user_value" value="' . $donnees['user_value'] . '" min="0" max="1" required><br>';
        echo '<input type="number" name="id_abonnement" value="' . $donnees['id_abonnement'] . '" min="1" max="3" required><br>';
    } elseif ($choix == "film") {
        echo '<input type="int" name="id_film" value="' . $donnees['id_film'] . '" readonly>' . "<br>";
        echo '<input type="text" name="film_city" value="' . $donnees['film_city'] . '" required>' . "<br>";
        echo '<input type="text" name="film_titre" value="' . $donnees['film_titre'] . '" required>' . "<br>";
        echo '<input type="text" name="film_description" value="' . $donnees['film_description'] . '" required>' . "<br>";
        echo '<input type="text" name="film_realisateur" value="' . $donnees['film_realisateur'] . '" required>' . "<br>";
        echo '<input type="text" name="film_cover_image" value="' . $donnees['film_cover_image'] . '" required>' . "<br>";
        echo '<input type="text" name="film_back_image" value="' . $donnees['film_back_image'] . '" required>' . "<br>";
        echo '<input type="text" name="film_trailer" value="' . $donnees['film_trailer'] . '" required>' . "<br>";
        echo '<input type="int" name="film_duree" value="' . $donnees['film_duree'] . '" required>' . "<br>";
        echo '<input type="text" name="film_date" value="' . $donnees['film_date'] . '" required>' . "<br>";
        echo '<input type="float" name="film_popularity" value="' . $donnees['film_popularity'] . '" required>' . "<br>";
        echo '<input type="int" name="film_value" value="' . $donnees['film_value'] . '"  min="0" max="1" required>' . "<br>";
    } elseif ($choix == "genre") {
        echo '<input type="text" name="id_genre" value="' . $donnees['id_genre'] . '" readonly>' . "<br>";
        echo '<input type="text" name="genre" value="' . $donnees['genre'] . '" required>' . "<br>";
    }
    echo "<input type='submit' value='modifier' /><br />";
    echo "</form>";
    if (isset($_POST['user_email'])) {
        $modify = $db->prepare('UPDATE users SET user_nom=?, user_email=?,user_role=?,user_telephone=?,user_date_naissance=?, user_value=?,id_abonnement=? WHERE id_user=?');
        $modify->execute(array(
            $_POST['user_nom'], $_POST['user_email'],
            $_POST['user_role'], $_POST['user_telephone'],
            $_POST['user_date_naissance'], $_POST['user_value'],
            $_POST['id_abonnement'], $_POST['id_user']
        ));
        if ($modify) {
            echo "csqlckjnqmofiqhjofmhqefqef ok mecc";
            var_dump($modify);
        } else {
            echo "not good";
            var_dump($modify);
            die();
        }
    }
}
}


?>

<script src="../assets/js/preloader.js"></script>

</body>

</html>