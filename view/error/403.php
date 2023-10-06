<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Erreur 403 | e-Gnose</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d51f8b0cc0.js" crossorigin="anonymous" defer></script>

    <!-- Favicons -->
    <link href="../../assets/img/favicon.ico" rel="icon">

    <style>
        @import "../../assets/css/navbar.css";
        @import "../../assets/css/footer.css";
        @import "../../assets/css/scrollbar.css";

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Kanit', sans-serif;
            background: linear-gradient(120deg, #071e53, #15c0ed) 50% no-repeat;
        }

        h1 {
            margin: 40px 0 20px;
            color: #bd9e5a;
            filter: brightness(1.10);
            font-weight: 900;
        }

        .lock {
            position: relative;
            border-radius: 5px;
            width: 55px;
            height: 45px;
            background-color: #15c0ed;
            animation: dip 1s;
            animation-delay: 1.5s;
        }

        .lock::before, .lock::after {
            content: "";
            position: absolute;
            border-left: 5px solid #15c0ed;

            height: 20px;
            width: 15px;
            left: calc(50% - 12.5px);
        }

        .lock::before {
            top: -30px;
            border: 5px solid #15c0ed;
            border-bottom-color: transparent;
            border-radius: 15px 15px 0 0;
            height: 30px;
            animation: lock 2s, spin 2s;
        }

        .lock::after {
            top: -10px;
            border-right: 5px solid transparent;
            animation: spin 2s;
        }

        @keyframes lock {
            0% {
                top: -45px;
            }
            65% {
                top: -45px;
            }
            100% {
                top: -30px;
            }
        }

        @keyframes spin {
            0% {
                transform: scaleX(-1);
                left: calc(50% - 30px);
            }
            65% {
                transform: scaleX(1);
                left: calc(50% - 12.5px);
            }
        }

        @keyframes dip {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(10px);
            }
            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>
<body>

<?php
include_once('../../_navbar/navbar.php');
?>

<div class="lock"></div>
<div class="message">
    <h1 style="text-align: center">L'accès à cette page vous est interdit !</h1>
    <p style="text-align: center;color: #fff">Veuillez vérifier auprès du webmaster du site si vous pensez qu'il s'agit d'une erreur.</p>
</div>

</body>
</html>
