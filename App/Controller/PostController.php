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
        if (!$this->isAdmin()) {
            header('Location: index.php');
        }

        $postManager = new PostManager();

        $posts = $postManager->listPosts();

        $countedPosts = count($posts);

        if ($posts === false) {
            header('Location: index.php');
            $_SESSION['error_post'] = "Impossible d'afficher les chapitres";
        }

        require('view/adminListPosts.php');
    }

    // Ajouter un chapitre
    public function adminAddPost()
    {
        if (!$this->isAdmin()) {
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
                    header('Location: index.php?action=adminListPosts');
                }
            }
        }
            
        require('view/adminAddPost.php');
    }

    // Modifier un chapitre
    public function adminUpdatePost()
    {
        if (!$this->isAdmin()) {
            header('Location: index.php');
        }
    
        $postManager = new PostManager();
    
        // Récupération données chapitre séléctionné
        $postId = $this->cleanParam($_GET['id']);
        $post = $postManager->getPost($postId);
    
        if ($post === false) {
            header('Location: index.php?action=adminListPosts');
        } else {
            $titlePost = $post['title_chapter'];
            $text = $post['text_chapter'];
            $image = $post['image_chapter'];
            $date = $post['date_chapter'];
    
            $errors = [];
            $success = [];
    
            if (isset($_POST['button_update_chapter'])) {
                $titlePost = $this->cleanParam($_POST['title_chapter']);
                $text = $_POST['content_chapter'];
                
                
                // Vérif champs vides
                if (empty($titlePost) && empty($text)) {
                    $errors['empty_post'] = "- Tous les champs sont nécessaires";
                    $titlePost = $this->cleanParam($post['title_chapter']);
                    $text = $post['text_chapter'];
                } else {
                    $titlePost = $this->cleanParam($_POST['title_chapter']);
                    $text = $_POST['content_chapter'];
                }
 
                // Traitement titre
                if ($post['title_chapter'] !== $titlePost) {
                    $success['title_post'] = "- Le titre a bien été modifié";
                } else {
                    $titlePost = $post['title_chapter'];
                }
        
                // Traitement contenu : textarea
                if ($post['text_chapter'] !== $text) {
                    $success['content_post'] = "- Le contenu a bien été modifié";
                } else {
                    $text = $post['text_chapter'];
                }
    
                // Traitement image
                if (isset($_FILES["file_chapter"]) && $_FILES["file_chapter"]["error"] == 0) {
                    $file = $_FILES['file_chapter'];
                    $fileExtensionUpload = $this->fileExtensionUpload($file);
                    $fileExtensionAllowed = $this->fileExtensionAllowed();
                    $newName = $this->newName($file, $fileExtensionUpload);
    
                    if (!$this->checkMaxSize($file)) {
                        $errors['size_img_post'] = "- Le fichier est trop volumineux";
                    }
    
                    if (!in_array($fileExtensionUpload, $fileExtensionAllowed)) {
                        $errors['extension_img_post'] = "- Le fichier n'est pas au format jpg/jpeg/png/gif";
                    }
    
                    if (!$errors) {
                        $fileUpload = $this->uploadFile($file, $newName);
                        $image = $newName;
                        $success['img_post'] = "- L'image a bien été modifiée";
                    } else {
                        $image = $post['image_chapter'];
                    }
                }

                $newDate = $_POST['date_chapter'] . " " . $_POST['time_chapter'];

                // Si modification date
                if ($post['date_chapter'] !== $newDate) {
                    $dateUs = $this->cleanParam($_POST['date_chapter']);
                    $time = $this->cleanParam($_POST['time_chapter']);
                    $date = $dateUs . " " . $time;
                    $success['date_post'] = "- La date a bien été modifiée";
                } else {
                    $date = $post['date_chapter'];
                }

                $updatePost = $postManager->updatePost($titlePost, $text, $image, $date, $postId);
    
                if ($updatePost === false) {
                    $errors['update_post'] = "Impossible de modifier le chapitre";
                    header('Location: index.php?action=adminListPosts');
                }
            }
        }
    
        require('view/adminUpdatePost.php');
    }

    // Supprimer un chapitre
    public function adminDeletePost()
    {
        if (!$this->isAdmin()) {
            header('Location: index.php');
        }

        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $postId = $this->cleanParam($_GET['id']);
        $commentId = $this->cleanParam($_GET['id']);

        $deletePost = $postManager->deletePost($postId);
        $deleteComment = $commentManager->deleteCommentWhereDeletedPost($commentId);

        if ($deletePost === false) {
            $_SESSION['error_post'] = "Impossible de supprimer le chapitre";
            header('Location: index.php?action=adminListPosts');
        } else {
            $_SESSION['success_post'] = "Le chapitre a bien été supprimé";
            header('Location: index.php?action=adminListPosts');
        }
    }
}
