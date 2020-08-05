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

    <!-- Header -->
    <header>
        <div id="header">
            <div id="div_pages">
                <nav>
                    <ul>
                        <li><a href="index.php"><img id="tag" src="public/img/tag.png" alt="Logo Jean Forteroche" /></a>
                        </li>
                        <li><a href="index.php"><i class="fas
                                fa-grip-lines-vertical"></i> ACCUEIL</a></li>
                        <li><a href="index.php?action=author"><i class="fas
                                fa-grip-lines-vertical"></i> L' AUTEUR</a>
                        </li>
                        <li><a href="index.php?action=listPosts"><i class="fas
                                fa-grip-lines-vertical"></i> LES
                                CHAPITRES</a></li>
                    </ul>
                </nav>
            </div>
            <div id="div_user">
                <nav>
                    <ul class="second_nav_hover">
                        <li>
                            <?php
                        if ($this->isLogged()) {
                            echo '<span class="connected">BONJOUR' . ' <span class="red2">' . mb_strtoupper($this->user['pseudo_user']) . '</span> ! </span>' ?>
                            <?php
                        if ($this->isLogged()) { ?>
                            <span class="mobile_connected"><i class="fas fa-user"></i></span>
                            <?php
                        } else {
                            ?>
                            <i class="fas fa-user"></i>
                            <?php
                        } ?>
                            <ul class="second_ul">
                                <?php if ($this->isAdmin()) { ?>
                                <li class="first_li"><a href="index.php?action=adminReportedComments">TABLEAU DE
                                        BORD</a>
                                </li>
                                <li><a href="index.php?action=updateProfil">PROFIL</a></li>
                                <li><a href="index.php?action=logout">DÉCONNECTION</a></li>
                                <?php } else { ?>
                                <li class="first_li"><a href="index.php?action=updateProfil">PROFIL</a></li>
                                <li><a href="index.php?action=logout">DÉCONNECTION</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php
                        } else { ?>
                        <li>
                            <i class="fas fa-user"></i>
                            <ul class="second_ul">
                                <li class="first_li"><a href="index.php?action=connection">CONNEXION</a></li>
                                <li><a href="index.php?action=register">INSCRIPTION</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
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