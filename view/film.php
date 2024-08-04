<?php
session_start();
require_once('../controller/singleton_connexion.php');
require_once('../controller/administration.php');

?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Films, livres, audio... Toute une bibliothÃ¨que pour vous divertir, oÃ» que vous soyez, en illimité !" />
    <meta name="robots" content="index, follow" />
    <meta property="og:title" content="Les films | e-Gnose" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="../assets/img/favicon.png" />
    <meta property="og:url" content="../view/film.php" />
    <meta property="og:description" content="Films, livres, audios... Toute une bibliothÃ¨que pour vous divertir, oÃ» que vous soyez, en illimité !" />
    <meta property="og:locale" content="fr_FR" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Les films | e-Gnose" />
    <meta name="twitter:description" content="Films, livres, audios... Toute une bibliothÃ¨que pour vous divertir, oÃ» que vous soyez, en illimité !" />
    <meta name="twitter:image" content="../assets/img/favicon.png" />
    <title>Les films | e-Gnose</title>

    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">

    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.usebootstrap.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../assets/css/home.css" rel="stylesheet" type="text/css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d51f8b0cc0.js" crossorigin="anonymous" defer></script>
    <script src="../assets/js/showMovie.js" defer></script>

</head>

<body class="unselectable">

    <?php
    include_once('../_navbar/navbar.php');
    ?>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Titres les plus récents disponible</h3>
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
                <h3>Les Films les plus court</h3>
            </div>
            <div id="carousel2">
                <?php
                $administration->SelectFilmByCourt();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Les films d'action</h3>
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
                <h3>Les films d'Aventure</h3>
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
                <h3>Les Films de Science-Fiction</h3>
            </div>
            <div id="carousel5">
                <?php
                $administration->SelectFilmBySF();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Les Films d'Horreur</h3>
            </div>
            <div id="carousel6">
                <?php
                $administration->SelectFilmByHorror();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Les Films Fantastiques</h3>
            </div>
            <div id="carousel7">
                <?php
                $administration->SelectFilmByFantastique();
                ?>
            </div>
        </div>
    </section>

    <section id="carousel-content">
        <div class="container">

            <div class="title">
                <h3>Les Films les plus Longs</h3>
            </div>
            <div id="carousel8">
                <?php
                $administration->SelectFilmByLong();
                ?>
            </div>
        </div>
    </section>
    


    <?php
    include_once('../_footer/footer.php');
    ?>

    <script src="https://cdn.usebootstrap.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="../assets/js/carousel.js" async></script>

</body>

</html>