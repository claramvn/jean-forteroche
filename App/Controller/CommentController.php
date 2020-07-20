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
                    header('Location: index.php?action=getPost&id=' . $postId . '#block_comment');
                }
            } else {
                $_SESSION['error_com'] = "Le champ est nécessaire";
                header('Location: index.php?action=getPost&id=' . $postId . '#block_comment');
            }
        }
    }

    // Signaler un commentaire
    public function reportComment()
    {
        $commentManager = new CommentManager();

        $commentId = $this->cleanParam($_GET['id']);
        $episodeId = $this->cleanParam($_GET['id_chapter']);

        $reportComment = $commentManager->reportComment($commentId);

        if ($reportComment === false) {
            $_SESSION['error_com'] = "Impossible de signaler le commentaire";
            header('Location: index.php?action=getPost&id=' . $episodeId . '#block_comment');
        } else {
            $_SESSION['success_com'] = "Votre commentaire a bien été signalé, merci.";
            header('Location: index.php?action=getPost&id=' . $episodeId . '#block_comment');
        }
    }

    /*********************** BACKEND ************************/

    // Affichage commentaire(s) signalé(s)
    public function adminReportedComments()
    {
        $commentManager = new CommentManager();

        $reportedComments = $commentManager->getReportedComments();

        $countReportedComments = count($reportedComments);

        if ($reportedComments === false) {
            $_SESSION['error_comment'] = "Impossible d'afficher les commentaire(s) signalé(s)";
            header('Location: index.php?action=adminReportedComments');
        }

        require('view/adminReportedComments.php');
    }
}
