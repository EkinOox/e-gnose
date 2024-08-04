<?php
session_start();
if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role'] == 1){
        // l'utilisateur a un rôle d'administrateur
    } else if($_SESSION['user_role'] == 3){
        // l'utilisateur a un rôle de modérateur
        header('location: ./index.php');
        exit;
    } else {
        // l'utilisateur a un rôle indéfini
        header('location: ./view/error/403.php');
        exit;
    }
} else {
    // la variable de session n'est pas initialisée
    header('location: ./view/error/403.php');
    exit;
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Films, livres, audios … Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !" />
    <meta name="robots" content="index, follow" />
    <meta property="og:title" content="Espace administration | e-Gnose" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="../assets/img/favicon.ico" />
    <meta property="og:url" content="../index-admin.php" />
    <meta property="og:description" content="Films, livres, audios … Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !" />
    <meta property="og:locale" content="fr_FR" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Espace administration | e-Gnose" />
    <meta name="twitter:description" content="Films, livres, audios … Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !" />
    <meta name="twitter:image" content="../assets/img/favicon.png" />
    <title>Espace administration | e-Gnose</title>

    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.usebootstrap.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css' rel="stylesheet">
    <link href="assets/css/administration.css" rel="stylesheet" type="text/css" media="screen">
    <script src="https://kit.fontawesome.com/d51f8b0cc0.js" crossorigin="anonymous" defer></script>
    <script src="../assets/js/showMovie.js" defer></script>
</head>

<body>

<?php
include_once('_navbar/navbar.php');
?>

<section class="services">
    <div class="container">

        <div class="title">
            <h1>Que souhaitez-vous administrer ?</h1>
        </div>
        <div class="title">
            <h3>Administrer des membres.</h3>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <a href="./view/modify-user.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-user-pen"></i></div>
                        <h4>Modifier un utilisateur</h4>
                        <p>Gérer les informations d'un compte déjà inscrit dans la base de données.</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                <a href="./view/delete-user.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-user-xmark"></i></div>
                        <h4>Supprimer un utilisateur</h4>
                        <p>Supprimer définitivement un compte déjà inscrit dans la base de données.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="container services">
        <div class="title">
            <h3>Administrer un film.</h3>
        </div>

        <div class="row">
            <!-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <a href="./view/insert-film.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-plus"></i></div>
                        <h4>Ajouter un média</h4>
                        <p>Ajouter un nouveau contenu média dans la base de données.</p>
                    </div>
                </a>
            </div> -->

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                <a href="./view/modify-film.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-pen"></i></div>
                        <h4>Modifier un média</h4>
                        <p>Modifier les informations d'un contenu média déjà inscrit dans la base de données.</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                <a href="./view/delete-film.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-trash"></i></div>
                        <h4>Supprimer un média</h4>
                        <p>Supprimer définitivement un contenu média existant de la base de données.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container services">
        <div class="title">
            <h3>Administrer une serie.</h3>
        </div>

        <div class="row">
            <!-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <a href="./view/insert-serie.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-plus"></i></div>
                        <h4>Ajouter une serie</h4>
                        <p>Ajouter un nouveau contenu serie dans la base de données.</p>
                    </div>
                </a>
            </div> -->

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                <a href="./view/modify-serie.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-pen"></i></div>
                        <h4>Modifier une serie</h4>
                        <p>Modifier les informations d'une serie média déjà inscrit dans la base de données.</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                <a href="./view/delete-serie.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-trash"></i></div>
                        <h4>Supprimer une serie</h4>
                        <p>Supprimer définitivement un contenu serie existant de la base de données.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container services">
        <div class="title">
            <h3>Administrer un livre.</h3>
        </div>

        <div class="row">
            <!-- <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <a href="./view/insert-livre.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-plus"></i></div>
                        <h4>Ajouter un livre</h4>
                        <p>Ajouter un nouveau contenu livre dans la base de données.</p>
                    </div>
                </a>
            </div> -->

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                <a href="./view/modify-livre.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-pen"></i></div>
                        <h4>Modifier un livre</h4>
                        <p>Modifier les informations d'un contenu livre déjà inscrit dans la base de données.</p>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                <a href="./view/delete-livre.php">
                    <div class="icon-box">
                        <div class="icon"><i style="width: 80%" class="fa-solid fa-trash"></i></div>
                        <h4>Supprimer un livre</h4>
                        <p>Supprimer définitivement un contenu livre existant de la base de données.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
include_once('_footer/footer.php');
?>

</body>

</html>