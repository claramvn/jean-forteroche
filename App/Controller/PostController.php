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
        $commentManager = new CommentManager();

        $postId = $this->cleanParam($_GET['id']);

        $post = $postManager->getPost($postId);
 
        if ($post === false) {
            require('view/index.php');
        }

        $comments = $commentManager->getCommentsByChapter($postId);

        $countComments = count($comments);

        if ($comments === false) {
            $_SESSION['error_com'] = "Impossible d'afficher le(s) commentaire(s)";
        }

        require("view/getPost.php");
    }

    /****************************  BACKEND  ****************************/

    // Listing chapitres
    public function adminListPosts()
    {
        if (!$this->is_admin()) {
            header('Location: index.php');
        }

        $postManager = new PostManager();

        $posts = $postManager->listPosts();

        $countedPosts = count($posts);

        if ($posts === false) {
            $_SESSION['error_post'] = "Impossible d'afficher les chapitres";
        }

        require('view/adminListPosts.php');
    }

    // Ajouter un chapitre
    public function adminAddPost()
    {
        if (!$this->is_admin()) {
            header('Location: index.php');
        }
    
        $postManager = new PostManager();
    
        $titlePost = "";
        $text = "";
        $errors = [];
    
        if (isset($_POST['button_create_chapter'])) {
            $novel = "Billet simple pour l'Alaska";
            $titlePost = $this->cleanParam($_POST['title_chapter']);
            $text = $this->cleanParam($_POST['content_chapter']);
            $file = $_FILES['file_chapter'];
        
            $fileExtensionUpload = $this->fileExtensionUpload($file);
            $fileExtensionAllowed = $this->fileExtensionAllowed();
            $newName = $this->newName($file, $fileExtensionUpload);

            if (empty($titlePost) && empty($text)) {
                $errors['empty_post'] = "Tous les champs sont nécessaires";
            }
    
            if ($file['error'] !== 0) {
                $errors['file_post'] = "Impossible de télécharger le fichier";
            }
    
            if (!$this->checkMaxSize($file)) {
                $errors['size_post'] = "Le fichier est trop volumineux";
            }
    
            if (!in_array($fileExtensionUpload, $fileExtensionAllowed)) {
                $errors['extension_post'] = "Le fichier n'est pas au format jpg/jpeg/png/gif";
            }
    
            if (!$errors) {
                $fileUpload = $this->uploadFile($file, $newName);
                $image = $newName;
    
                $addPost = $postManager->addPost($novel, $titlePost, $text, $image);
    
                if ($addPost === false) {
                    $errors['req_post'] = "Impossible de modifier l'article";
                } else {
                    $_SESSION['success_post'] = "Le chapitre a bien été créé";
                    header('Location: index.php?action=adminListPosts.php');
                }
            }
        }
            
        require('view/adminAddPost.php');
    }

    // Supprimer un chapitre
    public function adminDeletePost()
    {
        if (!$this->is_admin()) {
            header('Location: index.php');
        }

        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $postId = $this->cleanParam($_GET['id']);

        $deletePost = $postManager->deletePost($postId);

        if ($deletePost === false) {
            $_SESSION['error_post'] = "Impossible de supprimer le chapitre";
            header('Location: index.php?action=adminListPosts.php');
        } else {
            $_SESSION['success_post'] = "Le chapitre a bien été supprimé";
            header('Location: index.php?action=adminListPosts.php');
        }
    }
}
