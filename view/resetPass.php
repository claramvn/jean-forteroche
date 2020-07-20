<?php
// Titre site
$title = 'RÉINITIALISATION MOT DE PASSE';

//Classe inscription
$admin_li1 = 'connexion_li1';
$admin_li2 = 'connexion_li2';
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- header -->
<?php
require('auth_header.php');
?>

<!-- Formulaire -->
<div id="form">
    <h1>Réinitialiser votre mot de passe</h1>
    <p>Veuillez saisir votre adresse e-mail et votre nouveau mot de passe.</p><br /><br />

    <form action="index.php?action=resetPass" method="post">

        <!-- Messages d'erreurs -->
        <?php
            if (!empty($errors)) { ?>
        <div class="error"><i class="fas fa-times"></i><br /><?= implode('<br/>', $errors) ?>
        </div><br /><br />
        <?php
            }
            if (!empty($success)) {
                echo '<p class="success"><i class="fas fa-check"></i> ' . $success . '</p>';
            }
            ?>

        <label for="email_resetPass">ADRESSE E-MAIL</label><br />
        <input type="text" name="email_resetPass"
            value="<?= $email ?>"
            placeholder="contact@nomdedomaine.com" required /><br /><br />
        <label for="pass_resetPass">MOT DE PASSE</label><br />
        <input type="password" name="pass_resetPass" placeholder="minimum 6 caractères" required /><br /><br />
        <label for="pass2_resetPass">CONFIRMATION DU MOT DE PASSE</label><br />
        <input type="password" name="pass2_resetPass" required /><br /><br />
        <input id="button_form" type="submit" name="button_resetPass" value="RÉINITIALISER LE MOT DE PASSE" />
    </form>
</div>

<div class="auth_space"></div>


<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
