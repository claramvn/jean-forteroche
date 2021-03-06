<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?>
    </title>
    <!-- Mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="icon" type="image/png" href="public/img/littleLogo.png" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Police Google Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <!-- Police Google Roboto Mono Light -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <!-- Police Google Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link href="public/css/style.css" rel="stylesheet" />
</head>


<body>

    <!-- header -->
    <header>
        <div id="header_admin">
            <div>
                <a href="index.php"><img src="public/img/loginLogo.png" alt="Logo Jean Forteroche" /></a>
            </div>
            <div>
                <nav>
                    <ul>
                        <li id="<?= $admin_li1 ?>"><a
                                href="index.php?action=register">CRÉER
                                UN COMPTE</a>
                        </li>
                        <li id="<?= $admin_li2 ?>"><a
                                href="index.php?action=connection">SE
                                CONNECTER</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- sections -->
    <?= $content ?>

    <!-- Flèche scroll-top -->
    <p id="arrow"><a href="#"><i class="fas fa-arrow-up"></i></a></p>
    <!-- FOOTER -->
    <footer>
        <p><a href="index.php?action=legalsMentions">MENTIONS LÉGALES</a></p>
        <p> © COPYRIGHT 2020 - CLARA MORVAN</p>
        <p><a href="index.php?action=privacyPolicy">POLITIQUE DE CONFIDENTIALITÉ</a></p>
    </footer>

    <script src="public/js/all_js.js"></script>
</body>

</html>