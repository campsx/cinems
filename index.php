<?php
session_start();
require "core/conf.inc.php";

spl_autoload_register(function ($class){
	if(file_exists("core/".$class.".class.php")){
		include "core/".$class.".class.php";
	} else if(file_exists("src/models/".$class.".class.php")){
		include "src/models/".$class.".class.php";
	}
});


$redirection = new Redirection();
$redirection->runDirection();
