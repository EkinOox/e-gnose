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
    <meta name="description" content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="robots" content="index, follow"/>
    <meta property="og:title" content="Procédure de récupération du compte | e-Gnose"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <meta property="og:url" content="https://e-gnose.sfait.fr/view/forgot-password.php"/>
    <meta property="og:description" content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta property="og:locale" content="fr_FR"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="Procédure de récupération du compte | e-Gnose"/>
    <meta name="twitter:description" content="Films, livres, audios | Toute une bibliothèque pour vous divertir, où que vous soyez, en illimité !"/>
    <meta name="twitter:image" content="https://e-gnose.sfait.fr/assets/img/favicon.png"/>
    <title>Procédure de récupération du compte | e-Gnose</title>

    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">

    <!-- Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.usebootstrap.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../assets/css/authentification.css" rel="stylesheet" type="text/css" media="screen">
    <link href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css' rel="stylesheet">
</head>

<body class="unselectable">

<?php
include_once('../_navbar/navbar.php');

function generateToken($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[random_int(0, $max)];
    }

    return $token;
}

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération de l'adresse e-mail soumise
    $email = $_POST['email'];

    // Vérification de l'adresse e-mail dans la base de données
    // Ici, vous devrez implémenter votre propre logique pour vérifier si l'adresse e-mail existe dans votre base de données

    // Si l'adresse e-mail existe, générez le token de réinitialisation et enregistrez-le dans la base de données

    // Envoyez l'e-mail contenant le lien de réinitialisation au format HTML
    $token = generateToken(); // Fonction de génération de token
    $resetLink = 'https://example.com/reset-password.php?token=' . $token; // Lien de réinitialisation
    $subject = 'Réinitialisation du mot de passe';
    $message = 'Cliquez sur le lien suivant pour réinitialiser votre mot de passe : <a href="' . $resetLink . '">' . $resetLink . '</a>';
    $headers = 'From: kyllian.diochon.kd@gmail.com' . "\r\n" .
        'Reply-To: noreply@example.com' . "\r\n" .
        'Content-type: text/html; charset=UTF-8' . "\r\n";

    // Envoyer l'e-mail
    mail($email, $subject, $message, $headers);

}
?>

<div class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    <div class="card-3d-wrap mx-auto">
                        <div class="card-front">
                            <div class="center-wrap">
                                <div class="section text-center">
                                    <h4 class="mb-4 pb-3">Procédure de récupération du compte</h4>
                                    <form method="POST" action="">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="email" name="user_email" class="form-style"
                                                   placeholder="Adresse mail" id="user_email" autocomplete="off"
                                                   required>
                                            <i class="input-icon uil uil-at"></i>
                                        </div>
                                        <div>
                                            <input type="submit" name="connexion" value="Suivant" class="btn mt-4">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>