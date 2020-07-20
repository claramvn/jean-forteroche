<?php

namespace App\Controller;

use \App\Model\UserManager;

class UserController extends AncestorController
{
    // Nettoyage adresse e-mail
    public function cleanEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $email;
    }

    // Longueur minimum mdp
    public function checkPassLength($pass)
    {
        $passLength = strlen($pass);
        if ($passLength >= 6) {
            return true;
        } else {
            return false;
        }
    }

    // Vérification mdp Utilisateur
    public function checkUserPass($name, $pass)
    {
        $userManager = new UserManager();

        $user = $userManager->getUserByName($name);
        return password_verify($pass, $user['pass_user']);
    }

    // Inscription
    public function register()
    {
        $name = "";
        $email = "";
        $errors = [];

        if (isset($_POST['button_register'])) {
            $userManager = new UserManager();
            $name = $this->cleanParam($_POST['pseudo_register']);
            $email = $this->cleanParam($_POST['email_register']);
            $pass = $this->cleanParam($_POST['pass_register']);
            $pass2 = $this->cleanParam($_POST['pass2_register']);
            $avatar = "thumbnail.jpg";

            if (!empty($name) && !empty($email) && !empty($pass) && !empty($pass2)) {

                // Si nom utilisateur déjà en base
                $user = $userManager->getUserByName($name);
                if ($user['pseudo_user'] === $name) {
                    $errors['name_register'] = "- Nom d'utilisateur déjà existant ";
                }
               
                // Mauvais format e-mail
                if (!$this->cleanEmail($email)) {
                    $errors['email_register'] = "- Le format de l'adresse e-mail n'est pas valide ";
                }

                // Si e-mail utilisateur déjà en base
                $emailExist = $userManager->emailExist($email);
                if ($emailExist['email_user'] === $email) {
                    $errors['email2_register'] = "- Adresse e-mail déjà utilisée ";
                }

                // Vérif taille minimum mdp
                if (!$this->checkPassLength($pass)) {
                    $errors['pass_register'] = "- Le mot de passe doit comporter minimum 6 caractères ";
                }
                    
                // Comparaison mdp et mdp confirmation
                if ($pass !== $pass2) {
                    $errors['pass2_register'] = "- Veuillez renseigner un mot de passe identique au mot de passe de confirmation ";
                }
                
                if (!$errors) {
                    // Hash mot de passe
                    $pass = password_hash($pass, PASSWORD_DEFAULT);

                    // Ajout utilisateur
                    $addUser = $userManager->addUser($name, $email, $pass, $avatar);

                    if ($addUser !== false) {
                        $user = $userManager->getUserByName($name);
                        // Id utilisateur en session
                        $_SESSION['id_user'] = $user['id_user'];
                        // Id utilisateur hashé en session
                        $chaine1 = $user['id_user'] . "essaiesDeTrouverMonHash2020";
                        $_SESSION['id_hash_user'] = hash("sha256", $chaine1);

                        header('Location: index.php');
                    } else {
                        $errors['req_register'] = "- Impossible d'effectuer une inscription";
                    }
                }
            } else {
                $errors['empty_register'] = "- Tous les champs sont nécessaires";
            }
        }

        require('view/register.php');
    }

    // Connexion
    public function connection()
    {
        $name = "";
        $errors = [];

        if (isset($_POST['button_connection'])) {
            $userManager = new UserManager();
            $name = $this->cleanParam($_POST['pseudo_connection']);
            $pass = $this->cleanParam($_POST['pass_connection']);

            if (!empty($name) && !empty($pass)) {

                // Si nom utilisateur en base
                $user = $userManager->getUserByName($name);
                if ($user['pseudo_user'] !== $name) {
                    $errors['error_connection'] = "Erreur Authentification : Identifiants incorrects ";
                }

                // Comparaison mdp correspondant à l'utilisateur
                if (!$this->checkUserPass($name, $pass)) {
                    $errors['error_connection'] = "Erreur Authentification : Identifiants incorrects ";
                }

                if (!$errors) {
                    // Récup utilisateur en base par le nom
                    $user = $userManager->getUserByName($name);
                    // Récup de son id
                    $idUser = $user['id_user'];
                    // Son id direction session
                    $_SESSION['id_user'] = $idUser;
                    // Son id version hashé en session
                    $_SESSION['id_hash_user'] = $this->getPowerfulHash($idUser);
                    
                    if ($this->is_admin()) {
                        header('Location: index.php?action=adminReportedComments');
                    } else {
                        header('Location: index.php');
                    }
                }
            } else {
                $errors['empty_connection'] = "Tous les champs sont nécessaires";
            }
        }
        require('view/connection.php');
    }

    // Mot de passe oublié
    public function resetPass()
    {
        $email = "";
        $errors = [];
        $success = null;

        if (isset($_POST['button_resetPass'])) {
            $userManager = new UserManager();
            $email = $this->cleanParam($_POST['email_resetPass']);
            $pass = $this->cleanParam($_POST['pass_resetPass']);
            $pass2 = $this->cleanParam($_POST['pass2_resetPass']);

            if (!empty($email) && !empty($pass) && !empty($pass2)) {

                // Si e-mail utilisateur déjà en base
                $emailExist = $userManager->emailExist($email);
                if ($emailExist['email_user'] !== $email) {
                    $errors['email_resetpass'] = "- Adresse e-mail inconnue ";
                }

                // Vérif taille minimum mdp
                if (!$this->checkPassLength($pass)) {
                    $errors['pass_resetpass'] = "- Le mot de passe doit comporter minimum 6 caractères ";
                }

                // Comparaison mdp et mdp confirmation
                if ($pass !== $pass2) {
                    $errors['pass2_resetpass'] = "- Veuillez renseigner un mot de passe identique au mot de passe de confirmation ";
                }
           
                if (!$errors) {
                    // Hash mot de passe
                    $pass = password_hash($pass, PASSWORD_DEFAULT);
                    $updatePass = $userManager->updatePass($pass, $email);
                    $success = "Votre mot de passe à été modifié avec succès ";
                    header('Refresh:1.5;url=index.php?action=connection');
                }
            } else {
                $errors['empty_resetpass'] = "- Tous les champs sont nécessaires";
            }
        }

        require('view/resetPass.php');
    }

    // Profil utilisateur
    public function updateProfil()
    {
        if (!$this->is_logged()) {
            header('Location: index.php');
        }

        $name = $this->user['pseudo_user'];
        $email = $this->user['email_user'];
        $avatar = $this->user['avatar_user'];
        $id = $this->user['id_user'];

        $errors = [];
        $success = [];

        if (isset($_POST['button_update_profil'])) {
            $userManager = new UserManager();
            $name = $this->cleanParam($_POST['pseudo_user']);
            $email = $this->cleanParam($_POST['email_user']);

            // Vérif champs vides
            if (empty($name) && empty($email)) {
                $errors['empty_profil'] = "- Tous les champs sont nécessaires";
            }

            // Si pseudo non identique à l'ancien et si déjà existant en base
            if ($this->user['pseudo_user'] !== $name) {
                $user = $userManager->getUserByName($name);

                if ($user['pseudo_user'] === $name) {
                    $errors['name_profil'] = "- Nom d'utilisateur déjà existant";
                }
                
                if (!$errors) {
                    $success['pseudo_profil'] = "- Le pseudo a bien été modifié";
                } else {
                    $name = $this->user['pseudo_user'];
                }
            }

            // Si email non identique à l'ancien et si déjà existant en base
            if ($this->user['email_user'] !== $email) {
                $emailExist = $userManager->emailExist($email);

                if ($emailExist['email_user'] === $email) {
                    $errors['email_profil'] = "- Adresse e-mail déjà utilisée ";
                }
            
                if (!$this->cleanEmail($email)) {
                    $errors['email_profil'] = "- Le format de l'adresse e-mail n'est pas valide ";
                }
            
                if (!$errors) {
                    $success['email_profil'] = "- L'adresse e-mail a bien été modifié";
                } else {
                    $email = $this->user['email_user'];
                }
            }
            
            // Traitement image
            if (isset($_FILES["file_profil"]) && $_FILES["file_profil"]["error"] == 0) {
                $file = $_FILES['file_profil'];
                $fileExtensionUpload = $this->fileExtensionUpload($file);
                $fileExtensionAllowed = $this->fileExtensionAllowed();
                $newName = $this->newName($file, $fileExtensionUpload);


                if (!$this->checkMaxSize($file)) {
                    $errors['size_img_profil'] = "Impossible de modifier l'image : le fichier est trop volumineux";
                }

                if (!in_array($fileExtensionUpload, $fileExtensionAllowed)) {
                    $errors['extension_img_profil'] = "Impossible de modifier l'image : le fichier n'est pas au format jpg/jpeg/png/gif";
                }

                if (!$errors) {
                    $avatar = $newName;
                    $fileUpload = $this->uploadFile($file, $newName);
                    $success['img_profil'] = "- L'image a bien été modifiée";
                } else {
                    $avatar = $this->user['avatar_user'];
                }
            }

            $updateUser = $userManager->updateUser($email, $avatar, $name, $id);

            if (!$updateUser) {
                $errors['req_profil'] = "Impossible de modifier le profil";
            }
        }

        require('view/updateProfil.php');
    }

    // Déconnection
    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }
}
