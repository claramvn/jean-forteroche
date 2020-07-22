<?php

namespace App\Controller;

use \App\Model\UserManager;

class AncestorController
{
    /************** AUTHENTIFICATION  **************/

    // Utilisateur connécté
    protected function getPowerfulHash($idUser)
    {
        $combo = $idUser . "essaiesDeTrouverMonHash2020";
        $hashCombo = hash("sha256", $combo);
        return $hashCombo;
    }

    // Utilisateur connécté
    protected function is_logged()
    {
        if (isset($_SESSION['id_user']) && isset($_SESSION['id_hash_user'])) {
            // Id utilisateur qui tente une connection
            $id = $_SESSION['id_user'];

            // Récup utilisateur en base par l'id
            $userManager = new UserManager();
            $this->user = $userManager->getUserById($id);
            // Récup de son id
            $idUser = $this->user['id_user'];
            
            //hash de l'id récup à la connection
            $hash1 = $_SESSION['id_hash_user'];
            // hash de l'id si utilisateur est en base
            $hash2 = $this->getPowerfulHash($idUser);
       
            if ($hash1 === $hash2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Administrateur
    protected function is_admin()
    {
        if ($this->is_logged()) {
            if ($this->user['rank_user'] !== "1") {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**************  NETTOYAGE PARAMETRES **************/

    protected function cleanParam($param)
    {
        $clean = trim(htmlspecialchars($param));
        return $clean;
    }

    /************** CREATION FORMAT INTRODUCTION **************/

    protected function cutContent($content)
    {
        $length = 550;
        if (strlen(htmlspecialchars_decode($content)) >= $length) {
            // Contenu entier
            $allContent = htmlspecialchars_decode($content);
            // Dernier espace du contenu après 550 caractères
            $lastPos = strpos($allContent, ' ', $length);
            // Retourne segment du contenu de 0 à position recherchée
            $content = substr(nl2br($allContent), 0, $lastPos) .' ...';
            return $content;
        }
    }

    /************** DATES US / DATE FR  **************/

    // datetime us vers date fr
    protected function dateTimeUsToDateFr($date)
    {
        $formatUs = explode(' ', $date);
        $segmentDate = $formatUs[0];

        $explodeFormatUs = explode('-', $segmentDate);
        $dateFr = $explodeFormatUs[2] . '/' . $explodeFormatUs[1] . '/' . $explodeFormatUs[0];
        return $dateFr;
    }

    // datetime us vers datetime fr
    protected function dateTimeUsToDateTimeFr($date)
    {
        $formatUs = explode(' ', $date);
        $segmentDate = $formatUs[0];
        $segmentTime = $formatUs[1];

        $explodeFormatUs = explode('-', $segmentDate);
        $dateFr = $explodeFormatUs[2] . '/' . $explodeFormatUs[1] . '/' . $explodeFormatUs[0];
        return $dateFr . ' à ' . $segmentTime;
    }

    // Récup date us de datetime us
    protected function getDateOfDateTimeUs($date)
    {
        $dateTimeUs = explode(' ', $date);
        $segmentDate = $dateTimeUs[0];
        return $segmentDate;
    }

    // Récup heure us de datetime us
    protected function getTimeOfDateTimeUs($date)
    {
        $dateTimeUs = explode(' ', $date);
        $segmentTime = $dateTimeUs[1];
        return $segmentTime;
    }

    /************** TELECHARGEMENT FICHIERS  **************/

    // Poids max
    protected function checkMaxSize($file)
    {
        if ($file['size'] !== 0 && $file['size'] <= 3000000) {
            return true;
        } else {
            return false;
        }
    }

    // Extension téléchargée
    protected function fileExtensionUpload($file)
    {
        $extensionUpload = pathinfo($file['name']);
        $extension = $extensionUpload['extension'];
        return $extension;
    }

    // Extensions autorisées
    protected function fileExtensionAllowed()
    {
        $extension = array('jpg', 'jpeg', 'png');
        return $extension;
    }

    // Renommage
    protected function newName($file, $extension)
    {
        $fileUpload = str_replace($file['name'], "alaska", $file['name']);
        $file = $fileUpload . time() . '.' . $extension;
        return $file;
    }

    // Téléchargement
    protected function uploadFile($file, $newName)
    {
        move_uploaded_file($file['tmp_name'], 'public/img/' . $newName);
    }
}
