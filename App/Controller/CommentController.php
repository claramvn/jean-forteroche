<?php

namespace App\Controller;

use \App\Model\CommentManager;

class CommentController extends AncestorController
{
    /*********************** FRONTEND ************************/

    // Ajouter un commentaire
    public function addComment()
    {
        $commentManager = new CommentManager();

        if (isset($_POST['button_comment'])) {
            $userId = $this->user['id_user'];
            $message = $this->cleanParam($_POST['text_comment']);
            $postId = $this->cleanParam($_GET['id']);

            if (!empty($message)) {
                $comment = $commentManager->addComment($message, $postId, $userId);

                if ($comment === false) {
                    $_SESSION['error_com'] = "Impossible d'ajouter le commentaire";
                    header('Location: index.php?action=post&id=' . $postId . '#block_comment');
                } else {
                    $_SESSION['success_com'] = "Votre commentaire a bien été ajouté";
                    header('Location: index.php?action=post&id=' . $postId . '#block_comment');
                }
            } else {
                $_SESSION['error_com'] = "Le champ est nécessaire";
                header('Location: index.php?action=post&id=' . $postId . '#block_comment');
            }
        }
    }
}
