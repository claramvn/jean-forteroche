<?php
// Titre site
$title = 'Jean Forteroche - Les chapitres';
?>

<!-- Content -->
<?php ob_start(); ?>

<div class="back_content">

    <!-- Intro -->
    <div class="intro_dash">
        <h1>Liste des chapitres,</h1>
        <p>Créer, modifier ou supprimer les chapitres du roman en ligne.
            <a href="index.php?action=adminAddPost">
                <span class="space_create">NOUVEAU CHAPITRE</span> <span class="red"><i class=" fas
                    fa-chevron-right"></i><i class="fas fa-chevron-right"></i></span>
            </a>
        </p><br /><br />
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

    <!-- Nb chapitre(s) -->

    <?php
        if ($countedPosts <= 0) {
            ?>
    <h2><span class="bell_square"><i class="fas fa-square"></i></span><span class="bell"><?= $countedPosts ?></span>chapitre
    </h2>
    <?php
        } else {
            ?>
    <h2><span class="bell_square"><i class="fas fa-square"></i></span><span class="bell"><?= $countedPosts ?></span>
        chapitre(s)</h2>
    <table id="table1">
        <tr id="tr1">
            <th>TITRE</th>
            <th>IMAGE</th>
            <th>DATE</th>
            <th>VOIR ET MODÉRER LES COMMENTAIRES</th>
            <th>MODIFIER</th>
            <th>SUPPRIMER</th>
        </tr>
    </table>
    <table id="table2">
        <?php
        } ?>
        <?php
        foreach ($posts as $dataPosts) {
            ?>
        <tr id="tr2">
            <td><?= htmlspecialchars(mb_strtoupper($dataPosts['title_chapter'])) ?>
            </td>
            <td><img src="public/img/<?= htmlspecialchars($dataPosts['image_chapter']) ?>"
                    alt="Vignette Utilisateur - Billet simple pour l'Alaska" />
            </td>
            <td><?php
                    $date = $this->dateTimeUsToDateTimeFr(htmlspecialchars($dataPosts['date_chapter']));
            echo $date; ?>
            </td>
            <td><a href="index.php?action=getPost&amp;id=<?= htmlspecialchars($dataPosts['id_chapter']) ?>"
                    title="AFFICHER"><span class="bell"><i class="far fa-eye"></i></span>
                </a>
            </td>
            <td> <a href="index.php?action=adminUpdatePost&amp;id=<?= htmlspecialchars($dataPosts['id_chapter']) ?>"
                    title="MODIFIER"><span class="bell_update"><i class="fas fa-pen"></i></span>
                </a>
            </td>
            <td><a class="btn_suppr"
                    href="index.php?action=adminDeletePost&amp;id=<?= htmlspecialchars($dataPosts['id_chapter']) ?>"
                    title="SUPPRIMER" onclick="confirmDelete()"><span class="bell_alert"><i
                            class="far fa-trash-alt"></i></span>
                </a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/adminTemplate.php');
