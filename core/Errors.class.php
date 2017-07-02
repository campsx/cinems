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
    const LENGTH_MIN = "Le champs %s est trop petit , il doit faire entre %s et %s characteres";
    const LENGTH_MAX = "Le champs %s est trop grand , il doit faire entre %s et %s characteres";
    const LENGTH_NUMBER_MIN = "Le champs %s est trop petit , il doit faire entre %s et %s";
    const LENGTH_NUMBER_MAX = "Le champs %s est trop grand , il doit faire entre %s et %s";
    const INTERVAL_MIN = "La date '%s' est trop petite (%s), elle doit etre de plus %s ans et moin %s ans";
    const INTERVAL_MAX = "La date '%s' est trop grande (%s), elle doit etre de plus %s ans et moin %s ans";
    const SLUG_NOT_VALID = "Le slug est incorrect";
    const MULTIPLE_NO_EXIST = "La valeur %s pour le champs %s n'existe pas.";
    const TRUE_FALSE = "Pour le champs %s vous devez choisir entre true et false";
    const DATE_A_NUMBER = "La valeur dans le champs %s n'est pas un nombre";
    const ENTITY_MULTIPLE = "Le champs %s doit être un choix multiple";
    const ENTITY_NO_MULTIPLE = "Le champs %s ne doit pas être un choix multiple";
    const ENTITY_BAD = "Le champs %s à un choix inexistant";

    const LOGIN_ERROR = "Les identifiants sont inexacts.";
    const ROLE_ERROR = "Vous n'avez pas les droits pour acceder à cette page.";

    static function error500($message){
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', false, 500);
        if (ENV_IS_DEV) {
            die($message);
        }
        die("Error 500 appeler le moderateur");
    }
	
}