<?php

namespace App\Controller;

use \App\Model\PostManager;
use \App\Model\CommentManager;

class PostController extends AncestorController
{

    /*********************** FRONTEND ************************/

    // Listing chapitres
    public function listPosts()
    {
        $postManager = new PostManager();

        $posts = $postManager->listPosts();

        if ($posts === false) {
            require('view/index.php');
        }
        require('view/listPosts.php');
    }
}
