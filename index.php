<?php
session_start();
require "core/conf.inc.php";

if (!ENV_IS_DEV) {
    ini_set("display_errors",0);
    error_reporting(0);
}

spl_autoload_register(function ($class){
	if(file_exists("core/".$class.".class.php")){
		include "core/".$class.".class.php";
	} else if(file_exists("src/models/".$class.".class.php")){
		include "src/models/".$class.".class.php";
	}
});


$redirection = new Redirection();
$redirection->runDirection();
