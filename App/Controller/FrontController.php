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
}
