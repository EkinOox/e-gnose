<?php
session_start();
require_once('./controller/singleton_connexion.php');
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Films, livres, audio... Toute une bibliothèque pour vous divertir, oû que vous soyez, en illimité !" />
    <meta name="robots" content="index, follow" />
    <meta property="og:title" content="Accueil | e-Gnose" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="./assets/img/favicon.png" />
    <meta property="og:description" content="Films, livres, audios... Toute une bibliothèque pour vous divertir, oû que vous soyez, en illimité !" />
    <meta property="og:locale" content="fr_FR" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Accueil | e-Gnose" />
    <meta name="twitter:description" content="Films, livres, audios... Toute une bibliothèque pour vous divertir, oû que vous soyez, en illimité !" />
    <meta name="twitter:image" content="./assets/img/favicon.png" />
    <title>Accueil | e-Gnose</title>

    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="./assets/css/home.css" rel="stylesheet" type="text/css" media="screen">

</head>

<body class="unselectable">

    <div id="preloader">
        <?php include_once('./controller/preloader.php'); ?>
    </div>

    <?php
    require_once("./controller/administration.php");
    require_once("./model/films_model.php");
    include_once('./_navbar/navbar.php');
    ?>

    <div id="carouselExampleIndicators" class="carousel slide my-carousel" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active" style="background-image: url('assets/img/posters/the-last-of-us.png')">

            </div>
            <div class="carousel-item" style="background-image: url('assets/img/posters/coeurs-noirs.jpg')">

            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Suivant</span>
        </a>
    </div>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Titres les plus récents</h3>
            </div>
            <div id="carousel0">
                <?php
                $administration->SelectFilmByDateAsc();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Les mieux notés</h3>
            </div>
            <div id="carousel1">
                <?php
                $administration->SelectFilmByPop();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Films tournés en France</h3>
            </div>
            <div id="carousel2">
                <?php
                $administration->SelectFilmByFr();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Films d'action</h3>
            </div>
            <div id="carousel3">
                <?php
                $administration->SelectFilmByAction();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Films d'aventure</h3>
            </div>
            <div id="carousel4">
                <?php
                $administration->SelectFilmByAventure();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Films de science-fiction</h3>
            </div>
            <div id="carousel6">
                <?php
                $administration->SelectFilmBySF();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Films d'horreur</h3>
            </div>
            <div id="carousel7">
                <?php
                $administration->SelectFilmByHorror();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Films fantastiques</h3>
            </div>
            <div id="carousel8">
                <?php
                $administration->SelectFilmByFantastique();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Films les plus longs</h3>
            </div>
            <div id="carousel9">
                <?php
                $administration->SelectFilmByLong();
                ?>
            </div>
        </div>
    </section>

    <!-- <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Les Films les plus Courts</h3>
            </div>
            <div id="carousel5">
                <?php
                $administration->SelectFilmByCourt();
                ?>
            </div>
        </div>
    </section> -->
    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Series</h3>
            </div>
            <div id="carousel5">
                <?php
                $administration->SelectSerieByPop();
                ?>
            </div>
        </div>
    </section>

    <?php if (!isset($_SESSION['id_user'])) {

    ?>
        <div class="cta--subscribe">
            <h2>Retrouvez vos contenus préférés où vous voulez, quand vous voulez, en illimité sur <span>e</span>-Gnose.</h2>
            <a class="subscribe__btn" href="./view/authentification.php">Je m'abonne !</a>
        </div>
    <?php } ?>

    <?php
    include_once('_footer/footer.php');
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d51f8b0cc0.js" crossorigin="anonymous"></script>
    <script src="./assets/js/showMovie.js"></script>
    <script src="./assets/js/preloader.js"></script>
    <script src="./assets/js/carousel.js"></script>
    <script src="https://cdn.usebootstrap.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>



</body>

</html>