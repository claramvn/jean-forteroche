<?php
session_start();
// Affichage des erreurs
ini_set('error_reporting', E_ALL);

require_once('vendor/autoload.php');

use \App\Controller\FrontController;
use \App\Controller\PostController;

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
            
            
        }
    } else {
        //Accueil
        $frontController = new FrontController();
        $frontController->home();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
