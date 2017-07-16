<?php
session_start();
require __DIR__."/../core/conf.inc.php";

if (!ENV_IS_DEV) {
    ini_set("display_errors",0);
    error_reporting(0);
}

spl_autoload_register(function ($class){
	if(file_exists(__DIR__."/../core/".$class.".class.php")){
		include __DIR__."/../core/".$class.".class.php";
	} else if(file_exists(__DIR__."/../src/models/".$class.".class.php")){
		include __DIR__."/../src/models/".$class.".class.php";
	}
});


$redirection = new Redirection();
$redirection->runDirection();
