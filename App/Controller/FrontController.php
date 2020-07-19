<?php

namespace App\Controller;

use \App\Model\PostManager;

class FrontController
{
    // Accueil
    public function home()
    {
        $postManager = new PostManager();
        
        require('view/home.php');
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
}
