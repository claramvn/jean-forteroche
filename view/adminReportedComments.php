<?php
// Titre site
$title = 'Jean Forteroche - Tableau de bord';
?>

<!-- Content -->
<?php ob_start(); ?>


<div class="back_content">

    <!-- Intro -->
    <div class="intro_dash">
        <h1>Tableau de bord,</h1>
        <p>Retrouver la liste des commentaires jugés inappropriés par les utilisateurs.
        </p><br /><br />
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

    <!-- Nb commentaire(s) signalé(s) -->
    <?php
            if ($countReportedComments <= 0) {
                ?>
    <h2><span class="bell_square"><i class="fas fa-square"></i> </span><span class="bell"><?= $countReportedComments ?></span> commentaire signalé</h2>
    <?php
            } else {
                ?>
    <h2><span class="bell_square"><i class="fas fa-square"></i> </span><span class="bell_alert"><?= $countReportedComments ?></span> commentaire(s)
        signalé(s)</h2>
    <table id="table1">
        <tr id="tr1">
            <th>AVATAR</th>
            <th>PSEUDO</th>
            <th>DATE</th>
            <th>COMMENTAIRE</th>
            <th>VOIR/MODÉRER</th>
            <th>VALIDER</th>
            <th>SUPPRIMER</th>
        </tr>
    </table>
    <table id="table2">
        <?php
            } ?>
        <?php
        foreach ($reportedComments as $dataComments) {
            ?>
        <tr id="tr2">
            <td><img src="public/img/<?= htmlspecialchars($dataComments['avatar_user']) ?>"
                    alt="Vignette Utilisateur - Billet simple pour l'Alaska" />
            </td>
            <td><?= htmlspecialchars($dataComments['pseudo_user']) ?>
            </td>
            <td><?php
                    $date = $this->dateTimeUsToDateTimeFr(htmlspecialchars($dataComments['date_comment']));
            echo $date; ?>
            </td>
            <td> <?php echo '<i class="fas fa-angle-double-left"></i>  ' . htmlspecialchars($dataComments['content_comment']) . '  <i class="fas fa-angle-double-right"></i>' ?>
            </td>
            <td> <a href="index.php?action=getPost&amp;id=<?= htmlspecialchars($dataComments['id_chapter']) ?>"
                    title="AFFICHER"><span class="bell"><i class="far fa-eye"></i></span></a>
            </td>
            <td><a href="index.php?action=undoReportedComment&amp;id=<?= htmlspecialchars($dataComments['id_comment']) ?>"
                    title="VALIDER"><span class="bell_ok"><i class="fas fa-check-square"></i></span></a>
            </td>
            <td><a class="btn_suppr"
                    href="index.php?action=deleteReportedComment&amp;id=<?= htmlspecialchars($dataComments['id_comment']) ?>"
                    title="SUPPRIMER" onclick="confirmDelete()"><span class="bell_alert"><i
                            class="far fa-trash-alt"></i></span></a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/adminTemplate.php');
