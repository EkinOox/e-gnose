<?php
session_start();
require_once('../controller/singleton_connexion.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    header('Location: ../view/authentification.php');
    exit;
}
if (isset($_POST["id_film"])) {

    $id_film = $_POST["id_film"];
    
    // Suppression de la wishlist de la base de données
    $delete = $db->prepare('DELETE FROM wishlist WHERE id_user = ? AND id_film = ?');
    $delete->execute([$_SESSION['id_user'], $id_film]);
    if ($delete) {
        header("Location: ../view/wishlist.php");
        exit;
    }
}elseif(isset($_POST["id_serie"])){
    $id_serie = $_POST["id_serie"];
    
    // Suppression de la wishlist de la base de données
    $delete2 = $db->prepare('DELETE FROM wishlist WHERE id_user = ? AND id_serie = ?');
    $delete2->execute([$_SESSION['id_user'], $id_serie]);
    if ($delete2) {
        header("Location: ../view/wishlist.php");
        exit;
    }
}elseif(isset($_POST["id_livre"])){
    $id_livre = $_POST["id_livre"];
    
    // Suppression de la wishlist de la base de données
    $delete3 = $db->prepare('DELETE FROM wishlist WHERE id_user = ? AND id_livre = ?');
    $delete3->execute([$_SESSION['id_user'], $id_livre]);
    if ($delete3) {
        header("Location: ../view/wishlist.php");
        exit;
    }
}

global $db;
// Récupérer la wishlist de l'utilisateur
$id_user = $_SESSION['id_user'];

$query = "SELECT wishlist.id_wishlist, wishlist.id_film, wishlist.created_at, films.id_film, films.film_titre, films.film_cover_image
 FROM users, wishlist, films
 WHERE users.id_user = wishlist.id_user
 AND wishlist.id_film = films.id_film
 AND films.id_film != 0
 AND users.id_user = ?";
 
$query2 = "SELECT wishlist.id_wishlist, wishlist.id_serie, wishlist.created_at, series.id_serie, series.serie_titre, series.serie_cover_image
FROM users, wishlist, series
WHERE users.id_user = wishlist.id_user
AND wishlist.id_serie = series.id_serie
AND series.id_serie != 0
AND users.id_user = ?";

$query3 = "SELECT wishlist.id_wishlist, wishlist.id_livre, wishlist.created_at, livres.id_livre, livres.livre_titre, livres.livre_cover_image
FROM users, wishlist, livres
WHERE users.id_user = wishlist.id_user
AND wishlist.id_livre = livres.id_livre
AND livres.id_livre != 0
AND users.id_user = ?";

$result = $db->prepare($query);
$result->bindValue(1, $id_user, PDO::PARAM_INT);
$result->execute();
if (!$result) {
    $error = $result->errorInfo();
    die("Erreur : " . $error[2]);
}

$result2 = $db->prepare($query2);
$result2->bindValue(1, $id_user, PDO::PARAM_INT);
$result2->execute();
if (!$result2) {
    $error = $result2->errorInfo();
    die("Erreur : " . $error[2]);
}

$result3 = $db->prepare($query3);
$result3->bindValue(1, $id_user, PDO::PARAM_INT);
$result3->execute();
if (!$result3) {
    $error = $result3->errorInfo();
    die("Erreur : " . $error[2]);
}

