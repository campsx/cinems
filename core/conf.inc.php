<?php
include "Helpers.function.php";

define("DS", DIRECTORY_SEPARATOR);
define("VENDOR" , __DIR__.DS."..".DS."vendor".DS);
define("VENDOR_EMAIL" , VENDOR."PHPMailer-master".DS);
define("DIR_PUBLIC", __DIR__.DS."..".DS."public".DS);
define("DIR_IMAGES", DIR_PUBLIC."website".DS."images".DS);
define("DIR_UPLOAD", DIR_PUBLIC."website".DS."upload".DS);
define("BASE_PATH", "/cinems/");
define("BASE_PATH_PATTERN", "\/cinems\/");
define("URL_WEBSITE", "http://".$_SERVER['HTTP_HOST']."/cinems/");
define("URL_WEBSITE_ADMIN", URL_WEBSITE."admin/");
define("URL_WEBSITE_API", URL_WEBSITE."api/");
define("PATH_MEDIAS_WEBSITE", URL_WEBSITE."public/website/");
define("PATH_MEDIAS_IMAGES", PATH_MEDIAS_WEBSITE."images/");
define("PATH_MEDIAS_UPLOAD", PATH_MEDIAS_WEBSITE."upload/");
define("PATH_MEDIAS_CSS", PATH_MEDIAS_WEBSITE."css/");
define("PATH_MEDIAS_JS", PATH_MEDIAS_WEBSITE."js/");

$config = null;
if (file_exists(__DIR__.DS."config.ini")) {
    $config = parse_ini_file(__DIR__.DS."config.ini");
}

define("DB_USER", $config['DB_USER']?:"root");
define("DB_PWD", $config['DB_PWD']?:""); // wamp empty
define("DB_NAME", $config['DB_NAME']?:"cinems");
define("DB_HOST", $config['DB_HOST']?:"localhost");
define("DB_PORT", $config['DB_PORT']?:"8889"); // wamp 3306
define("DB_TYPE", $config['DB_TYPE']?:"mysql");

define("EMAIL_USERNAME", $config['EMAIL_USERNAME']?:"");
define("EMAIL_PASSWORD", $config['EMAIL_PASSWORD']?:"");

define("ENV_TYPE", $config['ENV_TYPE']?:"prod"); // prod | dev
define("ENV_IS_DEV", ENV_TYPE === "dev");