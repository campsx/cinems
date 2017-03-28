<?php
// display error for the current environment

class Errors{

    static function error500($message){
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', false, 500);
        if (ENV_IS_DEV) {
            die($message);
        }
        die("Error 500 appeler le moderateur");
    }
	
}