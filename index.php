<?php
session_start();
// Affichage des erreurs
ini_set('error_reporting', E_ALL);

require_once('vendor/autoload.php');

try {
    if (isset($_GET['action'])) {
        switch ($action) {
            
          
    } else {
        //Accueil
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
