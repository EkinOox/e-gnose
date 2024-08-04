<?php session_start();
require_once("../controller/singleton_connexion.php");
require_once('../controller/ControllerConnexion.php');
?>
<!doctype html>
<html lang="fr">

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
    <link href="../assets/css/authentification.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body class="unselectable">

<div id="preloader">
    <?php include_once('../controller/preloader.php'); ?>
</div>


<?php
include_once('../_navbar/navbar.php');
?>


<div class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    <h6 class="mb-0 pb-3"><span>Connexion</span><span class="separator">|</span><span>Inscription</span>
                    </h6>
                    <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                    <label for="reg-log"></label>
                    <div class="card-3d-wrap mx-auto">
                        <div class="card-3d-wrapper">
                            <div class="card-front">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-4 pb-3">Connexion</h4>
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <input type="email" name="user_email" class="form-style"
                                                       placeholder="Adresse mail" id="user_email" autocomplete="off"
                                                       required>
                                                <i class="input-icon uil uil-at"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="user_password" class="form-style"
                                                       placeholder="Mot de passe" id="user_password" autocomplete="off"
                                                       required>
                                                <i class="input-icon uil uil-lock-alt"></i>
                                            </div>
                                            <div>
                                                <input type="submit" name="connexion" value="CONNEXION"
                                                       class="btn mt-4">
                                            </div>
                                        </form>
                                        <p class="mb-0 mt-4 text-center"><a href="forgot-password.php" class="link">Mot
                                                de passe
                                                oublié ?</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-back">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-4 pb-3">Inscription</h4>
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <input type='text' name="user_nom" id="user_nom" class="form-style"
                                                       placeholder="Nom d'utilisateur" autocomplete="off" required
                                                       maxlength="30">
                                                <i class="input-icon uil uil-user"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="email" name="user_email" id="user_email" class="form-style"
                                                       placeholder="Adresse mail" autocomplete="off" required
                                                       maxlength="60">
                                                <i class="input-icon uil uil-at"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type='text' name="user_telephone" id="user_telephone"
                                                       class="form-style" placeholder="Téléphone" autocomplete="off"
                                                       required maxlength="15">
                                                <i class="input-icon uil-phone"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="text" name="user_date_naissance" id="user_date_naissance"
                                                       class="form-style" placeholder="Date de naissance"
                                                       onfocus="(this.type='date')" onblur="(this.type='text')"
                                                       autocomplete="off" required>
                                                <i class="input-icon uil uil-calender"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="user_password" id="user_password"
                                                       class="form-style" placeholder="Mot de passe" autocomplete="off"
                                                       required>
                                                <i class="input-icon uil uil-lock-alt"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="user_password_2" id="user_password_2"
                                                       class="form-style" placeholder="Confirmer le mot de passe"
                                                       autocomplete="off" required>
                                                <i class="input-icon uil uil-lock-alt"></i>
                                            </div>
                                            <input type="submit" name="inscription" value="S'inscrire" class="btn mt-4">
                                        </form>
                                        <?php
                                        require_once('../controller/ControllerInscription.php');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/preloader.js"></script>


</body>

</html>