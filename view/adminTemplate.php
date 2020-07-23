<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?>
    </title>
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
    <!-- tinyMce -->
    <script src="https://cdn.tiny.cloud/1/o6z5nnb6o603pf89s42m1u2j2ezfer3nhwglftavuq2oa6rn/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
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
                        <li><a href="index.php"><img id="tag" src="public/img/tag.png"
                                    alt="Jean Forteroche - image" /></a></li>
                    </ul>
                </nav>
            </div>
            <div id="div_user">
                <nav>
                    <ul class="second_nav_hover">
                        <li><?php echo '<img class="avatar_dashboard" src="public/img/' . $this->user['avatar_user'] .'"/>'?>
                        </li>
                        <li class="li_dash">
                            <?php echo ' ' . mb_strtoupper($this->user['pseudo_user']) . ' <i class="fas fa-chevron-down"></i>';?>
                            <ul class="second_ul">
                                <li class="first_li"><a href="index.php?action=updateProfil">PROFIL</a></li>
                                <li><a href="index.php?action=logout">DÉCONNECTION</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div id="div_dashboard">
        <div id="block_sidebar">
            <p id="home_sidebar"><a href="index.php"><i class="fas fa-home"></i><br /><br />
                    MON SITE</a></p>
            <p><a href="index.php?action=adminReportedComments"><i class="fas fa-tachometer-alt"></i><br /><br />
                    TABLEAU DE BORD</a></p>
            <p><a href="index.php?action=adminListPosts"><i class="fas fa-book-open"></i><br /><br />
                    LES CHAPITRES</a></p>
        </div>

        <!-- Bannière -->
        <div id="banner_dashboard">
            <img id="banner_img" src="public/img/adminbanner.png" />
            <h1 id="special_banner_h1">Bienvenue, <br /><span><?= mb_strtoupper($this->user['pseudo_user']) ?></span>
                !
            </h1>

            <!-- sections -->
            <?= $content ?>
        </div>
    </div>

    <!-- Flèche scroll-top -->
    <p id="arrow"><a href="#"><i class="fas fa-arrow-up"></i></a></p>
    <!-- FOOTER -->
    <footer>
        <p><a href="index.php?action=mentions">MENTIONS LÉGALES</a></p>
        <p> © COPYRIGHT 2020 - CLARA MORVAN</p>
        <p><a href="index.php?action=privacyPolicy">POLITIQUE DE CONFIDENTIALITÉ</a></p>
    </footer>

    <!-- JS -->
    <script>
        tinymce.init({
            selector: '.textarea_tiny',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });
    </script>
    <script src="public/js/all_js.js"></script>
</body>

</html>