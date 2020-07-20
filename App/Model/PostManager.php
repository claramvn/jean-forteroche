<?php

namespace App\Model;

class PostManager extends Manager
{

    /*********************** FRONTEND ************************/

    // Accueil : Chapitre récent
    public function getRecentPost()
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT * FROM chapters ORDER BY date_chapter DESC LIMIT 0,1 ");
        $recentPost = $req->fetch();
        return  $recentPost;
    }

    // Listing chapitres
    public function listPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT * FROM chapters ORDER BY date_chapter DESC");
        $req->execute(array());
        $posts = $req->fetchAll();
        return $posts;
    }

    // Chapitre séléctionné
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM chapters WHERE id_chapter = ?");
        $req->execute(array($postId));
        $post = $req->fetch();
        return  $post;
    }

    /************************************  BACKEND  ****************************/

    // Ajouter un chapitre
    public function addPost($novel, $titlePost, $text, $image)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO chapters (novel_chapter, title_chapter, text_chapter, image_chapter, date_chapter) VALUES (?, ?, ?, ?, NOW())');
        $addPost = $req->execute(array($novel, $titlePost, $text, $image));
        return $addPost;
    }

    // Supprimer un chapitre
    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM chapters WHERE id_chapter = ?');
        $deletePost = $req->execute(array($postId));
        return $deletePost;
    }
}
