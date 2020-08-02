<?php
// Titre site
$title = 'Jean Forteroche - Profil';
?>

<!-- Content -->
<?php ob_start(); ?>

<!-- Header -->
<?php
require('header.php');
?>

<div class="content">

    <div id="logo_profil">
        <a href="index.php"><img
                src="public/img/<?= $this->user['avatar_user'] ?>"
                alt="Logo Jean Forteroche" /></a>
    </div>

    <!-- Formulaire -->
    <div id="form">
        <h1> Profil </h1>
        <p>Modifier les informations relatives à votre profil.</p><br /><br />

        <!-- Formulaire Profil -->
        <form action="index.php?action=updateProfil" method="post" enctype="multipart/form-data">
            <label for="file_profil">IMAGE :</label><br />
            <input type="file" name="file_profil" accept="image/png, image/jpeg, image/jpg" /><br /><br />
            <label for="pseudo_user">PSEUDO</label><br />
            <input type="text" name="pseudo_user"
                value="<?= htmlspecialchars($name) ?>"><br /><br />
            <label for="email_user">E-MAIL</label><br />
            <input type="text" name="email_user"
                value="<?= htmlspecialchars($email) ?>"><br /><br />
            <input id="button_form" type="submit" name="button_update_profil" value="METTRE À JOUR LE PROFIL" />

            <!-- Messages d'erreurs -->
            <?php
            if (!empty($errors)) { ?>
            <div class="error"><i class="fas fa-times"></i><br /><?= implode('<br/>', $errors) ?>
            </div><br /><br />
            <?php
            }

            if (isset($_SESSION['success_profil'])) {
                echo '<p class="success"><i class="fas fa-check"></i> ' . $_SESSION['success_profil'] . '</p>';
            }
            unset($_SESSION['success_profil']);
            ?>
            <?php
            if (!empty($success)) { ?>
            <div class="success"><i class="fas fa-check"></i><br /><?= implode('<br/>', $success) ?>
            </div><br /><br />
            <?php
            }
            ?>
        </form>

    </div>
    <?php
    if ($this->isLogged() && $this->user['rank_user'] !== "1") { ?>
    <div id="display_account">
        <div id="admin_delete_account">
            <a class="btn_suppr" href="index.php?action=deleteUser" title="SUPPRIMER LE COMPTE"
                onclick="confirmDelete()">SUPPRIMER LE COMPTE
                <span class="bell_alert"><i class="far fa-trash-alt"></i></span>
            </a>
        </div>
    </div>
    <?php
    }
?>
</div>

<div class="auth_space"></div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php');
