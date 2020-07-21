<?php

namespace App\Model;

class CommentManager extends Manager
{

    /*********************** FRONTEND ************************/

    // Afficher les commentaires d'un chapitre
    public function getCommentsByChapter($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT c.id_comment, u.pseudo_user, u.avatar_user, c.content_comment, c.date_comment, c.alert_comment, c.id_chapter, c.id_user FROM comments AS c LEFT JOIN users AS u ON c.id_user = u.id_user WHERE c.id_chapter = ? ORDER BY c.id_comment ASC ");
        $req->execute(array($postId));
        $comments = $req->fetchAll();
        return $comments;
    }

    // Ajouter un commentaire
    public function addComment($message, $postId, $userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments (content_comment, date_comment, alert_comment, id_chapter, id_user) VALUES (?, NOW(), 0, ?, ?)');
        $comment = $req->execute(array($message, $postId, $userId));
        return $comment;
    }

    // Signaler un commentaire
    public function reportComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET alert_comment = 1 WHERE id_comment = ?');
        $reportComment = $req->execute(array($commentId));
        return $reportComment;
    }

    /************************************  BACKEND  ****************************/

    // Affichage commentaires signalés
    public function getReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT c.id_comment, u.pseudo_user, u.avatar_user, c.content_comment, c.date_comment, c.alert_comment, c.id_chapter, c.id_user FROM comments AS c LEFT JOIN users AS u ON c.id_user = u.id_user WHERE c.alert_comment > 0 ORDER BY c.date_comment DESC ");
        $req->execute(array());
        $reportedComments = $req->fetchAll();
        return $reportedComments;
    }

    // Modérer un commentaire
    public function undoReportComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET alert_comment = 0 WHERE id_comment = ?');
        $undoReportComment = $req->execute(array($commentId));
        return $undoReportComment;
    }

    // Supprimer un commentaire
    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id_comment = ?');
        $deleteComment = $req->execute(array($commentId));
        return $deleteComment;
    }

    // Supprimer le(s) commentaire(s) lié(s) au post
    public function deleteCommentWhereDeletedPost($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id_chapter = ?');
        $deleteComment = $req->execute(array($commentId));
        return $deleteComment;
    }
}
