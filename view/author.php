<?php
//Titre site
$title = 'Jean Forteroche - L\'auteur';
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- Bannière -->
<?php
require('banner.php');
?>

<div class="content">

    <!-- Retour accueil -->
    <div class="links">
        <a href="index.php">Accueil</a>
        <span class="red">
            <i class=" fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i>
        </span> L'auteur
    </div>

    <!-- auteur -->
    <div id="block_author">
        <div id="img_author">
            <img src="public/img/JF.jpg" alt="Auteur Jean Forteroche" />
        </div>
        <div id="text_author">
            <h1>JEAN FORTEROCHE
            </h1>
            <p>« Il est sur que Jean Forteroche est sûrement un très grand auteur de ce monde » c'est ce qu'a affirmé C.
                Lewis junior mardi dernier à un parterre de journalistes rassemblés à Nantes pour le
                rencontrer.<br /><br />

                Cette déclaration de C. Lewis junior nous pousse à revenir sur la carrière de Jean Forteroche. Né en
                12/04/1980, il n'a eu de cesse depuis d'épater la galerie par ces incessants apports dans le monde de la
                culture, en particulier au sein de la « confédération des auteurs de Nantes et de
                Navarre » puissante association créée par Pinocchio.<br /><br />

                Jean Forteroche a entamé son chemin vers la gloire suite à la publication du roman « Les clefs », qui
                consacre sa rencontre avec le public.<br /><br />

                C'est par un beau jour de novembre, durant un voyage en Alaska qu'il croise le chemin de Joséphine.
                C'est elle qui lui inspirera plusieurs de ses romans. Elle dira plus tard « J'ai claqué des doigts et
                l'inspiration lui est venue ! ».<br /><br />

                Pour Jean Forteroche c'est une révélation, il s'attelle à la rédaction de : « Billet simple pour
                l'Alaska ». Le livre est tant attendu qu'il décide de publier son roman en ligne, chapitre par chapitre,
                pour le plus grand bonheur de ses lecteurs. Comme l'a si justement fait remarquer C. Lewis junior «
                Ce livre est une œuvre impérissable ».
            </p>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
