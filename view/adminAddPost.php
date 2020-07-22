<?php
// Titre site
$title = 'Jean Forteroche - Créer un chapitre';
?>

<!-- Content -->
<?php ob_start(); ?>

<div class="content">

    <!--Créer un  chapitre -->
    <h1>Créer un chapitre</h1><br />

    <!-- Formulaire -->
    <form id="form_create" action="index.php?action=adminAddPost" method="post" enctype="multipart/form-data">

        <label for="file_chapter">IMAGE : <input type="file" name="file_chapter"
                accept="image/png, image/jpeg, image/jpg" required /></label><br />
        <label for="title_chapter">TITRE</label><br />
        <input type="text" name="title_chapter"
            value="<?= $titlePost ?>" required><br /><br />
        <label for=" content_chapter">CONTENU</label><br />
        <textarea class="textarea_tiny"
            name="content_chapter"><?= $text ?></textarea><br /><br />
        <input id="button_form" type="submit" name="button_create_chapter" value="PUBLIER LE CHAPITRE" />

        <!-- Messages d'erreurs -->
        <?php
            if (!empty($errors)) { ?>
        <div class="error"><i class="fas fa-times"></i><br /><?= implode('<br/>', $errors) ?>
        </div><br /><br />
        <?php
            }
            ?>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/adminTemplate.php');
