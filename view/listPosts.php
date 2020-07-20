<?php
// Titre site
$title = 'Jean Forteroche - Les chapitres';

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
    <div class="links"><a href="index.php">Accueil</a> <span class="red"><i class=" fas
                    fa-chevron-right"></i><i class="fas fa-chevron-right"></i></span> Les chapitres</div>

    <!-- Chapitres -->
    <?php
foreach ($posts as $dataPosts) {
    ?>
    <div class="block_posts">
        <div class="img_posts"><img
                src="public/img/<?= htmlspecialchars($dataPosts['image_chapter']) ?>"
                alt="Image - Billet simple pour l'Alaska - Jean Forteroche" /></div>
        <div class="para_posts">
            <div class="elts_posts">
                <p class="novel_posts"><?= mb_strtoupper(htmlspecialchars($dataPosts['novel_chapter'])) ?>
                </p>
                <p><span class="red"><i class="far fa-calendar-alt"></i></span>
                    <?php
                    $date = $this->dateTimeUsToDateFr(htmlspecialchars($dataPosts['date_chapter']));
    echo $date; ?>
                </p>
            </div>
            <h2><?= mb_strtoupper(htmlspecialchars($dataPosts['title_chapter'])) ?>
            </h2>
            <p>
                <?php
                $intro = $this->cutContent($dataPosts['text_chapter']);
    echo $intro; ?>
            </p>
            <p class="button"><a
                    href="index.php?action=getPost&amp;id=<?= htmlspecialchars($dataPosts['id_chapter']) ?>">Lire
                    la suite <span><i class=" fas
                    fa-chevron-right"></i><i class="fas fa-chevron-right"></i></span></a></p>
        </div>
    </div>
    <?php
}
?>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
