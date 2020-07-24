<?php

namespace App\Controller;

use \App\Model\CommentManager;

class CommentController extends AncestorController
{
    /*********************** FRONTEND ************************/

    // Ajouter un commentaire
    public function addComment()
    {
        if (!$this->isLogged()) {
            header('Location: index.php');
        }

        $commentManager = new CommentManager();

        if (isset($_POST['button_comment'])) {
            $userId = $this->user['id_user'];
            $message = $this->cleanParam($_POST['text_comment']);
            $postId = $this->cleanParam($_GET['id']);

            if (!empty($message)) {
                $comment = $commentManager->addComment($message, $postId, $userId);

                if ($comment === false) {
                    $_SESSION['error_com'] = "Impossible d'ajouter le commentaire";
                    header('Location: index.php?action=getPost&id=' . $postId . '#block_comment');
                } else {
                    $_SESSION['success_com'] = "Votre commentaire a bien été ajouté";
                    header('Location: index.php?action=getPost&id=' . $postId . '#block_comment');
                }
            } else {
                $_SESSION['error_com'] = "Le champ commentaire n'est pas renseigné";
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
        if (!$this->isAdmin()) {
            header('Location: https://www.fbi.gov/');
        }

        $commentManager = new CommentManager();

        $reportedComments = $commentManager->getReportedComments();

        $countReportedComments = count($reportedComments);

        if ($reportedComments === false) {
            header('Location: index.php?action=error404');
        }
        
        require('view/adminReportedComments.php');
    }

    // Annuler le signalement du commentaire
    public function undoReportedComment()
    {
        if (!$this->isAdmin()) {
            header('Location: index.php');
        }

        $commentManager = new CommentManager();

        $commentId = $this->cleanParam($_GET['id']);

        $undoReportComment = $commentManager->undoReportComment($commentId);

        if ($undoReportComment === false) {
            $_SESSION['error_comment'] = "Impossible de modérer le commentaire";
            header('Location: index.php?action=adminReportedComments');
        } else {
            $_SESSION['success_comment'] = "Le commentaire a bien été validé";
            header('Location: index.php?action=adminReportedComments');
        }
    }

    // Supprimer
    public function delete()
    {
        if (!$this->isAdmin()) {
            header('Location: index.php');
        }

        $commentManager = new CommentManager();

        $commentId = $this->cleanParam($_GET['id']);

        $deleteComment = $commentManager->deleteComment($commentId);

        return $deleteComment;
    }

    // Supprimer un commentaire signalé
    public function deleteReportedComment()
    {
        $this->delete();

        if ($this->delete() === false) {
            $_SESSION['error_comment'] = "Impossible de supprimer le commentaire";
            header('Location: index.php?action=adminReportedComments');
        } else {
            $_SESSION['success_comment'] = "Le commentaire a bien été supprimé";
            header('Location: index.php?action=adminReportedComments');
        }
    }

    // Supprimer commentaire
    public function adminDeleteComment()
    {
        $episodeId = $this->cleanParam($_GET['id_chapter']);

        $this->delete();

        if ($this->delete($episodeId) === false) {
            $_SESSION['error_com'] = "Impossible de supprimer le commentaire";
            header('Location: index.php?action=getPost&id=' . $episodeId . '#block_comment');
        } else {
            $_SESSION['success_com'] = "Le commentaire a bien été supprimé";
            header('Location: index.php?action=getPost&id=' . $episodeId . '#block_comment');
        }
    }
}
