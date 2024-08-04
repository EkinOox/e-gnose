<?php session_start();
require_once("../controller/singleton_connexion.php");
require_once('../controller/administration.php');
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Films, livres, audios | Toute une bibliothà¨que pour vous divertir, oà¹ que vous soyez, en illimité !"/>
    <meta name="robots" content="index, follow"/>
    <meta property="og:title" content="Espace compte | e-Gnose"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="../assets/img/favicon.png"/>
    <meta property="og:url" content="../view/account-user.php"/>
    <meta property="og:description"
          content="Films, livres, audios | Toute une bibliothà¨que pour vous divertir, oà¹ que vous soyez, en illimité !"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="Espace compte | e-Gnose"/>
    <meta name="twitter:description"
          content="Films, livres, audios | Toute une bibliothà¨que pour vous divertir, oà¹ que vous soyez, en illimité !"/>
    <meta name="twitter:image" content="../assets/img/favicon.png"/>
    <title>Espace compte | e-Gnose</title>

    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.usebootstrap.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../assets/img/favicon.ico" rel="icon">
    <link href="../assets/css/user-account.css" rel="stylesheet" type="text/css" media="screen">
    <link href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css' rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/d51f8b0cc0.js" crossorigin="anonymous" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body class="unselectable">

<div id="preloader">
    <?php include_once('../controller/preloader.php'); ?>
</div>

<?php
include_once('../_navbar/navbar.php');
require_once("../controller/administration.php");

$administration->SelectUserInfo()

?>

<section>

    <div class="main-content">
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
             style="background-image: url(../assets/img/user-bg.webp); background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white">Bonjour, <?= $_SESSION["user_nom"] ?>.</h1>
                        <p class="text-white mt-0 mb-5">Bienvenue sur votre espace compte. Vous pouvez consulter vos
                            données
                            personnelles et les modifier à  tout moment !</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0 card-user">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <img src="../assets/img/user_icon.webp" class="rounded-circle" alt="User-photo">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                        <div>

                                        </div>
                                        <div>

                                        </div>
                                        <div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3>
                                    <?= $donnees['user_prenom'] . " " . $donnees['user_nom']; ?>
                                </h3>
                                <?php
                                if (!empty($donnees['user_city']) || !empty($donnees['user__country'])) {
                                    ?>
                                    <div class="h5 font-weight-300">
                                        <i class="ni location_pin mr-2"></i><?= $donnees['user_city']; ?>
                                        , <?= $donnees['user_country']; ?>
                                    </div>
                                    <?php
                                }
                                if (!empty($donnees['user_desc'])) {
                                    ?>
                                    <div>
                                        <i class="ni education_hat mr-2"></i><strong>«</strong> <?= $donnees['user_desc']; ?>
                                        <strong>»</strong>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div>
                                        Je n'ai pas encore renseigné ma biographie.
                                    </div>
                                    <?php
                                }
                                ?>
                                <hr>
                                <div class="h5 font-weight-300">
                                        <h3>Vous avez un abonnement :<b><i class="ni location_pin mr-2"></i><?= $donnees['type']; ?></b></h3></br>
                                        <i>L'abonnement Freedom correspond à un abonnement basic. Pour changer et passer à l'abonnement supérieur, merci de contacter : admin@gmail.com</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Mon compte</h3>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <!-- On affiche chaque entrée une à Â  une -->
                            <form action="" method="post">
                                <h6 class="heading-small text-muted mb-4">Vos informations personnelles</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email</label>
                                                <?= '<input type="email" id="input-email" class="form-control form-control-alternative" name="user_email" value="' . $donnees['user_email'] . '" required><br>'; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-first-name">Prénom</label>
                                                <input type="text" id="input-first-name"
                                                       class="form-control form-control-alternative" name="user_prenom"
                                                       value="<?= $donnees['user_prenom'] ?>" required
                                                       pattern="[a-zA-Z\-]+"><br>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-last-name">Nom</label>
                                                <input type="text" id="input-last-name"
                                                       class="form-control form-control-alternative" name="user_nom"
                                                       value="<?= $donnees['user_nom'] ?>" required
                                                       pattern="[a-zA-Z\-]+"><br>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-address">Adresse</label>
                                                <input type="text" id="input-address"
                                                       class="form-control form-control-alternative" name="user_address"
                                                       value="<?= $donnees['user_address'] ?>"><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-city">Ville</label>
                                                <input type="text" id="input-city"
                                                       class="form-control form-control-alternative" name="user_city"
                                                       value="<?= $donnees['user_city'] ?>"><br>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-country">Pays</label>
                                                <input type="text" id="input-country"
                                                       class="form-control form-control-alternative" name="user_country"
                                                       value="<?= $donnees['user_country'] ?>" pattern="[A-Za-z\s-]+"
                                                       title="Le nom du pays ne peut contenir que des lettres, des espaces et des tirets."><br>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-postal-code">Code
                                                    Postal</label>
                                                <input type="text" id="input-postal-code"
                                                       class="form-control form-control-alternative" name="user_cp"
                                                       value="<?= $donnees['user_cp'] ?>"><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">


                                <!-- Description -->
                                <h6 class="heading-small text-muted mb-4">à  propos de moi</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group focused">
                                        <label>Biographie</label>
                                        <?= '<textarea rows="4" id="input-bio" name="user_desc" class="form-control form-control-alternative" placeholder="Quelques mots pour vous décrire ...">' . $donnees['user_desc'] . '</textarea><br>'; ?>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <!-- Button HTML (to Trigger Modal) -->
                                    <a href="#modal" data-toggle="modal">Ouvrir popup</a><br>
                                </div>
                                <input class="save--btn" type="submit" value="Sauvegarder"/>


                            </form>
                            <?php $administration->ModifyUserAccount(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once('../_footer/footer.php');
?>

<script src="../assets/js/preloader.js"></script>

</body>

</html>