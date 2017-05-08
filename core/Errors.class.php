<?php
// display error for the current environment
// todo: un system de log d'erreur
class Errors{

    const BAD_TOKEN = "Mauvais token";
    const BAD_CAPCHA = "Mauvais capcha";
    const EMAIL_NO_VALID = "L'email : %s est invalide";
    const FIELD_NO_ISSET = "Le champs %s n'est pas envoyer";
    const FIELD_EMPTY = "Le champs %s est vide";
    const DATE_NOT_VALID = "La date : %s est invalide";
    const UNIQUE = "%s : %s est déjà utiliser";
    const LENGTH_MIN = "Le champs %s et trop petit , il doit faire entre %s et %s characteres";
    const LENGTH_MAX = "Le champs %s et trop grand , il doit faire entre %s et %s characteres";
    const INTERVAL_MIN = "Le date %s et trop petite (%s), elle doit etre de plus %s ans et moin %s ans";
    const INTERVAL_MAX = "Le date %s et trop grande (%s), elle doit etre de plus %s ans et moin %s ans";

    const LOGIN_ERROR = "Les identifiants sont inexacts";

    static function error500($message){
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', false, 500);
        if (ENV_IS_DEV) {
            die($message);
        }
        die("Error 500 appeler le moderateur");
    }
	
}