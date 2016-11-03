<?php

namespace App\Repositories\Util;

use App\Repositories\Util\LogRepository;

class Email {

    public function sendMail($mail, $message_html, $sujet) {

        try {
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) { // On filtre les serveurs qui rencontrent des bogues.
                $passage_ligne = "\r\n";
            } else {
                $passage_ligne = "\n";
            }

            //Création de la boundary
            $boundary = "-----=" . md5(rand());

            //Création du header de l'e-mail.
            $header = "From: \"Steve\"<stevekouna@gmail.com>" . $passage_ligne;
            $header.= "Reply-to: \"Steve\" <" . $mail . ">" . $passage_ligne;
            $header.= "MIME-Version: 1.0" . $passage_ligne;
            $header.= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
//            dd($header);
            $message = $passage_ligne . "--" . $boundary . $passage_ligne;
            //Ajout du message au format HTML
            $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
            $message.= $passage_ligne . $message_html . $passage_ligne;

            $message.= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
            $message.= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
//            dd($message);
            
            //=====Envoi de l'e-mail.
            $mail0 = \mail($mail, $sujet, $message, $header);
            return $mail0;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

}
