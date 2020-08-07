<?php

namespace App\Model;

class Manager
{
    //Connexion bdd
    protected function dbConnect()
    {
        try {
            $db = new \PDO('mysql:host=localhost;dbname=alaska;charset=utf8', 'root', '');
            return $db;
        } catch (Exception $e) {
            require_once('view/error404.php');
        }
    }
}
