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


    <!-- Nb Commentaire(s) -->
    <div id="block_comment">
        <?php
        if ($countComments > 1) {
            echo '<p class="para_count"> ' . $countComments . ' commentaires</p>';
        } elseif ($countComments == 1) {
            echo '<p class="para_count"> ' . $countComments . ' commentaire</p>';
        } ?>

        <!-- Commentaire -->
        <?php
        foreach ($comments as $dataComments) {
            ?>

        <div class="comment">
            <div class="img_comment">
                <img src="public/img/<?= htmlspecialchars($dataComments['avatar_user']) ?>"
                    alt="Vignette Utilisateur - Billet simple pour l'Alaska" />
            </div>
            <div class="content_comment">
                <h3><?= htmlspecialchars($dataComments['pseudo_user']) ?>,
                    <span class="date_comment">
                        <?php
                            $date = $this->dateTimeUsToDateTimeFr(htmlspecialchars($dataComments['date_comment']));
            echo $date; ?>
                    </span>
                </h3>
                <p><?= nl2br(htmlspecialchars($dataComments['content_comment'])) ?>
                </p>
                <div class="nav_comment">
                    <?php
                        if ($this->isAdmin()) { ?>
                    <a class="btn_suppr"
                        href="index.php?action=adminDeleteComment&amp;id=<?= htmlspecialchars($dataComments['id_comment']) ?>&amp;id_chapter=<?= htmlspecialchars($dataComments['id_chapter']) ?>"
                        title="SUPPRIMER LE COMMENTAIRE"><span class="bell_alert"><i
                                class="far fa-trash-alt"></i></span></a>
                    <?php
                        } else {
                            ?>
                    <a href="index.php?action=reportComment&amp;id=<?= htmlspecialchars($dataComments['id_comment']) ?>&amp;id_chapter=<?= htmlspecialchars($dataComments['id_chapter']) ?>"
                        title="SIGNALER"><span class="bell_alert"><i class="fas fa-exclamation-triangle"></i></span></a>
                    <?php
                        } ?>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

        <!-- Message d'erreur ou succès -->
        <?php
        if (isset($_SESSION['error_com'])) {
            echo '<p class="error"><i class="fas fa-times"></i> ' . $_SESSION['error_com'] . '</p>';
        }
        unset($_SESSION['error_com']);

        if (isset($_SESSION['success_com'])) {
            echo '<p class="success"><i class="fas fa-check"></i> ' . $_SESSION['success_com'] . '</p>';
        }
        unset($_SESSION['success_com']);
        ?>
    </div>

    <!-- Formulaire Ajout commentaire -->
    <?php
    if ($this->isLogged()) { ?>
    <div id="block_formComment">
        <p id="para_addComment"><i class="far fa-comment-alt"></i> AJOUTER UN COMMENTAIRE</p>
        <div id="form_comment">
            <form
                action="index.php?action=addComment&amp;id=<?= htmlspecialchars($post['id_chapter']) ?>"
                method="post">
                <textarea class="textarea_design" name="text_comment" placeholder="Votre Message"
                    required></textarea><br /><br />
                <input class="button_design" type="submit" name="button_comment" value="PUBLIER" />
            </form>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    if ($this->isAdmin()) { ?>
    <div id="display_admin">
        <div id="admin_delete_posts">
            <a class="btn_suppr"
                href="index.php?action=adminDeletePost&amp;id=<?= htmlspecialchars($post['id_chapter']) ?>"
                title="SUPPRIMER LE CHAPITRE">SUPPRIMER LE CHAPITRE <span class="bell_alert"><i
                        class="far fa-trash-alt"></i></span>
            </a>
        </div>
    </div>
</div>
<?php
    }
?>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
