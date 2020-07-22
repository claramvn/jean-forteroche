<?php
// Titre site
$title = 'Jean Forteroche - Modifier un chapitre';
?>

<!-- Content -->
<?php ob_start(); ?>


<div class="content">

    <!--Créer un  chapitre -->
    <h1>Modifier un chapitre</h1>


    <form id="form_create"
        action="index.php?action=adminUpdatePost&amp;id=<?= htmlspecialchars($post['id_chapter']) ?>"
        method="post" enctype="multipart/form-data">
        <label for="file_chapter">IMAGE :</label><br />
        <img class="img_update"
            src="public/img/<?= htmlspecialchars($image) ?>"
            alt="Billet simple pour l'Alaska - Jean Forteroche" /><br /><br />
        <input type="file" name="file_chapter" accept="image/png, image/jpeg, image/jpg" /><br /><br />
        <label for="title_chapter">TITRE</label><br />
        <input type="text" name="title_chapter"
            value="<?= htmlspecialchars($titlePost) ?>"
            required><br /><br />
        <label for=" content_chapter">CONTENU</label><br />
        <textarea class="textarea_tiny"
            name="content_chapter"><?= $text ?></textarea><br /><br />
        <label>DATE DE PUBLICATION :
            <?php
                    $dateFr = $this->dateTimeUsToDateTimeFr(htmlspecialchars($date));
                    echo $dateFr; ?>
        </label>
        <div id="publication">
            <input class="date_input" type="date" name="date_chapter"
                max="<?php echo date("Y-m-d");?>"
                value="<?php
                    $dateUs = $this->getdateOfDateTimeUs($date);
                    echo $dateUs;
                    ?>" />
            <input class="time_input" type="time" name="time_chapter" step="2" value="<?php
                    $timeUs = $this->getTimeOfDateTimeUs($date);
                    echo $timeUs;
                    ?>" />
        </div><br /><br />
        <input id="button_form" type="submit" name="button_update_chapter" value="PUBLIER LE CHAPITRE" />

        <!-- Messages d'erreurs & succès -->
        <?php
            if (!empty($errors)) { ?>
        <div class="error"><i class="fas fa-times"></i><br /><?= implode('<br/>', $errors) ?>
        </div><br /><br />
        <?php
            }
            if (!empty($success)) { ?>
        <div class="success"><i class="fas fa-check"></i><br /><?= implode('<br/>', $success) ?>
        </div><br /><br />
        <?php
            }
            ?>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/adminTemplate.php');
