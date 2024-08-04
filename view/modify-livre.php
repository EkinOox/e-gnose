<?php
session_start();
require_once("../controller/singleton_connexion.php");
require_once("../controller/administration.php");

if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role'] == 1){
        // l'utilisateur a un rôle d'administrateur
    } else if($_SESSION['user_role'] == 3){
        // l'utilisateur a un rôle de modérateur
        header('location: ../index.php');
        exit;
    } else {
        // l'utilisateur a un rôle indéfini
        header('location: ../view/error/403.php');
        exit;
    }
} else {
    // la variable de session n'est pas initialisée
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
    <meta property="og:title" content="Modifier un média | e-Gnose"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <meta property="og:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="Modifier un média | e-Gnose"/>
    <meta name="twitter:description"
          content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="twitter:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <title>Modifier un média | e-Gnose</title>

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
            <h1>Modifier un média</h1>
        </div>

        <div class="user_infos--container">
            <p>Sélectionnez le média à modifier :</p>
            <form action="" method='post'>

                <?php
                // On r�cup�re tout le contenu de la table clients
                global $db; ?>
                <select id="id" name="id">
                    <option disabled selected> Sélectionner un média</option>
                    <?php
                    $stmt = $db->query("SELECT id_livre, livre_titre FROM livres");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo '<option value="' . $row['id_livre'] . '">' . $row['id_livre'] . ' - ' . $row['livre_titre'] . '</option>';
                    }
                    ?>
                </select>


                <input class="subscribe__btn" type="submit" value="Valider"/>
            </form>

            <?php
            if (isset($_POST['id'])) {
                $req = $db->prepare("SELECT * FROM livres WHERE id_livre = ?");
                $req->bindParam(1, $_POST['id'], PDO::PARAM_INT);
                $req->execute();
                $donnees = $req->fetch(PDO::FETCH_ASSOC);
                echo "Vous êtes en train de modifier le média : " . $donnees['livre_titre'] . ' [ID: ' . $_POST['id'] . ']' . "<br>";
                echo '<form action="" method="post">';
                // On affiche chaque entr�e une � une

                echo '<div class="form-group">

                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_livre" value="' . $donnees['id_livre'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_titre">Titre</label>
                    <input type="text" class="form-control" name="livre_titre" value="' . $donnees['livre_titre'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_editeur">livre editeur</label>
                    <input type="text" class="form-control" name="livre_editeur" value="' . $donnees['livre_editeur'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_auteur">livre auteur</label>
                    <input type="text" class="form-control" name="livre_auteur" value="' . $donnees['livre_auteur'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_date_publication">livre Date Publication</label>
                    <input type="text" class="form-control" name="livre_date_publication" value="' . $donnees['livre_date_publication'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_description">Description</label>
                    <input type="text" class="form-control" name="livre_description" value="' . $donnees['livre_description'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_nombre_page">Pages</label>
                    <input type="text" class="form-control" name="livre_nombre_page" value="' . $donnees['livre_nombre_page'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_cover_image">Image de couverture</label>
                    <input type="text" class="form-control" name="livre_cover_image" value="' . $donnees['livre_cover_image'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_popularity">Popularité</label>
                    <input type="number" step="0.1" class="form-control" name="livre_popularity" value="' . $donnees['livre_popularity'] . '" required>
                </div>
                
                <div class="form-group">
                <label for="livre_value">Valeur</label>
                    <input type="number" class="form-control" name="livre_value" value="' . $donnees['livre_value'] . '" min="0" max="1" required>
                </div>';

                echo '<input class="subscribe__btn" type="submit" value="Modifier">';
                echo "</form>";
            }
            $administration->ModifyLivre();
            ?>
        </div>
    </div>
</section>

<?php
include_once('../_footer/footer.php');
?>

</body>

</html>