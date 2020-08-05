<?php
// Titre site
$title = 'Jean Forteroche - Accueil';
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- Bannière -->
<div id="banner">
    <div id="text_banner">
        <h1>BILLET SIMPLE POUR L'ALASKA</h1>
        <h2>DÉCOUVREZ LE ROMAN EN LIGNE</h2>
        <p><a href="#recent_tag"><i class="fas fa-chevron-circle-down"></i></a></p>
    </div>
    <img src="public/img/banner.png" alt="Bannière montagnes Alaska - Jean Forteroche" />
</div>

<div class="content">

    <!-- Article récent -->
    <div>
        <div id="recent_tag">
            À la une
        </div>
        <div id="triangle"></div>
    </div>

    <div id="block_recent_post">
        <div id="img_recent_post">
            <img src="public/img/<?= htmlspecialchars($recentPost['image_chapter']) ?>"
                alt="Image - Billet simple pour l'Alaska - Jean Forteroche" />
        </div>
        <div id="para_recent_post">
            <div id="elts_recent_post">
                <p id="novel_recent_post"><?= mb_strtoupper(htmlspecialchars($recentPost['novel_chapter'])) ?>
                </p>
                <p><span class="red"><i class="far fa-calendar-alt"></i></span>
                    <?php
                    $date = $this->dateTimeUsToDateFr(htmlspecialchars($recentPost['date_chapter']));
                    echo $date;
               ?>
                </p>
            </div>
            <h2><?= mb_strtoupper(htmlspecialchars($recentPost['title_chapter'])) ?>
            </h2>
            <p>
                <?php
                    $intro = $this->cutContent($recentPost['text_chapter']);
                    echo $intro;
               ?>
            </p>
            <p class="button"><a
                    href="index.php?action=getPost&amp;id=<?= htmlspecialchars($recentPost['id_chapter'])?>">Lire
                    la suite <span><i class=" fas
                    fa-chevron-right"></i><i class="fas fa-chevron-right"></i></span></a>
            </p>
        </div>
    </div>

    <!-- Message d'erreur -->
    <?php
        if (isset($_SESSION['error_recentPost'])) {
            echo '<p class="error"><i class="fas fa-times"></i> ' . $_SESSION['error_recentPost'] . '</p>';
        }
        unset($_SESSION['error_recentPost']);
    ?>

    <div id="intro">
        <div class="separation"></div>
        <h1> Billet simple pour l'Alaska </h1>
        <div class="separation"></div>
        <div id="square">
            <p>
                <i class="fa fa-quote-left"></i> Alice s'endort sur une pelouse, près de sa grande sœur. Elle voit
                un grand lapin blanc qui porte un gilet et une montre à gousset : il est pressé. Elle le suit et
                tombe dans un terrier : la chute dure très longtemps et elle arrive dans une pièce close.

                Ses aventures commencent par une bouteille où il est écrit "buvez-moi" et qui la fait rapetisser, et
                un gâteau où il est écrit "mangez-moi" et qui la fait grandir démesurément. L'enjeu sera d'avoir la
                bonne taille pour franchir la porte du pays des merveilles.

                Mais elle n'y arrive pas et ses larmes trempent une multitude de petits animaux. Elle organise une
                course pour les sécher, discute avec un vers à soie bleu qui fume, rencontre une duchesse qui a une
                tête énorme, prend le thé avec un chapelier fou, un loir et un lièvre de mars.

                Enfin, elle retrouve le jardin qu'elle cherchait au début, joue au croquet avec une reine obsédée
                par la décapitation de ses sujets, récite poèmes et chansons avec un griffon et une tortue et
                termine dans un tribunal où l'on juge un serviteur pour le vol d'un gâteau.
                <i class="fa fa-quote-right"></i>
            </p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
