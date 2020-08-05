<?php
// Titre site
$title = 'CONNEXION';

//Classe inscription
$admin_li1 = 'connexion_li1';
$admin_li2 = 'connexion_li2';
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- Formulaire -->
<div id="form">

    <!-- Messages d'erreurs -->
    <?php
        if (!empty($errors)) {
            ?>
    <div class="error"><i class="fas fa-times"></i><br /><?= implode('<br/>', $errors) ?>
    </div><br /><br />
    <?php
        }
    ?>

    <form action="index.php?action=connection" method="post">
        <label>NOM D'UTILISATEUR</label><br />
        <input type="text" name="pseudo_connection"
            value="<?= $name ?>" required /><br /><br />
        <label>MOT DE PASSE</label><br />
        <input type="password" name="pass_connection" required /><br /><br />
        <input id="button_form" type="submit" name="button_connection" value="SE CONNECTER" />
    </form>
</div>
<div id="forget_pass">
    <p><a href="index.php?action=resetPass">Mot de passe oublié ?</a></p>
</div>

<div class="auth_space"></div>

<?php $content = ob_get_clean(); ?>
<?php require('view/authTemplate.php');
