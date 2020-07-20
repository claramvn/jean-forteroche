<?php

namespace App\Controller;

use \App\Model\UserManager;

class UserController extends AncestorController
{
    // Inscription
    public function register()
    {
        require('view/register.php');
    }

    // Connexion
    public function connection()
    {
        require('view/connection.php');
    }

    // Mot de passe oublié
    public function resetPass()
    {
        require('view/resetPass.php');
    }
}
