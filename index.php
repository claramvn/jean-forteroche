<?php
session_start();
// Affichage des erreurs
ini_set('error_reporting', E_ALL);

require_once('vendor/autoload.php');

use \App\Controller\FrontController;

try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {

            /*********************************************************************************
            ************************************ FrontController *****************************
            *********************************************************************************/
            
            
        }
    } else {
        //Accueil
        $frontController = new FrontController();
        $frontController->home();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
