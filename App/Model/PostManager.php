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
}
