<?php
// Titre site
$title = 'Jean Forteroche - Les chapitres';
?>

<!-- Content -->
<?php ob_start(); ?>

<div class="content">

    <!-- Intro -->
    <h1>Liste des chapitres,</h1>
    <p>Créer, modifier ou supprimer les chapitres du roman en ligne.
        <a href="index.php?action=adminAddPost">
            <span class="space_create">NOUVEAU CHAPITRE</span> <span class="red"><i class=" fas
                    fa-chevron-right"></i><i class="fas fa-chevron-right"></i></span>
        </a>
    </p><br /><br />

    <!-- Nb chapitre(s) -->
    <div>
        <h2> <span class="bell_square"><i class="fas fa-square"></i></span>
            <?php
            if ($countedPosts > 1) {
                echo ' <span class="bell">' . $countedPosts . '</span> chapitres' ;
            } else {
                echo ' <span class="bell">' . $countedPosts . '</span> chapitre';
            } ?>
        </h2>
    </div>

    <!--MESSAGES D'ERREURS OU SUCCES -->
    <?php
        if (isset($_SESSION['error_post'])) {
            echo '<p class="error"><i class="fas fa-times"></i> ' . $_SESSION['error_post'] . '</p>';
        }
        unset($_SESSION['error_post']);

        if (isset($_SESSION['success_post'])) {
            echo '<p class="success"><i class="fas fa-check"></i> ' . $_SESSION['success_post'] . '</p>';
        }
        unset($_SESSION['success_post']);
        ?>

    <!-- Chapitre(s) -->
    <?php
        foreach ($posts as $dataPosts) {
            ?>
    <div class="display_dash">
        <div>
            <?= htmlspecialchars(mb_strtoupper($dataPosts['title_chapter'])) ?>
        </div>
        <div class="div_avatar">
            <img src="public/img/<?= htmlspecialchars($dataPosts['image_chapter']) ?>"
                alt="Vignette Utilisateur - Billet simple pour l'Alaska" />
        </div>
        <div>
            <?php
                    $date = $this->dateTimeUsToDateFr(htmlspecialchars($dataPosts['date_chapter']));
            echo $date; ?>
        </div>
        <div>
            <a href="index.php?action=getPost&amp;id=<?= htmlspecialchars($dataPosts['id_chapter']) ?>"
                title="AFFICHER"><span class="bell"><i class="far fa-eye"></i></span>
            </a>
        </div>
        <div>
            <a href="index.php?action=adminUpdatePost&amp;id=<?= htmlspecialchars($dataPosts['id_chapter']) ?>"
                title="MODIFIER"><span class="bell_update"><i class="fas fa-pen"></i></span>
            </a>
        </div>
        <div>
            <a class="btn_suppr"
                href="index.php?action=adminDeletePost&amp;id=<?= htmlspecialchars($dataPosts['id_chapter']) ?>"
                title="SUPPRIMER"><span class="bell_alert"><i class="far fa-trash-alt"></i></span>
            </a>
        </div>
    </div>
    <?php
        }
        ?>



</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/adminTemplate.php');
