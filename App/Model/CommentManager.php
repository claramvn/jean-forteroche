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
}
