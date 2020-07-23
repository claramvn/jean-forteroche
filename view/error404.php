<?php
// Titre site
$title = 'Jean Forteroche - Accueil';
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- header -->
<?php
require('header.php');
?>

<div id="div_error"><img src="public/img/error.png" alt="Jean Forteroche - Billet simple pour l'Alaska : Page erreur" />
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
