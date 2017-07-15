<?php
include "Helpers.function.php";

define("DS", DIRECTORY_SEPARATOR);
define("ROOT_DIR", __DIR__.DS."..".DS);
define("INSTALLER_FILE", ROOT_DIR."_installer".DS);
define("VENDOR" , __DIR__.DS."..".DS."vendor".DS);
define("VENDOR_EMAIL" , VENDOR."PHPMailer-master".DS);
define("DIR_PUBLIC", ROOT_DIR."public".DS);
define("DIR_IMAGES", DIR_PUBLIC."website".DS."images".DS);
define("DIR_UPLOAD", DIR_PUBLIC."website".DS."upload".DS);
define("BASE_PATH", "/cinems/");
define("BASE_PATH_PATTERN", "\/cinems\/");
define("URL_WEBSITE", "http://".$_SERVER['HTTP_HOST']."/");
define("URL_WEBSITE_ADMIN", URL_WEBSITE."admin/");
define("URL_WEBSITE_API", URL_WEBSITE."api/");
define("PATH_MEDIAS_WEBSITE", URL_WEBSITE."website/");
define("PATH_MEDIAS_IMAGES", PATH_MEDIAS_WEBSITE."images/");
define("PATH_MEDIAS_UPLOAD", PATH_MEDIAS_WEBSITE."upload/");
define("PATH_MEDIAS_CSS", PATH_MEDIAS_WEBSITE."css/");
define("PATH_MEDIAS_JS", PATH_MEDIAS_WEBSITE."js/");

$config = null;
if (file_exists(__DIR__.DS."config.ini")) {
    $config = parse_ini_file(__DIR__.DS."config.ini");
}

define("DB_USER", isset($config['DB_USER'])? $config['DB_USER'] :"root");
define("DB_PWD", isset($config['DB_PWD']) ? $config['DB_PWD'] :""); // wamp empty
define("DB_NAME", isset($config['DB_NAME']) ? $config['DB_NAME']:"cinems");
define("DB_HOST", isset($config['DB_HOST']) ? $config['DB_HOST']:"localhost");
define("DB_PORT", isset($config['DB_PORT']) ? $config['DB_PORT']:"8889"); // wamp 3306
define("DB_TYPE", isset($config['DB_TYPE']) ? $config['DB_TYPE']:"mysql");

define("EMAIL_USERNAME", isset($config['EMAIL_USERNAME'])? $config['EMAIL_USERNAME'] :"");
define("EMAIL_PASSWORD", isset($config['EMAIL_PASSWORD'])? $config['EMAIL_PASSWORD'] :"");

define("ENV_TYPE", $config['ENV_TYPE']?:"prod"); // prod | dev
define("ENV_IS_DEV", ENV_TYPE === "dev");