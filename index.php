<?php

/* Path */
define("PATH_BASE", dirname(realpath(__FILE__)) . "/");
define("PATH_PKG", PATH_BASE ."packages/");
define("PATH_APP", PATH_PKG ."app/");
define("PATH_CORE", PATH_PKG ."core/");
define("PATH_CLASS", PATH_CORE ."class/");
define("PATH_VENDOR", PATH_CORE ."vendor/");
define("PATH_CONTROLLER", PATH_APP ."controller/");
define("PATH_MODEL", PATH_APP ."model/");
define("PATH_TMP", PATH_APP ."tmp/");
define("PATH_PUBLIC", PATH_BASE ."public/");

/* Parameters */
define("DEFAULT_CONTROLLER", "home");
define("DEFAULT_ACTION", "index");
define("MAX_PARAMETERS", 5);
define("DEFAULT_LANGUAGE", "fr");

/* run the application */
require_once(PATH_CORE ."application.class.php");
Application::run();
?>