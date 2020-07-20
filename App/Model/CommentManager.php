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
}
