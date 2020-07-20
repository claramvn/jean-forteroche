<?php
// Titre site
$title = 'Jean Forteroche - ' . htmlspecialchars($post['title_chapter']);
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- header -->
<?php
require('header.php');
?>

<!-- Bannière -->
<?php
require('banner.php');
?>

<div class="content">

    <!-- Retour accueil -->
    <div class="links">
        <p>
            <a href="index.php">Accueil</a>
            <span class="red"><i class=" fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></span>
            <a href="index.php?action=listPosts">Les chapitres</a></span>
            <span class="red"><i class=" fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></span>
            <?= htmlspecialchars($post['title_chapter']) ?>
        </p>
    </div>

    <!-- Chapitre -->
    <div id="block_post">
        <div id="text_post">
            <h1><?= mb_strtoupper(htmlspecialchars($post['title_chapter'])) ?>
            </h1>
            <div><img class="img_content"
                    src="public/img/<?= htmlspecialchars($post['image_chapter']) ?>"" alt="
                    Billet simple pour l'Alaska - Jean Forteroche" />
                <?=
                nl2br(htmlspecialchars_decode($post['text_chapter']));
             ?>
            </div>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