// Afficher la liste des films dans la wishlist
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description"
          content="Films, livres, audios … Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="robots" content="index, follow"/>
    <meta property="og:title" content="Ma wishlist | e-Gnose"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="../assets/img/favicon.png"/>
    <meta property="og:url" content="../view/wishlist.php"/>
    <meta property="og:description"
          content="Films, livres, audios … Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="Ma wishlist | e-Gnose"/>
    <meta name="twitter:description"
          content="Films, livres, audios … Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="twitter:image" content="../assets/img/favicon.png"/>
    <title>Ma wishlist | e-Gnose</title>

    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">

    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.usebootstrap.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../assets/css/wishlist.css" rel="stylesheet" type="text/css" media="screen">
    <script src="../assets/js/showMovie.js" defer></script>
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
            <h1>Ma wishlist pour les films</h1>
        </div>

        <div class="user_infos--container">
            <?php if ($result->rowCount() == 0) : ?>
                <h2 class="text-center">Votre wishlist est vide</h2>
                <input class="subscribe__btn" type="button" onclick="history.back(-1)" value="Retourner en arrière" />
            <?php else : ?>
            <div class="films">
                <?php $count = 0; ?>
                <?php while ($row = $result->fetch()) : ?>
                    <?php if ($count % 4 == 0) : ?>
                        <div class="ligne">
                    <?php endif; ?>
                    <div class="film">
                        <a href="../view/content.php?id=<?php echo $row['id_film'] ?>"><img src="<?php echo $row['film_cover_image']; ?>" alt="<?php echo $row['film_titre']; ?>" title="Voir <?php echo $row['film_titre']; ?>."></a>
                        <p><?php echo $row['film_titre']; ?></p>
                        <form id="wishlist-form" method="POST" action="">
                            <input type="hidden" name="id_film" value="<?php echo $row['id_film']; ?>">
                            <button class="delete-btn" title="Supprimer de la wishlist." type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <?php if (($count + 1) % 4 == 0) : ?>
                        </div>
                    <?php endif; ?>
                    <?php $count++; ?>
                <?php endwhile; ?>
                <?php if ($count % 4 != 0) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<section>
    <div class="container">

        <div class="title">
            <h1>Ma wishlist pour les séries</h1>
        </div>

        <div class="user_infos--container">
            <?php if ($result2->rowCount() == 0) : ?>
                <h2 class="text-center">Votre wishlist est vide</h2>
                <input class="subscribe__btn" type="button" onclick="history.back(-1)" value="Retourner en arrière" />
            <?php else : ?>
            <div class="films">
                <?php $count = 0; ?>
                <?php while ($row2 = $result2->fetch()) : ?>
                    <?php if ($count % 4 == 0) : ?>
                        <div class="ligne">
                    <?php endif; ?>
                    <div class="film">
                        <a href="../view/content_serie.php?id=<?php echo $row2['id_serie'] ?>"><img src="<?php echo $row2['serie_cover_image']; ?>" alt="<?php echo $row2['serie_titre']; ?>" title="Voir <?php echo $row2['serie_titre']; ?>."></a>
                        <p><?php echo $row2['serie_titre']; ?></p>
                        <form id="wishlist-form" method="POST" action="">
                            <input type="hidden" name="id_serie" value="<?php echo $row2['id_serie']; ?>">
                            <button class="delete-btn" title="Supprimer de la wishlist." type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <?php if (($count + 1) % 4 == 0) : ?>
                        </div>
                    <?php endif; ?>
                    <?php $count++; ?>
                <?php endwhile; ?>
                <?php if ($count % 4 != 0) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<section>
    <div class="container">

        <div class="title">
            <h1>Ma wishlist pour les livres</h1>
        </div>

        <div class="user_infos--container">
            <?php if ($result3->rowCount() == 0) : ?>
                <h2 class="text-center">Votre wishlist est vide</h2>
                <input class="subscribe__btn" type="button" onclick="history.back(-1)" value="Retourner en arrière" />
            <?php else : ?>
            <div class="films">
                <?php $count = 0; ?>
                <?php while ($row3 = $result3->fetch()) : ?>
                    <?php if ($count % 4 == 0) : ?>
                        <div class="ligne">
                    <?php endif; ?>
                    <div class="film">
                        <a href="../view/content_livre.php?id=<?php echo $row3['id_livre'] ?>"><img src="<?php echo $row3['livre_cover_image']; ?>" alt="<?php echo $row3['livre_titre']; ?>" title="Voir <?php echo $row3['livre_titre']; ?>."></a>
                        <p><?php echo $row3['livre_titre']; ?></p>
                        <form id="wishlist-form" method="POST" action="">
                            <input type="hidden" name="id_livre" value="<?php echo $row3['id_livre']; ?>">
                            <button class="delete-btn" title="Supprimer de la wishlist." type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <?php if (($count + 1) % 4 == 0) : ?>
                        </div>
                    <?php endif; ?>
                    <?php $count++; ?>
                <?php endwhile; ?>
                <?php if ($count % 4 != 0) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php
include_once('../_footer/footer.php');
?>

<script src="../assets/js/preloader.js"></script>
<script src="https://cdn.usebootstrap.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>

</html>