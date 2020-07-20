<?php

namespace App\Model;

class UserManager extends Manager
{

    // Récup utilisateur par le nom
    public function getUserByName($name)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE pseudo_user = ?');
        $req->execute(array($name));
        $user = $req->fetch();
        return $user;
    }

    // Récup E-mail utilisateur pour vérif
    public function emailExist($email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT email_user FROM users WHERE email_user = ?');
        $req->execute(array($email));
        $emailExist = $req->fetch();
        return $emailExist;
    }

    // Inscription utilisateur
    public function addUser($name, $email, $pass, $avatar)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users (pseudo_user, email_user, pass_user, avatar_user, rank_user) VALUES (?, ?, ?, ?, 0)');
        $addUser = $req->execute(array($name, $email, $pass, $avatar));
        return $addUser;
    }

    // Réinitialise le mot de passe
    public function updatePass($pass, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE users SET pass_user = ? WHERE email_user = ?');
        $req->execute(array($pass, $email));
        $updatePass = $req->fetch();
        return $updatePass;
    }

    // Récup utilisateur
    public function getUserById($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE id_user = ?');
        $req->execute(array($id));
        $user = $req->fetch();
        return $user;
    }
}
