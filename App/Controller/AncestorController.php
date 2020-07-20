<?php

namespace App\Controller;

class AncestorController
{
    /**************  NETTOYAGE PARAMETRES **************/


    // Nettoyage des paramètres
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
    protected function getdateOfDateTimeUs($date)
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
}
