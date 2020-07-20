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

    // Chapitre séléctionné
    public function getPost()
    {
        $postManager = new PostManager();

        $postId = $this->cleanParam($_GET['id']);
 
        $post = $postManager->getPost($postId);
 
        if ($post === false) {
            require('view/index.php');
        }

        require("view/getPost.php");
    }
}
