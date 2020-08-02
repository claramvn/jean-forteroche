<?php

// Titre site
$title = 'INSCRIPTION';

// Classe inscription
$admin_li1 = 'inscription_li1';
$admin_li2 = 'inscription_li2';
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- header -->
<?php
require('auth_header.php');
?>

<!-- Block Formulaire -->
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

    <!-- Formulaire -->
    <form action="index.php?action=register" method="post">
        <label>NOM D'UTILISATEUR</label><br />
        <input type="text" name="pseudo_register"
            value="<?= $name ?>" required /><br /><br />
        <label>ADRESSE E-MAIL</label><br />
        <input type="text" name="email_register" placeholder="contact@nomdedomaine.com"
            value="<?= $email ?>" required /><br /><br />
        <label>MOT DE PASSE</label><br />
        <input type="password" name="pass_register" placeholder="minimum 6 caractères" required /><br /><br />
        <label>CONFIRMATION DE MOT DE PASSE</label><br />
        <input type="password" name="pass2_register" required /><br /><br />
        <input id="button_form" type="submit" name="button_register" value="ENVOYER" />
    </form>
</div>

<div class="auth_space"></div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
