<?php
// Titre site
$title = 'Jean Forteroche - Tableau de bord';
?>

<!-- Content -->
<?php ob_start(); ?>


<div class="content">

    <!-- Intro -->
    <div>
        <h1>Tableau de bord,</h1>
        <p>Retrouver la liste des commentaires jugés inappropriés par les utilisateurs.
        </p><br /><br />

        <!-- Nb commentaire(s) signalé(s) -->
        <h2>
            <span class="bell_square"><i class="fas fa-square"></i></span>
            <?php
            if ($countReportedComments > 0) {
                echo ' <span class="bell_alert">' . $countReportedComments . '</span> commentaire(s) signalé(s) ' ;
            } else {
                echo ' <span class="bell">' . $countReportedComments . '</span> commentaire signalé ';
            } ?>
        </h2>
    </div>

    <!--Message erreurs/succès -->
    <?php
    if (isset($_SESSION['error_comment'])) {
        echo '<p class="error"><i class="fas fa-times"></i> ' . $_SESSION['error_comment'] . '</p>';
    }
    unset($_SESSION['error_comment']);
    if (isset($_SESSION['success_comment'])) {
        echo '<p class="success"><i class="fas fa-check"></i> ' . $_SESSION['success_comment'] . '</p>';
    }
    unset($_SESSION['success_comment']);
    ?>

    <!-- Commentaire(s) signalé(s) -->
    <?php
        foreach ($reportedComments as $dataComments) {
            ?>
    <div class="display_dash">
        <div class="div_avatar"><img
                src="public/img/<?= htmlspecialchars($dataComments['avatar_user']) ?>"
                alt="Vignette Utilisateur - Billet simple pour l'Alaska" />
        </div>
        <div>
            <?= htmlspecialchars($dataComments['pseudo_user']) ?>
        </div>
        <div>
            <?php
                    $date = $this->dateTimeUsToDateTimeFr(htmlspecialchars($dataComments['date_comment']));
            echo $date; ?>
        </div>
        <div>
            <?=  '<i class="fas fa-angle-double-left"></i>  ' . htmlspecialchars($dataComments['content_comment']) . '  <i class="fas fa-angle-double-right"></i>' ?>
        </div>
        <div>
            <a href="index.php?action=getPost&amp;id=<?= htmlspecialchars($dataComments['id_chapter']) ?>"
                title="AFFICHER"><span class="bell"><i class="far fa-eye"></i></span></a>
        </div>
        <div>
            <a href="index.php?action=validateReportedComment&amp;id=<?= htmlspecialchars($dataComments['id_comment']) ?>"
                title="VALIDER"><span class="bell_ok"><i class="fas fa-check-square"></i></span></a>
        </div>
        <div>
            <a class="btn_suppr"
                href="index.php?action=deleteReportedComment&amp;id=<?= htmlspecialchars($dataComments['id_comment']) ?>"
                title="SUPPRIMER"><span class="bell_alert"><i class="far fa-trash-alt"></i></span></a>
        </div>
    </div>

    <?php
        }
    ?>

</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/adminTemplate.php');
