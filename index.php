<?php
session_start();
// Affichage des erreurs
ini_set('error_reporting', E_ALL);

require_once('vendor/autoload.php');

use \App\Controller\FrontController;
use \App\Controller\PostController;
use \App\Controller\CommentController;
use \App\Controller\UserController;

try {
    if (isset($_GET['action'])) {
        $action = trim(htmlspecialchars($_GET['action']));
        switch ($_GET['action']) {

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
            
        }
    } else {
        //Accueil
        $frontController = new FrontController();
        $frontController->home();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
