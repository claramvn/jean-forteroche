<?php
session_start();

require_once('vendor/autoload.php');

use \App\Controller\FrontController;
use \App\Controller\PostController;
use \App\Controller\CommentController;
use \App\Controller\UserController;

try {
    if (isset($_GET['action'])) {
        $action = trim(htmlspecialchars($_GET['action']));
        switch ($action) {

            /*********************************************************************************
            ************************************ FrontController *****************************
            *********************************************************************************/

            // L'auteur
            case 'author':
                $frontController = new FrontController();
                $frontController->author();
            break;

            // Mentions légales
            case 'legalsMentions':
                $frontController = new FrontController();
                $frontController->legalsMentions();
            break;

            // Politique de confidentialité
            case 'privacyPolicy':
                $frontController = new FrontController();
                $frontController->privacyPolicy();
            break;

            // Page erreur 404
            case 'error404':
                $frontController = new FrontController();
                $frontController->error404();
            break;

            /*********************************************************************************
            ************************************ PostController ******************************
            *********************************************************************************/
            
            // FRONTEND

            // Les chapitres
            case 'listPosts':
                $postController = new PostController;
                $postController->listPosts();
            break;

            // Un Chapitre
            case 'getPost':
                $postController = new PostController;
                $postController->getPost();
            break;

            // BACKEND

            // Afficher les chapitres
            case 'adminListPosts':
                $postController = new PostController;
                $postController->adminListPosts();
            break;

            // Ajouter un chapitre
            case 'adminAddPost':
                $postController = new PostController;
                $postController->adminAddPost();
            break;

            // Modifier un chapitre
            case 'adminUpdatePost':
                $postController = new PostController;
                $postController->adminUpdatePost();
            break;

            // Supprimer un chapitre
            case 'adminDeletePost':
                $postController = new PostController;
                $postController->adminDeletePost();
            break;

            /*********************************************************************************
            ********************************** CommentController *****************************
            *********************************************************************************/

            // FRONTEND

            // Ajout commentaire
            case 'addComment':
                $commentController = new CommentController;
                $commentController->addComment();
            break;

            // Signaler un commentaire
            case 'reportComment':
                $commentController = new CommentController;
                $commentController->reportComment();
            break;

            // BACKEND

            // Tableau de bord : Affichage des commentaires signalés
            case 'adminReportedComments':
                $commentController = new CommentController;
                $commentController->adminReportedComments();
            break;

            // Annuler le signalement d'un commentaire
            case 'undoReportedComment':
                $commentController = new CommentController;
                $commentController->undoReportedComment();
            break;

            // Supprimer un commentaire signalé
            case 'deleteReportedComment':
                $commentController = new CommentController;
                $commentController->deleteReportedComment();
            break;

            // Supprimer un commentaire
            case 'adminDeleteComment':
                $commentController = new CommentController;
                $commentController->adminDeleteComment();
            break;

            /*********************************************************************************
            ************************************ UserController ******************************
            *********************************************************************************/

            // Inscription
            case 'register':
                $userController = new UserController;
                $userController->register();
            break;

            // Connexion
            case 'connection':
                $userController = new UserController;
                $userController->connection();
            break;

            // Mot de passe oublié
            case 'resetPass':
                $userController = new UserController;
                $userController->resetPass();
            break;

            // Déconnection
            case 'logout':
                $userController = new UserController;
                $userController->logout();
            break;

            // Profil
            case 'updateProfil':
                $userController = new UserController;
                $userController->updateProfil();
            break;

            // Supprimer un utilisateur
            case 'deleteUser':
                $userController = new UserController;
                $userController->deleteUser();
            break;

            // Défaut : Page erreur 404
            default:
                $frontController = new FrontController();
                $frontController->error404();
        }
    } else {
        //Accueil
        $frontController = new FrontController();
        $frontController->home();
    }
} catch (Exception $e) {
    require_once('view/error404.php');
}
