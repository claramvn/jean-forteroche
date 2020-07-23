<?php

namespace App\Controller;

use \App\Model\PostManager;

class FrontController extends AncestorController
{
    // Accueil
    public function home()
    {
        $postManager = new PostManager();

        $postManager = new PostManager();

        $recentPost = $postManager->getRecentPost();

        if ($recentPost === false) {
            $_SESSION['error_recentPost'] = "Impossible d'afficher le dernier chapitre";
        }
        
        require('view/home.php');
    }

    // L'auteur
    public function author()
    {
        require('view/author.php');
    }

    // Mentions légales
    public function legalsMentions()
    {
        require('view/legalsMentions.php');
    }

    // Politique de confidentialité
    public function privacyPolicy()
    {
        require('view/privacyPolicy.php');
    }

    // Politique de confidentialité
    public function error404()
    {
        require('view/error404.php');
    }
}
