<?php
// Titre site
$title = 'Jean Forteroche - Accueil';
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- header -->
<?php
require('header.php');
?>

<!-- Bannière -->
<div id="banner">
    <div id="text_banner">
        <h1>BILLET SIMPLE POUR L'ALASKA</h1>
        <h2>DÉCOUVREZ LE ROMAN EN LIGNE</h2>
        <p><a href="#recent_tag"><i class="fas fa-chevron-circle-down"></i></a></p>
    </div>
    <img src="public/img/banner.png" alt="Bannière montagnes Alaska - Jean Forteroche" />
</div>

<div id="intro">
    <div class="separation"></div>
    <h1> Billet simple pour l'Alaska </h1>
    <div class="separation"></div>
    <div id="block_square">
        <div id="square"></div>
        <div id="square2">
            <p>
                <i class="fa fa-quote-left"></i> Un roi souris déclare que la souris capable de faire de la soupe à la
                brochette deviendrait son épouse, la reine.
                La première souricelle rencontre des elfes qui font un arbre
                de mai avec une brochette, puis le décorent, dansent, font de la musique.
                De retour, elle a un petit bâton qui imite les bruits de la cuisine mais aucune soupe…
                La seconde souricelle, née dans une bibliothèque, écoute sa grand-mère lui dire que le poète est fait
                d’intelligence,
                d’imagination et de sentiment.
                Elle part à la rechecherde de ces trois ingrédients et mange des livres.
                Au lieu de faire de la soupe, elle raconte des histoires.
                La quatrième souricelle revient avec la théorie que « la soupe à la brochette » n’était qu’une
                expression utilisée par les hommes.
                La troisième souricelle dit au roi comment faire la fameuse soupe mais qu’il devra la remuer avec sa
                queue et seulement la sienne.
                Le roi acquiesce : c’est la soupe à la brochette mais on la fera plus tard car il ne veut pas se brûler…
                et
                c’est ainsi que la troisième souricelle devint reine.
                <i class="fa fa-quote-right"></i>
            </p>
        </div>
    </div>
</div>




<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
